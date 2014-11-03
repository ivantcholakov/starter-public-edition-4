<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Country_dropdown_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('countries');
        $this->load->helper('html');
    }

    public function index($config = array()) {

        if (!is_array($config)) {
            $config = array();
        }

        $element_name = isset($config['element_name']) && $config['element_name'] != '' ? nohtml($config['element_name']) : 'country_id';
        $element_id = isset($config['element_id']) && $config['element_id'] != '' ? nohtml($config['element_id']) : $element_name;
        $element_class = isset($config['element_class']) && $config['element_class'] != '' ? nohtml($config['element_class']) : '';

        $value = isset($config['value']) ? (int) $config['value'] : null;
        $language = isset($config['language']) ? (string) $config['language'] : null;

        $options = $this->countries->get_dropdown($language);
        $codes = $this->countries->get_dropdown_codes();

        $this->load->view('country_dropdown_widget', compact('element_name', 'element_id', 'element_class', 'value', 'language', 'options', 'codes'), false, 'i18n');
    }

}
