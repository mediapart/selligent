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

use Psr\Log\LogLevel;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Request\CreateCampaign;

/**
 *
 */
class Broadcast implements LoggerAwareInterface
{
    /**
     * @var \XMLWriter
     */
    protected $writer;

    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger = null;

    /**
     * @param \SoapClient $client
     * @param string $list
     * @param string $campaign
     */
    public function __construct(\SoapClient $client)
    {
        $this->writer = new \XMLWriter();
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Campaign $campaign
     * @return CreateCampaignResponse
     */
    public function triggerCampaign(Campaign $campaign)
    {
        $request = new CreateCampaign($this->writer);
        $response = $this->client->CreateCampaign([
            'Xml' => $request->basedOn($campaign)
        ]);

        if ($this->logger) {

            if (Response::SUCCESSFUL !== $response->getCode()) {
                $level = LogLevel::ERROR;
                $message = 'triggerCampaign has failed';
            } else {
                $level = LogLevel::INFO;
                $message = 'triggerCampaign with success';
            }

            $this->logger->log(
                $level,
                $message,
                [
                    'campaign' => [
                        'name' => $campaign->getName(),
                        'status' => $campaign->getStatus(),
                        'stdate' => $campaign->getStartDate()->format(\DateTime::RFC850),
                    ],
                    'response' => [
                        'code' => $response->getCode(),
                        'error' => $response->getError(),
                        'result' => $response->getXml(),
                    ],
                ]
            );
        }

        return $response;
    }
}
