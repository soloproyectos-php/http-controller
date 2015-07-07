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

/**
 * Class HttpController.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
class HttpController extends EventMediator
{
    use HttpControllerParamTrait;
    use HttpControllerSessionTrait;
    
    /**
     * Initializes the controller.
     * 
     * This method is called at the beggining of the request.
     * 
     * @param string[] $params Request parameters
     * 
     * @return void
     */
    public function init($params)
    {
        // No-Op
    }
    
    /**
     * Processes the request.
     * 
     * @return void
     */
    public function apply()
    {
        $this->init($_REQUEST);
        $this->trigger($_SERVER["REQUEST_METHOD"], [$_REQUEST]);
    }
}
