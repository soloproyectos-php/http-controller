<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controllers
 */
namespace soloproyectos\http\controller;
use soloproyectos\event\EventMediator;
use soloproyectos\http\controller\HttpControllerParamTrait;
use soloproyectos\http\controller\HttpControllerSessionTrait;
use soloproyectos\http\controller\HttpControllerCookieTrait;

/**
 * Class HttpController.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
class HttpController
{
    use HttpControllerParamTrait;
    use HttpControllerSessionTrait;
    use HttpControllerCookieTrait;
    
    /**
     * Open request name for internal purpose.
     * @var string
     */
    private $_openRequestName;
    
    /**
     * Close request name for internal purpose.
     * @var string
     */
    private $_closeRequestName;
    
    /**
     * Event mediator.
     * @var EventMediator
     */
    private $_event;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_event = new EventMediator();
        $this->_openRequestName = uniqid("OPEN_");
        $this->_closeRequestName = uniqid("CLOSE_");
    }
    
    /**
     * Registers a request handler.
     * 
     * @param string   $method  Request method (usually GET or POST)
     * @param Callable $handler Request handler
     * 
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods
     * @return void
     */
    public function addRequestHandler($method, $handler)
    {
        $this->_event->on($method, $handler);
    }
    
    /**
     * Registers a GET request handler.
     * 
     * @param Callable $handler Request handler
     * 
     * @return void
     */
    public function addGetRequestHandler($handler)
    {
        $this->addRequestHandler("GET", $handler);
    }
    
    /**
     * Registers a POST request handler.
     * 
     * @param Callable $handler Request handler
     * 
     * @return void
     */
    public function addPostRequestHandler($handler)
    {
        $this->addRequestHandler("POST", $handler);
    }
    
    /**
     * Registers an 'open handler'.
     * 
     * When adding an 'open handler' it is processed before any other request.
     * This is a good place to initializa variables, such as database
     * connections, etc...
     * 
     * @param Callable $handler Request handler
     * 
     * @return void
     */
    public function addOpenRequestHandler($handler)
    {
        $this->addRequestHandler($this->_openRequestName, $handler);
    }
    
    /**
     * Add a 'close' handler.
     * 
     * When adding a 'close handler' it is called after any other request.
     * This is a good place to free resources, such as database connections,
     * etc...
     * 
     * @param Callable $handler Request handler
     * 
     * @return void
     */
    public function addCloseRequestHandler($handler)
    {
        $this->addRequestHandler($this->_closeRequestName, $handler);
    }
    
    /**
     * Processes the HTTP request.
     * 
     * @return void
     */
    public function processRequest()
    {
        $this->_event->trigger($this->_openRequestName);
        $this->_event->trigger($_SERVER["REQUEST_METHOD"]);
        $this->_event->trigger($this->_closeRequestName);
    }
}
