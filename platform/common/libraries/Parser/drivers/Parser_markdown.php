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

    public function parse($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return || !$config['full_path'])
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (!$config['full_path'])
        {
            $template = $ci->load->path($template);
        }

        // For security reasons don't parse PHP content.
        $template = @ file_get_contents($template);

        switch ($config['detect_code_blocks']) {

            case 'parsedown':

                $parser = new ParsedownExtra();
                $template = @ $parser->text($template);

                break;

            default:

                if (!empty($config['detect_code_blocks']))
                {
                    $template = preg_replace('/`{3,}[a-z]*/i', '~~~', $template);
                }

                $parser = new MarkdownExtra_Parser();
                $template = @ $parser->transform($template);

                if (!empty($config['apply_autolink']))
                {
                    $this->ci->load->helper('url');
                    $template = auto_link($template);
                }

                break;
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $config = array())
    {
        if (!is_array($config))
        {
            $config = array();
        }

        $config = array_merge($this->config, $config);

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        switch ($config['detect_code_blocks']) {

            case 'parsedown':

                $parser = new ParsedownExtra();
                $template = @ $parser->text($template);

                break;

            default:

                if (!empty($config['detect_code_blocks']))
                {
                    $template = preg_replace('/`{3,}[a-z]*/i', '~~~', $template);
                }

                $parser = new MarkdownExtra_Parser();
                $template = @ $parser->transform($template);

                if (!empty($config['apply_autolink']))
                {
                    $this->ci->load->helper('url');
                    $template = auto_link($template);
                }

                break;
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
