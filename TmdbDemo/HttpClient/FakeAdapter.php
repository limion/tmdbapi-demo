<?php

namespace TmdbDemo\HttpClient;

use TmdbDemo\ApiException;

/**
 * FakeAdapter class is used to test an adapter interface
 * @author vlad.holovko@gmail.com
 */

class FakeAdapter implements AdapterInterface
{
    
    public function getClient() 
    {
       return null;
    }
    
    public function get(RequestInterface $request) 
    {
        return new Response();
    }
    
    public function post(RequestInterface $request) 
    {
        return Response();
    }
    
    public function delete(RequestInterface $request) 
    {
        return Response();
    }
    
}
