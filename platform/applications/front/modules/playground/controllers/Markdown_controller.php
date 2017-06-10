<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Markdown_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Markdown Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/markdown'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $text =  $this->load->source('test.md');
        $html = $this->load->view('test.md', null, true);

        $this->template
            ->set(compact('text', 'html'))
            ->build('markdown');
    }

}
