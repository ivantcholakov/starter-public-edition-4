<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vouchers extends Admin_Controller {
	
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
		$this->load->model('vouchers_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
		$this->load->library('currencys');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/vouchers'));
		define('THIS_URL_2', base_url('admin/vouchers/pending'));
		define('THIS_URL_3', base_url('admin/merchants/disapproved'));
		define('THIS_URL_4', base_url('admin/vouchers/activated'));
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
     * All Vouchers
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
			
		if ($this->input->get('date_creature'))
        {
            $date_creature_xss = $this->security->xss_clean($this->input->get('date_creature'));
						$date_creature_string = str_replace(' ', '-', $date_creature_xss);
						$date_creature_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_creature_string);
            $filters['date_creature'] = $date_creature_replace;
        }
			
		if ($this->input->get('creator'))
        {
						$creator_xss = $this->security->xss_clean($this->input->get('creator'));
						$creator_string = str_replace(' ', '-', $creator_xss);
						$creator_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $creator_string);
            $filters['creator'] = $creator_replace;
        }

        if ($this->input->get('code'))
        {
            $code_xss = $this->security->xss_clean($this->input->get('code'));
						$code_string = str_replace(' ', '-', $code_xss);
						$code_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $code_string);
            $filters['code'] = $code_replace;
        }
			
		if ($this->input->get('amount'))
        {
						$amount_xss = $this->security->xss_clean($this->input->get('amount'));
						$amount_string = str_replace(' ', '-', $amount_xss);
						$amount_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $amount_string);
            $filters['amount'] = $amount_replace;
        }
			
		if ($this->input->get('status'))
        {
            $status_xss = $this->security->xss_clean($this->input->get('status'));
						$status_string = str_replace(' ', '-', $status_xss);
						$status_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $status_string);
            $filters['status'] = $status_replace;
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
							
				if ($this->input->post('date_creature'))
                {
                    $filter .= "&date_creature=" . $this->input->post('date_creature', TRUE);
                }
							
				if ($this->input->post('creator'))
                {
                    $filter .= "&creator=" . $this->input->post('creator', TRUE);
                }

                if ($this->input->post('code'))
                {
                    $filter .= "&code=" . $this->input->post('code', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }
							
				if ($this->input->post('amount'))
                {
                    $filter .= "&amount=" . $this->input->post('amount', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$vouchers = $this->vouchers_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin vouchers menu') );
			
		$data = $this->includes;
		
        // get list
		$vouchers = $this->vouchers_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $vouchers['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
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
		$data['content'] = $this->load->view('admin/vouchers/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Active Vouchers
     */
    function activated()
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
			
		if ($this->input->get('date_creature'))
        {
            $date_creature_xss = $this->security->xss_clean($this->input->get('date_creature'));
						$date_creature_string = str_replace(' ', '-', $date_creature_xss);
						$date_creature_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_creature_string);
            $filters['date_creature'] = $date_creature_replace;
        }
			
		if ($this->input->get('creator'))
        {
						$creator_xss = $this->security->xss_clean($this->input->get('creator'));
						$creator_string = str_replace(' ', '-', $creator_xss);
						$creator_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $creator_string);
            $filters['creator'] = $creator_replace;
        }

        if ($this->input->get('code'))
        {
            $code_xss = $this->security->xss_clean($this->input->get('code'));
						$code_string = str_replace(' ', '-', $code_xss);
						$code_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $code_string);
            $filters['code'] = $code_replace;
        }
			
		if ($this->input->get('amount'))
        {
						$amount_xss = $this->security->xss_clean($this->input->get('amount'));
						$amount_string = str_replace(' ', '-', $amount_xss);
						$amount_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $amount_string);
            $filters['amount'] = $amount_replace;
        }
			
		if ($this->input->get('status'))
        {
            $status_xss = $this->security->xss_clean($this->input->get('status'));
						$status_string = str_replace(' ', '-', $status_xss);
						$status_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $status_string);
            $filters['status'] = $status_replace;
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
							
				if ($this->input->post('date_creature'))
                {
                    $filter .= "&date_creature=" . $this->input->post('date_creature', TRUE);
                }
							
				if ($this->input->post('creator'))
                {
                    $filter .= "&creator=" . $this->input->post('creator', TRUE);
                }

                if ($this->input->post('code'))
                {
                    $filter .= "&code=" . $this->input->post('code', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }
							
				if ($this->input->post('amount'))
                {
                    $filter .= "&amount=" . $this->input->post('amount', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$vouchers = $this->vouchers_model->get_active($limit, $offset, $filters, $sort, $dir);

        }
			
	// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin vouchers menu') );
			
		$data = $this->includes;
		
        // get list
		$vouchers = $this->vouchers_model->get_active($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $vouchers['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL_4,
			'this_url_4' => THIS_URL_4,
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
		$data['content'] = $this->load->view('admin/vouchers/activated', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Pending Vouchers
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
			
		if ($this->input->get('date_creature'))
        {
            $date_creature_xss = $this->security->xss_clean($this->input->get('date_creature'));
						$date_creature_string = str_replace(' ', '-', $date_creature_xss);
						$date_creature_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_creature_string);
            $filters['date_creature'] = $date_creature_replace;
        }
			
		if ($this->input->get('creator'))
        {
						$creator_xss = $this->security->xss_clean($this->input->get('creator'));
						$creator_string = str_replace(' ', '-', $creator_xss);
						$creator_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $creator_string);
            $filters['creator'] = $creator_replace;
        }

        if ($this->input->get('code'))
        {
            $code_xss = $this->security->xss_clean($this->input->get('code'));
						$code_string = str_replace(' ', '-', $code_xss);
						$code_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $code_string);
            $filters['code'] = $code_replace;
        }
			
		if ($this->input->get('amount'))
        {
						$amount_xss = $this->security->xss_clean($this->input->get('amount'));
						$amount_string = str_replace(' ', '-', $amount_xss);
						$amount_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $amount_string);
            $filters['amount'] = $amount_replace;
        }
			
		if ($this->input->get('status'))
        {
            $status_xss = $this->security->xss_clean($this->input->get('status'));
						$status_string = str_replace(' ', '-', $status_xss);
						$status_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $status_string);
            $filters['status'] = $status_replace;
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
							
				if ($this->input->post('date_creature'))
                {
                    $filter .= "&date_creature=" . $this->input->post('date_creature', TRUE);
                }
							
				if ($this->input->post('creator'))
                {
                    $filter .= "&creator=" . $this->input->post('creator', TRUE);
                }

                if ($this->input->post('code'))
                {
                    $filter .= "&code=" . $this->input->post('code', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }
							
				if ($this->input->post('amount'))
                {
                    $filter .= "&amount=" . $this->input->post('amount', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$vouchers = $this->vouchers_model->get_pending($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->set_title( lang('admin vouchers menu') );
			
		$data = $this->includes;
		
        // get list
		$vouchers = $this->vouchers_model->get_pending($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $vouchers['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_2' => THIS_URL_2,
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
		$data['content'] = $this->load->view('admin/vouchers/pending', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	
	/**
     * Edit Vouchers
     */
	
	function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $vouchers = $this->vouchers_model->get_vouchers($id);

        // if empty results, return to list
        if ( !  $vouchers)
        {
            redirect($this->_redirect_url);
        }

		$this->form_validation->set_rules('status', lang('admin col status'), 'required');
		$this->form_validation->set_rules('code', lang('admin vouchers code'), 'required');
		$this->form_validation->set_rules('activator', lang('admin vouchers activator'), 'required');
		$this->form_validation->set_rules('date_creature', lang('admin tickets date'), 'required');
		$this->form_validation->set_rules('creator', lang('admin vouchers creator'), 'required');
		$this->form_validation->set_rules('amount', lang('admin trans amount'), 'required');
		$this->form_validation->set_rules('date_activation', lang('admin vouchers date'), 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->vouchers_model->edit_voucher($this->input->post());

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
        $this->set_title( lang('admin vouchers detail') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'    => $this->_redirect_url,
            'vouchers'      => $vouchers,
            'vouchers_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/vouchers/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
}