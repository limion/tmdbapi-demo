<?php

namespace TmdbDemo\Api;

/**
 * AuthenticationTrait contains an implementation of AuthenticationInterface 
 *
 * @author vlad.holovko@gmail.com
 */
trait AuthenticationTrait {
    
    public function getAuthenticationGuestSessionNew()
    {
        return $this->get('authentication/guest_session/new');
    }
    
}
