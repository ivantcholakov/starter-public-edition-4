<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_validation extends CI_Form_validation {

    public $CI; // See https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home

    public function __construct($rules = array()) {

        parent::__construct($rules);
    }


    // ---------------------------------------------------------------------
    // Bug fixing, see
    // http://www.mahbubblog.com/php/form-validation-callbacks-in-hmvc-in-codeigniter/
    // ---------------------------------------------------------------------

    function run($module = '', $group = '') {

        (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
    }

}
