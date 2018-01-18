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

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;

/**
 *
 */
class Connection implements LoggerAwareInterface
{
    /**
     * @var string
     */
    const CLASS_SOAPCLIENT = 'SoapClient';

    /**
     * @var string
     */
    const CLASS_SOAPHEADER = 'SoapHeader';

    /**
     * @var string
     */
    const API_INDIVIDUAL = 'individual.yml';

    /**
     * @var string
     */
    const API_BROADCAST = 'broadcast.yml';

    /**
     * @var ReflectionClass
     */
    private $client;

    /**
     * @var ReflectionClass
     */
    private $header;

    /**
     * @var Array
     */
    private $options = [];

    /**
     * @var LoggerInterface
     */
    private $logger = null;

    /**
     * @param string $client
     * @param string $header
     *
     * @throws InvalidArgumentException
     */
    public function __construct($client = 'SoapClient', $header = 'SoapHeader')
    {
        $load = function($class, $expected) {
            $result = new \ReflectionClass($class);
            if ($class != $expected && !$result->isSubclassOf($expected)) {
                throw new \InvalidArgumentException(sprintf(
                    "%s is not an instance of %s",
                    $class, $expected
                ));
            }
            return $result;
        };

        $this->client = $load($client, self::CLASS_SOAPCLIENT);
        $this->header = $load($header, self::CLASS_SOAPHEADER);
    }

    /**
     * {@inheritDoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    /**
     * @param array $parameters
     * @param string $config
     *
     * @return \SoapClient
     */
    public function open(array $parameters = [], $config = 'individual.yml', array $options = [])
    {
        $processor = new Processor();
        $configuration = $processor->processConfiguration(
            new Configuration(),
            [
                Yaml::parse(file_get_contents(__DIR__.'/../config/'.$config)),
                $parameters
            ]
        );

        if ($this->logger) {
            $this->logger->debug(sprintf('connecting to %s', $configuration['wsdl']));
        }

        $client = $this
            ->client
            ->newInstance($configuration['wsdl'], array_merge($options, $configuration['options']))
        ;
        $client->__setSoapHeaders(
            $this->header->newInstance(
                $configuration['namespace'],
                'AutomationAuthHeader',
                [
                    'Login' => $configuration['login'],
                    'Password' => $configuration['password'],
                ]
            )
        );

        return $client;
    }
}
