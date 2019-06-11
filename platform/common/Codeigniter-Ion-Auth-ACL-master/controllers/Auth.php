<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Auth.php
 *
 * @package     CI-ACL
 * @author      Steve Goodwin
 * @copyright   2015 Plumps Creative Limited
 */
class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('/login');
    }

    public function login()
    {
        if( $this->ion_auth->logged_in() ) redirect('/dashboard');

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        $this->form_validation->set_message('required', 'Please enter your %s');

        //  Validate form
        if( $this->form_validation->run() )
        {
            $remember   =   (bool) $this->input->post('remember');

            //  Check login
            if( $this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember) )
            {
                //  Login was successful
                redirect('/dashboard', 'refresh');
            }
            else
            {
                //  Login was un-successful
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh');
            }
        }
        else
        {
            $data['message']    =   $this->session->flashdata('message');

            $this->load->view('auth/login', $data);
        }
    }

    public function logout()
    {
        if( $this->ion_auth->logout() )
            redirect('/login');
        else
            die("There was an error logging you out");
    }

}
