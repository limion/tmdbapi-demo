<?php

namespace TmdbDemo\tests;

use TmdbDemo\Api;
use TmdbDemo\ApiFormatter;
use TmdbDemo\HttpClient\Response;

class ApiTest extends \PHPUnit_Framework_TestCase
{
	
    const SECURE_API_URI = 'https://api.themoviedb.org/3/';
    const NONSECURE_API_URI = 'http://api.themoviedb.org/3/';
    const API_KEY = 'qwer';
    
    private $adapter;
    private $api;
	
    protected function setUp() {
        $this->adapter = $this->getMock('TmdbDemo\HttpClient\AdapterInterface');
        $this->api = new Api([
            'apiKey'=>self::API_KEY,
            'secure'=>false,
            'httpClientOptions'=>[
                'adapter' => $this->adapter
            ]
        ]);
    }


    public function testSetApiKeyByConstuctor()
    {
        $api = new Api('qwer');
	$this->assertEquals('qwer',$api->apiKey);
    }
	
    public function testSecureModeReturnsRightBaseUri()
    {
        $api = new Api([
            'secure'=>true
        ]);
        $this->assertEquals(self::SECURE_API_URI,$api->getBaseUri());
    }
	
    public function testNonSecureModeReturnsRightBaseUri()
    {
        $api = new Api([
            'secure'=>false
        ]);
        $this->assertEquals(self::NONSECURE_API_URI,$api->getBaseUri());
    }
    
    public function testReconfigSecureMode()
    {
        $api = new Api([
            'secure'=>false
        ]);
        $this->assertEquals(self::NONSECURE_API_URI,$api->getBaseUri());
        $api->configure([
            'secure'=>true
        ]);
        $this->assertEquals(self::SECURE_API_URI,$api->getBaseUri());
    }
	
    public function testDefaultAdapterIsGuzzleAdapter()
    {
        $api = new Api();
        $this->assertTrue($api->getHttpClient()->getAdapter() instanceof \TmdbDemo\HttpClient\GuzzleAdapter);
    }
    
    public function testDefaultAdapterClientIsGuzzleClient()
    {
        $api = new Api();
        $this->assertTrue($api->getHttpClient()->getAdapter()->getClient() instanceof \GuzzleHttp\Client);
    }
    
    public function testSetManuallyFakeAdapter()
    {
        $adapter = new \TmdbDemo\HttpClient\FakeAdapter();
        $api = new Api([
            'httpClientOptions'=>[
                'adapter'=>$adapter
            ]
        ]);
        $this->assertTrue($api->getHttpClient()->getAdapter() instanceof \TmdbDemo\HttpClient\FakeAdapter);
    }
    
    public function providerTestApiImplementsInterface()
    {
        return [
            ['TmdbDemo\Api\ConfigurationInterface'],
            ['TmdbDemo\Api\DiscoverInterface'],
            ['TmdbDemo\Api\AuthenticationInterface'], 
            ['TmdbDemo\Api\MovieInterface']  
        ];
    }
    
    /**
    * @dataProvider providerTestApiImplementsInterface
    */
    public function testApiImplementsInterface($interface)
    {
        //fwrite(STDERR, print_r(class_implements('TmdbDemo\Api'),true));
        $this->assertTrue(in_array($interface, class_implements('TmdbDemo\Api')));
    }
    
    public function providerTestApiHasMethod()
    {
        return [
            ['getAuthenticationGuestSessionNew'],
            ['getConfiguration'],
            ['getDiscoverMovie'],
            ['getMovie'],
            ['getMoviePopular'],
            ['getMovieTopRated'],
            ['setMovieRating'],
            ['unsetMovieRating'],
        ];
    }
    
    /**
    * @dataProvider providerTestApiHasMethod
    */
    public function testApiHasMethod($method)
    {
        $api = new Api();
        $this->assertTrue(method_exists($api, $method));
    }
    
    public function testGetMovieMakesRequest()
    {
        $body = 'test';
        $response = (new Response)
            ->setBody(ApiFormatter::encode($body));    
        
        $this->adapter
            ->expects($this->once())
            ->method('get')
            ->willReturn($response);
        
        $this->assertEquals($body, $this->api->getMovie(123));
    }
    
}