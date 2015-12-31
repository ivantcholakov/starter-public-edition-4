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

            if (in_array($name, array(
                'session_id',
                'ip_address',
                'id',
                'user_id',
                'group_id',
                'group',
                'username',
                'email',
            ))) {
                return;
            }

            $this->session->set_userdata($name, $value);

            return;
        }

        if ($name == 'session_id') {
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

            $this->session->set_flashdata($name, $value);

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

            $ttl = (int) $this->get_attribute(2, 300);

            $this->session->set_tempdata($name, $value, $ttl);

            return;
        }

        return $this->session->tempdata($name);
    }

}
