# Selligent Soap API Client

## Installation

```
composer require mediapart/selligent
```

## Test

Executing default test suite :

```
/vendor/bin/phpunit --configuration phpunit.xml.dist --testsuite default
```

## Test by connecting to a custom server

With the `real` testsuite, you could execute a serie of test who will be applied to a given host. Some environment variables are required to execute RealTestSuite :

- soap_login
- soap_password
- soap_wsdl
- selligent_listid


## Read More

- Illustrated [Reference](doc/Reference.md) of all available API endpoints.
- Little use case [Example](doc/Example.md) from connection to triggering campaign
