<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Loader_Filesystem extends Twig_Loader_Filesystem {

    public function __construct() {

        parent::__construct();
    }

    protected function findTemplate($name) {

        $ci = & get_instance();

        $throw = func_num_args() > 1 ? func_get_arg(1) : true;
        $name = $this->normalizeName($name);

        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        if (isset($this->errorCache[$name])) {

            if (!$throw) {
                return false;
            }

            throw new Twig_Error_Loader($this->errorCache[$name]);
        }

        if (is_file($name)) {
            // Full file name has been given.
            return $this->cache[$name] = $name;
        }

        $this->validateName($name);

        $file = $ci->parser->find_file($file_name, $detected_parser, $detected_extension, $detected_filename);

        if ($file != '') {
            return $this->cache[$name] = $file;
        }

        $this->errorCache[$name] = sprintf('Unable to find template "%s".', $name);

        if (!$throw) {
            return false;
        }

        throw new Twig_Error_Loader($this->errorCache[$name]);
    }

}
