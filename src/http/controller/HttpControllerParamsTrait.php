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
 * Class HttpControllerParamsTrait.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
trait HttpControllerParamsTrait
{
    /**
     * Gets a parameter.
     *
     * @param string $name Parameter name
     *
     * @return mixed
     */
    public function getParam($name)
    {
        $param = Arr::get($_REQUEST, $name);

        if ($_SERVER["REQUEST_METHOD"] == "GET" && is_string($param)) {
            $param = urldecode($param);
        }

        return $param;
    }
    
    /**
     * Sets a parameter.
     *
     * @param string $name  Parameter name
     * @param mixed  $value Value.
     *
     * @return void
     */
    public function setParam($name, $value)
    {
        $_REQUEST[$name] = $value;
    }
    
    /**
     * Does the parameter exist?
     *
     * @param string $name Parameter name
     *
     * @return boolean
     */
    public function existParam($name)
    {
        return Arr::exist($_REQUEST, $name);
    }
    
    /**
     * Deletes a parameter.
     *
     * @param string $name HttpRequest attribute.
     *
     * @return void
     */
    public function deleteParam($name)
    {
        Arr::delete($_REQUEST, $name);
    }
}
