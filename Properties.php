<?php

namespace Mediapart\Selligent;

use Mediapart\Selligent\Property;

/**
 *
 */
class Properties implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var Array[Property]
     */
    public $Property = [];

    /**
     * @return boolean 
     */
    public function offsetExists($offset)
    {
        foreach ($this->Property as $property) {
            if ($offset === $property->getKey()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        foreach ($this->Property as $property) {
            if ($offset === $property->getKey()) {
                return $property;
            }
        }
        return null;
    }

    /**
     * @return void 
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset) && $value instanceof Property) {
            $offset = $value->getKey();
        }

        foreach ($this->Property as $i => $property) {
            if ($offset === $property->getKey()) {
                return $this->Property[$i]->setValue($value);
            }
        }

        return $this->Property[] = new Property(
            $offset,
            $value instanceof Property ? $value->getValue() : $value
        );
    }

    /**
     * @return void 
     */
    public function offsetUnset($offset)
    {
        foreach ($this->Property as $i => $property) {
            if ($offset === $property->getKey()) {
                unset($this->Property[$i]);
            }
        }
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->Property);
    }
}
