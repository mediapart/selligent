<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests\Response;

use PHPUnit\Framework\TestCase;
use Mediapart\Selligent\Response;
use Mediapart\Selligent\Response\CreateCampaignResponse;

class CreateCampaignResponseTest extends TestCase
{
    public function testResponse()
    {
        $response = new CreateCampaignResponse();

        $this->assertEquals('', $response->getXml());
        $this->assertEquals(Response::ERROR_NORESULT, $response->getCode());
    }

    public function testResponseWithWarning()
    {
        $class = 'Mediapart\Selligent\Response\CreateCampaignResponse';
        $response = new CreateCampaignResponse();

        $property = new \ReflectionProperty($class, 'ErrorStr');
        $property->setAccessible(true);
        $property->setValue($response, 'Lorem');
        $property = new \ReflectionProperty($class, 'CreateCampaignResult');
        $property->setAccessible(true);
        $property->setValue($response, Response::SUCCESSFUL);

        $this->assertEquals(CreateCampaignResponse::WARNING, $response->getCode());
    }
}
