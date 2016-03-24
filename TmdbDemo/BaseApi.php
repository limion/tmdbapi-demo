<?php

namespace TmdbDemo;

use TmdbDemo\HttpClient\HttpClient;
use TmdbDemo\HttpClient\AdapterInterface;
use TmdbDemo\HttpClient\GuzzleAdapter;

/**
 * The base Api class. It governs initial configuration like setting an apiKey, secure mode, 
 * default httpclient adapter, building base API Uri; 
 * @author vlad.holovko@gmail.com
 */
abstract class BaseApi  extends Setter
{
    /**
     * TMDb API v3 base uri
     * @var string
     */
    const TMDB_URI = 'api.themoviedb.org/3/';
    
    /**
     * HTTP secure schema
     */
    const SECURE_SCHEMA = 'https';
    
    /**
     * HTTP shema
     */
    const NONSECURE_SCHEMA = 'http';
    
    /**
     * TMDb API key
     * @var string
     */
    public $apiKey;

    private $_secure = false;
    private $_baseUri;
    private $_httpClient;
    private $_httpClientOptions = [];
    
    public function __construct($config = []) 
    {
        if (is_string($config)) {
            $this->apiKey = $config;
            $config = [];
        }
        $this->configure($config);
    } 
    
    public function configure($config = []) {
        if (!is_array($config)) {
            return;
        }
        if(isset($config['secure'])) {
            $this->_secure = $config['secure'];
            unset($config['secure']);
        }
        if(isset($config['httpClientOptions'])) {
            if (!is_array($config['httpClientOptions'])) {
                $config['httpClientOptions'] = [];
            }
        }
        foreach($config as $key=>$value) {
            $this->$key=$value;
        }
        if (null !== $this->_httpClient && isset($config['httpClientOptions'])) {
            // reconfigure httpClient
            $options = $config['httpClientOptions'];
            if (isset($options['adapter'])) {
                $this->getHttpClient()->setAdapter($options['adapter']);
                unset($options['adapter']);
            }
            $this->getHttpClient()->configure($options);
        }
        $this->_baseUri = sprintf('%s://%s', ($this->_secure ? self::SECURE_SCHEMA : self::NONSECURE_SCHEMA), self::TMDB_URI);
    }

    public function getHttpClientOptions()
    {
        return $this->_httpClientOptions;
    }
    
    public function setHttpClientOptions($options)
    {
        $this->_httpClientOptions = $options;
        return $this;
    }
    
    public function getBaseUri()
    {
        return $this->_baseUri;
    }
    
    public function getHttpClient() 
    {
        if(null === $this->_httpClient) {
            $options = $this->getHttpClientOptions();
            $adapter = null;
            if (isset($options['adapter'])) {
                $adapter = $options['adapter'];
                unset($options['adapter']);
            }
            if(empty($adapter)) {
               $adapter = $this->getDefaultAdapter(); 
            }
            $this->_httpClient = new HttpClient($adapter,$options);
        }
        return $this->_httpClient;
    }
    
    public function getDefaultAdapter()
    {
        return new GuzzleAdapter(new \GuzzleHttp\Client());
    }
    
    
}
