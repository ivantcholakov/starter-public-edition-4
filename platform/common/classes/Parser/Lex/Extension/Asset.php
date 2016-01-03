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

    public function css_path() {

        $file = $this->get_attribute('file');

        return $this->asset->css_path($file);
    }

    public function css_url() {

        $file = $this->get_attribute('file');

        return $this->asset->css_url($file);
    }

    public function js_inline() {

        return $this->asset->js_inline($this->get_content());
    }

    public function js() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->js($file, null, $attributes);
    }

    public function js_path() {

        $file = $this->get_attribute('file');

        return $this->asset->js_path($file);
    }

    public function js_url() {

        $file = $this->get_attribute('file');

        return $this->asset->js_url($file);
    }

    public function image() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->image($file, null, $attributes);
    }

    public function image_path() {

        $file = $this->get_attribute('file');

        return $this->asset->image_path($file);
    }

    public function image_url() {

        $file = $this->get_attribute('file');

        return $this->asset->image_url($file);
    }

}
