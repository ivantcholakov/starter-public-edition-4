<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
// Sample class autoloading if you have no your own way.
if (!class_exists('Mustache_Autoloader', FALSE))
{
    require_once APPPATH.'third_party/Mustache/Autoloader.php';
    Mustache_Autoloader::register();
}
*/

class CI_Parser_mustache extends CI_Driver {

    protected $config;
    protected $parser;
    protected $parser_methods = array();
    protected $parser_properties = array();
    protected $string_loader;

    private $ci;

    public function __construct()
    {
        $this->ci = get_instance();

        // Default configuration options.

	$this->config = array(
            'extension' => '.mustache',
            'cache' => MUSTACHE_CACHE,
            'cache_file_mode' => FILE_WRITE_MODE,
            'charset' => 'UTF-8',
            'entityFlags' => ENT_COMPAT,
	);

        if ($this->ci->config->load('parser_mustache', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_mustache'));
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

        // Mustache_Engine parser initialization.

        $this->parser= new Mustache_Engine($this->config);

        $this->string_loader = new Mustache_Loader_StringLoader();

        // Scanning Mustache_Engine public properties and methods for magic methods implementation.

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

        log_message('debug', "CI_Parser_mustache Class Initialized");
    }

    public function parse($template, $data = array(), $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        $template = $this->ci->load->path($template);

        $path = pathinfo($template);
        $base_dir = $path['dirname'];
        $template = $path['basename'];

        $this->parser->setLoader(new Mustache_Loader_FilesystemLoader($base_dir));

        if ($return)
        {
            return $this->parser->render($template, $data);
        }
        else
        {
            $this->ci->output->append_output($this->parser->render($template, $data));
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE)
    {
        if (!is_array($data))
        {
            $data = array();
        }

        $this->parser->setLoader($this->string_loader);
        
        if ($return)
        {
            return $this->parser->render($template, $data);
        }
        else
        {
            $this->ci->output->append_output($this->parser->render($template, $data));
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
