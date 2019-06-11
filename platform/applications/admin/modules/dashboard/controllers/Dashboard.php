<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {
    /**
    * Constructor
    */
    function __construct()
    {
        // var_dump($this->session->userdata('logged_in')['id']); die();
        if($this->session->userdata('logged_in')['id']=='')
        {
        	redirect('/');
        }


        parent::__construct();
        // load the language files
        $this->lang->load('dashboard');
		//$this->lang->load('admin_lang');
		$this->load->model('transactions_model');
		$this->load->model('tickets_model');
		$this->load->model('users_model');
		$this->load->model('disputes_model');
		$this->load->library('currencys');
		$this->load->library('commission');
    }
    /**
    * Dashboard
    */

    function index()
    {
		$log_transaction = $this->transactions_model->get_log_transactions();
		$log_ticket = $this->tickets_model->get_log_ticket();
		$log_activy = $this->users_model->get_log_activy();
		$total_users = $this->users_model->get_total_users();
		//var_dump($total_users);die();
		$total_transactions = $this->transactions_model->get_total_transactions();
		$total_disputes = $this->disputes_model->get_total_disputes();
		if($this->commission->display->check_btc_dep) {
			// ################################### Get Current Price BTC ######################################## //
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
				$limit_dep = $response['gap'];
			} else {
				$limit_dep = "0";
			}
		}
		// ################################### Get Current Price BTC ####################################### //
		if($this->commission->display->check_btc_sci) {
		// ################################### Get Current Price BTC ######################################## //
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
				$limit_sci = $response['gap'];
			} else {
				$limit_sci = "0";
			}
		// ################################### Get Current Price BTC ####################################### //
		}
        // setup page header data
			// $this->set_title( lang('admin title admin') );
        // $data = $this->includes;
		// set content data


        $content_data = array(
			'log_transaction'  		=> $log_transaction,
			'log_activy'  	   		=> $log_activy,
			'log_ticket'  			=> $log_ticket,
			'total_users'  			=> $total_users,
			'total_transactions'  	=> $total_transactions,
			'total_disputes'  		=> $total_disputes,
			'limit_dep'  			=> $limit_dep,
			'limit_sci'  			=> $limit_sci,
        );
// var_dump($total_users); die();
        // load views
         // $this->template
         //    ->prepend_title('Administration')
         //    // ->set_partial('scripts', 'login_scripts')
         //    ->build('dashboard');
        
        $data['page_header'] = 'Administration';
		$data['content'] = $this->load->view('dashboard', $content_data, TRUE);
		//$data['content'] = $content_data;
		//$this->template = "../../{$this->settings->root_folder}/themes/{$this->settings->theme}/template.php";
       // $this->load->view('../templete', $data);
		// var_dump(FCPATH.'platform/applications/admin/modules/template'); die();
		// var_dump(base_url('themes/modular/template')); die();
         // $this->load->view(base_url('themes/modular/template'), $data);
         $this->load->view('template', $data);
    }
}