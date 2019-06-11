<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Private_Controller {

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();
			
		require './Twilio/autoload.php';

		// load the language file
        $this->lang->load('users');

        // load the users model
        $this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('disputes_model');
		$this->load->model('tickets_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
		$this->load->model('verification_model');
		$this->load->model('merchants_model');
		$this->load->model('vouchers_model');
		$this->lang->load('currency');
		$this->load->library('commission');
		$this->load->library('email');
			
		// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('account/history'));
		define('THIS_URL_2', base_url('account/dispute'));
		define('THIS_URL_3', base_url('account/tickets'));
		define('THIS_URL_4', base_url('account/merchants'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "desc");

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


    /**
	* Dashboard
    */
	function dashboard()
	{
    	// setup page header data
        $this->set_title(sprintf(lang('users title dasboard'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
		$history = $this->users_model->get_history($user['username']);

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'              => $user,
			'history'			=> $history,
        );

        // load views
        $data['content'] = $this->load->view('account/dashboard', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Vouchers
    */
	function vouchers()
	{
		$user = $this->users_model->get_user($this->user['id']);
		$username = $user['username'];
		
		// get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
        $filters = array();
			
		if ($this->input->get('id'))
        {
            $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }
		
		// build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }
			
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

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
			$vouchers = $this->vouchers_model->get_user_vouchers($limit, $offset, $filters, $sort, $dir, $username);	
		}
		
        // setup page header data
        $this->set_title(sprintf(lang('users vouchers menu'), $this->settings->site_name));
		// reload the new user data and store in session

        $data = $this->includes;
					
		$vouchers = $this->vouchers_model->get_user_vouchers($limit, $offset, $filters, $sort, $dir, $username);
		
		$user = $this->users_model->get_user($this->user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $vouchers['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'username'   => $username,
            'this_url'   => THIS_URL,
            'vouchers'   => $vouchers['results'],
            'total'      => $vouchers['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );


        // load views
        $data['content'] = $this->load->view('account/vouchers', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Activate voucher
    */
	function activate_code()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users vouchers menu'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/activate_code', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	*  Start new code voucher
    */
	function start_new_code()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		// Check fraud 
		if ($user['fraud_status']>0) {
			
			$this->session->set_flashdata('error', lang('users error fraud'));
	        redirect(site_url("account/new_code"));
			
    	} else {
			
			$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
			$this->form_validation->set_rules('currency', lang('users transfer amount'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error', lang('users vouchers error_new'));
				redirect(site_url("account/new_code"));

			} else {
				
				$amount = $this->input->post("amount");
				$currency = $this->input->post("currency");
				
				$percent = $this->settings->com_transfer/"100";
				$fee = $amount*$percent;
				$sum = $fee+$amount;
				
				// Check wallet
				if ($user[$currency]<$sum) {

					$this->session->set_flashdata('error', lang('users error wallet'));
					redirect(site_url("account/new_code"));

				} else {
					
					$hash_string=
						$user['username'].':'.$user['salt'].':'.
						$sum.':'.
						date('Y-m-d H:i:s');

					$code=strtoupper(md5($hash_string));
					
					$total = $user[$currency]-$sum;
					
					// update sender wallet
					$this->users_model->update_wallet_transfer($user['username'],
						array(
							$currency => $total,
						)
					);
					
					// add transaction for sender
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 					=> "2",
						"sum"  					=> $sum,
						"fee"    				=> $fee,
						"amount" 				=> $amount,
						"currency"				=> $currency,
						"status" 				=> "2",
						"sender" 				=> $user['username'],
						"receiver" 				=> "system",
						"time"          		=> date('Y-m-d H:i:s'),
						"user_comment"  		=> 'Create voucher '.$code.'',
						"admin_comment" 		=> "none"
						)
					);
					
					// add voucher in base
					$voucher = $this->vouchers_model->add_voucher(array(
						"code" 					=> $code,
						"date_creature" 		=> date('Y-m-d H:i:s'),
						"creator"    			=> $user['username'],
						"amount" 				=> $amount,
						"currency"				=> $currency,
						"date_activation" 		=> "0000-00-00 00:00:00",
						"activator" 			=> "none",
						"status" 				=> "1"
						)
					);
					
					$this->session->set_flashdata('message', lang('users vouchers success_new'));
					redirect(site_url('account/vouchers'));
					
				}
				
			}
			
		}
		
	}
	
	/**
	*  New voucher page
    */
	function new_code()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users vouchers menu'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/new_code', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	
	/**
	 * Start activate code 
     */
	function start_activate_code()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		// Check fraud 
		if ($user['fraud_status']==2) {
			
		$this->session->set_flashdata('error', lang('users error fraud'));
      	redirect(site_url("account/activate_code"));
			
    	} else {
			
			$this->form_validation->set_rules('code', lang('users vouchers code'), 'required|trim');
			
			if ($this->form_validation->run() == FALSE)
			{

				$this->session->set_flashdata('error', lang('users vouchers error'));
				redirect(site_url("account/activate_code"));

			} else {
				
				$code = $this->input->post("code");
				
				$check_code = $this->vouchers_model->validate_code($code);
				
				// if empty results, return to list
		        if ( ! $check_code)
		        {
		        	$this->session->set_flashdata('error', lang('users vouchers error'));
							redirect(site_url("account/activate_code"));
		        } else {
					
					$currency_code = $check_code['currency'];
					
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 					=> "1",
						"sum"  					=> $check_code['amount'],
						"fee"    				=> "0",
						"amount" 				=> $check_code['amount'],
						"currency"				=> $currency_code,
						"status" 				=> "2",
						"sender" 				=> "System",
						"receiver" 				=> $user['username'],
						"time"          		=> date('Y-m-d H:i:s'),
						"user_comment"  		=> 'Activate voucher '.$check_code['code'].'',
						"admin_comment" 		=> "none"
						)
					);
					
					$total = $user[$currency_code]+$check_code['amount'];
			
					// update wallet
					$this->users_model->update_wallet_transfer($user['username'],
						array(
							$currency_code => $total,
						)
					);
					
					// update status voucher
					$this->vouchers_model->update_voucher($code,
						array(
							"status" 			=> "2",
							"date_activation" 	=> date('Y-m-d H:i:s'),
							"activator" 		=> $user['username'],
						)
					);
					
					$this->session->set_flashdata('message', lang('users vouchers success'));
					redirect(site_url('account/history'));
					
				}
				
			}
			
		}
		
	}
	
	/**
	* Operation history
    */
	function history()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		$username = $user['username'];
		
		// get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
        $filters = array();
			
		if ($this->input->get('id'))
        {
            $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }

        if ($this->input->get('type'))
        {
            $type_xss = $this->security->xss_clean($this->input->get('type'));
						$type_string = str_replace(' ', '-', $type_xss);
						$type_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $type_string);
            $filters['type'] = $type_replace;
        }

        if ($this->input->get('status'))
        {
            $status_xss = $this->security->xss_clean($this->input->get('status'));
						$status_string = str_replace(' ', '-', $status_xss);
						$status_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $status_string);
            $filters['status'] = $status_replace;
        }
			
		if ($this->input->get('time'))
        {
            $time_xss = $this->security->xss_clean($this->input->get('time'));
						$time_string = str_replace(' ', '-', $time_xss);
						$time_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_string);
            $filters['time'] = $time_replace;
        }
		
		// build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }
			
		// are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            } else {

                // apply the filter(s)
                $filter = "";

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }

                if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			$history = $this->transactions_model->get_history($limit, $offset, $filters, $sort, $dir, $username);
				
		}
		
        // setup page header data
        $this->set_title(sprintf(lang('users title history'), $this->settings->site_name));
		// reload the new user data and store in session

        $data = $this->includes;
					
		$history = $this->transactions_model->get_history($limit, $offset, $filters, $sort, $dir, $username);
		
		$user = $this->users_model->get_user($this->user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $history['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'username'   => $username,
            'this_url'   => THIS_URL,
            'history'    => $history['results'],
            'total'      => $history['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );


        // load views
        $data['content'] = $this->load->view('account/history', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Detail transaction
    */
	function detail_transaction($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $transactions = $this->transactions_model->get_detail_transactions($id, $user['username']);

        // if empty results, return to list
        if ( ! $transactions)
        {
            redirect($this->_redirect_url);
        }
			
			// Check dispute history
			$dispute_history = $this->disputes_model->get_history_dispute($id);

			// if empty results, return to list
			if ( $dispute_history)
			{
				$dispute_mode = "0"; // no start dispute
			} else {
				$dispute_mode = "1"; // yes start dispute
			}

        // setup page header data
        $this->set_title( lang('users history detail') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		=> THIS_URL,
			'user'              => $user,
			'dispute_mode'      => $dispute_mode,
            'cancel_url'        => $this->_redirect_url,
            'transactions'      => $transactions,
            'transactions_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('account/detail_transaction', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * start dispute
    */
	function start_dispute($id)
	{
			
		$user = $this->users_model->get_user($this->user['id']);
		// get the data
        $transactions = $this->transactions_model->get_detail_transactions($id, $user['username']);
			
		// if empty results, return to list
	    if ( ! $transactions)
	    {
	    	redirect($this->_redirect_url);
	    }
			
		// Check dispute history
		$dispute_history = $this->disputes_model->get_history_dispute($id);
			
		// if empty results, return to list
        if ( $dispute_history)
      	{
			$this->session->set_flashdata('error', lang('users error fraud'));
      		redirect($this->_redirect_url);
      	}
			
		$this->form_validation->set_rules('title', lang('users transfer amount'), 'required|trim|in_list[1,2]');
		$this->form_validation->set_rules('message', lang('users transfer amount'), 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/history"));
		} else {

			$title = $this->input->post("title");
			$message = $this->input->post("message");
				
			if ($transactions['type']==3 && $user['username']==$transactions['sender'] && $transactions['status']==2) {
				// set content data
				$content_data = array(
					'this_url'   		=> "account/history",
					'user'              => $user,
					'cancel_url'        => $this->_redirect_url,
					'transactions'      => $transactions,
					'transactions_id'   => $id
				);

				$dispute = $this->disputes_model->add_dispute(array(
					"title"  			=> $title,
					"message" 			=> $message,
					"transaction" 		=> $transactions['id'],
					"time_transaction" 	=> $transactions['time'],
					"time_dispute"   	=> date('Y-m-d H:i:s'),
					"claimant"   		=> $user['username'],
					"defendant"   		=> $transactions['receiver'],
					"status" 			=> "1",
					"sum"   			=> $transactions['sum'],
					"fee"   			=> $transactions['fee'],
					"amount"   			=> $transactions['amount'],
					"currency"   		=> $transactions['currency']
					)
				);

				// update transaction history
				$this->transactions_model->update_dispute_transactions($transactions['id'],
					array(
						"status"   		=> "4",
						)
					);

				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(5);
				$users = $this->users_model->get_user_transfer($transactions['receiver']);

				// variables to replace
				$id_transaction = $transactions['id'];
				$claimant = $user['username'];
				$link = site_url('account/dispute');
				$site_name = $this->settings->site_name;
				$site_url = base_url();

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]', '[URL_SITE]', '[ID_TRANSACTION]', '[CLAIMANT]');

				$vals_1 = array($site_name, $link, $id_transaction, $claimant);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($user['email'], $users['email'])
				);
				//$this -> email -> to($user['email']);
				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				$this->session->set_flashdata('message', lang('users history dispute_success'));
				redirect(site_url('account/dispute'));
			} else {
				redirect(site_url('account/dispute'));
			}

		}

	}
	
	/**
    * List dispute
    */
	function dispute()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		$username = $user['username'];
		
		// get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
        $filters = array();
			
		if ($this->input->get('id'))
        {
            $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }
		
		// build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }
			
		// are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            } else {

                // apply the filter(s)
                $filter = "";

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			$dispute = $this->disputes_model->get_list_dispute($limit, $offset, $filters, $sort, $dir, $username);
				
		}
		
        // setup page header data
        $this->set_title(sprintf(lang('users title resolution'), $this->settings->site_name));
		// reload the new user data and store in session

        $data = $this->includes;
					
		$dispute = $this->disputes_model->get_list_dispute($limit, $offset, $filters, $sort, $dir, $username);
		
		$user = $this->users_model->get_user($this->user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $dispute['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'username'   => $username,
            'this_url'   => THIS_URL_2,
            'dispute'    => $dispute['results'],
            'total'    	 => $dispute['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );


        // load views
        $data['content'] = $this->load->view('account/dispute', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Detail dispute
    */
	function detail_dispute($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect(THIS_URL_2);
        }

        // get the data
        $dispute = $this->disputes_model->get_detail_dispute($id, $user['username']);
		$log_comment = $this->disputes_model->get_log_comment($dispute['id']);

        // if empty results, return to list
        if ( ! $dispute)
        {
            redirect(THIS_URL_2);
        }

        // setup page header data
        $this->set_title( lang('users title det_dispute') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   			=> THIS_URL_2,
			'user'              	=> $user,
            'cancel_url'        	=> THIS_URL_2,
            'dispute'      			=> $dispute,
			'log_comment'   		=> $log_comment,
            'dispute_id'   			=> $id
        );

        // load views
        $data['content'] = $this->load->view('account/detail_dispute', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * New dispute comment
    */
	function add_user_comment($id)
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		// get the data
        $dispute = $this->disputes_model->get_detail_dispute($id, $user['username']);
		// if empty results, return to list
        if ( ! $dispute)
        {
            redirect(THIS_URL_2);
        }
			
		$this->form_validation->set_rules('comment', lang('users transfer amount'), 'required|trim');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/dispute"));
		} else {

				if (!$dispute['comments']) {

					$comment = $this->input->post("comment");
			
					// set content data
					$content_data = array(
						'this_url'   		=> "account/dispute",
						'user'              => $user,
						'cancel_url'        => THIS_URL_2,
						'dispute'      		=> $dispute,
						'dispute_id'   		=> $id
					);

					$comments = $this->disputes_model->add_admin_comment(array(
						"id_dispute" 		=> $dispute['id'],
						"time"          	=> date('Y-m-d H:i:s'),
						"user"          	=> $user['username'],
						"role"          	=> "1",
						"comment"       	=> $comment,
						)
					);


					// Sending email

					$email_template = $this->emailtemplate_model->get_email_template(6);
					$users = $this->users_model->get_user_transfer($dispute['defendant']);

					// variables to replace
					$id_dispute = $dispute['id'];
					$link = site_url('account/dispute/');
					$site_name = $this->settings->site_name;
					$site_url = base_url();

					$rawstring = $email_template['message'];

					// what will we replace
					$placeholders = array('[SITE_NAME]', '[URL_DISPUTE]', '[ID_DISPUTE]');

					$vals_1 = array($site_name, $link, $id_dispute);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($user['email'], $users['email'])
					);

					$this -> email -> subject($email_template['title']);

					$this -> email -> message($str_1);

					$this->email->send();
						
					$sms_template = $this->smstemplate_model->get_sms_template(11);
						
					if($sms_template['enable']) {
						// Twilio user number
						$to = '+'.$user['phone'];
						// Your Account SID and Auth Token from twilio.com/console
						$sid = $this->settings->twilio_sid;
						$token = $this->settings->twilio_token;
						$client = new Twilio\Rest\Client($sid, $token);

						// Use the client to do fun stuff like send text messages!
						$client->messages->create(
						// the number you'd like to send the message to
							$to,
								array(
								// A Twilio phone number you purchased at twilio.com/console
								'from' => '+'.$this->settings->twilio_number,
								// the body of the text message you'd like to send
								'body' => $sms_template['message']
							)
						);
							
						$to = '+'.$users['phone'];
						// Your Account SID and Auth Token from twilio.com/console
						$sid = $this->settings->twilio_sid;
						$token = $this->settings->twilio_token;
						$client = new Twilio\Rest\Client($sid, $token);

						// Use the client to do fun stuff like send text messages!
						$client->messages->create(
						// the number you'd like to send the message to
							$to,
								array(
								// A Twilio phone number you purchased at twilio.com/console
								'from' => '+'.$this->settings->twilio_number,
									// the body of the text message you'd like to send
								'body' => $sms_template['message']
								)
							);
						}

					$this->session->set_flashdata('message', lang('users disputes comment_success'));
					redirect(site_url("account/dispute"));

				} else {
					redirect(THIS_URL_2);
				}		
			}
	}
	
	/**
    * Open claim
    */
	function open_claim($id)
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		// get the data
        $dispute = $this->disputes_model->get_detail_dispute($id, $user['username']);
		// if empty results, return to list
        if ( ! $dispute)
        {
            redirect(THIS_URL_2);
        }
			
		if ($dispute['status']==1) {
		// update dispute
		$this->disputes_model->update_dispute($id,
			array(
				"status"   => "2",
				"comments" => "1",
				)
			);

		// set content data
		$content_data = array(
			'this_url'   		=> "account/dispute",
			'user'              => $user,
			'cancel_url'        => THIS_URL_2,
			'dispute'      		=> $dispute,
			'dispute_id'   		=> $id
		);

		// add notification comment listing
		$comments = $this->disputes_model->new_comment(array(
			"id_dispute" 		=> $dispute['id'],
			"user" 		      	=> $user['username'],
			"role" 		      	=> "3",
			"comment" 		  	=> lang('users disputes transferred'),
			"time"          	=> date('Y-m-d H:i:s'),
			)
		);
					
		// update user fraud status
		$this->users_model->update_user($dispute['defendant'],
			array(
				"fraud_status"   => "1",
				)
			);

		// Sending email

		$email_template = $this->emailtemplate_model->get_email_template(7);
		$users = $this->users_model->get_user_transfer($dispute['defendant']);

		// variables to replace
		$id_dispute = $dispute['id'];
		$link = site_url('account/dispute/');
		$site_name = $this->settings->site_name;

		$rawstring = $email_template['message'];

		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_DISPUTE]', '[ID_DISPUTE]');

		$vals_1 = array($site_name, $link, $id_dispute);

		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'], $users['email'])
		);

		$this -> email -> subject($email_template['title']);

		$this -> email -> message($str_1);

		$this->email->send();
					
		$sms_template = $this->smstemplate_model->get_sms_template(9);
					
		if($sms_template['enable']) {
			// Twilio user number
			$to = '+'.$user['phone'];
			// Your Account SID and Auth Token from twilio.com/console
			$sid = $this->settings->twilio_sid;
			$token = $this->settings->twilio_token;
			$client = new Twilio\Rest\Client($sid, $token);

			// Use the client to do fun stuff like send text messages!
			$client->messages->create(
			// the number you'd like to send the message to
			$to,
				array(
					// A Twilio phone number you purchased at twilio.com/console
					'from' => '+'.$this->settings->twilio_number,
					// the body of the text message you'd like to send
					'body' => $sms_template['message']
				)
			);

			$to = '+'.$users['phone'];
			// Your Account SID and Auth Token from twilio.com/console
			$sid = $this->settings->twilio_sid;
			$token = $this->settings->twilio_token;
			$client = new Twilio\Rest\Client($sid, $token);

			// Use the client to do fun stuff like send text messages!
			$client->messages->create(
			// the number you'd like to send the message to
			$to,
				array(
					// A Twilio phone number you purchased at twilio.com/console
					'from' => '+'.$this->settings->twilio_number,
					// the body of the text message you'd like to send
					'body' => $sms_template['message']
				)
			);
		}

		$this->session->set_flashdata('message', lang('users disputes open_claim_success'));
		redirect(site_url("account/dispute"));

				
		} else {
			redirect(THIS_URL_2);
		}
	}
	
	/**
    * Close claim
    */
	function close_claim($id)
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		// get the data
        $dispute = $this->disputes_model->get_user_close_dispute($id, $user['username']);
		// if empty results, return to list
        if ( ! $dispute)
        {
            redirect(THIS_URL_2);
        }
			
		if ($dispute['status']!=3 && $dispute['status']!=4) {
			// update dispute
			$this->disputes_model->update_dispute($id,
				array(
					"status"   => "3",
					"comments" => "1",
				)
			);

			// set content data
			$content_data = array(
				'this_url'   		=> "account/dispute",
				'user'              => $user,
				'cancel_url'        => THIS_URL_2,
				'dispute'      		=> $dispute,
				'dispute_id'   		=> $id
			);

			// add notification comment listing
			$comments = $this->disputes_model->new_comment(array(
				"id_dispute" 		=> $dispute['id'],
				"user" 		      	=> $user['username'],
				"role" 		      	=> "4",
				"comment" 		  	=> lang('users disputes stop'),
				"time"          	=> date('Y-m-d H:i:s'),
				)
			);

			// update user fraud status
			$this->users_model->update_user($dispute['defendant'],
				array(
					"fraud_status"	=> "0",
					)
				);

			// update transaction history
			$this->transactions_model->update_dispute_transactions($dispute['transaction'],
				array(
					"status"		=> "2",
					)
				);
					
			// Sending email

			$email_template = $this->emailtemplate_model->get_email_template(8);
			$users = $this->users_model->get_user_transfer($dispute['defendant']);

			// variables to replace
			$id_dispute = $dispute['id'];
			$link = site_url('account/dispute/');
			$site_name = $this->settings->site_name;

			$rawstring = $email_template['message'];

			// what will we replace
			$placeholders = array('[SITE_NAME]', '[URL_DISPUTE]', '[ID_DISPUTE]');

			$vals_1 = array($site_name, $link, $id_dispute);

			//replace
			$str_1 = str_replace($placeholders, $vals_1, $rawstring);

			$this -> email -> from($this->settings->site_email, $this->settings->site_name);
			$this->email->to(
				array($user['email'], $users['email'])
			);

			$this -> email -> subject($email_template['title']);

			$this -> email -> message($str_1);

			$this->email->send();
					
			$sms_template = $this->smstemplate_model->get_sms_template(7);
                                                
			if($sms_template['enable']) {
				// Twilio user number
				$to = '+'.$user['phone'];
				// Your Account SID and Auth Token from twilio.com/console
				$sid = $this->settings->twilio_sid;
				$token = $this->settings->twilio_token;
				$client = new Twilio\Rest\Client($sid, $token);

				// Use the client to do fun stuff like send text messages!
				$client->messages->create(
				// the number you'd like to send the message to
				$to,
					array(
					// A Twilio phone number you purchased at twilio.com/console
					'from' => '+'.$this->settings->twilio_number,
					// the body of the text message you'd like to send
					'body' => $sms_template['message']
					)
				);

				$to = '+'.$users['phone'];
				// Your Account SID and Auth Token from twilio.com/console
				$sid = $this->settings->twilio_sid;
				$token = $this->settings->twilio_token;
				$client = new Twilio\Rest\Client($sid, $token);

				// Use the client to do fun stuff like send text messages!
				$client->messages->create(
				// the number you'd like to send the message to
				$to,
					array(
					// A Twilio phone number you purchased at twilio.com/console
					'from' => '+'.$this->settings->twilio_number,
					// the body of the text message you'd like to send
					'body' => $sms_template['message']
					)
				);
			}

			$this->session->set_flashdata('message', lang('users disputes success_stop'));
			redirect(site_url("account/dispute"));
		} else {
			redirect(THIS_URL_2);
		}

	}
	
	/**
    * List tickets
    */
	function support()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		$username = $user['username'];
		
		// get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
        $filters = array();
			
		if ($this->input->get('id'))
        {
            $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }
		
		// build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }
			
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

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			$ticket = $this->tickets_model->get_list_tickets($limit, $offset, $filters, $sort, $dir, $username);
				
		}
		
        // setup page header data
        $this->set_title(sprintf(lang('users title support'), $this->settings->site_name));
		// reload the new user data and store in session

        $data = $this->includes;
					
		$ticket = $this->tickets_model->get_list_tickets($limit, $offset, $filters, $sort, $dir, $username);
		
		$user = $this->users_model->get_user($this->user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $ticket['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'username'   => $username,
            'this_url'   => THIS_URL_3,
            'ticket'     => $ticket['results'],
            'total'    	 => $ticket['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );


        // load views
        $data['content'] = $this->load->view('account/support', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	
	/**
    * Detail ticket
    */
	function detail_ticket($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect(THIS_URL_2);
        }

        // get the data
        $ticket = $this->tickets_model->get_detail_ticket($id, $user['username']);
		$log_comment = $this->tickets_model->get_log_comment($ticket['id']);

        // if empty results, return to list
        if ( ! $ticket)
        {
            redirect(THIS_URL_2);
        }

        // setup page header data
        $this->set_title( lang('users title det_dispute') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		=> THIS_URL_3,
			'user'              => $user,
            'cancel_url'        => THIS_URL_3,
            'ticket'      		=> $ticket,
			'log_comment'      	=> $log_comment,
            'ticket_id'   		=> $id
        );

        // load views
        $data['content'] = $this->load->view('account/detail_ticket', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * Add comment ticket
    */
	function add_ticket_comment($id)
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		// get the data
       	$ticket = $this->tickets_model->get_detail_ticket($id, $user['username']);
				// if empty results, return to list
        if ( ! $ticket)
        {
            redirect(THIS_URL_3);
        }
				
		$this->form_validation->set_rules('comment', lang('users transfer amount'), 'required|trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/support"));
		}
		else
		{
			if ($ticket['status']!=3 && $ticket['comment']!=1) {
				$comment = $this->input->post("comment");

				// set content data
				$content_data = array(
					'this_url'    	=> "account/tickets",
					'user'        	=> $user,
					'cancel_url'  	=> THIS_URL_3,
					'ticket'      	=> $ticket,
					'ticket_id'   	=> $id
				);

				$comments = $this->tickets_model->add_admin_comment(array(
					"id_ticket" 	=> $ticket['id'],
					"date"          => date('Y-m-d H:i:s'),
					"user"          => $user['username'],
					"role"          => "1",
					"comment"       => $comment,
					)
				);

				// update ticket status
				$this->tickets_model->update_ticket($id,
					array(
						"status"   => "1",
						)
					);

				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(10);

				// variables to replace
				$id_ticket = $ticket['id'];
				$link = site_url('account/detail_ticket/');
				$site_name = $this->settings->site_name;

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]', '[URL_TICKET]', '[ID_TICKET]');

				$vals_1 = array($site_name, $link, $id_ticket);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($user['email'])
				);

				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				$this->session->set_flashdata('message', lang('users tickets success_comment'));
				redirect(site_url("account/support"));
			} else {
				redirect(site_url("account/support"));
			}
		}

	}
	
	/**
	* New ticket
    */
	function new_ticket()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users title new_ticket'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/new_ticket', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Start form ticket
    */
	function start_ticket()
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		$this->form_validation->set_rules('title', lang('users transfer amount'), 'required|trim');
		$this->form_validation->set_rules('message', lang('users transfer amount'), 'required|trim');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/new_ticket"));
		}
		else
		{
			$title = $this->input->post("title");
			$message = $this->input->post("message");

			$ticket = $this->tickets_model->add_ticket(array(
				"date"   	=> date('Y-m-d H:i:s'),
				"user"   	=> $user['username'],
				"title"  	=> $title,
				"status" 	=> "1",
				"comment" 	=> "0",
				"message" 	=> $message,
				)
			);

			$this->session->set_flashdata('message', lang('users tickets success_new'));
			redirect(site_url('account/support'));
		}

	}
	
	/**
    * Close ticket
    */
	function close_ticket($id)
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		// get the data
        $ticket = $this->tickets_model->get_detail_ticket($id, $user['username']);
		// if empty results, return to list
        if ( ! $ticket)
        {
            redirect(THIS_URL_3);
        }
			
		if ($ticket['status']!=3 && $user['username']==$ticket['user']) {
			// update dispute
			$this->tickets_model->update_ticket($id,
				array(
					"status"   => "3",
					"comments" => "1",
					)
				);

			// set content data
			$content_data = array(
				'this_url'   		=> "account/support",
				'user'              => $user,
				'cancel_url'        => THIS_URL_3,
				'ticket'      		=> $ticket,
				'ticket_id'   		=> $id
			);
					
			// Sending email

			$email_template = $this->emailtemplate_model->get_email_template(11);

			// variables to replace
			$id_ticket = $ticket['id'];
			$link = site_url('account/detail_ticket/');
			$site_name = $this->settings->site_name;

			$rawstring = $email_template['message'];

			// what will we replace
			$placeholders = array('[SITE_NAME]', '[URL_TICKET]', '[ID_TICKET]');

			$vals_1 = array($site_name, $link, $id_ticket);

			//replace
			$str_1 = str_replace($placeholders, $vals_1, $rawstring);

			$this -> email -> from($this->settings->site_email, $this->settings->site_name);
			$this->email->to(
				array($user['email'])
			);

			$this -> email -> subject($email_template['title']);

			$this -> email -> message($str_1);

			$this->email->send();

			$this->session->set_flashdata('message', lang('users tickets success_close'));
			redirect(site_url("account/support"));
					
		} else {
			redirect(THIS_URL_3);
		}

	}
	
	/**
	* Request payment
    */
	function request()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users title request'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/request', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Send Request payment
    */
	function start_request()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users title request'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
			
		if ($user['fraud_status']<2) {
					
			$cyr1 = $this->currencys->display->base_code;
			$cyr2 = $this->currencys->display->extra1_code;
			$cyr3 = $this->currencys->display->extra2_code;
			$cyr4 = $this->currencys->display->extra3_code;
			$cyr5 = $this->currencys->display->extra4_code;
			$cyr6 = $this->currencys->display->extra5_code;

			$this->form_validation->set_rules('purpose', lang('users reqest purpose'), 'required|trim|max_length[500]');
			$this->form_validation->set_rules('invoice', lang('users reqest invoice'), 'required|trim|max_length[50]');
			$this->form_validation->set_rules('amount', lang('users reqest amount'), 'required|trim|numeric');
			$this->form_validation->set_rules('currency', lang('users transfer amount'), 'required|trim|in_list['. $cyr1 .','. $cyr2 .','. $cyr3 .','. $cyr4 .','. $cyr5 .','. $cyr6 .']');
			$this->form_validation->set_rules('receiver', lang('users reqest receiver'), 'required|trim|valid_email');

			$purpose = $this->input->post("purpose");
			$invoice = $this->input->post("invoice");
			$amount = $this->input->post("amount");
			$currency = $this->input->post("currency");
			$receiver = $this->input->post("receiver");
			$note = $this->input->post("note");

			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error', lang('users error invalid_form'));
				redirect(site_url("account/request"));
			}
			else
			{

				$email_template = $this->emailtemplate_model->get_email_template(18);

				$site_name = $this->settings->site_name;
				$site_url = base_url();
				$url_go = ''.base_url().'account/money_transfer';
				$date = date('Y-m-d H:i:s');

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[DATE]', '[INV]', '[SENDER]', '[PURPOSE]', '[AMOUNT]', '[CYR]', '[NOTE]', '[SITE_NAME]', '[LINK]',);
				$vals_1 = array($date, $invoice, $user['username'], $purpose, $amount, $currency, $note, $site_name, $url_go);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this -> email -> to($receiver);
				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				$data = $this->includes;

				// set content data
				$content_data = array(
					'user'    => $user,
				);

				$this->session->set_flashdata('message', lang('users reqest success'));
				redirect(site_url("account/request"));
			}
		} else {
			$this->session->set_flashdata('error', lang('users error fraud'));
			redirect(site_url("account/request"));
		}
	
	}
	
	/**
	* Money transfer
	*/
	function money_transfer()
	{
        // setup page header data
        $this->set_title(sprintf(lang('users title money_transfer'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
		$percent = $this->settings->com_transfer;
		$fee = $this->settings->com_transfer/"100";
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'          => $user,
			'percent'     	=> $percent,
			'fee'     		=> $fee,
        );

        // load views
        $data['content'] = $this->load->view('account/money_transfer', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Start transfer money
    */
	function start_transfer()
	{	
		// get the data
        $user = $this->users_model->get_user($this->user['id']);

		// Check fraud 
		if ($user['fraud_status']>0) {
					
			$this->session->set_flashdata('error', lang('users error fraud'));
	        redirect(site_url("account/money_transfer"));
					
        }
			
			elseif ($user['fraud_status']==0) {
					
				$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('receiver', lang('users transfer amount'), 'required|trim|callback__check_username[]');
				$this->form_validation->set_rules('currency', lang('users transfer amount'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
					
				if ($this->form_validation->run() == FALSE)
					{
						$this->session->set_flashdata('error', lang('users error form'));
						redirect(site_url("account/money_transfer"));
					}
					else
					{
							
					$amount = $this->input->post("amount");
					$currency = $this->input->post("currency");
					$receiver = $this->input->post("receiver");
					$note = $this->input->post("note");

					$user_receiver = $this->users_model->get_user_transfer($receiver);
							
					$percent = $this->settings->com_transfer/"100";
					$fee = $amount*$percent;
					$sum = $fee+$amount;

					$total_receiver = $user_receiver[$currency]+$amount;
					$total_sender = $user[$currency]-$sum;
								
					// Check wallet
					if ($user[$currency]<$sum) {

						$this->session->set_flashdata('error', lang('users error wallet'));
						redirect(site_url("account/money_transfer"));

					}

					elseif ($user[$currency]>$sum) {

						// update receiver wallet
						$this->users_model->update_wallet_transfer($receiver,
							array(
								$currency => $total_receiver,
								)
							);

						// update sender wallet
						$this->users_model->update_wallet_transfer($user['username'],
						array(
							$currency => $total_sender,
							)
						);
								
						// add transaction for sender
						$transactions = $this->transactions_model->add_transaction(array(
							"type" 				=> "3",
							"sum"  				=> $sum,
							"fee"    			=> $fee,
							"amount" 			=> $amount,
							"currency"			=> $currency,
							"status" 			=> "2",
							"sender" 			=> $user['username'],
							"receiver" 			=> $user_receiver['username'],
							"time"          	=> date('Y-m-d H:i:s'),
							"user_comment"  	=> $note,
							"admin_comment" 	=> "none"
							)
						);

						// set content data
						$content_data = array(
							'user'              => $user,
							'user_receiver'     => $user_receiver,
							'percent'     		=> $percent,
						);
								
						// Send payeer email
							
						$email_template = $this->emailtemplate_model->get_email_template(22);
								
						// variables to replace
						if ($currency=="debit_base") {
							$mail_cyr = $this->currencys->display->base_code;
						} elseif ($currency=="debit_extra1") {
							$mail_cyr = $this->currencys->display->extra1_code;
						} elseif ($currency=="debit_extra2") {
							$mail_cyr = $this->currencys->display->extra2_code;
						} elseif ($currency=="debit_extra3") {
							$mail_cyr = $this->currencys->display->extra3_code;
						} elseif ($currency=="debit_extra4") {
							$mail_cyr = $this->currencys->display->extra4_code;
						} elseif ($currency=="debit_extra5") {
							$mail_cyr = $this->currencys->display->extra5_code;
						} 

						// variables to replace
						$link = site_url('account/history/');
						$site_name = $this->settings->site_name;
						$mail_sum = round($sum, 2);

						$rawstring = $email_template['message'];

						 // what will we replace
						$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]', '[RECEIVER]');

						$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link, $user_receiver['username']);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to(
							array($user['email'])
						);

						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
								

						// variables to replace
						if ($currency=="debit_base") {
							$mail_cyr = $this->currencys->display->base_code;
						} elseif ($currency=="debit_extra1") {
							$mail_cyr = $this->currencys->display->extra1_code;
						} elseif ($currency=="debit_extra2") {
							$mail_cyr = $this->currencys->display->extra2_code;
						} elseif ($currency=="debit_extra3") {
							$mail_cyr = $this->currencys->display->extra3_code;
						} elseif ($currency=="debit_extra4") {
							$mail_cyr = $this->currencys->display->extra4_code;
						} elseif ($currency=="debit_extra5") {
							$mail_cyr = $this->currencys->display->extra5_code;
						} 

						$link = site_url('account/history/');
						$site_name = $this->settings->site_name;

						$rawstring = $email_template['message'];

						// what will we replace
						$placeholders = array('[SITE_NAME]', '[URL_HISTORY]', '[SUM]', '[CYR]');

						$vals_1 = array($site_name, $link, $sum, $mail_cyr);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to(
							array($user['email'])
							);

						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
								
						$sms_template = $this->smstemplate_model->get_sms_template(13);
                                                
						if($sms_template['enable']) {
									
							$rawstring = $sms_template['message'];

							// what will we replace
							$placeholders = array('[SUM]', '[CYR]');

							$vals_1 = array($sum, $mail_cyr);

							//replace
							$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
							// Twilio user number
							$to = '+'.$user['phone'];
							// Your Account SID and Auth Token from twilio.com/console
							$sid = $this->settings->twilio_sid;
							$token = $this->settings->twilio_token;
							$client = new Twilio\Rest\Client($sid, $token);

							// Use the client to do fun stuff like send text messages!
							$client->messages->create(
							// the number you'd like to send the message to
							$to,
								array(
									// A Twilio phone number you purchased at twilio.com/console
									'from' => '+'.$this->settings->twilio_number,
									// the body of the text message you'd like to send
									'body' => $str_1
								)
							);

						}
								
								
						// Sending email receiver user

						$email_template = $this->emailtemplate_model->get_email_template(2);

						// variables to replace
						if ($currency=="debit_base") {
							$mail_cyr = $this->currencys->display->base_code;
						} elseif ($currency=="debit_extra1") {
							$mail_cyr = $this->currencys->display->extra1_code;
						} elseif ($currency=="debit_extra2") {
							$mail_cyr = $this->currencys->display->extra2_code;
						} elseif ($currency=="debit_extra3") {
							$mail_cyr = $this->currencys->display->extra3_code;
						} elseif ($currency=="debit_extra4") {
							$mail_cyr = $this->currencys->display->extra4_code;
						} elseif ($currency=="debit_extra5") {
							$mail_cyr = $this->currencys->display->extra5_code;
						} 

						$link = site_url('account/history/');
						$site_name = $this->settings->site_name;

						$rawstring = $email_template['message'];

						// what will we replace
						$placeholders = array('[SITE_NAME]', '[URL_HISTORY]', '[SUM]', '[CYR]');

						$vals_1 = array($site_name, $link, $amount, $mail_cyr);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to(
							array($user_receiver['email'])
						);

						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
								
						$sms_template2 = $this->smstemplate_model->get_sms_template(12);
                                                
						if($sms_template['enable']) {
									
							$rawstring = $sms_template2['message'];

							// what will we replace
							$placeholders = array('[SUM]', '[CYR]');

							$vals_1 = array($sum, $mail_cyr);

							//replace
							$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
							// Twilio user number
							$to = '+'.$user_receiver['phone'];
							// Your Account SID and Auth Token from twilio.com/console
							$sid = $this->settings->twilio_sid;
							$token = $this->settings->twilio_token;
							$client = new Twilio\Rest\Client($sid, $token);

							// Use the client to do fun stuff like send text messages!
							$client->messages->create(
							// the number you'd like to send the message to
								$to,
									array(
										// A Twilio phone number you purchased at twilio.com/console
										'from' => '+'.$this->settings->twilio_number,
										// the body of the text message you'd like to send
										'body' => $str_1
									)
								);
						}

						$this->session->set_flashdata('message', lang('users transfer success'));
						redirect(site_url("account/history"));

					}
				}
					
			}

		}
	
	/**
    * Start exchange money
    */
	function exchange_of_base_currency()
	{
			
		// get the data
        $user = $this->users_model->get_user($this->user['id']);
			
		// Check fraud 
		if ($user['fraud_status']==2) {
					
		$this->session->set_flashdata('error', lang('users error fraud'));
        redirect(site_url("account/exchange"));
					
        }
			
		elseif ($user['fraud_status']<2) {
					
			$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric|greater_than[0]');
			$this->form_validation->set_rules('currency', lang('users transfer amount'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
					
			if ($this->form_validation->run() == FALSE) {

				$this->session->set_flashdata('error', lang('users error form'));
				redirect(site_url("account/exchange"));

			} 
			else  
			{
							
				$amount = $this->input->post("amount");
				$currency = $this->input->post("currency");
							
				// Check rate
				if ($currency == "debit_extra1") {
					$rates=$this->currencys->display->extra1_rate;
				} elseif ($currency == "debit_extra2") {
					$rates=$this->currencys->display->extra2_rate;
				} elseif ($currency == "debit_extra3") {
					$rates=$this->currencys->display->extra3_rate;
				} elseif ($currency == "debit_extra4") {
					$rates=$this->currencys->display->extra4_rate;
				} elseif ($currency == "debit_extra5") {
					$rates=$this->currencys->display->extra5_rate;
				}
								
				$geat_sum = $amount*$rates;
								
				$total = $user[$currency]+$geat_sum;
				$base_wallet = $user['debit_base']-$amount;
								
				// Check wallet
				if ($user['debit_base']<$amount) {

					$this->session->set_flashdata('error', lang('users error wallet'));
					redirect(site_url("account/exchange"));

				}

					elseif ($user['debit_base']>=$amount) {

						// update user wallet - get
						$this->users_model->update_wallet_transfer($user['username'],
						array(
							$currency => $total,
							)
						);
								
						// update user wallet - base wallet
						$this->users_model->update_wallet_transfer($user['username'],
							array(
								"debit_base" => $base_wallet,
								)
							);
								
						$transactions = $this->transactions_model->add_transaction(array(
							"type" 				=> "4",
							"sum"  				=> $amount,
							"fee"    			=> "0",
							"amount" 			=> $amount,
							"currency"			=> "debit_base",
							"status" 			=> "2",
							"sender" 			=> $user['username'],
							"receiver" 			=> "system",
							"time"          	=> date('Y-m-d H:i:s'),
							"user_comment"  	=> "",
							"admin_comment" 	=> "none"
							)
						);
								
						$transactions2 = $this->transactions_model->add_transaction(array(
							"type" 				=> "1",
							"sum"  				=> $geat_sum,
							"fee"    			=> "0",
							"amount" 			=> $geat_sum,
							"currency"			=> $currency,
							"status" 			=> "2",
							"sender" 			=> "system",
							"receiver" 			=> $user['username'],
							"time"          	=> date('Y-m-d H:i:s'),
							"user_comment"  	=> lang('users exchange note'),
							"admin_comment" 	=> lang('users exchange note'),
							)
						);


						// set content data
						$content_data = array(
							'user'              => $user,
						);
								
						// Sending email exchange

						$email_template = $this->emailtemplate_model->get_email_template(4);

						// variables to replace
						if ($currency=="debit_base") {
							$mail_cyr = $this->currencys->display->base_code;
						} elseif ($currency=="debit_extra1") {
							$mail_cyr = $this->currencys->display->extra1_code;
						} elseif ($currency=="debit_extra2") {
							$mail_cyr = $this->currencys->display->extra2_code;
						} elseif ($currency=="debit_extra3") {
							$mail_cyr = $this->currencys->display->extra3_code;
						} elseif ($currency=="debit_extra4") {
							$mail_cyr = $this->currencys->display->extra4_code;
						} elseif ($currency=="debit_extra5") {
							$mail_cyr = $this->currencys->display->extra5_code;
						} 

						$link = site_url('account/history/');
						$site_name = $this->settings->site_name;
						$mail_sum = round($geat_sum, 2);

						$rawstring = $email_template['message'];

						// what will we replace
						$placeholders = array('[SITE_NAME]', '[URL_HISTORY]', '[SUM_1]', '[CYR_1]', '[SUM_2]', '[CYR_2]');

						$vals_1 = array($site_name, $link, $amount, $this->currencys->display->base_code, $mail_sum, $mail_cyr);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to(
							array($user['email'])
						);

						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
								
						$sms_template = $this->smstemplate_model->get_sms_template(14);
								
						if($sms_template['enable']) {
									
							$rawstring = $sms_template['message'];

							// what will we replace
							$placeholders = array('[SUM_1]', '[CYR_1]', '[SUM_2]', '[CYR_2]');

							$vals_1 = array($amount, $this->currencys->display->base_code, $mail_sum, $mail_cyr);

							//replace
							$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
							// Twilio user number
							$to = '+'.$user['phone'];
							// Your Account SID and Auth Token from twilio.com/console
							$sid = $this->settings->twilio_sid;
							$token = $this->settings->twilio_token;
							$client = new Twilio\Rest\Client($sid, $token);

							// Use the client to do fun stuff like send text messages!
							$client->messages->create(
							// the number you'd like to send the message to
							$to,
								array(
									// A Twilio phone number you purchased at twilio.com/console
									'from' => '+'.$this->settings->twilio_number,
									// the body of the text message you'd like to send
									'body' => $str_1
								)
							);

						}

						$this->session->set_flashdata('message', lang('users exchange success'));
						redirect(site_url("account/history"));

					}
			}
					
		}

	}
	
	/**
    * Start exchange money
    */
	function exchange_to_base_currency()
	{
			
		// get the data
        $user = $this->users_model->get_user($this->user['id']);
			
		// Check fraud 
		if ($user['fraud_status']==2) {
					
			$this->session->set_flashdata('error', lang('users error fraud'));
        	redirect(site_url("account/exchange"));
					
        }
			
		elseif ($user['fraud_status']<2) {
					
			$this->form_validation->set_rules('amount2', lang('users transfer amount'), 'required|trim|numeric|greater_than[0]');
			$this->form_validation->set_rules('currency2', lang('users transfer amount'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
					
				if ($this->form_validation->run() == FALSE) {

							$this->session->set_flashdata('error', lang('users error form'));
							redirect(site_url("account/exchange"));

				}
				else
				{
							
					$amount = $this->input->post("amount2");
					$currency = $this->input->post("currency2");
							
					// Check rate
					if ($currency == "debit_extra1") {
						$rates=$this->currencys->display->extra1_rate;
					} elseif ($currency == "debit_extra2") {
						$rates=$this->currencys->display->extra2_rate;
					} elseif ($currency == "debit_extra3") {
						$rates=$this->currencys->display->extra3_rate;
					} elseif ($currency == "debit_extra4") {
						$rates=$this->currencys->display->extra4_rate;
					} elseif ($currency == "debit_extra5") {
						$rates=$this->currencys->display->extra5_rate;
					}
								
					$geat_sum = $amount/$rates;
								
					$total = $user['debit_base']+$geat_sum;
					$extra_wallet = $user[$currency]-$amount;
								
					// Check wallet
					if ($user[$currency]<$amount) {

						$this->session->set_flashdata('error', lang('users error wallet'));
						redirect(site_url("account/exchange"));

					}

					elseif ($user[$currency]>=$amount) {

					// update user wallet - get
					$this->users_model->update_wallet_transfer($user['username'],
						array(
							'debit_base' => $total,
							)
						);
								
					// update user wallet - base wallet
					$this->users_model->update_wallet_transfer($user['username'],
						array(
							$currency => $extra_wallet,
							)
						);
								
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "4",
						"sum"  				=> $amount,
						"fee"    			=> "0",
						"amount" 			=> $amount,
						"currency"			=> $currency,
						"status" 			=> "2",
						"sender" 			=> $user['username'],
						"receiver" 			=> "system",
						"time"          	=> date('Y-m-d H:i:s'),
						"user_comment"  	=> "",
						"admin_comment" 	=> "none"
						)
					);
								
					$transactions2 = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $geat_sum,
						"fee"    			=> "0",
						"amount" 			=> $geat_sum,
						"currency"			=> 'debit_base',
						"status" 			=> "2",
						"sender" 			=> "system",
						"receiver" 			=> $user['username'],
						"time"          	=> date('Y-m-d H:i:s'),
						"user_comment"  	=> lang('users exchange note'),
						"admin_comment" 	=> lang('users exchange note'),
						)
					);
								
					// set content data
					$content_data = array(
						'user'              => $user,
					);
								
					// Sending email exchange

					$email_template = $this->emailtemplate_model->get_email_template(4);

					// variables to replace
					if ($currency=="debit_base") {
						$mail_cyr = $this->currencys->display->base_code;
					} elseif ($currency=="debit_extra1") {
						$mail_cyr = $this->currencys->display->extra1_code;
					} elseif ($currency=="debit_extra2") {
						$mail_cyr = $this->currencys->display->extra2_code;
					} elseif ($currency=="debit_extra3") {
						$mail_cyr = $this->currencys->display->extra3_code;
					} elseif ($currency=="debit_extra4") {
						$mail_cyr = $this->currencys->display->extra4_code;
					} elseif ($currency=="debit_extra5") {
						$mail_cyr = $this->currencys->display->extra5_code;
					} 

					$link = site_url('account/history/');
					$site_name = $this->settings->site_name;
					$mail_sum = round($geat_sum, 2);

					$rawstring = $email_template['message'];

					// what will we replace
					$placeholders = array('[SITE_NAME]', '[URL_HISTORY]', '[SUM_1]', '[CYR_1]', '[SUM_2]', '[CYR_2]');

					$vals_1 = array($site_name, $link, $amount, $mail_cyr, $mail_sum, $this->currencys->display->base_code);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($user['email'])
					);

					$this -> email -> subject($email_template['title']);

					$this -> email -> message($str_1);

					$this->email->send();
								
					$sms_template = $this->smstemplate_model->get_sms_template(14);
								
					if($sms_template['enable']) {
									
						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[SUM_1]', '[CYR_1]', '[SUM_2]', '[CYR_2]');

						$vals_1 = array($amount, $mail_cyr, $mail_sum, $this->currencys->display->base_code);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
						// Twilio user number
						$to = '+'.$user['phone'];
						// Your Account SID and Auth Token from twilio.com/console
						$sid = $this->settings->twilio_sid;
						$token = $this->settings->twilio_token;
						$client = new Twilio\Rest\Client($sid, $token);

						// Use the client to do fun stuff like send text messages!
						$client->messages->create(
						// the number you'd like to send the message to
						$to,
							array(
							// A Twilio phone number you purchased at twilio.com/console
							'from' => '+'.$this->settings->twilio_number,
							// the body of the text message you'd like to send
							'body' => $str_1
							)
						);

					}

					$this->session->set_flashdata('message', lang('users exchange success'));
					redirect(site_url("account/history"));

				}
			}
					
		}

	}

	/**
    * Page exchange money
    */
	function exchange()
	{
        // setup page header data
         $this->set_title(sprintf(lang('users title exchange'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
		$percent = $this->settings->com_transfer;
		$fee = $this->settings->com_transfer/"100";
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'         => $user,
			'percent'      => $percent,
			'fee'     	   => $fee,
        );

        // load views
        $data['content'] = $this->load->view('account/exchange', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Withdrawal page
    */
	function withdrawal()
	{
        // setup page header data
        $this->set_title(sprintf(lang('users title withdrawal'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'         => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/withdrawal', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Start withdrawal
    */
	function start_withdrawal()
	{
			
		// get the data
        $user = $this->users_model->get_user($this->user['id']);
			
		if ($user['verifi_status']>=1 && $user['verifi_status']<3) {
			
			// Check fraud 
			if ($user['fraud_status']>0) {
					
				$this->session->set_flashdata('error', lang('users error fraud'));
        		redirect(site_url("account/withdrawal"));
					
        	}
			
			elseif ($user['fraud_status']==0) {
					
				$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric|greater_than[0]');
				$this->form_validation->set_rules('account', lang('users transfer amount'), 'required|trim');
				$this->form_validation->set_rules('currency', lang('users transfer amount'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
				$this->form_validation->set_rules('method', lang('users transfer amount'), 'required|trim|in_list[1,2,3,4,5,6,7,8,9]');
					
					if ($this->form_validation->run() == FALSE)
						{
							$this->session->set_flashdata('error', lang('users error form'));
							redirect(site_url("account/withdrawal"));
						}
						else
						{
							
							$amount = $this->input->post("amount");
							$currency = $this->input->post("currency");
							$account = $this->input->post("account");
							$method = $this->input->post("method");
								
							// Check method and fee
							if ($method == "1") {
								$method=lang('users withdrawal card');
								$com=$this->commission->display->card_fee;
							} elseif ($method == "2") {
								$method=lang('users withdrawal paypal');
								$com=$this->commission->display->pp_fee;
							} elseif ($method == "3") {
								$method=lang('users withdrawal btc');
								$com=$this->commission->display->btc_fee;
							} elseif ($method == "4") {
								$method=lang('users withdrawal adv');
								$com=$this->commission->display->adv_fee;
							} elseif ($method == "5") {
								$method=lang('users withdrawal webmoney');
								$com=$this->commission->display->wm_fee;
							} elseif ($method == "6") {
								$method=lang('users withdrawal qiwi');
								$com=$this->commission->display->qiwi_fee;
							} elseif ($method == "7") {
								$method=lang('users withdrawal swift');
								$com=$this->commission->display->swift_fee;
							} elseif ($method == "8") {
								$method=lang('users withdrawal perfect');
								$com=$this->commission->display->perfect_fee;
							} elseif ($method == "9") {
								$method=lang('users withdrawal payeer');
								$com=$this->commission->display->payeer_fee;
							}
								
							
							$percent = $com/"100";
							$fee = $amount*$percent;
							$sum = $fee+$amount;

							$total = $user[$currency]-$sum;
								
							// Check wallet
							if ($user[$currency]<$sum) {

								$this->session->set_flashdata('error', lang('users error wallet'));
								redirect(site_url("account/withdrawal"));

							}

							elseif ($user[$currency]>=$sum) {

								// update wallet
								$this->users_model->update_wallet_transfer($user['username'],
									array(
										$currency => $total,
									)
								);

								$transactions = $this->transactions_model->add_transaction(array(
									"type" 				=> "2",
									"sum"  				=> $sum,
									"fee"    			=> $fee,
									"amount" 			=> $amount,
									"currency"			=> $currency,
									"status" 			=> "1",
									"sender" 			=> $user['username'],
									"receiver" 			=> "system",
									"time"          	=> date('Y-m-d H:i:s'),
									"user_comment"  	=> $method.' '.$account.'',
									"admin_comment" 	=> "none"
									)
								);

								// set content data
								$content_data = array(
									'user'              => $user,
									'percent'     		=> $percent
								);
								
								// Sending email exchange

								$email_template = $this->emailtemplate_model->get_email_template(3);

								// variables to replace
								if ($currency=="debit_base") {
									$mail_cyr = $this->currencys->display->base_code;
								} elseif ($currency=="debit_extra1") {
									$mail_cyr = $this->currencys->display->extra1_code;
								} elseif ($currency=="debit_extra2") {
									$mail_cyr = $this->currencys->display->extra2_code;
								} elseif ($currency=="debit_extra3") {
									$mail_cyr = $this->currencys->display->extra3_code;
								} elseif ($currency=="debit_extra4") {
									$mail_cyr = $this->currencys->display->extra4_code;
								} elseif ($currency=="debit_extra5") {
									$mail_cyr = $this->currencys->display->extra5_code;
								} 

								$link = site_url('account/history/');
								$site_name = $this->settings->site_name;
								$mail_sum = round($sum, 2);

								$rawstring = $email_template['message'];

								 // what will we replace
								$placeholders = array('[SITE_NAME]', '[URL_HISTORY]', '[SUM]', '[CYR]');

								$vals_1 = array($site_name, $link, $mail_sum, $mail_cyr);

								//replace
								$str_1 = str_replace($placeholders, $vals_1, $rawstring);

								$this -> email -> from($this->settings->site_email, $this->settings->site_name);
								$this->email->to(
									array($user['email'])
								);

								$this -> email -> subject($email_template['title']);

								$this -> email -> message($str_1);

								$this->email->send();
								
								$sms_template = $this->smstemplate_model->get_sms_template(13);
								
								if($sms_template['enable']) {
									
									$rawstring = $sms_template['message'];

									 // what will we replace
									$placeholders = array('[SUM]', '[CYR]');

									$vals_1 = array($mail_sum, $mail_cyr);

									//replace
									$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
									// Twilio user number
									$to = '+'.$user['phone'];
									// Your Account SID and Auth Token from twilio.com/console
									$sid = $this->settings->twilio_sid;
									$token = $this->settings->twilio_token;
									$client = new Twilio\Rest\Client($sid, $token);

									// Use the client to do fun stuff like send text messages!
									$client->messages->create(
									// the number you'd like to send the message to
									$to,
									array(
										// A Twilio phone number you purchased at twilio.com/console
										'from' => '+'.$this->settings->twilio_number,
										// the body of the text message you'd like to send
										'body' => $str_1
										)
									);

								}

								$this->session->set_flashdata('message', lang('users transfer success'));
								redirect(site_url("account/history"));

							}
						}
					
					}
				} 
				else 
				{
    				$this->session->set_flashdata('error', lang('users withdrawal error'));
					redirect(site_url("account/withdrawal"));
				}

		}
	
	/**
	* Identification
    */
	function identification()
	{
        // setup page header data
        $this->set_title(sprintf(lang('users title verifi'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user
        );

        // load views
        $data['content'] = $this->load->view('account/identification', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	
	/**
	* Start business identification
    */
	function business_identification()
	{
      	$user = $this->users_model->get_user($this->user['id']);
		
		if ($user['verifi_status']==1) {

			$config['upload_path']          = ''.$this->settings->full_upload.'/'.$this->settings->upload_path.'/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 80000; // 10mb
			$config['encrypt_name']         = TRUE;
			$config['remove_spaces']        = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('business')) {

				$this->session->set_flashdata('error', lang('users error invalid_form'));
				redirect(site_url('account/identification'));

			}
			else
			{
				$documnent = $this->verification_model->add_document(array(
					"user"  	=> $user['username'],
					"type" 		=> "3",
					"img"  		=> $this->upload->data('file_name'),
					"status" 	=> "1",
					"date"   	=> date('Y-m-d H:i:s')
					)
				);

				// update user verifi status
				$this->users_model->update_user($user['username'],
					array(
						"verifi_status"   => "3",
						)
					);

				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(12);

				// variables to replace
				$link = site_url('account/identification');
				$site_name = $this->settings->site_name;

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]', '[URL_CHECK]');

				$vals_1 = array($site_name, $link);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($user['email'])
				);

				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				redirect(site_url('account/identification'));
			}

		} else {
			redirect(site_url("account/identification"));
		}

	}
	
	 /**
	* Start verifi identification
    */
	function verifi_identification()
	{
      	$user = $this->users_model->get_user($this->user['id']);
			
		if ($user['verifi_status']==0) {

			$config['upload_path']          = ''.$this->settings->full_upload.'/'.$this->settings->upload_path.'/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 80000; // 10mb
			$config['encrypt_name']         = TRUE;
			$config['remove_spaces']        = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('passport'))
			{
				$this->session->set_flashdata('error', lang('users error invalid_form'));
				redirect(site_url('account/identification'));
			} 
			else
			{
				$documnent = $this->verification_model->add_document(array(
					"user"   => $user['username'],
					"type" 	 => "1",
					"img"  	 => $this->upload->data('file_name'),
					"status" => "1",
					"date"   => date('Y-m-d H:i:s')
					)
				);
			}

			if ( ! $this->upload->do_upload('address'))
			{
				$this->session->set_flashdata('error', lang('users tickets success_new'));
				redirect(site_url('account/identification'));
			} 
			else
			{
				$documnent = $this->verification_model->add_document(array(
					"user"   => $user['username'],
					"type" 	 => "1",
					"img"  	 => $this->upload->data('file_name'),
					"status" => "1",
					"date"   => date('Y-m-d H:i:s')
					)
				);

				// update user verifi status
				$this->users_model->update_user($user['username'],
					array(
						"verifi_status"   => "3",
					)
				);

				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(12);

				// variables to replace
				$link = site_url('account/identification');
				$site_name = $this->settings->site_name;

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]', '[URL_CHECK]');

				$vals_1 = array($site_name, $link);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($user['email'])
				);

				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				redirect(site_url('account/identification'));
			}

		} else {
			redirect(site_url("account/identification"));
		}

	}
	
	/**
	* user_settings
    */
	function user_settings()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		// validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email');
		$this->form_validation->set_rules('phone', lang('users input phone'), 'required|trim|numeric|max_length[12]|min_length[11]');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'min_length[5]');
        $this->form_validation->set_rules('password', lang('users input password'), 'min_length[5]|matches[password_repeat]');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->users_model->edit_profile($this->input->post(), $this->user['id']);

            if ($saved)
            {
                // reload the new user data and store in session
                $this->user = $this->users_model->get_user($this->user['id']);
                unset($this->user['password']);
                unset($this->user['salt']);

                $this->session->set_userdata('logged_in', $this->user);
                $this->session->language = $this->user['language'];
                $this->lang->load('users', $this->user['language']);
                $this->session->set_flashdata('message', lang('users msg edit_profile_success'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error edit_profile_failed'));
            }

            // reload page and display message
            redirect('account/user_settings');
        }
		
        // setup page header data
        $this->set_title(sprintf(lang('users title settings'), $this->settings->site_name));
		// reload the new user data and store in session
       

        $data = $this->includes;

        /// set content data
        $content_data = array(
            'cancel_url'        => base_url(),
            'user'              => $user,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('account/user_settings', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Deposit
    */
	function deposit()
	{
        // setup page header data
        $this->set_title(sprintf(lang('users title deposit'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'     => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/deposit', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Payeer start
    */
	function start_payeer()
	{
		$user = $this->users_model->get_user($this->user['id']);
		$form_amount = $this->input->post("form_amount");
		$form_user = $this->input->post("form_user");
				
    $m_shop = $this->commission->display->merch_payeer;
		$m_orderid = rand(10000, 99999);
		$m_amount = number_format($form_amount, 2, '.', '');
		$m_curr = $this->currencys->display->base_code;
		$m_desc = base64_encode($user['username']);
		$m_key = $this->commission->display->key_payeer;

		$arHash = array(
			$m_shop,
			$m_orderid,
			$m_amount,
			$m_curr,
			$m_desc
		);
				

		$arHash[] = $m_key;

		$sign = strtoupper(hash('sha256', implode(':', $arHash)));
				
		$GET_params = 'm_shop='.$m_shop.'&';
		$GET_params .= 'm_orderid='.$m_orderid.'&';
		$GET_params .= 'm_amount='.$m_amount.'&';
		$GET_params .= 'm_curr='.$m_curr.'&';
		$GET_params .= 'm_desc='.$m_desc.'&';
		$GET_params .= 'm_sign='.$sign.'';
				
		$url = "https://payeer.com/merchant/?".$GET_params ." ";
		redirect("$url");		
	}
	
	/**
    * ADV cash deposit start
    */
	function start_advcash()
	{
		$user = $this->users_model->get_user($this->user['id']);
		$form_amount = $this->input->post("form_amount");
		$id_random = rand(10000, 99999);
				
		$ac_account_email = $this->commission->display->account_adv;
		$ac_sci_name = $this->commission->display->name_adv;
		$ac_amount = $form_amount;
		$ac_currency = $this->currencys->display->base_code;
		$secret = $this->commission->display->secret_adv;
		$ac_order_id = $id_random;

		$arHash = array(
			$ac_account_email,
			$ac_sci_name,
			$ac_amount,
			$ac_currency,
			$secret,
			$ac_order_id
		);
				
		$ac_sign = strtoupper(hash('sha256', implode(':', $arHash)));
				
		$GET_params = 'ac_account_email='.$ac_account_email.'&';
		$GET_params .= 'ac_sci_name='.$ac_sci_name.'&';
		$GET_params .= 'ac_amount='.$ac_amount.'&';
		$GET_params .= 'ac_currency='.$ac_currency.'&';
		$GET_params .= 'ac_order_id='.$ac_order_id.'&';
		$GET_params .= 'ac_comments='.$user['username'].'&';
		$GET_params .= 'ac_sign='.$ac_sign.'';
				
		$url = "https://wallet.advcash.com/sci/?".$GET_params ." ";
		redirect("$url");		
	}
	
	/**
    * Block io generate forwarding adress
    */
	function start_blockio()
	{
		$user = $this->users_model->get_user($this->user['id']); // user
		$form_amount = $this->input->post("form_amount"); // amount in base
		$id_random = rand(10000, 99999); // order number
				
		$receiver = $user['username'];

		$secret = $this->commission->display->pass_btc;

		$my_xpub = $this->commission->display->xpub;
		$my_api_key = $this->commission->display->shop_btc;

		$my_callback_url = ''.base_url().'IPN/blockchain?secret='.$secret;
				
		$call_url = urlencode($my_callback_url);

		$root_url = 'https://api.blockchain.info/v2/receive';

		$parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key;

		$response = file_get_contents($root_url . '?' . $parameters);

		$object = json_decode($response);

		$forwarding_address = $object->address;

		if ($forwarding_address) {
					
			$percent = $this->commission->display->fee_btc_dep/"100";
			$fee = $form_amount*$percent;
			$sum = $form_amount-$fee;
				
			$transactions = $this->transactions_model->add_transaction(array(
				"type" 				=> "1",
				"sum"  				=> $sum,
				"fee"    			=> $fee,
				"amount" 			=> $form_amount,
				"currency"			=> 'debit_base',
				"status" 			=> "1",
				"sender" 			=> "Bitcoin",
				"receiver" 			=> $receiver,
				"time"          => date('Y-m-d H:i:s'),
				"user_comment"  => $forwarding_address,
				"admin_comment" => "none"
				)
			);
					
			$url_btc = site_url('account/btc_order/'.$forwarding_address.'');
			redirect($url_btc);
					
		} else {
			$this->session->set_flashdata('error', "error");
			redirect(site_url("account/deposit"));
		}
				
	}
	
	/**
    * BTC pending order
    */
	function btc_order($user_comment = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
			
        // make sure we have a numeric id
        if (is_null($user_comment))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $transactions = $this->transactions_model->get_detail_btc_transactions($user_comment, $user['username']);

        // if empty results, return to list
        if ( ! $transactions)
        {
            redirect($this->_redirect_url);
        }
			
		// ################################### Get Current Price BTC ######################################## //

		define('API_TOKEN', ''); // Access to API token. (not testing key!)

		$fields['currency'] = $this->currencys->display->base_code;
		$fields['value'] = $transactions['amount']; // Receiver adress

		$url = 'https://blockchain.info/tobtc'; // Get a new address with a random label
		$ch = curl_init();

		$url = $url . '?' . http_build_query($fields);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response = json_decode($response, true);

		if ($httpCode == 200) {
			$rate = $response;
		} else {
			$rate = "undefined";
		}

		// ################################### Get Current Price BTC ####################################### //
			
		// get the data
    	$block_transaction = $this->transactions_model->get_chain($user_comment);

        // setup page header data
        $this->set_title( lang('users history detail') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   			=> THIS_URL,
			'user'              	=> $user,
            'cancel_url'        	=> $this->_redirect_url,
            'transactions'      	=> $transactions,
            'transactions_id'   	=> $user_comment,
			'rate'              	=> $rate,
			'block_transaction'     => $block_transaction,
        );

        // load views
        $data['content'] = $this->load->view('account/btc_order', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * List merchants
    */
	function merchants()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		$username = $user['username'];
		
		// get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
        $filters = array();
			
		if ($this->input->get('id'))
        {
            $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }
		
		// build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }
			
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

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }

            // redirect using new filter(s)
            redirect(THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

            }
					
			$merchant = $this->merchants_model->get_list_merchants($limit, $offset, $filters, $sort, $dir, $username);
				
		}
		
        // setup page header data
        $this->set_title(sprintf(lang('users menu acceptance'), $this->settings->site_name));
		// reload the new user data and store in session

        $data = $this->includes;
					
		$merchant = $this->merchants_model->get_list_merchants($limit, $offset, $filters, $sort, $dir, $username);
		
		$user = $this->users_model->get_user($this->user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $merchant['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'username'   => $username,
            'this_url'   => THIS_URL_4,
            'merchant'   => $merchant['results'],
            'total'    	 => $merchant['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('account/merchants', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
     * Detail merchant
     */
	
	function detail_merchant($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect(THIS_URL_2);
        }

        // get the data
        $merchant = $this->merchants_model->get_detail_merchants($id, $user['username']);

        // if empty results, return to list
        if ( ! $merchant)
        {
            redirect(THIS_URL_4);
        }

        // setup page header data
        $this->set_title( lang('users merchants detail') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		=> THIS_URL_4,
			'user'              => $user,
            'cancel_url'        => THIS_URL_4,
            'merchant'      	=> $merchant,
            'merchant_id'   	=> $id
        );

        // load views
        $data['content'] = $this->load->view('account/detail_merchant', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
	* New merchant
    */
	function new_merchant()
	{
		// setup page header data
        $this->set_title(sprintf(lang('users merchants new'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);

        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('account/new_merchant', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
    * Start form merchant
    */
	function start_merchant()
	{
		$user = $this->users_model->get_user($this->user['id']);
			
		if ($user['verifi_status']==2) {
			
			$this->form_validation->set_rules('name', lang('users transfer amount'), 'required|trim');
			$this->form_validation->set_rules('url', lang('users transfer amount'), 'required|trim|valid_url');
			$this->form_validation->set_rules('ipn', lang('users transfer amount'), 'required|trim|valid_url');
			$this->form_validation->set_rules('password', lang('users transfer amount'), 'required|trim');
			$this->form_validation->set_rules('comment', lang('users transfer amount'), 'trim|max_length[300]');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('error', lang('users error form'));
				redirect(site_url("account/new_merchant"));
			}
			else
			{
			
				$name = $this->input->post("name");
				$url = $this->input->post("url");
				$ipn = $this->input->post("ipn");
				$password = $this->input->post("password");
				$comment = $this->input->post("comment");

				$merchant = $this->merchants_model->add_merchant(array(
					"date"   		=> date('Y-m-d H:i:s'),
					"link"   		=> $url,
					"status_link"   => $ipn,
					"password"   	=> $password,
					"name"   		=> $name,
					"status"   		=> "2",
					"user"   		=> $user['username'],
					"comment"  		=> $comment,
					)
				);

				$this->session->set_flashdata('message', lang('users tickets success_new'));
				redirect(site_url('account/merchants'));
			}
			
		} else {
    		$this->session->set_flashdata('error', lang('users withdrawal error'));
			redirect(site_url("account/merchants"));
		}

	}
	
	function start_swift()
	{
		
		// setup page header data
		$user = $this->users_model->get_user($this->user['id']);
		
		if ($user['fraud_status'] <= 1) {
			
		$this->form_validation->set_rules('form_amount', lang('admin merchant link'), 'required|trim|numeric');

			if ($this->form_validation->run() == TRUE)
			{

				$form_amount = $this->input->post("form_amount");
				
				$percent = $this->commission->display->fee_swift_dep/"100";
				$fee_percent = $form_amount*$percent;
				$fee = $fee_percent+$this->commission->display->fee_swift_fix;
				$sum = $form_amount-$fee;

				
				// add transaction
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 					=> "1",
					"sum"  					=> $sum,
					"fee"    				=> $fee,
					"amount" 				=> $form_amount,
					"currency"			=> "debit_base",
					"status" 				=> "1",
					"sender" 				=> "SWIFT",
					"receiver" 			=> $user['username'],
					"time"          => date('Y-m-d H:i:s'),
					"user_comment"  => $this->commission->display->swift_desc,
					"admin_comment" => "none"
					)
				);
				
				$this->session->set_flashdata('message', lang('users history swift'));
				redirect(site_url("account/history"));
				
			} else {
				
				$this->session->set_flashdata('error', lang('users error request'));
				redirect(site_url("account/deposit"));

			}
			
		} else {
			
			$this->session->set_flashdata('error', lang('users error fraud'));
			redirect(site_url("account/deposit"));
		
		}
		
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
						return $username;
        }
        else
        {
            return FALSE;
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
        if (trim($email) != $this->user['email'] && $this->users_model->email_exists($email))
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