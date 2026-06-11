<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_scss extends CI_Parser_driver {

    protected $config;
    protected $allowed_formatters;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        $this->allowed_formatters = array(
            'expanded',
            'compressed',
        );

        // Default configuration options.

        $this->config = array(
            'import_paths' => array(''),
            'formatter' => 'expanded',
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_scss', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_scss'));
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

        foreach ($this->config['import_paths'] as $key => $value) {

            if ($value == '') {
                $this->config['import_paths'][$key] = getcwd();
            }
        }

        log_message('info', 'CI_Parser_scss Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

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

        $parser = new \ScssPhp\ScssPhp\Compiler();

        $parser->setImportPaths($options['import_paths']);
        $parser->addImportPath(dirname($template));

        $formatter = $options['formatter'];

        if (!in_array($formatter, $this->allowed_formatters))
        {
            $formatter = 'expanded';
        }

        $parser->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::fromString($formatter));

        $template =
            $parser
                ->compileFile($template)
                ->getCss();

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser = new \ScssPhp\ScssPhp\Compiler();

        $parser->setImportPaths($options['import_paths']);

        $formatter = $options['formatter'];

        if (!in_array($formatter, $this->allowed_formatters))
        {
            $formatter = 'expanded';
        }

        $parser->setOutputStyle(\ScssPhp\ScssPhp\OutputStyle::fromString($formatter));

        $template =
            $parser
                ->compileString($template)
                ->getCss();

        return $this->output($template, $return, $ci, $is_mx);
    }

}
