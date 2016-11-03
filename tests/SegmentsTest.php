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

/**
 *
 */
class SegmentsTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testEmptyCollection()
    {
        $segments = new ArrayOfSegmentInfo();

        $this->assertCount(0, $segments);
    }

    /**
     *
     */
    public function testSegmentInfo()
    {
        $segment = new SegmentInfo();

        $this->assertNull($segment->getId());
        $this->assertNull($segment->getName());
        $this->assertNull($segment->getType());
        $this->assertNull($segment->getDescription());
    }
}
