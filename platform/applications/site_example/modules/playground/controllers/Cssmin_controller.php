<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
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

        $output = null;

        $validation_rules = array(
            array(
                'field' => 'input',
                'label' => 'Input CSS source',
                'rules' => 'trim'
            ),
        );

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {

            $output = $this->parser->parse_string($this->input->post('input'), null, true, 'cssmin');

        } elseif (validation_errors()) {

            $output = null;

            $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
            $this->template->set('validation_errors', validation_errors_array());
        }

        $this->template
            ->set(compact('output'))
            ->build('cssmin');
    }

}
