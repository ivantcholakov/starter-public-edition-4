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
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('debug', 'CI_Parser_mustache Class Initialized');
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

        $template = $this->ci->load->path($template);

        $path = pathinfo($template);
        $base_dir = $path['dirname'];
        $template = $path['basename'];

        $parser = new Mustache_Engine($config);
        $parser->setLoader(new Mustache_Loader_FilesystemLoader($base_dir));

        if ($return)
        {
            return $parser->render($template, $data);
        }
        else
        {
            $this->ci->output->append_output($parser->render($template, $data));
        }
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
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

        $parser = new Mustache_Engine($config);
        $parser->setLoader(new Mustache_Loader_StringLoader());
        
        if ($return)
        {
            return $parser->render($template, $data);
        }
        else
        {
            $this->ci->output->append_output($parser->render($template, $data));
        }
    }

}
