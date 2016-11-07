# Manage Segments

## CreateSegment

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


## AddToSegment

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


## GetSegmentRecordCount

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


## GetSegments

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
