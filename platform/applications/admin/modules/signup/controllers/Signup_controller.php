<?php defined('BASEPATH') OR exit('No direct script access allowed.');

class Signup_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->template->set_layout('signup');
        $this->load->model('users_model');
    }

    public function index() {

        $this->load->library('form_validation');
        $login_rules = array(
            array(
                'field' => 'username',
                'label' => $this->lang->line('ui_username').' / '.'Username',
                'rules' => 'nohtml|trim|max_length[256]|required'
            ),
                 array(
                'field' => 'email',
                'label' => $this->lang->line('ui_email').' / '.'E-mail',
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
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->_signup($username, $password)) {

                if ($this->input->get('continue')) {
                    redirect($this->input->get('continue'));
                }

                $this->session->set_flashdata('confirmation_message', '<nobr>Your Account has been created, <strong>'.$username.'please follow the istrustions in your email to finish setting up your account</strong>.</nobr>');
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

        } elseif (validation_errors()) {

            $this->template->set('error_message', '<ul>'.validation_errors('<li>', '</li>').'</ul>');
            $this->template->set('validation_errors', validation_errors_array());
        }

        $this->session->unset_userdata('reg_code');
        $this->session->unset_userdata('reg_email');
        $this->session->unset_userdata('reg_username');
        $this->session->unset_userdata('reg_is_admin');
        $this->session->unset_userdata('reg_code_verification');

         $this->template
         ->prepend_title('Get Started')
         ->build('signup');

            // $this->template
            // ->prepend_title('Get Started')
            // ->set_partial('scripts', 'signup_scripts')
            // ->build('signup');
    }

    public function reg_email()
    {

        $data['email'] = $this->input->post('email');
        $data['username'] = $this->input->post('username');
        $data['is_admin'] = $this->input->post('is_admin');


        $validation_code_email = $this->users_model->chk_email_duplicate($data['email']);
        $validation_code_username = $this->users_model->chk_username_duplicate($data['username']);


        if ($validation_code_email=='true'){
              // echo 'email';
            $this->session->set_flashdata('errors',"Email Id Allready Exits.");
            redirect('signup');
        } else if($validation_code_username=='true'){
            // echo 'unm';
            $this->session->set_flashdata('errors',"User Name Allready Exits.");
            redirect('signup');
        }
        else{
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

             // $config = array(
             //      'protocol' => 'mail',
             //      'smtp_host' => 'info@gladxsolution.com',
             //      'smtp_port' => 25 , // or 587
             //      'smtp_user' => 'info@gladxsolution.com',
             //      'smtp_pass' => 'Gladxsol!009',
             //      'charset' => 'utf-8',
             //      'mailtype' => 'html'
             //  );

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
                                                                <img alt='#' src='".base_url()."assets/images/logo-mail-black.png' width='160' class='CToWUd'>
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
                // $this->email->from('no-reply@everpayinc.com');
                $this->email->from('info@gladxsolution.com');
                $this->email->to($data['email']);
                $this->email->subject('Everypay Registration Code');
                $this->email->message($msg);

                $this->email->send();

                $this->session->set_userdata('reg_code', $six_digit_random_number);
                $this->session->set_userdata('reg_email', $data['email']);
                $this->session->set_userdata('reg_username', $data['username']);
                $this->session->set_userdata('reg_is_admin', $data['is_admin']);


            // echo $data['is_admin'];
                if($data['is_admin']=='2'){
                    redirect('customer');
                    //window.location.href = '<?php echo site_url("user");
                }else if($data['is_admin']=='3'){
                   redirect('business');
                   //window.location.href = '<?php echo site_url("partners");
                }

        }
    }

    function code_verification()
    {
        if($this->session->userdata('reg_code') != '' && $this->session->userdata('reg_email') != '' && $this->session->userdata('reg_is_admin') != ''){
              $this->template
               ->prepend_title('Get Started')
               ->build('code_validtor');
            // $this->load->view('account/code_validtor');
        }else{
             redirect('signup');
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

        // $config = array(
        //       'protocol' => 'mail',
        //       'smtp_host' => 'info@gladxsolution.com',
        //       'smtp_port' => 25 , // or 587
        //       'smtp_user' => 'info@gladxsolution.com',
        //       'smtp_pass' => 'Gladxsol!009',
        //       'charset' => 'utf-8',
        //       'mailtype' => 'html'
        //   );

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
                                    <img alt='#' src='".base_url()."assets/images/logo-mail-black.png' width='160' class='CToWUd'>
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
        // $this->email->from('accounts@everpayinc.com');
        $this->email->from('info@gladxsolution.com');
        $this->email->to($this->session->userdata('reg_email'));
        $this->email->subject('Everypay Registration Code');
        $this->email->message($msg);

        $this->email->send();
        $this->session->set_userdata('reg_code', $six_digit_random_number);

        // echo 'success';
         if($this->session->userdata('reg_is_admin') == '2' ){
            $this->session->set_flashdata('success', "New Code Send On Your E-mail.. Please Check Again.");
              redirect('customer');
          }else if($this->session->userdata('reg_is_admin') == '3' ){
            $this->session->set_flashdata('success', "New Code Send On Your E-mail.. Please Check Again.");
             redirect('business');
          }
    }

    function chk_code_verification()
    {

        $c1 = $this->input->post('code_1');
        $c2 = $this->input->post('code_2');
        $c3 = $this->input->post('code_3');
        $c4 = $this->input->post('code_4');
        $c5 = $this->input->post('code_5');
        $c6 = $this->input->post('code_6');
        $code = $c1.$c2.$c3.$c4.$c5.$c6 ;
        if($code == $this->session->userdata('reg_code'))
        {
            $this->session->set_userdata('reg_code_verification', 'true');
            // echo "true";
            // echo json_encode("true");
            if($this->session->userdata('reg_is_admin') == '2' ){
              redirect('customer-detail');
            }else if($this->session->userdata('reg_is_admin') == '3' ){
               redirect('business-detail');
            }
        }else{
            if($this->session->userdata('reg_is_admin') == '2' ){
             $this->session->set_flashdata('errors',"Your Code Is Not Correnct.. Please Try Again");
             redirect('customer');
          }else if($this->session->userdata('reg_is_admin') == '3' ){
             $this->session->set_flashdata('errors',"Your Code Is Not Correnct.. Please Try Again");
             redirect('business');
          }
        }
    }

    function after_code_verification()
    {
        if($this->session->userdata('reg_code_verification') == 'true'){

             // setup page header data
            // $this->set_title( ang('users title register'));

            // $data = $this->includes;
            // $content_data = array(
            //     'cancel_url'        => base_url(),
            //     'user'              => NULL,
            //     'password_required' => TRUE
            // );
            // $this->load->view('user/reg');
              $this->template
               // ->prepend_title('Get Started')
               ->build('reg');
        }else{
          redirect('signup');
        }
    }

    function add_register_data()
    {
        $Userdata['is_admin'] = $this->session->userdata('reg_is_admin');

        if($Userdata['is_admin'] == 3){   // For Customer
          $redirect_link = "https://partners.everpayinc.com/" ;
        }else if($Userdata['is_admin'] == 4){   // For Business
          $redirect_link = "http://developer.everpayinc.com/" ;
        }
        $redirect_link = base_url();

        $Userdata['uuid'] = uniqid();
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




        // print_r($Userdata); echo '<br><br>';
        // print_r($Infodata); echo '<br><br>';
        // print_r($Processdata); echo '<br><br>';

        // die();

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

            //  $config = array(
            //     'protocol' => 'mail',
            //     'smtp_host' => 'info@gladxsolution.com',
            //     'smtp_port' => 25 , // or 587
            //     'smtp_user' => 'info@gladxsolution.com',
            //     'smtp_pass' => 'Gladxsol!009',
            //     'charset' => 'utf-8',
            //     'mailtype' => 'html'
            // );

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
                                              <img alt='#' src='".base_url()."assets/images/logo-mail-black.png' width='160' class='CToWUd'>
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
            $this->email->from('info@gladxsolution.com');
        // $this->email->from('accounts@everpayinc.com');
            $this->email->to($Userdata['email']);
            $this->email->subject('Everypay Registration Completed');
            $this->email->message($msg);

            $this->email->send();

            $this->session->set_flashdata('success', "You are register sucessfully.");
            // redirect($redirect_link);
             redirect('signup');
        }else{
            $this->session->set_flashdata('errors', "Somthing wrong please try again.");
             redirect('signup');
        }

    }


}
