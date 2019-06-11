<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Dashboard.php
 *
 * @package     CI-ACL
 * @author      Steve Goodwin
 * @copyright   2015 Plumps Creative Limited
 */
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if( ! $this->ion_auth->logged_in() )
            redirect('/login');
    }

    public function index()
    {
        $data['users_groups']           =   $this->ion_auth->get_users_groups()->result();
        $data['users_permissions']      =   $this->ion_auth_acl->build_acl();

        $this->load->view('admin/dashboard', $data);
    }

}