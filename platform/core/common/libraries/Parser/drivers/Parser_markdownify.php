<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
// Sample class loading if you have no your own way.
if (!class_exists('Markdownify_Extra', FALSE))
{
    require APPPATH.'third_party/markdownify/markdownify_extra.php';
}
*/

class CI_Parser_markdownify extends CI_Driver {

    protected $config;
    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'linksAfterEachParagraph' => FALSE,
            'bodyWidth' => FALSE,
            'keepHTML' => FALSE,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_markdownify', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_markdownify'));
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

        log_message('debug', 'CI_Parser_markdownify Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        if (!$config['full_path'])
        {
            $template = $this->ci->load->path($template);
        }

        // For security reasons don't parse PHP content.
        $template = file_get_contents($template);

        $parser = new Markdownify_Extra(
            $config['linksAfterEachParagraph'],
            $config['bodyWidth'],
            $config['keepHTML']
        );

        if ($return)
        {
            return @ $parser->parseString($template);
        }
        else
        {
            $this->ci->output->append_output(@ $parser->parseString($template));
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);
        
        $parser = new Markdownify_Extra(
            $config['linksAfterEachParagraph'],
            $config['bodyWidth'],
            $config['keepHTML']
        );

        if ($return)
        {
            return @ $parser->parseString($template);
        }
        else
        {
            $this->ci->output->append_output(@ $parser->parseString($template));
        }
    }

}
