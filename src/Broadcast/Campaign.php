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
class Campaign
{
    const TEST = 'TEST';
    const ACTIVE = 'ACTIVE';
    const HOLD = 'HOLD';
    const DESIGN = 'DESIGN';

    /**
     * @var string The name of the journey map.
     */
    private $name;

    /**
     * @var string Possible values are Test, Active, Hold, Design. By default the value is set to Design.
     */
    private $state;

    /**
     * @var integer The ID of the folder in which the journey map is created.
     */
    private $folderId;

    /**
     * @var \DateTimeInterface This is the start date for the journey map.
     */
    private $startDate;

    /**
     * @var string The description of the journey map as defined in the properties
     */
    private $description;

    /**
     * @var string The category defined for the journey map, if any.
     */
    private $maCategory;

    /**
     * @var integer The ID of the product defined for the journey map, if any.
     */
    private $productId;

    /**
     * @var integer The ID of the marketing pressure plan to which the journey map is linked.
     */
    private $clashPlanId;

    /**
     * @var Email[]
     */
    private $emails;

    /**
     *
     */
    public function __construct()
    {
        $this->state = self::DESIGN;
        $this->startDate = new \DateTime();
        $this->emails = [];
    }

    /**
     * @param string $name The name of the journey map.
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string The name of the journey map.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $state Possible values are Test, Active, Hold, Design. By default the value is set to Design.
     * @return self
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

    /**
     * @return string Possible values are Test, Active, Hold, Design. By default the value is set to Design.
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param integer $id The ID of the folder in which the journey map is created.
     * @return self
     */
    public function setFolderId($id)
    {
        $this->folderId = $id;

        return $this;
    }

    /**
     * @return integer The ID of the folder in which the journey map is created.
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * @param \DateTimeInterface $date This is the start date for the journey map.
     * @return self
     */
    public function setStartDate(\DateTimeInterface $date)
    {
        $this->startDate = $date;

        return $this;
    }

    /**
     * @return \DateTimeInterface This is the start date for the journey map.
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $description The description of the journey map as defined in the properties.
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string The description of the journey map as defined in the properties.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $maCategory The category defined for the journey map, if any.
     * @return self
     */
    public function setMaCategory($maCategory)
    {
        $this->maCategory = $maCategory;

        return $this;
    }

    /**
     * @return string The category defined for the journey map, if any.
     */
    public function getMaCategory()
    {
        return $this->maCategory;
    }

    /**
     * @param integer $productId The ID of the product defined for the journey map, if any.
     * @return self
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return integer The ID of the product defined for the journey map, if any.
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param integer $clashPlanId The ID of the marketing pressure plan to which the journey map is linked.
     * @return self
     */
    public function setClashPlanId($clashPlanId)
    {
        $this->clashPlanId = $clashPlanId;

        return $this;
    }
    
    /**
     * @return integer The ID of the marketing pressure plan to which the journey map is linked.
     */
    public function getClashPlanId()
    {
        return $this->clashPlanId;
    }

    /**
     * @param Email $email
     * @return self
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
