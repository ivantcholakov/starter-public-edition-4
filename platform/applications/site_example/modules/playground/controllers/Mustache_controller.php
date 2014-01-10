<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Mustache_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->parser();

        $this->template
            ->title('Mustache Test')
        ;
    }

    public function index() {

        $data = $this->_get_data();
        $mustache_template = $this->_get_template();

        $this->template
            ->set('data', $data)
            ->set('mustache_template', $mustache_template)
            ->set_partial('scripts', 'mustache_scripts')
            ->build('mustache');
    }

    protected function _get_data() {

        $csv = (string) file_get_contents(dirname(__FILE__).'/countries.csv');

        $items = preg_split('/\R/m', $csv, null, PREG_SPLIT_NO_EMPTY);

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

    protected function _get_template() {

        return $this->load->view('countries.mustache', null, true);
    }

}
