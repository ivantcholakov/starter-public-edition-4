<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_URI extends CI_URI {

    // This method has been modified for backward compatibility with PHP prior to version 5.2.4.
    public function filter_uri(&$str)
    {
        // Modified by Ivan Tcholakov, 16-JAN-2014.
        //if ( ! empty($str) && ! empty($this->_permitted_uri_chars) && ! preg_match('/^['.$this->_permitted_uri_chars.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $str))
        if ( ! empty($str) && ! empty($this->_permitted_uri_chars) && ! preg_match('/^['.$this->_permitted_uri_chars.']+$/i'.(IS_UTF8_CHARSET && PCRE_UTF8_INSTALLED ? 'u' : ''), $str))
        //
        {
            show_error('The URI you submitted has disallowed characters.', 400);
        }
    }

    public function ruri_string()
    {
        return ltrim(load_class('Router', 'core')->rdir, '/').implode('/', $this->rsegments);
    }

}
