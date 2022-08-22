<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Handlebars_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Handlebars Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/handlebars'));
        ;

        $this->registry->set('nav', 'playground/handlebars');
    }

    public function index() {

        $data = $this->_get_data();
        $data_json = json_encode($data);
        $parsed_template_view_name = 'countries.handlebars';
        $parsed_template_path = $this->load->path($parsed_template_view_name);
        $handlebars_template = file_get_contents($parsed_template_path);
        $handlebars_result = $this->load->view($parsed_template_view_name, $data, true);

        $this->template
            ->set('data', $data)
            ->set('data_json', $data_json)
            ->set('handlebars_template', $handlebars_template)
            ->set('handlebars_result', $handlebars_result)
            ->set_partial('scripts', 'handlebars_scripts')
            ->build('handlebars');
    }

    protected function _get_data() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, -1, PREG_SPLIT_NO_EMPTY);

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
