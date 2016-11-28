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
class RealTest extends \PHPUnit_Framework_TestCase
{
    const API_VERSION = 'v6.3';

    /**
     * @var \SoapClient
     */
    protected $client;

    /**
     * @var integer
     */
    protected $listId;

    /**
     * @var string
     */
    protected $gateName;

    /**
     *
     */
    public function __construct()
    {
        $config = [
          'selligent' => [
            'login' => getenv('soap_login'),
            'password' => getenv('soap_password'),
            'wsdl' => getenv('soap_wsdl'),
            'namespace' => 'http://tempuri.org/',
            'list' =>   getenv('selligent_list'),
            'options' => [
              'classmap' => [
                'CountUsersByConstraint' => ''
              ]
            ]
          ]
        ];

        $con = new Connection();
        $this->client = $con->open($config['selligent']);

        $response = $this
            ->client
            ->getListID([
                'name' => $config['selligent']['list'],
            ])
        ;

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());

        $this->listId = $response->getId();
        $this->gateName = getenv('selligent_gate');
    }

    /**
     * Assert that the $userId exists in Selligent database
     *
     * @param integer $userId
     */
    public function assertUserId($userId)
    {
        $response = $this->client->GetUserById([
            'List' => $this->listId,
            'UserID' => $userId,
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertInstanceOf('Mediapart\Selligent\Properties', $response->getProperties());
    }

    /**
     * Check the system status and version
     */
    public function testStatus()
    {
        $response = $this->client->GetSystemStatus();

        $this->assertEquals('OK', $response->getStatus());
        $this->assertEquals(self::API_VERSION, substr($response->getVersion(), 0, 4));
    }

    /**
     *
     */
    public function testCountUsersByConstraint()
    {
        $response = $this->client->CountUsersByConstraint([
            'List' => $this->listId,
            'Constraint' => "NAME LIKE '%thomas%'",
        ]);

        $this->assertGreaterThanOrEqual(1, $response->getUserCount());
    }

    /**
     * Retrieves existingg remotes lists
     */
    public function testGetLists()
    {
        $response = $this->client->getLists();

        $this->assertGreaterThanOrEqual(1, count($response->getLists()));
    }

    /**
     *
     */
    public function testListUsers()
    {
        $response = $this->client->GetUsersByConstraint([
            'List' => $this->listId,
            'Constraint' => "NAME LIKE '%thomas%'",
            'MaxCount' => 5,
        ]);

        if (Response::SUCCESSFUL === $response->getCode()) {
            foreach ($response->getIds() as $userId) {
                $this->assertUserId($userId);
            }
        }
    }

    /**
     *
     */
    public function testRetrievesUserHash()
    {        
        $response = $this->client->RetrieveHashForUser([
            'GateName' => $this->gateName,
            'List' => $this->listId,
            'UserID' => 1,
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
        $this->assertNotNull($response->getHashCode());
    }

    /**
     *
     */
    public function testTriggerCampaign()
    {
        $response = $this->client->triggerCampaign([
            'GateName' => $this->gateName,
            'InputData' => new Properties(),
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }

    /**
     *
     */
    public function testTriggerCampaignWithResult()
    {
        $response = $this->client->triggerCampaignWithResult([
            'GateName' => $this->gateName,
            'InputData' => new Properties(),
        ]);

        $this->assertNotNull($response->getResult());
    }

    /**
     *
     */
    public function testTriggerCampaignForUser()
    {
        $response = $this->client->triggerCampaignForUser([
            'List' => $this->listId,
            'UserID' => 10,
            'GateName' => $this->gateName,
            'InputData' => new Properties(),
        ]);

        $this->assertEquals(Response::SUCCESSFUL, $response->getCode());
    }

    /**
     *
     */
    public function testTriggerCampaignForUserWithResult()
    {
        $response = $this->client->triggerCampaignForUserWithResult([
            'List' => $this->listId,
            'UserID' => 10,
            'GateName' => $this->gateName,
            'InputData' => new Properties(),
        ]);

        $this->assertNotNull($response->getResult());
    }
}
