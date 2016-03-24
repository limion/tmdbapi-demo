<?php

namespace TmdbDemo\HttpClient;

/**
 * RequestInterface represents a HTTP request message.
 * Yes, it's not PSR-7. I keep it simple.
 * 
 * @author vlad.holovko@gmail.com
 */

interface RequestInterface 
{
    
    public function getUrl();
    
    public function setUrl($url);
    
    public function getMethod();
    
    public function setMethod($method);
    
    public function getQueryParams();
    
    public function setQueryParams($queryParams);
    
    public function getHeaders();
    
    public function setHeaders($headers);
    
    public function getBody();
    
    public function setBody($body);
    
}
