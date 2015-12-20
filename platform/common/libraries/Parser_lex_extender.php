<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_lex_extender {

    protected $ci;

    public function __construct() {

        $this->ci = & get_instance();
    }

    /**
     * A callback to be used by Lex template parser for parsing the so called "callback tags".
     *
     * @param string        $name           The name of the callback tag (it would be "template.partial" for example).
     * @param array         $attributes     An associative array of the attributes set.
     * @param string        $content        If it the tag is a block tag, it will be the content contained, otherwise a blank string
     * @return string|null                  Returns a string, which will replace the tag in the content.
     *
     * @link https://github.com/pyrocms/lex
     */
    public function parser_callback($name, $attributes, $content) {

        $this->ci->load->library('parser_lex_extensions');

        $data = $this->ci->parser_lex_extensions->locate($name, $attributes, $content);

        if (is_array($data) && $data) {

        }

        return $data ? $data : null;
    }

    protected function is_multi_array($array) {

        return (count($array) != count($array, 1));
    }

    protected function make_multi_array($array, $i = 0) {

        $result = array();

        foreach ($array as $key => $value) {

            if (is_object($value)) {
                $result[$key] = (array) $value;
            } else {
                $result[$i][$key] = $value;
            }
        }

        return $result;
    }

}
