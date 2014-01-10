<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Server_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('REST Server Test')
        ;
    }

    public function index() {

        $this->template->build('rest/server');
    }

}
