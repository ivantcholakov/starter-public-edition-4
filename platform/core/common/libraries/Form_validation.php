<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form_validation extends CI_Form_validation {

    public $CI; // See https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home

    public function __construct($rules = array()) {

        parent::__construct($rules);

        $this->CI->load->helper('checkbox');
        $this->CI->load->helper('email');
    }


    // ---------------------------------------------------------------------
    // Bug fixing, see
    // http://www.mahbubblog.com/php/form-validation-callbacks-in-hmvc-in-codeigniter/
    // ---------------------------------------------------------------------

    function run($module = '', $group = '') {

        (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
    }


    // ---------------------------------------------------------------------
    // Reworked validation rules.
    // ---------------------------------------------------------------------

    public function valid_email($str) {

        return valid_email($str);
    }

    public function min_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? ($val <= UTF8::strlen($str))
            : ($val <= strlen($str));
    }

    public function max_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? ($val >= UTF8::strlen($str))
            : ($val >= strlen($str));
    }

    public function exact_length($str, $val) {

        if (!is_numeric($val)) {
            return false;
        } else {
            $val = (int) $val;
        }

        return IS_UTF8_CHARSET
            ? (UTF8::strlen($str) === $val)
            : (strlen($str) === $val);
    }

    public function prep_url($str = '') {

        // Added by Ivan Tcholakov, 08-DEC-2011.
        $str = str_ireplace('http://', 'http://', $str);
        $str = str_ireplace('https://', 'https://', $str);
        //

        if ($str == 'http://' OR $str == '') {
            return '';
        }

        if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://') {
            $str = 'http://'.$str;
        }

        return $str;
    }

    // ---------------------------------------------------------------------

}
