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
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Mediapart\Selligent\Configuration;

class ConfigurationTest extends TestCase
{
    public function testConfiguration()
    {
        $config = [
            'login' => 'login',
            'password' => 'password',
            'wsdl' => 'http//wsdl?individual',
        ];
        $processor = new Processor();
        $configuration = new Configuration();

        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            [$config]
        );

        $this->assertEquals('login', $processedConfiguration['login']);
        $this->assertEquals('password', $processedConfiguration['password']);
        $this->assertEquals('http://tempuri.org/', $processedConfiguration['namespace']);
    }
}
