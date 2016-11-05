<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Welcome_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->lang->load('welcome');

        $this->registry->set('nav', 'home');
    }

    public function index() {

        // This is just a demo page, code is done in ad-hoc manner.

        $yes = '<span class="green text">Yes</span>';
        $no  = '<span class="red text">No</span>';

        // Collecting diagnostics data.

        $writable_folders = array(

            'platform/writable/' =>
                array(
                    'path' => WRITABLEPATH,
                    'is_writable' => NULL
                ),
            'platform/upload/' =>
                array(
                    'path' => PLATFORM_UPLOAD_PATH,
                    'is_writable' => NULL
                ),
            'www/upload/' =>
                array(
                    'path' => PUBLIC_UPLOAD_PATH,
                    'is_writable' => NULL
                ),
            'www/cache/' =>
                array(
                    'path' => PUBLIC_CACHE_PATH,
                    'is_writable' => NULL
                ),
        );

        foreach ($writable_folders as $key => $folder) {

            $writable_folders[$key]['is_writable'] = is_really_writable($folder['path']);
        }

        // Diagnostics data decoration.

        $diagnostics = array();

        //----------------------------------------------------------------------

        $diagnostics[] = '<strong>Writable folders check:</strong>';

        foreach ($writable_folders as $key => $folder) {

            if ($writable_folders[$key]['is_writable']) {

                $diagnostics[] = "$key - <span class=\"green text\">writable</span>";

            } else {

                $diagnostics[] = "$key - <span class=\"red text\">make it writable</span>";
            }
        }

        //----------------------------------------------------------------------

        $diagnostics[] = '<br /><strong>Mailer:</strong>';

        $mailer_enabled = (bool) $this->settings->get('mailer_enabled');

        if ($mailer_enabled) {

            $diagnostics[] = 'Mailer service - <span class="green text">enabled</span>';

        } else {

            $diagnostics[] = 'Mailer service - <span class="red text">disabled. Check $config[\'mailer_enabled\'] option within platform/core/common/config/config_site.php. Check also the mailer settings within platform/core/common/config/email.php.</span>';
        }

        //----------------------------------------------------------------------

        $diagnostics[] = '<br /><strong>UTF-8 support:</strong>';

        $diagnostics[] = 'IS_UTF8_CHARSET - '.(IS_UTF8_CHARSET ? $yes : $no);
        $diagnostics[] = 'MBSTRING_INSTALLED - '.(MBSTRING_INSTALLED ? $yes : $no);
        $diagnostics[] = 'ICONV_INSTALLED - '.(ICONV_INSTALLED ? $yes : $no);
        $diagnostics[] = 'PCRE_UTF8_INSTALLED - '.(PCRE_UTF8_INSTALLED ? $yes : $no);
        $diagnostics[] = 'INTL_INSTALLED (optional) - '.(INTL_INSTALLED ? $yes : $no);

        //----------------------------------------------------------------------

        $diagnostics[] = '<br /><strong>Cryptography support:</strong>';

        $diagnostics[] = '\'openssl\' installed - '.(extension_loaded('openssl') ? $yes : $no);

        if (version_compare(PHP_VERSION, '7.1.0-alpha', '<')) {
            $diagnostics[] = 'or \'mcrypt\' installed - '.(defined('MCRYPT_DEV_URANDOM') ? $yes : $no);
        }

        $random_bytes = $no;

        if (function_exists('random_bytes')) {

            try {
                $test = random_bytes(1);
                $random_bytes = $yes;
            }
            catch (Exception $e) {
                $random_bytes = '<span class="red text">'.$e->getMessage().'</span>';
            }
        }

        $diagnostics[] = 'random_bytes() - '.$random_bytes;

        //----------------------------------------------------------------------

        $diagnostics[] = '<br /><strong>Graphics:</strong>';

        $gd_installed = extension_loaded('gd');

        $gd_version = null;

        if ($gd_installed) {

            $gd_info = gd_info();

            if (isset($gd_info['GD Version'])) {
                $gd_version = $gd_info['GD Version'];
            }
        }

        $diagnostics[] = '\'gd\' installed - '.($gd_installed ? $yes.($gd_version != '' ? ', '.$gd_version : '') : $no);

        //----------------------------------------------------------------------

        $diagnostics[] = '<br /><strong>Communication:</strong>';

        $diagnostics[] = '\'curl\' (optional) - '.(function_exists('curl_init') ? $yes : $no);

        //----------------------------------------------------------------------

        $diagnostics = implode('<br />', $diagnostics);

        $this->template

            // This is the canonical URL for the home page only.
            // For the other pages create their corresponding canonical URLs,
            // for example site_url('contact-us'), etc.
            // See http://moz.com/learn/seo/canonicalization
            // See https://support.google.com/webmasters/answer/139066?hl=en
            ->set_canonical_url(site_url())

            ->set('diagnostics', $diagnostics)
            ->build('welcome_message');
    }

}
