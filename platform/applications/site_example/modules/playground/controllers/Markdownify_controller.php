<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Markdownify_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->parser();

        $title = 'Markdownify Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/markdownify'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        try {
            $html = str_replace('BASE_URL', base_url(), $this->load->view('test.textile', null, true, 'textile'));
        } catch (Exception $e) {
            $html = $e->getMessage();
        }

        $text = $this->parser->parse_string($html, null, true, 'markdownify');

        $this->template
            ->set(compact('text', 'html'))
            ->build('markdownify');
    }

}
