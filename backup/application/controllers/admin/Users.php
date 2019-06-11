<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    /**
     * @var string
     */
    private $_redirect_url;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('users');

        // load the users model
        $this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->library('currencys');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/users'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "last_name");
        define('DEFAULT_DIR', "asc");

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * User list page
     */
    function index()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('username'))
        {
						$username_xss = $this->security->xss_clean($this->input->get('username'));
						$username_string = str_replace(' ', '-', $username_xss);
						$username_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $username_string);
            $filters['username'] = $username_replace;
        }

        if ($this->input->get('first_name'))
        {
						$first_name_xss = $this->security->xss_clean($this->input->get('first_name'));
						$first_name_string = str_replace(' ', '-', $first_name_xss);
						$first_name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $first_name_string);
            $filters['first_name'] = $first_name_replace;
        }

        if ($this->input->get('last_name'))
        {
						$last_name_xss = $this->security->xss_clean($this->input->get('last_name'));
						$last_name_string = str_replace(' ', '-', $last_name_xss);
						$last_name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $last_name_string);
            $filters['last_name'] = $last_name_replace;
        }

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }

                if ($this->input->post('first_name'))
                {
                    $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
                }

                if ($this->input->post('last_name'))
                {
                    $filter .= "&last_name=" . $this->input->post('last_name', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $users = $this->users_model->get_all($limit, $offset, $filters, $sort, $dir);
				// get list
        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $users['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme( "users_i18n.js", TRUE )
			->set_title( lang('users title user_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $users['results'],
            'total'      => $users['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/users/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Add new user
     */
    function add()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username[]');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[]');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('status', lang('users input status'), 'required|numeric');
		$this->form_validation->set_rules('phone', lang('users input phone'), 'required|numeric');
        $this->form_validation->set_rules('is_admin', lang('users input is_admin'), 'required|numeric');
		$this->form_validation->set_rules('verifi_status', lang('users input verifi_status'), 'required|numeric');
		$this->form_validation->set_rules('fraud_status', lang('users input fraud_status'), 'required|numeric');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'required|trim|matches[password]');

        if ($this->form_validation->run() == TRUE)
        {
            // save the new user
            $saved = $this->users_model->add_user($this->input->post());

            if ($saved)
            {
            $this->session->set_flashdata('message', sprintf(lang('users msg add_user_success'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }
            else
            {
            $this->session->set_flashdata('error', sprintf(lang('users error add_user_failed'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('users title user_add') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('admin/users/add', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Edit existing user
     *
     * @param  int $id
     */
    function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $user = $this->users_model->get_user($id);

        // if empty results, return to list
        if ( ! $user)
        {
            redirect($this->_redirect_url);
        }

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username[' . $user['username'] . ']');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[' . $user['email'] . ']');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('status', lang('users input status'), 'required|numeric');
		$this->form_validation->set_rules('phone', lang('users input phone'), 'required|numeric');
		$this->form_validation->set_rules('debit_base', lang('users input debit_base'), 'required|numeric');
		$this->form_validation->set_rules('debit_extra1', lang('users input debit_base'), 'required|numeric');
		$this->form_validation->set_rules('debit_extra2', lang('users input debit_base'), 'required|numeric');
		$this->form_validation->set_rules('debit_extra3', lang('users input debit_base'), 'required|numeric');
		$this->form_validation->set_rules('debit_extra4', lang('users input debit_base'), 'required|numeric');
		$this->form_validation->set_rules('debit_extra5', lang('users input debit_base'), 'required|numeric');
        $this->form_validation->set_rules('is_admin', lang('users input is_admin'), 'required|numeric');
		$this->form_validation->set_rules('verifi_status', lang('users input verifi_status'), 'required|numeric');
		$this->form_validation->set_rules('fraud_status', lang('users input fraud_status'), 'required|numeric');
        $this->form_validation->set_rules('password', lang('users input password'), 'min_length[5]|matches[password_repeat]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'matches[password]');
			
		$log_user = $this->users_model->get_log_user($user['username']);
		$log_user_mail = $this->users_model->get_log_user_mail($user['email']);
		$log_transactions = $this->users_model->get_log_transactions($user['username']);
		$log_transactions_in = $this->users_model->get_log_transactions_in($user['username']);
		$log_verify = $this->users_model->get_log_doc($user['username']);

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->users_model->edit_user($this->input->post());

            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('users msg edit_user_success'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('users error edit_user_failed'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('users title user_edit') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'             => $this->_redirect_url,
            'user'                   => $user,
			'log_user'               => $log_user,
			'log_user_mail'          => $log_user_mail,
			'log_verify'             => $log_verify,
			'log_transactions'       => $log_transactions,
			'log_transactions_in'    => $log_transactions_in,
            'user_id'                => $id,
            'password_required'      => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/users/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }	
	
	/**
     * Add transaction (deposit)
     */
	function add_user_transaction($id)
	{
		// get the data
        $user = $this->users_model->get_user($id);
			
		$currency = $this->input->post("currency");
		$amount = $this->input->post("amount");
		$user_comment = $this->input->post("user_comment");
		$admin_comment = $this->input->post("admin_comment");
		$type = $this->input->post("type");
			
		$this->form_validation->set_rules('currency', lang('users input status'), 'required');
		$this->form_validation->set_rules('amount', lang('users input status'), 'required|numeric');
		$this->form_validation->set_rules('type', lang('admin trans type'), 'required|numeric');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/users"));
		}else{
					
			$total = $user[$currency]+$amount;

			// update user wallet
			$this->users_model->update_wallet($id,
				array(
					$currency => $total,
					)
				);
			
			$transactions = $this->transactions_model->add_transaction(array(
				"type" 				=> $type,
				"sum"  				=> $amount,
				"fee"    			=> "0",
				"amount" 			=> $amount,
				"currency"			=> $currency,
				"status" 			=> "2",
				"sender" 			=> "system",
				"receiver" 			=> $user['username'],
				"time"              => date('Y-m-d H:i:s'),
				"user_comment"      => $user_comment,
				"admin_comment"     => $admin_comment
				)
			);


			$this->session->set_flashdata('message', lang('admin trans add_success'));
			redirect(site_url("admin/users"));
					
		}

	}
	
	/**
     * Debit balance
     */
	function add_debit_user_transaction($id)
	{
			
		// get the data
        $user = $this->users_model->get_user($id);
			
		$currency = $this->input->post("currency");
		$amount = $this->input->post("amount");
		$user_comment = $this->input->post("user_comment");
		$admin_comment = $this->input->post("admin_comment");
		$type = $this->input->post("type");
			
		$this->form_validation->set_rules('currency', lang('users input status'), 'required');
		$this->form_validation->set_rules('amount', lang('users input status'), 'required|numeric');
		$this->form_validation->set_rules('type', lang('admin trans type'), 'required|numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/users"));
		}else{
			
			$total = $user[$currency]-$amount;

			// update user wallet
			$this->users_model->update_wallet($id,
				array(
					$currency => $total,
				)
			);
			
			$transactions = $this->transactions_model->add_transaction(array(
				"type" 				=> $type,
				"sum"  				=> $amount,
				"fee"    			=> "0",
				"amount" 			=> $amount,
				"currency"			=> $currency,
				"status" 			=> "2",
				"sender" 			=> "system",
				"receiver" 			=> $user['username'],
				"time"              => date('Y-m-d H:i:s'),
				"user_comment"      => $user_comment,
				"admin_comment"     => $admin_comment
				)
			);

			$this->session->set_flashdata('message', lang('admin trans add_success'));
			redirect(site_url("admin/users"));
					
		}

	}


    /**
     * Delete a user
     *
     * @param  int $id
     */
    function delete($id = NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details
            $user = $this->users_model->get_user($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->users_model->delete_user($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $user['first_name'] . " " . $user['last_name']));
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $user['first_name'] . " " . $user['last_name']));
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error user_not_exist'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error user_id_required'));
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }


    /**
     * Export list to CSV
     */
    function export()
    {
        // get parameters
        $sort = $this->input->get('sort') ? $this->input->get('sort', TRUE) : DEFAULT_SORT;
        $dir  = $this->input->get('dir')  ? $this->input->get('dir', TRUE)  : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('first_name'))
        {
            $filters['first_name'] = $this->input->get('first_name', TRUE);
        }

        if ($this->input->get('last_name'))
        {
            $filters['last_name'] = $this->input->get('last_name', TRUE);
        }

        // get all users
        $users = $this->users_model->get_all(0, 0, $filters, $sort, $dir);

        if ($users['total'] > 0)
        {
            // manipulate the output array
            foreach ($users['results'] as $key=>$user)
            {
                unset($users['results'][$key]['password']);
                unset($users['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $users['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $users['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($users['results'], "users");
        }
        else
        {
            // nothing to export
            $this->session->set_flashdata('error', lang('core error no_results'));
            redirect($this->_redirect_url);
        }

        exit;
    }


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Make sure username is available
     *
     * @param  string $username
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_username($username, $current)
    {
        if (trim($username) != trim($current) && $this->users_model->username_exists($username))
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
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_email($email, $current)
    {
        if (trim($email) != trim($current) && $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

}