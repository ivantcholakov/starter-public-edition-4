<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_URI extends CI_URI {

    // This method has been modified for backward compatibility with PHP prior to version 5.2.4.
    public function _filter_uri($str)
    {
        if ($str !== '' && $this->config->item('permitted_uri_chars') != '' && $this->config->item('enable_query_strings') === FALSE)
        {
            // preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
            // compatibility as many are unaware of how characters in the permitted_uri_chars will be parsed as a regex pattern
            // Modified by Ivan Tcholakov, 01-NOV-2012.
            //if ( ! preg_match('|^['.str_replace(array('\\-', '\-'), '-', preg_quote($this->config->item('permitted_uri_chars'), '-')).']+$|i', $str))
            if ( ! preg_match('|^['.str_replace(array('\\-', '\-'), '-', preg_quote($this->config->item('permitted_uri_chars'), '-')).']+$|i', urldecode($str)))
            //
            {
                show_error('The URI you submitted has disallowed characters.', 400);
            }
        }

        // Convert programatic characters to entities and return
        return str_replace(
                    array('$',     '(',     ')',     '%28',   '%29'), // Bad
                    array('&#36;', '&#40;', '&#41;', '&#40;', '&#41;'), // Good
                    $str);
    }

}
