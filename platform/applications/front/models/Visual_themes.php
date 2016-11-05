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

        $this->session_key = 'visual_theme';

        $this->items = array(
            array(
                'key' => 'front_semantic_ui_default',
                'name' => 'Semantic UI Default',
            ),
            array(
                'key' => 'front_semantic_ui_amazon',
                'name' => 'Semantic UI Amazon',
            ),
            array(
                'key' => 'front_semantic_ui_basic',
                'name' => 'Semantic UI Basic',
            ),
            array(
                'key' => 'front_semantic_ui_chubby',
                'name' => 'Semantic UI Chubby',
            ),
            array(
                'key' => 'front_semantic_ui_classic',
                'name' => 'Semantic UI Classic',
            ),
            array(
                'key' => 'front_semantic_ui_flat',
                'name' => 'Semantic UI Flat',
            ),
            array(
                'key' => 'front_semantic_ui_github',
                'name' => 'Semantic UI GitHub',
            ),
            array(
                'key' => 'front_semantic_ui_material',
                'name' => 'Semantic UI Material',
            ),
        );
    }

    public function get_default() {

        $keys = $this->get_all_keys();

        if (empty($keys)) {
            return null;
        }

        return $keys[0];
    }

    public function get_current() {

        $result = $this->session->userdata($this->session_key);

        if ($result != '') {
            return $result;
        }

        return $this->get_default();
    }

    public function set_current($key) {

        $key = (string) $key;
        $keys = $this->get_all_keys();

        if (in_array($key, $keys)) {
            $this->session->set_userdata($this->session_key, $key);
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
