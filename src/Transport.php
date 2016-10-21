<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

/**
 *
 */
class Transport
{
    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var int
     */
    protected $list;

    /**
     * @var string
     */
    protected $campaign;

    /**
     * @param \SoapClient $client
     * @param string $list
     * @param string $campaign
     */
    public function __construct(\SoapClient $client, $list = null, $campaign = null)
    {
        $this->client = $client;

        if (!is_null($list)) {
            $this->setList($list);
        }
        if (!is_null($campaign)) {
            $this->setCampaign($campaign);
        }
    }

    /**
     *
     * @param string $list Name of the list 
     * @throws Exception if the list was not found in the remote server
     * @return self
     */
    public function setList($list)
    {
        $response = $this->client->GetListID(['name' => $list]);

        if (Response::SUCCESSFUL!==$response->getCode()) {
            throw new \Exception();
        } else {
            $this->list = $response->getId();

            return $this;
        }
    }

    /**
     * @return int
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     *
     * @param string $campaign Gate Name
     * @return self
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return string
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Subscribe the given user, if not already in list, and returns his identifier
     *
     * @param Properties $user
     * @return int User id
     * @throws UnexpectedValueException if $idKey is not an existing Property
     * @throws Exception If something happens during the request
     */
    public function subscribe(Properties $user, $idKey = 'ID')
    {
        $response = $this->client->GetUserByFilter([
            'List' => $this->list,
            'Filter' => $user,
        ]);

        switch ($response->getCode()) {

            /* the user already exists */
            case Response::SUCCESSFUL:
                $properties = $response->getProperties();
                if (isset($properties[$idKey])) {
                    $id = $properties[$idKey]->getValue();
                    break;
                } else {
                    throw new \UnexpectedValueException(sprintf(
                        "key %s do not exists in %s",
                        $idKey,
                        implode(',', array_keys((array) $properties))
                    ));
                }

            /* the user do not exist, we create it */
            case Response::ERROR_NORESULT:
                $response = $this->client->CreateUser([
                    'List' => $this->list,
                    'Changes' => $user,
                ]);
                if (Response::SUCCESSFUL===$response->getCode()) {
                    $id = $response->getUserId();
                    break;
                }

            /* something wrong */
            default:
                throw new \Exception(
                    $response->getError(),
                    $response->getCode()
                );
        }

        return $id;
    }

    /**
     * @param int $userId
     * @param Properties $inputData
     * @return string
     * @throws Exception
     */
    public function triggerCampaign($userId, Properties $inputData)
    {
        $response = $this->client->TriggerCampaignWithResult([
            'List' => $this->list,
            'UserID' => $userId,
            'GateName' => $this->campaign,
            'InputData' => $inputData,
        ]);

        if (Response::SUCCESSFUL!==$response->getCode()) {
            throw new \Exception(
                $response->getError(),
                $response->getCode()
            );
        } else {
            return $response->getResult();
        }
    }
}
