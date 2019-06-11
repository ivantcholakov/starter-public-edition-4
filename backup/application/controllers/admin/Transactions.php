<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends Admin_Controller {
	
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
			
		// load the logs model
		$this->load->library('currencys');
        $this->load->model('transactions_model');
		$this->load->model('disputes_model');
		$this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('emailtemplate_model');
			
		// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/transactions'));
		define('THIS_URL_2', base_url('admin/transactions/pending'));
		define('THIS_URL_3', base_url('admin/transactions/confirmed'));
		define('THIS_URL_4', base_url('admin/transactions/disputed'));
		define('THIS_URL_5', base_url('admin/transactions/blocked'));
		define('THIS_URL_6', base_url('admin/transactions/refunded'));
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
     * Transactions
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
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
            }
            else
            {
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
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_all($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_all($limit, $offset, $filters, $sort, $dir);
		
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/transactions/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Transactions pending
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
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
            }
            else
            {
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
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_pending($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_pending($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_2 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
			'this_url_2'    => THIS_URL_2,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/transactions/pending', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Transactions confirmed
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
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
            }
            else
            {
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
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_pending($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_confirmed($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_3 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
				// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
			'this_url_3'    => THIS_URL_3,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
	    $data['content'] = $this->load->view('admin/transactions/confirmed', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Transactions disputed
     */
    function disputed()
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
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
            }
            else
            {
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
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_disputed($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_disputed($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_4 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
	   // set content data
        $content_data = array(
            'this_url'      => THIS_URL,
			'this_url_4'    => THIS_URL_4,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/transactions/disputed', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Transactions blocked
     */
    function blocked()
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
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
            }
            else
            {
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
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_blocked($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_blocked($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_5 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
			'this_url_5'    => THIS_URL_5,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/transactions/blocked', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Transactions refunded
     */
    function refunded()
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
			
		if ($this->input->get('sender'))
        {
						$sender_xss = $this->security->xss_clean($this->input->get('sender'));
						$sender_string = str_replace(' ', '-', $sender_xss);
						$sender_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $sender_string);
            $filters['sender'] = $sender_replace;
        }
			
		if ($this->input->get('receiver'))
        {
						$receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
						$receiver_string = str_replace(' ', '-', $receiver_xss);
						$receiver_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $receiver_string);
            $filters['receiver'] = $receiver_replace;
        }
			
		if ($this->input->get('time'))
        {
						$time_xss = $this->security->xss_clean($this->input->get('time'));
						$time_string = str_replace(' ', '-', $time_xss);
						$time_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $time_string);
            $filters['time'] = $time_replace;
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

                if ($this->input->post('type'))
                {
                    $filter .= "&type=" . $this->input->post('type', TRUE);
                }

                if ($this->input->post('status'))
                {
                    $filter .= "&status=" . $this->input->post('status', TRUE);
                }
							
				if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
				if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
				if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL_6 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$transactions = $this->transactions_model->get_refunded($limit, $offset, $filters, $sort, $dir);

        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL_6 . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title transactions') );
		
        $data = $this->includes;
			
		// get list
		$transactions = $this->transactions_model->get_refunded($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL_6 . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $transactions['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'      => THIS_URL,
			'this_url_6'    => THIS_URL_6,
            'transactions'  => $transactions['results'],
            'total'         => $transactions['total'],
            'filters'       => $filters,
            'filter'        => $filter,
            'pagination'    => $this->pagination->create_links(),
            'limit'         => $limit,
            'offset'        => $offset,
            'sort'          => $sort,
            'dir'           => $dir
        );

        // load views
		$data['content'] = $this->load->view('admin/transactions/refunded', $content_data, TRUE);
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
        $transactions = $this->transactions_model->get_transactions($id);

        // if empty results, return to list
        if ( ! $transactions)
        {
            redirect($this->_redirect_url);
        }

		$this->form_validation->set_rules('type', lang('admin trans type'), 'required');
		$this->form_validation->set_rules('status', lang('admin trans status'), 'required');
		$this->form_validation->set_rules('sender', lang('admin trans sender'), 'required');
		$this->form_validation->set_rules('receiver', lang('admin trans receiver'), 'required');
		$this->form_validation->set_rules('time', lang('admin trans time'), 'required');
		$this->form_validation->set_rules('sum', lang('admin trans sum'), 'required');
		$this->form_validation->set_rules('fee', lang('admin trans fee'), 'required');
		$this->form_validation->set_rules('amount', lang('admin trans amount'), 'required');
		$this->form_validation->set_rules('user_comment', lang('admin trans comment'), 'max_length[100]');
		$this->form_validation->set_rules('admin_comment', lang('admin trans admin_comment'), 'max_length[300]');
				

        if ($this->form_validation->run() == TRUE)
        {
            // save the changes
            $saved = $this->transactions_model->edit_transaction($this->input->post());

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('users msg edit_user_success'));
            }
            else
            {
				$this->session->set_flashdata('error', lang('users error edit_user_failed'));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('admin title edit_transactions') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'transactions'      => $transactions,
            'transactions_id'   => $id
        );

        // load views
        $data['content'] = $this->load->view('admin/transactions/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }	
	
    /**
     * Confirm withdrawal
     */
	function confirm_withdrawal($id)
	{
		
    	// get the data
        $transactions = $this->transactions_model->get_transactions($id);
		
		$user = $this->users_model->get_user_mail($transactions['sender']);
		
		if ($transactions['type'] == 2 && $transactions['status'] == 1)
		{
			
		// update transaction history
		$this->transactions_model->update_dispute_transactions($transactions['id'],
			array(
				"status"   	 => "2",
			)
		);
		
		$email_template = $this->emailtemplate_model->get_email_template(25);
			
		// variables to replace
		$link = site_url('account/history/');
		$site_name = $this->settings->site_name;
		
		// variables to replace
		if ($transactions['currency']=="debit_base") {
			$mail_cyr = $this->currencys->display->base_code;
		} elseif ($transactions['currency']=="debit_extra1") {
			$mail_cyr = $this->currencys->display->extra1_code;
		} elseif ($transactions['currency']=="debit_extra2") {
			$mail_cyr = $this->currencys->display->extra2_code;
		} elseif ($transactions['currency']=="debit_extra3") {
			$mail_cyr = $this->currencys->display->extra3_code;
		} elseif ($transactions['currency']=="debit_extra4") {
			$mail_cyr = $this->currencys->display->extra4_code;
		} elseif ($transactions['currency']=="debit_extra5") {
			$mail_cyr = $this->currencys->display->extra5_code;
		} 
				
		$rawstring = $email_template['message'];
				
			
		// what will we replace
		$placeholders = array('[SUM]', '[CYR]', '[SITE_NAME]', '[URL_HISTORY]');
			
		$vals_1 = array($transactions['sum'], $mail_cyr, $site_name, $link);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'])
		);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
		
		$this->session->set_flashdata('message', lang('admin trans add_success'));
		redirect(site_url("admin/transactions"));
			
		}else{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/transactions"));
		}
	
	}
	
    /**
     * Refund withdrawal
     */
	function refund_withdrawal($id)
	{
		// get the data
        $transactions = $this->transactions_model->get_transactions($id);
		$user = $this->users_model->get_user_mail($transactions['sender']);
		
		$wallet = $transactions['currency'];
		// Calculation of the amount to be credited to the claimant 
		$return = $user[$wallet]+$transactions['sum'];
		
		if ($transactions['type'] == 2 && $transactions['status'] == 1)
		{
		
		// update transaction history
		$this->transactions_model->update_dispute_transactions($transactions['id'],
			array(
				"status"   	 => "3",
			)
		);
		
		// update claimant wallet
		$this->users_model->update_user($transactions['sender'],
			array(
				$transactions['currency']  => $return,
				)
			);
		
		$email_template = $this->emailtemplate_model->get_email_template(26);
			
		// variables to replace
		$link = site_url('account/history/');
		$site_name = $this->settings->site_name;
		
		// variables to replace
		if ($transactions['currency']=="debit_base") {
			$mail_cyr = $this->currencys->display->base_code;
		} elseif ($transactions['currency']=="debit_extra1") {
			$mail_cyr = $this->currencys->display->extra1_code;
		} elseif ($transactions['currency']=="debit_extra2") {
			$mail_cyr = $this->currencys->display->extra2_code;
		} elseif ($transactions['currency']=="debit_extra3") {
			$mail_cyr = $this->currencys->display->extra3_code;
		} elseif ($transactions['currency']=="debit_extra4") {
			$mail_cyr = $this->currencys->display->extra4_code;
		} elseif ($transactions['currency']=="debit_extra5") {
			$mail_cyr = $this->currencys->display->extra5_code;
		} 
				
		$rawstring = $email_template['message'];
				
		// what will we replace
		$placeholders = array('[SUM]', '[CYR]', '[SITE_NAME]', '[URL_HISTORY]');
			
		$vals_1 = array($transactions['sum'], $mail_cyr, $site_name, $link);
			
		//replace
		$str_1 = str_replace($placeholders, $vals_1, $rawstring);

		$this -> email -> from($this->settings->site_email, $this->settings->site_name);
		$this->email->to(
			array($user['email'])
		);
		$this -> email -> subject($email_template['title']);
			
		$this -> email -> message($str_1);

		$this->email->send();
		
		$this->session->set_flashdata('message', lang('admin trans add_success'));
		redirect(site_url("admin/transactions"));
			
		}else{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/transactions"));
		}
		
	}
	
	  /**
     * Start block transaction
     */
	function start_blocked($id)
	{
		// get the data
    $transactions = $this->transactions_model->get_transactions($id);
		$user = $this->users_model->get_user_mail($transactions['receiver']);
		
		$wallet = $transactions['currency'];
		// Calculation of the amount to be credited to the claimant 
		$return = $user[$wallet]-$transactions['sum'];
		
		if ($transactions['status'] != 5)
		{
		
		// update transaction history
		$this->transactions_model->update_dispute_transactions($transactions['id'],
			array(
				"status"   	 => "5",
			)
		);
		
		// update claimant wallet
		$this->users_model->update_user($transactions['receiver'],
			array(
				$transactions['currency']  => $return,
				)
			);
		
		
		
		$this->session->set_flashdata('message', lang('admin trans success_blocked'));
		redirect(site_url("admin/transactions"));
			
		}else{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/transactions"));
		}
		
	}
	
	  /**
     * Confirm transaction
     */
	function start_confirm($id)
	{
		// get the data
    $transactions = $this->transactions_model->get_transactions($id);
		$user = $this->users_model->get_user_mail($transactions['receiver']);
		
		$wallet = $transactions['currency'];
		// Calculation of the amount to be credited to the claimant 
		$return = $user[$wallet]+$transactions['sum'];
		
		if ($transactions['status'] != 2)
		{
		
		// update transaction history
		$this->transactions_model->update_dispute_transactions($transactions['id'],
			array(
				"status"   	 => "2",
			)
		);
		
		// update claimant wallet
		$this->users_model->update_user($transactions['receiver'],
			array(
				$transactions['currency']  => $return,
				)
			);
		
		
		
		$this->session->set_flashdata('message', lang('admin trans success_confirm'));
		redirect(site_url("admin/transactions"));
			
		}else{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/transactions"));
		}
		
	}
	
	  /**
     * Refund transaction
     */
	function start_refund($id)
	{
		// get the data
    $transactions = $this->transactions_model->get_transactions($id);
		$user2 = $this->users_model->get_user_mail($transactions['receiver']);
		$user = $this->users_model->get_user_mail($transactions['sender']);
		
		$wallet = $transactions['currency'];
		// Calculation of the amount to be credited to the claimant 
		$return = $user[$wallet]+$transactions['sum'];
		
		$return2 = $user2[$wallet]-$transactions['sum'];
		
		if ($transactions['status'] != 3)
		{
		
		// update transaction history
		$this->transactions_model->update_dispute_transactions($transactions['id'],
			array(
				"status"   	 => "3",
			)
		);
		
		// update sender wallet
		$this->users_model->update_user($transactions['sender'],
			array(
				$transactions['currency']  => $return,
				)
			);
			
		// update sender wallet
		$this->users_model->update_user($transactions['receiver'],
			array(
				$transactions['currency']  => $return2,
				)
			);
		
		
		
		$this->session->set_flashdata('message', lang('admin trans success_refund'));
		redirect(site_url("admin/transactions"));
			
		}else{
			$this->session->set_flashdata('error', lang('users error form'));
			redirect(site_url("admin/transactions"));
		}
		
	}

}