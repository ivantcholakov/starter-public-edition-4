<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Login_controller extends Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->set_layout('login');
		$this->load->model('users_model');
    }

    public function index() {
        if ( $this->load->database() === FALSE )
        {
           exit('THE END IS NIGH!');
        }
        $this->load->library('form_validation');
        $login_rules = array(
            array(
                'field' => 'username',
                'label' => $this->lang->line('ui_username').' / '.'E-mail',
                'rules' => 'nohtml|trim|max_length[256]|required'
            ),

            array(
                'field' => 'password',
                'label' => 'lang:ui_password',
                'rules' => 'nohtml|trim|max_length[256]|required'
            ),
        );
        $this->form_validation->set_rules($login_rules);
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // Implement your own login system.
            if ($this->_login($username, $password)) {
                if ($this->input->get('continue')) {
                    redirect($this->input->get('continue'));
                }
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
                $this->template->set('error_message', $error_message);
            }
            
        }
        elseif (validation_errors()) {
            $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
            $this->template->set('validation_errors', validation_errors_array());
        }
        // $data['dt'] = $this->Demo_model->country_display();
        // echo "<pre>";
        // print_r($data['dt']); die();
        $this->template
            ->prepend_title('Login')
            // ->set_partial('scripts', 'login_scripts')
            ->build('login');
    }

	function user_login_check()
    {
		$username = $this->input->post('username');
        $password = $this->input->post('password');
		$ok_to_login = $this->users_model->login_attempts();
        if ($ok_to_login)
        {
            $login = $this->users_model->login($this->input->post('username', TRUE), $password);
            if($login)
            {
				$history = $this->users_model->login_history($this->input->post('username', TRUE), $password);
                $this->session->set_userdata('logged_in', $login);
				if ($this->session->userdata('redirect')==5)
				{
					die('if');
					$redirect = $this->session->userdata('redirect');
					$this->session->unset_userdata('redirect');
					redirect($redirect);
				}
				else
				{
					$logged_in_user = $this->session->userdata('logged_in');
					if ($logged_in_user['is_admin']=='1')
					{
						redirect('dashboard');
					}
					else
					{
						die('For Now Only Admin Can Login.');
						redirect(base_url('account/dashboard'));
					}
				}
            }else
			{
				 $this->session->set_flashdata('errors',"User Name And Password Dose Not Match!");
            	 redirect('login');
			}
           // $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
           // return FALSE;
        }
        //$this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        //return FALSE;
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('/');
    }
}
