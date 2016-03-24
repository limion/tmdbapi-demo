<?php

namespace TmdbDemo\Api;

/**
 * ConfigurationTrait contains an implementation of ConfigurationInterface
 *
 * @author vlad.holovko@gmail.com
 */
trait ConfigurationTrait {
    
    public function getConfiguration()
    {
        return $this->get('configuration');
    }
    
}
