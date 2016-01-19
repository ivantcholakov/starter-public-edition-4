<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Playground_Base_Controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template->set_breadcrumb('<i class="fa fa-sun-o"></i> '.'The Palyground', site_url('playground'));
    }

}
