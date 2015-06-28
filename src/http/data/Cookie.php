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

/**
 * Class Cookie.
 *
 * @package Http\Data
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
class Cookie implements DataInterface
{
    /**
     * By default the cookie expires in one year (365 * 24 * 60 * 60 seconds)
     */
    const DEFAULT_EXPIRATION_TIME = 31536000;

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
        return Arr::get($_COOKIE, $name, $default);
    }

    /**
     * Sets a request attribute.
     *
     * @param string $name           Request attribute.
     * @param mixed  $value          Request value.
     * @param int    $expirationTime Expiration time (default is one year)
     *
     * @return void
     */
    public function set(
        $name,
        $value,
        $expirationTime = Cookie::DEFAULT_EXPIRATION_TIME
    ) {
        setcookie($name, $value, time() + $expirationTime, "/");
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
        return Arr::is($_COOKIE, $name);
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
        setcookie($name, "", time() - 3600, "/");
        Arr::del($_COOKIE, $name);
    }
}
