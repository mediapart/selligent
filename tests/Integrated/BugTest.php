<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Tests\Integrated;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Response;
use Mediapart\Selligent\Properties;
use Mediapart\Selligent\Configuration;
use Mediapart\Selligent\Transport;
use Mediapart\Selligent\Tests\Integrated\IntegrationTestCase;

/**
 *
 */
class BugTest extends IntegrationTestCase
{
    /**
     *
     */
    public function testTriggerCampaignForUserWithResult()
    {   
        $con = new Connection();
        $client = $con->open(
            [
                'login' => getenv('soap_login'),
                'password' => getenv('soap_password'),
                'wsdl' => getenv('soap_wsdl_individual'),
                'options' => [
                    'trace' => true,
                ],
            ],
            Connection::API_INDIVIDUAL
        );

        $user = new Properties();
        $user["MAIL"] = "thomas.gasc@mediapart.fr";

        $transport = new Transport($client, getenv('selligent_list'), getenv('selligent_gate'));

        $userId = $transport->subscribe($user);

        $inputData = new Properties();
        $inputData['ID'] = $userId;
        $inputData['TRANSAC.PRENOM'] = "Thomas";
        $inputData['TRANSAC.NOM'] = "Gasc";
        $inputData['TRANSAC.EMAIL'] = "thomas.gasc@mediapart.fr";
        /* info sur l'acheteur */
        $inputData['TRANSAC.PRENOM_ACHETEUR'] = "Thomas";
        $inputData['TRANSAC.NOM_ACHETEUR'] = "Gasc";
        $inputData['TRANSAC.EMAIL_ACHETEUR'] = "thomas.gasc+acheteur@mediapart.fr";
        /* autres variables incluses dans le mail */
        $inputData['TRANSAC.MESSAGE'] = 'Cadeau de "Noel"';
        $inputData['TRANSAC.DOMAINE'] = "mediapart.dev";
        $inputData['TRANSAC.LINK'] = "localhost";
        $inputData['TRANSAC.IDABONNEMENT'] = "42";


        $response = $transport->triggerCampaign($userId, $inputData);

        echo $client->__getLastRequest();
        exit;
        $this->assertEquals('', $client->__getLastRequest());
    }
}
