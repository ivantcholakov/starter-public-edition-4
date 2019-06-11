<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_Controller {

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();

        // load the users model
        $this->load->model('users_model');
		$this->load->model('emailtemplate_model');
		$this-> load->library('email');
		 

        // load the users language file
        $this->lang->load('users');
    }


    /**************************************************************************************
    * PUBLIC FUNCTIONS
    **************************************************************************************/


    /**
    * Default
    */
    function index() {
	
	}


    /**
    * Validate login credentials
    */
    function login()
    {
        if ($this->session->userdata('logged_in'))
        { 
            $logged_in_user = $this->session->userdata('logged_in');
            //var_dump($logged_in_user);
            //die();

            if ($logged_in_user['is_admin'])
            {
                redirect('admin');
            }
            else
            {
                redirect(base_url());
            }
        }
        // set form validation rules
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username_email'), 'required|trim|max_length[256]');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|max_length[72]|callback__check_login');

        if ($this->form_validation->run() == TRUE)
        {
            if ($this->session->userdata('redirect'))
            {
                // redirect to desired page
                $redirect = $this->session->userdata('redirect');
                $this->session->unset_userdata('redirect');
                redirect($redirect);
            }
            else
            {
                $logged_in_user = $this->session->userdata('logged_in');
                if ($logged_in_user['is_admin'])
                {
                    // redirect to admin dashboard
                    redirect('admin');
                }
                else
                {

					// $this->users_model->login_history($id);

                    // redirect to landing page
                    redirect(base_url('account/dashboard'));
                }
            }
        }

        // setup page header data
        $this->set_title(lang('users title login'));

		$this->add_css_theme('https://geteverpay.netlify.com/assets/css/login-signup2233.css');

        $data = $this->includes;

        // load views
        $data['content'] = $this->load->view('account/login', NULL, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Logout
     */
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();

        redirect('login');
    }


    /**
     * Registration Form
     */
    function signup()
    {   
        // validators
  //       $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
  //       $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username');
  //       $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
  //       $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
  //       $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email');
		// $this->form_validation->set_rules('phone', lang('users input phone'), 'required|trim|numeric|max_length[12]|min_length[11]');
  //       $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
  //       $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|min_length[5]');
  //       $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'required|trim|matches[password]');

  //       if ($this->form_validation->run() == TRUE)
  //       {
  //           // save the changes
  //           $validation_code = $this->users_model->create_profile($this->input->post());

  //           if ($validation_code)
  //           {
		// 		$email_template = $this->emailtemplate_model->get_email_template(23);
  //               // build the validation URL
  //               $encrypted_email = sha1($this->input->post('email', TRUE));
  //               $validation_url  = base_url('user/validate') . "?e={$encrypted_email}&c={$validation_code}";

		// 		// variables to replace
		// 		$site_name = $this->settings->site_name;

		// 		$rawstring = $email_template['message'];

		// 		// what will we replace
		// 		$placeholders = array('[SITE_NAME]', '[CHECK_LINK]');

		// 		$vals_1 = array($site_name, $validation_url);

		// 		//replace
		// 		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		// 		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		// 		$this->email->to($this->input->post('email', TRUE));
		// 		//$this -> email -> to($user['email']);
		// 		$this -> email -> subject($email_template['title']);

		// 		$this -> email -> message($str_1);

		// 		$this->email->send();

  //               $this->session->language = $this->input->post('language');
  //               $this->lang->load('users', $this->user['language']);
  //               $this->session->set_flashdata('message', sprintf(lang('users msg register_success'), $this->input->post('first_name', TRUE)));
		// 		redirect(site_url('login'));
  //           }
  //           else
  //           {
  //               $this->session->set_flashdata('error', lang('users error register_failed'));
  //               redirect($_SERVER['REQUEST_URI'], 'refresh');
  //           }

  //       }

        // setup page header data
        $this->set_title( lang('users title register') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => base_url(),
            'user'              => NULL,
            'password_required' => TRUE
        );

        // $content_data['acrionReg'] = site_url('user/reg_email');

        $this->session->unset_userdata('reg_code');
        $this->session->unset_userdata('reg_email');
        $this->session->unset_userdata('reg_username');
        $this->session->unset_userdata('reg_is_admin');
        $this->session->unset_userdata('reg_code_verification');

        // load views
        
        $data['content'] = $this->load->view('user/profile_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    /**
     * vb8
     */
    public function reg_email()
    {
        
		$data['email'] = $this->input->post('email');
		$data['username'] = $this->input->post('username');
    $data['is_admin'] = $this->input->post('is_admin');

        $validation_code_email = $this->users_model->chk_email_duplicate($data['email']);
        $validation_code_username = $this->users_model->chk_username_duplicate($data['username']);

        if ($validation_code_email=='true'){
            echo 'email';
        } else if($validation_code_username=='true'){
            echo 'unm';
        } else{ 

            $six_digit_random_number = mt_rand(100000, 999999);
                
             $config = array(
                    'protocol' => 'mail',
                    'smtp_host' => 'info@everpayinc.com',
                    'smtp_port' => 25 , // or 587
                    'smtp_user' => 'info@everpayinc.com',
                    'smtp_pass' => 'TL42eQ!',
                    'charset' => 'utf-8',
                    'mailtype' => 'html'
                );

                $msg = "<div style='width:100%!important;min-width:100%;font-size:15px;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;color:#42464d'>
                                <table  style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0;color:#42464d'>
                                  <tbody><tr>
                                    <td>
                                      <table class='m_2526241974629449980header' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;color:#fff;margin:0 auto;padding:0'>
                                        <tbody><tr>
                                          <td>
                                            <center>
                                              <table class='m_2526241974629449980header_content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0'>
                                                <tbody><tr>
                                                  <td>
                                                    <center>
                                                            <div style='margin-top:15px'>
                                                                <img alt='#' src='https://id.everpayinc.com/themes/default/img/logo-mail-black.png' width='160' class='CToWUd'>
                                                            </div>
                                                    </center>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </center>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                      <div class='' style='padding:20px 0px 40px;margin:10px 0;border-bottom:1px solid #efefef;color:#333'>
                                        <table class='m_2526241974629449980content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;margin:0 auto;padding:0;font-size:15px;font-family:Arial,Helvetica,sans-serif'>
                                          <tbody><tr>
                                            <td><center>
                                              </center></td><td>
                                                <div style='font-family:Arial,Helvetica,sans-serif'>
                                                    <table style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;padding:0;font-family:Arial,Helvetica,sans-serif;'>
                                                                <tbody><tr>
                                                                 <td style='padding-bottom:15px'>
                                                                   <span style='font-size:28px'><b>You're so close! Just confirm your email address</b></span>
                                                                 </td>
                                                                </tr>
                                                                <tr>
                                                                 <td>
                                                                   <span style='font-size:16px'>Enter this code in the browser where you started signing up.</span>
                                                                 </td>
                                                                </tr>
                                                                <tr>
                                                                  <td style='padding-top:25px;padding-bottom:25px' align='center'>
                                                                    <span style='font-size:35px'>".$six_digit_random_number."</span>
                                                                  </td>
                                                                </tr>
                                                              </tbody></table>
                                              </div>
                                              </td>
                                          </tr>
                                        </tbody></table>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody></table>";

                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('no-reply@everpayinc.com'); 
                $this->email->to($data['email']);
                $this->email->subject('Everypay Registration Code');
                $this->email->message($msg);  

                $this->email->send(); 

                $this->session->set_userdata('reg_code', $six_digit_random_number);
                $this->session->set_userdata('reg_email', $data['email']);
                $this->session->set_userdata('reg_username', $data['username']);
                $this->session->set_userdata('reg_is_admin', $data['is_admin']);

                 
            echo $data['is_admin'];
           
        }
    }

    function send_again_code_verification()
    {
        $this->session->unset_userdata('reg_code');
        $six_digit_random_number = mt_rand(100000, 999999);
                
        $config = array(
                'protocol' => 'mail',
                'smtp_host' => 'info@everpayinc.com',
                'smtp_port' => 25 , // or 587
                'smtp_user' => 'info@everpayinc.com',
                'smtp_pass' => 'TL42eQ!',
                'charset' => 'utf-8',
                'mailtype' => 'html'
        );

        $msg = "<div style='width:100%!important;min-width:100%;font-size:15px;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;color:#42464d'>
    <table  style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0;color:#42464d'>
      <tbody><tr>
        <td>
          <table class='m_2526241974629449980header' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;color:#fff;margin:0 auto;padding:0'>
            <tbody><tr>
              <td>
                <center>
                  <table class='m_2526241974629449980header_content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0'>
                    <tbody><tr>
                      <td>
                        <center>
                                <div style='margin-top:15px'>
                                    <img alt='#' src='https://id.everpayinc.com/themes/default/img/logo-mail-black.png' width='160' class='CToWUd'>
                                </div>
                        </center>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </center>
              </td>
            </tr>
          </tbody></table>
          <div class='' style='padding:20px 0px 40px;margin:10px 0;border-bottom:1px solid #efefef;color:#333'>
            <table class='m_2526241974629449980content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;margin:0 auto;padding:0;font-size:15px;font-family:Arial,Helvetica,sans-serif'>
              <tbody><tr>
                <td><center>
                  </center></td><td>
                    <div style='font-family:Arial,Helvetica,sans-serif'>
                        <table style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;padding:0;font-family:Arial,Helvetica,sans-serif;'>
                                    <tbody><tr>
                                     <td style='padding-bottom:15px'>
                                       <span style='font-size:28px'><b>You're so close! Just confirm your email address</b></span>
                                     </td>
                                    </tr>
                                    <tr>
                                     <td>
                                       <span style='font-size:16px'>Enter this code in the browser where you started signing up.</span>
                                     </td>
                                    </tr>
                                    <tr>
                                      <td style='padding-top:25px;padding-bottom:25px' align='center'>
                                        <span style='font-size:35px'>".$six_digit_random_number."</span>
                                      </td>
                                    </tr>
                                  </tbody></table>
                  </div>
                  </td>
              </tr>
            </tbody></table>
          </div>
        </td>
      </tr>
    </tbody></table>";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('accounts@everpayinc.com'); 
        $this->email->to($this->session->userdata('reg_email'));
        $this->email->subject('Everypay Registration Code');
        $this->email->message($msg);    

        $this->email->send();
        $this->session->set_userdata('reg_code', $six_digit_random_number);

        echo 'success';
    }

    function code_verification()
    {
        if($this->session->userdata('reg_code') != '' && $this->session->userdata('reg_email') != '' && $this->session->userdata('reg_is_admin') != ''){
            $this->load->view('account/code_validtor');  
        }else{
             $this->signup();
        }  
    }

    function chk_code_verification()
    {
        $code = $this->input->post('code');

        if($code == $this->session->userdata('reg_code'))
        {
            $this->session->set_userdata('reg_code_verification', 'true');
            echo $this->session->userdata('reg_is_admin');
        }else{
            echo 'flase';
        }
    }

    function after_code_verification()
    {
        if($this->session->userdata('reg_code_verification') == 'true'){
             // setup page header data
            $this->set_title( lang('users title register') );

            $data = $this->includes;
            $content_data = array(
                'cancel_url'        => base_url(),
                'user'              => NULL,
                'password_required' => TRUE
            );
            $this->load->view('user/reg');
        }else{
            $this->signup();
        }
    }

    function add_register_data()
    {
        $Userdata['is_admin'] = $this->session->userdata('reg_is_admin');
        
        if($Userdata['is_admin'] == 2){         // For User
          $redirect_link = "https://shop.everpayinc.com/" ;
        }else if($Userdata['is_admin'] == 3){   // For Partners
          $redirect_link = "https://partners.everpayinc.com/" ;            
        }else if($Userdata['is_admin'] == 4){   // For Developer
          $redirect_link = "https://developer.everpayinc.com/" ;
        }else if($Userdata['is_admin'] == 5){   // For Merchant
          $redirect_link = "https://app.everpayinc.com/" ;
        }

        $Userdata['email'] = $this->input->post('email');
        $Userdata['username'] = $this->input->post('username');
        $Userdata['first_name'] = $this->input->post('first_name');
        $Userdata['last_name'] = $this->input->post('last_name');
        $Userdata['phone'] = $this->input->post('phone');
        $Userdata['language'] = $this->input->post('language');

        $salt     = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));
        $password = hash('sha512', $this->input->post('password') . $salt);

        $Userdata['salt'] = $salt;
        $Userdata['password'] =$password;
        $Userdata['status'] = '1';
        $Userdata['verifi_status'] = '1';
        $Userdata['created'] = date('Y-m-d H:i:s');

        $Infodata['business_name'] = $this->input->post('business_name');
        $Infodata['business_type'] = $this->input->post('business_type');
        $Infodata['business_phone'] = $this->input->post('business_phone');
        $Infodata['website'] = $this->input->post('website');
        $Infodata['business_address'] = $this->input->post('business_address');
        $Infodata['postal_code'] = $this->input->post('postal_code');
        $Infodata['country'] = $this->input->post('country');
        $Infodata['city'] = $this->input->post('city');
        $Infodata['state'] = $this->input->post('state');
        $Infodata['sdate'] = date('Y-m-d H:i:s',strtotime($this->input->post('sdate')));
        $Infodata['created'] = date('Y-m-d H:i:s');

        $Processdata['industry'] = $this->input->post('industry');
        $Processdata['subscriptions'] = $this->input->post('subscriptions');
        $Processdata['refund_policy'] = $this->input->post('refund_policy');
        $Processdata['braintree'] = $this->input->post('braintree');
        $Processdata['annual'] = $this->input->post('annual');
        $Processdata['average'] = $this->input->post('average');
        $Processdata['largest'] = $this->input->post('largest');
        $Processdata['created'] = date('Y-m-d H:i:s');



        $addData = $this->users_model->add_user_dt($Userdata,$Infodata,$Processdata);

        $this->session->unset_userdata('reg_code');
        $this->session->unset_userdata('reg_email');
        $this->session->unset_userdata('reg_username');
        $this->session->unset_userdata('reg_code_verification');
        $this->session->unset_userdata('reg_is_admin');
         
        if($addData == 'true'){

             $config = array(
                'protocol' => 'mail',
                'smtp_host' => 'info@everpayinc.com',
                'smtp_port' => 25 , // or 587
                'smtp_user' => 'info@everpayinc.com',
                'smtp_pass' => 'TL42eQ!',
                'charset' => 'utf-8',
                'mailtype' => 'html'
            );

            $msg = "<div style='width:100%!important;min-width:100%;font-size:15px;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;color:#42464d'>
              <table  style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0;color:#42464d'>
                <tbody><tr>
                  <td>
                    <table class='m_2526241974629449980header' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;color:#fff;margin:0 auto;padding:0'>
                      <tbody><tr>
                        <td>
                          <center>
                            <table class='m_2526241974629449980header_content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;margin:0;padding:0'>
                              <tbody><tr>
                                <td>
                                  <center>
                                          <div style='margin-top:15px'>
                                              <img alt='#' src='https://id.everpayinc.com/themes/default/img/logo-mail-black.png' width='160' class='CToWUd'>
                                          </div>
                                  </center>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </center>
                        </td>
                      </tr>
                    </tbody></table>
                    <div class='' style='padding:20px 0px 40px;margin:10px 0;border-bottom:1px solid #efefef;color:#333'>
                      <table class='m_2526241974629449980content' style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;max-width:640px;margin:0 auto;padding:0;font-size:15px;font-family:Arial,Helvetica,sans-serif'>
                        <tbody><tr>
                          <td><center>
                            </center></td><td>
                              <div style='font-family:Arial,Helvetica,sans-serif'>
                                  <table style='border-spacing:0;border-collapse:collapse;width:100%;vertical-align:top;padding:0;font-family:Arial,Helvetica,sans-serif;'>
                                          <tbody>
                                          <tr>
                                           <td style='padding-bottom:15px'>
                                             <span style='font-size:28px'><b>You're register sucessfully!!</b></span>
                                           </td>
                                          </tr>
                                          <tr>
                                           <td style='padding-bottom:15px'>
                                             <span style='font-size:28px'><b  style='font-size: 15px;'>Your Username : ".$Userdata['username']."</b></span>
                                           </td>
                                          </tr>
                                          <tr>
                                           <td style='padding-bottom:15px'>
                                             <span style='font-size:28px'><b  style='font-size: 15px;'>Your Email : ".$Userdata['email']."</b></span>
                                           </td>
                                          </tr>
                                          <tr>
                                           <td style='padding-bottom:15px'>
                                             <span style='font-size:28px'><b  style='font-size: 15px;'>Your Password : ".$this->input->post('password')."</b></span>
                                           </td>
                                          </tr>
                                          <tr>
                                           <td style='padding-bottom:15px'>
                                             <span style='font-size:28px;margin-left: 80px;'><b>Click Here to Login :</b><a href='".$redirect_link."' target='_blank' style='margin-left: 20px;'><button class='btn btn-block btn-primary btn-lg' style='height:51px;width:100px;font-size: 20px;'>Login</button></a></span>
                                           </td>
                                          </tr>
                                        </tbody>
                                  </table>
                            </div>
                            </td>
                        </tr>
                      </tbody></table>
                    </div>
                  </td>
                </tr>
              </tbody></table>";

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('info@everpayinc.com'); 
            $this->email->to($Userdata['email']);
            $this->email->subject('Everypay Registration Completed');
            $this->email->message($msg);  

            $this->email->send();

            $this->session->set_flashdata('success', "You are register sucessfully.");
            redirect($redirect_link);
        }else{
            $this->session->set_flashdata('errors', "Somthing wrong please try again.");
             redirect('user/signup');
        }

    }

    /**
    * Validate new account
    */
    function validate()
    {
        // get codes
        $encrypted_email = $this->input->get('e');
        $validation_code = $this->input->get('c');

        // validate account
        $validated = $this->users_model->validate_account($encrypted_email, $validation_code);

        if ($validated)
        {
            $this->session->set_flashdata('message', lang('users msg validate_success'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error validate_failed'));
        }

        redirect(base_url());
    }


    /**
	* Forgot password
    */
	function forgot()
	{
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email_exists');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $results = $this->users_model->reset_password($this->input->post());

            if ($results)
            {
				$email_template = $this->emailtemplate_model->get_email_template(24);

                // build email
                $reset_url  = base_url('login');
                $email_msg  = lang('core email start');
                $email_msg .= sprintf(lang('users msg email_password_reset'), $this->settings->site_name, $results['new_password'], $reset_url, $reset_url);
                $email_msg .= lang('core email end');

				// variables to replace
				$site_name = $this->settings->site_name;

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]','[PASSWORD]', '[LOGIN_LINK]');

				$vals_1 = array($site_name, $results['new_password'], $reset_url);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to($this->input->post('email', TRUE));
				//$this -> email -> to($user['email']);
				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

                $this->session->set_flashdata('message', sprintf(lang('users msg password_reset_success'), $results['first_name']));
				redirect(site_url('login'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error password_reset_failed'));
            }

        }

        // setup page header data
        $this->set_title( lang('users title forgot') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url' => base_url(),
            'user'       => NULL
        );

        // load views
        $data['content'] = $this->load->view('account/forgot_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**************************************************************************************
    * PRIVATE VALIDATION CALLBACK FUNCTIONS
    **************************************************************************************/


    /**
     * Verify the login credentials
     *
     * @param  string $password
     * @return boolean
     */
    function _check_login($password)
    {
        // limit number of login attempts
        $ok_to_login = $this->users_model->login_attempts();

        if ($ok_to_login)
        {
            $login = $this->users_model->login($this->input->post('username', TRUE), $password);

            if ($login)
            {
				$history = $this->users_model->login_history($this->input->post('username', TRUE), $password);
                $this->session->set_userdata('logged_in', $login);
                return TRUE;
            }

            $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
            return FALSE;
        }

        $this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        return FALSE;
    }

    /**
     * Make sure username is available
     *
     * @param  string $username
     * @return int|boolean
     */
    function _check_username($username)
    {
        if ($this->users_model->username_exists($username))
        {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        }
        else
        {
            return $username;
        }
    }


    /**
     * Make sure email is available
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email($email)
    {
        if ($this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }


    /**
     * Make sure email exists
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email_exists($email)
    {
        if ( ! $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email_exists', sprintf(lang('users error email_not_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

}