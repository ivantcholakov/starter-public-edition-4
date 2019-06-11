<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends Admin_Controller {
	
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
        $this->load->model('logs_model');
			
				// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/logs'));
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
     * Activity Log
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

        if ($this->input->get('date'))
        {
            $date_xss = $this->security->xss_clean($this->input->get('date'));
						$date_string = str_replace(' ', '-', $date_xss);
						$date_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $date_string);
            $filters['date'] = $date_replace;
        }
			
		if ($this->input->get('event'))
        {
            $event_xss = $this->security->xss_clean($this->input->get('event'));
						$event_string = str_replace(' ', '-', $event_xss);
						$event_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $event_string);
            $filters['event'] = $event_replace;
        }
			
		if ($this->input->get('ip'))
        {
            $ip_xss = $this->security->xss_clean($this->input->get('ip'));
						$ip_string = str_replace(' ', '-', $ip_xss);
						$ip_replace = preg_replace('/[^A-Za-z0-9\-]/', '', $ip_string);
            $filters['ip'] = $ip_replace;
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

                if ($this->input->post('date'))
                {
                    $filter .= "&date=" . $this->input->post('date', TRUE);
                }
							
				if ($this->input->post('event'))
                {
                    $filter .= "&event=" . $this->input->post('event', TRUE);
                }
							
				if ($this->input->post('ip'))
                {
                    $filter .= "&ip=" . $this->input->post('ip', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
					
			// get list
			$logs = $this->logs_model->get_all($limit, $offset, $filters, $sort, $dir);
					
        }
			
		// save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			
        // setup page header data
		$this
			->add_js_theme("currency_i18n.js", TRUE )
			->set_title( lang('admin title logs') );
		
        $data = $this->includes;
			
		// get list
		$logs = $this->logs_model->get_all($limit, $offset, $filters, $sort, $dir);
			
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $logs['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'logs'       => $logs['results'],
            'total'      => $logs['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/logs/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
    /**
     * Delite logs
     */
	function clear_log() 
	{
		$this->logs_model->clear_log();
		$this->session->set_flashdata('message', lang('admin currency msg save_success'));
		redirect(site_url("admin/logs"));
	}

}