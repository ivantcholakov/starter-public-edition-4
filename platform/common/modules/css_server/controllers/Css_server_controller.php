<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Easing SCSS and LESS development - compilation "on-the-fly" with caching.
 *
 * All the CSS files defined within the configuration files
 * config/scss_compile.php and config/less_compile.php could also be compiled
 * "on-the-fly" during development. Delete a chosen static CSS file that has been
 * previously created by a scss or less compiler. Then the correcponding compiler
 * would provide the requested CSS-source under the same requested URL.
 * When development ends, before uploading the site on the production
 * server, use the command-line scss or less compiler for producing the final
 * static CSS file(s).
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

        $this->config->load('scss_compile', false, true);

        $scss_compile_config =
            !empty($this->config->config['scss_compile']) && is_array($this->config->config['scss_compile'])
            ? $this->config->config['scss_compile']
            : array();

        $this->config->load('less_compile', false, true);

        foreach ($scss_compile_config as $options) {

            $name = isset($options['name']) ? (string) $options['name'] : '';
            $source = isset($options['source']) ? (string) $options['source'] : '';
            $destination = isset($options['destination']) ? (string) $options['destination'] : '';

            if ($destination == $file_path && $name != '' && $source != '' && $destination != '') {

                $this->_compile_scss($options);
                return;
            }
        }

        $less_compile_config =
            !empty($this->config->config['less_compile']) && is_array($this->config->config['less_compile'])
            ? $this->config->config['less_compile']
            : array();

        foreach ($less_compile_config as $options) {

            $name = isset($options['name']) ? (string) $options['name'] : '';
            $source = isset($options['source']) ? (string) $options['source'] : '';
            $destination = isset($options['destination']) ? (string) $options['destination'] : '';

            if ($destination == $file_path && $name != '' && $source != '' && $destination != '') {

                $this->_compile_less($options);
                return;
            }
        }

        $this->_show_404();
    }

    protected function _compile_scss($options) {

        $php_min = '5.4';

        if (!is_php($php_min)) {

            $this->_show_500('Requires PHP '.$php_min.' or above.');
            return;
        }

        $name = $options['name'];
        $source = $options['source'];
        $destination = $options['destination'];

        unset($options['name']);
        unset($options['source']);
        unset($options['destination']);

        $defaults = array(
            'import_paths' => array(''),
            'number_precision' => 5,
            'formatter' => 'expanded',
            'line_number_style' => null,
        );

        if ($this->config->load('parser_scss', TRUE, TRUE)) {
            $defaults = array_merge($defaults, $this->config->item('parser_scss'));
        }

        $options = array_merge($defaults, $options);

        $cache_dir = WRITABLEPATH.'cache_scssphp/'.sha1($name).'/';
        is_dir($cache_dir) OR @mkdir($cache_dir, DIR_WRITE_MODE, TRUE);

        $allowed_formatters = array(
            'expanded',
            'nested',
            'compressed',
            'compact',
            'crunched',
        );

        $_GET['p'] = basename($source);

        $parser_reflection = new ReflectionClass('Leafo\ScssPhp\Compiler');
        $parser = $parser_reflection->newInstance();

        $parser->setImportPaths($options['import_paths']);
        $parser->addImportPath(dirname($source));
        $parser->setNumberPrecision($options['number_precision']);

        $formatter = $options['formatter'];

        if (!in_array($formatter, $allowed_formatters)) {
            $formatter = 'expanded';
        }

        $formatter = 'Leafo\ScssPhp\Formatter\\'.ucfirst($formatter);
        $parser->setFormatter($formatter);

        $parser->setLineNumberStyle($options['line_number_style']);

        $server_reflection = new ReflectionClass('Leafo\ScssPhp\Server');
        $server = $server_reflection->newInstance(dirname($source), $cache_dir, $parser);

        $server->serve();
    }

    protected function _compile_less($options) {

        $name = $options['name'];
        $source = $options['source'];
        $destination = $options['destination'];

        unset($options['name']);
        unset($options['source']);
        unset($options['destination']);

        $defaults = array(
            'compress' => FALSE,
            'strictUnits' => FALSE,
            'uri_root' => '',
        );

        if ($this->config->load('parser_less', TRUE, TRUE)) {
            $defaults = array_merge($defaults, $this->config->item('parser_less'));
        }

        $options = array_merge($defaults, $options);

        $cache_dir = WRITABLEPATH.'cache_lessphp/'.sha1($name).'/';
        is_dir($cache_dir) OR @mkdir($cache_dir, DIR_WRITE_MODE, TRUE);

        $options['cache_dir'] = $cache_dir;
        $options['cache_method'] = 'serialize';

        $this->output->set_content_type('text/css');
        $this->output->set_output(@ (string) file_get_contents($cache_dir.Less_Cache::Get(array($source => ''), $options)));
    }

    protected function _show_404() {

        $this->output->set_status_header(404)->set_output('Not Found');
    }

    protected function _show_500($error_message) {

        $this->output->set_status_header(500)->set_output($error_message);
    }

}
