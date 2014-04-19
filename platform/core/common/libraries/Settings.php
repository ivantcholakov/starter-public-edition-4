<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Settings {

    protected $settings;

    protected $ci;
    protected $settings_model;

    public function __construct() {

        $this->ci = get_instance();

        $this->ci->load->model('settings_model');
        $this->settings_model = $this->ci->settings_model;

        $this->ci->load->helper('settings');

        $this->refresh();
    }

    // Reads all the setting from database only.
    public function get_all() {

        if (!$this->settings_model->table_exists()) {
            return false;
        }

        return $this->settings;
    }

    // Reads a setting from the database.
    // If the settings is not found, then a setting from the configuration
    // files under the same name will be tried to be returned.
    public function get($key) {

        if (is_array($key)) {

            $result = array();

            foreach ($key as $k) {
                $result[$k] = $this->get($k);
            }

            return $result;
        }

        $key = (string) $key;

        if ($key == '') {
            return null;
        }

        if (array_key_exists($key, $this->settings)) {
            return $this->settings[$key];
        }

        return $this->ci->config->item($key);
    }

    // Sets a database stored setting.
    // Database table should be created in order to use this method.
    // See Settings_model class for information about table structure.
    public function set($key, $value = null) {

        if (is_array($key)) {

            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }

            return $this;
        }

        $key = (string) $key;

        if ($key == '') {
            return $this;
        }

        $id = $this->settings_model->select('id')->where('name', $key)->as_value()->first();
        $data = array('name' => $key, 'value' => $value);

        if ($id === null) {
            $this->settings_model->insert($data);
        } else {
            $this->settings_model->update((int) $id, $data);
        }

        return $this;
    }

    // Reads all the settings from database and holds them within memory.
    public function refresh() {

        $this->settings = array();

        if (!$this->settings_model->table_exists()) {
            return $this;
        }

        $data = ci()->settings_model
            ->select('name, value')
            ->order_by('id')
            ->find();

        if (!empty($data)) {

            foreach ($data as $item) {

                $name = (string) $item['name'];
                $value = $item['value'];

                // Just in case, skip missing or duplicate keys.
                if ($name == '' || isset($this->settings[$name])) {
                    continue;
                }

                if (is_string($value) && is_numeric($value)) {

                    if (ctype_digit($value)) {

                        if (strlen($value) == 1 || strpos($value, '0') !== 0) {
                            $this->settings[$name] = (int) $value;
                        } else {
                            $this->settings[$name] = $value;
                        }

                    } else {

                        $this->settings[$name] = (double) $value;
                    }

                } else {

                    $this->settings[$name] = $value;
                }
            }
        }

        return $this;
    }

}
