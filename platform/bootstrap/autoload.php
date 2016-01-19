<?php

require COMMONPATH.'third_party/phpmailer/PHPMailerAutoload.php';
require COMMONPATH.'third_party/htmlpurifier/library/HTMLPurifier/Bootstrap.php';

spl_autoload_register('_common_autoloader');

/**
 * Automatically loads classes in PHP5 way, using SPL.
 * @param   string      $class              The class name, no namespaces are supported.
 * @return  bool                            TRUE if a class have been found and loaded, FALSE otherwise.
 * @author  Ivan Tcholakov, 2013
 * @license The MIT License
 */
function _common_autoloader($class) {

    static $locations = null;

    if (!isset($locations)) {

        $locations = array();
        $autoload = null;

        _autoload_classes_read_config($autoload, COMMONPATH.'config/autoload_classes.php');
        _autoload_classes_read_config($autoload, COMMONPATH.'config/'.ENVIRONMENT.'/autoload_classes.php');
        _autoload_classes_read_config($autoload, APPPATH.'config/autoload_classes.php');
        _autoload_classes_read_config($autoload, APPPATH.'config/'.ENVIRONMENT.'/autoload_classes.php');

        if (isset($autoload) && is_array($autoload) && isset($autoload['classes']) && is_array($autoload['classes'])) {
            $locations = $autoload['classes'];
        }
    }

    $class = (string) $class;

    // No class name? Abort.
    if ($class == '') {
        return false;
    }

    // Scanning for classes in specific directories (see the array above).
    if (isset($locations[$class])) {
        require $locations[$class];
        return true;
    }

    // Autoload CodeIgniter classes.

    if (strpos($class, 'CI_') === 0) {

        if (is_file($location = BASEPATH.'core/'.substr($class, 3).'.php')) {
            require $location;
            return true;
        }

        if (is_file($location = BASEPATH.'libraries/'.substr($class, 3).'.php')) {
            require $location;
            return true;
        }

        if (is_file($location = BASEPATH.'libraries/'.substr($class, 3).'/'.substr($class, 3).'.php')) {
            require $location;
            return true;
        }
    }

    // Autoload core classes.

    global $RTR;
    $module = null;

    if (is_object($RTR)) {
        $module = $RTR->fetch_module();
    }

    if ($module != '') {

        if (is_file($location = APPPATH."modules/$module/core/$class.php")) {
            require $location;
            return true;
        }

        if (is_file($location = COMMONPATH."modules/$module/core/$class.php")) {
            require $location;
            return true;
        }
    }

    if (is_file($location = APPPATH."core/$class.php")) {
        require $location;
        return true;
    }

    if (is_file($location = COMMONPATH."core/$class.php")) {
        require $location;
        return true;
    }

    // Autoload Modular Extensions MX core classes.
    if (strpos($class, 'MX_') === 0 && is_file($location = COMMONPATH.'third_party/MX/'.substr($class, 3).'.php')) {
        require $location;
        return true;
    }

    // Autoload library classes.

    if (is_file($location = APPPATH."libraries/$class.php")) {
        require $location;
        return true;
    }

    if (is_file($location = COMMONPATH."libraries/$class.php")) {
        require $location;
        return true;
    }

    // Autoload models (that are extended by other models).

    if (is_file($location = APPPATH."models/$class.php")) {
        require $location;
        return true;
    }

    if (is_file($location = COMMONPATH."models/$class.php")) {
        require $location;
        return true;
    }

    // Autoload custom classes, non-standard way.

    if (is_file($location = APPPATH."classes/$class.php")) {
        require $location;
        return true;
    }

    if (is_file($location = COMMONPATH."classes/$class.php")) {
        require $location;
        return true;
    }

    // PSR-0 autoloading.

    if (is_file($location = APPPATH.'classes/'.str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $class).'.php')) {
        require $location;
        return true;
    }

    if (is_file($location = COMMONPATH.'classes/'.str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $class).'.php')) {
        require $location;
        return true;
    }

    // Autoload HTMLPurifier classes.
    if (HTMLPurifier_Bootstrap::autoload($class)) {
        return true;
    }

    // Autoload PEAR packages that are integrated in this platform.
    if (is_file($location = COMMONPATH.'third_party/pear/'.str_replace('_', DIRECTORY_SEPARATOR, $class).'.php')) {
        require $location;
        return true;
    }

    return false;
}

/**
 * Merges information from autoload_classes.php configuration files in different locations.
 * @param   null|array  $config_output      The result array (output parameter).
 * @param   string      $config_file        The current configuration file autoload_classes.php (a full path).
 * @return  void
 * @author  Ivan Tcholakov, 2013
 * @license The MIT License
 */
function _autoload_classes_read_config(& $config_output, $config_file) {

    if (file_exists($config_file)) {

        include($config_file);

        if (isset($autoload) && is_array($autoload)) {

            if (!isset($config_output) || !is_array($config_output)) {
                $config_output = array();
            }

            $config_output = array_merge_recursive($config_output, $autoload);
        }
    }
}
