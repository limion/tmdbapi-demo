<?php

namespace TmdbDemo\Api;

/**
 * DiscoverTrait contains an implementation of DiscoverInterface
 *
 * @author vlad.holovko@gmail.com
 */
trait DiscoverTrait {
    
    public function getDiscoverMovie($parameters = [])
    {
        return $this->get('discover/movie/', $parameters);
    }
    
}
