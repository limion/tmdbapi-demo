<?php

namespace TmdbDemo;

/**
 * Base class for objects that can configure their  properties with and array
 */

class Setter 
{
    /**
     * For configuration private properties with set* methods
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } 
    }
    
}
