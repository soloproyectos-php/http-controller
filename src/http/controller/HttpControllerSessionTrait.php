<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controllers
 */
namespace soloproyectos\http\controller;
use soloproyectos\arr\Arr;
use soloproyectos\http\exception\HttpException;

/**
 * Class HttpControllerSessionTrait.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
trait HttpControllerSessionTrait
{
    /**
     * Gets a session attribute.
     *
     * @param string $name Attribute name
     *
     * @return mixed
     */
    public function getSession($name)
    {
        $this->_startSession();
        return Arr::get($_SESSION, $name);
    }

    /**
     * Sets a session attribute.
     *
     * @param string $name  Attribute name
     * @param mixed  $value Value
     *
     * @return void
     */
    public function setSession($name, $value)
    {
        $this->_startSession();

        if (!preg_match("/^[\_a-z]/i", $name)) {
            throw new HttpException("Invalid session attribute: $name");
        }

        $_SESSION[$name] = $value;
    }

    /**
     * Does the session attribute exist?
     *
     * @param string $name Attribute name
     *
     * @return boolean
     */
    public function existSession($name)
    {
        $this->_startSession();
        return Arr::is($_SESSION, $name);
    }

    /**
     * Deletes a session attribute.
     *
     * @param string $name Attribute name
     *
     * @return void
     */
    public function deleteSession($name)
    {
        $this->_startSession();
        Arr::delete($_SESSION, $name);
    }

    /**
     * Starts a session, if not already started.
     *
     * @return void
     */
    private function _startSession()
    {
        if (!session_id()) {
            session_start();
        }
    }
}
