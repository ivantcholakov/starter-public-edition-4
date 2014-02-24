<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class Error_404_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        set_status_header(404);

        $title = $this->lang->line('ui_error_404');

        $this->template
            ->title($title)
            ->build('error_404');
    }

}
