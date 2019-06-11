<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SCI extends Public_Controller {

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();
			
		require './Twilio/autoload.php';

        // load the language file
        $this->lang->load('welcome');
		// load the users model
        $this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('merchants_model');
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
		$this->lang->load('currency');
		$this->load->library('commission');
		$this->load->library('email');
		$this->load->library('currencys');
        $this->load->model('contact_model');
        // load the captcha helper
        $this->load->helper('captcha');
		$this->config->set_item('csrf_protection', FALSE);
			
		// load the users language file
        $this->lang->load('users');
    }
	
	/**
	* Form payment
    */	
	public function form()
	{
		$order = $_POST['order'];
		$merchant = $_POST['merchant'];
		$item_name = $_POST['item_name'];
		$amount = $_POST['amount'];
		$custom = $_POST['custom'];
		
		// Check username
		$detail_merchant = $this->merchants_model->get_user_merchant($merchant);
		// if empty results, return to base url
	    if ( ! $detail_merchant)
	    {
			$this->session->set_flashdata('error', lang('core error sci_merchant'));
	    	redirect($this->base_url);
	    }

		$merchant_status = $detail_merchant['status'];
		
		// Check verifi status
		if ($merchant_status > 1)
	    {
			$this->session->set_flashdata('error', lang('core error sci_no_active'));
	    	redirect($this->base_url);
	    }
		
		// if empty results, return to base url
	    if ( ! $order)
	    {
			$this->session->set_flashdata('error', lang('core error sci_order'));
	    	redirect($this->base_url);
	    } elseif (! $merchant) {
			$this->session->set_flashdata('error', lang('core error sci_merchant'));
    		redirect($this->base_url);
		} elseif (! $item_name) {
			$this->session->set_flashdata('error', lang('core error sci_item_name'));
    		redirect($this->base_url);
		} elseif (! $amount) {
			$this->session->set_flashdata('error', lang('core error sci_amount'));
    		redirect($this->base_url);
		}
		
		// create captcha image
	    $captcha = create_captcha(array(
	       'img_path'   	=> "./captcha/",
	       'img_url'    	=> base_url('/captcha') . "/",
	       'font_path'  	=> FCPATH . "themes/core/fonts/bromine/Bromine.ttf",
	       'img_width'		=> 170,
	       'img_height' 	=> 59,
	    ));

	    $captcha_data = array(
	       'captcha_time' 	=> $captcha['time'],
	       'ip_address'   	=> $this->input->ip_address(),
	       'word'	       	=> $captcha['word']
	    );
		
		// store captcha image
    	$this->transactions_model->save_captcha($captcha_data);
		
		// setup page header data
    	$this->set_title(sprintf(lang('core payment title'), $this->settings->site_name));

    	$data = $this->includes;

	    // set content data
	    $content_data = array(
			'order'          => $order,
			'merchant'       => $merchant,
			'item_name'      => $item_name,
			'amount'         => $amount,
			'custom'         => $custom,
			'captcha_image'  => $captcha['image'],
			'captcha_time'   => $captcha['time'],
	    );

    	// load views
    	$data['content'] = $this->load->view('payment/payment', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Success payment
    */
	function success()
	{
        // setup page header data
        $this->set_title(sprintf(lang('core payment status'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user
        );

        // load views
        $data['content'] = $this->load->view('payment/success', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Fail payment
    */
	function fail()
	{
        // setup page header data
        $this->set_title(sprintf(lang('core payment status'), $this->settings->site_name));
		// reload the new user data and store in session
        $user = $this->users_model->get_user($this->user['id']);
				
        $data = $this->includes;

        // set content data
        $content_data = array(
			'user'    => $user,
        );

        // load views
        $data['content'] = $this->load->view('payment/fail', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	/**
	* Form payment BTC
    */
	function start_blockchain()
	{
		
		$order = $_POST['order'];
    	$merchant = $_POST['merchant'];
    	$amount = $_POST['amount'];
    	$custom = $_POST['custom'];
		
		// if empty results, return to base url
	    if ( ! $order)
	    {
	      $this->session->set_flashdata('error', lang('core error sci_order'));
	      redirect($this->base_url);
	    } elseif (! $merchant) {
	      $this->session->set_flashdata('error', lang('core error sci_merchant'));
	      redirect($this->base_url);
	    } elseif (! $amount) {
	      $this->session->set_flashdata('error', lang('core error sci_amount'));
	      redirect($this->base_url);
	    } elseif (! $custom) {
	      $this->session->set_flashdata('error', "Email");
	      redirect($this->base_url);
	    }
		
		// Check username
    	$detail_merchant = $this->merchants_model->get_user_merchant($merchant);
		
		// Generation BTC adress //

    	$secret = $this->commission->display->pass_btc_sci;

    	$my_xpub = $this->commission->display->sci_xpub;
	    $my_api_key = $this->commission->display->shop_btc_sci;

    	$my_callback_url = ''.base_url().'SCI/sci_blockchain?secret='.$secret;

    	$root_url = 'https://api.blockchain.info/v2/receive';

    	$parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key;

    	$response = file_get_contents($root_url . '?' . $parameters);

    	$object = json_decode($response);
                
    	$forwarding_address = $object->address;
        
    	// Generation BTC adress //
		
		$percent = $this->commission->display->fee_btc_sci/"100";
		$fee_percent = $amount*$percent;
	  	$fee = $fee_percent+$this->commission->display->sci_btc_fee_fix;
		$sum = $amount-$fee;
		
		if ($forwarding_address != null) {
			
			$transactions = $this->transactions_model->add_transaction(array(
				"type"          => "5",
				"sum"           => $sum,
				"fee"           => $fee,
				"amount"        => $amount,
				"currency"      => 'debit_base',
				"status"        => "1",
				"sender"        => "Bitcoin",
				"receiver"      => $detail_merchant['user'],
				"time"          => date('Y-m-d H:i:s'),
				"user_comment"  => $forwarding_address,
				"admin_comment" => "none"
				)
			);
			
			$btc_order = $this->transactions_model->add_order(array(
		        "adress"        => $forwarding_address,
		        "amount"        => $amount,
		        "date"          => date('Y-m-d H:i:s'),
		        "merchant"      => $merchant,
				"amount"      	=> $amount,
		        "payeer"        => $custom, // email payeer
		        )
		    );
			
		// ################################### Get Current Price BTC ######################################## //

			define('API_TOKEN', ''); // Access to API token. (not testing key!)

			$fields['currency'] = $this->currencys->display->base_code;
			$fields['value'] = $amount; // Receiver adress

			$url = 'https://blockchain.info/tobtc'; // Get a new address with a random label
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
				$rate = $response;
			} else {
				$rate = "undefined";
			}

			// ################################### Get Current Price BTC ####################################### //
			
			// Sending payeer email

			$email_template = $this->emailtemplate_model->get_email_template(27);

			// variables to replace
			$site_name = $this->settings->site_name;

			$rawstring = $email_template['message'];

			 // what will we replace
			$placeholders = array('[SITE_NAME]', '[SUM_USD]', '[CYR]', '[SUM_BTC]', '[ADRESS]');
			
			$vals_1 = array($site_name, $amount, $this->currencys->display->base_code, $rate, $forwarding_address);

			// replace
			$str_1 = str_replace($placeholders, $vals_1, $rawstring);

			$this -> email -> from($this->settings->site_email, $this->settings->site_name);
			$this->email->to(
				array($custom)
			);

			$this -> email -> subject($email_template['title']);

			$this -> email -> message($str_1);

			$this->email->send();
			
			$url_btc = site_url('SCI/btc_payment/'.$forwarding_address.'');
      		redirect($url_btc);
			
		} else {
			
      		redirect(site_url("SCI/fail"));
			
		}
		
	}
	
	/**
	* Make payment
    */
	function btc_payment($adress = NULL)
	{
    	// setup page header data
    	$this->set_title(sprintf(lang('core payment status'), $this->settings->site_name));
		// reload the new user data and store in session
		
		// make sure we have a numeric id
	    if (is_null($adress))
	    {
	     redirect($this->_redirect_url);
	    }
		
		// get the data
    	$btc_order = $this->transactions_model->get_detail_btc_order($adress);
		
		// if empty results, return to list
	    if ( ! $btc_order)
	    {
	      redirect($this->_redirect_url);
	    }
		
		// ################################### Get Current Price BTC ######################################## //

		define('API_TOKEN', ''); // Access to API token. (not testing key!)

		$fields['currency'] = $this->currencys->display->base_code;
		$fields['value'] = $btc_order['amount']; // Receiver adress

		$url = 'https://blockchain.info/tobtc'; // Get a new address with a random label
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
			$rate = $response;
		} else {
			$rate = "undefined";
		}

		// ################################### Get Current Price BTC ####################################### //
		
		// get the data
	    $sci_transaction = $this->transactions_model->get_adress($adress);
			
	    $data = $this->includes;

	    // set content data
	    $content_data = array(
			'btc_order'         => $btc_order,
	      	'btc_order_id'      => $adress,
			'rate'              => $rate,
			'sci_transaction'   => $sci_transaction,
	    );

    	// load views
    	$data['content'] = $this->load->view('payment/btc_payment', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}
	
	
	/**
    * Blockchain monitoring
    */
	
	function sci_blockchain()
	{
		$transaction_hash = $_GET['transaction_hash'];
		$value_in_satoshi = $_GET['value'];
		$value_in_btc = $value_in_satoshi / 100000000;
		$address = $_GET['address'];
		// Check BTC order
		$block_transaction = $this->transactions_model->get_chain_sci($address);
		// Check transaction merchant
		$merchant_transaction = $this->transactions_model->get_chain($address);
		$date = $merchant_transaction['time'];
		
		// Check merchant
    	$detail_merchant = $this->merchants_model->get_user_merchant($block_transaction['merchant']);
		
		// Check user
		$users = $this->users_model->get_user_transfer($detail_merchant['user']);
		
		if ($_GET['secret'] == $this->commission->display->pass_btc_sci) {
			
			// ################################### Get Current Price BTC ######################################## //

			define('API_TOKEN', ''); // Access to API token. (not testing key!)

			$fields['currency'] = $this->currencys->display->base_code;
			$fields['value'] = "1"; // Receiver adress

			$url = 'https://blockchain.info/tobtc'; // Get a new address with a random label
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
				$rate = $response;
				$amount = $value_in_btc/$rate;

				$percent = $this->commission->display->fee_btc_sci/"100";
				$fee_percent = $amount*$percent;
	  			$fee = $fee_percent+$this->commission->display->sci_btc_fee_fix;
				$sum = $amount-$fee;
				
				if ($_GET['confirmations'] >= 6) {
					
					$badge_sci = uniqid("sci_");

					// update transaction history
					$this->transactions_model->update_btc_transactions($merchant_transaction['id'],
						array(
							"status"   		 => "2",
							"admin_comment"  => $badge_sci,
							"amount"         => $amount,
							"sum"  			 => $sum,
						)
					);
					
					$id_ipn = $this->transactions_model->get_detail_sci_transactions($badge_sci);

					$total = $users['debit_base']+$sum;

					// update wallet
					$this->users_model->update_wallet_transfer($users['username'],
						array(
							"debit_base" => $total,
						)
					);
				
					// Sending email

					$email_template = $this->emailtemplate_model->get_email_template(2);

					// variables to replace
					$link = site_url('account/history/');
					$site_name = $this->settings->site_name;
					$mail_sum = round($sum, 2);

					$rawstring = $email_template['message'];

					 // what will we replace
					$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]');

					$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($users['email'])
					);

					$this -> email -> subject($email_template['title']);

					$this -> email -> message($str_1);

					$this->email->send();

					$sms_template = $this->smstemplate_model->get_sms_template(12);

					if($sms_template['enable']) {

						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[SUM]', '[CYR]');

						$vals_1 = array($mail_sum, $this->currencys->display->base_code);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						// Twilio user number
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
								'body' => $str_1
							)
						);

					}
				
					// IPN for user
	
					$merchant_password = $detail_merchant['password'];
					$merchant_name = $detail_merchant['name'];
					$merchant_ipn = $detail_merchant['status_link'];
					$id = $id_ipn['id'];

					$hash_string2=
						 $id_ipn['amount'].':'
						.$merchant_password.':'
						.$date.':'
						.$id;

					$hash2=strtoupper(md5($hash_string2));

					// Send POST request

					$url = $merchant_ipn;  

					$post_data = array (  
						"amount" 		=> $id_ipn['amount'],
						"fee" 			=> $id_ipn['fee'],   
						"method" 				=> "Bitcoin",
						"merchant_name" 		=> $merchant_name,
						"status" 				=> "Confirmed",
						"date" 					=> $date,
						"id_transfer" 			=> $id,
						"ballance" 				=> $total,
						"custom" 				=> "none",
						"hash" 					=> $hash2
					); 

					$ch = curl_init();  

					curl_setopt($ch, CURLOPT_URL, $url);  

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

					curl_setopt($ch, CURLOPT_POST, 1);  

					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

					$output = curl_exec($ch);  

					curl_close($ch);  

					echo $output;
					
				echo "*ok*";

				}
				

			} else {

				$rate = "undefined";
				// update transaction history
				$this->transactions_model->update_btc_transactions($merchant_transaction['id'],
					array(
						"status"   		 => "5",
						"admin_comment"  => $transaction_hash,
					)
				);
			}
			
		// Delete btc order from base
		$this->transactions_model->delete_order($address);
			
		} else {
			
			echo "*ok*";
			
		}
		
	}
	
	
	/**
    * ADV cash form start
    */
	
	function form_advcash()
	{
		$order = $_POST['order'];
		$merchant = $_POST['merchant'];
		$amount = $_POST['amount'];
		$custom = $_POST['custom'];
		
		// if empty results, return to base url
		if ( ! $order)
		{
			$this->session->set_flashdata('error', lang('core error sci_order'));
			redirect($this->base_url);
		} elseif (! $merchant) {
			$this->session->set_flashdata('error', lang('core error sci_merchant'));
			redirect($this->base_url);
		} elseif (! $amount) {
			$this->session->set_flashdata('error', lang('core error sci_amount'));
			redirect($this->base_url);
		}
		
		// Check username
		$detail_merchant = $this->merchants_model->get_user_merchant($merchant);
				
		$ac_account_email = $this->commission->display->account_adv_sci;
		$ac_sci_name = $this->commission->display->name_adv_sci;
		$ac_amount = $amount;
		$ac_currency = $this->currencys->display->base_code;
		$secret = $this->commission->display->secret_adv_sci;
		$ac_order_id = $order;

		$arHash = array(
			$ac_account_email,
			$ac_sci_name,
			$ac_amount,
			$ac_currency,
			$secret,
			$ac_order_id
		);
				


		$ac_sign = strtoupper(hash('sha256', implode(':', $arHash)));
				
				
		$GET_params = 'ac_account_email='.$ac_account_email.'&';
		$GET_params .= 'ac_sci_name='.$ac_sci_name.'&';
		$GET_params .= 'ac_amount='.$ac_amount.'&';
		$GET_params .= 'ac_currency='.$ac_currency.'&';
		$GET_params .= 'ac_order_id='.$ac_order_id.'&';
		$GET_params .= 'ac_comments='.$merchant.'&';
		$GET_params .= 'ac_sign='.$ac_sign.'';
				
		$url = "https://wallet.advcash.com/sci/?".$GET_params ." ";
		redirect("$url");
				
	}

 	/**
	*ADV Cash
    */	
	public function sci_advcash()
	{
		
		$secret=$this->commission->display->secret_adv_sci;
	
		$hash_string=$_POST['ac_transfer'].':'
			.$_POST['ac_start_date'].':'
			.$_POST['ac_sci_name'].':'
			.$_POST['ac_src_wallet'].':'
			.$_POST['ac_dest_wallet'].':'
			.$_POST['ac_order_id'].':'
			.$_POST['ac_amount'].':'
			.$_POST['ac_merchant_currency'].':'
			.$secret;

		$sha256 = hash('sha256', $hash_string);

		if($sha256==$_POST['ac_hash']){

			$amount = $_POST['ac_amount'];
			$id_transfer = $_POST['ac_transfer'];
			$id_merchant = $_POST['ac_comments'];
				
			// Check username
			$detail_merchant = $this->merchants_model->get_user_merchant($id_merchant);
			$user = $detail_merchant['user'];
			
			$percent = $this->commission->display->fee_adv_sci/"100";
			$fee_percent = $amount*$percent;
	  	$fee = $fee_percent+$this->commission->display->fee_adv_sci;
			$sum = $amount-$fee;

			$date = date('Y-m-d H:i:s');
			
			$badge_sci = uniqid("sci_");

			$transactions = $this->transactions_model->add_transaction(array(
				"type" 			=> "5",
				"sum"  			=> $sum,
				"fee"    		=> $fee,
				"amount" 		=> $amount,
				"currency"		=> 'debit_base',
				"status" 		=> "2",
				"sender" 		=> "ADV Cash",
				"receiver" 		=> $user,
				"time"          => $date,
				"user_comment"  => $_POST['ac_order_id'],
				"admin_comment" => $badge_sci,
				)
			);
			
			$id_ipn = $this->transactions_model->get_detail_sci_transactions($badge_sci);

			$users = $this->users_model->get_user_transfer($user);

			$total = $users['debit_base']+$sum;

			// update wallet
			$this->users_model->update_wallet_transfer($user,
				array(
					"debit_base" => $total,
				)
			);
			
			// Sending email

			$email_template = $this->emailtemplate_model->get_email_template(2);

			// variables to replace
			$link = site_url('account/history/');
			$site_name = $this->settings->site_name;
			$mail_sum = round($sum, 2);

			$rawstring = $email_template['message'];

			 // what will we replace
			$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]');

			$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link);

			//replace
			$str_1 = str_replace($placeholders, $vals_1, $rawstring);

			$this -> email -> from($this->settings->site_email, $this->settings->site_name);
			$this->email->to(
				array($user['email'])
			);

			$this -> email -> subject($email_template['title']);

			$this -> email -> message($str_1);

			$this->email->send();
			
			$sms_template = $this->smstemplate_model->get_sms_template(12);
								
			if($sms_template['enable']) {
									
				$rawstring = $sms_template['message'];

				// what will we replace
				$placeholders = array('[SUM]', '[CYR]');

				$vals_1 = array($mail_sum, $this->currencys->display->base_code);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);
									
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
						'body' => $str_1
					)
				);

			}
			
			// IPN for user
		
			$merchant_password = $detail_merchant['password'];
			$merchant_name = $detail_merchant['name'];
			$merchant_ipn = $detail_merchant['status_link'];
			$custom = $_POST['custom'];
			$id = $id;
		
			$hash_string2=
				$id_ipn['amount'].':'
				.$merchant_password.':'
				.$date.':'
				.$id;
			
			$hash2=strtoupper(md5($hash_string2));
			
			// Send POST request
			
			$url = $merchant_ipn;  

			$post_data = array (  
				"amount" 		=> $id_ipn['amount'],
				"fee" 			=> $id_ipn['fee'],    
				"method" 				=> "ADV Cash",
				"merchant_name" 		=> $merchant_name,
				"status" 				=> "Confirmed",
				"date" 					=> $date,
				"id_transfer" 			=> $id,
				"ballance" 				=> $total,
				"custom" 				=> $custom,
				"hash" 					=> $hash2
			); 


			$ch = curl_init();  

			curl_setopt($ch, CURLOPT_URL, $url);  

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
			
			curl_setopt($ch, CURLOPT_POST, 1);  
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

			$output = curl_exec($ch);  
			
			curl_close($ch);  

			echo $output; 
			
		}else{

		}

	}
	
	/**
    * Payeer form start
    */
	
	function form_payeer()
	{
		$order = $_POST['order'];
		$merchant = $_POST['merchant'];
		$amount = $_POST['amount'];
		$custom = $_POST['custom'];
		
		// if empty results, return to base url
		if ( ! $order)
		{
			$this->session->set_flashdata('error', lang('core error sci_order'));
			redirect($this->base_url);
		} elseif (! $merchant) {
			$this->session->set_flashdata('error', lang('core error sci_merchant'));
			redirect($this->base_url);
		} elseif (! $amount) {
			$this->session->set_flashdata('error', lang('core error sci_amount'));
			redirect($this->base_url);
		}
		
		// Check username
		$detail_merchant = $this->merchants_model->get_user_merchant($merchant);
				
		$m_shop = $this->commission->display->merch_payeer_sci;
		$m_orderid = $order;
		$m_amount = number_format($amount, 2, '.', '');
		$m_curr = $this->currencys->display->base_code;
		$m_desc = base64_encode($detail_merchant['user']);
		$m_key = $this->commission->display->key_payeer_sci;

		$arHash = array(
			$m_shop,
			$m_orderid,
			$m_amount,
			$m_curr,
			$m_desc
		);
				

		$arHash[] = $m_key;

		$sign = strtoupper(hash('sha256', implode(':', $arHash)));
				
		$GET_params = 'm_shop='.$m_shop.'&';
		$GET_params .= 'm_orderid='.$m_orderid.'&';
		$GET_params .= 'm_amount='.$m_amount.'&';
		$GET_params .= 'm_curr='.$m_curr.'&';
		$GET_params .= 'm_desc='.$m_desc.'&';
		$GET_params .= 'm_sign='.$sign.'';
				
		$url = "https://payeer.com/merchant/?".$GET_params ." ";
		redirect("$url");
			
	}
	
	/**
	* SCI Payeer
    */
	public function sci_payeer()
	{
		
		if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

			if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
			{
				$m_key = $this->commission->display->key_payeer_sci;

				$arHash = array(
					$_POST['m_operation_id'],
					$_POST['m_operation_ps'],
					$_POST['m_operation_date'],
					$_POST['m_operation_pay_date'],
					$_POST['m_shop'],
					$_POST['m_orderid'],
					$_POST['m_amount'],
					$_POST['m_curr'],
					$_POST['m_desc'],
					$_POST['m_status']
				);

				if (isset($_POST['m_params']))
				{
					$arHash[] = $_POST['m_params'];
				}

				$arHash[] = $m_key;

				$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
			
				$amount =  $_POST['m_amount'];
				$user = base64_decode($_POST['m_desc']);
				
				$percent = $this->commission->display->fee_payeer_sci/"100";
				$fee_percent = $amount*$percent;
		  		$fee = $fee_percent+$this->commission->display->sci_pay_fee_fix;
				$sum = $amount-$fee;
			
				$date = date('Y-m-d H:i:s');
			
				// Check username
				$detail_merchant = $this->merchants_model->get_user_merchant_user($user);

				if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
				{
					$badge_sci = uniqid("sci_");
					
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "5",
						"sum"  				=> $sum,
						"fee"    			=> $fee,
						"amount" 			=> $amount,
						"currency"			=> 'debit_base',
						"status" 			=> "2",
						"sender" 			=> "Payeer",
						"receiver" 			=> $user,
						"time"          	=> $date,
						"user_comment"  	=> "none",
						"admin_comment" 	=> $badge_sci,
						)
					);
					
					$id_ipn = $this->transactions_model->get_detail_sci_transactions($badge_sci);
				
					$users = $this->users_model->get_user_transfer($user);
				
					$total = $users['debit_base']+$sum;
				
					// update wallet
					$this->users_model->update_wallet_transfer($user,
						array(
							"debit_base" => $total,
						)
					);
				
					// Sending email

					$email_template = $this->emailtemplate_model->get_email_template(2);

					// variables to replace
					$link = site_url('account/history/');
					$site_name = $this->settings->site_name;
					$mail_sum = round($sum, 2);

					$rawstring = $email_template['message'];

					 // what will we replace
					$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]');

					$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($users['email'])
					);

					$this -> email -> subject($email_template['title']);

					$this -> email -> message($str_1);

					$this->email->send();

					$sms_template = $this->smstemplate_model->get_sms_template(12);

					if($sms_template['enable']) {

						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[SUM]', '[CYR]');

						$vals_1 = array($mail_sum, $this->currencys->display->base_code);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						// Twilio user number
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
								'body' => $str_1
							)
						);

					}
				
					// IPN for user
	
					$merchant_password = $detail_merchant['password'];
					$merchant_name = $detail_merchant['name'];
					$merchant_ipn = $detail_merchant['status_link'];
					$id = $id_ipn['id'];

					$hash_string2=
						$id_ipn['amount'].':'
						.$merchant_password.':'
						.$date.':'
						.$id;

					$hash2=strtoupper(md5($hash_string2));

					// Send POST request

					$url = $merchant_ipn;  

					$post_data = array (  
						"amount" 		=> $id_ipn['amount'],
						"fee" 			=> $id_ipn['fee'],   
						"method" 		=> "Payeer",
						"merchant_name" => $merchant_name,
						"status" 		=> "Confirmed",
						"date" 			=> $date,
						"id_transfer" 	=> $id,
						"ballance" 		=> $total,
						"custom"		=> "none",
						"hash" 			=> $hash2
					); 


					$ch = curl_init();  

					curl_setopt($ch, CURLOPT_URL, $url);  

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

					curl_setopt($ch, CURLOPT_POST, 1);  

					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

					$output = curl_exec($ch);  

					curl_close($ch);  

					echo $output;
				
					echo $_POST['m_orderid'].'|success';
			
				}
				else 
				{
    			echo $_POST['m_orderid'].'|error';
			}
		}
	}
	
	/**
	*SCI Perfect money
    */	
	public function sci_perfect() 
	{
		$alternate=strtoupper(md5($this->commission->display->key_perfect_sci));
	
		$hash_string=
			$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
		    $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
		    $_POST['PAYMENT_BATCH_NUM'].':'.
		    $_POST['PAYER_ACCOUNT'].':'.$alternate.':'.
		    $_POST['TIMESTAMPGMT'];
	
		$hash=strtoupper(md5($hash_string));
	
		$id_merchant = $_POST['PAYMENT_ID'];
	
		// Check username
		$detail_merchant = $this->merchants_model->get_user_merchant($id_merchant);
		$user = $detail_merchant['user'];

		if($hash==$_POST['V2_HASH']){
		
			if($_POST['PAYMENT_UNITS']==$this->currencys->display->base_code){

    			$users = $this->users_model->get_user($detail_merchant['user']);
				$amount = $_POST['PAYMENT_AMOUNT'];
			
				$percent = $this->commission->display->fee_perfect_sci/"100";
				$fee_percent = $amount*$percent;
			  	$fee = $fee_percent+$this->commission->display->sci_per_fee_fix;
				$sum = $amount-$fee;
			
				$date = date('Y-m-d H:i:s');
				
				$badge_sci = uniqid("sci_");
		
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "5",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $_POST['PAYMENT_AMOUNT'],
					"currency"			=> 'debit_base',
					"status" 			=> "2",
					"sender" 			=> "Perfect Money",
					"receiver" 			=> $user,
					"time"          	=> $date,
					"user_comment"  	=> 'Perfect Money ID '. $_POST['PAYMENT_BATCH_NUM'].'',
					"admin_comment" 	=> $badge_sci,
					)
				);
				
				$total = $users['debit_base']+$sum;

				// update wallet
				$this->users_model->update_wallet_transfer($user,
					array(
						"debit_base" => $total,
					)
				);
			
				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(2);

				// variables to replace
				$link = site_url('account/history/');
				$site_name = $this->settings->site_name;
				$mail_sum = round($sum, 2);

				$rawstring = $email_template['message'];

				 // what will we replace
				$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]');

				$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($users['email'])
				);

				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();
				
				$sms_template = $this->smstemplate_model->get_sms_template(12);
								
				if($sms_template['enable']) {
										
					$rawstring = $sms_template['message'];

					// what will we replace
					$placeholders = array('[SUM]', '[CYR]');

					$vals_1 = array($mail_sum, $this->currencys->display->base_code);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);
										
					// Twilio user number
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
							'body' => $str_1
						)
					);

				}
			
				// IPN for user
	
				$merchant_password = $detail_merchant['password'];
				$merchant_name = $detail_merchant['name'];
				$merchant_ipn = $detail_merchant['status_link'];
				$id = $id_ipn['id'];

				$hash_string2=
					$id_ipn['amount'].':'
					.$merchant_password.':'
					.$date.':'
					.$id;

					$hash2=strtoupper(md5($hash_string2));

					// Send POST request

					$url = $merchant_ipn;  

					$post_data = array (  
						"amount" 		=> $id_ipn['amount'],
						"fee" 			=> $id_ipn['fee'],   
						"method" 		=> "Perfect Money",
						"merchant_name" => $merchant_name,
						"status" 		=> "Confirmed",
						"date" 			=> $date,
						"id_transfer" 	=> $id,
						"ballance" 		=> $total,
						"custom" 		=> "none",
						"hash" 			=> $hash2
					); 


					$ch = curl_init();  

					curl_setopt($ch, CURLOPT_URL, $url);  

					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

					curl_setopt($ch, CURLOPT_POST, 1);  

					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

					$output = curl_exec($ch);  

					curl_close($ch);  

					echo $output;
			

   			}else{ // you can also save invalid payments for debug purposes

   			}
		
		}else{
		//NO
		}
	}
	
	/**
	* SCI PayPal new
    */
	public function sci_paypal() 
	{
		// STEP 1: read POST data
		// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
		// Instead, read raw POST data from the input stream.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}

		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$req = 'cmd=_notify-validate';
		if (function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}

		// Step 2: POST IPN data back to PayPal to validate
		$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		// In wamp-like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
		// the directory path of the certificate as shown below:
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if ( !($res = curl_exec($ch)) ) {
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			exit;
		}
		curl_close($ch);
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		// inspect IPN validation result and act accordingly
		if (strcmp ($res, "VERIFIED") == 0) {
			// The IPN is verified, process it:
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process the notification
			// assign posted variables to local variables
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
			$custom = $_POST['custom'];
			// IPN message values depend upon the type of notification sent.
			// To loop through the &_POST array and print the NV pairs to the screen:
			
			// Check username
			$detail_merchant = $this->merchants_model->get_user_merchant($custom);

			$user = $detail_merchant['user'];
			
			$percent = $this->commission->display->fee_pp_sci/"100";
			$fee_percent = $amount*$percent;
	  		$fee = $fee_percent+$this->commission->display->sci_pp_fee_fix;
			$sum = $amount-$fee;
			$id = $txn_id;
			
			$date = date('Y-m-d H:i:s');
			
			if($payment_currency = $this->currencys->display->base_code) {
				
				$badge_sci = uniqid("sci_");
			
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "5",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $amount,
					"currency"			=> 'debit_base',
					"status" 			=> "2",
					"sender" 			=> "PayPal",
					"receiver" 			=> $user,
					"time"          	=> $date,
					"user_comment" 		=> 'PayPal # '.$id.'',
					"admin_comment" 	=> $badge_sci
					)
				);
				
				$id_ipn = $this->transactions_model->get_detail_sci_transactions($badge_sci);

				$users = $this->users_model->get_user_transfer($user);

				$total = $users['debit_base']+$sum;

				// update wallet
				$this->users_model->update_wallet_transfer($user,
					array(
						"debit_base" => $total,
					)
				);

				// Sending email

				$email_template = $this->emailtemplate_model->get_email_template(2);

				// variables to replace
				$link = site_url('account/history/');
				$site_name = $this->settings->site_name;
				$mail_sum = round($sum, 2);

				$rawstring = $email_template['message'];

				 // what will we replace
				$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]');

				$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to(
					array($users['email'])
				);

				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();

				$sms_template = $this->smstemplate_model->get_sms_template(12);

				if($sms_template['enable']) {

					$rawstring = $sms_template['message'];

					// what will we replace
					$placeholders = array('[SUM]', '[CYR]');

					$vals_1 = array($mail_sum, $this->currencys->display->base_code);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					// Twilio user number
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
							'body' => $str_1
						)
					);

				}

				// IPN for user

				$merchant_password = $detail_merchant['password'];
				$merchant_name = $detail_merchant['name'];
				$merchant_ipn = $detail_merchant['status_link'];
				$id = $id_ipn['id'];

				$hash_string2=
					$id_ipn['amount'].':'
					.$merchant_password.':'
					.$date.':'
					.$id;

				$hash2=strtoupper(md5($hash_string2));

				// Send POST request

				$url = $merchant_ipn;  

				$post_data = array (  
					"amount" 		=> $id_ipn['amount'],
					"fee" 			=> $id_ipn['fee'],    
					"method" 		=> "PayPal",
					"merchant_name" => $merchant_name,
					"status" 		=> "Confirmed",
					"date" 			=> $date,
					"id_transfer" 	=> $id,
					"ballance" 		=> $total,
					"custom" 		=> $custom,
					"hash" 			=> $hash2
				); 


			$ch = curl_init();  

			curl_setopt($ch, CURLOPT_URL, $url);  

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

			curl_setopt($ch, CURLOPT_POST, 1);  

			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

			$output = curl_exec($ch);  

			curl_close($ch);  

			echo $output;
				
			} else {
				
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "5",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $amount,
					"currency"			=> 'debit_base',
					"status" 			=> "5",
					"sender" 			=> "PayPal",
					"receiver" 			=> $user,
					"time"          	=> $date,
					"user_comment"  	=> 'PayPal # '.$id.'',
					"admin_comment" 	=> 'Other currency'
					)
				);
				
			}
			
		foreach($_POST as $key => $value) {
			echo $key . " = " . $value . "<br>";
		}

		} else if (strcmp ($res, "INVALID") == 0) {
			// IPN invalid, log for manual investigation
			echo "The response from IPN was: <b>" .$res ."</b>";
		}
		
	}
	

 	/**
    * Just Wallet
    */
    function ux_pay()
    {
		//if (!in_array($_SERVER['SERVER_ADDR'], array('93.170.130.254'))) return;
			
		// Check username ID merchant
		$detail_merchant = $this->merchants_model->get_user_merchant($this->input->post("merchant"));
		$merchant = $detail_merchant['user'];
			
		// Check fraud 
		if ($merchant>0) {
					
			$this->session->set_flashdata('error', lang('users error fraud'));
        	redirect(site_url("SCI/fail"));
					
        }
			
		elseif ($merchant==0) {
			
        	// set form validation rules
        	$this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
			$this->form_validation->set_rules('captcha', lang('users input password'), 'required|trim|callback__check_captcha');
        	$this->form_validation->set_rules('username', lang('users input username_email'), 'required|trim|max_length[256]');
        	$this->form_validation->set_rules('password', lang('users input password'), 'required|trim|max_length[72]|callback__check_users');

	        if ($this->form_validation->run() == TRUE)
	        {
					
				$date = date('Y-m-d H:i:s');
								
				$amount = $this->input->post("amount");
							
				$percent = $this->commission->display->fee_ux/"100";
				$fee_percent = $amount*$percent;
	  			$fee = $fee_percent+$this->commission->display->ux_fee_fix;
				$sum = $amount-$fee;
					
				$login = $this->users_model->login($this->input->post('username', TRUE), $this->input->post('password', TRUE));
					
				$this->session->set_userdata('logged_in', $login);
					
				if ($login['username'] != $merchant & $login['debit_base'] >= $sum)
          		{
					
					$badge_sci = uniqid("sci_");
						
					// Add transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "5",
						"sum"  				=> $sum,
						"fee"    			=> $fee,
						"amount" 			=> $amount,
						 "currency"			=> 'debit_base',
						"status" 			=> "2",
						"sender" 			=> $login['username'],
						"receiver" 			=> $merchant,
						"time"          	=> $date,
						"user_comment"  	=> "none",
						"admin_comment" 	=> $badge_sci,
						)
					);

					$id_ipn = $this->transactions_model->get_detail_sci_transactions($badge_sci);
						
					$users = $this->users_model->get_user_transfer($merchant);
							
					$total = $users['debit_base']+$sum;

					// update wallet merchant
					$this->users_model->update_wallet_transfer($merchant,
						array(
							"debit_base" => $total,
						)
					);
						
					$total2 = $login['debit_base']-$amount;
							
					// update wallet payer
					$this->users_model->update_wallet_transfer($login['username'],
						array(
							"debit_base" => $total2,
						)
					);
						
					// Sending email

					$email_template = $this->emailtemplate_model->get_email_template(2);

					// variables to replace
					$link = site_url('account/history/');
					$site_name = $this->settings->site_name;
					$mail_sum = round($sum, 2);

					$rawstring = $email_template['message'];

					// what will we replace
					$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]');

					$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($users['email'])
					);

					$this -> email -> subject($email_template['title']);

					$this -> email -> message($str_1);

					$this->email->send();
						
					// Send payeer email
							
					$email_template2 = $this->emailtemplate_model->get_email_template(22);

					// variables to replace
					$link = site_url('account/history/');
					$site_name = $this->settings->site_name;
					$mail_sum = round($sum, 2);

					$rawstring = $email_template2['message'];

					// what will we replace
					$placeholders = array('[SITE_NAME]', '[SUM]', '[CYR]', '[URL_HISTORY]', '[RECEIVER]');

					$vals_1 = array($site_name, $mail_sum, $this->currencys->display->base_code, $link, $merchant);

					//replace
					$str_1 = str_replace($placeholders, $vals_1, $rawstring);

					$this -> email -> from($this->settings->site_email, $this->settings->site_name);
					$this->email->to(
						array($users['email'], $login['email'])
					);

					$this -> email -> subject($email_template2['title']);

					$this -> email -> message($str_1);

					$this->email->send();
						
					$sms_template = $this->smstemplate_model->get_sms_template(12);

					if($sms_template['enable']) {

						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[SUM]', '[CYR]');

						$vals_1 = array($mail_sum, $this->currencys->display->base_code);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						// Twilio user number
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
								'body' => $str_1
							)
						);

					}
						
					// IPN for user
	
					$merchant_password = $detail_merchant['password'];
					$merchant_name = $detail_merchant['name'];
					$merchant_ipn = $detail_merchant['status_link'];
					$id = $id_ipn['id'];

					$hash_string2=
						$id_ipn['amount'].':'
						.$merchant_password.':'
						.$date.':'
						.$id;

						$hash2=strtoupper(md5($hash_string2));

						// Send POST request

						$url = $merchant_ipn;  

						$post_data = array (  
							"amount" 		=> $id_ipn['amount'],
							"fee" 			=> $id_ipn['fee'],  
							"method" 		=> "Wallet transfer",
							"merchant_name" => $merchant_name,
							"status" 		=> "Confirmed",
							"date" 			=> $date,
							"id_transfer" 	=> $id,
							"ballance" 		=> $total,
							"custom"		=> "none",
							"hash" 			=> $hash2
						); 


						$ch = curl_init();  

						curl_setopt($ch, CURLOPT_URL, $url);  

						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

						curl_setopt($ch, CURLOPT_POST, 1);  

						curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);  

						$output = curl_exec($ch);  

						curl_close($ch);  

						echo $output;
							

					} else {
						
						redirect(site_url("SCI/fail"));
						
					}
					
				redirect(site_url("SCI/success"));
            
        	} else {
					
				// setup page header data
				$this->set_title(lang('users title login'));

				$this->add_css_theme('login.css');

				redirect(site_url("SCI/fail"));

			}

		}
    }
	
	 /**
     * Verify the login credentials
     *
     * @param  string $password
     * @return boolean
     */
    function _check_users($password)
    {
        // limit number of login attempts
        $ok_to_login = $this->users_model->login_attempts();

        if ($ok_to_login)
        {
            $login = $this->users_model->login($this->input->post('username', TRUE), $password);

            if ($login)
            {
                // $this->session->set_userdata('logged_in', $login);
                return TRUE;
            }

            $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
            return FALSE;
        }

        $this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        return FALSE;
    }
	
	/**
     * Verifies correct CAPTCHA value
     *
     * @param  string $captcha
     * @return string|boolean
     */
    function _check_captcha($captcha)
    {
        $verified = $this->transactions_model->verify_captcha($captcha);

        if ($verified == FALSE)
        {
            $this->form_validation->set_message('_check_captcha', lang('contact error captcha'));
            return FALSE;
        }
        else
        {
			// Delete captcha code from base
			$this->transactions_model->delete_captcha($captcha);
            return $captcha;
        }
    }
	
}