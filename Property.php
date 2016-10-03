<?php

namespace Mediapart\Selligent;

/**
 *
 */
class Property
{
    /**
     * @var string
     */
    protected $Key;

    /**
     * @var mixed
     */
    protected $Value;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function __construct($key, $value = null)
    {
        $this->Key = $key;
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->Key;
    }

    /**
     * @return bool
     */
    public function setValue($value)
    {
        return $this->Value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->Value;
    }
}
