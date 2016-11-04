# Campaigns


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