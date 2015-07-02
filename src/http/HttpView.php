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
use soloproyectos\http\exception\HttpException;
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
     * This method captures any error thrown by the controller and appends it to the request header.
     * 
     * @return mixed
     */
    public function document()
    {
        $ret = "";
        
        // processes the request
        $exception = null;
        try {
            $this->controller->apply();
        } catch (Exception $e) {
            $exception = $e;
        }
        
        // gets the document body
        if ($exception === null || $exception instanceof HttpException) {
            try {
                $ret = $this->getDocument();
            } catch (Exception $e) {
                $exception = $e;
            }
        }
        
        // prepends the error message
        $message = "";
        if ($exception !== null) {
            $code = $exception instanceof HttpException? "400": "500";
            $message = $exception->getMessage();
            header("HTTP/1.0 $code $message");
        }
        
        return $ret;
    }
}
