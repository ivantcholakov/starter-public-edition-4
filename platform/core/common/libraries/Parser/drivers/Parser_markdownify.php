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
    protected $parser;
    protected $parser_methods = array();
    protected $parser_properties = array();

    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'linksAfterEachParagraph' => FALSE,
            'bodyWidth' => FALSE,
            'keepHTML' => FALSE,
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
            if (array_key_exists('parser_driver', $this->_parent->params))
            {
                unset($this->_parent->params['parser_driver']);
            }

            $this->config = array_merge($this->config, $this->_parent->params);
        }

        // Markdown parser initialization.

        $this->parser = new Markdownify_Extra(
            $this->config['linksAfterEachParagraph'],
            $this->config['bodyWidth'],
            $this->config['keepHTML']
        );

        // Scanning parser public properties and methods for magic methods implementation.

        $r = new ReflectionObject($this->parser);

        foreach ($r->getMethods() as $method)
        {
            if ($method->isPublic())
            {
                $this->parser_methods[] = $method->getName();
            }
        }

        foreach ($r->getProperties() as $prop)
        {
            if ($prop->isPublic())
            {
                $this->parser_properties[] = $prop->getName();
            }
        }

        log_message('debug', 'CI_Parser_markdownify Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        $template = $this->ci->load->path($template);
        $content = file_get_contents($template);

        if ($return)
        {
            return @ $this->parser->parseString($content);
        }
        else
        {
            $this->ci->output->append_output(@ $this->parser->parseString($content));
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
            return @ $this->parser->parseString($template);
        }
        else
        {
            $this->ci->output->append_output(@ $this->parser->parseString($template));
        }
    }

    // Magic Methods
    //--------------------------------------------------------------------------

    public function __get($property)
    {
        if (in_array($property, $this->parser_properties))
        {
            return $this->parser->{$property};
        }
        else
        {
            return parent::__get($property);
        }
    }

    public function __call($method, $args = array())
    {
        if (in_array($method, $this->parser_methods))
        {
            return call_user_func_array(array($this->parser, $method), $args);
        }
        else
        {
            return parent::__call($method, $args);
        }
    }

}
