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

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;

use Mediapart\Selligent\Response\GetUserByFilterResponse;

/**
 *
 */
class Transport implements LoggerAwareInterface
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
     * @var LoggerInterface
     */
    protected $logger = null;

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
     * {@inheritDoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
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

        if (Response::SUCCESSFUL !== $response->getCode()) {
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
     * @param GetUserByFilterResponse $response
     * @param string $idKey
     *
     * @return integer
     */
    private function getExistingUserId(GetUserByFilterResponse $response, $idKey)
    {
        $properties = $response->getProperties();
        if (isset($properties[$idKey])) {
            $id = $properties[$idKey];
            if ($this->logger) {
                $this->logger->info('User already registered', [$idKey => $id]);
            }
            return $id;
        } else {
            throw new \UnexpectedValueException(sprintf(
                "key %s do not exists in %s",
                $idKey,
                implode(',', array_keys((array) $properties))
            ));
        }
    }

    /**
     * @param Properties $user
     * @return integer
     */
    private function createUser(Properties $user)
    {
        $response = $this->client->CreateUser([
            'List' => $this->list,
            'Changes' => $user,
        ]);
        $id = null;
        if (Response::SUCCESSFUL === $response->getCode()) {
            $id = $response->getUserId();
            if ($this->logger) {
                $this->logger->notice(
                    'New user registered',
                    [
                        'id' => $id, 
                        'properties' => $user
                    ]
                );
            }
        }
        return $id;
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

        try {
            switch ($response->getCode()) {

                /* the user already exists */
                case Response::SUCCESSFUL:
                    $id = $this->getExistingUserId($response, $idKey);
                    break;

                /* the user do not exist, we create it */
                case Response::ERROR_NORESULT:
                    if($id = $this->createUser($user)) {
                        break;
                    }

                /* something wrong */
                default:
                    throw new \Exception(
                        $response->getError(),
                        $response->getCode()
                    );
            }
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error($e->getMessage());
            }
            throw $e;
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
        $options = [
            'List' => $this->list,
            'UserID' => $userId,
            'GateName' => $this->campaign,
            'InputData' => $inputData,
        ];
        
        $response = $this->client->TriggerCampaignForUserWithResult($options);
       
        $context = [
            'request' => $options, 
            'response' => [
                'code' => $response->getCode(),
                'error' => $response->getError(),
                'result' => $response->getResult(),
            ],
        ];

        if (Response::SUCCESSFUL !== $response->getCode()) {
            if ($this->logger) {
                $this->logger->error('triggerCampaign has failed', $context);
            }
            throw new \Exception(
                $response->getError(),
                $response->getCode()
            );
        } else {
            if ($this->logger) {
                $this->logger->info('triggerCampaign with success', $context);
            }
            return $response->getResult();
        }
    }
}
