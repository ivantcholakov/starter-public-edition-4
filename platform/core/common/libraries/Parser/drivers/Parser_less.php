<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_less extends CI_Driver {

    protected $config;

    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        // Default configuration options.

	$this->config = array(

        );

        if ($this->ci->config->load('parser_less', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_less'));
        }

        // Ivan Tcholakov: A ugly hack for accessing the parent loader object,
        // since there is no decoration yet.
        global $PARENT_DRIVER_LIBRARY_OBJECT;
        if (isset($PARENT_DRIVER_LIBRARY_OBJECT))
        {
            $this->_parent = $PARENT_DRIVER_LIBRARY_OBJECT;
        }
        //

        // Injecting configuration options directly.

        if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
        {
            if (array_key_exists('parser_driver', $this->_parent->params))
            {
                unset($this->_parent->params['parser_driver']);
            }

            $this->config = array_merge($this->config, $this->_parent->params);
        }

        log_message('debug', 'CI_Parser_less Class Initialized');
    }

    // Note: Provide the full path for $template.
    public function parse($template, $data, $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        $uri_root = isset($data['uri_root']) ? (string) $data['uri_root'] : '';

        $parser = new Less_Parser($this->options);
        $parser->parseFile($template, $uri_root);

        if ($return)
        {
            return $parser->getCss();
        }
        else
        {
            $this->ci->output->append_output($parser->getCss());
        }
    }

    public function parse_string($template, $data, $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }
        
        $parser = new Less_Parser($this->options);
        $parser->parse($template);

        if ($return)
        {
            return $parser->getCss();
        }
        else
        {
            $this->ci->output->append_output($parser->getCss());
        }
    }

}
