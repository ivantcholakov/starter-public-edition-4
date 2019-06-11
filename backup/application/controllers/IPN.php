<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IPN extends Public_Controller {

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
		$this->load->model('emailtemplate_model');
		$this->load->model('smstemplate_model');
		$this->lang->load('currency');
		$this->load->library('commission');
		$this->load->library('email');
		$this->load->library('currencys');
		$this->config->set_item('csrf_protection', FALSE);
    }
	
	/**
	* PayPal
    */
	
	public function paypal() 
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
			$user = $_POST['custom'];
			// IPN message values depend upon the type of notification sent.
			// To loop through the &_POST array and print the NV pairs to the screen:
			
			$percent = $this->commission->display->fee_pp_dep/"100";
			$fee_percent = $amount*$percent;
			$fee = $fee_percent+$this->commission->display->fee_pp_fix_dep;
			$sum = $amount-$fee;
			$id = $txn_id;
			
			if($payment_currency = $this->currencys->display->base_code) {
			
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "1",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $amount,
					"currency"			=> 'debit_base',
					"status" 			=> "2",
					"sender" 			=> "PayPal",
					"receiver" 			=> $user,
					"time"          	=> date('Y-m-d H:i:s'),
					"user_comment" 		=> 'PayPal # '.$txn_id.'',
					"admin_comment" 	=> "none"
					)
				);

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
			
			} else {
				
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "1",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $amount,
					"currency"			=> 'debit_base',
					"status" 			=> "5",
					"sender" 			=> "PayPal",
					"receiver" 			=> $user,
					"time"          	=> date('Y-m-d H:i:s'),
					"user_comment"  	=> 'PayPal # '.$txn_id.'',
					"admin_comment" 	=> "Other currency"
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
	* Blockchain
    */
	public function blockchain() 
	{
		
		$transaction_hash = $_GET['transaction_hash'];
		$value_in_satoshi = $_GET['value'];
		$value_in_btc = $value_in_satoshi / 100000000;
		$address = $_GET['address'];
		$block_transaction = $this->transactions_model->get_chain($address);
		
		if ($_GET['secret'] == $this->commission->display->pass_btc) {

			$users = $this->users_model->get_user_transfer($block_transaction['receiver']);


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

				$percent = $this->commission->display->fee_btc_dep/"100";
				$fee_percent = $amount*$percent;
				$fee = $fee_percent+$this->commission->display->fee_btc_fix;
				$sum = $amount-$fee;

				if ($_GET['confirmations'] >= 6) {

					// update transaction history
					$this->transactions_model->update_btc_transactions($block_transaction['id'],
						array(
							"status"   			 => "2",
							"admin_comment"  => $_GET['secret'],
							"amount"         => $amount,
							"sum"  				 	 => $sum,
						)
					);

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
				
					echo "*ok*";

				}

			} else {
				$rate = "undefined";
				// update transaction history
				$this->transactions_model->update_btc_transactions($block_transaction['id'],
					array(
						"status"   		 => "5",
						"admin_comment"  => $transaction_hash,
					)
				);
				
				echo "*ok*";
			}

		} else {
				
		// update transaction history
		$this->transactions_model->update_btc_transactions($block_transaction['id'],
			array(
				"status"   			 => "5",
				"admin_comment"  => $transaction_hash,
			)
		);
			
		echo "*ok*";
			
		}

	}
	
	
	/**
	* Payeer
    */
	public function payeer() 
	{
		if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

		if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
		{
			$m_key = $this->commission->display->merch_payeer;

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
			
			$percent = $this->commission->display->fee_payeer_dep/"100";
			$fee_percent = $amount*$percent;
			$fee = $fee_percent+$this->commission->display->fee_pay_fix;
			$sum = $amount-$fee;
			
			if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
			{
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "1",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $amount,
					"currency"			=> 'debit_base',
					"status" 			=> "2",
					"sender" 			=> "Payeer",
					"receiver" 			=> $user,
					"time"          	=> date('Y-m-d H:i:s'),
					"user_comment"  	=> 'Payeer ID '.$_POST['m_operation_id'].'',
					"admin_comment" 	=> "none"
					)
				);
				
				$users = $this->users_model->get_user_transfer($user);
				
				$total = $users['debit_base']+$sum;
				
				// update wallet
				$this->users_model->update_wallet_transfer($user,
					array(
						"debit_base" => $total,
						)
					);
				
				echo $_POST['m_orderid'].'|success';
				
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
			}

			else {
    			echo $_POST['m_orderid'].'|error';
			}
		}
	}
	
 	/**
	*ADV Cash
    */	
	public function advcash() 
	{
		$secret=$this->commission->display->secret_adv;
	
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
			$user = $_POST['ac_comments'];
				
			$percent = $this->commission->display->fee_adv_dep/"100";
			$fee_percent = $amount*$percent;
			$fee = $fee_percent+$this->commission->display->fee_adv_fix;
			$sum = $amount-$fee;
				
			$transactions = $this->transactions_model->add_transaction(array(
				"type" 				=> "1",
				"sum"  				=> $sum,
				"fee"    			=> $fee,
				"amount" 			=> $amount,
				"currency"			=> 'debit_base',
				"status" 			=> "2",
				"sender" 			=> "ADV Cash",
				"receiver" 			=> $user,
				"time"          	=> date('Y-m-d H:i:s'),
				"user_comment"  	=> 'ADV Cash ID '.$id_transfer.'',
				"admin_comment" 	=> "none"
				)
			);
			
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

		}
		else
		{

		}
	}
	
	/**
	*Perfect money
    */	
	
	public function perfect2() 
	{
	
		$alternate=strtoupper(md5($this->commission->display->key_perfect));
	
		$hash_string=
			$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
	    	$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
	    	$_POST['PAYMENT_BATCH_NUM'].':'.
	    	$_POST['PAYER_ACCOUNT'].':'.$alternate.':'.
	    	$_POST['TIMESTAMPGMT'];
	
		$hash=strtoupper(md5($hash_string));

		if($hash==$_POST['V2_HASH']){
		
			if($_POST['PAYMENT_UNITS']==$this->currencys->display->base_code){

    			$users = $this->users_model->get_user($_POST['PAYMENT_ID']);
				$amount = $_POST['PAYMENT_AMOUNT'];
			
				$percent = $this->commission->display->fee_perfect/"100";
				$fee_percent = $amount*$percent;
	  			$fee = $fee_percent+$this->commission->display->fee_perf_fix;
				$sum = $amount-$fee;
		
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "1",
					"sum"  				=> $sum,
					"fee"    			=> $fee,
					"amount" 			=> $_POST['PAYMENT_AMOUNT'],
					"currency"			=> 'debit_base',
					"status" 			=> "2",
					"sender" 			=> "Perfect Money",
					"receiver" 			=> $users['username'],
					"time"          	=> date('Y-m-d H:i:s'),
					"user_comment"  	=> 'Perfect Money ID '. $_POST['PAYMENT_BATCH_NUM'].'',
					"admin_comment" 	=> "none"
					)
				);
				
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
			

   			}
   			else
   			{ // you can also save invalid payments for debug purposes

   			}
		
		}else
		{
		//NO
		}
	}
}