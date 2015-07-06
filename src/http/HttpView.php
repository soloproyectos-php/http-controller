<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controllers
 */
namespace soloproyectos\http;
use \Exception;
use soloproyectos\http\exception\HttpClientException;
use soloproyectos\http\HttpController;

/**
 * Abstract base class of views.
 *
 * @package Admin\View
 * @author  Axis-Studios <info@axis-studios.com>
 * @license Proprietary License
 * @link    https://github.com/AxisStudios/syntheticpictures-admin
 */
abstract class HttpView
{
    /**
     * HTTP Controller.
     * @var HttpController
     */
    protected $controller = null;
    
    /**
     * Constructor.
     * 
     * @param HttpController $controller HTTP Controller
     */
    public function __construct($controller)
    {
        $this->controller = $controller;
    }
    
    /**
     * Gets the document.
     * 
     * @return mixed
     */
    abstract public function getDocument();
    
    /**
     * Makes the document.
     * 
     * This method processes the HTTP request and makes the document. Any error thrown by the controller
     * or the 'getDocument' method is captured and returned as a HTTP status code.
     * 
     * @return mixed
     */
    public function document()
    {
        $ret = "";
        $exception = null;
        
        // processes the request
        try {
            $this->controller->apply();
        } catch (Exception $e) {
            $exception = $e;
        }
        
        // gets the document body
        if ($exception === null || $exception instanceof HttpClientException) {
            try {
                $ret = $this->getDocument();
            } catch (Exception $e) {
                $exception = $e;
            }
        }
        
        // attaches the error message
        if ($exception !== null) {
            $code = $exception instanceof HttpClientException
                ? "400"     // client-side error
                : "500";    // server-side error
            $message = $exception->getMessage();
            header("HTTP/1.0 $code $message");
        }
        
        return $ret;
    }
}
