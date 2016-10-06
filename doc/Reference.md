# Reference


## System Information

### GetStatus

Provides information about the current status of the system.

```php
<?php

$SystemStatusResponse = $client->GetSystemStatus();

print $SystemStatusResponse->getStatus(); // OK
print $SystemStatusResponse->getVersion(); // v6.2.5.1

```


## Manage Lists

### GetLists

Retrieve a series of lists.

```php
<?php

$GetListsReponse = $client->GetLists([

    /* This is a list of ids of lists to retrieve */
    'ids' => '',

    /* The SQL constraint to apply to the query */
    'constraint' => '',

]);

if (Response::SUCCESSFUL === $GetListsReponse->getCode()) {
    $ArrayOfListInfo = $GetListsReponse->getLists();
}

```


### GetListID

Get the id of a list by using its name.

```php
<?php

$GetListIDResponse = $client->GetListID([

    /* Name of the list of which the id must be retrieved */
    'name' => '',

]);

if (Response::SUCCESSFUL === $GetListIDResponse->getCode()) {
    print $GetListIDResponse->getId();
}

```


## Manage Segments

### CreateSegment

Creates a new static segment for a user list.

```php
<?php

$CreateSegmentResponse = $client->CreateSegment([

    /* ID or code of the targeted list */
    'Listid' => 1,

    /* Name to be set for the segment */
    'Name' => 'Test segment',

    /* A description of the segment */
    'Description' => 'a segment created for test purpose',
]);

if (Response::SUCCESSFUL === $CreateSegmentResponse->getCode()) {
    $segmentid = $CreateSegmentResponse->getId();
    print "$segmentid has been created.";
}

```


### AddToSegment

Adds a list of ID’s to a segment.

```php
<?php

$AddToSegmentResponse = $client->AddToSegment([

    /* ID of the segment to which records must be added */
    'segmentid' => 1,

    /* An array of ids to add to the segment */
    'ids' => [1, 2, 3, 5, 8, 13, 21]
]);

if (Response::SUCCESSFUL === $AddToSegmentResponse->getCode()) {
    print "users [1, 2, 3, 5, 8, 13, 21] are added to the segment";
}

```


### GetSegmentRecordCount

Gets the amount of recipients in a segment.

```php
<?php

$GetSegmentRecordCountResponse = $client->GetSegmentRecordCount([
    'segmentId' => 1,
]);

if (Response::SUCCESSFUL === $GetSegmentRecordCountResponse->getCode()) {
    print $GetSegmentRecordCountResponse->getResult();
}

```

### GetSegments

Gets the segments for a specific list.

```php
<?php

$GetSegmentsResponse = $client->GetSegments([
    'listId' => 1,
]);

if (Response::SUCCESSFUL === $GetSegmentsResponse->getCode()) {
    $segments = $GetSegmentsResponse->getSegments();
}

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
    print $CountUserByConstraintResponse->getUserCount();
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


## TriggerCampaign

Trigger the execution of the specified journey map.

```php
<?php

$TriggerCampaignResponse = $client->TriggerCampaign([

    /* Name of the targeted gate */
    'GateName' => '',

    /* List of input properties */
    'InputData' => '',
]);

if (Response::SUCCESSFUL !== $TriggerCampaignResponse->getCode()) {
    printf(
        "ERROR %d\t%s",
        $TriggerCampaignResponse->getCode(),
        $TriggerCampaignResponse->getError()
    );
}

```

