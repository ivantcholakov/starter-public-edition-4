<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Welcome_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->lang->load('welcome');
    }

    public function index() {

        // This is just a demo page, code is done in ad-hoc manner.

        $yes = '<span style="color: green;">Yes</span>';
        $no  = '<span style="color: red;">No</span>';

        // Collecting diagnostics data.

        $writable_folders = array(

            'platform/writable/' =>
                array(
                    'path' => WRITABLEPATH,
                    'is_writable' => NULL
                ),
        );

        foreach ($writable_folders as $key => $folder) {

            $writable_folders[$key]['is_writable'] = is_really_writable($folder['path']);
        }

        $mailer_enabled = (bool) $this->settings->get('mailer_enabled');

        // Diagnostics data decoration.

        $diagnostics = array();

        $diagnostics[] = '<strong>Writable folders check:</strong>';

        foreach ($writable_folders as $key => $folder) {
            
            if ($writable_folders[$key]['is_writable']) {

                $diagnostics[] = "$key - <span style=\"color: green\">writable</span>";

            } else {

                $diagnostics[] = "$key - <span style=\"color: red\">make it writable</span>";
            }
        }

        $diagnostics[] = '<br /><strong>Mailer:</strong>';

        if ($mailer_enabled) {

            $diagnostics[] = 'Mailer service - <span style="color: green">enabled</span>';

        } else {

            $diagnostics[] = 'Mailer service - <span style="color: red">disabled. Check $config[\'mailer_enabled\'] option within platform/core/common/config/config_site.php. Check also the mailer settings within platform/core/common/config/email.php.</span>';
        }

        $diagnostics[] = '<br /><strong>UTF-8 support:</strong>';
        $diagnostics[] = 'IS_UTF8_CHARSET - '.(IS_UTF8_CHARSET ? $yes : $no);
        $diagnostics[] = 'MBSTRING_INSTALLED - '.(MBSTRING_INSTALLED ? $yes : $no);
        $diagnostics[] = 'ICONV_INSTALLED - '.(ICONV_INSTALLED ? $yes : $no);
        $diagnostics[] = 'PCRE_UTF8_INSTALLED - '.(PCRE_UTF8_INSTALLED ? $yes : $no);

        $diagnostics = implode('<br />', $diagnostics);

        $this->template
            ->set('diagnostics', $diagnostics)
            ->build('welcome_message');
    }

}
