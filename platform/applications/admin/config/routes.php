<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['signup_reg_email'] 					= 'signup/reg_email';
$route['customer']      					= 'signup/code_verification';
$route['business']          				= 'signup/code_verification';
$route['send_again_code_verification'] 		= 'signup/send_again_code_verification';
$route['chk-code']       					= 'signup/chk_code_verification';
$route['customer-detail']       			= 'signup/after_code_verification';
$route['business-detail']       			= 'signup/after_code_verification';
$route['add-register-data']     			= 'signup/add_register_data';
$route['login_user'] 						= 'login/user_login_check';


$route['dashboard'] 						= 'dashboard';

$route['admin/users'] 						= 'Users';
$route['admin/users/add'] 					= 'Users/add';
$route['admin/users/edit/(:any)'] 			= 'Users/edit/$1';
$route['admin/users/delete/(:any)'] 		= 'Users/delete/$1';

$route['admin/transactions'] 				= 'Transactions';
$route['admin/transactions/edit/(:any)'] 	= 'Transactions/edit/$1';
$route['admin/transactions/pending'] 		= 'Transactions/pending';
$route['admin/transactions/confirmed'] 		= 'Transactions/confirmed';
$route['admin/transactions/disputed'] 		= 'Transactions/disputed';
$route['admin/transactions/blocked'] 		= 'Transactions/blocked';
$route['admin/transactions/refunded'] 		= 'Transactions/refunded';
$route['admin/transactions/start_confirm/(:any)'] 	= 'Transactions/start_confirm/$1';
$route['admin/transactions/start_refund/(:any)'] 	= 'Transactions/start_refund/$1';
$route['admin/transactions/start_confirm/(:any)'] 	= 'Transactions/start_confirm/$1';


$route['admin/disputes'] 					= 'Disputes';
$route['admin/disputes/open_disputes'] 		= 'Disputes/open_disputes';
$route['admin/disputes/open_claims'] 		= 'Disputes/open_claims';
$route['admin/disputes/rejected_disputes'] 	= 'Disputes/rejected_disputes';
$route['admin/disputes/satisfied_disputes'] = 'Disputes/satisfied_disputes';


$route['admin/tickets'] 					= 'Tickets';
$route['admin/tickets/add'] 				= 'Tickets/add';
$route['admin/tickets/edit/(:any)'] 		= 'Tickets/edit/$1';
$route['admin/tickets/close_ticket/(:any)'] = 'Tickets/close_ticket/$1';
$route['admin/tickets/add_admin_comment/(:any)'] = 'Tickets/add_admin_comment/$1';
$route['admin/tickets/add_ticket'] 			= 'Tickets/add_ticket';
$route['admin/tickets/untreated'] 			= 'Tickets/untreated';
$route['admin/tickets/processed'] 			= 'Tickets/processed';
$route['admin/tickets/closed'] 				= 'Tickets/closed';

$route['admin/verification'] 				= 'Verification';
$route['admin/verification/pending'] 		= 'Verification/pending';
$route['admin/verification/confirmed'] 		= 'Verification/confirmed';
$route['admin/verification/disapproved'] 	= 'Verification/disapproved';

$route['admin/merchants'] 					= 'Merchants';
$route['admin/merchants/edit/(:any)'] 		= 'Merchants/edit/$1';
$route['admin/merchants/confirm/(:any)'] 	= 'Merchants/confirm/$1';
$route['admin/merchants/reject/(:any)'] 	= 'Merchants/reject/$1';
$route['admin/merchants/active'] 			= 'Merchants/active';
$route['admin/merchants/moderation'] 		= 'Merchants/moderation';
$route['admin/merchants/disapproved'] 		= 'Merchants/disapproved';

$route['admin/vouchers'] 					= 'vouchers';
$route['admin/vouchers/pending'] 			= 'vouchers/pending';
$route['admin/vouchers/activated'] 			= 'vouchers/activated';

$route['admin/currency'] 					= 'currency';
$route['admin/currency/update'] 			= 'currency/update';

$route['admin/template_msg'] 				= 'Template_msg';
$route['admin/template_msg/edit/(:any)'] 	= 'Template_msg/edit/$1';
$route['admin/template_msg/sms'] 			= 'Template_msg/sms';
$route['admin/template_msg/edit_sms/(:any)'] 	= 'Template_msg/edit_sms/$1';

$route['admin/fees'] 						= 'Fees';
$route['admin/fees/deposit'] 				= 'Fees/deposit';
$route['admin/fees/sci'] 					= 'Fees/sci';
$route['admin/fees/update'] 				= 'Fees/update';
$route['admin/fees/dep_update'] 			= 'Fees/dep_update';
$route['admin/fees/sci_update'] 			= 'Fees/sci_update';


$route['admin/logs'] 						= 'Logs';

$route['admin/settings_info'] 					= 'Settings_info';

$route['admin/contact'] 					= 'contact';

$route['login_user'] 						= 'login/user_login_check';
$route['logout']                			= 'login/logout';
$route['default_controller'] 				= 'home';
$route['404_override'] 						= 'error_404';
