<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Note: Storing the current theme is within a session variable.
 * Rework or extend this class in order to change where the current theme is to be stored.
 */

class Visual_themes extends CI_Model {

    protected $session_key;
    protected $items;

    public function __construct() {

        parent::__construct();

        $this->session_key = 'admin_visual_theme';

        $this->items = array(
            array(
                'key' => 'admin_default_18',
                'name' => 'Font 18px',
            ),
            array(
                'key' => 'admin_default_17',
                'name' => 'Font 17px',
            ),
            array(
                'key' => 'admin_default',
                'name' => 'Font 16px',
            ),
            array(
                'key' => 'admin_default_15',
                'name' => 'Font 15px',
            ),
            array(
                'key' => 'admin_default_14',
                'name' => 'Font 14px',
            ),
        );
    }

    public function get_default() {

        $keys = $this->get_all_keys();

        if (empty($keys)) {
            return null;
        }

        return $keys[2];
    }

    public function get_current() {

        // Modified by Ivan Tcholakov, 28-OCT-2017.
        //$result = $this->session->userdata($this->session_key);
        $result = $this->input->cookie($this->session_key);
        $this->input->set_cookie($this->session_key, (string) $result, 31536000);
        //

        if ($result != '') {
            return $result;
        }

        return $this->get_default();
    }

    public function set_current($key) {

        $key = (string) $key;
        $keys = $this->get_all_keys();

        if (in_array($key, $keys)) {
            // Modified by Ivan Tcholakov, 28-OCT-2017.
            //$this->session->set_userdata($this->session_key, $key);
            $this->input->set_cookie($this->session_key, (string) $key, 31536000);
            //
        }
    }

    public function get_all() {

        return empty($this->items) ? array() : $this->items;
    }

    public function get_all_keys() {

        $items = $this->get_all();

        if (empty($items)) {
            return array();
        }

        return array_column($items, 'key');
    }

}
