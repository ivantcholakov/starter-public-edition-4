<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fees extends Admin_Controller {

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
		$this->load->model("fees_model");
		$this->load->library('commission');
		$this->load->library('currencys');
    }


    /**
     * Fees
     */
    function index()
    {
    	// get fees
      	$fees = $this->fees_model->get_fees();

       	// setup page header data
		$this
			->set_title(lang('admin title fee'));

        $data = $this->includes;

        // set content data
        $content_data = array(
			'fees'   	 => $fees,
            'cancel_url' => "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/fees/index', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Save settings index
     */
	function update() 
	{
		$card_check = intval($this->input->post("card_check"));
		$card_fee = $this->input->post("card_fee");
		$pp_check = intval($this->input->post("pp_check"));
		$pp_fee = $this->input->post("pp_fee");
		$btc_check = intval($this->input->post("btc_check"));
		$btc_fee = $this->input->post("btc_fee");
		$adv_check = intval($this->input->post("adv_check"));
		$adv_fee = $this->input->post("adv_fee");
		$wm_check = intval($this->input->post("wm_check"));
		$wm_fee = $this->input->post("wm_fee");
		$payeer_check = intval($this->input->post("payeer_check"));
		$payeer_fee = $this->input->post("payeer_fee");
		$qiwi_check = intval($this->input->post("qiwi_check"));
		$qiwi_fee = $this->input->post("qiwi_fee");
		$perfect_check = intval($this->input->post("perfect_check"));
		$perfect_fee = $this->input->post("perfect_fee");
		$swift_check = intval($this->input->post("swift_check"));
		$swift_fee = $this->input->post("swift_fee");

		// update
		$this->fees_model->updateFees(
			array(
				"card_check" 	=> $card_check,
				"card_fee" 		=> $card_fee,
				"pp_check" 		=> $pp_check,
				"pp_fee" 		=> $pp_fee,
				"btc_check" 	=> $btc_check,
				"btc_fee" 		=> $btc_fee,
				"adv_check" 	=> $adv_check,
				"adv_fee" 		=> $adv_fee,
				"wm_check" 		=> $wm_check,
				"wm_fee" 		=> $wm_fee,
				"payeer_check" 	=> $payeer_check,
				"payeer_fee" 	=> $payeer_fee,
				"qiwi_check" 	=> $qiwi_check,
				"qiwi_fee" 		=> $qiwi_fee,
				"perfect_check" => $perfect_check,
				"perfect_fee" 	=> $perfect_fee,
				"swift_check" 	=> $swift_check,
				"swift_fee" 	=> $swift_fee,
			)
		);
		
		$this->session->set_flashdata('message', lang('admin fees success'));
		redirect(site_url("admin/fees/"));

	}
	
	/**
     * Fees deposit
     */
    function deposit()
    {
    	// get fees
      	$fees = $this->fees_model->get_fees();
			
		// ################################### Get Current Price BTC ######################################## //

		define('API_TOKEN', ''); // Access to API token. (not testing key!)

		$fields['xpub'] = $this->commission->display->xpub;
		$fields['key'] = $this->commission->display->shop_btc; // Receiver adress

		$url = 'https://api.blockchain.info/v2/receive/checkgap'; // Get a new address with a random label
		$ch = curl_init();

		$url = $url . '?' . http_build_query($fields);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response = json_decode($response, true);

		if ($httpCode == 200) {
			$limit = $response['gap'];
		} else {
			$limit = "-";
		}

		// ################################### Get Current Price BTC ####################################### //

        // setup page header data
		 $this
			->set_title(lang('admin title fee_dep'));

        $data = $this->includes;

        // set content data
        $content_data = array(
			'fees'   		=> $fees,
			'limit'    		=> $limit,
            'cancel_url' 	=> "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/fees/deposit', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Fees SCI
     */
    function sci()
    {
    	// get fees
      	$fees = $this->fees_model->get_fees();
			
		// ################################### Get Current Price BTC ######################################## //

		define('API_TOKEN', ''); // Access to API token. (not testing key!)

		$fields['xpub'] = $this->commission->display->sci_xpub;
		$fields['key'] = $this->commission->display->shop_btc_sci; // Receiver adress

		$url = 'https://api.blockchain.info/v2/receive/checkgap'; // Get a new address with a random label
		$ch = curl_init();

		$url = $url . '?' . http_build_query($fields);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response = json_decode($response, true);

		if ($httpCode == 200) {
			$limit = $response['gap'];
		} else {
			$limit = "-";
		}

		// ################################### Get Current Price BTC ####################################### //

        // setup page header data
		  $this
			->set_title(lang('admin pay manager'));

        $data = $this->includes;

        // set content data
        $content_data = array(
			'fees'   		=> $fees,
			'limit'  		=> $limit,
            'cancel_url' 	=> "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/fees/sci', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Save settings fees
     */
	function dep_update()
	{
		$check_pp_dep = intval($this->input->post("check_pp_dep"));
		$fee_pp_dep = $this->input->post("fee_pp_dep");
		$account_pp = $this->input->post("account_pp");
		$check_payeer_dep = intval($this->input->post("check_payeer_dep"));
		$fee_payeer_dep = $this->input->post("fee_payeer_dep");
		$merch_payeer = $this->input->post("merch_payeer");
		$key_payeer = $this->input->post("key_payeer");
		$crypt_payeer = $this->input->post("crypt_payeer");
		$check_adv_dep = intval($this->input->post("check_adv_dep"));
		$fee_adv_dep = $this->input->post("fee_adv_dep");
		$account_adv = $this->input->post("account_adv");
		$name_adv = $this->input->post("name_adv");
		$secret_adv = $this->input->post("secret_adv");
		$check_perfect = intval($this->input->post("check_perfect"));
		$fee_perfect = $this->input->post("fee_perfect");
		$account_perfect = $this->input->post("account_perfect");
		$key_perfect = $this->input->post("key_perfect");
		$check_btc_dep = intval($this->input->post("check_btc_dep"));
		$fee_btc_dep = $this->input->post("fee_btc_dep");
		$shop_btc = $this->input->post("shop_btc");
		$pass_btc = $this->input->post("pass_btc");
		$swift_dep_check = intval($this->input->post("swift_dep_check"));
		$fee_swift_dep = $this->input->post("fee_swift_dep");
		$swift_desc = $this->input->post("swift_desc");
		$xpub = $this->input->post("xpub");
		$fee_pp_fix_dep = $this->input->post("fee_pp_fix_dep");
		$fee_pay_fix = $this->input->post("fee_pay_fix");
		$fee_adv_fix = $this->input->post("fee_adv_fix");
		$fee_perf_fix = $this->input->post("fee_perf_fix");
		$fee_btc_fix = $this->input->post("fee_btc_fix");
		$fee_swift_fix = $this->input->post("fee_swift_fix");

		// update
		$this->fees_model->updateFees(
			array(
				"check_pp_dep" 		=> $check_pp_dep,
				"fee_pp_dep" 		=> $fee_pp_dep,
				"account_pp" 		=> $account_pp,
				"check_payeer_dep" 	=> $check_payeer_dep,
				"fee_payeer_dep" 	=> $fee_payeer_dep,
				"merch_payeer" 		=> $merch_payeer,
				"key_payeer" 		=> $key_payeer,
				"crypt_payeer" 		=> $crypt_payeer,
				"check_adv_dep" 	=> $check_adv_dep,
				"fee_adv_dep" 		=> $fee_adv_dep,
				"account_adv" 		=> $account_adv,
				"name_adv" 			=> $name_adv,
				"secret_adv" 		=> $secret_adv,
				"check_perfect" 	=> $check_perfect,
				"fee_perfect" 		=> $fee_perfect,
				"account_perfect" 	=> $account_perfect,
				"key_perfect" 		=> $key_perfect,
				"check_btc_dep" 	=> $check_btc_dep,
				"fee_btc_dep" 		=> $fee_btc_dep,
				"shop_btc" 			=> $shop_btc,
				"pass_btc" 			=> $pass_btc,
				"swift_dep_check" 	=> $swift_dep_check,
				"fee_swift_dep" 	=> $fee_swift_dep,
				"swift_desc" 		=> $swift_desc,
				"xpub" 				=> $xpub,
				"fee_pp_fix_dep" 	=> $fee_pp_fix_dep,
				"fee_pay_fix" 		=> $fee_pay_fix,
				"fee_adv_fix" 		=> $fee_adv_fix,
				"fee_perf_fix" 		=> $fee_perf_fix,
				"fee_btc_fix" 		=> $fee_btc_fix,
				"fee_swift_fix" 	=> $fee_swift_fix,
			)
		);
		
		$this->session->set_flashdata('message', lang('admin fees success'));
		redirect(site_url("admin/fees/deposit"));

	}
	
	/**
     * Save settings fees sci
     */
	function sci_update() // save settings currencys
	{
		$check_pp_sci = intval($this->input->post("check_pp_sci"));
		$fee_pp_sci = $this->input->post("fee_pp_sci");
		$account_pp_sci = $this->input->post("account_pp_sci");
		$check_payeer_sci = intval($this->input->post("check_payeer_sci"));
		$fee_payeer_sci = $this->input->post("fee_payeer_sci");
		$merch_payeer_sci = $this->input->post("merch_payeer_sci");
		$key_payeer_sci = $this->input->post("key_payeer_sci");
		$crypt_payeer_sci = $this->input->post("crypt_payeer_sci");
		$check_adv_sci = intval($this->input->post("check_adv_sci"));
		$fee_adv_sci = $this->input->post("fee_adv_sci");
		$account_adv_sci = $this->input->post("account_adv_sci");
		$name_adv_sci = $this->input->post("name_adv_sci");
		$secret_adv_sci = $this->input->post("secret_adv_sci");
		$check_perfect_sci = intval($this->input->post("check_perfect_sci"));
		$fee_perfect_sci = $this->input->post("fee_perfect_sci");
		$account_perfect_sci = $this->input->post("account_perfect_sci");
		$key_perfect_sci = $this->input->post("key_perfect_sci");
		$check_btc_sci = intval($this->input->post("check_btc_sci"));
		$fee_btc_sci = $this->input->post("fee_btc_sci");
		$shop_btc_sci = $this->input->post("shop_btc_sci");
		$pass_btc_sci = $this->input->post("pass_btc_sci");
		$swift_sci_check = intval($this->input->post("swift_sci_check"));
		$fee_swift_sci = $this->input->post("fee_swift_sci");
		$swift_desc_sci = $this->input->post("swift_desc_sci");
		$ux_check = intval($this->input->post("ux_check"));
		$fee_ux = $this->input->post("fee_ux");
		$sci_xpub = $this->input->post("sci_xpub");
		$sci_pp_fee_fix = $this->input->post("sci_pp_fee_fix");
		$sci_pay_fee_fix = $this->input->post("sci_pay_fee_fix");
		$sci_adv_fix = $this->input->post("sci_adv_fix");
		$sci_per_fee_fix = $this->input->post("sci_per_fee_fix");
		$sci_btc_fee_fix = $this->input->post("sci_btc_fee_fix");
		$sci_swift_fee_fix = $this->input->post("sci_swift_fee_fix");
		$ux_fee_fix = $this->input->post("ux_fee_fix");

		// update
		$this->fees_model->updateFees(
			array(
				"check_pp_sci" 			=> $check_pp_sci,
				"fee_pp_sci" 			=> $fee_pp_sci,
				"account_pp_sci" 		=> $account_pp_sci,
				"check_payeer_sci" 		=> $check_payeer_sci,
				"fee_payeer_sci" 		=> $fee_payeer_sci,
				"merch_payeer_sci" 		=> $merch_payeer_sci,
				"key_payeer_sci" 		=> $key_payeer_sci,
				"crypt_payeer_sci" 		=> $crypt_payeer_sci,
				"check_adv_sci" 		=> $check_adv_sci,
				"fee_adv_sci" 			=> $fee_adv_sci,
				"account_adv_sci" 		=> $account_adv_sci,
				"name_adv_sci" 			=> $name_adv_sci,
				"secret_adv_sci" 		=> $secret_adv_sci,
				"check_perfect_sci" 	=> $check_perfect_sci,
				"fee_perfect_sci" 		=> $fee_perfect_sci,
				"account_perfect_sci" 	=> $account_perfect_sci,
				"key_perfect_sci" 		=> $key_perfect_sci,
				"check_btc_sci" 		=> $check_btc_sci,
				"fee_btc_sci" 			=> $fee_btc_sci,
				"shop_btc_sci" 			=> $shop_btc_sci,
				"pass_btc_sci" 			=> $pass_btc_sci,
				"swift_sci_check" 		=> $swift_sci_check,
				"fee_swift_sci" 		=> $fee_swift_sci,
				"swift_desc_sci" 		=> $swift_desc_sci,
				"ux_check" 				=> $ux_check,
				"fee_ux" 				=> $fee_ux,
				"sci_xpub" 				=> $sci_xpub,
				"sci_pp_fee_fix" 		=> $sci_pp_fee_fix,
				"sci_pay_fee_fix" 		=> $sci_pay_fee_fix,
				"sci_adv_fix" 			=> $sci_adv_fix,
				"sci_per_fee_fix" 		=> $sci_per_fee_fix,
				"sci_btc_fee_fix" 		=> $sci_btc_fee_fix,
				"sci_swift_fee_fix" 	=> $sci_swift_fee_fix,
				"ux_fee_fix" 			=> $ux_fee_fix,
			)
		);
		
		$this->session->set_flashdata('message', lang('admin fees success'));
		redirect(site_url("admin/fees/sci"));

	}

}