<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Broadcast;

/**
 *
 */
class TargetTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPrioritySortingWithException()
    {
        $target = new Target();

        $this->setExpectedException(\InvalidArgumentException::class);

        $target->setPrioritySorting('lorem');
    }
}
