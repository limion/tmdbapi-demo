<?php

namespace TmdbDemo\HttpClient;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException as AdapterRequestException;
use GuzzleHttp\Exception\TransferException as AdapterTransferException;
use Psr\Http\Message\ResponseInterface as AdapterResponseInterface;
use TmdbDemo\ApiException;

/**
 * Adapter for the GuzzleHttp\ClientInterface
 * @author vlad.holovko@gmail.com
 */

class GuzzleAdapter implements AdapterInterface
{
 
    private $_client;
    
    public function __construct(ClientInterface $client) 
    {
        $this->_client = $client;
    }
    
    public function getClient() 
    {
       return $this->_client;
    }
    
    protected function buildOptions(RequestInterface $request) 
    {
        $options = [
            'headers'=>$request->getHeaders(),
            'query'=>$request->getQueryParams()
        ];
        if ('POST' == strtoupper($request->getMethod())) {
            $options['body'] = $request->getBody();
        }
        return $options;
    }
    
    public function get(RequestInterface $request) 
    {
        return $this->send('get', $request);
    }
    
    public function post(RequestInterface $request) 
    {
        return $this->send('post', $request);
    }
    
    public function delete(RequestInterface $request) 
    {
        return $this->send('delete', $request);
    }
    
    /**
     * Makes actual request 
     * @param string $method (get,post,delete)
     * @param \TmdbDemo\HttpClient\RequestInterface $request
     * @return \TmdbDemo\HttpClient\Response 
     */
    public function send($method,RequestInterface $request) 
    {
        try {
            $response = $this->getClient()->$method($request->getUrl(),$this->buildOptions($request));
            return $this->createResponse($response);
        } catch (AdapterRequestException $e) {
            if ($e->hasResponse()) {
                return $this->createResponse($e->getResponse());
            }
            $this->manageHttpClientException($request,$e);
        } catch (AdapterTransferException $e) {
            $this->manageHttpClientException($request,$e);
        } 
        
    }
    
    protected function createResponse(AdapterResponseInterface $adapterResponse) 
    {
        return new Response(
            $adapterResponse->getStatusCode(), 
            $adapterResponse->getHeaders(),
            (string)$adapterResponse->getBody()
        );    
    }
    
    protected function manageHttpClientException(RequestInterface $request, AdapterTransferException $adapterException) 
    {
        $message = 'The used HttpClient returned an empty response. See previous Exception ($e->getPrevious()) for the detailed information.';
        $response = null;
        $httpStatus = null;
        throw new ApiException($message,$request,$httpStatus, $response, 0, $adapterException);
    }
}
