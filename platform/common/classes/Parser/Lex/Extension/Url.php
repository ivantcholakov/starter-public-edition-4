<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Url extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load->helper('url');
    }

    public function current() {

        return CURRENT_URL;
    }

    public function uri_string() {

        return CURRENT_URI_STRING;
    }

    public function query_string() {

        return CURRENT_QUERY_STRING;
    }

    public function get() {

        $this->detect_boolean_attributes(array(1));

        return $this->input->get($this->get_attribute(0), (bool) $this->get_attribute(1));
    }

    public function site() {

        return site_url($this->get_attribute(0));
    }

    public function base() {

        return base_url($this->get_attribute(0));
    }

}
