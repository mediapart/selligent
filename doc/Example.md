# Example

```php
<?php

namespace Mediapart\Selligent;

/* 
    Open a connection to Selligent.
 */
$connection = new Connection();
$client = $connection->open([
    'login' => '*****',
    'password' => '*****',
    'wsdl' => 'http://emsecure/individual?wsdl', 
]);

/* 
    Output lists infos.
 */
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


/* 
    Register a new user.
 */
$user = new Properties();
$user['NAME'] = 'Foo Bar';
$user['MAIL'] = 'foo@bar.tld';

$response = $client->CreateUser([
    'List' => $list->getId(),
    'Changes' => $user,
]);

if (Response::SUCCESSFUL === $response->getCode()) {
    $idUser = $response->getUserId();
    printf("saved with id=%d\n", $idUser);
}


/* 
    Update user info.
 */
$changes = new Properties();
$changes['NAME'] = 'Foo Bar';
$changes['MAIL'] = 'foo+test@bar.tld';

$response = $client->UpdateUser([
    'List' => $list->getId(),
    'UserID' => $idUser,
    'Changes' => $changes,
]);

if (Response::SUCCESSFUL === $response->getCode()) {
    printf("%d updated\n", $idUser);
}


/* 
    Trigger a campaign TESTGATE to $idUser with a 
    custom var MESSAGE.
 */
$nameGate = 'TESTGATE';
$nameList = 'TESTLIST';

$response = $this->client->GetListID([
    'name' => $nameList,
]);

if (Response::SUCCESSFUL === $response->getCode()) {

    $idList = $response->getId();

    $inputData = new Properties();
    $inputData['MESSAGE'] = 'Lorem ipsum dolor sit amet.';

    $response = $client->TriggerCampaignForUserWithResult([
        'List' => $idList,
        'UserID' => $idUser,
        'GateName' => $nameGate,
        'InputData' => $inputData,
    ]);

    if (Response::SUCCESSFUL === $response->getCode()) {
        printf("The message has been sent to user #%d.", $idUser);
    }

} else {
    printf("Error with the '%s' list.", $nameList);
}
```
