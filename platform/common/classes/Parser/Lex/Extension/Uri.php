<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Uri extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load->helper('url');
    }

    public function current() {

        return CURRENT_URI;
    }

    public function site() {

        return site_uri($this->get_attribute(0));
    }

    public function base() {

        return base_uri($this->get_attribute(0));
    }

}
