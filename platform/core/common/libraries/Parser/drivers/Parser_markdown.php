<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
// Sample class loading if you have no your own way.
if (!class_exists('MarkdownExtra_Parser', FALSE))
{
    require APPPATH.'third_party/markdown/markdown.php';
}
*/

class CI_Parser_markdown extends CI_Driver {

    protected $config;
    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        $this->ci->load->helper('url');

        // Default configuration options.

        $this->config = array(
            'auto_links' => true,
            'detect_code_blocks' => true,
        );

        if ($this->ci->config->load('parser_markdown', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_markdown'));
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

        log_message('debug', 'CI_Parser_markdown Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        $template = $this->ci->load->path($template);
        $content = file_get_contents($template);

        if (!empty($config['detect_code_blocks']))
        {
            $content = preg_replace('/`{3,}[a-z]*/i', '~~~', $content);
        }

        $parser = new MarkdownExtra_Parser();

        $result = @ $parser->transform($content);

        if (!empty($config['auto_links']))
        {
            $result = auto_link($result);
        }

        if ($return)
        {
            return $result;
        }
        else
        {
            $this->ci->output->append_output($result);
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        if (!empty($config['detect_code_blocks']))
        {
            $template = preg_replace('/`{3,}[a-z]*/i', '~~~', $template);
        }

        $parser = new MarkdownExtra_Parser();

        $result = @ $parser->transform($template);

        if (!empty($config['auto_links']))
        {
            $result = auto_link($result);
        }

        if ($return)
        {
            return $result;
        }
        else
        {
            $this->ci->output->append_output($result);
        }
    }

}
