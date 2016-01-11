<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*
// Sample class loading if you have no your own way.
if (!class_exists('MarkdownExtra_Parser', FALSE))
{
    require COMMONPATH.'third_party/markdown/markdown.php';
}
*/

class CI_Parser_markdown extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        $this->ci->load->helper('url');

        // Default configuration options.

        $this->config = array(
            'markdown_implementation' => 'php-markdown',
            'detect_code_blocks' => TRUE,
            'full_path' => FALSE,
        );

        if ($this->ci->config->load('parser_markdown', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_markdown'));
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

        log_message('info', 'CI_Parser_markdown Class Initialized');
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

        switch ($options['markdown_implementation']) {

            case 'parsedown':

                $parser = new ParsedownExtra();
                $template = @ $parser->text($template);

                break;

            default:

                if (!empty($options['detect_code_blocks']))
                {
                    $template = preg_replace('/`{3,}[a-z]*/i', '~~~', $template);
                }

                $parser = new MarkdownExtra_Parser();
                $template = @ $parser->transform($template);

                if (!empty($options['apply_autolink']))
                {
                    $this->ci->load->helper('url');
                    $template = auto_link($template);
                }

                break;
        }

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

        switch ($options['markdown_implementation']) {

            case 'parsedown':

                $parser = new ParsedownExtra();
                $template = @ $parser->text($template);

                break;

            default:

                if (!empty($options['detect_code_blocks']))
                {
                    $template = preg_replace('/`{3,}[a-z]*/i', '~~~', $template);
                }

                $parser = new MarkdownExtra_Parser();
                $template = @ $parser->transform($template);

                if (!empty($options['apply_autolink']))
                {
                    $this->ci->load->helper('url');
                    $template = auto_link($template);
                }

                break;
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
