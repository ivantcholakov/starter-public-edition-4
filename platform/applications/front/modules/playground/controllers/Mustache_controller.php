<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014 - 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Mustache_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Mustache Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/mustache'));
        ;

        $this->registry->set('nav', 'playground/mustache');
    }

    public function index() {

        $data = $this->_get_data();
        $data_json = json_encode($data);
        $parsed_template_view_name = 'countries.mustache';
        $parsed_template_path = $this->load->path($parsed_template_view_name);
        $mustache_template = file_get_contents($parsed_template_path);
        $mustache_result = $this->load->view($parsed_template_view_name, $data, true);

        $this->template
            ->set('data', $data)
            ->set('data_json', $data_json)
            ->set('mustache_template', $mustache_template)
            ->set('mustache_result', $mustache_result)
            ->set_partial('scripts', 'mustache_scripts')
            ->build('mustache');
    }

    protected function _get_data() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, null, PREG_SPLIT_NO_EMPTY);

        foreach ($items as & $item) {

            $values = explode(';', $item);
            $item = (array('code' => $values[0], 'name' => $values[1]));
        }

        $data = array(
            'BASE_URI' => BASE_URI,
            'data' => $items
        );

        return $data;
    }

}
