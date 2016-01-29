<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Loader_String extends Twig_Loader_String {

    protected $initial_string = null;

    public function exists($name) {

        $name = (string) $name;

        // What is assumed for now:
        // The first call passes the template string.
        // Next calls are template filenames that are present
        // within the initial template.
        // Next calls will be processed by a filesystem loader
        // that is next in the loader chain.
        if (!isset($this->initial_string)) {
            $this->initial_string = $name;
        }

        return $name === $this->initial_string;
    }

}
