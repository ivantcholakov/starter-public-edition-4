<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_cssmin extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'raise_php_limits' => TRUE,
            'memory_limit' => '128M',
            'max_execution_time' => 60,
            'pcre_backtrack_limit' => 1000 * 1000,
            'pcre_recursion_limit' => 500 * 1000,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_cssmin', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_cssmin'));
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

        log_message('info', 'CI_Parser_cssmin Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return || !$config['full_path'])
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (!$config['full_path'])
        {
            $template = $ci->load->path($template);
        }

        $config['raise_php_limits'] = !empty($config['raise_php_limits']);

        $parser = new CSSmin($config['raise_php_limits']);

        if ($config['raise_php_limits']) {

            if ($config['memory_limit'] != '') {
                $parser->set_memory_limit($config['memory_limit']);
            }

            if ($config['max_execution_time'] != '') {
                $parser->set_max_execution_time($config['max_execution_time']);
            }

            if ($config['pcre_backtrack_limit'] != '') {
                $parser->set_pcre_backtrack_limit($config['pcre_backtrack_limit']);
            }

            if ($config['pcre_recursion_limit'] != '') {
                $parser->set_pcre_recursion_limit($config['pcre_recursion_limit']);
            }
        }

        // For security reasons don't parse PHP content.
        $template = @ file_get_contents($template);

        $template = $parser->run($template);

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $config['raise_php_limits'] = !empty($config['raise_php_limits']);

        $parser = new CSSmin($config['raise_php_limits']);

        if ($config['raise_php_limits']) {

            if ($config['memory_limit'] != '') {
                $parser->set_memory_limit($config['memory_limit']);
            }

            if ($config['max_execution_time'] != '') {
                $parser->set_max_execution_time($config['max_execution_time']);
            }

            if ($config['pcre_backtrack_limit'] != '') {
                $parser->set_pcre_backtrack_limit($config['pcre_backtrack_limit']);
            }

            if ($config['pcre_recursion_limit'] != '') {
                $parser->set_pcre_recursion_limit($config['pcre_recursion_limit']);
            }
        }

        $template = $parser->run($template);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
