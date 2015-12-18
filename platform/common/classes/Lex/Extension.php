<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

abstract class Lex_Extension {

    public function __get($variable) {

        $ci = & get_instance();

        if (isset($ci->$variable)) {
            return $ci->$variable;
        }

        return null;
    }

}
