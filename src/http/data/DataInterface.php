<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
namespace soloproyectos\http\data;

/**
 * Class DataInterface.
 *
 * @package Http\Data
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
interface DataInterface
{
    /**
     * Gets an attribute value.
     * 
     * @param string $name    Attribute name
     * @param mixed  $default Default value
     * 
     * @return void
     */
    function get($name, $default = "");
    
    /**
     * Sets an attribute value.
     * 
     * @param string $name  Attribute name
     * @param mixed  $value Value
     * 
     * @return void
     */
    function set($name, $value);
    
    /**
     * Does the attribute exist?
     * 
     * @param string $name Attribute name
     * 
     * @return boolean
     */
    function exist($name);
    
    /**
     * Deletes an attribute.
     * 
     * @param string $name Attribute name
     * 
     * @return void
     */
    function delete($name);
}
