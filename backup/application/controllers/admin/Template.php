<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
			
		// load the logs model
        $this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
			
		// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/template'));
		define('THIS_URL_2', base_url('admin/template/sms'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
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

     /**
     * All email templates
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
					
			// get list
			$email_templates = $this->emailtemplate_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title template') );
			
		$data = $this->includes;

		// get list
		$email_templates = $this->emailtemplate_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $email_templates['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'              => THIS_URL,
            'email_templates'       => $email_templates['results'],
            'total'                 => $email_templates['total'],
            'filters'               => $filters,
            'filter'                => $filter,
            'pagination'            => $this->pagination->create_links(),
            'limit'                 => $limit,
            'offset'                => $offset,
            'sort'                  => $sort,
            'dir'                   => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/template/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * All sms templates
     */
    function sms()
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
					
			// get list
			$sms_templates = $this->smstemplate_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin title template') );
			
		$data = $this->includes;

		// get list
		$sms_templates = $this->smstemplate_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $sms_templates['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'          => THIS_URL,
            'sms_templates'     => $sms_templates['results'],
            'total'             => $sms_templates['total'],
            'filters'           => $filters,
            'filter'            => $filter,
            'pagination'        => $this->pagination->create_links(),
            'limit'             => $limit,
            'offset'            => $offset,
            'sort'              => $sort,
            'dir'               => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/template/sms', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Edit email template
     */
	function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $email_templates = $this->emailtemplate_model->get_templates($id);

        // if empty results, return to list
        if ( ! $email_templates)
        {
            redirect($this->_redirect_url);
        }

		$this->form_validation->set_rules('title', lang('admin tickets title'), 'required');
		$this->form_validation->set_rules('message', lang('admin tickets message'), 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->emailtemplate_model->edit_template($this->input->post());

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('admin template success'));
            }
            else
            {
				$this->session->set_flashdata('error', lang('users error edit_user_failed'));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('admin title template') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		   => THIS_URL,
            'cancel_url'           => $this->_redirect_url,
            'email_templates'      => $email_templates,
            'email_templates_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/template/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
    /**
     * Edit sms template
     */
	function edit_sms($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $sms_templates = $this->smstemplate_model->get_templates($id);

        // if empty results, return to list
        if ( ! $sms_templates)
        {
            redirect($this->_redirect_url);
        }

		$this->form_validation->set_rules('title', lang('admin tickets title'), 'required');
		$this->form_validation->set_rules('message', lang('admin tickets message'), 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->smstemplate_model->edit_template($this->input->post());

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('admin template success'));
            }
            else
            {
				$this->session->set_flashdata('error', lang('users error edit_user_failed'));
            }

            // return to list and display message
            redirect(THIS_URL_2);
        }

        // setup page header data
        $this->set_title( lang('admin title template') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		 => THIS_URL_2,
            'cancel_url'         => $this->_redirect_url,
            'sms_templates'      => $sms_templates,
            'sms_templates_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/template/sms_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}