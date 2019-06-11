<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_scss extends CI_Parser_driver {

    protected $config;
    protected $allowed_formatters;
    private $ci;

    public function initialize()
    {
        $php_min = '5.4';

        if (!is_php($php_min))
        {
            throw new Exception('CI_Parser_scss: Requires PHP '.$php_min.' or above.');
        }

        $this->ci = get_instance();

        $this->allowed_formatters = array(
            'expanded',
            'nested',
            'compressed',
            'compact',
            'crunched',
        );

        // Default configuration options.

        $this->config = array(
            'import_paths' => array(''),
            'number_precision' => 5,
            'formatter' => 'expanded',
            'line_number_style' => null,
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

        $parser = new \Leafo\ScssPhp\Compiler();

        $parser->setImportPaths($options['import_paths']);
        $parser->addImportPath(dirname($template));
        $parser->setNumberPrecision($options['number_precision']);

        $formatter = $options['formatter'];

        if (!in_array($formatter, $this->allowed_formatters))
        {
            $formatter = 'expanded';
        }

        $formatter = 'Leafo\ScssPhp\Formatter\\'.ucfirst($formatter);
        $parser->setFormatter($formatter);

        $parser->setLineNumberStyle($options['line_number_style']);

        $template = $parser->compile(@ file_get_contents($template));

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

        $parser = new \Leafo\ScssPhp\Compiler();

        $parser->setImportPaths($options['import_paths']);
        $parser->setNumberPrecision($options['number_precision']);

        $formatter = $options['formatter'];

        if (!in_array($formatter, $this->allowed_formatters))
        {
            $formatter = 'expanded';
        }

        $formatter = 'Leafo\ScssPhp\Formatter\\'.ucfirst($formatter);
        $parser->setFormatter($formatter);

        $parser->setLineNumberStyle($options['line_number_style']);

        $template = $parser->compile($template);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
