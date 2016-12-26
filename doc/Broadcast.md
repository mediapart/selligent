# Broadcast Complete HTML Campaign

```php
<?php

namespace Mediapart\Selligent;

/* 
    Open a connection to Selligent.
 */
$connection = new Connection();
$client = $connection->open(
    [
        'login' => '*****',
        'password' => '*****',
        'wsdl' => 'http://emsecure/broadcast?wsdl', 
    ],
    Connection::API_BROADCAST
);

/*
    Create your campaign.
    For complete options, see directly the Selligent API reference and
    our implementation in /src/Broadcast/ classes.
 */
$campaign = new Campaign();
$campaign
    ->setName('Campaign Test')
    ->setState(Campaign::ACTIVE)
    ->setStartDate(new DateTime('tomorrow'))
    ->setDescription('Some campaign test scheduled for tomorrow.')
;
// ... 

$broadcast = new Broadcast($client);
$response = $broadcast->triggerCampaign($campaign);

if ($response==Response::SUCCESSFUL) {
    print 'Your campaign has been created';
}

```

## HYPERLINKS_TO_SENSORS Attribute

Convert all your hyperlinks to sensors in your email :

```php
<?php
$email = new Email();
$email->setHyperlinksToSensors(true);
```
