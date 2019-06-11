<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Format extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load->parser();
    }

    public function markdown() {

        return $this->parser->parse_string(trim($this->get_attribute(0, $this->get_content())), null, true, 'markdown');
    }

    public function textile() {

        return $this->parser->parse_string(trim($this->get_attribute(0, $this->get_content())), null, true, 'textile');
    }

}
