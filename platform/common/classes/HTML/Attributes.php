<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class HTML_Attributes extends HTML_Common2 {

    public function __construct($attributes) {

        if (is_object($attributes)) {
            $attributes = (array) $attributes;
        }

        parent::__construct($attributes);
    }

    public function __toString() {

        return $this->getAttributes(true);
    }

}
