<?php

namespace Mediapart\Selligent\Broadcast;

class Campaign
{
    const TEST = 'Test';
    const ACTIVE = 'Active';
    const HOLD = 'Hold';
    const DESIGN = 'Design';

    private $name;
    private $state;
    private $folderId;
    private $startDate;
    private $description;
    private $maCategory;
    private $productId;
    private $clashPlanId;
    private $emails;

    public function __construct()
    {
        $this->state = self::DESIGN;
        $this->startDate = new \DateTime();
        $this->emails = [];
    }

    /**
     * @param string $name The name of the journey map.
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $state Possible values are Test, Active, Hold, Design. By default the value is set to Design.
     */
    public function setState($state)
    {
        $possible = array(
            self::TEST,
            self::ACTIVE,
            self::HOLD,
            self::DESIGN,
        );

        if (in_array($state, $possible)) {
            $this->state = $state;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    /**
     * @param integer $id The ID of the folder in which the journey map is created.
     */
    public function setFolderId($id)
    {
        $this->folderId = $id;

        return $this;
    }

    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * @param \DateTimeInterface $date This is the start date for the journey map.
     */
    public function setStartDate(\DateTimeInterface $date)
    {
        $this->startDate = $date;

        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $description The description of the journey map as defined in the properties
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $maCategory The category defined for the journey map, if any.
     */
    public function setMaCategory($maCategory)
    {
        $this->maCategory = $maCategory;

        return $this;
    }

    public function getMaCategory()
    {
        return $this->maCategory;
    }

    /**
     * @param integer $productId The ID of the product defined for the journey map, if any.
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param integer $clashPlanId The ID of the marketing pressure plan to which the journey map is linked.
     */
    public function setClashPlanId($clashPlanId)
    {
        $this->clashPlanId = $clashPlanId;

        return $this;
    }
    
    public function getClashPlanId()
    {
        return $this->clashPlanId;
    }

    /**
     * @param Email $email
     */
    public function addEmail(Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * @return Email[]
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
