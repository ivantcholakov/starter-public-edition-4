<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends Admin_Controller {

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('currency');
		// load model class
		$this->load->model("currencys_model");
		$this->load->library('currencys');
    }


    /**
    * Currency
    */
    function index()
    {
        // get currencys
        $currencys = $this->currencys_model->get_currencys();

        // setup page header data
		 $this
			->add_css_theme('summernote.css')
			->add_js_theme('summernote.min.js')
			->add_js_theme('settings_i18n.js', TRUE)
			->set_title(lang('admin title currency'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'currencys'   	=> $currencys,
            'cancel_url' 	=> "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/currency', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
    * Save settings currencys
    */
	function update()
	{
		$base_name = $this->input->post("base_name");
		$base_code = $this->input->post("base_code");
		$extra1_check = intval($this->input->post("extra1_check"));
		$extra1_name = $this->input->post("extra1_name");
		$extra1_code = $this->input->post("extra1_code");
		$extra1_rate = abs($this->input->post("extra1_rate"));
		$extra2_check = intval($this->input->post("extra2_check"));
		$extra2_name = $this->input->post("extra2_name");
		$extra2_code = $this->input->post("extra2_code");
		$extra2_rate = abs($this->input->post("extra2_rate"));
		$extra3_check = intval($this->input->post("extra3_check"));
		$extra3_name = $this->input->post("extra3_name");
		$extra3_code = $this->input->post("extra3_code");
		$extra3_rate = abs($this->input->post("extra3_rate"));
		$extra4_check = intval($this->input->post("extra4_check"));
		$extra4_name = $this->input->post("extra4_name");
		$extra4_code = $this->input->post("extra4_code");
		$extra4_rate = abs($this->input->post("extra4_rate"));
		$extra5_check = intval($this->input->post("extra5_check"));
		$extra5_name = $this->input->post("extra5_name");
		$extra5_code = $this->input->post("extra5_code");
		$extra5_rate = abs($this->input->post("extra5_rate"));
		

		// update
		$this->currencys_model->updateCurrencys(
			array(
				"base_name" 	=> $base_name,
				"base_code" 	=> $base_code,
				"extra1_check" 	=> $extra1_check,
				"extra1_name" 	=> $extra1_name,
				"extra1_code" 	=> $extra1_code,
				"extra1_rate" 	=> $extra1_rate,
				"extra2_check" 	=> $extra2_check,
				"extra2_name" 	=> $extra2_name,
				"extra2_code" 	=> $extra2_code,
				"extra2_rate" 	=> $extra2_rate,
				"extra3_check" 	=> $extra3_check,
				"extra3_name" 	=> $extra3_name,
				"extra3_code" 	=> $extra3_code,
				"extra3_rate" 	=> $extra3_rate,
				"extra4_check" 	=> $extra4_check,
				"extra4_name" 	=> $extra4_name,
				"extra4_code" 	=> $extra4_code,
				"extra4_rate" 	=> $extra4_rate,
				"extra5_check" 	=> $extra5_check,
				"extra5_name" 	=> $extra5_name,
				"extra5_code" 	=> $extra5_code,
				"extra5_rate" 	=> $extra5_rate,
			)
		);
		
		$this->session->set_flashdata('message', lang('admin currency msg save_success'));
		redirect(site_url("admin/currency"));

	}

}