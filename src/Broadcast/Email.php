<?php

namespace Mediapart\Selligent\Broadcast;

class Email
{
    /**
     * @var string The name as defined for the email message properties.
     */
    private $name;

    /**
     * @var integer The ID of the folder in which the email is stored
     */
    private $folderId;

    /**
     * @var integer The Brand used for sending out the email message.
     */
    private $mailDomainId;

    /**
     * @var boolean This indicates if the list unsubscribe option has been activated for the email message.
     */
    private $unsubscribe;

    /**
     * @var integer The queue to which the email messages are transferred for broadcast.
     */
    private $queueId;

    /**
     * @var string 
     */
    private $tag;

    /**
     * @var string The category attributed to the email message.
     */
    private $maCategory;

    /**
     * @var Target 
     */
    private $target;

    /**
     * @var array
     */
    private $content;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;

        return $this;
    }

    public function getFolderId()
    {
        return $this->folderId;
    }

    public function listUnsubscribe($unsubscribe = true)
    {
        $this->unsubscribe = $unsubscribe;

        return $this;
    }

    public function canUnsubscribe()
    {
        return $this->unsubscribe;
    }

    public function setQueueId($queueId) 
    {
        $this->queueId = $queueId;

        return $this;
    }

    public function getQueueId()
    {
        return $this->queueId;
    }

    public function setMailDomainId($mailDomainId)
    {
        $this->mailDomainId = $mailDomainId;

        return $this;
    }

    public function getMailDomainId()
    {
        return $this->mailDomainId;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setMaCategory($maCategory)
    {
        $this->maCategory = $maCategory;

        return $this;
    }

    public function getMaCategory()
    {
        return $this->maCategory;
    }

    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param Array 
     *
     * With the folling key/values :
     *
     * - HTML: The complete HTML version of the email message
     * - TEXT: The complete text version of the email message
     * - FROM_ADDR: The From address used for the email
     * - FROM_NAME: The From name used in the email
     * - TO_ADDR: The recipients email address. This is always like following: ~Mail~
     * - TO_NAME: The recipient’s name. This is always like following: ~Name~
     * - REPLY_ADDR: The ‘reply to’ address
     * - REPLY_NAME: The ‘reply to’ name
     * - SUBJECT: The subject line of the email message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }
}
