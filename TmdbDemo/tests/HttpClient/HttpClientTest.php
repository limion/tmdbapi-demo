<?php

namespace TmdbDemo\tests\HttpClient;

use TmdbDemo\Api;
use TmdbDemo\HttpClient\Response;
use TmdbDemo\HttpClient\Request;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{
	
    const API_KEY = 'qwer';
    
    private $client;
    private $adapter;
	
    protected function setUp()
    {
        $this->adapter = $this->getMock('TmdbDemo\HttpClient\AdapterInterface');
        $api = new Api([
            'httpClientOptions'=>[
                'adapter' => $this->adapter
            ]
        ]);
        $this->client = $api->getHttpClient();
    }
	
    public function providerTestClientMethodCallsAdapterMethod()
    {
        return [
            ['get'],
            ['post'],
            ['delete']
        ];
    }
    
    /**
    * @dataProvider providerTestClientMethodCallsAdapterMethod
    */
    public function testClientMethodCallsAdapterMethod($method)
    {
        $fakeBody = 'test';
        $fakeResponse = new Response();
        $fakeResponse->setBody($fakeBody);
        $this->adapter
            ->expects($this->once())
            ->method($method)
            ->willReturn($fakeResponse);
        
        $this->assertEquals($fakeBody, $this->client->$method('/'));
    }
    
    public function testLastRequest()
    {
        $headers = ['someheader'=>'somevalue'];
        $params = ['someparam'=>'somevalue'];
        $url = '/test';
        $request = (new Request())
            ->setUrl($url)
            ->setMethod('get')
            ->setHeaders($headers)
            ->setQueryParams($params);    
        
        $this->client->get($url,$params,$headers);
        
        $this->assertEquals($request, $this->client->getLastRequest());
    }
    
    public function testLastResponse()
    {
        $headers = ['someheader'=>'somevalue'];
        $body = 'test';
        $response = (new Response)
            ->setStatusCode(404)
            ->setHeaders($headers)
            ->setBody($body);    
        
        $this->adapter
            ->expects($this->once())
            ->method('get')
            ->willReturn($response);
        
        $this->client->get('/');
        $this->assertEquals($response, $this->client->getLastResponse());
    }
    
    public function testAdapterMethodIsNotCalledIfBeforeRequestReturnsFalse()
    {
        $this->client->configure([
            'beforeRequest'=>function(){return false;}
        ]);
        
        $this->adapter
            ->expects($this->never())
            ->method('get');
        
        $this->client->get('/');
    }
}