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
 *
 */
class SegmentInfo
{
    /**
     * @var int identifier
     */
    protected $ID;

    /**
     * @var string name
     */
    protected $Name;

    /**
     * @var string type
     */
    protected $Type;

    /**
     *
     * @var strinf description
     */
    protected $Description;

    /**
     * Gets the segment's identifier
     *
     * @return int identifier
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * Gets the segment's name
     *
     * @return string name
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Gets the segment's type
     *
     * @return string type
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Gets the segment's description
     *
     * @return string description
     */
    public function getDescription()
    {
        return $this->Description;
    }
}
