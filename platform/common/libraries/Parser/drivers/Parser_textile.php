<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013 - 2018
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_textile extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->config = array(
            'doctype' => 'xhtml',
            'full_path' => FALSE,
            'restricted_mode' => FALSE,
            'full_path' => FALSE,
            'lite' => FALSE,
            'encode' => FALSE,
            'noimage' => FALSE,
            'strict' => FALSE,
            'rel' => '',
        );

        if ($this->ci->config->load('parser_textile', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_textile'));
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

        log_message('info', 'CI_Parser_textile Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        $options['restricted_mode'] = !empty($options['restricted_mode']);
        $options['lite'] = !empty($options['lite']);
        $options['encode'] = !empty($options['encode']);
        $options['noimage'] = !empty($options['noimage']);
        $options['strict'] = !empty($options['strict']);
        $options['rel'] = (string) $options['rel'];

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

        $parser = new \Netcarver\Textile\Parser($options['doctype']);

        if ($options['encode'])
        {
            $template = $parser->textileEncode($template);
        }
        else
        {
            $template = $parser
                ->setRestricted($options['restricted_mode'])
                ->setLite($options['lite'])
                ->setBlockTags(true)
                ->setImages(!$options['noimage'])
                ->setLinkRelationShip($options['rel'])
                ->parse($template);
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

        $options['restricted_mode'] = !empty($options['restricted_mode']);
        $options['lite'] = !empty($options['lite']);
        $options['encode'] = !empty($options['encode']);
        $options['noimage'] = !empty($options['noimage']);
        $options['strict'] = !empty($options['strict']);
        $options['rel'] = (string) $options['rel'];

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $parser = new \Netcarver\Textile\Parser($options['doctype']);

        if ($options['encode'])
        {
            $template = $parser->textileEncode($template);
        }
        else
        {
            $template = $parser
                ->setRestricted($options['restricted_mode'])
                ->setLite($options['lite'])
                ->setBlockTags(true)
                ->setImages(!$options['noimage'])
                ->setLinkRelationShip($options['rel'])
                ->parse($template);
        }

        return $this->output($template, $return, $ci, $is_mx);
    }

}
