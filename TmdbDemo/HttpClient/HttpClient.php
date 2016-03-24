<?php

namespace TmdbDemo\HttpClient;

use TmdbDemo\HttpClient\AdapterInterface;
use TmdbDemo\HttpClient\Response;
use TmdbDemo\Setter;

/**
 * HttpClient class provides an ability to communitate over HTTP protocol.
 * It has a set of standart methods such as get,post,delete. 
 * Actual requests are made through an AdapterInterface object. 
 * 
 * @author vlad.holovko@gmail.com
 */
class HttpClient extends Setter {
    
    /**
     * @var callable. A function that is called before making a request.
     * It should be implemented as: function(RequestInterface $request, HttpClient $client) {}
     * With this function you can make additional manipulations with the Request object
     * If it returns false a request is not made, so with the help of $client->setLastResponse(ResponseInterface $response) you can implement caching.
     */
    public $beforeRequest;
    
    /**
     * @var callable. A function that is called after making a request.
     * It should be implemented as: function(ResponseInterface $response) {}
     * With this function you can make additional manipulations with the Response object,
     * for example cache it.
     */
    public $afterResponse;
    
    private $_adapter;
    
    private $_lastRequest;
    
    private $_lastResponse;
    
    public function __construct(AdapterInterface $adapter, $config = []) 
    {
        $this->_adapter = $adapter;
        $this->configure($config);
    }
    
    public function configure($config = []) {
        if (!is_array($config)) {
            return;
        }
        foreach($config as $key=>$value) {
            $this->$key=$value;
        }
    }
    
    public function setBeforeRequest($fn)
    {
        $this->beforeRequest = $fn;
        return $this;
    }
    
    public function setAfterResponse($fn)
    {
        $this->afterResponse = $fn;
        return $this;
    }
    
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }
    
    public function getAdapter()
    {
        return $this->_adapter;
    }
    
    public function getLastRequest()
    {
        return $this->_lastRequest;
    }
    
    public function getLastResponse()
    {
        return $this->_lastResponse;
    }
    
    public function setLastResponse(ResponseInterface $response)
    {
       $this->_lastResponse = $response;
       return $this;
    }
    
    public function get($uri,$queryParams = [], $headers = [])
    {
        return $this->send('get', $uri, $queryParams, $headers);
    }
    
    public function post($uri,$queryParams = [], $headers = [], $body = null)
    {
        return $this->send('post', $uri, $queryParams, $headers, $body);
    }
    
    public function delete($uri,$queryParams = [], $headers = [])
    {
        return $this->send('delete', $uri, $queryParams, $headers);
    }
    
    /**
     * Makes a request through an adapter
     * @param string $method 
     * @param string $uri
     * @param array $queryParams
     * @param array $headers
     * @param string $body
     * @return type string|null
     */
    protected function send($method, $uri,$queryParams = [], $headers = [], $body = null)
    {
        $request = $this->createRequest($uri, $method, $queryParams, $headers, $body);
        if (!is_callable($this->beforeRequest) || false !== $this->beforeRequest($request, $this)) {
            $this->_lastResponse = null;
            $response = $this->getAdapter()->$method($request);
            $this->_lastResponse = $response;
            if (is_callable($this->afterResponse)) {
                $this->afterResponse($response);
            }
        }
        return $this->_lastResponse ? $this->_lastResponse->getBody() : null;
    }
    
    protected function createRequest($uri,$method,$queryParams = [],$headers = [],$body = null)
    {
        return $this->_lastRequest = new Request($uri,$method,$queryParams,$headers,$body);
    }
    
    /**
     * Magic method to have an ability to call class property as method
     */
    public function __call($method, $args)
    {
        if(is_callable(array($this, $method))) {
            return call_user_func_array($this->$method, $args);
        }
    }
    
}
