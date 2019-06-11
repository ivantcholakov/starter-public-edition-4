<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Cssmin_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'CSS Minification Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/cssmin'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $input = null;
        $output = null;

        $clear_form = (bool) $this->input->post('test_form_clear');
        $is_example = (bool) $this->input->post('test_form_example');

        if ($clear_form) {

            // Do nothing, all has been already initialized.

        } elseif ($is_example) {

            $input = $this->load->source('test.css');

            try {
                $output = $this->parser->parse_string($input, null, true, 'cssmin');
            } catch(Exception $e) {
                $output = $e->getMessage();
            }

        } else {

            $validation_rules = array(
                array(
                    'field' => 'input',
                    'label' => 'Input CSS source',
                    'rules' => 'trim'
                ),
            );

            $this->form_validation->set_rules($validation_rules);

            if ($this->form_validation->run()) {

                $input = $this->input->post('input');

                try {
                    $output = $this->parser->parse_string($input, null, true, 'cssmin');
                } catch(Exception $e) {
                    $output = $e->getMessage();
                }

            } elseif (validation_errors()) {

                $output = null;

                $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
                $this->template->set('validation_errors', validation_errors_array());
            }
        }

        $this->template
            ->set('clear_form', $clear_form)
            ->set('is_example', $is_example)
            ->set('input', $input)
            ->set('output', $output)
            ->build('cssmin');
    }

}
