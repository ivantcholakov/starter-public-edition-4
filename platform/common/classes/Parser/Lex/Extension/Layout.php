<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 * Inpired by https://bitbucket.org/getunik/pyrocms-layout-module by getunik ag
 */

class Parser_Lex_Extension_Layout extends Parser_Lex_Extension {

    protected $internal_data_key = '_layout_lex_extension';
    protected $internal_data = array();

    public function __construct() {

        parent::__construct();

        if (!isset($this->load->_ci_cached_vars[$this->internal_data_key])) {

            $this->load->_ci_cached_vars[$this->internal_data_key] = array();
        }

        $this->internal_data[$this->internal_data_key] = & $this->load->_ci_cached_vars[$this->internal_data_key];
    }

    /**
     * placeholder
     *
     * Usage:
     * {{ layout:placeholder name="placeholdername" }}
     *     default content
     * {{ /layout:placeholder }}
     *
     * @return string
     */
    public function placeholder($blockName = 'placeholder') {

        $name = $this->get_attribute('name');

        if (isset($this->internal_data[$this->internal_data_key][$name])) {
            return $this->internal_data[$this->internal_data_key][$name];
        }

        $content = $this->get_content();
        $content = is_string($content) ? $content : '';

        $parser = new Parser_Lex_Extensions;

        $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
        $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);
        $parser->parser_options = $this->parser_instance->parser_options;

        $result = $parser->parse(
            $content,
            $this->parser_instance->parser_data,
            array($this->parser_instance, 'parser_callback'),
            $this->parser_instance->parser_options['allow_php']
        );

        return $result;
    }

    /**
     * partial
     *
     * Usage:
     * {{ layout:partial name="placeholdername" }}
     *     content
     * {{ /layout:partial }}
     *
     * @return string
     */
    public function partial($blockName = 'partial') {

        $name = $this->get_attribute('name');

        $content = $this->get_content();
        $content = is_string($content) ? $content : '';

        $parser = new Parser_Lex_Extensions;

        $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
        $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);
        $parser->parser_options = $this->parser_instance->parser_options;

        $result = $parser->parse(
            $content,
            $this->parser_instance->parser_data,
            array($this->parser_instance, 'parser_callback'),
            $this->parser_instance->parser_options['allow_php']
        );

        $this->internal_data[$this->internal_data_key][$name] = $result;
    }

    /**
     * extend
     *
     * Usage:
     * {{ layout:extend file='layouts/base-layout.html' }}
     *     {{ layout:content name='body' }}
     *         my body
     *     {{ /layout:content }}
     * {{ /layout:extend }}
     *
     * @return string
     */
    public function extend($name = 'extend') {

        $base_layout = $this->get_attribute('file', NULL);

        $string = '';
        $path = $this->load->get_var('template_views');
        $path = $path.$base_layout;

        if ($path != '') {
            $string = @ (string) file_get_contents($path);
        }

        $content = $this->get_content();
        $content = is_string($content) ? $content : '';

        $parser = new Parser_Lex_Extensions;

        $parser->scopeGlue($this->parser_instance->parser_options['scope_glue']);
        $parser->cumulativeNoparse($this->parser_instance->parser_options['cumulative_noparse']);
        $parser->parser_options = $this->parser_instance->parser_options;

        $result1 = $parser->parse(
            $content,
            $this->parser_instance->parser_data,
            array($this->parser_instance, 'parser_callback'),
            $this->parser_instance->parser_options['allow_php']
        );

        $result = $parser->parse(
            $string,
            $this->parser_instance->parser_data,
            array($this->parser_instance, 'parser_callback'),
            $this->parser_instance->parser_options['allow_php']
        );

        return $result;
    }

    /**
     * Allows nested extend blocks by mapping any plugin call that starts with the
     * 'extends_' prefix to the default 'extends' function
     */
    public function __call($name, $arguments) {

    	$matches = array();

    	if (preg_match('/^(extend_\w+)$/', $name, $matches)) {

            return $this->extend($matches[1]);

    	} elseif (preg_match('/^(placeholder_\w+)$/', $name, $matches)) {

            return $this->placeholder($matches[1]);

    	} elseif (preg_match('/^(partial_\w+)$/', $name, $matches)) {

            return $this->partial($matches[1]);
    	}
    }

}
