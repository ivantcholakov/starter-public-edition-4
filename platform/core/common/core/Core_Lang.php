<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Core_Lang extends MX_Lang {

    protected $common_module_extender;

    public function __construct() {

        parent::__construct();
    }

    /**
     * Fetches a single line of text from the language array
     *
     * @param       string          $line           Language line key
     * @parap       string|array    $param          String or array of strings to be inserted at placeholders like %s, %d, etc.
     * @param       bool            $log_errors     Whether to log an error message if the line is not found
     * @return      string                          Translation
     */
    public function line($line = '', $param = NULL, $log_errors = TRUE) {

        $line = (string) $line;

        if (is_bool($param)) {
 
            // Backward compatibility, the parent method line()
            // does not contain $param parameter.
            $log_errors = $param;
            $param = '';

        } elseif (!is_array($param)) {

            $param = (string) $param;
        }

        $log_errors = (bool) $log_errors;

        if ($line == '' || !isset($this->language[$line])) {

            $value = FALSE;

        } else {

            $value = $this->language[$line];

            if (is_array($param) && !empty($param)) {

                $value = vsprintf($value, $param);

            } elseif ($param != '') {

                $value = sprintf($value, $param);
            }
        }

        if ($value === FALSE && $log_errors) {

            log_message('error', 'Could not find the language line "'.$line.'"');
        }

        return $value;
    }

}
