<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Login_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('kcaptcha', null, 'captcha')
            ->language('captcha')
        ;

        $this->template->set_layout('admin_example_login');
    }

    public function index() {

        $this->load->library('form_validation');

        $login_rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'captcha',
                'label' => 'Captcha',
                'rules' => 'nohtml|trim|callback__captcha'
            ),
        );

        $this->form_validation->set_rules($login_rules);

        $error_message = $this->session->flashdata('error_message');

        if ($this->form_validation->run()) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Implement your own login system.
            if ($this->_login($username, $password)) {

                $this->session->set_flashdata('confirmation_message', '<nobr>Hello, <strong>'.$username.'</strong>.</nobr>');
                redirect(site_url());

            } else {

                $error_message = 'Wrong username or password.';
                // Code for the real authentication system.
                //switch ($this->_last_login_error()) {
                //
                //    case LOGIN_USER_UNVERIFIED:
                //        $error_message = 'The user account has not been verified by e-mail.';
                //        break;
                //
                //    case LOGIN_USER_SUSPENDED:
                //        $error_message = 'The user has been suspended';
                //        break;
                //
                //    default:
                //        $error_message = $error_message = 'Wrong username or password.';
                //        break;
                //}

            }

        } elseif (validation_errors()) {

            $error_message = '<ul>'.validation_errors('<li>', '</li>').'</ul>';
        }

        $this->captcha->clear();

        $this->template
            ->prepend_title('Login')
            ->set('error_message', $error_message)
            ->set_partial('scripts', 'login_scripts')
            ->enable_parser_body('i18n')
            ->build('login');
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
