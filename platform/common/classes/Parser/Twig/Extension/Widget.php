<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Widget {

    public static function widget() {

        $args = func_get_args();

        ob_start();

        echo call_user_func_array(array('Modules', 'run'), $args);

        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    public static function run() {

        $args = func_get_args();

        // Return data directly.
        return call_user_func_array(array('Modules', 'run'), $args);
    }

}
