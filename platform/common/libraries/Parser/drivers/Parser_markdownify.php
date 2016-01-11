<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
// Sample class loading if you have no your own way.
if (!class_exists('Markdownify_Extra', FALSE))
{
    require COMMONPATH.'third_party/markdownify/markdownify_extra.php';
}
*/

class CI_Parser_markdownify extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
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

        // Injecting configuration options directly.

        if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
        {
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('info', 'CI_Parser_markdownify Class Initialized');
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

        // For security reasons don't parse PHP content.
        $template = @ file_get_contents($template);

        $parser = new Markdownify_Extra(
            $options['linksAfterEachParagraph'],
            $options['bodyWidth'],
            $options['keepHTML']
        );

        $template = @ $parser->parseString($template);

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

        $parser = new Markdownify_Extra(
            $options['linksAfterEachParagraph'],
            $options['bodyWidth'],
            $options['keepHTML']
        );

        $template = @ $parser->parseString($template);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
