<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Lex_extensions {

    protected $loaded = array();

    public function __construct() {

        $this->ci = & get_instance();

        $this->ci->load->library('lex_parser_extender');
    }

    public function locate($name, $attributes, $content) {

        $scope_glue = $this->ci->lex_parser_extender->options['scope_glue'];

        if (strpos($name, $scope_glue) === false) {
            return false;
        }

        list($class, $method) = explode($scope_glue, $name);

        foreach (array(APPPATH, COMMONPATH) as $directory) {

            if (file_exists($path = $directory.'lex_extensions/'.$class.'.php')) {
                return $this->_process($path, $class, $method, $attributes, $content);
            }
        }
    }

    protected function _process($path, $class, $method, $attributes, $content) {

        $class = strtolower($class);
        $class_name = 'Lex_Extension_'.ucfirst($class);

        if (!isset($this->loaded[$class])) {

            include_once $path;
            $this->loaded[$class] = true;
        }

        if (!class_exists($class_name, false)) {

            log_message('error', 'Lex_Extension class "'.$class_name.'" does not exist.');
            return false;
        }

        $object = new $class_name;
        $object->set_path($path);
        $object->set_class($class);
        $object->set_method($method);
        $object->set_data($content, $attributes);

        if (
                $class == 'helper'
                && 
                (
                    $method == 'empty'
                    ||
                    $method == 'isset'
                )
        ) {
            $method = 'func_'.$method;
        }

        if (!is_callable(array($object, $method))) {

            if (property_exists($object, $method)) {
                return true;
            }

            log_message('error', 'Lex_Extension method "'.$method.'" does not exist on class "'.$class_name.'".');
            return false;
        }

        return call_user_func(array($object, $method));
    }

}
