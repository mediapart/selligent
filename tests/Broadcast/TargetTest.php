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
use Mediapart\Selligent\Broadcast\Target;

class TargetTest extends TestCase
{
    public function testSetPrioritySortingWithException()
    {
        $target = new Target();

        $this->expectException(\InvalidArgumentException::class);

        $target->setPrioritySorting('lorem');
    }
}
