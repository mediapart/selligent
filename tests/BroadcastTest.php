<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Mediapart\Selligent\Broadcast;
use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Response;

class BroadcastTest extends TestCase
{
    /**
     * Test simple broadcast campaign.
     */
    public function testBroadcast()
    {
        $client = $this->getClient();
        $campaign = $this->getCampaign();

        $broadcast = new Broadcast($client);
        $response = $broadcast->triggerCampaign($campaign);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }

    /**
     * Test simple broadcast campaign with logging result.
     */
    public function testBroadcastWithLogger()
    {
        $client = $this->getClient();
        $campaign = $this->getCampaign();
        $logger = $this->getLogger(LogLevel::INFO);

        $broadcast = new Broadcast($client);
        $broadcast->setLogger($logger);
        $response = $broadcast->triggerCampaign($campaign);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }

    /**
     * Test simple broadcast campaign, logging error.
     */
    public function testBroadcastWithError()
    {
        $client = $this->getClient(Response::ERROR_FAILED);
        $campaign = $this->getCampaign();
        $logger = $this->getLogger(LogLevel::ERROR);

        $broadcast = new Broadcast($client);
        $broadcast->setLogger($logger);
        $response = $broadcast->triggerCampaign($campaign);

        $this->assertEquals(Response::ERROR_FAILED, $response->getCode());
    }

    /**
     * @return SoapClient
     */
    public function getClient($code = Response::SUCCESSFUL)
    {
        $response = $this
            ->getMockBuilder('Mediapart\Selligent\Response\CreateCampaignResponse')
            ->disableOriginalConstructor()
            ->setMethods(['getCode', 'getXml'])
            ->getMock()
        ;
        $response
            ->method('getCode')
            ->willReturn($code)
        ;
        $response
            ->method('getXml')
            ->willReturn('')
        ;

        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(['CreateCampaign'])
            ->getMock()
        ;
        $client
            ->method('CreateCampaign')
            ->willReturn($response)
        ;

        return $client;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        $tomorrow = new \DateTime('tomorrow');
        $campaign = $this
            ->getMockBuilder('Mediapart\Selligent\Broadcast\Campaign')
            ->setMethods(['getStartDate', 'getStatus'])
            ->getMock()
        ;
        $campaign
            ->method('getStartDate')
            ->willReturn($tomorrow)
        ;
        $campaign
            ->method('getStatus')
            ->willReturn(Campaign::TEST)
        ;

        return $campaign;
    }

    /**
     * @return Psr\Log\LoggerInterface
     */
    public function getLogger($expecting)
    {
        $logger = $this
            ->getMockBuilder('Psr\Log\NullLogger')
            ->setMethods(['log'])
            ->getMock()
        ;
        $logger
            ->method('log')
            ->with($this->equalTo($expecting))
        ;

        return $logger;
    }
}
