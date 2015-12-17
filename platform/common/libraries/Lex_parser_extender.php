<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Lex_parser_extender {

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

        return null;    // For now.
    }

}
