# Manage Users

- [CreateUser](#createuser)
- [UpdateUser](#updateuser)
- [UpdateUsers](#updateusers)
- [GetUserById](#getuserbyid)
- [RetrieveHashForUser](#retrievehashforuser)
- [CountUserByFilter](#countuserbyfilter)
- [GetUsersByFilter](#getusersbyfilter)
- [GetUserByFilter](#getuserbyfilter)
- [CountUserByConstraint](#countuserbyconstraint)
- [GetUsersByConstraint](#getusersbyconstraint)
- [GetUserByConstraint](#getusersbyconstraint)


## CreateUser

Create a contact in the specified list.

```php
<?php

$changes = new Properties();
$changes['NAME'] = 'Foo bar';
$changes['MAIL'] = 'foo@bar.tld';

$CreateUserResponse = $client->CreateUser([

    /* ID or Code of the targeted list */
    'List' => 42,

    /* Properties of the new contact */
    'Changes' => $changes,
]);

if (Response::SUCCESSFUL === $CreateUserResponse->getCode()) {
    $user_id = $CreateUserResponse->getUserId();
}

```


## UpdateUser

Update a contact profile in the specified list.

```php
<?php

$changes = new Properties();
$changes['NAME'] = 'Test Foo bar';
$changes['MAIL'] = 'foo+test@bar.tld';

$UpdateUserResponse = $client->UpdateUser([

    /* ID or Code of the targeted list */
    'List' => 42,

    /* ID of the selected contact */
    'UserID' => $user_id,

    /* List of modified properties */
    'Changes' => $changes,

]);

if (Response::SUCCESSFUL !== $UpdateUserResponse->getCode()) {
    print $UpdateUserResponse->getError();
}

```


## UpdateUsers

Update multiple contact profiles in the specified list.

```php
<?php

use Mediapart\Selligent\Properties;
use Mediapart\Selligent\Request\UpdateUsers;

$user1Properties = new Properties();
$user1Properties['Foo'] = 'Bar 1';

$user2Properties = new Properties();
$user2Properties['Foo'] = 'Bar 2';

$UpdateUsersResponse = $client->UpdateUsers([

    /* ID or Code of the targeted list */
    'List' => 1,

    /* An array of contact profiles to update. 
       The ID is used to perform mapping with existing records. 
       In case of insert, set the ID to 0. */
    'UserChanges' => [
        [
            'ID' => 1,
            'Changes' => $user1Properties
        ],
        [
            'ID' => 2,
            'Changes' => $user2Properties
        ],
    ],

    /* The type of operation.
        - 1, insert only
        - 2, update only
        - 3, insert and update */
    'mode' => UpdateUsers::INSERT & UpdateUsers::UPDATE,

]);

if (Response::SUCCESSFUL === $UpdateUsersResponse->getCode()) {
    print "changes saved."
}

```


## GetUserById

Retrieve contact information based on a user ID.

```php
<?php

$GetUserByIDResponse = $client->GetUserByID([

    /* ID or Code of the targeted list */
    'List' => 42,

    /* ID of the selected contact */
    'UserID' => $user_id,

]);

if (Response::SUCCESSFUL === $GetUsersByConstraintResponse->getCode()) {
    $userProperties = $GetUsersByConstraintResponse->getProperties();
}

```


## RetrieveHashForUser

Retrieve the hash code for the selected contact.

```php
<?php

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


## CountUserByConstraint

Count the number of contacts based on a constraint.

```php
<?php

$CountUserByConstraintResponse = $client->CountUsersByConstraint([

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Constraint applied to the contact’s selection. 
       The constraint corresponds to the sql WHERE statement */
    'Constraint' => 'NAME LIKE %foobar%',

]);

if (Response::SUCCESSFUL === $CountUserByConstraintResponse->getCode()) {
    print $CountUserByConstraintResponse->getUserCount();
}

```


## GetUsersByConstraint

Retrieve a list of contacts based on a constraint.

```php
<?php

$GetUsersByConstraintResponse = $client->GetUsersByConstraint([
    
    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Constraint applied to the contact selection */
    'Constraint' => 'NAME LIKE %foobar%',

    /* Maximum amount of records retrieved */
    'MaxCount' => 5,

]);

$users = [];
if (Response::SUCCESSFUL === $GetUsersByConstraintResponse->getCode()) {

    foreach ($GetUsersByConstraintResponse->getIds() as $user_id) {
        $users[] = $client->GetUserById($user_id);
    }

}

```


## GetUserByConstraint

Retrieve user information based on a constraint.

```php
<?php

$GetUserByConstraintResponse = $client->GetUsersByConstraint([
    
    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Constraint applied to the contact selection */
    'Constraint' => 'NAME = %foobar%',

]);

if (Response::SUCCESSFUL === $GetUserByConstraintResponse->getCode()) {
    $user = $GetUserByConstraintResponse->getProperties();
}

```


## CountUserByFilter

Count the number of contacts based on a filter.

```php
<?php

$filter = new Properties();
$filter['NAME'] = 'foobar';

$CountUserByFilterResponse = $client->CountUsersByFilter([

    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Filter applied to the contact’s selection. 
       This is represented by an array of keys and values */
    'Filter' => $filter,

]);

if (Response::SUCCESSFUL === $CountUserByFilterResponse->getCode()) {
    print $CountUserByFilterResponse->getUserCount();
}

```


## GetUsersByFilter

Retrieve a list of contacts based on a filter.

```php
<?php

$filter = new Properties();
$filter['NAME'] = 'foobar';

$GetUsersByFilterResponse = $client->GetUsersByFilter([
    
    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Filter applied to the contact’s selection.
       This is represented by an array of keys and values */
    'Filter' => $filter,

    /* Maximum amount of records retrieved */
    'MaxCount' => 5,

]);

$users = [];
if (Response::SUCCESSFUL === $GetUsersByFilterResponse->getCode()) {

    foreach ($GetUsersByFilterResponse->getIds() as $user_id) {
        $users[] = $client->GetUserById($user_id);
    }

}

```


## GetUserByFilter

Retrieve contact information based on a filter

```php
<?php

$filter = new Properties();
$filter['NAME'] = 'foobar';

$GetUserByFilterResponse = $client->GetUserByFilter([
    
    /* ID or Code of the targeted list */
    'List' => $list_id,

    /* Filter applied to the contact selection */
    'Filter' => $filter,

]);

if (Response::SUCCESSFUL === $GetUserByFilterResponse->getCode()) {
    $user = $GetUserByFilterResponse->getProperties();
}

```
