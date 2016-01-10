<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Template extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function __call($name, $arguments) {

        $template_data = & $this->parser_instance->getVariableRef(
            'template',
            $this->parser_instance->parser_data
        );

        return isset($template_data[$name]) ? $template_data[$name] : null;
    }

}
