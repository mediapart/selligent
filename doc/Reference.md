# Reference


## GetStatus

Provides information about the current status of the system.

```php
<?php

$SystemStatusResponse = $client->GetSystemStatus();

print $SystemStatusResponse->getStatus(); // OK
print $SystemStatusResponse->getVersion(); // v6.2.5.1

```


## CountUserByConstraint

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


## GetUsersByConstraint

Retrieve user information based on a constraint.

```php
<?php

$GetUsersByConstraintResponse = $client->GetUsersByConstraint([
    
    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Constraint applied to the contact selection */
    'Constraint' => '',

]);

$users = [];
if (Response::SUCCESSFUL === $GetUsersByConstraintResponse->getCode()) {

    foreach ($GetUsersByConstraintResponse->getIds() as $user_id) {
        $users[] = $client->GetUserById($user_id);
    }

}

```


## GetUserById

Retrieve contact information based on a user ID.

```php
<?php

$GetUserByIDResponse = $client->GetUserByID([

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* ID of the selected contact */
    'UserID' => $user_id,

]);

if (Response::SUCCESSFUL === $GetUsersByConstraintResponse->getCode()) {
    $userProperties = $GetUsersByConstraintResponse->getProperties();
}

```


## CreateUser

Create a contact in the specified list.

```php
<?php

$userProperties = new Properties();
$userProperties['NAME'] = 'Thomas';
$userProperties['EMAIL'] = 'thomas.gasc+test@mediapart.fr';

$CreateUserResponse = $client->CreateUser([

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Properties of the new contact */
    'Changes' => $userProperties,
]);

if (Response::SUCCESSFUL === $CreateUserResponse->getCode()) {
    $user_id = $CreateUserResponse->getUserId();
}

```


## RetrieveHashForUser

Retrieve the hash code for the selected contact.

```php
$RetrieveHashForUserResponse = $client->RetrieveHashForUser([

    /* Name of the targeted gate */
    'GateName' => $gate_name,

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* ID of the targeted contact */
    'UserID' => $user_id,

]);

if (Response::SUCCESSFUL === $RetrieveHashForUserResponse->getCode()) {
    $user_hash_code = $RetrieveHashForUserResponse->getHashCode();
}

```


