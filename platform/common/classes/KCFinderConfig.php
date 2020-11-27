<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class KCFinderConfig {

    protected static $config = array();

    public static function get($key) {

        $key = (string) $key;

        $key = trim(preg_replace('/[^A-Za-z0-9_\-]/', '', $key));

        if ($key == '') {
            $key = 'default';
        }

        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }

        $ci = get_instance();

        $config = array();

        $ci->config->load('editor_filemanager_default', true, true);
        $config_default = $ci->config->item('editor_filemanager_default');

        if (!is_array($config_default)) {
            $config_default = array();
        }

        if ($key != 'default') {

            $ci->config->load('editor_filemanager_'.$key, true, true);
            $config = $ci->config->item('editor_filemanager_'.$key);

            if (!is_array($config)) {
                $config = array();
            }
        }

        $config = array_replace_recursive($config_default, $config);

        self::$config[$key] = $config;

        return self::$config[$key];
    }

}
