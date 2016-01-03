<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Asset extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load->library('asset');
    }

    public function css_inline() {

        return $this->asset->css_inline($this->get_content());
    }

    public function css() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->css($file, null, $attributes);
    }

    public function js_inline() {

        return $this->asset->js_inline($this->get_content());
    }
}
