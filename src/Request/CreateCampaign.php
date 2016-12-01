<?php

namespace Mediapart\Selligent\Request;

use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Broadcast\Target;
use Mediapart\Selligent\Broadcast\Email;

class CreateCampaign
{
    private $writer;

    public function __construct(\XMLWriter $writer)
    {
        $writer->openMemory();
        $writer->setIndent(true);

        $this->writer = $writer;
    }

    public function basedOn(Campaign $campaign)
    {
        $this->writer->startDocument('1.0');
        $this->writer->startElement('API');

        $this->campaign($campaign);
        $this->emails($campaign->getEmails());

        $this->writer->endElement();
        $this->writer->endDocument();
        
        return $this->writer->outputMemory(TRUE);
    }

    private function element($name, $attributes = array(), $end = true)
    {
        $this->writer->startElement($name);

        foreach ($attributes as $key => $value) {
            $this->attr($key, $value);
        }

        if ($end) {
            $this->writer->endElement();
        }
    }

    private function attr($name, $value)
    {
        $this->writer->writeAttribute($name, $value);
    }

    private function campaign(Campaign $campaign)
    {
        $this->element(
            'CAMPAIGN', 
            [
                'NAME' => $campaign->getName(),
                'STATE' => $campaign->getState(),
                'FOLDERID' => $campaign->getFolderId(),
                'START_DT' => $campaign->getStartDate()->format('Ymdhmi'),
                'DESCRIPTION' => $campaign->getDescription(),
                'MACATEGORY' => $campaign->getMaCategory(),
                'PRODUCTID' => $campaign->getProductId(),
                'CLASHPLANID' => $campaign->getClashPlanId(),
            ]
        );
    }

    private function emails($emails)
    {
        $this->writer->startElement('EMAILS');

        foreach ($emails as $email) {
            $this->email($email);
        }

        $this->writer->endElement();
    }

    private function target(Target $target)
    {
        $this->element(
            'TARGET',
            [
                'LISTID' => $target->getListId(),
                'PRIORITY_FIELD' => $target->getPriorityField(),
                'PRIORITY_SORTING' => $target->getPrioritySorting(),
                'SEGMENTID' => $target->getSegmentId(),
                'CONSTRAINT' => $target->getConstraint(),
                'SCOPES' => $target->getScopes(),
            ]
        );
    }

    private function email(Email $email)
    {
        $this->element(
            'EMAIL', 
            [
                'NAME' => $email->getName(),
                'FOLDERID' => $email->getFolderId(),
                'MAILDOMAINID' => $email->getMailDomainId(),
                'LIST_UNSUBSCRIBE' => $email->canUnsubscribe() ? 'TRUE' : 'FALSE',
                'QUEUEID' => $email->getQueueId(),
                'TAG' => $email->getTag(),
                'MACATEGORY' => $email->getMaCategory(),
            ],
            false
        );

        $this->target($email->getTarget());

        $this->writer->startElement('CONTENT');
        foreach ($email->getContent() as $key => $value) {
            $this->writer->startElement($key);
            $this->writer->startCData();
            $this->writer->text($value);
            $this->writer->endCData();
            $this->writer->endElement();
        }
        $this->writer->endElement();

        $this->writer->endElement();
    }
}
