<?php

namespace TmdbDemo;

use TmdbDemo\Api\MovieInterface;
use TmdbDemo\Api\AuthenticationInterface;
use TmdbDemo\Api\ConfigurationInterface;
use TmdbDemo\Api\DiscoverInterface;
use TmdbDemo\Api\Formatter;
use TmdbDemo\ApiException;

/**
 * The main Api class. It includes API method calls and auxiliary methods for iteracting with HttpClient
 * 
 * @author vlad.holovko@gmail.com
 */
class Api extends BaseApi implements MovieInterface, AuthenticationInterface, ConfigurationInterface, DiscoverInterface
{
    use Api\MovieTrait;
    use Api\AuthenticationTrait;
    use Api\ConfigurationTrait;
    use Api\DiscoverTrait;
    
    protected function get($uri,$parameters = [])
    {
        $url = $this->getBaseUri() . $uri;
        $parameters['api_key'] = $this->apiKey;
        $headers['Accept'] = 'application/json';
        $rawBody = $this->getHttpClient()->get($url,$parameters, $headers);
        return $this->processedResponse($rawBody);
    }
    
    protected function post($uri,$parameters = [],$body = null)
    {
        $url = $this->getBaseUri() . $uri;
        $parameters['api_key'] = $this->apiKey;
        $headers = [
            'Accept' => 'application/json',
            'Content-Type'=>'application/json'
        ];
        $rawBody = $this->getHttpClient()->post($url,$parameters,$headers,$body);
        return $this->processedResponse($rawBody);
    }
    
    protected function delete($uri,$parameters = [])
    {
        $url = $this->getBaseUri() . $uri;
        $parameters['api_key'] = $this->apiKey;
        $headers['Accept'] = 'application/json';
        $rawBody = $this->getHttpClient()->delete($url,$parameters,$headers);
        return $this->processedResponse($rawBody);
    }


    protected function processedResponse($body)
    {
        $body = ApiFormatter::decode($body);
        $lastResponse = $this->getHttpClient()->getLastResponse();
        if ($lastResponse && $lastResponse->getStatusCode() >= 300) {
            throw new ApiException(
                $body['status_message'],
                $this->getHttpClient()->getLastRequest(),
                $lastResponse->getStatusCode(),
                $this->getHttpClient()->getLastResponse(),
                $body['status_code']    
            );
        }
        return $body;
    }
}
