<?php

namespace TmdbDemo\Api;

/**
 * AuthenticationInterface reflects Authentication subsection of the API 
 *
 * @author vlad.holovko@gmail.com
 */
interface AuthenticationInterface {
    
    /**
     * @link http://docs.themoviedb.apiary.io/#reference/authentication/authenticationguestsessionnew
     */
    public function getAuthenticationGuestSessionNew();
    
}
