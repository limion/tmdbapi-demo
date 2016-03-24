<?php

namespace TmdbDemo\Api;

/**
 * MovieInterface reflects Movies subsection of the API 
 *
 * @author vlad.holovko@gmail.com
 */
interface MovieInterface {
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/movies/movieid
     * @param int movie ID
     * @param array additional parameters for the API method call
     */
    public function getMovie($id, $parameters = []);
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/movies/moviepopular
     * @param array additional parameters for the API method call
     */
    public function getMoviePopular($parameters = []);
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/movies/movietoprated
     * @param array additional parameters for the API method call
     */
    public function getMovieTopRated($parameters = []);
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/movies/movieidrating
     * @param int movie ID
     * @param array additional parameters for the API method call
     * @param numeric rating value
     */
    public function setMovieRating($id, $parameters, $value = 0);
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/movies/movieidrating
     * @param int movie ID
     * @param array additional parameters for the API method call
     */
    public function unsetMovieRating($id, $parameters);
    
}
