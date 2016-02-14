<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Twig_template_inheritance_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Twig Template Inheritance Test';

        $this->template->append_title($title);

        $this->template
            ->set_theme('front_theme_bs')
            ->set_layout('direct')
        ;
    }

    public function index() {

        $php_min = '5.2.7';

        if (!is_php($php_min)) {

            $this->output->set_output('PHP '.$php_min.' is required for Lex parser.');
            return;
        }

        $this->template
            ->set('text_in_body', 'This is a dynamic text displayed within the template body.')
            ->build('twig_template_inheritance_test.html');
    }

}
