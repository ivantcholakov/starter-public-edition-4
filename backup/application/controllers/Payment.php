<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Public_Controller {

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
		$this->load->library('commission');
		$this->load->library('email');
		$this->load->library('currencys');
    }


    /**
	* Payment processing
    */
	function index()
	{
        // setup page header data
        $this->set_title(sprintf(lang('core payment title'), $this->settings->site_name));

        $data = $this->includes;

        // set content data
        $content_data = array(
        );

        // load views
        $data['content'] = $this->load->view('payment', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

}