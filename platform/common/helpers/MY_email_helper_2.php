<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('set_email_settings')) {

    // Sets email settings within database. Use this function within admin panel
    // for making possible some chosen email settings to be edited through user interface.
    // See also the complement function get_email_settings().
    function set_email_settings($config) {

        $ci = get_instance();

        $ci->load
            ->library('settings')
        ;

        if (!is_array($config)) {
            $config = array();
        }

        if (array_key_exists('useragent', $config)) {
            $ci->settings->set('email_useragent', (string) $config['useragent']);
        }

        if (array_key_exists('protocol', $config)) {
            $ci->settings->set('email_protocol', (string) $config['protocol']);
        }

        if (array_key_exists('mailpath', $config)) {
            $ci->settings->set('email_mailpath', (string) $config['mailpath']);
        }

        if (array_key_exists('smtp_host', $config)) {
            $ci->settings->set('email_smtp_host', (string) $config['smtp_host']);
        }

        if (array_key_exists('smtp_user', $config)) {
            $ci->settings->set('email_smtp_user', (string) $config['smtp_user']);
        }

        if (array_key_exists('smtp_pass', $config)) {
            $ci->settings->set('email_smtp_pass', (string) $config['smtp_pass'], true);
        }

        if (array_key_exists('smtp_port', $config)) {
            $ci->settings->set('email_smtp_port', (int) $config['smtp_port']);
        }

        if (array_key_exists('smtp_timeout', $config)) {
            $ci->settings->set('email_smtp_timeout', (int) $config['smtp_timeout']);
        }

        if (array_key_exists('smtp_crypto', $config)) {
            $ci->settings->set('email_smtp_crypto', (string) $config['smtp_crypto']);
        }

        if (array_key_exists('smtp_debug', $config)) {
            $ci->settings->set('email_smtp_debug', (int) $config['smtp_debug']);
        }

        if (array_key_exists('debug_output', $config)) {
            $ci->settings->set('email_debug_output', (int) $config['debug_output']);
        }

        if (array_key_exists('wordwrap', $config)) {
            $ci->settings->set('email_wordwrap', empty($config['wordwrap']) ? 0 : 1);
        }

        if (array_key_exists('wrapchars', $config)) {
            $ci->settings->set('email_wrapchars', (int) $config['wrapchars']);
        }

        if (array_key_exists('mailtype', $config)) {
            $ci->settings->set('email_mailtype', (string) $config['mailtype']);
        }

        if (array_key_exists('charset', $config)) {
            $ci->settings->set('email_charset', (string) $config['charset']);
        }

        if (array_key_exists('validate', $config)) {
            $ci->settings->set('email_validate', empty($config['validate']) ? 0 : 1);
        }

        if (array_key_exists('priority', $config)) {
            $ci->settings->set('email_priority', empty($config['priority']) ? null : (int) $config['priority']);
        }

        if (array_key_exists('crlf', $config)) {
            $ci->settings->set('email_crlf', (string) $config['crlf']);
        }

        if (array_key_exists('newline', $config)) {
            $ci->settings->set('email_newline', (string) $config['newline']);
        }

        if (array_key_exists('bcc_batch_mode', $config)) {
            $ci->settings->set('email_bcc_batch_mode', empty($config['bcc_batch_mode']) ? 0 : 1);
        }

        if (array_key_exists('bcc_batch_size', $config)) {
            $ci->settings->set('email_bcc_batch_size', (int) $config['bcc_batch_size']);
        }

        if (array_key_exists('encoding', $config)) {
            $ci->settings->set('email_encoding', (string) $config['encoding']);
        }

        //----------------------------------------------------------------------

        if (array_key_exists('smtp_auto_tls', $config)) {
            $ci->settings->set('email_smtp_auto_tls', (int) empty($config['smtp_auto_tls']) ? 0 : 1);
        }

        if (array_key_exists('smtp_conn_options', $config)) {

            $config['smtp_conn_options'] = get_object_vars_recursive($config['smtp_conn_options']);

            if (empty($config['smtp_conn_options'])) {
                $config['smtp_conn_options'] = array();
            }

            $ci->settings->set('email_smtp_conn_options', $config['smtp_conn_options']);
        }

        //----------------------------------------------------------------------

        if (array_key_exists('oauth_type', $config)) {
            $ci->settings->set('email_oauth_type', (string) $config['oauth_type']);
        }

        if (array_key_exists('oauth_user_email', $config)) {
            $ci->settings->set('email_oauth_user_email', (string) $config['oauth_user_email']);
        }

        if (array_key_exists('oauth_client_id', $config)) {
            $ci->settings->set('email_oauth_client_id', (string) $config['oauth_client_id']);
        }

        if (array_key_exists('oauth_client_secret', $config)) {
            $ci->settings->set('email_oauth_client_secret', (string) $config['oauth_client_secret']);
        }

        if (array_key_exists('oauth_refresh_token', $config)) {
            $ci->settings->set('email_oauth_refresh_token', (string) $config['oauth_refresh_token']);
        }

        //----------------------------------------------------------------------

        if (array_key_exists('dkim_domain', $config)) {
            $ci->settings->set('email_dkim_domain', (string) $config['dkim_domain']);
        }

        if (array_key_exists('dkim_private', $config)) {
            $ci->settings->set('email_dkim_private', (string) $config['dkim_private']);
        }

        if (array_key_exists('dkim_private_string', $config)) {
            $ci->settings->set('email_dkim_private_string', (string) $config['dkim_private_string']);
        }

        if (array_key_exists('dkim_selector', $config)) {
            $ci->settings->set('email_dkim_selector', (string) $config['dkim_selector']);
        }

        if (array_key_exists('dkim_passphrase', $config)) {
            $ci->settings->set('email_dkim_passphrase', (string) $config['dkim_passphrase'], true);
        }

        if (array_key_exists('dkim_identity', $config)) {
            $ci->settings->set('email_dkim_identity', (string) $config['dkim_identity']);
        }

        //----------------------------------------------------------------------

        if (array_key_exists('mailer_enabled', $config)) {
            $ci->settings->set('mailer_enabled', (int) empty($config['mailer_enabled']) ? 0 : 1);
        }

        if (array_key_exists('site_email', $config)) {
            $ci->settings->set('site_email', (string) $config['site_email']);
        }

        if (array_key_exists('notification_email', $config)) {
            $ci->settings->set('notification_email', (string) $config['notification_email']);
        }

        if (array_key_exists('cc_email', $config)) {
            $ci->settings->set('cc_email', (string) $config['cc_email']);
        }

        if (array_key_exists('bcc_email', $config)) {
            $ci->settings->set('bcc_email', (string) $config['cc_email']);
        }

    }

}

if (!function_exists('get_email_settings')) {

    // Returns all the email settings. The settings are stored within database,
    // missing in database values are to be taken from the configuration file.
    function get_email_settings() {

        $ci = get_instance();

        $ci->load
            ->library('settings')
        ;

        // Read values from the configuration file first.

        $config = $ci->config->load('email', true, true);

        if (empty($config)) {
            $config = array();
        }

        $config = $config + array(
            'mailer_enabled' => config_item('mailer_enabled'),
            'site_email' => config_item('site_email'),
            'notification_email' => config_item('notification_email'),
            'cc_email' => config_item('cc_email'),
            'bcc_email' => config_item('bcc_email'),
        );

        // Ensure default values presence.

        $config['useragent'] = array_key_exists('useragent', $config) ? $config['useragent'] : 'CodeIgniter';
        $config['protocol'] = array_key_exists('protocol', $config) ? $config['protocol'] : (IS_WINDOWS_OS ? 'smtp' : 'mail');
        $config['mailpath'] = array_key_exists('mailpath', $config) ? $config['mailpath'] : '/usr/sbin/sendmail';
        $config['smtp_host'] = array_key_exists('smtp_host', $config) ? $config['smtp_host'] : 'localhost';
        $config['smtp_user'] = array_key_exists('smtp_user', $config) ? $config['smtp_user'] : '';
        $config['smtp_pass'] = array_key_exists('smtp_pass', $config) ? $config['smtp_pass'] : '';
        $config['smtp_port'] = array_key_exists('smtp_port', $config) ? $config['smtp_port'] : 25;
        $config['smtp_timeout'] = array_key_exists('smtp_timeout', $config) ? $config['smtp_timeout'] : 5;
        $config['smtp_crypto'] = array_key_exists('smtp_crypto', $config) ? $config['smtp_crypto'] : '';
        $config['smtp_debug'] = array_key_exists('smtp_debug', $config) ? $config['smtp_debug'] : 0;
        $config['debug_output'] = array_key_exists('debug_output', $config) ? $config['debug_output'] : '';
        $config['wordwrap'] = array_key_exists('wordwrap', $config) ? $config['wordwrap'] : true;
        $config['wrapchars'] = array_key_exists('wrapchars', $config) ? $config['wrapchars'] : 76;
        $config['mailtype'] = array_key_exists('mailtype', $config) ? $config['mailtype'] : 'html';
        $config['charset'] = array_key_exists('charset', $config) ? $config['charset'] : 'utf-8';
        $config['validate'] = array_key_exists('validate', $config) ? $config['validate'] : true;
        $config['priority'] = array_key_exists('priority', $config) ? (empty($config['priority']) ? null : (int) $config['priority']) : null;
        $config['crlf'] = array_key_exists('crlf', $config) ? $config['crlf'] : "\n";
        $config['newline'] = array_key_exists('newline', $config) ? $config['newline'] : "\n";
        $config['bcc_batch_mode'] = array_key_exists('bcc_batch_mode', $config) ? $config['bcc_batch_mode'] : false;
        $config['bcc_batch_size'] = array_key_exists('bcc_batch_size', $config) ? $config['bcc_batch_size'] : 200;
        $config['encoding'] = array_key_exists('encoding', $config) ? $config['encoding'] : '8bit';

        $config['smtp_auto_tls'] = array_key_exists('smtp_auto_tls', $config) ? $config['smtp_auto_tls'] : true;
        $config['smtp_conn_options'] = array_key_exists('smtp_conn_options', $config) ? $config['smtp_conn_options'] : array();

        $config['oauth_type'] = array_key_exists('oauth_type', $config) ? $config['oauth_type'] : '';
        $config['oauth_instance'] = array_key_exists('oauth_instance', $config) ? $config['oauth_instance'] : null;
        $config['oauth_user_email'] = array_key_exists('oauth_user_email', $config) ? $config['oauth_user_email'] : '';
        $config['oauth_client_id'] = array_key_exists('oauth_client_id', $config) ? $config['oauth_client_id'] : '';
        $config['oauth_client_secret'] = array_key_exists('oauth_client_secret', $config) ? $config['oauth_client_secret'] : '';
        $config['oauth_refresh_token'] = array_key_exists('oauth_refresh_token', $config) ? $config['oauth_refresh_token'] : '';

        $config['dkim_domain'] = array_key_exists('dkim_domain', $config) ? $config['dkim_domain'] : '';
        $config['dkim_private'] = array_key_exists('dkim_private', $config) ? $config['dkim_private'] : '';
        $config['dkim_private_string'] = array_key_exists('dkim_private_string', $config) ? $config['dkim_private_string'] : '';
        $config['dkim_selector'] = array_key_exists('dkim_selector', $config) ? $config['dkim_selector'] : '';
        $config['dkim_passphrase'] = array_key_exists('dkim_passphrase', $config) ? $config['dkim_passphrase'] : '';
        $config['dkim_identity'] = array_key_exists('dkim_identity', $config) ? $config['dkim_identity'] : '';

        $config['mailer_enabled'] = array_key_exists('mailer_enabled', $config) ? $config['mailer_enabled'] : false;
        $config['site_email'] = array_key_exists('site_email', $config) ? $config['site_email'] : '';
        $config['notification_email'] = array_key_exists('notification_email', $config) ? $config['notification_email'] : '';
        $config['cc_email'] = array_key_exists('cc_email', $config) ? $config['cc_email'] : '';
        $config['bcc_email'] = array_key_exists('bcc_email', $config) ? $config['bcc_email'] : '';

        // Read values from database stored settings, if there are any.

        $settings = $ci->settings->get(array(
            'email_useragent',
            'email_protocol',
            'email_mailpath',
            'email_smtp_host',
            'email_smtp_user',
            'email_smtp_pass',
            'email_smtp_port',
            'email_smtp_timeout',
            'email_smtp_crypto',
            'email_smtp_debug',
            'email_debug_output',
            'email_wordwrap',
            'email_wrapchars',
            'email_mailtype',
            'email_charset',
            'email_validate',
            'email_priority',
            'email_crlf',
            'email_newline',
            'email_bcc_batch_mode',
            'email_bcc_batch_size',
            'email_encoding',

            'email_smtp_auto_tls',
            'email_smtp_conn_options',

            'email_oauth_type',
            'email_oauth_user_email',
            'email_oauth_client_id',
            'email_oauth_client_secret',
            'email_oauth_refresh_token',

            'email_dkim_domain',
            'email_dkim_private',
            'email_dkim_private_string',
            'email_dkim_selector',
            'email_dkim_passphrase',
            'email_dkim_identity',

            'mailer_enabled',
            'site_email',
            'notification_email',
            'cc_email',
            'bcc_email',
        ));

        $config['useragent'] = isset($settings['email_useragent']) ? (string) $settings['email_useragent'] : $config['useragent'];
        $config['protocol'] = isset($settings['email_protocol']) ? (string) $settings['email_protocol'] : $config['protocol'];
        $config['mailpath'] = isset($settings['email_mailpath']) ? (string) $settings['email_mailpath'] : $config['mailpath'];
        $config['smtp_host'] = isset($settings['email_smtp_host']) ? (string) $settings['email_smtp_host'] : $config['smtp_host'];
        $config['smtp_user'] = isset($settings['email_smtp_user']) ? (string) $settings['email_smtp_user'] : $config['smtp_user'];
        $config['smtp_pass'] = isset($settings['email_smtp_pass']) ? (string) $settings['email_smtp_pass'] : $config['smtp_pass'];
        $config['smtp_port'] = isset($settings['email_smtp_port']) ? (int) $settings['email_smtp_port'] : $config['smtp_port'];
        $config['smtp_timeout'] = isset($settings['email_smtp_timeout']) ? (int) $settings['email_smtp_timeout'] : $config['smtp_timeout'];
        $config['smtp_crypto'] = isset($settings['email_smtp_crypto']) ? (string) $settings['email_smtp_crypto'] : $config['smtp_crypto'];
        $config['smtp_debug'] = isset($settings['email_smtp_debug']) ? (int) $settings['email_smtp_debug'] : $config['smtp_debug'];
        $config['debug_output'] = isset($settings['email_debug_output']) ? $settings['email_debug_output'] : $config['debug_output'];
        $config['wordwrap'] = isset($settings['email_wordwrap']) ? !empty($settings['email_wordwrap']) : $config['wordwrap'];
        $config['wrapchars'] = isset($settings['email_wrapchars']) ? (int) $settings['email_wrapchars'] : $config['wrapchars'];
        $config['mailtype'] = isset($settings['email_mailtype']) ? (string) $settings['email_mailtype'] : $config['mailtype'];
        $config['charset'] = isset($settings['email_charset']) ? (string) $settings['email_charset'] : $config['charset'];
        $config['validate'] = isset($settings['email_validate']) ? !empty($settings['email_validate']) : $config['validate'];
        $config['priority'] = array_key_exists('priority', $settings) ? (empty($settings['email_priority']) ? null : (int) $settings['email_priority']) : $config['priority'];
        $config['crlf'] = isset($settings['email_crlf']) ? (string) $settings['email_crlf'] : $config['crlf'];
        $config['newline'] = isset($settings['email_newline']) ? (string) $settings['email_newline'] : $config['newline'];
        $config['bcc_batch_mode'] = isset($settings['email_bcc_batch_mode']) ? !empty($settings['email_bcc_batch_mode']) : $config['bcc_batch_mode'];
        $config['bcc_batch_size'] = isset($settings['email_bcc_batch_size']) ? (int) $settings['email_bcc_batch_size'] : $config['bcc_batch_size'];
        $config['encoding'] = isset($settings['email_encoding']) ? (int) $settings['email_encoding'] : $config['encoding'];

        $config['smtp_auto_tls'] = isset($settings['email_smtp_auto_tls']) ? !empty($settings['email_smtp_auto_tls']) : $config['smtp_auto_tls'];
        $config['smtp_conn_options'] = isset($settings['email_smtp_conn_options']) ? $settings['email_smtp_conn_options'] : $config['smtp_conn_options'];

        if (empty($config['smtp_conn_options'])) {
            $config['smtp_conn_options'] = array();
        }

        $config['oauth_type'] = isset($settings['email_oauth_type']) ? (string) $settings['email_oauth_type'] : $config['oauth_type'];
        $config['oauth_user_email'] = isset($settings['email_oauth_user_email']) ? (string) $settings['email_oauth_user_email'] : $config['oauth_user_email'];
        $config['oauth_client_id'] = isset($settings['email_oauth_client_id']) ? (string) $settings['email_oauth_client_id'] : $config['oauth_client_id'];
        $config['oauth_client_secret'] = isset($settings['email_oauth_client_secret']) ? (string) $settings['email_oauth_client_secret'] : $config['oauth_client_secret'];
        $config['oauth_refresh_token'] = isset($settings['email_oauth_refresh_token']) ? (string) $settings['email_oauth_refresh_token'] : $config['oauth_refresh_token'];
        
        $config['dkim_domain'] = isset($settings['email_dkim_domain']) ? (string) $settings['email_dkim_domain'] : $config['dkim_domain'];
        $config['dkim_private'] = isset($settings['email_dkim_private']) ? (string) $settings['email_dkim_private'] : $config['dkim_private'];
        $config['dkim_private_string'] = isset($settings['email_dkim_private_string']) ? (string) $settings['email_dkim_private_string'] : $config['dkim_private_string'];
        $config['dkim_selector'] = isset($settings['email_dkim_selector']) ? (string) $settings['email_dkim_selector'] : $config['dkim_selector'];
        $config['dkim_passphrase'] = isset($settings['email_dkim_passphrase']) ? (string) $settings['email_dkim_passphrase'] : $config['dkim_passphrase'];
        $config['dkim_identity'] = isset($settings['email_dkim_identity']) ? (string) $settings['email_dkim_identity'] : $config['dkim_identity'];

        $config['mailer_enabled'] = isset($settings['mailer_enabled']) ? !empty($settings['mailer_enabled']) : $config['mailer_enabled'];
        $config['site_email'] = isset($settings['site_email']) ? (string) $settings['site_email'] : $config['site_email'];
        $config['notification_email'] = isset($settings['notification_email']) ? (string) $settings['notification_email'] : $config['notification_email'];
        $config['cc_email'] = isset($settings['cc_email']) ? (string) $settings['cc_email'] : $config['cc_email'];
        $config['bcc_email'] = isset($settings['bcc_email']) ? (string) $settings['bcc_email'] : $config['bcc_email'];

        return $config;
    }

}
