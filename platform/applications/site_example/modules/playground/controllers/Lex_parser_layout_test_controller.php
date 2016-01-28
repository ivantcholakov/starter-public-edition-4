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
            ->set_theme('front_theme_bs')
            ->set_layout('default_test.lex.html')
        ;
    }

    public function index() {

        $php_min = '5.3';

        if (!is_php($php_min)) {

            $this->output->set_output('PHP '.$php_min.' is required for Lex parser.');
            return;
        }

        $this->template->build('lex_parser_layout_test');
    }

}
