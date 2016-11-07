# Campaigns

- [TriggerCampaign](#triggercampaign)
- [TriggerCampaignWithResult](#triggercampaignwithresult)
- [TriggerCampaignForUser](#triggercampaignforuser)
- [TriggerCampaignForUserWithResult](#triggercampaignforuserwithresult)


## TriggerCampaign

Trigger the execution of the specified journey map.

```php
<?php

$inputData = new Properties();
$TriggerCampaignResponse = $client->TriggerCampaign([

    /* Name of the targeted gate */
    'GateName' => 'TESTGATE',

    /* List of input properties */
    'InputData' => $inputData,
]);

if (Response::SUCCESSFUL !== $TriggerCampaignResponse->getCode()) {
    printf(
        "ERROR %d\t%s",
        $TriggerCampaignResponse->getCode(),
        $TriggerCampaignResponse->getError()
    );
}

```


## TriggerCampaignWithResult

Trigger the execution of the specified journey map and returns the result.

```php
<?php

$inputData = new Properties();
$TriggerCampaignWithResultResponse = $client->TriggerCampaign([

    /* Name of the targeted gate */
    'GateName' => 'TESTGATE',

    /* List of input properties */
    'InputData' => $inputData,
]);

if (Response::SUCCESSFUL === $TriggerCampaignWithResultResponse->getCode()) {
    print $TriggerCampaignWithResultResponse->getResult();
}

```


## TriggerCampaignForUser

Trigger the execution of the specified journey map for a specific contact.

```php
<?php

$inputData = new Properties();
$TriggerCampaignForUserResponse = $client->TriggerCampaign([

    /* ID or code of the targeted list */
    'List' => 1,

    /* ID of the selected contact */
    'UserID' => 1,

    /* Name of the targeted gate */
    'GateName' => 'TESTGATE',

    /* List of input properties */
    'InputData' => $inputData,
]);

if (Response::SUCCESSFUL === $TriggerCampaignForUserResponse->getCode()) {
    print "campaign sent";
}


```## TriggerCampaignForUserWithResult

Trigger the execution of the specified journey map for a specific contact.

```php
<?php

$inputData = new Properties();
$TriggerCampaignForUserWithResultResponse = $client->TriggerCampaign([

    /* ID or code of the targeted list */
    'List' => 1,

    /* ID of the selected contact */
    'UserID' => 1,

    /* Name of the targeted gate */
    'GateName' => 'TESTGATE',

    /* List of input properties */
    'InputData' => $inputData,
]);

if (Response::SUCCESSFUL === $TriggerCampaignForUserWithResultResponse->getCode()) {
    print $TriggerCampaignForUserWithResultResponse->getResult();
}

```