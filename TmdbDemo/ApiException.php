<?php

namespace TmdbDemo;

use TmdbDemo\HttpClient\RequestInterface;
use TmdbDemo\HttpClient\ResponseInterface;

/**
 * ApiException represents API Status Codes see <a href="https://www.themoviedb.org/documentation/api/status-codes">https://www.themoviedb.org/documentation/api/status-codes</a>
 * Additionally it contents Request and Response (if exists) objects.
 * @link https://www.themoviedb.org/documentation/api/status-codes
 * @author vlad.holovko@gmail.com
 */
class ApiException extends \Exception 
{
    /**
    * @var integer HTTP status code, such as 403, 404, 500, etc.
    */
   protected $httpStatusCode;
   
   protected $request;
   
   protected $response;

   /**
    * Constructor.
    * @param integer $status HTTP status code, such as 404, 500, etc.
    * @param string $message error message
    * @param integer $code error code
    */
   public function __construct($message, RequestInterface $request, $httpStatusCode = null, ResponseInterface $response = null, $code=0, \Exception $previous = null)
   {
        $this->httpStatusCode = $httpStatusCode;
        $this->request = $request;
        $this->response = $response;
        parent::__construct($message,$code,$previous);
   }
   
   /**
    * @return string HTTP status code
    */
   public function getStatusCode() 
   {
       return $this->httpStatusCode;       
   }
   
   /**
    * @return Request the Request object
    */
   public function getRequest()
   {
       return $this->request;
   }
   
   /**
    * @return Response the Response object
    */
   public function getResponse()
   {
       return $this->response;
   }
   
   /**
    * @return boolean whether an exception contains a Response object
    */
   public function hasResponse()
   {
       return null !== $this->response;
   }
}
