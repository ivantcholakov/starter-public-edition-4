<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * LESS Assets Compiler
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Compile_controller extends Core_Controller {

    protected $items;

    public function __construct() {

        parent::__construct();

        if (!IS_CLI) {
            show_404();
        }

        $this->config->load('less_compile', false, true);

        $this->items
            = !empty($this->config->config['less_compile']) && is_array($this->config->config['less_compile'])
            ? $this->config->config['less_compile']
            : array();

        $this->load->parser();
        $this->load->helper('file');
    }

    public function index() {

        $args = array_slice($this->uri->rsegment_array(), 2);

        foreach ($this->items as $options) {

            $name = isset($options['name']) ? (string) $options['name'] : null;

            if (!empty($args)) {

                if (!in_array($name, $args)) {
                    continue;
                }
            }

            $source = isset($options['source']) ? (string) $options['source'] : '';
            $destination = isset($options['destination']) ? (string) $options['destination'] : '';

            if ($source == '' || $destination == '') {
                continue;
            }

            unset($options['source']);
            unset($options['destination']);
            $options['full_path'] = true;

            $dir = pathinfo($destination, PATHINFO_DIRNAME);
            file_exists($dir) OR mkdir($dir, 0755, TRUE);

            try {
                write_file($destination, $this->parser->parse($source, null, true, array('less' => $options)));
            } catch(Exception $e) {
                echo $e->getMessage().PHP_EOL;
            }
        }
    }

}
