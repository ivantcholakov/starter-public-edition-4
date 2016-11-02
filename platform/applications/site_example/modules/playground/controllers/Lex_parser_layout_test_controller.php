<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Lex_parser_layout_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Lex Parser Layout Test';

        $this->template->append_title($title);

        $this->template
            ->set_theme('front_semantic_ui_default')
            ->set_layout('default_test.lex.html')
        ;
    }

    public function index() {

        $this->template->build('lex_parser_layout_test');
    }

}
