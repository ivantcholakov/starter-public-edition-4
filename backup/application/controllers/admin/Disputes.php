<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Disputes extends Admin_Controller {
	
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
		$this->load->library('email');
		$this->load->library('currencys');
        $this->load->model('disputes_model');
		$this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
			
		// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/disputes'));
		define('THIS_URL_2', base_url('admin/disputes/open_claims'));
		define('THIS_URL_3', base_url('admin/disputes/open_disputes'));
		define('THIS_URL_4', base_url('admin/disputes/rejected_disputes'));
		define('THIS_URL_5', base_url('admin/disputes/satisfied_disputes'));
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
    * Disputes list
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
			
		if ($this->input->get('transaction'))
        {
						$transaction_xss = $this->security->xss_clean($this->input->get('transaction'));
						$transaction_string = str_replace(' ', '-', $transaction_xss);
						$transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $transaction_string);
            $filters['transaction'] = $transaction_replace;
        }

        if ($this->input->get('time_transaction'))
        {
						$time_transaction_xss = $this->security->xss_clean($this->input->get('time_transaction'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_transaction_string);
            $filters['time_transaction'] = $time_transaction_replace;
        }
			
		if ($this->input->get('time_dispute'))
        {
						$time_dispute_xss = $this->security->xss_clean($this->input->get('time_dispute'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_dispute_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_dispute_string);
            $filters['time_dispute'] = $time_dispute_replace;
        }
			
		if ($this->input->get('claimant'))
        {
						$claimant_xss = $this->security->xss_clean($this->input->get('claimant'));
						$claimant_string = str_replace(' ', '-', $claimant_xss);
						$claimant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $claimant_string);
            $filters['claimant'] = $claimant_replace;
        }
			
		if ($this->input->get('defendant'))
        {
						$defendant_xss = $this->security->xss_clean($this->input->get('defendant'));
						$defendant_string = str_replace(' ', '-', $defendant_xss);
						$defendant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $defendant_string);
            $filters['defendant'] = $defendant_replace;
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
							
				if ($this->input->post('transaction'))
                {
                    $filter .= "&transaction=" . $this->input->post('transaction', TRUE);
                }

                if ($this->input->post('time_transaction'))
                {
                    $filter .= "&time_transaction=" . $this->input->post('time_transaction', TRUE);
                }

                if ($this->input->post('time_dispute'))
                {
                    $filter .= "&time_dispute=" . $this->input->post('time_dispute', TRUE);
                }
							
				if ($this->input->post('claimant'))
                {
                    $filter .= "&claimant=" . $this->input->post('claimant', TRUE);
                }
							
				if ($this->input->post('defendant'))
                {
                    $filter .= "&defendant=" . $this->input->post('defendant', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$disputes = $this->disputes_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title disputes') );
		
        $data = $this->includes;
			
		// get list
		$disputes = $this->disputes_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $disputes['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'disputes'   => $disputes['results'],
            'total'      => $disputes['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/disputes/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * Disputes open claims
    */
    function open_claims()
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
			
		if ($this->input->get('transaction'))
        {
						$transaction_xss = $this->security->xss_clean($this->input->get('transaction'));
						$transaction_string = str_replace(' ', '-', $transaction_xss);
						$transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $transaction_string);
            $filters['transaction'] = $transaction_replace;
        }

        if ($this->input->get('time_transaction'))
        {
						$time_transaction_xss = $this->security->xss_clean($this->input->get('time_transaction'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_transaction_string);
            $filters['time_transaction'] = $time_transaction_replace;
        }
			
		if ($this->input->get('time_dispute'))
        {
						$time_dispute_xss = $this->security->xss_clean($this->input->get('time_dispute'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_dispute_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_dispute_string);
            $filters['time_dispute'] = $time_dispute_replace;
        }
			
		if ($this->input->get('claimant'))
        {
						$claimant_xss = $this->security->xss_clean($this->input->get('claimant'));
						$claimant_string = str_replace(' ', '-', $claimant_xss);
						$claimant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $claimant_string);
            $filters['claimant'] = $claimant_replace;
        }
			
		if ($this->input->get('defendant'))
        {
						$defendant_xss = $this->security->xss_clean($this->input->get('defendant'));
						$defendant_string = str_replace(' ', '-', $defendant_xss);
						$defendant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $defendant_string);
            $filters['defendant'] = $defendant_replace;
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
							
				if ($this->input->post('transaction'))
                {
                    $filter .= "&transaction=" . $this->input->post('transaction', TRUE);
                }

                if ($this->input->post('time_transaction'))
                {
                    $filter .= "&time_transaction=" . $this->input->post('time_transaction', TRUE);
                }

                if ($this->input->post('time_dispute'))
                {
                    $filter .= "&time_dispute=" . $this->input->post('time_dispute', TRUE);
                }
							
				if ($this->input->post('claimant'))
                {
                    $filter .= "&claimant=" . $this->input->post('claimant', TRUE);
                }
							
				if ($this->input->post('defendant'))
                {
                    $filter .= "&defendant=" . $this->input->post('defendant', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$disputes = $this->disputes_model->get_open_claims($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title disputes') );
		
        $data = $this->includes;
			
		// get list
		$disputes = $this->disputes_model->get_open_claims($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $disputes['total'],
			'per_page'   => $limit
		));
			
				// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_2' => THIS_URL_2,
            'disputes'   => $disputes['results'],
            'total'      => $disputes['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/disputes/open_claims', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Disputes open disputes
     */
    function open_disputes()
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
			
		if ($this->input->get('transaction'))
        {
						$transaction_xss = $this->security->xss_clean($this->input->get('transaction'));
						$transaction_string = str_replace(' ', '-', $transaction_xss);
						$transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $transaction_string);
            $filters['transaction'] = $transaction_replace;
        }

        if ($this->input->get('time_transaction'))
        {
						$time_transaction_xss = $this->security->xss_clean($this->input->get('time_transaction'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_transaction_string);
            $filters['time_transaction'] = $time_transaction_replace;
        }
			
		if ($this->input->get('time_dispute'))
        {
						$time_dispute_xss = $this->security->xss_clean($this->input->get('time_dispute'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_dispute_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_dispute_string);
            $filters['time_dispute'] = $time_dispute_replace;
        }
			
		if ($this->input->get('claimant'))
        {
						$claimant_xss = $this->security->xss_clean($this->input->get('claimant'));
						$claimant_string = str_replace(' ', '-', $claimant_xss);
						$claimant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $claimant_string);
            $filters['claimant'] = $claimant_replace;
        }
			
		if ($this->input->get('defendant'))
        {
						$defendant_xss = $this->security->xss_clean($this->input->get('defendant'));
						$defendant_string = str_replace(' ', '-', $defendant_xss);
						$defendant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $defendant_string);
            $filters['defendant'] = $defendant_replace;
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
							
				if ($this->input->post('transaction'))
                {
                    $filter .= "&transaction=" . $this->input->post('transaction', TRUE);
                }

                if ($this->input->post('time_transaction'))
                {
                    $filter .= "&time_transaction=" . $this->input->post('time_transaction', TRUE);
                }

                if ($this->input->post('time_dispute'))
                {
                    $filter .= "&time_dispute=" . $this->input->post('time_dispute', TRUE);
                }
							
				if ($this->input->post('claimant'))
                {
                    $filter .= "&claimant=" . $this->input->post('claimant', TRUE);
                }
							
				if ($this->input->post('defendant'))
                {
                    $filter .= "&defendant=" . $this->input->post('defendant', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$disputes = $this->disputes_model->get_open_disputes($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title disputes') );
		
        $data = $this->includes;
			
		// get list
		$disputes = $this->disputes_model->get_open_disputes($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $disputes['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_3' => THIS_URL_3,
            'disputes'   => $disputes['results'],
            'total'      => $disputes['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/disputes/open_disputes', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Disputes rejected disputes
     */
    function rejected_disputes()
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
			
		if ($this->input->get('transaction'))
        {
						$transaction_xss = $this->security->xss_clean($this->input->get('transaction'));
						$transaction_string = str_replace(' ', '-', $transaction_xss);
						$transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $transaction_string);
            $filters['transaction'] = $transaction_replace;
        }

        if ($this->input->get('time_transaction'))
        {
						$time_transaction_xss = $this->security->xss_clean($this->input->get('time_transaction'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_transaction_string);
            $filters['time_transaction'] = $time_transaction_replace;
        }
			
		if ($this->input->get('time_dispute'))
        {
						$time_dispute_xss = $this->security->xss_clean($this->input->get('time_dispute'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_dispute_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_dispute_string);
            $filters['time_dispute'] = $time_dispute_replace;
        }
			
		if ($this->input->get('claimant'))
        {
						$claimant_xss = $this->security->xss_clean($this->input->get('claimant'));
						$claimant_string = str_replace(' ', '-', $claimant_xss);
						$claimant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $claimant_string);
            $filters['claimant'] = $claimant_replace;
        }
			
		if ($this->input->get('defendant'))
        {
						$defendant_xss = $this->security->xss_clean($this->input->get('defendant'));
						$defendant_string = str_replace(' ', '-', $defendant_xss);
						$defendant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $defendant_string);
            $filters['defendant'] = $defendant_replace;
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
							
				if ($this->input->post('transaction'))
                {
                    $filter .= "&transaction=" . $this->input->post('transaction', TRUE);
                }

                if ($this->input->post('time_transaction'))
                {
                    $filter .= "&time_transaction=" . $this->input->post('time_transaction', TRUE);
                }

                if ($this->input->post('time_dispute'))
                {
                    $filter .= "&time_dispute=" . $this->input->post('time_dispute', TRUE);
                }
							
				if ($this->input->post('claimant'))
                {
                    $filter .= "&claimant=" . $this->input->post('claimant', TRUE);
                }
							
				if ($this->input->post('defendant'))
                {
                    $filter .= "&defendant=" . $this->input->post('defendant', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$disputes = $this->disputes_model->get_rejected_disputes($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title disputes') );
		
        $data = $this->includes;
			
		// get list
		$disputes = $this->disputes_model->get_rejected_disputes($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $disputes['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_4' => THIS_URL_4,
            'disputes'   => $disputes['results'],
            'total'      => $disputes['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/disputes/rejected_disputes', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Disputes satisfied disputes
     */
    function satisfied_disputes()
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
			
		if ($this->input->get('transaction'))
        {
						$transaction_xss = $this->security->xss_clean($this->input->get('transaction'));
						$transaction_string = str_replace(' ', '-', $transaction_xss);
						$transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $transaction_string);
            $filters['transaction'] = $transaction_replace;
        }

        if ($this->input->get('time_transaction'))
        {
						$time_transaction_xss = $this->security->xss_clean($this->input->get('time_transaction'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_transaction_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_transaction_string);
            $filters['time_transaction'] = $time_transaction_replace;
        }
			
		if ($this->input->get('time_dispute'))
        {
						$time_dispute_xss = $this->security->xss_clean($this->input->get('time_dispute'));
						$time_transaction_string = str_replace(' ', '-', $time_transaction_xss);
						$time_dispute_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_dispute_string);
            $filters['time_dispute'] = $time_dispute_replace;
        }
			
		if ($this->input->get('claimant'))
        {
						$claimant_xss = $this->security->xss_clean($this->input->get('claimant'));
						$claimant_string = str_replace(' ', '-', $claimant_xss);
						$claimant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $claimant_string);
            $filters['claimant'] = $claimant_replace;
        }
			
		if ($this->input->get('defendant'))
        {
						$defendant_xss = $this->security->xss_clean($this->input->get('defendant'));
						$defendant_string = str_replace(' ', '-', $defendant_xss);
						$defendant_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $defendant_string);
            $filters['defendant'] = $defendant_replace;
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
							
				if ($this->input->post('transaction'))
                {
                    $filter .= "&transaction=" . $this->input->post('transaction', TRUE);
                }

                if ($this->input->post('time_transaction'))
                {
                    $filter .= "&time_transaction=" . $this->input->post('time_transaction', TRUE);
                }

                if ($this->input->post('time_dispute'))
                {
                    $filter .= "&time_dispute=" . $this->input->post('time_dispute', TRUE);
                }
							
				if ($this->input->post('claimant'))
                {
                    $filter .= "&claimant=" . $this->input->post('claimant', TRUE);
                }
							
				if ($this->input->post('defendant'))
                {
                    $filter .= "&defendant=" . $this->input->post('defendant', TRUE);
                }
							
				if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
    		// get list
    		$disputes = $this->disputes_model->get_satisfied_disputes($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title disputes') );
		
        $data = $this->includes;
			
		// get list
		$disputes = $this->disputes_model->get_satisfied_disputes($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $disputes['total'],
			'per_page'   => $limit
		));
			
				// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
			'this_url_5' => THIS_URL_5,
            'disputes'   => $disputes['results'],
            'total'      => $disputes['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/disputes/satisfied_disputes', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Edit transaction
     */
	function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $disputes = $this->disputes_model->get_disputes($id);

        // if empty results, return to list
        if ( ! $disputes)
        {
            redirect($this->_redirect_url);
        }

			$this->form_validation->set_rules('time_transaction', lang('admin disputes id_tran_time'), 'required');
			$this->form_validation->set_rules('time_dispute', lang('admin disputes time_dispute'), 'required');
			$this->form_validation->set_rules('claimant', lang('admin disputes claimant'), 'required');
			$this->form_validation->set_rules('defendant', lang('admin disputes defendant'), 'required');
			$this->form_validation->set_rules('sum', lang('admin trans sum'), 'required');
			$this->form_validation->set_rules('fee', lang('admin trans fee'), 'required');
			$this->form_validation->set_rules('amount', lang('admin trans amount'), 'required');
			
			$log_comment = $this->disputes_model->get_log_comment($disputes['id']);

            if ($this->form_validation->run() == TRUE)
            {
                // save the changes
                $saved = $this->disputes_model->edit_dispute($this->input->post());

                if ($saved)
                {
                    $this->session->set_flashdata('message', lang('admin disputes success'));
                }
                else
                {
    				$this->session->set_flashdata('error', lang('users error edit_user_failed'));
                }

                // return to list and display message
                redirect($this->_redirect_url);
            }

        // setup page header data
        $this->set_title( lang('admin title edit_dispute') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   	=> THIS_URL,
            'cancel_url'    => $this->_redirect_url,
            'disputes'      => $disputes,
			'log_comment'   => $log_comment,
            'disputes_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/disputes/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Add admin comment
     */
	function add_admin_comment($id)
	{
		// get the data
        $disputes = $this->disputes_model->get_disputes($id);
		$user = $this->users_model->get_user_mail($disputes['defendant']);
		$user2 = $this->users_model->get_user_mail($disputes['claimant']);
			
		$comment = $this->input->post("comment");
			
		$comments = $this->disputes_model->add_admin_comment(array(
			"id_dispute" 	=> $disputes['id'],
			"time"          => date('Y-m-d H:i:s'),
			"user"          => lang('admin disputes admin'),
			"role"          => "2",
			"comment"       => $comment,
			)
		);
			
		$email_template = $this->emailtemplate_model->get_email_template(6);
		$sms_template = $this->smstemplate_model->get_sms_template(11);
			
		// variables to replace
		$id_dispute = $disputes['id'];
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
			array($user['email'], $user2['email'])
		);
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
    				
    		$to = '+'.$user2['phone'];
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


		$this->session->set_flashdata('message', lang('admin disputes success_com'));
		redirect(site_url("admin/disputes"));

	}
	
	/**
     * Open claim (admin)
     */
	function open_claim($id)
	{
			
		// get the data
        $disputes = $this->disputes_model->get_disputes($id);
		$user = $this->users_model->get_user_mail($disputes['defendant']);
		$user2 = $this->users_model->get_user_mail($disputes['claimant']);

		// update dispute
		$this->disputes_model->update_dispute($id,
			array(
				"status"   => "2",
				"comments" => "1",
				)
			);
			
		// update user fraud status
		$this->users_model->update_user($dispute['defendant'],
			array(
				"fraud_status"   => "1",
				)
			);
			
		// add notification comment listing
		$comments = $this->disputes_model->new_comment(array(
			"id_dispute" 	  => $disputes['id'],
			"user" 		      => lang('admin disputes admin'),
			"role" 		      => "3",
			"comment" 		  => lang('admin disputes transferred'),
			"time"            => date('Y-m-d H:i:s'),
			)
		);
			
		$email_template = $this->emailtemplate_model->get_email_template(7);
		$sms_template = $this->smstemplate_model->get_sms_template(9);
			
		// variables to replace
		$id_dispute = $disputes['id'];
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
			array($user['email'], $user2['email'])
		);
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
    				
    		$to = '+'.$user2['phone'];
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

			
		$this->session->set_flashdata('message', lang('admin disputes success_claim'));
		redirect(site_url("admin/disputes"));

	}
	
    /**
     * Start dispute (admin)
     */
	function open_dispute($id)
	{	
		// get the data
        $disputes = $this->disputes_model->get_disputes($id);

		// update dispute
		$this->disputes_model->update_dispute($id,
			array(
				"status"   => "1",
				"comments" => "0",
				)
			);
			
		// add notification comment listing
		$comments = $this->disputes_model->new_comment(array(
			"id_dispute"    => $disputes['id'],
			"user" 		    => lang('admin disputes admin'),
			"role" 		    => "3",
			"comment" 		=> lang('admin disputes open_dispute_ad'),
			"time"          => date('Y-m-d H:i:s'),
			)
		);
			
		// update transaction history
		$this->transactions_model->update_dispute_transactions($disputes['transaction'],
			array(
				"status"    => "4",
				)
			);
			
		$this->session->set_flashdata('message', lang('admin disputes success_dispute'));
		redirect(site_url("admin/disputes"));

	}
	
    /**
     * Reject dispute
     */
	function reject($id)
	{
			
		// get the data
        $disputes = $this->disputes_model->get_disputes($id);
		$user = $this->users_model->get_user_mail($disputes['defendant']);
		$user2 = $this->users_model->get_user_mail($disputes['claimant']);

		// update dispute
		$this->disputes_model->update_dispute($id,
			array(
				"status"   => "3",
				"comments" => "1",
				)
			);
			
		// update user fraud status
		$this->users_model->update_user($disputes['defendant'],
			array(
				"fraud_status"   => "0",
				)
			);
			
		// update transaction history
		$this->transactions_model->update_dispute_transactions($disputes['transaction'],
			array(
				"status"   			 => "2",
				)
			);
			
		// add notification comment listing
		$comments = $this->disputes_model->new_comment(array(
			"id_dispute" 	    => $disputes['id'],
			"user" 		        => lang('admin disputes admin'),
			"role" 		        => "4",
			"comment" 		    => lang('admin disputes open_reject'),
			"time"              => date('Y-m-d H:i:s'),
			)
		);
			
		$email_template = $this->emailtemplate_model->get_email_template(8);
		$sms_template = $this->smstemplate_model->get_sms_template(7);
			
		// variables to replace
		$id_dispute = $disputes['id'];
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
			array($user['email'], $user2['email'])
			);
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
        				
        		$to = '+'.$user2['phone'];
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
			
		$this->session->set_flashdata('message', lang('admin disputes success_reject'));
		redirect(site_url("admin/disputes"));

	}
	
    /**
     * Satisfy dispute
     */
	function satisfy($id)
	{
		// get the data
        $disputes = $this->disputes_model->get_disputes($id);
		$user = $this->users_model->get_user_disp($disputes['defendant']);
		$users = $this->users_model->get_user_claim($disputes['claimant']);
		$wallet = $disputes['currency'];
		$amount = $disputes['amount'];
			
		// update dispute
		$this->disputes_model->update_dispute($id,
			array(
				"status"   => "4",
				"comments" => "1",
			    )
			);
			
		// Calculation of the amount to debit the defendant's account
		$refund = $user[$wallet]-$amount;
			
		// Calculation of the amount to be credited to the claimant 
		$return = $users[$wallet]+$amount;
		
		// update defendant fraud status and wallet
		$this->users_model->update_user($disputes['defendant'],
			array(
				"fraud_status"   			 => "0",
				$disputes['currency']  => $refund,
				)
			);
			
		// update claimant wallet
		$this->users_model->update_user($disputes['claimant'],
			array(
				$disputes['currency']  => $return,
				)
			);
			
		// add notification comment listing
		$comments = $this->disputes_model->new_comment(array(
			"id_dispute" 		=> $disputes['id'],
			"user" 		      => lang('admin disputes admin'),
			"role" 		      => "5",
			"comment" 		  => lang('admin disputes open_satisfy'),
			"time"          => date('Y-m-d H:i:s'),
			)
		);
			
		// update transaction history
		$this->transactions_model->update_dispute_transactions($disputes['transaction'],
			array(
				"status"   			 => "3",
				)
			);
			
		$email_template = $this->emailtemplate_model->get_email_template(17);
		$sms_template = $this->smstemplate_model->get_sms_template(8);
			
		// variables to replace
		$id_dispute = $disputes['id'];
		$id_transaction = $disputes['transaction'];
		$link = site_url('account/dispute/');
		$site_name = $this->settings->site_name;
				
		$rawstring = $email_template['message'];
				
		// what will we replace
		$placeholders = array('[SITE_NAME]', '[URL_DISPUTE]', '[ID_DISPUTE]', '[ID_TRANSACTION]');
			
		$vals_1 = array($site_name, $link, $id_dispute, $id_transaction);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'], $users['email'])
		);
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
			
			$this->session->set_flashdata('message', lang('admin disputes success_satisfy'));
			redirect(site_url("admin/disputes"));

		}

}