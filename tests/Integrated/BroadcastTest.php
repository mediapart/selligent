<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests\Integrated;

use \XMLWriter;
use Mediapart\Selligent\Response;
use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Broadcast\Target;
use Mediapart\Selligent\Broadcast\Email;
use Mediapart\Selligent\Request\CreateCampaign;
use Mediapart\Selligent\Tests\Integrated\IntegrationTestCase;

class BroadcastTest extends IntegrationTestCase
{
    protected function setUp()
    {
        $this->requireEnv([
            'soap_login',
            'soap_password',
            'soap_wsdl_broadcast',
            'selligent_folderid',
            'selligent_maildomainid',
            'selligent_listid',
            'selligent_segmentid',
            'selligent_queueid',
            'selligent_macategory',
        ]);

        $con = new Connection();
        $this->client = $con->open(
            [
                'login' => getenv('soap_login'),
                'password' => getenv('soap_password'),
                'wsdl' => getenv('soap_wsdl_broadcast'),
            ],
            Connection::API_BROADCAST
        );
    }

    public function testCompleteHTML()
    {
        $tomorrow = new \DateTime('tomorrow');

        $campaign = new Campaign();
        $campaign
            ->setName('Broadcast Test ('.$tomorrow->format('l, jS F').')')
            ->setFolderId(getenv('selligent_folderid'))
            ->setState(Campaign::ACTIVE)
            ->setStartDate($tomorrow)
            ->setDescription(sprintf(
                'Some broadcast test scheduled for the %s at %s.',
                $tomorrow->format('L, jS F'),
                $tomorrow->format('g:ia')
            ))
        ;
        $target = new Target();
        $target
            ->setListId(getenv('selligent_listid'))
            ->setPriorityField('CREATED_DT')
            ->setPrioritySorting('DESC')
            ->setSegmentid(getenv('selligent_segmentid'))
        ;
        $email = new Email();
        $email
            ->setName('Broadcast Email Test ('.$tomorrow->format('l, jS F').')')
            ->setFolderId(getenv('selligent_folderid'))
            ->setMailDomainId(getenv('selligent_maildomainid'))
            ->listUnsubscribe(false)
            ->setQueueId(getenv('selligent_queueid'))
            ->setMaCategory(getenv('selligent_macategory'))
            ->setTarget($target)
            ->setContent([
                'HTML' => 'html over here.',
                'TEXT' => 'text over there.',
                'FROM_ADDR' => 'from@domain.tld',
                'FROM_NAME' => 'From Name',
                'TO_ADDR' => '~MAIL~',
                'TO_NAME' => '~NAME~',
                'REPLY_ADDR' => 'reply-to@domain.tld',
                'REPLY_NAME' => 'Reply To',
                'SUBJECT' => sprintf(
                    '%s at %s.',
                    $tomorrow->format('l, jS F'),
                    $tomorrow->format('g:ia')
                ),
            ])
        ;
        $campaign->addEmail($email);

        $writer = new XMLWriter();
        $request = new CreateCampaign($writer);
        $xml = $request->basedOn($campaign);
        $response = $this->client->CreateCampaign(['Xml' => $xml]);

        $this->assertEquals('', $response->getError());
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }
}
