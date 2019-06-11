<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Payments_buttons_widget_controller extends Base_Widget_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
/*
        $this->load->model('pages');
        $total_page_count = (int) $this->pages
            ->select('COUNT(id)')
            ->as_value()
            ->first();
        if ($this->settings->get('has_news')) {
            $this->load->model('news');
            $total_news_count = (int) $this->news
                ->select('COUNT(id)')
                ->as_value()
                ->first();
        } else {
            $total_news_count = 0;
        }
        if ($this->settings->get('has_gallery')) {
            $this->load->model('gallery');
            $total_gallery_count = (int) $this->gallery
                ->select('COUNT(id)')
                ->as_value()
                ->first();
        } else {
            $total_gallery_count = 0;
        }
        $this->load->model('slideshow');
        $total_slideshow_count = (int) $this->slideshow
            ->select('COUNT(id)')
            ->as_value()
            ->first();
        if ($this->settings->get('has_product_catalog')) {
            $this->load->model('categories');
            $total_category_count = (int) $this->categories
                ->select('COUNT(id)')
                ->as_value()
                ->first();
            $this->load->model('products');
            $total_product_count = (int) $this->products
                ->select('COUNT(id)')
                ->as_value()
                ->first();
        } else {
            $total_category_count = 0;
            $total_product_count = 0;
        }
*/
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
        $this->load->view('payments_buttons_widget', $data);
    }
}
