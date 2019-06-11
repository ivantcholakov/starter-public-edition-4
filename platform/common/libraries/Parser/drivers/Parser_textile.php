<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_textile extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'doctype' => 'xhtml',
            'full_path' => FALSE,
            'restricted_mode' => FALSE,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_textile', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_textile'));
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

        log_message('info', 'CI_Parser_textile Class Initialized');
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

        // For security reasons don't parse PHP content.
        $template = @ file_get_contents($template);

        $parser = new TextileParser($options['doctype']);

        if ($options['restricted_mode'])
        {
            $template = $parser->textileRestricted($template);
        }
        else
        {
            $template = $parser->textileThis($template);
        }

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

        $parser = new TextileParser($options['doctype']);

        if ($options['restricted_mode'])
        {
            $template = $parser->textileRestricted($template);
        }
        else
        {
            $template = $parser->textileThis($template);
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
