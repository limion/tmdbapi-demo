<?php

namespace TmdbDemo\HttpClient;

/**
 * ResponseInterface represents a HTTP response message.
 * Yes, it's not PSR-7. I keep it simple.
 * 
 * @author vlad.holovko@gmail.com
 */
interface ResponseInterface 
{
    
    public function getStatusCode();
    
    public function setStatusCode($code);
    
    public function getHeaders();
    
    public function setHeaders($headers);
    
    public function getBody();
    
    public function setBody($body);
    
}
