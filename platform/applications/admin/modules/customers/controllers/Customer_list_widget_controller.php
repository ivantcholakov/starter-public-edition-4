<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Customer_list_widget_controller extends Base_Widget_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
/*
          $this->load->model('products');
            $total_customer_count = (int) $this->customers
                ->select('COUNT(id)')
                ->as_value()
                ->first();
        } else {
            $total_customer_count = 0;
        }
*/
        // Fake values:
        $total_customer_count = 50;
        $data = compact(
            'total_customer_count'
        );
        $this->load->view('customer_list_widget', $data);
    }
}
