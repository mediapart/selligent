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
     *
     */
    const TRIGGER = 0x01;

    /**
     *
     */
    const WITH_RESULT = 0x10;

    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $list;

    /**
     * @var string
     */
    protected $campaign;

    /**
     * @param SoapClient
     * @param $list
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
     *
     */
    public function subscribe($user)
    {}

    /**
     *
     */
    public function unsubscribe($userId)
    {}

    /**
     * @param 
     */
    public function triggerCampaign($inputData, $mode = 1)
    {}
}
