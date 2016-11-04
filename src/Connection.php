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
class Connection
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
     *
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

        $this->options['classmap'] = [

            'ArrayOfListInfo' => 'Mediapart\Selligent\ArrayOfListInfo',
            'ListInfo' => 'Mediapart\Selligent\ListInfo',
            'Property' => 'Mediapart\Selligent\Property',
            'ArrayOfProperty' => 'Mediapart\Selligent\Properties',

            # System info
            'GetSystemStatusResponse' => 'Mediapart\Selligent\Response\GetSystemStatusResponse',

            # Manage Lists
            'GetListsResponse' => 'Mediapart\Selligent\Response\GetListsResponse',
            'GetListIDResponse' => 'Mediapart\Selligent\Response\GetListIDResponse',

            # Manage Segments
            'CreateSegmentResponse' => 'Mediapart\Selligent\Response\CreateSegmentResponse',
            'AddToSegmentResponse' => 'Mediapart\Selligent\Response\AddToSegmentResponse',
            'GetSegmentsResponse' => 'Mediapart\Selligent\Response\GetSegmentsResponse',
            'GetSegmentRecordCountResponse' => 'Mediapart\Selligent\Response\GetSegmentRecordCountResponse',

            # Manage Users
            'CreateUserResponse' => 'Mediapart\Selligent\Response\CreateUserResponse',
            'UpdateUserResponse' => 'Mediapart\Selligent\Response\UpdateUserResponse',
            'GetUserByIDResponse' => 'Mediapart\Selligent\Response\GetUserByIDResponse',
            
            'CountUsersByConstraintResponse' => 'Mediapart\Selligent\Response\CountUsersByConstraintResponse',
            'GetUsersByConstraintResponse' => 'Mediapart\Selligent\Response\GetUsersByConstraintResponse',
            'GetUserByFilterResponse' => 'Mediapart\Selligent\Response\GetUserByFilterResponse',

            # Manage Campaign
            'TriggerCampaignResponse' => 'Mediapart\Selligent\Response\TriggerCampaignResponse',
            'TriggerCampaignWithResultResponse' => 'Mediapart\Selligent\Response\TriggerCampaignWithResultResponse',
            'TriggerCampaignForUserResponse' => 'Mediapart\Selligent\Response\TriggerCampaignForUserResponse',
            'TriggerCampaignForUserWithResultResponse' => 'Mediapart\Selligent\Response\TriggerCampaignForUserWithResultResponse',

        ];
    }

    /**
     *
     * @var string $login
     * @var string $password
     * @var string $wsdl
     * @var string $namespace
     *
     * @return SoapClient
     */
    public function open($login, $password, $wsdl, $namespace = 'http://tempuri.org/')
    {
        $client = $this
            ->client
            ->newInstance($wsdl, $this->options)
        ;

        $client->__setSoapHeaders(
            $this->header->newInstance(
                $namespace,
                'AutomationAuthHeader',
                [
                    'Login' => $login,
                    'Password' => $password,
                ]
            )
        );

        return $client;
    }
}
