<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Verification extends Admin_Controller {
	
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
        $this->load->model('verification_model');
		$this->load->model('users_model');
        $this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/verification'));
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
     * All requests
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
			
		if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('type'))
        {
						$type_xss = $this->security->xss_clean($this->input->get('type'));
						$type_string = str_replace(' ', '-', $type_xss);
						$type_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $type_string);
            $filters['type'] = $type_replace;
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
							
                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$verifications = $this->verification_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title verification') );
			
		$data = $this->includes;

		// get list
		$verification = $this->verification_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $verification['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'          => THIS_URL,
            'verification'      => $verification['results'],
            'total'             => $verification['total'],
            'filters'           => $filters,
            'filter'            => $filter,
            'pagination'        => $this->pagination->create_links(),
            'limit'             => $limit,
            'offset'            => $offset,
            'sort'              => $sort,
            'dir'               => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/verification/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Pending requests
     */
    function pending()
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
			
		if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('type'))
        {
						$type_xss = $this->security->xss_clean($this->input->get('type'));
						$type_string = str_replace(' ', '-', $type_xss);
						$type_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $type_string);
            $filters['type'] = $type_replace;
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
							
                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$verifications = $this->verification_model->get_pending($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title verification') );
			
		$data = $this->includes;

		// get list
		$verification = $this->verification_model->get_pending($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $verification['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
            'verification'  => $verification['results'],
            'total'         => $verification['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/verification/pending', $content_data, TRUE);
        $this->load->view($this->template, $data);
			
    }
	
	/**
     * Disapproved requests
     */
    function disapproved()
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
			
		if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('type'))
        {
						$type_xss = $this->security->xss_clean($this->input->get('type'));
						$type_string = str_replace(' ', '-', $type_xss);
						$type_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $type_string);
            $filters['type'] = $type_replace;
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
							
                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$verifications = $this->verification_model->get_disapproved($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
		  ->set_title( lang('admin title verification') );
			
		$data = $this->includes;

		// get list
		$verification = $this->verification_model->get_disapproved($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $verification['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
            'verification'  => $verification['results'],
            'total'         => $verification['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/verification/disapproved', $content_data, TRUE);
        $this->load->view($this->template, $data);
			
    }
	
	/**
     * Confirmed requests
     */
    function confirmed()
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
			
		if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('type'))
        {
						$type_xss = $this->security->xss_clean($this->input->get('type'));
						$type_string = str_replace(' ', '-', $type_xss);
						$type_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $type_string);
            $filters['type'] = $type_replace;
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
							
                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$verifications = $this->verification_model->get_confirmed($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title verification') );
			
		$data = $this->includes;

		// get list
		$verification = $this->verification_model->get_confirmed($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $verification['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
            'verification'  => $verification['results'],
            'total'         => $verification['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/verification/confirmed', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * reject documents
     */
	function reject($id)
	{
		// get the data
        $verification = $this->verification_model->get_verification($id);
        $user = $this->users_model->get_user_mail($verification['user']);
			
		// update verification status
		$this->verification_model->update_verification($id,
			array(
				"status"   => "3"
				)
			);
			
		// update user verification status
		$this->users_model->verify_user($verification['user'],
			array(
				"verifi_status"   => "0",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(16);
		$sms_template = $this->smstemplate_model->get_sms_template(2);
			
		// variables to replace
		$site_name = $this->settings->site_name;
		$site_url = base_url('account/identification');
			
		$rawstring = $email_template['message'];
				
			
		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_VERIFI]');
			
		$vals_1 = array($site_name, $site_url);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
		
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
			
		$this->session->set_flashdata('message', lang('admin verification reject_suc'));
		redirect(site_url("admin/verification"));

	}
	
    /**
     * Confirm documents
     */
	function confirm($id)
	{	
		// get the data
        $verification = $this->verification_model->get_verification($id);
		$user = $this->users_model->get_user_mail($verification['user']);

		// update verification status
		$this->verification_model->update_verification($id,
			array(
				"status"   => "2"
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(13);
		$sms_template = $this->smstemplate_model->get_sms_template(3);
			
		// variables to replace
		$site_name = $this->settings->site_name;
		$site_url = base_url('account/identification');
			
		$rawstring = $email_template['message'];
					
		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_VERIFI]');
			
		$vals_1 = array($site_name, $site_url);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
			
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
			
		$this->session->set_flashdata('message', lang('admin verification com_suc'));
		redirect(site_url("admin/verification"));

	}
	
    /**
     * Confirm documents and verify account user
     */
	function confirm_verify($id)
	{
		// get the data
        $verification = $this->verification_model->get_verification($id);
		$user = $this->users_model->get_user_mail($verification['user']);

		// update verification status
		$this->verification_model->update_verification($id,
			array(
				"status"   => "2"
				)
			);
			
		// update user verification status
		$this->users_model->verify_user($verification['user'],
			array(
				"verifi_status"   => "1",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(14);
		$sms_template = $this->smstemplate_model->get_sms_template(1);
			
		// variables to replace
		$site_name = $this->settings->site_name;
		$site_url = base_url('account/identification');
			
		$rawstring = $email_template['message'];
				
			
		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_VERIFI]');
			
		$vals_1 = array($site_name, $site_url);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
        
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
			
		$this->session->set_flashdata('message', lang('admin verification com_ver_suc'));
		redirect(site_url("admin/verification"));

	}
	
	/**
     * Confirm documents and business status account user
     */
    function confirm_business($id)
	{
		// get the data
        $verification = $this->verification_model->get_verification($id);
		$user = $this->users_model->get_user_mail($verification['user']);

		// update verification status
		$this->verification_model->update_verification($id,
			array(
				"status"   => "2"
				)
			);
			
		// update user verification status
		$this->users_model->verify_user($verification['user'],
			array(
				"verifi_status"   => "2",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(15);
		$sms_template = $this->smstemplate_model->get_sms_template(4);
			
		// variables to replace
		$site_name = $this->settings->site_name;
		$site_url = base_url('account/identification');
			
		$rawstring = $email_template['message'];
			
		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_VERIFI]');
			
		$vals_1 = array($site_name, $site_url);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this -> email -> to($user['email']);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
			
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
			
		$this->session->set_flashdata('message', lang('admin verification com_bus_suc'));
		redirect(site_url("admin/verification"));

	}

}