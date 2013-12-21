<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_i18n extends CI_Driver {

    protected $config;

    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(

        );

        if ($this->ci->config->load('parser_i18n', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_i18n'));
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

        log_message('debug', 'CI_Parser_i18n Class Initialized');
    }

    // Note: Provide the full path for $template.
    public function parse($template, $data = array(), $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        $template = $this->ci->load->view($template, $data, TRUE);

        if ($return)
        {
            return $this->ci->lang->parse_i18n($template);
        }
        else
        {
            $this->ci->output->append_output($this->ci->lang->parse_i18n($template));
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        if ($return)
        {
            return $this->ci->lang->parse_i18n($template);
        }
        else
        {
             $this->ci->output->append_output($this->ci->lang->parse_i18n($template));
        }
    }

}
