<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Extension_Language {

    public static function lang() {

        $args = func_get_args();

        if (count($args) < 1) {
            return null;
        }

        $ci = & get_instance();

        $line = $args[0];

        if (count($args) == 1) {
            return $ci->lang->line($line);
        }

        $params = array_slice($args, 1);

        return $ci->lang->line($line, $params);
    }

}
