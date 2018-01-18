<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests\Broadcast;

use PHPUnit\Framework\TestCase;
use \XMLWriter;
use Mediapart\Selligent\Request\CreateCampaign;
use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Broadcast\Target;
use Mediapart\Selligent\Broadcast\Email;

class CampaignTest extends TestCase
{
    public function testWrongCampaignState()
    {
        $campaign = new Campaign();

        $this->expectException(\InvalidArgumentException::class);

        $campaign->setState('Lorem ipsum dolor');
    }

    public function testXml()
    {
        $campaign = $this->getCampaign();
        $writer = new XMLWriter();
        $request = new CreateCampaign($writer);

        $xml = $request->basedOn($campaign);

        $document = simplexml_load_string($xml);
        $this->assertEquals($campaign->getName(), (string) $document->CAMPAIGN['NAME']);
        $this->assertEquals($campaign->getFolderId(), (int) $document->CAMPAIGN['FOLDERID']);
        $this->assertEquals($campaign->getState(), (string) $document->CAMPAIGN['STATE']);
        $this->assertEquals($campaign->getStartDate()->format('YmdHis'), (string) $document->CAMPAIGN['START_DT']);
        $this->assertEquals($campaign->getDescription(), (string) $document->CAMPAIGN['DESCRIPTION']);
        $this->assertEquals($campaign->getMaCategory(), (string) $document->CAMPAIGN['MACATEGORY']);
        $this->assertEquals($campaign->getProductId(), (int) $document->CAMPAIGN['PRODUCTID']);
        $this->assertEquals($campaign->getClashPlanId(), (int) $document->CAMPAIGN['CLASHPLANID']);

        $emails = $campaign->getEmails();
        $this->assertEquals(count($emails), (int) $document->EMAILS->count());
        for ($i=0; $i<$document->EMAILS->count(); $i++) {
            $email = $emails[$i];

            $node = $document->EMAILS->EMAIL[$i];
            $this->assertEquals($email->getName(), (string) $node['NAME']);
            $this->assertEquals($email->getFolderId(), (int) $node['FOLDERID']);
            $this->assertEquals($email->getMailDomainId(), (int) $node['MAILDOMAINID']);
            $this->assertEquals($email->canUnsubscribe() ? 'TRUE' : 'FALSE', (string) $node['LIST_UNSUBSCRIBE']);
            $this->assertEquals($email->getQueueId(), (int) $node['QUEUEID']);
            $this->assertEquals($email->getTag(), (string) $node['TAG']);
            $this->assertEquals($email->getMaCategory(), (string) $node['MACATEGORY']);

            $target = $email->getTarget();
            $this->assertEquals($target->getListId(), (int) $node->TARGET['LISTID']);
            $this->assertEquals($target->getPriorityField(), (string) $node->TARGET['PRIORITY_FIELD']);
            $this->assertEquals($target->getPrioritySorting(), (string) $node->TARGET['PRIORITY_SORTING']);
            $this->assertEquals($target->getSegmentId(), (int) $node->TARGET['SEGMENTID']);
            $this->assertEquals($target->getConstraint(), (string) $node->TARGET['CONSTRAstring']);
            $this->assertEquals($target->getScopes(), (string) $node->TARGET['SCOPES']);

            $this->assertEquals($email->getContent()['HTML'], (string) $node->CONTENT->HTML);
            $this->assertEquals($email->getContent()['TEXT'], (string) $node->CONTENT->TEXT);
            $this->assertEquals($email->getContent()['FROM_ADDR'], (string) $node->CONTENT->FROM_ADDR);
            $this->assertEquals($email->getContent()['FROM_NAME'], (string) $node->CONTENT->FROM_NAME);
            $this->assertEquals($email->getContent()['TO_NAME'], (string) $node->CONTENT->TO_NAME);
            $this->assertEquals($email->getContent()['TO_ADDR'], (string) $node->CONTENT->TO_ADDR);
            $this->assertEquals($email->getContent()['REPLY_NAME'], (string) $node->CONTENT->REPLY_NAME);
            $this->assertEquals($email->getContent()['REPLY_ADDR'], (string) $node->CONTENT->REPLY_ADDR);
            $this->assertEquals($email->getContent()['SUBJECT'], (string) $node->CONTENT->SUBJECT);
        }
    }

    /**
     * @return Campaign
     */
    private function getCampaign()
    {
        $campaign = new Campaign();
        $campaign
            ->setName('DailY IT News 20090801')
            ->setFolderId(5)
            ->setState(Campaign::DESIGN)
            ->setStartDate(new \DateTime('tomorrow'))
            ->setDescription('My-Description')
            ->setMaCategory('Science')
            ->setProductId(1)
            ->setClashPlanId(0)
        ;

        $target = new Target();
        $target
            ->setListId(13)
            ->setPriorityField('CREATED_DT')
            ->setPrioritySorting('DESC')
            ->setSegmentid(2)
            ->setConstraint('')
            ->setScopes(['foo', 'bar'])
        ;

        $email = new Email();
        $email
            ->setName('DailY IT News 20090801')
            ->setFolderId(5)
            ->setMailDomainId(1)
            ->listUnsubscribe(true)
            ->setQueueId(1)
            ->setTag('')
            ->setMaCategory('Science')
            ->setTarget($target)
            ->setContent([
                'HTML' => 'du html ici',
                'TEXT' => 'du texte là',
                'FROM_ADDR' => 'demo@emsecure.net',
                'FROM_NAME' => 'SIM Training',
                'TO_ADDR' => '~MAIL~',
                'TO_NAME' => '~NAME~',
                'REPLY_ADDR' => 'noreply@emsecure.net',
                'REPLY_NAME' => 'SIM Training',
                'SUBJECT' => 'Daily IT News - Optus survey finds iPhone 3G getting strong traction in the enterprise, Asus Eee PC T91 Tablet PC, ...',
            ])
        ;
        $campaign->addEmail($email);

        return $campaign;
    }
}
