<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

/**
 * List datastructure
 */
class ListInfo
{
    /**
     *
     */
    public static $datetime_format = 'Y-m-d\TH:i:s.u';

    /**
     * @var integer
     */
    protected $ID;

    /**
     * @var string
     */
    protected $Name;

    /**
     * @var string
     */
    protected $Description;

    /**
     * @var string
     */
    protected $CreatedDate;

    /**
     * @var string
     */
    protected $ModifiedDate;

    /**
     * @var string
     */
    protected $Type;

    /**
     * @var string
     */
    protected $Tag;

    /**
     * @param integer $id
     * @param string $name
     * @param string $description 
     * @param string $type 
     * @param string $tag
     */
    public function __construct($id, $name = null, $description = null, $type = null, $tag = null)
    {
        $now = new \DateTime();
        $this->ID = $id;
        $this->Name = $name;
        $this->Description = $description;
        $this->CreatedDate = $now->format(self::$datetime_format);
        $this->ModifiedDate = null;
        $this->Type = $type;
        $this->Tag = $tag;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedDate()
    {
        return new \DateTime($this->CreatedDate);
    }

    /**
     * @return \DateTimeInterface
     */
    public function getModifiedDate()
    {
        if (!is_null($this->ModifiedDate)) {
            return new \DateTime($this->ModifiedDate);
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->Tag;
    }
}
