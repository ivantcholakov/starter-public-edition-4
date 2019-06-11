<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Loader_Filesystem extends Twig_Loader_Filesystem {

    public function __construct($paths = array()) {

        parent::__construct($paths);
    }

    protected function findTemplate($name) {

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

        $ci = & get_instance();

        if (strpos($name, '..') === false && $ci->parser->detect($name) === 'twig' && is_file($name)) {
            // Full file name has been given.
            return $this->cache[$name] = $name;
        }

        $this->validateName($name);

        list($namespace, $shortname) = $this->parseName($name);

        if (!isset($this->paths[$namespace])) {
            $this->errorCache[$name] = sprintf('There are no registered paths for namespace "%s".', $namespace);

            if (!$throw) {
                return false;
            }

            throw new Twig_Error_Loader($this->errorCache[$name]);
        }

        foreach ($this->paths[$namespace] as $path) {

            $file = $ci->parser->find_file($path.'/'.$shortname, $detected_parser, $detected_extension, $detected_filename, 'twig');

            if (is_file($file)) {

                if (false !== $realpath = realpath($file)) {
                    return $this->cache[$name] = $realpath;
                }

                return $this->cache[$name] = $file;
            }
        }

        $this->errorCache[$name] = sprintf('Unable to find template "%s" (looked into: %s).', $name, implode(', ', $this->paths[$namespace]));

        if (!$throw) {
            return false;
        }

        throw new Twig_Error_Loader($this->errorCache[$name]);
    }

}
