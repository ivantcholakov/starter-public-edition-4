<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_jsonmin extends CI_Parser_driver {

    protected $config;
    protected $allowed_formatters;
    private $ci;

    public function initialize()
    {
        $php_min = '5.3.0';

        if (!is_php($php_min))
        {
            throw new Exception('CI_Parser_jsonmin: Requires PHP '.$php_min.' or above.');
        }

        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_jsonmin', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_jsonmin'));
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

        log_message('info', 'CI_Parser_jsonmin Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

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

        $parser_reflection = new ReflectionClass('t1st3\JSONMin\JSONMin');
        $parser = $parser_reflection->newInstance(@ file_get_contents($template));

        $template = $parser->getMin();

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser_reflection = new ReflectionClass('t1st3\JSONMin\JSONMin');
        $parser = $parser_reflection->newInstance($template);

        $template = $parser->getMin();

        return $this->output($template, $return, $ci, $is_mx);
    }

}
