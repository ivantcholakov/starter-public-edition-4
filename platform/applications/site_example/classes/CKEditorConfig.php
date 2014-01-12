<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class CKEditorConfig {

    protected static $config = array();

    final private function __construct() {}
    final private function __clone() {}

    public static function get($editor_config_key, $editor_toolbar_key = null) {

        $editor_config_key = (string) $editor_config_key;
        $editor_toolbar_key = (string) $editor_toolbar_key;

        $editor_config_key = trim(preg_replace('/[^A-Za-z0-9_\-]/', '', $editor_config_key));
        $editor_toolbar_key = trim(preg_replace('/[^A-Za-z0-9_\-]/', '', $editor_toolbar_key));

        if ($editor_config_key == '') {
            $editor_config_key = 'default';
        }

        $key = $editor_config_key;
        if ($editor_toolbar_key != '') {
            $key .= '_'.$editor_toolbar_key;
        } else {
            $editor_toolbar_key = $editor_config_key;
        }

        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }

        $config_dir = APPPATH.'config/';

        $config = array();
        @ include $config_dir.'editor_default.php';
        if ($editor_config_key != 'default') {
            @ include $config_dir.'editor_'.$editor_config_key.'.php';
        }
        if (empty($config['config']['fullPage'])) {
            if (isset($config['config']['contentsCss'])) {
                if (!is_array($config['config']['contentsCss'])) {
                    $config['config']['contentsCss'] = (array) $config['config']['contentsCss'];
                }
            } else {
                $config['config']['contentsCss'] = array();
            }
        }
        self::$config[$key] = $config;

        $config = array();
        if (file_exists($config_dir.'editor_toolbar_'.$editor_toolbar_key.'.php')) {
            @ include $config_dir.'editor_toolbar_'.$editor_toolbar_key.'.php';
        } else {
            @ include $config_dir.'editor_toolbar_default.php';
        }
        self::$config[$key]['config']['toolbar'] = $editor_toolbar_key;
        self::$config[$key]['config']['toolbar_'.$editor_toolbar_key] = $config;

        return self::$config[$key];
    }

    public static function set_read_only(& $config) {

        if (!is_array($config)) {
            return;
        }

        if (!isset($config['config']) || !is_array($config['config'])) {
            return;
        }

        $config['config']['readOnly'] = true;
    }

}
