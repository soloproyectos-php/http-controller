<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controllers
 */
namespace soloproyectos\http;
use soloproyectos\event\EventMediator;

/**
 * Class HttpController.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
abstract class HttpController extends EventMediator
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->open($_REQUEST);
        $this->trigger($_SERVER["REQUEST_METHOD"], [$_REQUEST]);
        $this->close($_REQUEST);
    }
    
    /**
     * Opens the request.
     * 
     * This method is always called at the beggining of any request.
     * 
     * @return void
     */
    public function open()
    {
        // no-op
    }
    
    /**
     * Closes the request.
     * 
     * This function is always called at the end of any request.
     * 
     * @return void
     */
    public function close()
    {
        // no-op
    }
}
