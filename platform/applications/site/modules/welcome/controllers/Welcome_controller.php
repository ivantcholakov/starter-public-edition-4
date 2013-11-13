<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        // This is just a demo page, code is done in ad-hoc manner.

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

        $diagnostics = implode('<br />', $diagnostics);

        $this->template
            ->set('diagnostics', $diagnostics)
            ->build('welcome_message');
    }

}
