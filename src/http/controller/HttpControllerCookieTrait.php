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

/**
 * Class HttpControllerCookieTrait.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
trait HttpControllerCookieTrait
{
    /**
     * By default the cookie expires in one year (365 * 24 * 60 * 60 seconds)
     */
    private $_defaultExpirationTime = 31536000;

    /**
     * Gets a cookie.
     *
     * @param string $name     Cookie name
     * @param mixed  $defValue Default value (not required)
     *
     * @return mixed
     */
    public function getCookie($name, $defValue = null)
    {
        return Arr::get($_COOKIE, $name, $defValue);
    }

    /**
     * Sets a cookie.
     *
     * @param string  $name           Cookie name
     * @param mixed   $value          Value
     * @param integer $expirationTime Expiration time in seconds (default is
     *                                one year)
     *
     * @return void
     */
    public function setCookie($name, $value, $expirationTime = null)
    {
        if ($expirationTime === null) {
            $expirationTime = $this->_defaultExpirationTime;
        }
        
        setcookie($name, $value, time() + $expirationTime, "/");
    }

    /**
     * Does the exist exist?
     *
     * @param string $name Request attribute.
     *
     * @return boolean
     */
    public function existCookie($name)
    {
        return Arr::exist($_COOKIE, $name);
    }

    /**
     * Deletes a cookie.
     *
     * @param string $name Request attribute.
     *
     * @return void
     */
    public function deleteCookie($name)
    {
        setcookie($name, "", time() - 3600, "/");
        Arr::delete($_COOKIE, $name);
    }
}
