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
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

    public function testConfigurationKO()
    {
        $this->setExpectedException('\Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');
        $configFile = file_get_contents(__DIR__.'/test_config_ko.yaml');

        $cfg = new Configuration();
        $cfg->loadConfig($configFile);
        
    }

    public function testCheckReturnedConfig()
    {
        $configFile = file_get_contents(__DIR__.'/test_config_ok.yaml');
        $cfg = new Configuration();
        $config = $cfg->loadConfig($configFile);
        $fixture = ['login' => 'MY_LOGIN', 'namespace' => "http://tempuri.org/"];
        $this->assertEquals($fixture['login'], $config['login']);
        $this->assertEquals($fixture['namespace'], $config['namespace']);
    }
}