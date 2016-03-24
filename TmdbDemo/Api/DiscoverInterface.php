<?php

namespace TmdbDemo\Api;

/**
 * DiscoverInterface reflects Discover subsection of the API 
 *
 * @author vlad.holovko@gmail.com
 */
interface DiscoverInterface {
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/discover/discovermovie
     * @param array additional parameters for the API method call
     */
    public function getDiscoverMovie($parameters = []);
    
}
