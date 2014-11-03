<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends Core_Model {

    public $protected_attributes = array('id');

    protected $_table = 'countries';
    protected $return_type = 'array';

    public function __construct() {

        parent::__construct();
    }

    public function get_dropdown($language = null) {

        // Note: The parameter $language is not used here,
        // translation of country names is not supported by this demo code.

        return $this->dropdown('id', 'name');
    }

    public function get_dropdown_codes() {

        return $this->dropdown('id', 'code');
    }

}
