<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class CKEditorConfig {

    protected static $config = array();

    final private function __construct() {}
    final private function __clone() {}

    public static function get($editor_config_key = null, $editor_toolbar_key = null) {

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

        // Get editor's configureation.

        $ci = get_instance();

        $config = array();

        $ci->config->load('editor_default', true, true);
        $config_default = $ci->config->item('editor_default');

        if (!is_array($config_default)) {
            $config_default = array();
        }

        if ($editor_config_key != 'default') {

            $ci->config->load('editor_'.$editor_config_key, true, true);
            $config = $ci->config->item('editor_'.$editor_config_key);

            if (!is_array($config)) {
                $config = array();
            }
        }

        $config = array_replace_recursive($config_default, $config);

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

        // Get toolbar configuration.

        $ci->config->load('editor_toolbar_'.$editor_toolbar_key, true, true);
        $config = $ci->config->item('editor_toolbar_'.$editor_toolbar_key);

        if (!is_array($config)) {
            $config = array();
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
