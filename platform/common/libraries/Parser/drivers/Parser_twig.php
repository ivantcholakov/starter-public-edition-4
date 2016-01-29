<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_twig extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $php_min = '5.2.7';

        if (!is_php($php_min))
        {
            throw new Exception('CI_Parser_twig: Requires PHP '.$php_min.' or above.');
        }

        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(

            'full_path' => false,
        );

        if ($this->ci->config->load('parser_twig', TRUE, TRUE))
        {
            $defaults = $this->ci->config->item('parser_twig');

            $this->config = array_merge($this->config, $defaults);
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

        log_message('info', 'CI_Parser_twig Class Initialized');
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
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
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

        $parser = new Twig_Environment(new Parser_Twig_Loader_Filesystem(), array(
            'cache' => TWIG_CACHE
        ));

        $template = $parser->render($template, $data);

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
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser = new Twig_Environment(new Twig_Loader_Chain(array(new Parser_Twig_Loader_String, new Parser_Twig_Loader_Filesystem())), array(
        ));

        $template = $parser->render($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
