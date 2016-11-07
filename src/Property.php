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
 * Combination of a key and a value.
 * The key is a field name and the value is a formatted string.
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
