<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_mustache extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'cache' => MUSTACHE_CACHE,
            'cache_file_mode' => FILE_WRITE_MODE,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_mustache', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_mustache'));
        }

        // Injecting configuration options directly.

        if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
        {
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('info', 'CI_Parser_mustache Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            $data = array();
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return || !$options['full_path'])
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (!$options['full_path'])
        {
            $template = $ci->load->path($template);
        }

        if (array_key_exists('cache', $options)) {

            if ($options['cache'] != '') {
                $options['cache'] = rtrim($options['cache'], '/\\');
            } else {
                unset($options['cache']);
            }
        }

        if (array_key_exists('charset', $options)) {
            $options['charset'] = strtoupper($options['charset']);
        }

        $base_dir = pathinfo($template, PATHINFO_DIRNAME);
        $filename = pathinfo($template, PATHINFO_FILENAME);
        $extension = pathinfo($template, PATHINFO_EXTENSION);

        if (array_key_exists('loader', $options) && !is_object($options['loader'])) {
            unset($options['loader']);
        }

        if (empty($options['loader'])) {
            $options['loader'] = new \Mustache_Loader_FilesystemLoader($base_dir, array('extension' => '.'.$extension));
        }

        if (array_key_exists('partials_loader', $options) && !is_object($options['partials_loader'])) {
            unset($options['partials_loader']);
        }

        if (empty($options['partials_loader'])) {
            $options['partials_loader'] = new \Mustache_Loader_FilesystemLoader($base_dir, array('extension' => '.'.$extension));
        }

        $parser = new \Mustache_Engine($options);

        $template = $parser->render($filename, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            $data = array();
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (array_key_exists('cache', $options)) {

            if ($options['cache'] != '') {
                $options['cache'] = rtrim($options['cache'], '/\\');
            } else {
                unset($options['cache']);
            }
        }

        if (array_key_exists('charset', $options)) {
            $options['charset'] = strtoupper($options['charset']);
        }

        $options['loader'] = new \Mustache_Loader_StringLoader();

        if (array_key_exists('partials_loader', $options)) {
            unset($options['partials_loader']);
        }

        $parser = new \Mustache_Engine($options);

        $template = $parser->render($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
