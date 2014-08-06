<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Authenticated_Ajax_Controller extends Base_Ajax_Controller {

    public function __construct() {

        parent::__construct();

        $this->_check_access();
    }

}
