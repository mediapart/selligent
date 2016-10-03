<?php

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
            'GetSystemStatusResponse' => 'Mediapart\Selligent\Response\GetSystemStatusResponse',
            'GetListsResponse' => 'Mediapart\Selligent\Response\GetListsResponse',
            'GetUsersByConstraintResponse' => 'Mediapart\Selligent\Response\GetUsersByConstraintResponse',
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
