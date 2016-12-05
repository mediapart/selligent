# Selligent Soap API Client

[![Build Status](https://secure.travis-ci.org/mediapart/selligent.svg?branch=master)](http://travis-ci.org/mediapart/selligent) [![Code Coverage](https://codecov.io/gh/mediapart/selligent/branch/master/graph/badge.svg)](https://scrutinizer-ci.com/g/mediapart/selligent) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/mediapart/selligent/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mediapart/selligent) [![Total Downloads](https://poser.pugx.org/mediapart/selligent/downloads.png)](https://packagist.org/packages/mediapart/selligent) [![Latest Stable Version](https://poser.pugx.org/mediapart/selligent/v/stable.png)](https://packagist.org/packages/mediapart/selligent)


## Usage

```php
<?php # example.php

require './vendor/autoload.php';

use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Transport;
use Mediapart\Selligent\Properties;


/* connect you to your Selligent API server */
$connection = new Connection();
$client = $connection->open([
    'login' => '*****',
    'password' => '*****',
    'wsdl' => 'http://emsecure/individual?wsdl', 
]);

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
- soap_wsdl_individual
- soap_wsdl_broadcast
- selligent_list
- selligent_gate
- selligent_folderid 
- selligent_maildomainid 
- selligent_listid 
- selligent_segmentid 
- selligent_queueid 
- selligent_macategory 


## Read More

- Illustrated [Reference](doc/Reference/Readme.md) of all available API endpoints.
- Little use case [Example](doc/Example.md) from connection to triggering campaign
- You could use PSR3 to [log informations from this library](doc/Logging.md).
- You could [broadcast campaign based on complete HTML](doc/Broadcast.md) from the API.
