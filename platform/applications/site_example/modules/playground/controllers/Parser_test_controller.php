<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->parser();

        $this->template
            ->title('CodeIgniter\'s Parser Test')
        ;

        $this->registry->set('nav', 'playground/parser_test');
    }

    public function index() {

        $data = $this->_get_data();
        $parsed_template = $this->_get_template();

        $parsed_result_2 = $this->parser->parse_string($parsed_template, $data, true);

        $this->template
            ->set('BASE_URI', BASE_URI)
            ->set('data', $data['data'])
            ->set('parsed_result_2', $parsed_result_2)
            ->enable_parser_body('parser')
            ->build('parser_test');
    }

    protected function _get_data() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, null, PREG_SPLIT_NO_EMPTY);

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

    protected function _get_template() {

        return $this->load->view('countries.parser.php', null, true);
    }

}
