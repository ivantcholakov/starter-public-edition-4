<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Page_hits_controller extends Playground_Base_Controller {

    protected $demo_ok = false;
    protected $demo_error_message;

    public function __construct() {

        parent::__construct();

        $driver_ok = extension_loaded('pdo_sqlite');
        $database_directory = APPPATH.'demo_data/';
        $database_file = $database_directory.'demo.sqlite';
        $database_file_exists = is_file($database_file);
        $database_directory_writable = false;
        $database_file_writable = false;

        if ($database_file_exists) {
            $database_directory_writable = is_really_writable($database_directory);
            $database_file_writable = is_really_writable($database_file);
        }

        if (!$driver_ok) {

            $this->demo_error_message = 'pdo_sqlite database driver is needed for this demo to work.';

        } elseif (!$database_file_exists) {

            $this->demo_error_message = 'The file demo_data/demo.sqlite does not exist.';

        } elseif (!$database_directory_writable) {

            $this->demo_error_message = 'The directory demo_data/ is not writable.';

        } elseif (!$database_file_writable) {

            $this->demo_error_message = 'The file demo_data/demo.sqlite is not writable.';

        } else {

            $this->demo_ok = true;
        }

        if ($this->demo_ok) {

            $this->load
                ->database()
                ->model('page_hits')
            ;
        }

        $title = 'Page Visitors Counter Demo';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/page-hits'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $visits = 0;
        $unique_visitors = 0;

        if ($this->demo_ok) {

            $page_id = 'playground_page_hits_demo'; // Could be for example 'page_12', 'category_5', 'product_1837', etc.

            // Record this page preview.
            $this->page_hits->add_hit($page_id);

            // Read the counters.
            $visits = $this->page_hits->get_hits($page_id);
            $unique_visitors = $this->page_hits->get_hits($page_id, true);
        }

        $this->template
            ->set('demo_ok', $this->demo_ok)
            ->set('demo_error_message', $this->demo_error_message)
            ->set('visits', $visits)
            ->set('unique_visitors', $unique_visitors)
            ->build('page_hits');
    }

}
