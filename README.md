# Selligent Soap API Client

## Installation

```bash
composer require mediapart/selligent
```

```php
<?php

use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Transport;

$config = [
    'login' => '******',
    'password' => '******',
    'wsdl' => '',
    'list_id' => 1,
    'gate_name' => 'TESTGATE',
];

$connection = new Connection();
$client = $connection->open(
    $config['login'],
    $config['password'],
    $config['wsdl']
);

try {
    $transport = new Transport($client);
    $result = $transport
        ->setList($config['list_id'])
        ->subscribe($user)
        ->setCampaign($config['gate_name'])
        ->triggerCampaign(
            $inputData,
            Selligent::TRIGGER & Selligent::WITH_RESULT
        )
    ;
} catch (Exception $e) {

}
```

## Test

Executing `default` test suite :

```bash
./vendor/bin/phpunit --configuration phpunit.xml.dist --testsuite default
```

### Test by connecting to a Soap server

With the `real` testsuite, you could execute a serie of test who will be applied to a given host. Some environment variables are required to execute RealTestSuite :

- soap_login
- soap_password
- soap_wsdl
- selligent_listid


## Read More

- Illustrated [Reference](doc/Reference.md) of all available API endpoints.
- Little use case [Example](doc/Example.md) from connection to triggering campaign
