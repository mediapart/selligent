<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Request;

use Mediapart\Selligent\Broadcast\Campaign;
use Mediapart\Selligent\Broadcast\Target;
use Mediapart\Selligent\Broadcast\Email;

/**
 *
 */
class CreateCampaign
{
    const DATETIME_FORMAT = 'YmdHis';

    /**
     * @var \XMLWriter $writer
     */
    private $writer;

    /**
     * @param \XMLWriter $writer
     */
    public function __construct(\XMLWriter $writer)
    {
        $writer->openMemory();
        $writer->setIndent(true);

        $this->writer = $writer;
    }

    /**
     * @param Campaign $campaign
     * @return string Xml
     */
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

    /**
     * @param string $name
     * @param Array $attributes 
     * @param boolena $end
     */
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

    /**
     * @param string $name
     * @param string $value
     */
    private function attr($name, $value)
    {
        $this->writer->writeAttribute($name, $value);
    }

    /**
     * @param Campaign $campaign
     */
    private function campaign(Campaign $campaign)
    {
        $this->element(
            'CAMPAIGN', 
            [
                'NAME' => $campaign->getName(),
                'STATE' => $campaign->getState(),
                'FOLDERID' => $campaign->getFolderId(),
                'START_DT' => $campaign->getStartDate()->format(self::DATETIME_FORMAT),
                'DESCRIPTION' => $campaign->getDescription(),
                'MACATEGORY' => $campaign->getMaCategory(),
                'PRODUCTID' => $campaign->getProductId(),
                'CLASHPLANID' => $campaign->getClashPlanId(),
            ]
        );
    }

    /**
     * @param Email[] $emails
     */
    private function emails($emails)
    {
        $this->writer->startElement('EMAILS');

        foreach ($emails as $email) {
            $this->email($email);
        }

        $this->writer->endElement();
    }

    /**
     * @param Target $target
     */
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

    /**
     * @param Email $email
     */
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
        if ($email->hasHyperlinksToSensors()) {
            $this->attr('HYPERLINKS_TO_SENSORS', 1);
        }
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
