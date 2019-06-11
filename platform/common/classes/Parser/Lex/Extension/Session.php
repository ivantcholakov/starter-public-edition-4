<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Session extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function data() {

        $name = $this->get_attribute(0);

        if (!isset($name)) {
            return;
        }

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        $no_value = new Parser_Lex_No_Value;
        $value = $this->get_attribute(1, $no_value);

        if ($value !== $no_value) {

            if ($this->parser->is_blacklisted_session_variable($name) || $this->parser->is_read_only_session_variable($name)) {
                return;
            }

            $this->session->set_userdata($name, $value);

            return;
        }

        if ($this->parser->is_blacklisted_session_variable($name)) {
            return;
        }

        return $this->session->userdata($name);
    }

    public function flash() {

        $name = $this->get_attribute(0);

        if (!isset($name)) {
            return;
        }

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        $no_value = new Parser_Lex_No_Value;
        $value = $this->get_attribute(1, $no_value);

        if ($value !== $no_value) {

            if ($this->parser->is_blacklisted_session_variable($name) || $this->parser->is_read_only_session_variable($name)) {
                return;
            }

            $this->session->set_flashdata($name, $value);

            return;
        }

        if ($this->parser->is_blacklisted_session_variable($name)) {
            return;
        }

        return $this->session->flashdata($name);
    }

    public function temp() {

        $name = $this->get_attribute(0);

        if (!isset($name)) {
            return;
        }

        $name = trim(@ (string) $name);

        if ($name == '') {
            return;
        }

        $no_value = new Parser_Lex_No_Value;
        $value = $this->get_attribute(1, $no_value);

        if ($value !== $no_value) {

            if ($this->parser->is_blacklisted_session_variable($name) || $this->parser->is_read_only_session_variable($name)) {
                return;
            }

            $ttl = $this->get_attribute(2, 300);

            if (!is_numeric($ttl)) {
                $ttl = 300;
            }

            $ttl = (int) $ttl;

            $this->session->set_tempdata($name, $value, $ttl);

            return;
        }

        if ($this->parser->is_blacklisted_session_variable($name)) {
            return;
        }

        return $this->session->tempdata($name);
    }

}
