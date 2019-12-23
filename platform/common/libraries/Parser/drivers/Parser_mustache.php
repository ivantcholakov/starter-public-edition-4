<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2019
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_mustache extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'cache' => MUSTACHE_CACHE,
            'cache_file_mode' => FILE_WRITE_MODE,
            'escape' => null,
            'charset' => null,
            'entity_flags' => ENT_COMPAT,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_mustache', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_mustache'));
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

        log_message('info', 'CI_Parser_mustache Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (empty($options['cache']) && array_key_exists('cache', $options))
        {
            unset($options['cache']);
        }
        elseif (array_key_exists('cache', $options))
        {
            $options['cache'] = rtrim($options['cache'], '/\\');
        }

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            $data = array();
        }

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

        // For security reasons don't parse PHP content.

        $path = pathinfo($template);
        $base_dir = $path['dirname'];
        $template = $path['basename'];

        $ci->load->parser();
        $p = $ci->parser->detect($template, $detected_extension, $detected_filename);

        if ($detected_extension == '')
        {
            $detected_extension = $options['extension'];
        }

        $parser = new Mustache_Engine($options);
        $parser->setLoader(new Mustache_Loader_FilesystemLoader($base_dir, array('extension' => '.'.$detected_extension)));
        $template = $parser->render($detected_filename, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (array_key_exists('cache', $options))
        {
            unset($options['cache']);
        }
        elseif (array_key_exists('cache', $options))
        {
            $options['cache'] = rtrim($options['cache'], '/\\');
        }

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            $data = array();
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser = new Mustache_Engine($options);
        $parser->setLoader(new Mustache_Loader_StringLoader());
        $template = $parser->render($template, $data);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
