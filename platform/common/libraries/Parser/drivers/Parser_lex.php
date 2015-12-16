<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_lex extends CI_Parser_driver {

    protected $config;
    protected $allowed_formatters;
    private $ci;

    public function initialize()
    {
        $php_min = '5.3';

        if (!is_php($php_min))
        {
            throw new Exception('CI_Parser_lex: Requires PHP '.$php_min.' or above.');
        }

        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'scope_glue' => '.',
            'cumulative_noparse' => false,
        );

        if ($this->ci->config->load('parser_lex', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_lex'));
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

        log_message('info', 'CI_Parser_lex Class Initialized');
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

        $parser_reflection = new ReflectionClass('Lex\Parser');
        $parser = $parser_reflection->newInstance();

        $parser->scopeGlue($config['scope_glue']);
        $parser->cumulativeNoparse($config['cumulative_noparse']);

        $template = $parser->compile(@ file_get_contents($template), $data);

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

        $parser_reflection = new ReflectionClass('Lex\Parser');
        $parser = $parser_reflection->newInstance();

        $parser->scopeGlue($config['scope_glue']);
        $parser->cumulativeNoparse($config['cumulative_noparse']);

        $template = $parser->parse($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
