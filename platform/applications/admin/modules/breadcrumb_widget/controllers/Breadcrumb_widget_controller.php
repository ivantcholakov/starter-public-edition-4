<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Breadcrumb_widget_controller extends Base_Widget_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $breadcrumbs = template_breadcrumbs();
        $n = count($breadcrumbs);

        if (empty($breadcrumbs) || !is_array($breadcrumbs) || $n <= 1) {
            return;
        }

        $data = compact(
            'breadcrumbs',
            'n'
        );

        $this->load->view('breadcrumb_widget', $data);
    }

}
