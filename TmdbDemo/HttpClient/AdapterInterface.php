<?php

namespace TmdbDemo\HttpClient;

/* 
 * AdapterInterface for HttpClient handlers
 * @author vlad.holovko@gmail.com
 */

interface AdapterInterface 
{
    
    /**
     * Makes HTTP GET request
     * @param \TmdbDemo\HttpClient\RequestInterface $request
     * @return \TmdbDemo\HttpClient\ResponseInterface
     */
    public function get(RequestInterface $request);
    
    /**
     * Makes HTTP POST request
     * @param \TmdbDemo\HttpClient\RequestInterface $request
     * @return \TmdbDemo\HttpClient\ResponseInterface
     */
    public function post(RequestInterface $request);
    
    /**
     * Makes HTTP DELETE request
     * @param \TmdbDemo\HttpClient\RequestInterface $request
     * @return \TmdbDemo\HttpClient\ResponseInterface
     */
    public function delete(RequestInterface $request);
    
    /**
     * Get original handler instance
     */
    public function getClient();
    
}
