<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class KCFinderConfig {

    protected static $config = array();

    final private function __construct() {}
    final private function __clone() {}

    public static function get($key) {

        $key = (string) $key;

        $key = trim(preg_replace('/[^A-Za-z0-9_\-]/', '', $key));

        if ($key == '') {
            $key = 'default';
        }

        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }

        $config_dir = APPPATH.'config/';

        $config = array();
        @ include $config_dir.'editor_filemanager_default.php';
        if ($key != 'default') {
            @ include $config_dir.'editor_filemanager_'.$key.'.php';
        }

        self::$config[$key] = $config;

        return self::$config[$key];
    }

}
