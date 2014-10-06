<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends Core_Model {

    public $protected_attributes = array('id');

    protected $_table = 'countries';
    protected $return_type = 'array';

    public function __construct() {

        parent::__construct();
    }

}
