# Example

```php
<?php

use Mediapart\Selligent\Connection;
use Mediapart\Selligent\Response;
use Mediapart\Selligent\List;
use Mediapart\Selligent\Property;
use Mediapart\Selligent\ArrayOfProperty;


$connection = new Connection();
$client = $connection->open($login, $password, $wsdl);


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