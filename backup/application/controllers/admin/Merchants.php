<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Merchants extends Admin_Controller {
	
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
		$this->load->model('merchants_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/merchants'));
		define('THIS_URL_2', base_url('admin/merchants/moderation'));
		define('THIS_URL_3', base_url('admin/merchants/disapproved'));
		define('THIS_URL_4', base_url('admin/merchants/active'));
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
     * All merchants
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
			
		if ($this->input->get('name'))
        {
            $name_xss = $this->security->xss_clean($this->input->get('name'));
						$name_string = str_replace(' ', '-', $name_xss);
						$name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $name_string);
            $filters['name'] = $name_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('link'))
        {
            $link_xss = $this->security->xss_clean($this->input->get('link'));
						$link_string = str_replace(' ', '-', $link_xss);
						$link_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $link_string);
            $filters['link'] = $link_replace;
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
							
				if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('link'))
                {
                    $filter .= "&link=" . $this->input->post('link', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$merchants = $this->merchants_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin merchant title') );
			
		$data = $this->includes;
		
        // get list
		$merchants = $this->merchants_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $merchants['total'],
			'per_page'   => $limit
		));
			
				// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'merchants'  => $merchants['results'],
            'total'      => $merchants['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/merchants/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Active merchants
     */
    function active()
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
			
		if ($this->input->get('name'))
        {
            $name_xss = $this->security->xss_clean($this->input->get('name'));
						$name_string = str_replace(' ', '-', $name_xss);
						$name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $name_string);
            $filters['name'] = $name_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('link'))
        {
            $link_xss = $this->security->xss_clean($this->input->get('link'));
						$link_string = str_replace(' ', '-', $link_xss);
						$link_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $link_string);
            $filters['link'] = $link_replace;
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
							
				if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('link'))
                {
                    $filter .= "&link=" . $this->input->post('link', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$merchants = $this->merchants_model->get_active($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin merchant title') );
			
		$data = $this->includes;
		
        // get list
		$merchants = $this->merchants_model->get_active($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
		    'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $merchants['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_4' => THIS_URL_4,
            'merchants'  => $merchants['results'],
            'total'      => $merchants['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/merchants/active', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Moderation merchants
     */
    function moderation()
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
			
		if ($this->input->get('name'))
        {
            $name_xss = $this->security->xss_clean($this->input->get('name'));
						$name_string = str_replace(' ', '-', $name_xss);
						$name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $name_string);
            $filters['name'] = $name_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('link'))
        {
            $link_xss = $this->security->xss_clean($this->input->get('link'));
						$link_string = str_replace(' ', '-', $link_xss);
						$link_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $link_string);
            $filters['link'] = $link_replace;
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
							
				if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('link'))
                {
                    $filter .= "&link=" . $this->input->post('link', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$merchants = $this->merchants_model->get_moderation($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin merchant title') );
			
		$data = $this->includes;
		
        // get list
		$merchants = $this->merchants_model->get_moderation($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $merchants['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_2' => THIS_URL_2,
            'merchants'  => $merchants['results'],
            'total'      => $merchants['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/merchants/moderation', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

	/**
     * Disapproved merchants
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
			
		if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }
			
		if ($this->input->get('name'))
        {
            $name_xss = $this->security->xss_clean($this->input->get('name'));
						$name_string = str_replace(' ', '-', $name_xss);
						$name_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $name_string);
            $filters['name'] = $name_replace;
        }

        if ($this->input->get('user'))
        {
            $user_xss = $this->security->xss_clean($this->input->get('user'));
						$user_string = str_replace(' ', '-', $user_xss);
						$user_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $user_string);
            $filters['user'] = $user_replace;
        }
			
		if ($this->input->get('link'))
        {
            $link_xss = $this->security->xss_clean($this->input->get('link'));
						$link_string = str_replace(' ', '-', $link_xss);
						$link_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $link_string);
            $filters['link'] = $link_replace;
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
							
				if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('user'))
                {
                    $filter .= "&user=" . $this->input->post('user', TRUE);
                }
							
				if ($this->input->post('link'))
                {
                    $filter .= "&link=" . $this->input->post('link', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$merchants = $this->merchants_model->get_disapproved($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin merchant title') );
			
		$data = $this->includes;
		
        // get list
		$merchants = $this->merchants_model->get_disapproved($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $merchants['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_3' => THIS_URL_3,
            'merchants'  => $merchants['results'],
            'total'      => $merchants['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/merchants/disapproved', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Edit merchant
     */
	
	function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $merchants = $this->merchants_model->get_merchants($id);

        // if empty results, return to list
        if ( ! $merchants)
        {
            redirect($this->_redirect_url);
        }

		$this->form_validation->set_rules('date', lang('admin tickets date'), 'required');
		$this->form_validation->set_rules('date', lang('admin tickets name'), 'required');
		$this->form_validation->set_rules('link', lang('admin merchant link'), 'required');
		$this->form_validation->set_rules('password', lang('admin merchant link'), 'required');
		$this->form_validation->set_rules('user', lang('admin tickets user'), 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->merchants_model->edit_merchant($this->input->post());

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
        $this->set_title( lang('admin merchant detail') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'    => $this->_redirect_url,
            'merchants'     => $merchants,
            'merchants_id'  => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/merchants/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Confirm merchant
     */
	function confirm($id)
	{
			
		// get the data
        $merchant = $this->merchants_model->get_merchants($id);
		$user = $this->users_model->get_user_transfer($merchant['user']);

		// update merchant status
		$this->merchants_model->update_merchant($id,
			array(
				"status"   => "1"
				)
			);
			
		// Sending email

		$email_template = $this->emailtemplate_model->get_email_template(19);

		// variables to replace
		$id_merchant = $merchant['id'];
		$link = site_url('account/merchants');
		$site_name = $this->settings->site_name;

		$rawstring = $email_template['message'];

		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_MERCHANT]', '[ID_MERCHANT]');

		$vals_1 = array($site_name, $link, $id_merchant);

		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'])
		);

		$this -> email -> subject($email_template['title']);

		$this -> email -> message($str_1);

		$this->email->send();
			
		$this->session->set_flashdata('message', lang('admin merchant success'));
		redirect(site_url("admin/merchants/"));
			
	}
	
    /**
     * Reject merchant
     */
	function reject($id)
	{
	
		// get the data
        $merchant = $this->merchants_model->get_merchants($id);
		$user = $this->users_model->get_user_transfer($merchant['user']);
			
		// update merchant status
		$this->merchants_model->update_merchant($id,
			array(
				"status"   => "3"
				)
			);
			
		// Sending email

		$email_template = $this->emailtemplate_model->get_email_template(20);

		// variables to replace
		$id_merchant = $merchant['id'];
		$link = site_url('account/merchants');
		$site_name = $this->settings->site_name;

		$rawstring = $email_template['message'];

		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_MERCHANT]', '[ID_MERCHANT]');

		$vals_1 = array($site_name, $link, $id_merchant);

		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'])
		);

		$this -> email -> subject($email_template['title']);

		$this -> email -> message($str_1);

		$this->email->send();
			
		$this->session->set_flashdata('message', lang('admin merchant success'));
		redirect(site_url("admin/merchants/"));
			
	}
	
}