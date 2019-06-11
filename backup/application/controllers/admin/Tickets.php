<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends Admin_Controller {
	
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
			
		require './Twilio/autoload.php';
			
		// load the logs model
		$this-> load->library('email');
        $this->load->model('tickets_model');
		$this->load->model('users_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/tickets'));
		define('THIS_URL_2', base_url('admin/tickets/untreated'));
		define('THIS_URL_3', base_url('admin/tickets/processed'));
		define('THIS_URL_4', base_url('admin/tickets/closed'));
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
     * All tickets
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
			
		if ($this->input->get('id'))
        {
           $id_xss = $this->security->xss_clean($this->input->get('id'));
						$id_string = str_replace(' ', '-', $id_xss);
						$id_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $id_string);
            $filters['id'] = $id_replace;
        }
			
		if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
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
							
				if ($this->input->post('date'))
                {
                    $filter .= "&date=" . $this->input->post('date', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$tickets = $this->tickets_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title tickets') );
			
		$data = $this->includes;
		
        // get list
		$tickets = $this->tickets_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $tickets['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'tickets'    => $tickets['results'],
            'total'      => $tickets['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/tickets/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Untreated tickets
     */
    function untreated()
    {
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
			
		if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
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
							
				if ($this->input->post('date'))
                {
                    $filter .= "&date=" . $this->input->post('date', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$tickets = $this->tickets_model->get_untreated($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title tickets') );
			
		$data = $this->includes;
		
        // get list
		$tickets = $this->tickets_model->get_untreated($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $tickets['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_2' => THIS_URL_2,
            'tickets'    => $tickets['results'],
            'total'      => $tickets['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/tickets/untreated', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Processed tickets
     */
    function processed()
    {
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
			
		if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
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
							
				if ($this->input->post('date'))
                {
                    $filter .= "&date=" . $this->input->post('date', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$tickets = $this->tickets_model->get_processed($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title tickets') );
			
		$data = $this->includes;
		
        // get list
		$tickets = $this->tickets_model->get_processed($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $tickets['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_3' => THIS_URL_3,
            'tickets'    => $tickets['results'],
            'total'      => $tickets['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/tickets/processed', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Closed tickets
     */
    function closed()
    {
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
			
		if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
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
							
				if ($this->input->post('date'))
                {
                    $filter .= "&date=" . $this->input->post('date', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$tickets = $this->tickets_model->get_closed($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title tickets') );
			
		$data = $this->includes;
		
        // get list
		$tickets = $this->tickets_model->get_closed($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $tickets['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_4' => THIS_URL_4,
            'tickets'    => $tickets['results'],
            'total'      => $tickets['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/tickets/closed', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
    /**
     * Add tickets page
     */
	function add()
	{	
		// setup page header data
		$this
			->add_js_theme( "dashboard_i18n.js", TRUE )
			->set_title( lang('admin title admin') );
		
       $data = $this->includes;

       // load views
       $data['content'] = $this->load->view('admin/tickets/add', NULL, TRUE);
       $this->load->view($this->template, $data);

	}
	
    /**
     * Add tickets form
     */
	function add_ticket()
	{
		$this->form_validation->set_rules('usernames', lang('users transfer amount'), 'required|trim|callback__check_username[]');
		$this->form_validation->set_rules('title', lang('users transfer amount'), 'required');
		$this->form_validation->set_rules('message', lang('users transfer amount'), 'required');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', lang('core error no_username'));
			redirect(site_url("admin/tickets/add"));
		}
		else
		{
			$usernames = $this->input->post("usernames");
			$title = $this->input->post("title");
			$message = $this->input->post("message");

			$ticket = $this->tickets_model->add_ticket(array(
				"date"   => date('Y-m-d H:i:s'),
				"user"   => $usernames,
				"title"  => $title,
				"status" => "1",
				"comment" => "0",
				"message" => $message,
				)
			);
				
			// Sending email

			$email_template = $this->emailtemplate_model->get_email_template(21);
			$users = $this->users_model->get_user_transfer($usernames);

			// variables to replace
			$link = site_url('account/support');
			$site_name = $this->settings->site_name;

			$rawstring = $email_template['message'];

			// what will we replace
		    $placeholders = array('[SITE_NAME]', '[URL_TICKET]');

			$vals_1 = array($site_name, $link);

			//replace
			$str_1 = str_replace($placeholders, $vals_1, $rawstring);

			$this -> email -> from($this->settings->site_email, $this->settings->site_name);
			$this->email->to(
				array($users['email'])
			);

			$this -> email -> subject($email_template['title']);

			$this -> email -> message($str_1);

			$this->email->send();

			$this->session->set_flashdata('message', lang('admin tickets success_create'));
			redirect(site_url('admin/tickets/untreated'));
		}

	}
	
	/**
     * Edit tickets
     */
	
	function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $tickets = $this->tickets_model->get_tickets($id);

        // if empty results, return to list
        if ( ! $tickets)
        {
            redirect($this->_redirect_url);
        }

			$this->form_validation->set_rules('date', lang('admin tickets date'), 'required');
			$this->form_validation->set_rules('user', lang('admin tickets user'), 'required');
			$this->form_validation->set_rules('status', lang('admin col status'), 'required');
			
			$log_comment = $this->tickets_model->get_log_comment($tickets['id']);

            if ($this->form_validation->run() == TRUE)
            {
                // save the changes
                $saved = $this->tickets_model->edit_tickets($this->input->post());

                if ($saved)
                {
                    $this->session->set_flashdata('message', lang('admin tickets success_edit'));
                }
                else
                {
    				$this->session->set_flashdata('error', lang('users error edit_user_failed'));
                }

                // return to list and display message
                redirect($this->_redirect_url);
            }

        // setup page header data
        $this->set_title( lang('admin button det_tickets') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   	=> THIS_URL,
            'cancel_url'    => $this->_redirect_url,
            'tickets'       => $tickets,
			'log_comment'   => $log_comment,
            'ticket_id'     => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/tickets/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Add admin comment
     */
	function add_admin_comment($id)
	{
		// get the data
        $tickets = $this->tickets_model->get_tickets($id);
		$user = $this->users_model->get_user_mail($tickets['user']);
			
		$comment = $this->input->post("comment");
			
		$comments = $this->tickets_model->add_admin_comment(array(
			"id_ticket" 	=> $tickets['id'],
			"date"          => date('Y-m-d H:i:s'),
			"user"          => lang('admin disputes admin'),
			"role"          => "2",
			"comment"       => $comment,
			)
	   );
			
		// update ticket status
		$this->tickets_model->update_ticket($id,
			array(
				"status"   => "2",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(10);
			
		// variables to replace
		$id_tickets = $ticket['id'];
		$link = site_url('account/detail_ticket/');
		$site_name = $this->settings->site_name;
				
		$rawstring = $email_template['message'];
			
		$placeholders = array('[SITE_NAME]', '[URL_TICKET]', '[ID_TICKET]');

		$vals_1 = array($site_name, $link, $id_ticket);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
			
		$sms_template = $this->smstemplate_model->get_sms_template(6);

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
		}

		$this->session->set_flashdata('message', lang('admin tickets admin_comment'));
		redirect(site_url("admin/tickets"));

	}
	
    /**
     * Close ticket
     */
	function close_ticket($id)
	{
		// get the data
        $tickets = $this->tickets_model->get_tickets($id);
		$user = $this->users_model->get_user_mail($tickets['user']);
			
		// update ticket status
		$this->tickets_model->update_ticket($id,
			array(
				"status"   => "3",
				"comment"  => "1",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(11);
			
		// variables to replace
		$id_ticket = $tickets['id'];
		$link = site_url('account/detail_ticket/');
		$site_name = $this->settings->site_name;

		$rawstring = $email_template['message'];

		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_TICKET]', '[ID_TICKET]');

		$vals_1 = array($site_name, $link, $id_ticket);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();

		$sms_template = $this->smstemplate_model->get_sms_template(5);
                                                
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
		}

		$this->session->set_flashdata('message', lang('admin tickets success_close'));
		redirect(site_url("admin/tickets"));

	}
	
	/**
     * Check true username new ticket
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

}