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
use Mediapart\Selligent\Response;
use Mediapart\Selligent\Transport;
use Mediapart\Selligent\Properties;

class TransportTest extends TestCase
{
    protected function buildClientForTestList($listId, $listName, $responseCode)
    {
        $GetListIdResponse = $this
            ->getMockBuilder('Mediapart\Selligent\Response\GetListIdResponse')
            ->setMethods(['getCode', 'getId'])
            ->getMock()
        ;
        $GetListIdResponse
            ->method('getCode')
            ->willReturn($responseCode)
        ;
        $GetListIdResponse
            ->method('getId')
            ->willReturn($listId)
        ;
        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(['GetListID'])
            ->getMock()
        ;
        $client
            ->method('GetListID')
            ->with($this->equalTo(['name'=>$listName]))
            ->willReturn($GetListIdResponse)
        ;

        return $client;
    }

    public function testSetList()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $client = $this->buildClientForTestList($listId, $listName, Response::SUCCESSFUL);

        $transport = new Transport($client);
        $result = $transport->setList($listName);

        $this->assertEquals($listId, $transport->getList());
    }

    public function testSetListWithException()
    {
        $client = $this->buildClientForTestList(42, 'TESTLIST', Response::ERROR_NORESULT);

        $this->expectException('Exception');

        $transport = new Transport($client);
        $transport->setList('TESTLIST');
    }

    public function testSetCampaign()
    {
        $campaign = 'TESTCAMPAIGN';
        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $transport = new Transport($client);
        $transport->setCampaign($campaign);

        $this->assertEquals($campaign, $transport->getCampaign());
    }

    public function testConstructor()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $client = $this->buildClientForTestList(42, 'TESTLIST', Response::SUCCESSFUL);

        $transport = new Transport($client, $listName, $campaign);

        $this->assertEquals($listId, $transport->getList());
        $this->assertEquals($campaign, $transport->getCampaign());
    }

    protected function buildClientForTriggerCampaign($listId, $listName, $campaign, $userId, $TriggerCampaignResult, $inputData, $responseCode)
    {
        $GetListIdResponse = $this
            ->getMockBuilder('Mediapart\Selligent\Response\GetListIdResponse')
            ->setMethods(['getCode', 'getId'])
            ->getMock()
        ;
        $GetListIdResponse
            ->method('getCode')
            ->willReturn(Response::SUCCESSFUL)
        ;
        $GetListIdResponse
            ->method('getId')
            ->willReturn($listId)
        ;
        $TriggerCampaignForUserWithResultResponse = $this
            ->getMockBuilder('Mediapart\Selligent\Response\TriggerCampaignForUserWithResultResponse')
            ->setMethods(['getCode', 'getResult'])
            ->getMock()
        ;
        $TriggerCampaignForUserWithResultResponse
            ->method('getCode')
            ->willReturn($responseCode)
        ;
        $TriggerCampaignForUserWithResultResponse
            ->method('getResult')
            ->willReturn($TriggerCampaignResult)
        ;
        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(['GetListID', 'TriggerCampaignForUserWithResult'])
            ->getMock()
        ;
        $client
            ->method('GetListID')
            ->with($this->equalTo(['name'=>$listName]))
            ->willReturn($GetListIdResponse)
        ;
        $client
            ->method('TriggerCampaignForUserWithResult')
            ->with($this->equalTo([
                'List' => $listId,
                'UserID' => $userId,
                'GateName' => $campaign,
                'InputData' => $inputData,
            ]))
            ->willReturn($TriggerCampaignForUserWithResultResponse)
        ;

        return $client;
    }

    public function testTriggerCampaign()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $userId = 1337;
        $TriggerCampaignResult = '[OK]';
        $inputData = new Properties();
        $responseCode = Response::SUCCESSFUL;

        $client = $this->buildClientForTriggerCampaign(
            $listId, $listName, $campaign, $userId,
            $TriggerCampaignResult, $inputData, $responseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);
        $result = $transport->triggerCampaign($userId, $inputData);

        $this->assertEquals($TriggerCampaignResult, $result);
    }

    public function testTriggerCampaignWithException()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $userId = 1337;
        $TriggerCampaignResult = '[OK]';
        $inputData = new Properties();
        $responseCode = Response::ERROR_FAILED;

        $client = $this->buildClientForTriggerCampaign(
            $listId, $listName, $campaign, $userId,
            $TriggerCampaignResult, $inputData, $responseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $this->expectException('\Exception');

        $result = $transport->triggerCampaign($userId, $inputData);
    }

    protected function buildClientForSubscribe($listId, $listName, $campaign, $user, $userProperties, $GetUserByFilterResponseCode, $CreateUserResponseCode)
    {
        $GetListIdResponse = $this
            ->getMockBuilder('Mediapart\Selligent\Response\GetListIdResponse')
            ->setMethods(['getCode', 'getId'])
            ->getMock()
        ;
        $GetListIdResponse
            ->method('getCode')
            ->willReturn(Response::SUCCESSFUL)
        ;
        $GetListIdResponse
            ->method('getId')
            ->willReturn($listId)
        ;
        $GetUserByFilterResponse  = $this
            ->getMockBuilder('Mediapart\Selligent\Response\GetUserByFilterResponse')
            ->setMethods(['getCode', 'getProperties'])
            ->getMock()
        ;
        $GetUserByFilterResponse
            ->method('getCode')
            ->willReturn($GetUserByFilterResponseCode)
        ;
        $GetUserByFilterResponse
            ->method('getProperties')
            ->willReturn($userProperties)
        ;
        $CreateUserResponse  = $this
            ->getMockBuilder('Mediapart\Selligent\Response\CreateUserResponse')
            ->setMethods(['getCode', 'getUserId'])
            ->getMock()
        ;
        $CreateUserResponse
            ->method('getCode')
            ->willReturn($CreateUserResponseCode)
        ;
        $id = isset($userProperties['ID']) ? $userProperties['ID'] : null;
        $CreateUserResponse
            ->method('getUserId')
            ->willReturn($id)
        ;

        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(['GetListID', 'GetUserByFilter', 'CreateUser'])
            ->getMock()
        ;
        $client
            ->method('GetListID')
            ->with($this->equalTo(['name'=>$listName]))
            ->willReturn($GetListIdResponse)
        ;
        $client
            ->method('GetUserByFilter')
            ->with($this->equalTo(['List'=>$listId, 'Filter'=>$user]))
            ->willReturn($GetUserByFilterResponse)
        ;
        $client
            ->method('CreateUser')
            ->with($this->equalTo(['List'=>$listId, 'Changes'=>$user]))
            ->willReturn($CreateUserResponse)
        ;

        return $client;
    }

    public function testSubscribeWithExistingUser()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $user = new Properties();
        $user['NAME'] = 'Foo Bar';
        $user['MAIL'] = 'foo@bar.tld';
        $userProperties = new Properties();
        $userProperties['ID'] = 1337;
        $GetUserByFilterResponseCode = Response::SUCCESSFUL;
        $CreateUserResponseCode = Response::ERROR_FAILED;

        $client = $this->buildClientForSubscribe(
            $listId, $listName, $campaign, $user, $userProperties,
            $GetUserByFilterResponseCode, $CreateUserResponseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $id = $transport->subscribe($user);

        $this->assertEquals($userProperties['ID'], $id);
    }

    public function testSubscribeWithExistingUserAndUnexpectedValueException()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $user = new Properties();
        $user['NAME'] = 'Foo Bar';
        $user['MAIL'] = 'foo@bar.tld';
        $userProperties = new Properties();
        $userProperties['userid'] = 1337;
        $GetUserByFilterResponseCode = Response::SUCCESSFUL;
        $CreateUserResponseCode = Response::ERROR_FAILED;

        $client = $this->buildClientForSubscribe(
            $listId, $listName, $campaign, $user, $userProperties,
            $GetUserByFilterResponseCode, $CreateUserResponseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $this->expectException('\UnexpectedValueException');

        $transport->subscribe($user);
    }

    public function testSubscribeWithExistingUserAndException()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $user = new Properties();
        $user['NAME'] = 'Foo Bar';
        $user['MAIL'] = 'foo@bar.tld';
        $userProperties = new Properties();
        $userProperties['ID'] = 1337;
        $GetUserByFilterResponseCode = Response::ERROR_FAILED;
        $CreateUserResponseCode = Response::ERROR_FAILED;

        $client = $this->buildClientForSubscribe(
            $listId, $listName, $campaign, $user, $userProperties,
            $GetUserByFilterResponseCode, $CreateUserResponseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $this->expectException('\Exception');

        $transport->subscribe($user);
    }

    public function testSubscribeAndCreatingUser()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $user = new Properties();
        $user['NAME'] = 'Foo Bar';
        $user['MAIL'] = 'foo@bar.tld';
        $userProperties = new Properties();
        $userProperties['ID'] = 1337;
        $GetUserByFilterResponseCode = Response::ERROR_NORESULT;
        $CreateUserResponseCode = Response::SUCCESSFUL;

        $client = $this->buildClientForSubscribe(
            $listId, $listName, $campaign, $user, $userProperties,
            $GetUserByFilterResponseCode, $CreateUserResponseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $id = $transport->subscribe($user);

        $this->assertEquals($userProperties['ID'], $id);
    }

    public function testSubscribeAndCreatingUserWithException()
    {
        $listId = 42;
        $listName = 'TESTLIST';
        $campaign = 'TESTCAMPAIGN';
        $user = new Properties();
        $user['NAME'] = 'Foo Bar';
        $user['MAIL'] = 'foo@bar.tld';
        $userProperties = new Properties();
        $userProperties['ID'] = 1337;
        $GetUserByFilterResponseCode = Response::ERROR_NORESULT;
        $CreateUserResponseCode = Response::ERROR_FAILED;

        $client = $this->buildClientForSubscribe(
            $listId, $listName, $campaign, $user, $userProperties,
            $GetUserByFilterResponseCode, $CreateUserResponseCode
        );
        $logger = $this->getMockBuilder('Psr\Log\NullLogger')->getMock();

        $transport = new Transport($client, $listName, $campaign);
        $transport->setLogger($logger);

        $this->expectException('\Exception');

        $transport->subscribe($user);
    }
}
