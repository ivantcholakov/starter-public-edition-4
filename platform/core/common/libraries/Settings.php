<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Settings {

    protected $settings = null;

    protected $ci = null;
    protected $settings_model = null;

    public function __construct() {

        $this->ci = get_instance();

        $this->ci->load->model('settings_model');
        $this->settings_model = $this->ci->settings_model;

        $this->get_all();
    }

    public function get_all() {

        if (is_array($this->settings)) {
            return $this->settings;
        }

        $this->settings = array();

        if (!$this->settings_model->table_exists()) {
            return false;
        }

        $data = ci()->settings_model
            ->select('name, value')
            ->order_by('id')
            ->find();

        if (!empty($data)) {

            foreach ($data as $item) {

                if (is_string($item['value']) && is_numeric($item['value'])) {

                    if (ctype_digit($item['value'])) {

                        if (strlen($item['value']) == 1 || strpos($item['value'], '0') !== 0) {
                            $this->settings[$item['name']] = (int) $item['value'];
                        } else {
                            $this->settings[$item['name']] = $item['value'];
                        }

                    } else {

                        $this->settings[$item['name']] = (double) $item['value'];
                    }

                } else {

                    $this->settings[$item['name']] = $item['value'];
                }
            }
        }

        return $this->settings;
    }

    public function get($name) {

        if (is_array($name)) {

            $result = array();

            foreach ($name as $key) {
                $result[$key] = $this->get($key);
            }

            return $result;
        }

        $name = (string) $name;

        if ($name == '') {
            return null;
        }

        if (array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }

        return $this->ci->config->item($name);
    }

}
