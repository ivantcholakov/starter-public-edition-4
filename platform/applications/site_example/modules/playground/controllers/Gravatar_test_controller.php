<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Gravatar_test_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('kcaptcha', null, 'captcha')
            ->language('captcha')
        ;

        $this->load->library('gravatar');

        $this->template
            ->title('Gravatar Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $validation_rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'nohtml|trim|required|valid_email'
            ),
            array(
                'field' => 'captcha',
                'label' => 'Captcha',
                'rules' => 'nohtml|trim|callback__captcha'
            ),
        );

        $email = null;
        $gravatar = null;
        $profile = null;

        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run()) {

            $email = $this->input->post('email');

            $gravatar = $this->gravatar->get($email);
            $profile = $this->gravatar->get_profile_data($email);

        } elseif (validation_errors()) {

            $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
            $this->template->set('validation_errors', validation_errors_array());
        }

        $this->captcha->clear();

        $this->template
            ->set(compact('email', 'gravatar', 'profile'))
            ->enable_parser_body('i18n')
            ->build('gravatar_test');
    }

    public function _captcha($string) {

        $captcha_valid = $this->captcha->valid($string);
        $this->captcha->clear();

        if (!$captcha_valid) {
            $this->form_validation->set_message('_captcha', $this->lang->line('captcha.validation_error'));
        }

        return $captcha_valid;
    }

}
