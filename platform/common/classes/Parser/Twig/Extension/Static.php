<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// See http://blog.alterphp.com/2016/02/access-static-methodsproperties-from.html

class Parser_Twig_Extension_Static {

    public static function call_static($class, $method) {

        $args = func_get_args();

        if (count($args) < 2) {
            return null;
        }

        array_shift($args);
        array_shift($args);

        $refl = new reflectionClass($class);

        if (
                $refl->hasMethod($method)
                &&
                $refl->getMethod($method)->isStatic()
                &&
                $refl->getMethod($method)->isPublic()
        ) {

            return call_user_func_array($class.'::'.$method, $args);
        }

        throw new RuntimeException('Invalid static method call for class '.$class.' and method '.$method);
    }

    public static function get_static($class, $property) {

        $refl = new reflectionClass($class);

        if (
                $refl->hasProperty($property)
                &&
                $refl->getProperty($property)->isStatic()
                &&
                $refl->getProperty($property)->isPublic()
        ) {

            return $refl->getProperty($property)->getValue();
        }

        throw new RuntimeException('Invalid static property get for class '.$class.' and property '.$property);
    }

}
