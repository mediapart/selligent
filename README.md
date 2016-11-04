# Selligent Soap API Client

[![Build Status](https://secure.travis-ci.org/mediapart/selligent.svg?branch=master)](http://travis-ci.org/mediapart/selligent) [![Total Downloads](https://poser.pugx.org/mediapart/selligent/downloads.png)](https://packagist.org/packages/mediapart/selligent) [![Latest Stable Version](https://poser.pugx.org/mediapart/selligent/v/stable.png)](https://packagist.org/packages/mediapart/selligent)


## Usage

```php
<?php # example.php

require './vendor/autoload.php';

use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Transport;
use Mediapart\Selligent\Properties;

/* define your API credentials */
$config = [
    'login' => '******',
    'password' => '******',
    'wsdl' => 'http://emsecure/?wsdl',
    'list' => 'TESTLIST',
    'campaign' => 'TESTGATE',
];

/* connect you to your Selligent API server */
$connection = new Connection();
$client = $connection->open(
    $config['login'],
    $config['password'],
    $config['wsdl']
);

/*
    Example : Trigger the TESTGATE campaign to an user.
    We will register the user first an then, we will trigger
    the campaign with a custom message :
 */
try {

    $transport = new Transport($client);

    $user = new Properties();
    $user['NAME'] = 'Foo Bar';
    $user['MAIL'] = 'foo@bar.tld';

    $userId = $transport
        ->setList($config['list'])
        ->subscribe($user)
    ;

    $inputData = new Properties();
    $inputData['MESSAGE'] = 'Lorem ipsum dolor sit amet conceptuem.';

    $result = $transport
        ->setCampaign($config['campaign'])
        ->triggerCampaign($userId, $inputData)
    ;

} catch (\Exception $e) {
    echo 'something bad happens.';
}
```


## Installation

Simply install this package with [Composer](http://getcomposer.org/).

```bash
composer require mediapart/selligent
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
