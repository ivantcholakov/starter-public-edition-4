<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * All  > PUBLIC <  AJAX functions should go in here
 *
 * CSRF protection has been disabled for this controller in the config file
 *
 * IMPORTANT: DO NOT DO ANY WRITEBACKS FROM HERE!!! For retrieving data only.
 */
class Ajax extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }


    /**
	 * Change session language - user selected
     */
	function set_session_language()
	{
        $language = $this->input->post('language');
        $this->session->language = $language;
        $results['success'] = TRUE;
        echo json_encode($results);
        die();
	}

}
