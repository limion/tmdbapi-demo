<?php

namespace TmdbDemo\Api;

/**
 * ConfigurationInterface reflects Configuration subsection of the API 
 *
 * @author vlad.holovko@gmail.com
 */
interface ConfigurationInterface {
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/configuration
     */
    public function getConfiguration();
    
}
