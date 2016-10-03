<?php

namespace Mediapart\Selligent;

use PHPUnit\Framework\TestCase;

/**
 *
 */
class RealTest extends TestCase
{
    /**
     * @return \SoapClient A client to Selligent's API
     */
    public function getClient()
    {
        $con = new Connection(
            getenv('soap_login'),
            getenv('soap_password')
        );

        return $con->open(getenv('soap_wsdl'));
    }

    /**
     * @param SoapClient $client
     * @param $user_id
     * @param $list_id 
     */
    public function assertUserId(\SoapClient $client, $user_id, $list_id = null)
    {
        $list_id = is_null($list_id) ? getenv('selligent_listid') : $list_id;

        $response = $client->GetUserById([
            'List' => $list_id,
            'UserID' => $user_id,
        ]);

        $response->ResultSet;
    }

    /**
     *
     */
    public function testStatus()
    {
        $client = $this->getCLient();
        $response = $client->GetSystemStatus();

        $this->assertInstanceOf('Mediapart\Selligent\Response\GetSystemStatusResponse', $response);
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertEquals('OK', $response->getStatus());
        $this->assertEquals('v6.2', substr($response->getVersion(), 0, 4));
    }

    /**
     *
     */
    public function testCountUsersByConstraint()
    {
        $client = $this->getClient();
        $list_id = getenv('selligent_listid');

        $response = $client->CountUsersByConstraint([
            'List' => $list_id,
            'Constraint' => '',
        ]);

        $this->assertInstanceOf('Mediapart\Selligent\Response\CountUsersByConstraintResponse', $response);
        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertEquals(5, $response->getUserCount());
    }

    /**
     * Retrieves existingg remotes lists
     */
    public function testGetLists()
    {
        $client = $this->getCLient();
        $response = $client->getLists();

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertEquals('', $response->getError());
    }

    /**
     *
     */
    public function testListUsers()
    {
        $client = $this->getClient();
        $list_id = getenv('selligent_listid');

        $response = $client->GetUsersByConstraint([
            'List' => $list_id,
            'Constraint' => "NAME LIKE '%thomas%'",
            'MaxCount' => 5,
        ]);

        if (Response::SUCCESSFUL === $response->getCode()) {
            foreach ($response->getIds() as $user_id) {
                $this->assertUserId($client, $user_id, $list_id);
            }
        }
    }
}
