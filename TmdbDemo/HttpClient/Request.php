<?php

namespace TmdbDemo\HttpClient;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author Я
 */
class Request implements RequestInterface
{
    private $_url;
    
    private $_method;
    
    private $_queryParams;

    private $_headers;
    
    private $_body;
    
    public function __construct($url = '/', $method = 'GET', $queryParams = [], $headers = [], $body = null) 
    {
        $this->_url = (string)$url;
        $this->_method = (string)$method;
        $this->_queryParams = $queryParams ? (array)$queryParams : [];
        $this->_headers = $headers ? (array)$headers : [];
        $this->_body = $body;
    }
    
    public function getUrl() {
        return $this->_url;
    }
    
    public function setUrl($value)
    {
        $this->_url = $value;
        return $this;
    }
    
    public function getMethod() {
        return $this->_method;
    }
    
    public function setMethod($value)
    {
        $this->_method = $value;
        return $this;
    }
    
    public function getQueryParams() {
        return $this->_queryParams;
    }
    
    public function setQueryParams($value)
    {
        $this->_queryParams = $value;
        return $this;
    }
    
    public function getHeaders() 
    {
        return $this->_headers;
    }
    
    public function setHeaders($value)
    {
        $this->_headers = $value;
        return $this;
    }
    
    public function getBody() {
        return $this->_body;
    }
    
    public function setBody($value)
    {
        $this->_body = $value;
        return $this;
    }
}
