<?php

namespace TmdbDemo\HttpClient;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface AdapterInterface 
{
    
    public function get(RequestInterface $request);
    
    public function post(RequestInterface $request);
    
    public function delete(RequestInterface $request);
    
    public function getClient();
    
}
