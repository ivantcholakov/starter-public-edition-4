<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Forgot Password";
$lang['users title login']                    = "Login";
$lang['users title profile']                  = "Profile";
$lang['users title register']                 = "Register";
$lang['users title user_add']                 = "Add User";
$lang['users title user_delete']              = "Confirm Delete User";
$lang['users title user_edit']                = "Edit User";
$lang['users title user_list']                = "User List";
$lang['users title dasboard']                 = "Dashboard";
$lang['users title history']                  = "Operations history";
$lang['users title resolution']               = "Resolution center";
$lang['users title det_dispute']              = "Detail dispute";
$lang['users title support']                  = "Support";
$lang['users title all_tickets']              = "All tickets";
$lang['users title request']                  = "Request payment";
$lang['users title request_form']             = "Payment request form";
$lang['users title new_ticket']               = "New ticket";
$lang['users title money_transfer']           = "Money transfer";
$lang['users title form_transfer']            = "Form of money transfer";
$lang['users title exchange']                 = "Money exchange";
$lang['users title form_exchange']            = "Exchange of base currency";
$lang['users title to_form_exchange']         = "Exchange to base currency";
$lang['users title withdrawal']               = "Withdrawal";
$lang['users title deposit']                  = "Deposit";
$lang['users title form_withdrawal']          = "Choose how to receive funds";
$lang['users title form_deposit']             = "Choice of deposit method";
$lang['users title verifi']                   = "Verification";
$lang['users title settings']                 = "Settings account";
$lang['users title about']                    = "Profile";

// Buttons
$lang['users button add_new_user']            = "Add New User";
$lang['users button register']                = "Create Account";
$lang['users button reset_password']          = "Reset Password";
$lang['users button login_try_again']         = "Try Again";

// Tooltips
$lang['users tooltip add_new_user']           = "Create a brand new user.";

// Links
$lang['users link forgot_password']           = "Forgot your password?";
$lang['users link register_account']          = "Register for an account.";

// Table Columns
$lang['users col first_name']                 = "First Name";
$lang['users col is_admin']                   = "Admin";
$lang['users col last_name']                  = "Last Name";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Username";

// Form Inputs
$lang['users input email']                    = "Email";
$lang['users input first_name']               = "First Name";
$lang['users input is_admin']                 = "Is Admin";
$lang['users input language']                 = "Language";
$lang['users input last_name']                = "Last Name";
$lang['users input password']                 = "Password";
$lang['users input password_repeat']          = "Repeat Password";
$lang['users input status']                   = "Status";
$lang['users input username']                 = "Username";
$lang['users input username_email']           = "Username or Email";
$lang['users input phone']                    = "Phone";

// Help
$lang['users help passwords']                 = "Only enter passwords if you want to change it.";

// Messages
$lang['users msg add_user_success']           = "%s was successfully added!";
$lang['users msg delete_confirm']             = "Are you sure you want to delete <strong>%s</strong>? This can not be undone.";
$lang['users msg delete_user']                = "You have succesfully deleted <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Your profile was successfully modified!";
$lang['users msg edit_user_success']          = "%s was successfully modified!";
$lang['users msg register_success']           = "Thanks for registering, %s! Check your email for a confirmation message. Once
                                                 your account has been verified, you will be able to log in with the credentials
                                                 you provided.";
$lang['users msg password_reset_success']     = "Your password has been reset, %s! Please check your email for your new temporary password.";
$lang['users msg validate_success']           = "Your account has been verified. You may now log in to your account.";
$lang['users msg email_new_account']          = "<p>Thank you for creating an account at %s. Click the link below to validate your
                                                 email address and activate your account.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "New Account for %s";
$lang['users msg email_password_reset']       = "<p>Your password at %s has been reset. Click the link below to log in with your
                                                 new password:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Once logged in, be sure to change your password to something you can
                                                 remember.</p>";
$lang['users msg email_password_reset_title'] = "Password Reset for %s";

// Menu
$lang['users menu dashboard']                 = "Dashboard";
$lang['users menu transfer']                  = "Money transfer";
$lang['users menu exchange']                  = "Currency exchange";
$lang['users menu history']                   = "Operations history";
$lang['users menu dispute']                   = "Resolution center";
$lang['users menu request']                   = "Request payment";
$lang['users menu acceptance']                = "Acceptance payments";
$lang['users menu support']                   = "Support";
$lang['users menu settings']                  = "Account settings";

// Dashboard
$lang['users dashboard ballance']             = "Available ballance";
$lang['users dashboard deposit']              = "Deposit";
$lang['users dashboard withdrawal']           = "Withdrawal";
$lang['users dashboard other_ballance']       = "Other wallets";
$lang['users dashboard success_verif_title']  = "The status of your account - verified";
$lang['users dashboard success_verif_text']   = "Excellent! Now you can withdraw funds from your account without restrictions.  <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard danger_verif_title']   = "The status of your account - anonymous";
$lang['users dashboard danger_verif_text']    = "Oops! Your account status does not allow you to withdraw funds from your account. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard warning_verif_title']  = "The status of your account - pending verification";
$lang['users dashboard warning_verif_text']   = "Thanks! We received your documents and will give a decision within 2-3 working days. <a href=\"/account/identification\">Learn More</a>";
$lang['users dashboard info_verif_title']     = "The status of your account - business";
$lang['users dashboard info_verif_text']      = "Great! You have confirmed your reliability status and can accept external payments. <a href=\"/account/identification\">Learn More</a>";
$lang['users trans deposit']                  = "Deposit";
$lang['users trans withdrawal']               = "Withdrawal";
$lang['users trans transfer']                 = "Transfer";
$lang['users trans exchange']                 = "Exchange";
$lang['users trans external']                 = "External deposit";
$lang['users trans pending']                  = "Pending";
$lang['users trans success']                  = "Confirmed";
$lang['users trans refund']                   = "Refund";
$lang['users trans dispute']                  = "Dispute";
$lang['users trans blocked']                  = "Blocked";
$lang['users trans id']                       = "ID";
$lang['users trans type']                     = "Type";
$lang['users trans sum']                      = "Sum";
$lang['users trans fee']                      = "Fee";
$lang['users trans amount']                   = "Amount";
$lang['users trans status']                   = "Status";
$lang['users trans sender']                   = "Sender";
$lang['users trans receiver']                 = "Receiver";
$lang['users trans date']                     = "Date";
$lang['users trans comment']                  = "Comment";
$lang['users trans cyr']                      = "Currency";
$lang['users trans detail']                   = "Detail";
$lang['users trans 10last']                   = "Last 10 operations";
$lang['users trans all']                      = "All transactions";

// History
$lang['users history all']                    = "Account IP history";
$lang['users history detail']                 = "Detail transaction";
$lang['users history id_trans']               = "ID transaction";
$lang['users history open_dispute']           = "Open dispute";
$lang['users history print']                  = "Print detail";
$lang['users history of']                     = "Dated";
$lang['users history open_dispute']           = "Opening dispute";
$lang['users history dispute_title']          = "Reason for opening a dispute";
$lang['users history not_received']           = "I have not received the goods";
$lang['users history not_desk']               = "Product does not match the description";
$lang['users history reason']                 = "Describe the essence of the dispute";
$lang['users history help']                   = "Specify in the text box the reason why you open this dispute. As detailed as possible description of the problem and ask the seller of options for its solutions.";
$lang['users history start']                  = "Start dispute";
$lang['users history dispute_success']        = "The dispute was successfully opened! You can track the dispute in the center of the resolution";
$lang['users history swift']                  = "We expect your payment! Enter in the payment Bank order your username.";

// Dispute
$lang['users dispute list']                   = "List of disputes";
$lang['users dispute id']                     = "ID dispute";
$lang['users dispute date']                   = "Date";
$lang['users dispute claimant']               = "Claimant";
$lang['users dispute action']                 = "Action";
$lang['users dispute start_claim']            = "Start claim";
$lang['users dispute close_claim']            = "Close dispute";
$lang['users disputes id_tran']               = "ID transaction";
$lang['users disputes id_tran_time']          = "Date transaction";
$lang['users disputes time_dispute']          = "Date dispute";
$lang['users disputes all_dispute']           = "All disputes";
$lang['users disputes edit_dispute']          = "Edit dispute";
$lang['users disputes claimant']              = "Claimant";
$lang['usersn disputes defendant']            = "Defendant";
$lang['users disputes status']                = "Status";
$lang['users disputes open']                  = "Dispute is open";
$lang['users disputes rejected']              = "Claim rejected";
$lang['users disputes satisfied']             = "Claim satisfied";
$lang['users disputes claim']                 = "Claim";
$lang['users disputes detail']                = "Details dispute";
$lang['users disputes overwiev']              = "Overview dispute";
$lang['users disputes back']                  = "Back";
$lang['users disputes new_comment']           = "New comment";
$lang['users disputes add_comment']           = "Add comment";
$lang['users disputes comment_success']       = "Your comment was successfully added!";
$lang['users disputes open_claim_success']    = "The dispute was successfully transferred to the claim!";
$lang['users disputes transferred']           = "The dispute is transferred to the claim. Please wait for the administration's decision.";
$lang['users disputes stop']                  = "The dispute is stopped. My problem is resolved";
$lang['users disputes success_stop']          = "Dispute was successfully stopped";

// Tickets
$lang['users tickets add']                    = "Crate new ticket";
$lang['users tickets date']                   = "Create date";
$lang['users tickets date_info']              = "Date";
$lang['users tickets user']                   = "Username";
$lang['users tickets message']                = "Message";
$lang['users tickets create']                 = "Create ticket";
$lang['users tickets title']                  = "Title";
$lang['users tickets untreated']              = "Untreated";
$lang['users tickets processed']              = "Processed";
$lang['users tickets closed']                 = "Closed";
$lang['users tickets success_edit']           = "Ticket successfully changed";
$lang['users tickets reply']                  = "Reply to ticket";
$lang['users tickets id']                     = "ID ticket";
$lang['users tickets close']                  = "Close ticket";
$lang['users tickets new']                    = "New comment";
$lang['users tickets success_comment']        = "Comment added successfully!";
$lang['users tickets success_close']          = "Ticket successfully closed!";
$lang['users tickets success_new']            = "Ticket successfully created! We will reply within two business days";
$lang['users tickets form']                   = "Fill out the support request form";
$lang['users tickets send']                   = "Send ticket";

// Request
$lang['users reqest purpose']                 = "Purpose of payment";
$lang['users reqest invoice']                 = "Invoice number";
$lang['users reqest email']                   = "Email";
$lang['users reqest note']                    = "Note for recipient";
$lang['users reqest send']                    = "Send request";
$lang['users reqest success']                 = "Your request was successfully sent!";

// Transfer
$lang['users transfer amount']                = "Amount trasfer";
$lang['users transfer sum']                   = "Fee";
$lang['users transfer help_com']              = "With commission";
$lang['users transfer receiver']              = "Username receiver";
$lang['users transfer send']                  = "Send money";
$lang['users transfer success']               = "Money transfer was successfully completed!";

// Exchange
$lang['users exchange rate']                  = "Exchange rates";
$lang['users exchange amount']                = "Amount exchange";
$lang['users exchange get']                   = "You get";
$lang['users exchange start']                 = "Start exchange";
$lang['users exchange note']                  = "Exchange operation";
$lang['users exchange success']               = "Exchange successfully completed!";

// Withdrawal
$lang['users withdrawal amount']              = "Amount";
$lang['users withdrawal currency']            = "Currency";
$lang['users withdrawal account']             = "Your requisites for receiving funds";
$lang['users withdrawal help']                = "Please enter a valid account to which you want to transfer money. For example mail@gmail.com or 4276150025568996";
$lang['users withdrawal error']               = "Your level of verification is not enough to perform the operation";

// Method
$lang['users withdrawal card']                = "Bank cards";
$lang['users withdrawal paypal']              = "PayPal";
$lang['users withdrawal btc']                 = "Bitcoin";
$lang['users withdrawal adv']                 = "ADV cash";
$lang['users withdrawal webmoney']            = "Webmoney";
$lang['users withdrawal payeer']              = "Payeer";
$lang['users withdrawal qiwi']                = "QIWI VISA Wallet";
$lang['users withdrawal perfect']             = "Perfect money";
$lang['users withdrawal swift']               = "SWIFT transfer";

// Verifi
$lang['users verifi title']                  = "Level of your account";
$lang['users verifi anonymous']              = "Anonymous";
$lang['users verifi verified']               = "Verified";
$lang['users verifi business']               = "Business";
$lang['users verifi available']              = "Available";
$lang['users verifi not_available']          = "Not available";
$lang['admin verifi check']                  = "Your documents are on check. We need 2-3 working days!";
$lang['users verifi deposit']                = "deposit";
$lang['users verifi transfer']               = "money transfer";
$lang['users verifi exchange']               = "exchange";
$lang['users verifi request']                = "request";
$lang['users verifi withdrawal']             = "withdrawal funds";
$lang['users verifi acceptance']             = "acceptance payments";
$lang['users verifi get_it_now']             = "Get it now";
$lang['users verifi you_status']             = "Your status";
$lang['users verifi upload']                 = "Upload documents";
$lang['users verifi save']                   = "Save";
$lang['users verifi close']                  = "Close";
$lang['users verifi unavailable']            = "Unavailable";
$lang['users verifi info']                   = "We never transfer your personal information to anyone or use it for commercial purposes. Identification only helps us distinguish between trustworthy users and potential scammers. If a person gives us his data, we assume he's got nothing to hide. ";
$lang['users verifi id']                     = "Identity card or passport";
$lang['users verifi adress']                 = "Address document";
$lang['users verifi doc_business']           = "Business registration documents";

// Deposit
$lang['users deposit next']                  = "Next";
$lang['users deposit payment']               = "Go to payment";

// Merchants ====================================================================================
$lang['users merchants pay']                 = "Pay order"; //
$lang['users merchants btc_address']         = "BTC address"; //
$lang['users merchants btc_order']           = "Order is awaiting transfer for the amount of"; //
$lang['users merchants btc_total']           = "You will receive to your account"; //
$lang['users merchants btc_completed']       = "after the transaction is completed"; //
$lang['users merchants btc_warning']         = "Up to six network confirmations may be required to complete the operation."; //
$lang['users merchants html']                = "HTML Form generator"; //
$lang['users merchants all']                 = "All merchants";
$lang['users merchants id']                  = "Merchant ID"; //
$lang['users merchants item']                = "Item name"; //
$lang['users merchants order']               = "Order number"; //
$lang['users merchants price']               = "Price"; //
$lang['users merchants custom']              = "Custom"; //
$lang['users merchants form']                = "Example HTML form"; //
$lang['users merchants generate']            = "Generate!"; //
$lang['users merchants copy']                = "Copy the form code and place it on your website."; //
$lang['users merchants pay']                 = "Pay order"; //
$lang['users merchants btc_address']         = "BTC address"; //
$lang['users merchants btc_order']           = "Order is awaiting transfer for the amount of"; //
$lang['users merchants btc_total']           = "You will receive to your account"; //
$lang['users merchants btc_completed']       = "after the transaction is completed"; //
$lang['users merchants btc_warning']         = "Up to six network confirmations may be required to complete the operation."; //
$lang['users merchants html']                = "HTML Form generator"; //
$lang['users merchants all']                 = "All merchants";
$lang['users merchants id']                  = "Merchant ID"; //
$lang['users merchants item']                = "Item name"; //
$lang['users merchants order']               = "Order number"; //
$lang['users merchants price']               = "Price"; //
$lang['users merchants custom']              = "Custom"; //
$lang['users merchants form']                = "Example HTML form"; //
$lang['users merchants generate']            = "Generate!"; //
$lang['users merchants copy']                = "Copy the form code and place it on your website."; //
$lang['users merchants create']              = "Create new merchant";
$lang['users merchants name']                = "Name";
$lang['users merchants url']                 = "URL site";
$lang['users merchants ipn']                 = "Status IPN link";
$lang['users merchants active']              = "Active";
$lang['users merchants moderation']          = "Moderation";
$lang['users merchants disapproved']         = "Disapproved";
$lang['users merchants test']                = "Test payment form";
$lang['users merchants detail']              = "Detail merchant";
$lang['users merchants password']            = "Merchant password";
$lang['users merchants new']                 = "New merchant";
$lang['users merchants comment']             = "Comment for administration";
$lang['users merchants send']                = "Send for moderation";
$lang['users merchants success']             = "Request has been sent! We will take a decision within 2-3 business days!";
// Merchants ====================================================================================


// Errors
$lang['users error add_user_failed']          = "%s could not be added!";
$lang['users error delete_user']              = "<strong>%s</strong> could not be deleted!";
$lang['users error edit_profile_failed']      = "Your profile could not be modified!";
$lang['users error edit_user_failed']         = "%s could not be modified!";
$lang['users error email_exists']             = "The email <strong>%s</strong> already exists!";
$lang['users error email_not_exists']         = "That email does not exists!";
$lang['users error invalid_login']            = "Invalid username or password";
$lang['users error password_reset_failed']    = "There was a problem resetting your password. Please try again.";
$lang['users error register_failed']          = "Your account could not be created at this time. Please try again.";
$lang['users error user_id_required']         = "A numeric user ID is required!";
$lang['users error user_not_exist']           = "That user does not exist!";
$lang['users error username_exists']          = "The username <strong>%s</strong> already exists!";
$lang['users error validate_failed']          = "There was a problem validating your account. Please try again.";
$lang['users error too_many_login_attempts']  = "You've made too many attempts to log in too quickly. Please wait %s seconds and try again.";
$lang['users error fraud']                    = "Sorry, you can not complete this operation. Please contact support for clarification";
$lang['users error form']                     = "Please provide correct data about the transfer";
$lang['users error wallet']                   = "Sorry, not enough funds to perform the operation";
//################################################################################################
$lang['users error warning']                  = "Warning!";
$lang['users error not_fraud']                = "Some operations are prohibited for your account. Contact support for more details!";
$lang['users error invalid_form']             = "You entered incorrect data!";
$lang['users error btc_network']              = "The funds will be credited to your account after 6 network confirmations!"; //

// Vouchers
$lang['users vouchers menu']                  = "Vouchers";
$lang['users vouchers all']                   = "All vouchers";
$lang['users vouchers pending']               = "Pending";
$lang['users vouchers activated']             = "Activated";
$lang['users vouchers code']                  = "Code";
$lang['users vouchers code_v']                = "Code voucher";
$lang['users vouchers creator']               = "Creator";
$lang['users vouchers activator']             = "Activator";
$lang['users vouchers voucher']               = "Voucher";
$lang['users vouchers detail']                = "Detail voucher";
$lang['users vouchers date']                  = "Activation date";
$lang['users vouchers new']                   = "New code";
$lang['users vouchers new_v']                 = "New voucher";
$lang['users vouchers create_v']              = "Create voucher";
$lang['users vouchers ac']                    = "Activate code";
$lang['users vouchers now']                   = "Activate now";
$lang['users vouchers date_created']          = "Created date";
$lang['users vouchers error']                 = "This voucher does not exist or has already been activated in the system!";
$lang['users vouchers success']               = "Voucher successfully activated!";
$lang['users vouchers error_new']             = "Check the correctness of the entered values!";
$lang['users vouchers success_new']           = "Voucher successfully created!";