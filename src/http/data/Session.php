<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
namespace soloproyectos\http\data;
use soloproyectos\arr\Arr;
use soloproyectos\http\data\DataInterface;
use soloproyectos\http\exception\HttpException;

/**
 * Class Session
 *
 * @package Http\Data
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
class Session implements DataInterface
{
    /**
     * Gets a request attribute.
     *
     * @param string $name    Request attribute.
     * @param string $default Default value (not required)
     *
     * @return mixed
     */
    public function get($name, $default = "")
    {
        Session::start();
        return Arr::get($_SESSION, $name, $default);
    }

    /**
     * Sets a request attribute.
     *
     * @param string $name  Request attribute.
     * @param mixed  $value Request value.
     *
     * @return void
     */
    public function set($name, $value)
    {
        Session::start();

        if (!preg_match("/^[\_a-z]/i", $name)) {
            throw new HttpException("Invalid session attribute: $name");
        }

        $_SESSION[$name] = $value;
    }

    /**
     * Does the request attribute exist?
     *
     * @param string $name Request attribute.
     *
     * @return boolean
     */
    public function exist($name)
    {
        Session::start();
        return Arr::is($_SESSION, $name);
    }

    /**
     * Deletes a request attribute.
     *
     * @param string $name Request attribute.
     *
     * @return void
     */
    public function delete($name)
    {
        Session::start();
        Arr::del($_SESSION, $name);
    }

    /**
     * Deletes all session variables.
     *
     * @return void
     */
    public static function clear()
    {
        Session::start();
        session_unset();
    }

    /**
     * Starts a session, if not already started.
     *
     * @return void
     */
    public static function start()
    {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * Saves data and closes the current session.
     *
     * @return void
     */
    public static function close()
    {
        Session::start();
        session_write_close();
    }
}
