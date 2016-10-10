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

use PHPUnit\Framework\TestCase;

/**
 *
 */
class CampaignTest extends TestCase
{
    /**
     * @return \SoapClient A client to Selligent's API
     */
    public function getClient()
    {
        $con = new Connection();

        return $con->open(
            getenv('soap_login'),
            getenv('soap_password'),
            getenv('soap_wsdl')
        );
    }

    /**
     *
     */
    public function testCampaign()
    {
        $list_id = getenv('selligent_listid');
        $gate_name = getenv('selligent_gate');
        $client = $this->getCLient();

        $user = new Properties();
        $user['NAME'] = 'Thomas Test G.';
        $user['MAIL'] = 'thomas.gasc+test@mediapart.fr';

        // check the connection
        $response = $client->GetSystemStatus();
        $this->assertEquals('OK', $response->getStatus());
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());

        // check if the user already exists
        $response = $client->GetUserByFilter([
            'List' => $list_id,
            'Filter' => $user,
        ]);

        // if the user do not already exists, we create it
        if (Response::ERROR_NORESULT === $response->getCode()) {
            $response = $client->CreateUser([
                'List' => $list_id,
                'Changes' => $user,
            ]);
            $user_id = $response->getUserId();
        }

        // retrieves the user id
        if (Response::SUCCESSFUL !== $response) {
            $user_id = $response->getProperties()['ID']->getValue();
        }

        // should have an user id to trigger the campaign
        $this->assertNotNull($user_id);

        // trigger the campaign
        $data = new Properties();
        $data['ID_UTILISATEUR'] = $user_id;

        $response = $client->TriggerCampaign([
            'List' => $list_id,
            'UserID' => $user_id,
            'GateName' => $gate_name,
            'InputData' => $data,
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }
}
