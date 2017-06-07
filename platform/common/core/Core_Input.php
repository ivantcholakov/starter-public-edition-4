<?php

// Added by Ivan Tcholakov, 07-JUN-2017.

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Input extends CI_Input {

    public function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Sanitize Globals
     *
     * Internal method serving for the following purposes:
     *
     *    - Unsets $_GET data, if query strings are not enabled
     *    - Cleans POST, COOKIE and SERVER data
     *    - Standardizes newline characters to PHP_EOL
     *
     * @return    void
     */
    protected function _sanitize_globals()
    {
        // Is $_GET data allowed? If not we'll set the $_GET to an empty array
        if ($this->_allow_get_array === FALSE)
        {
            $_GET = array();
        }
        elseif (is_array($_GET))
        {
            foreach ($_GET as $key => $val)
            {
                $_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
            }
        }

        // Clean $_POST Data
        if (is_array($_POST))
        {
            foreach ($_POST as $key => $val)
            {
                $_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
            }
        }

        // Clean $_COOKIE Data
        if (is_array($_COOKIE))
        {
            // Also get rid of specially treated cookies that might be set by a server
            // or silly application, that are of no use to a CI application anyway
            // but that when present will trip our 'Disallowed Key Characters' alarm
            // http://www.ietf.org/rfc/rfc2109.txt
            // note that the key names below are single quoted strings, and are not PHP variables
            unset(
                $_COOKIE['$Version'],
                $_COOKIE['$Path'],
                $_COOKIE['$Domain']
            );

            foreach ($_COOKIE as $key => $val)
            {
                if (($cookie_key = $this->_clean_input_keys($key)) !== FALSE)
                {
                    $_COOKIE[$cookie_key] = $this->_clean_input_data($val);
                }
                else
                {
                    unset($_COOKIE[$key]);
                }
            }
        }

        // Sanitize PHP_SELF
        $_SERVER['PHP_SELF'] = strip_tags($_SERVER['PHP_SELF']);

        // Modified by Ivan Tcholakov, 07-JUN-2017.
        //log_message('debug', 'Global POST, GET and COOKIE data sanitized');
        log_message('info', 'Global POST, GET and COOKIE data sanitized');
        //
    }

}
