<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_smileys extends CI_Parser_driver {

    protected $config;
    private $ci;

    public function initialize()
    {
        $this->ci = get_instance();

        $this->ci->load
            ->helper('asset')
            ->helper('smiley')
        ;

        // Default configuration options.

        $this->config = array(
            'image_url' => null,
            'smileys' => null,
        );

        if ($this->ci->config->load('parser_smileys', TRUE, TRUE))
        {
            $this->config = array_merge($this->config, $this->ci->config->item('parser_smileys'));
        }

        if ($this->config['image_url'] == '') {
            $this->config['image_url'] = image_url('lib/smileys/');
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

        log_message('info', 'CI_Parser_auto_link Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if ($options['image_url'] == '') {
            $options['image_url'] = image_url('lib/smileys/');
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
        $template = parse_smileys(@ file_get_contents($template), (string) $options['image_url'], $options['smileys']);

        return $this->output($template, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if ($options['image_url'] == '') {
            $options['image_url'] = image_url('lib/smileys/');
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        $template = parse_smileys($template, (string) $options['image_url'], $options['smileys']);

        return $this->output($template, $return, $ci, $is_mx);
    }

}
