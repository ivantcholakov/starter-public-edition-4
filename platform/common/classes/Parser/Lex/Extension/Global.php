<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Global extends Parser_Lex_Extension {

    protected $parser_allowed_globals;

    public function __construct() {

        parent::__construct();

        $this->parser_allowed_globals =
            isset($this->extension_config['allowed_globals'])
                ? $this->extension_config['allowed_globals']
                : array();
    }

    public function __call($name, $data) {

        if (in_array(strtolower($name), array_map('strtolower', $this->parser_allowed_globals))) {

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
