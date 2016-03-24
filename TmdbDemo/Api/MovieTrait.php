<?php

namespace TmdbDemo\Api;

use TmdbDemo\ApiFormatter;

/**
 * MovieTrait contains an implementation of MovieInterface
 *
 * @author vlad.holovko@gmail.com
 */

trait MovieTrait {
    
    public function getMovie($id, $parameters = [])
    {
        return $this->get('movie/'.$id, $parameters);
    }
    
    public function getMoviePopular($parameters = [])
    {
        return $this->get('movie/popular', $parameters);
    }
    
    public function getMovieTopRated($parameters = [])
    {
        return $this->get('movie/top_rated', $parameters);
    }
    
    public function setMovieRating($id, $parameters, $value = 0)
    {
        $body = ApiFormatter::encode(array('value'=>$value));
        return $this->post('movie/'.$id.'/rating', $parameters, $body);
    }
    
    public function unsetMovieRating($id, $parameters)
    {
        return $this->delete('movie/'.$id.'/rating', $parameters);
    }
    
}
