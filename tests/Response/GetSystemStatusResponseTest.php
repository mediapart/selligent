<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Response;

use PHPUnit\Framework\TestCase;
use Mediapart\Selligent\Response;

/**
 *
 */
class GetSystemStatusResponseTest extends TestCase
{
    /**
     *
     */
    public function testResponse()
    {
        $response = new GetSystemStatusResponse();

        $this->assertEquals('error', $response->getStatus());
        $this->assertEquals('unknown', $response->getVersion());
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }
}
