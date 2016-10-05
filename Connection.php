<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * (c) mediapart <https://github.com/mediapart/selligent>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

/**
 *
 */
class Connection
{
    private $login;
    private $password;
    private $options;

    /**
     *
     */
    public function __construct($login, $password, $options = array())
    {
        $this->login = $login;
        $this->password = $password;
        $this->options = $options;

        $this->options['classmap'] = [
            'Property' => 'Mediapart\Selligent\Property',
            'ArrayOfProperty' => 'Mediapart\Selligent\Properties',

            'ListInfo' => 'Mediapart\Selligent\ListInfo',

            'GetSystemStatusResponse' => 'Mediapart\Selligent\Response\GetSystemStatusResponse',
            'CountUsersByConstraintResponse' => 'Mediapart\Selligent\Response\CountUsersByConstraintResponse',
            'CreateUserResponse' => 'Mediapart\Selligent\Response\CreateUserResponse',
            'GetUserByIDResponse' => 'Mediapart\Selligent\Response\GetUserByIDResponse',
            'GetListsResponse' => 'Mediapart\Selligent\Response\GetListsResponse',
            'GetUsersByConstraintResponse' => 'Mediapart\Selligent\Response\GetUsersByConstraintResponse',
            'GetUserByFilterResponse' => 'Mediapart\Selligent\Response\GetUserByFilterResponse',
            'TriggerCampaignResponse' => 'Mediapart\Selligent\Response\TriggerCampaignResponse',
            'TriggerCampaignWithResultResponse' => 'Mediapart\Selligent\Response\TriggerCampaignWithResultResponse',
        ];
    }

    /**
     *
     */
    public function open($WSDL, $namespace = 'http://tempuri.org/')
    {
        $client = new \SoapClient($WSDL, $this->options);

        $header = new \SoapHeader(
            $namespace,
            'AutomationAuthHeader',
            [
                'Login' => $this->login,
                'Password' => $this->password,
            ]
        );
        $client->__setSoapHeaders($header);

        return $client;
    }
}
