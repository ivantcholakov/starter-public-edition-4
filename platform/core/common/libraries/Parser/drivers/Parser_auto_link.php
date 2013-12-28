<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_auto_link extends CI_Driver {

    protected $config;
    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        $this->ci->load->helper('url');

        // Default configuration options.

        $this->config = array(
            'type' => 'both',
            'attributes' => '',
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_auto_link', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_auto_link'));
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
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('debug', 'CI_Parser_auto_link Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        if (!is_array($data))
        {
            $data = array();
        }

        if (!$config['full_path'])
        {
            // Adaptation for HMVC by wiredesignz.
            //$template = $this->ci->load->path($template);

            $ci = $this->ci;

            foreach (debug_backtrace() as $item) {
                $object = isset($item['object']) ? $item['object'] : null;
                if (is_object($object) && @ is_a($object, 'MX_Controller')) {
                    $ci = $object;
                    break;
                }
            }

            $template = $ci->load->path($template);
            //
        }

        // For security reasons don't parse PHP content.
        $template = @ file_get_contents($template);

        if ($return)
        {
            return auto_link($template, $config['type'], $config['attributes']);
        }
        else
        {
            $this->ci->output->append_output(auto_link($template, $config['type'], $config['attributes']));
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        if ($return)
        {
            return auto_link($template, $config['type'], $config['attributes']);
        }
        else
        {
             $this->ci->output->append_output(auto_link($template, $config['type'], $config['attributes']));
        }
    }

}
