<?php

namespace Mediapart\Selligent;

class SegmentInfo
{
    /**
     *
     */
    protected $ID;

    /**
     *
     */
    protected $Name;

    /**
     *
     */
    protected $Type;

    /**
     *
     */
    protected $Description;

    /**
     *
     */
    public function __construct()
    {}

    /**
     *
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     *
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     *
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     *
     */
    public function getDescription()
    {
        return $this->Description;
    }
}
