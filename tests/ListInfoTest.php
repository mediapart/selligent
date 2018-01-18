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
use Mediapart\Selligent\ListInfo;

class ListInfoTest extends TestCase
{
    public function testSimple()
    {
        $id = 42;
        $name = 'LISTNAME';
        $description = 'Lorem ipsum dolor';
        $type = 'LIST';
        $tag = 'foobar';
        $now = new \DateTime();

        $list = new ListInfo($id, $name, $description, $type, $tag);

        $this->assertEquals($now, $list->getCreatedDate());
        $this->assertEquals(null, $list->getModifiedDate());

        $this->assertEquals($id, $list->getId());
        $this->assertEquals($name, $list->getName());
        $this->assertEquals($description, $list->getDescription());
        $this->assertEquals($type, $list->getType());
        $this->assertEquals($tag, $list->getTag());
    }

    /**
     * Never write a test like this at home.
     * This is a very special case due to SoapClient.
     */
    public function testWtf()
    {
        $tomorrow = new \DateTime('tomorrow');
        $list = new ListInfo(42);

        /* change property visibility during a test is bad. */
        $reflec = new \ReflectionObject($list);
        $prop = $reflec->getProperty('ModifiedDate');
        $prop->setAccessible(true);
        $prop->setValue($list, $tomorrow->format($list::$datetime_format));

        $this->assertEquals($tomorrow, $list->getModifiedDate());
    }
}
