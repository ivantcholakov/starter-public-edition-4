<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Template extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('template')
            ->helper('template')
        ;
    }

    public function __call($name, $arguments) {

        $template_data = & $this->parser_instance->getVariableRef(
            'template',
            $this->parser_instance->parser_data
        );

        return isset($template_data[$name]) ? $template_data[$name] : null;
    }

    public function file_partial() {

        ob_start();

        file_partial($this->get_attribute(0));

        return ob_get_clean();
    }

    public function partial() {

        ob_start();

        template_partial($this->get_attribute(0));

        return ob_get_clean();
    }

    public function has_partial() {

        return template_has_partial($this->get_attribute(0));
    }

}
