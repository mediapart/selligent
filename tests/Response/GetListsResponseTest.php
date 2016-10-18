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
class GetListsResponseTest extends TestCase
{
    /**
     *
     */
    public function testResponse()
    {
        $response = new GetListsResponse();

        $this->assertEquals(Response::ERROR_NORESULT, $response->getCode());
        $this->assertCount(0, $response->getLists());
    }
}
