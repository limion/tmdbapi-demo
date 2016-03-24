<?php

namespace TmdbDemo\HttpClient;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
