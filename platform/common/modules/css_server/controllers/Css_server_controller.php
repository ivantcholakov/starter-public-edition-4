<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Easing LESS development - compilation "on-the-fly" with caching.
 *
 * All the CSS files defined within the configuration file
 * config/less_compile.php could also be compiled "on-the-fly"
 * during development. Delete a chosen static CSS file that has been
 * previously created by the less-compiler. Then the less-compiler would
 * provide the requested CSS-source under the same requested URL.
 * When development ends, before uploading the site on the production
 * server, use the command-line less compiler as it has been described
 * within config/less_compile.php for producing the final static CSS files.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Css_server_controller extends Core_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->helper('file');
    }

    public function index() {

        $filename = implode('/', array_slice($this->uri->rsegments, 2));
        $filename = preg_replace('/\.{2,}/', '', $filename); // Sanitazing the name.

        $base_path = DEFAULTFCPATH;

        if (defined('APPSEGMENT') && APPSEGMENT != '') {
            $base_path .= APPSEGMENT.'/';
        }

        $file_path = $base_path.$filename;

        $this->config->load('less_compile', false, true);

        $less_compile_config =
            !empty($this->config->config['less_compile']) && is_array($this->config->config['less_compile'])
            ? $this->config->config['less_compile']
            : array();

        if (empty($less_compile_config)) {

            $this->_show_404();
            return;
        }

        $found = false;

        foreach ($less_compile_config as $options) {

            $name = isset($options['name']) ? (string) $options['name'] : '';
            $source = isset($options['source']) ? (string) $options['source'] : '';
            $destination = isset($options['destination']) ? (string) $options['destination'] : '';

            if ($destination == $file_path && $name != '' && $source != '' && $destination != '') {

                $found = true;
                break;
            }
        }

        if (!$found) {

            $this->_show_404();
            return;
        }

        unset($options['name']);
        unset($options['source']);
        unset($options['destination']);

        $cache_dir = WRITABLEPATH.'cache_lessphp/'.sha1($name).'/';
        is_dir($cache_dir) OR @mkdir($cache_dir, 0755, TRUE);

        $options['cache_dir'] = $cache_dir;
        $options['cache_method'] = 'serialize';

        $this->output->set_content_type('text/css');
        $this->output->set_output(@ (string) file_get_contents($cache_dir.Less_Cache::Get(array($source => ''), $options)));
    }

    protected function _show_404() {

        $this->output->set_status_header(404)->set_output('Not Found');
    }

}
