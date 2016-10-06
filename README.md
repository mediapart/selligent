# Selligent Soap API Client

## Installation

```bash
composer require mediapart/selligent
```

```php
<?php

use Mediapart\Selligent\Connection;

$connection = new Connection();
$client = $connection->open($login, $password, $wsdl);

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
