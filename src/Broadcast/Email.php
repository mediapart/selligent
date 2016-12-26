<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent\Broadcast;

/**
 *
 */
class Email
{
    /**
     * @var string The name as defined for the email message properties.
     */
    private $name;

    /**
     * @var integer The ID of the folder in which the email is stored.
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
    private $content = [];

    /**
     * @var boolean
     */
    protected $hyperlinks_to_sensors = false;

    /**
     * @param string $name The name as defined for the email message properties.
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string The name as defined for the email message properties.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $folderId The ID of the folder in which the email is stored
     * @return self
     */
    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;

        return $this;
    }

    /**
     * @return integer The ID of the folder in which the email is stored
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * @param boolean This indicates if the list unsubscribe option has been activated for the email message.
     * @return self
     */
    public function listUnsubscribe($unsubscribe = true)
    {
        $this->unsubscribe = $unsubscribe;

        return $this;
    }

    /**
     * @return boolean Indicates if the list unsubscribe option has been activated for the email message.
     */
    public function canUnsubscribe()
    {
        return $this->unsubscribe;
    }

    /**
     * @param integer The queue to which the email messages are transferred for broadcast.
     * @return self
     */
    public function setQueueId($queueId) 
    {
        $this->queueId = $queueId;

        return $this;
    }

    /**
     * @return integer The queue to which the email messages are transferred for broadcast.
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * @param integer The Brand used for sending out the email message.
     * @return self
     */
    public function setMailDomainId($mailDomainId)
    {
        $this->mailDomainId = $mailDomainId;

        return $this;
    }

    /**
     * @return integer The Brand used for sending out the email message.
     */
    public function getMailDomainId()
    {
        return $this->mailDomainId;
    }

    /**
     * @param string $tag
     * @return self
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string The category attributed to the email message.
     * @return self
     */
    public function setMaCategory($maCategory)
    {
        $this->maCategory = $maCategory;

        return $this;
    }

    /**
     * @return string
     */
    public function getMaCategory()
    {
        return $this->maCategory;
    }

    /**
     * @param Target $target
     * @return self
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return Target
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
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
     *
     * @param Array 
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set this value to TRUE when your hyperlinks must be converted to sensors.
     *
     * @param boolean $hyperlinks_to_sensors
     * @return self
     */
    public function setHyperlinksToSensors($hyperlinks_to_sensors = true)
    {
        $this->hyperlinks_to_sensors = $hyperlinks_to_sensors;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasHyperlinksToSensors()
    {
        return $this->hyperlinks_to_sensors;
    }
}
