<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_lex extends CI_Parser_driver {

    protected $config;
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
            'cumulative_noparse' => false,
            'scope_glue' => '.',
            'allow_php' => false,
        );

        if ($this->ci->config->load('parser_lex', TRUE, TRUE))
        {
            $defaults = $this->ci->config->item('parser_lex');

            if (array_key_exists('allowed_functions', $defaults))
            {
                unset($defaults['allowed_functions']);
            }

            if (array_key_exists('allowed_globals', $defaults))
            {
                unset($defaults['allowed_globals']);
            }

            if (array_key_exists('disabled_config_settings', $defaults))
            {
                unset($defaults['disabled_config_settings']);
            }

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

        log_message('info', 'CI_Parser_lex Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $options['cumulative_noparse'] = !empty($options['cumulative_noparse']);

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

        $parser = new Parser_Lex_Extensions;

        $parser->scopeGlue($options['scope_glue']);
        $parser->cumulativeNoparse($options['cumulative_noparse']);

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

        $data = array_merge($data, $ci->load->_ci_cached_vars);

        $parser->parser_options = $options;

        $template = $parser->parse(@ file_get_contents($template), $data, array($parser, 'parser_callback'), $options['allow_php']);

        if ($options['cumulative_noparse'])
        {
            $template = Parser_Lex_Extensions::injectNoparse($template);
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

        $options['cumulative_noparse'] = !empty($options['cumulative_noparse']);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser = new Parser_Lex_Extensions;

        $parser->scopeGlue($options['scope_glue']);
        $parser->cumulativeNoparse($options['cumulative_noparse']);

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

        $data = array_merge($data, $ci->load->_ci_cached_vars);

        $parser->parser_options = $options;

        $template = $parser->parse($template, $data, array($parser, 'parser_callback'), $options['allow_php']);

        if ($options['cumulative_noparse'])
        {
            $template = Parser_Lex_Extensions::injectNoparse($template);
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
