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
use Mediapart\Selligent\Property;
use Mediapart\Selligent\Properties;

class PropertiesTest extends TestCase
{
    public function testSimple()
    {
        $tested_properties = [
            'NAME' => 'thomas',
            'EMAIL' => 'thomas.gasc+test@mediapart.fr',
        ];

        $properties = new Properties();

        foreach ($tested_properties as $key => $value) {
            $properties[$key] = $value;
        }

        foreach ($properties as $property) {
            $this->assertInstanceOf('Mediapart\Selligent\Property', $property);
            $this->assertTrue(isset($properties[$property->getKey()]));
            $this->assertEquals($tested_properties[$property->getKey()], $property->getValue());
        }

        unset($properties['EMAIL']);
        $this->assertFalse(isset($properties['EMAIL']));
        $this->assertNull($properties['EMAIL']);

        $properties['NAME'] = 'jacques';
        $this->assertEquals('jacques', $properties['NAME']);
    }

    public function testObject()
    {
        $properties = new Properties();
        $properties[] = new Property( 'NAME', 'thomas');
        $properties[] = new Property('EMAIL', 'thomas.gasc+test@mediapart.fr');

        $this->assertEquals('thomas', $properties['NAME']);
    }
}
