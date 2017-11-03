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

class HyperlinkToSensorsTest extends TestCase
{
    public function testEmailAttribute()
    {
        $email = new Email();

        $email->setHyperlinksToSensors(true);

        $this->assertTrue($email->hasHyperlinksToSensors());
    }

    public function testCreateCampaign()
    {
        $campaign = new Campaign();
        $target = new Target();
        $email = new Email();
        $email
            ->setTarget($target)
            ->setHyperlinksToSensors(true)
        ;
        $campaign->addEmail($email);

        $writer = new XMLWriter();
        $request = new CreateCampaign($writer);
        $xml = $request->basedOn($campaign);

        $document = simplexml_load_string($xml);
        $this->assertEquals(1, (int) $document->EMAILS->EMAIL[0]->CONTENT->attributes()->HYPERLINKS_TO_SENSORS);
    }
}
