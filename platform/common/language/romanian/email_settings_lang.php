<?php
/**
 * @author
 * @license     The MIT License (MIT), http://opensource.org/licenses/MIT
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_protocol'] = 'Protocol';
$lang['email_protocol_tip'] = 'Protocol for sending e-mail messages: mail, sendmail, smtp.';
$lang['email_mailpath'] = 'Sendmail Path';
$lang['email_mailpath_tip'] = 'Path to the program for sending messages Sendmail. It is relevant to sendmail protocol, for Linux systems only.';
$lang['email_smtp_host'] = 'SMTP Host';
$lang['email_smtp_host_tip'] = 'The address to the SMTP host server. It is relevant to the SMTP protocol only.';
$lang['email_smtp_user'] = 'SMTP Username';
$lang['email_smtp_user_tip'] = 'The username registerd in the SMTP host/server. It is relevant to the SMTP protocol only.';
$lang['email_smtp_pass'] = 'SMTP Password';
$lang['email_smtp_pass_tip'] = 'The password associated with the registered SMTP username. It is relevant to the SMTP protocol only.';
$lang['email_smtp_port'] = 'SMTP Port';
$lang['email_smtp_port_tip'] = 'The number of the TCP port for communication with the SMTP host/server. It is relevant to the SMTP protocol only. Ususlly the port is 25 for communication without encryption, 465 for ssl encryption, 587 for tls encryption.';
$lang['email_smtp_crypto'] = 'SMTP Encryption';
$lang['email_smtp_crypto_tip'] = 'The encryption type for the communoction with the SMTP host/server: none (without encryption), ssl, tls. It is relevant to the SMTP protocol only.';
$lang['email_none'] = 'none';
$lang['email_email'] = 'E-mail';
$lang['email_email_tip'] = 'This is the e-mail address, where the test message will be sent.';
$lang['mailer_enabled_tip'] = 'Enabling sending automaticaly e-mail messages by the system.';
$lang['site_email'] = 'Site e-mail address';
$lang['site_email_tip'] = 'The email-address from which the platform sends automatic messages.';
$lang['notification_email'] = 'Notification e-mail address';
$lang['notification_email_tip'] = 'The e-mail address, where automatic messages about system events are to be sent.';
$lang['cc_email'] = 'E-mail address for copies';
$lang['cc_email_tip'] = 'An e-mail address that receives copies of automaticaly generated messages.';
$lang['email_smtp_auto_tls'] = 'SMTP Auto-TLS';
$lang['email_smtp_auto_tls_tip'] = 'Whether to enable TLS encryption automatically if a server supports it, even if "SMTP Encryption" is not set to "tls".';
$lang['email_smtp_conn_options'] = 'SMTP Connection Options';
$lang['email_smtp_conn_options_tip'] = 'SMTP connection options, notated in JSON format, For example: { "ssl": { "verify_peer": false, "verify_peer_name": false, "allow_self_signed": true } }';
$lang['email_dkim_domain'] = 'DKIM Domain';
$lang['email_dkim_domain_tip'] = 'DKIM signing domain name, for exmple "example.com".';
$lang['email_dkim_private'] = 'DKIM Private Key';
$lang['email_dkim_private_tip'] = 'DKIM private key, the file path. The file path accepts variables like {APPPATH}, {COMMONPATH}, and {PLATFORMPATH}';
$lang['email_dkim_selector'] = 'DKIM Selector';
$lang['email_dkim_selector_tip'] = 'DKIM selector, indicates your DKIM public key location.';
$lang['email_dkim_passphrase'] = 'DKIM Passphrase';
$lang['email_dkim_passphrase_tip'] = 'DKIM passphrase, used if your private key is encrypted.';
$lang['email_dkim_identity'] = 'DKIM Identity';
$lang['email_dkim_identity_tip'] = 'DKIM identity, usually the email address used as the source of the email.';
