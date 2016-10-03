# Selligent Soap API Client

## Installation

## Example

```php

use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Response;
use Mediapart\Selligent\List;
use Mediapart\Selligent\Property;
use Mediapart\Selligent\ArrayOfProperty;


$connection = new Connection($login, $password);
$client = $connection->open(Connection::INDIVIDUAL);


/* output lists infos */
$response = $client->GetLists();

if (Response::SUCCESSFUL === $response->getCode()) {
    foreach ($response->lists as $list) {
        printf(
            "#%d \t%s - %s\n",
            $list->getId(),
            $list->getName(),
            $list->getDescription()
        );
    }
}


/* register a new user */
$user = new ArrayOfProperty();
$user[] = new Property('NAME', 'Thomas Gasc');
$user[] = new Property('MAIL', 'thomas@gasc.fr');

$response = $client->CreateUser([
    'List' => $list->getId(),
    'Changes' => $user,
]);

if (Response::SUCCESSFUL === $response->getCode()) {
    $user_id = $response->ID;
    printf("saved with id=%d\n", $user_id);
}


/* update user info */
$updatedUser = new ArrayOfProperty();
$updatedUser[] = new Property('NAME', 'Thomas Gasc Test');
$updatedUser[] = new Property('MAIL', 'thomas+test@gasc.fr');

$response = $client->UpdateUser([
    'List' => $list->getId(),
    'UserID' => $user_id,
    'Changes' => $updatedUser,
]);

if (Response::SUCCESSFUL === $response->getCode()) {
    printf("%d updated\n", $user_id);
}
```

## Reference

### GetStatus

Provides information about the current status of the system.

```php
<?php

$SystemStatusResponse = $client->GetSystemStatus();

print $SystemStatusResponse->getStatus(); // OK
print $SystemStatusResponse->getVersion(); // v6.2.5.1

```

### CountUserByConstraint

Count the number of contacts based on a filter.

```php
<?php

$CountUserByConstraintResponse = $client->CountUsersByConstraint([

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Constraint applied to the contact’s selection. 
       The constraint corresponds to the sql WHERE statement */
    'Constraint' => '',

]);

if (Response::SUCCESSFUL === $CountUserByConstraintResponse->getCode()) {
    print $CountUserByConstraintResponse->getUserCount(); // 5
}

```

