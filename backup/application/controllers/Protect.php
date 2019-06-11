<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Protect extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
    }


    /**
	* Default
    */
	function index()
	{
        // setup page header data
        $this->set_title(sprintf(lang('core button protect'), $this->settings->site_name));

        $data = $this->includes;

        // set content data
        $content_data = array(
        );

        // load views
        $data['content'] = $this->load->view('protect', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

}