<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Asset extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function css_inline() {

        return html_tag('style', array('type' => 'text/css'), PHP_EOL.$this->get_content().PHP_EOL).PHP_EOL;
    }

}
