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
use Mediapart\Selligent\Request\CreateCampaign;
use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Broadcast\Email;
use Mediapart\Selligent\Broadcast\Target;

/**
 *
 */
class XMLTest extends TestCase
{
	public function testXML()
	{
		$start_date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
		$start_date->modify('+3 minutes');

	    $campaign = new Campaign();
	    $campaign
	        ->setName('CAMPAIGN_NAME')
	        ->setFolderId(42)
	        ->setState(Campaign::ACTIVE)
	        ->setStartDate($start_date)
	        ->setDescription("campaign_desc")
	        ->setMaCategory('CAMPAIGN_MACATEGORY')
	        ->setProductId(1)
	        ->setClashPlanId(0)
	    ;

	    $target = new Target();
	    $target
	        ->setListId(2)
	        ->setPriorityField('CREATED_DT')
	        ->setPrioritySorting('DESC')
	        ->setSegmentid(42)
	    ;

	    $email = new Email();
	    $email
	        ->setName($start_date->format('Ymd'))
	        ->setFolderId(42)
	        ->setMailDomainId(2)
	        ->listUnsubscribe(true)
	        ->setQueueId(2)
	        ->setTarget($target)
	        ->setHyperlinksToSensors(true)
	        ->setContent([
	            'HTML' => "<p>Lorem ipsum</p>",
	            'TEXT' => "Lorem ipsum",
	            'FROM_ADDR' => "email@domain.tld",
	            'FROM_NAME' => "dolor sit amet",
	            'TO_ADDR' => '~MAIL~',
	            'TO_NAME' => '~NAME~',
	            'REPLY_ADDR' => "email@domain.tld",
	            'REPLY_NAME' => "dolor sit amet",
	            'SUBJECT' => "Loremp ipsum dolor sit amet",
	    ]);

	    $campaign->addEmail($email);

        $client = $this
            ->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $request = new CreateCampaign(new \XMLWriter());
        $xml = $request->basedOn($campaign);

		//print($xml);exit;
	}
}
