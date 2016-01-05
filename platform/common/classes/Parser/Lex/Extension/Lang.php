<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Lex_Extension_Lang extends Parser_Lex_Extension {

    public function __construct() {

        parent::__construct();
    }

    public function trans() {

        $attributes = $this->get_attribute_values();

        if (count($attributes) < 1) {
            return null;
        }

        $line = $attributes[0];

        if (count($attributes) == 1) {
            return $this->lang->line($line);
        }

        $params = array_slice($attributes, 1);

        return $this->lang->line($line, $params);
    }

    public function get() {

        return $this->lang->get($this->lang->current());
    }

    public function current() {

        return $this->lang->current();
    }

    public function code() {

        return $this->lang->code();
    }

    public function direction() {

        return $this->lang->direction();
    }

    public function uri_segment() {

        return $this->lang->uri_segment();
    }

    public function current_uri_segment() {

        return $this->lang->hide_default_uri_segment() && $this->lang->current() == $this->lang->default_lang()
            ? NULL
            : $this->lang->uri_segment();
    }

    public function name() {

        return $this->lang->name();
    }

    public function name_en() {

        return $this->lang->name_en();
    }

    public function flag() {

        return $this->lang->flag();
    }

}
