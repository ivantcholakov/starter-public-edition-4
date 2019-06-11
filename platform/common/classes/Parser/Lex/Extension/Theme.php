<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Theme extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('asset')
            ->library('template')
        ;
    }

    public function name() {

        return $this->template->get_theme();
    }

    public function css() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->css($file, '_theme_', $attributes);
    }

    public function css_path() {

        $file = $this->get_attribute('file');

        return $this->asset->css_path($file, '_theme_');
    }

    public function css_url() {

        $file = $this->get_attribute('file');

        return $this->asset->css_url($file, '_theme_');
    }

    public function js() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->js($file, '_theme_', $attributes);
    }

    public function js_path() {

        $file = $this->get_attribute('file');

        return $this->asset->js_path($file, '_theme_');
    }

    public function js_url() {

        $file = $this->get_attribute('file');

        return $this->asset->js_url($file, '_theme_');
    }

    public function image() {

        $file = $this->get_attribute('file');

        $attributes = $this->get_attributes();

        if (isset($attributes['file'])) {
            unset($attributes['file']);
        }

        return $this->asset->image($file, '_theme_', $attributes);
    }

    public function image_path() {

        $file = $this->get_attribute('file');

        return $this->asset->image_path($file, '_theme_');
    }

    public function image_url() {

        $file = $this->get_attribute('file');

        return $this->asset->image_url($file, '_theme_');
    }

}
