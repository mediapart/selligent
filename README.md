# Selligent Soap API Client

[![Build Status](https://secure.travis-ci.org/mediapart/selligent.svg?branch=master)](http://travis-ci.org/mediapart/selligent) [![Code Coverage](https://codecov.io/gh/mediapart/selligent/branch/master/graph/badge.svg)](https://scrutinizer-ci.com/g/mediapart/selligent) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/mediapart/selligent/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mediapart/selligent) [![Total Downloads](https://poser.pugx.org/mediapart/selligent/downloads.png)](https://packagist.org/packages/mediapart/selligent) [![Latest Stable Version](https://poser.pugx.org/mediapart/selligent/v/stable.png)](https://packagist.org/packages/mediapart/selligent)

A simple PHP library to help you interact with both Selligent Individual and Broadcast API.


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

You could [broadcast campaign based on complete HTML](doc/Broadcast.md) from the API.


## Installation

Simply install this package with [Composer](http://getcomposer.org/).

```bash
composer require mediapart/selligent
```


## Tests

Executing tests out of the box :

```bash
./vendor/bin/phpunit
```

Without setting [some environment variables](./doc/Tests.md), some tests will be skipped. Tests in `real` testsuite for example.


## Read More

- Illustrated [Reference](doc/Reference/Readme.md) of all available API endpoints ;
- Little use case [Example](doc/Example.md) from connection to triggering campaign ;
- You could use PSR3 to [log informations from this library](doc/Logging.md).
