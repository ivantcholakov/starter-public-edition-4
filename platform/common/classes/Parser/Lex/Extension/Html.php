<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Html extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function escape() {

        return html_escape($this->get_attribute(0, $this->get_content()));
    }

}
