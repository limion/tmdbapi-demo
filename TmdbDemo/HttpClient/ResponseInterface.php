<?php

namespace TmdbDemo\HttpClient;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Response
 *
 * @author Я
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
