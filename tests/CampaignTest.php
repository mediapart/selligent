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
class CampaignTest extends \PHPUnit_Framework_TestCase
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
        $user_id = null;

        $user = new Properties();
        $user['NAME'] = 'Thomas G.';
        $user['MAIL'] = 'thomas.gasc+test@mediapart.fr';

        // check the connection
        $response = $client->GetSystemStatus();
        $this->assertEquals('OK', $response->getStatus());
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());

        // check the list
        $response = $client->GetLists();
        $available_lists = [];
        foreach ($response->getLists() as $list) {
            $available_lists[$list->ID] = $list->Name;
        }
        $this->assertTrue(array_key_exists($list_id, $available_lists));

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
        elseif (Response::SUCCESSFUL === $response->getCode()) {
            $user_id = $response->getProperties()['ID']->getValue();
        }

        // should have an user id to trigger the campaign
        $this->assertNotNull($user_id);

        // trigger the campaign
        $data = new Properties();
        $data['ID'] = $user_id;
        $data['TRANSAC.PRENOM_ACHETEUR'] = "prenom_acheteur";
        $data['TRANSAC.NOM_ACHETEUR'] = "nom_acheteur";
        $data['TRANSAC.PRENOM'] = "prenom";
        $data['TRANSAC.NOM'] = "nom";
        $data['TRANSAC.MESSAGE'] = "message";
        $data['TRANSAC.DOMAINE'] = "domaine";
        $data['TRANSAC.LINK'] = "link";
        $data['TRANSAC.IDABONNEMENT'] = "idabonnement";
        $data['TRANSAC.EMAIL'] = "email";
        $data['TRANSAC.EMAIL_ACHETEUR'] = "email_acheteur";

        $response = $client->TriggerCampaignWithResult([
            'List' => $list_id,
            'UserID' => $user_id,
            'GateName' => $gate_name,
            'InputData' => $data,
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertEquals('[OK]', $response->getResult());
    }
}
