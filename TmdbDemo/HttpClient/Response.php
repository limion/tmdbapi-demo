<?php

namespace TmdbDemo\HttpClient;

/**
 * Implementation of a ResponseInterface
 * 
 * @author vlad.holovko@gmail.com
 */
class Response implements ResponseInterface 
{
    
    private $_statusCode;
    
    private $_headers;
    
    private $_body;
    
    public function __construct($statusCode = 200, $headers = [], $body = null) 
    {
        $this->_statusCode = $statusCode;
        $this->_headers = $headers ? (array)$headers : [];
        $this->_body = $body;
    }
    
    public function getStatusCode()
    {
        return $this->_statusCode;
    }
    
    public function setStatusCode($value)
    {
        $this->_statusCode = $value;
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
    
    public function getBody()
    {
        return $this->_body;
    }
    
    public function setBody($value)
    {
        $this->_body = $value;
        return $this;
    }
    
}
