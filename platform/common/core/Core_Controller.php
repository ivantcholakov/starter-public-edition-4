<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends MX_Controller {

    public $module;
    public $controller;
    public $method;

    public $parse_i18n;

    /* Common module extender object  (Xavier Perez) */
    protected $common_module_extender;

    public function __construct() {

        parent::__construct();

        $ci = get_instance();

        $this->module = $this->router->fetch_module();
        $this->controller = $this->router->class;
        $this->method = $this->router->method;

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;    // Hack to make form validation work properly with HMVC.
                                                // See https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home

        // See http://devzone.zend.com/1441/zend-framework-and-translation/
        $this->parse_i18n = (bool) $this->config->item('parse_i18n');

        $this->load
            ->library('registry')
            ->library('settings')
            ->helper('url')
            ->helper('language')
            ->helper('language_extra')
            ->language('ui')
        ;
    }

    // --------------------------------------------------------------

    /**
     * Generic callback used to call callback methods for form validation.
     *
     * @param string
     *        - the value to be validated
     * @param string
     *        - a comma separated string that contains the model name, method name
     *          and any optional values to send to the method as a single parameter.
     *          First value is the name of the model.
     *          Second value is the name of the method.
     *          Any additional values are values to be send in an array to the method.
     *
     *      EXAMPLE RULE:
     *  callback_external_callbacks[some_model,some_method,some_string,another_string]
     *
     * @author skunkbad (forum alias), http://ellislab.com/forums/member/93974/
     * @link http://ellislab.com/forums/viewthread/205469/
     * @link https://gist.github.com/1503599
     *
     * CodeIgniter 2.1.0 form validation external callbacks.
     *
     * This is part of MY_Controller.php in Community Auth, which is an open
     * source authentication application for CodeIgniter 2.1.0
     *
     * @package     Community Auth
     * @author      Robert B Gottier
     * @copyright   Copyright (c) 2011, Robert B Gottier.
     * @license     BSD - http://http://www.opensource.org/licenses/BSD-3-Clause
     * @link        http://community-auth.com
     */
    public function external_callbacks( $postdata, $param ) {

        $param_values = explode( ',', $param );

        // Make sure the model is loaded.
        $model = $param_values[0];
        $this->load->model( $model );

        // Rename the second element in the array for easy usage.
        // Modified by Ivan Tcholakov, 27-NOV-2012.
        //$method = $param_values[1];
        $method = trim($param_values[1]);
        //

        // Check to see if there are any additional values to send as an array.
        if ( count( $param_values ) > 2 ) {

            // Remove the first two elements in the param_values array.
            array_shift( $param_values );
            array_shift( $param_values );

            $argument = $param_values;
        }

        // Do the actual validation in the external callback.
        if ( isset( $argument ) ) {
            $callback_result = $this->$model->$method( $postdata, $argument );
        } else {
            $callback_result = $this->$model->$method( $postdata );
        }

        return $callback_result;
    }

    // --------------------------------------------------------------

    /**
     * Customizations by Xavier Perez
     * @link https://bitbucket.org/xperez/codeigniter-cross-modular-extensions-xhmvc
     * @link http://www.4amics.com/x.perez/2013/06/xhmvc-common-modular-extensions/
     */

    /**
     * Get properties from the common module, otherwise, from $APP
     *
     * @param type $myVar
     * @return var
     * @throws Exception
     */
    public function __get($myVar)
    {
        if (isset($this->common_module_extender) && (isset($this->common_module_extender->$myVar) || property_exists($this->common_module_extender, $myVar))) {
            return $this->common_module_extender->$myVar;
        }

        if (isset(CI::$APP->$myVar) || property_exists(CI::$APP, $myVar)) {
            return CI::$APP->$myVar;
        }

        throw new Exception('There is no such property: ' . $myVar);
    }

    /**
     * Set properties to a var inside the common module, only if exists
     *
     * @param type $myVar
     * @param type $myValue
     */
    public function __set($myVar, $myValue = '')
    {
        if (isset($this->common_module_extender) && (isset($this->common_module_extender->$myVar) || property_exists($this->common_module_extender, $myVar))) {
            $this->common_module_extender->$myVar = $myValue;
        } else {
            CI::$APP->$myVar = $myValue;
        }
    }

    /**
     * Call any method inside common module, else call $APP method
     *
     * @param type $name
     * @param array $arguments
     * @return type
     * @throws Exception
     */
    public function __call($name, array $arguments) {

        if (method_exists($this->common_module_extender, $name)) {
            return call_user_func_array(array($this->common_module_extender, $name), $arguments);
        }

        if (method_exists(CI::$APP, $name)) {
            return call_user_func_array(array(CI::$APP, $name), $arguments);
        }

        throw new Exception('There is no such method: ' . $name);
    }

    /**
     * Remap any call to an existing method in common module
     *
     * @param type $method
     * @param type $params
     * @return type
     */
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }

        if (method_exists($this->common_module_extender, $method)) {
            return call_user_func_array(array($this->common_module_extender, $method), $params);
        }

        show_404();
    }

    /**
     * Common module extender
     *
     * @param type $class
     * @param type $module
     * @param type $params
     */
    public function common_module_loader($class, $module = '', $params = '')
    {
        $currentPath = $module;
        $currentPath = str_replace('\\', '/', $currentPath);

        $appPath = str_replace('\\', '/', realpath(APPPATH));
        $commonPath = str_replace('\\', '/', realpath(COMMONPATH));

        $currentPath = str_replace($appPath, $commonPath, $currentPath);

        if (file_exists($currentPath))
        {
            $moduleExtends = file_get_contents($currentPath);
            $moduleExtends = str_ireplace('class '.$class, 'class '.ucfirst($class).'_common', $moduleExtends);
            $moduleExtends = preg_replace("/<\?php|<\?|\?>/", '', $moduleExtends);
            eval($moduleExtends);

            $newclass = ucfirst($class).'_common';
            $this->common_module_extender = new $newclass($params);
        }

    }

    // --------------------------------------------------------------

}
