# Manage Lists

## GetLists

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


## GetListID

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
