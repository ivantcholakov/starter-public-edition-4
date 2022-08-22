<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_test_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'CodeIgniter\'s Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/parser-test'));
        ;

        $this->registry->set('nav', 'playground/parser_test');
    }

    public function index() {

        $data = $this->_get_data();
        $parsed_template_view_name = 'countries.parser.php';
        $parsed_template_path = $this->load->path($parsed_template_view_name);
        $parsed_template = file_get_contents($parsed_template_path);

        $parsed_result_2 = $this->parser->parse_string($parsed_template, $data, true);
        $parsed_result_3 = $this->parser->parse($parsed_template_view_name, $data, true);
        $parsed_result_4 = $this->parser->parse($parsed_template_path, $data, true, array('parser' => array('full_path' => true)));

        $this->template
            ->set('BASE_URI', BASE_URI)
            ->set('data', $data['data'])
            ->set('parsed_result_2', $parsed_result_2)
            ->set('parsed_result_3', $parsed_result_3)
            ->set('parsed_result_4', $parsed_result_4)
            ->build('parser_test');
    }

    protected function _get_data() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($items as & $item) {

            $values = explode(';', $item);
            $item = array('code' => $values[0], 'name' => $values[1], 'BASE_URI' => BASE_URI);
        }

        $data = array(
            'BASE_URI' => BASE_URI,
            'data' => $items
        );

        return $data;
    }

}
