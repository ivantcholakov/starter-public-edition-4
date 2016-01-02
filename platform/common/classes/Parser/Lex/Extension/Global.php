<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Global extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function __call($name, $data) {

        $name = trim(@ (string) $name);

        if ($this->_is_global_allowed($name)) {

            if (defined(strtoupper($name))) {

                return constant(strtoupper($name));
            }

            if (isset(get_instance()->{$name}) && is_scalar($this->{$name})) {

                return $this->{$name};
            }
        }

        return null;
    }

}
