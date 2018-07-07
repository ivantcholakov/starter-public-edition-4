<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_graph_widget_controller extends Base_Widget_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {

        // Fake values:
        $total_page_count = 8;
        $total_news_count = 1;
        $total_gallery_count = 5;
        $total_slideshow_count = 2;
        $total_category_count = 5;
        $total_product_count = 50;
        $data = compact(
            'total_page_count',
            'total_news_count',
            'total_gallery_count',
            'total_slideshow_count',
            'total_category_count',
            'total_product_count'
        );
        $this->load->view('dashboard_graph_widget', $data);
    }
}
