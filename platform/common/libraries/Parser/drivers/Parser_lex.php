<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_lex extends CI_Parser_driver {

    protected $config;
    private $ci;
    private $extender;

    public function initialize()
    {
        $php_min = '5.3';

        if (!is_php($php_min))
        {
            throw new Exception('CI_Parser_lex: Requires PHP '.$php_min.' or above.');
        }

        $this->ci = get_instance();

        $this->ci->load->library('lex_parser_extender');
        $this->extender = $this->ci->lex_parser_extender;

        // Default configuration options.

        $this->config = array(
            'scope_glue' => '.',
            'allow_php' => false,
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
        $parser->cumulativeNoparse(true);

        $this->extender->set_scope_glue($config['scope_glue']);
        $this->extender->set_allow_php($config['allow_php']);

        $template = $parser->compile(@ file_get_contents($template), $data, array($this->extender, 'parser_callback'), $config['allow_php']);

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
        $parser->cumulativeNoparse(true);

        $this->extender->set_scope_glue($config['scope_glue']);
        $this->extender->set_allow_php($config['allow_php']);

        $template = $parser->parse($template, $data, array($this->extender, 'parser_callback'), $config['allow_php']);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
