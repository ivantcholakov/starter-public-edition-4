<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('valid_email')) {

    // This function has been borrowed from PHPMailer Version 5.2.9.
    /**
     * Check that a string looks like an email address.
     * @param string $address The email address to check
     * @param string $patternselect A selector for the validation pattern to use :
     * * `auto` Pick strictest one automatically;
     * * `pcre8` Use the squiloople.com pattern, requires PCRE > 8.0, PHP >= 5.3.2, 5.2.14;
     * * `pcre` Use old PCRE implementation;
     * * `php` Use PHP built-in FILTER_VALIDATE_EMAIL; same as pcre8 but does not allow 'dotless' domains;
     * * `html5` Use the pattern given by the HTML5 spec for 'email' type form input elements.
     * * `noregex` Don't use a regex: super fast, really dumb.
     * @return boolean
     * @static
     * @access public
     */
    // Modified by Ivan Tcholakov, 24-DEC-2013.
    //public static function validateAddress($address, $patternselect = 'auto')
    //{
    function valid_email($address) {
        $patternselect = 'auto';
    //

        if (!$patternselect or $patternselect == 'auto') {
            //Check this constant first so it works when extension_loaded() is disabled by safe mode
            //Constant was added in PHP 5.2.4
            if (defined('PCRE_VERSION')) {
                //This pattern can get stuck in a recursive loop in PCRE <= 8.0.2
                if (version_compare(PCRE_VERSION, '8.0.3') >= 0) {
                    $patternselect = 'pcre8';
                } else {
                    $patternselect = 'pcre';
                }
            } elseif (function_exists('extension_loaded') and extension_loaded('pcre')) {
                //Fall back to older PCRE
                $patternselect = 'pcre';
            } else {
                //Filter_var appeared in PHP 5.2.0 and does not require the PCRE extension
                if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
                    $patternselect = 'php';
                } else {
                    $patternselect = 'noregex';
                }
            }
        }
        switch ($patternselect) {
            case 'pcre8':
                /**
                 * Uses the same RFC5322 regex on which FILTER_VALIDATE_EMAIL is based, but allows dotless domains.
                 * @link http://squiloople.com/2009/12/20/email-address-validation/
                 * @copyright 2009-2010 Michael Rushton
                 * Feel free to use and redistribute this code. But please keep this copyright notice.
                 */
                return (boolean)preg_match(
                    '/^(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){65,}@)' .
                    '((?>(?>(?>((?>(?>(?>\x0D\x0A)?[\t ])+|(?>[\t ]*\x0D\x0A)?[\t ]+)?)(\((?>(?2)' .
                    '(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)' .
                    '([!#-\'*+\/-9=?^-~-]+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*' .
                    '(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(?>([a-z0-9](?>[a-z0-9-]*[a-z0-9])?)' .
                    '(?>(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9]{1,4})(?>:(?6)){7}' .
                    '|(?!(?:.*[a-f0-9][:\]]){8,})((?6)(?>:(?6)){0,6})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:' .
                    '|(?!(?:.*[a-f0-9]:){6,})(?8)?::(?>((?6)(?>:(?6)){0,4}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?9)){3}))\])(?1)$/isD',
                    $address
                );
            case 'pcre':
                //An older regex that doesn't need a recent PCRE
                return (boolean)preg_match(
                    '/^(?!(?>"?(?>\\\[ -~]|[^"])"?){255,})(?!(?>"?(?>\\\[ -~]|[^"])"?){65,}@)(?>' .
                    '[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*")' .
                    '(?>\.(?>[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*"))*' .
                    '@(?>(?![a-z0-9-]{64,})(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>\.(?![a-z0-9-]{64,})' .
                    '(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)){0,126}|\[(?:(?>IPv6:(?>(?>[a-f0-9]{1,4})(?>:' .
                    '[a-f0-9]{1,4}){7}|(?!(?:.*[a-f0-9][:\]]){8,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?' .
                    '::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?))|(?>(?>IPv6:(?>[a-f0-9]{1,4}(?>:' .
                    '[a-f0-9]{1,4}){5}:|(?!(?:.*[a-f0-9]:){6,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4})?' .
                    '::(?>(?:[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4}):)?))?(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\])$/isD',
                    $address
                );
            case 'html5':
                /**
                 * This is the pattern used in the HTML5 spec for validation of 'email' type form input elements.
                 * @link http://www.whatwg.org/specs/web-apps/current-work/#e-mail-state-(type=email)
                 */
                return (boolean)preg_match(
                    '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}' .
                    '[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/sD',
                    $address
                );
            case 'noregex':
                //No PCRE! Do something _very_ approximate!
                //Check the address is 3 chars or longer and contains an @ that's not the first or last char
                return (strlen($address) >= 3
                    and strpos($address, '@') >= 1
                    and strpos($address, '@') != strlen($address) - 1);
            case 'php':
            default:
                return (boolean)filter_var($address, FILTER_VALIDATE_EMAIL);
        }
    }

}

if (!function_exists('name_email_format')) {

    function name_email_format($name, $email) {
        return $name.' <'.$email.'>';
    }

}

if (!function_exists('set_email_settings')) {

    // Sets email settings within database. Use this function within admin panel
    // for making possible some chosen email settings to be edited through user interface.
    // See also the complement function get_email_settings().
    function set_email_settings($config) {

        $ci = get_instance();

        $ci->load
            ->library('settings')
            ->library('password')
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
            $ci->settings->set('email_priority', (int) $config['priority']);
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

    }

}

if (!function_exists('get_email_settings')) {

    // Returns all the email settings. The settings are stored within database,
    // missing in database values are to be taken from the configuration file.
    function get_email_settings() {

        $ci = get_instance();

        $ci->load
            ->library('settings')
            ->library('password')
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
        $config['wordwrap'] = array_key_exists('wordwrap', $config) ? $config['wordwrap'] : true;
        $config['wrapchars'] = array_key_exists('wrapchars', $config) ? $config['wrapchars'] : 76;
        $config['mailtype'] = array_key_exists('mailtype', $config) ? $config['mailtype'] : 'html';
        $config['charset'] = array_key_exists('charset', $config) ? $config['charset'] : 'utf-8';
        $config['validate'] = array_key_exists('validate', $config) ? $config['validate'] : true;
        $config['priority'] = array_key_exists('priority', $config) ? $config['priority'] : 3;
        $config['crlf'] = array_key_exists('crlf', $config) ? $config['crlf'] : "\n";
        $config['newline'] = array_key_exists('newline', $config) ? $config['newline'] : "\n";
        $config['bcc_batch_mode'] = array_key_exists('bcc_batch_mode', $config) ? $config['bcc_batch_mode'] : false;
        $config['bcc_batch_size'] = array_key_exists('bcc_batch_size', $config) ? $config['bcc_batch_size'] : 200;
        $config['encoding'] = array_key_exists('encoding', $config) ? $config['encoding'] : '8bit';

        $config['mailer_enabled'] = array_key_exists('mailer_enabled', $config) ? $config['mailer_enabled'] : false;
        $config['site_email'] = array_key_exists('site_email', $config) ? $config['site_email'] : '';
        $config['notification_email'] = array_key_exists('notification_email', $config) ? $config['notification_email'] : '';
        $config['cc_email'] = array_key_exists('cc_email', $config) ? $config['cc_email'] : '';

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

            'mailer_enabled',
            'site_email',
            'notification_email',
            'cc_email',
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
        $config['wordwrap'] = isset($settings['email_wordwrap']) ? !empty($settings['email_wordwrap']) : $config['wordwrap'];
        $config['wrapchars'] = isset($settings['email_wrapchars']) ? (int) $settings['email_wrapchars'] : $config['wrapchars'];
        $config['mailtype'] = isset($settings['email_mailtype']) ? (string) $settings['email_mailtype'] : $config['mailtype'];
        $config['charset'] = isset($settings['email_charset']) ? (string) $settings['email_charset'] : $config['charset'];
        $config['validate'] = isset($settings['email_validate']) ? !empty($settings['email_validate']) : $config['validate'];
        $config['priority'] = isset($settings['email_priority']) ? (int) $settings['email_priority'] : $config['priority'];
        $config['crlf'] = isset($settings['email_crlf']) ? (string) $settings['email_crlf'] : $config['crlf'];
        $config['newline'] = isset($settings['email_newline']) ? (string) $settings['email_newline'] : $config['newline'];
        $config['bcc_batch_mode'] = isset($settings['email_bcc_batch_mode']) ? !empty($settings['email_bcc_batch_mode']) : $config['bcc_batch_mode'];
        $config['bcc_batch_size'] = isset($settings['email_bcc_batch_size']) ? (int) $settings['email_bcc_batch_size'] : $config['bcc_batch_size'];
        $config['encoding'] = isset($settings['email_encoding']) ? (int) $settings['email_encoding'] : $config['encoding'];

        $config['mailer_enabled'] = isset($settings['mailer_enabled']) ? !empty($settings['mailer_enabled']) : $config['mailer_enabled'];
        $config['site_email'] = isset($settings['site_email']) ? (string) $settings['site_email'] : $config['site_email'];
        $config['notification_email'] = isset($settings['notification_email']) ? (string) $settings['notification_email'] : $config['notification_email'];
        $config['cc_email'] = isset($settings['cc_email']) ? (string) $settings['cc_email'] : $config['cc_email'];

        return $config;
    }

}
