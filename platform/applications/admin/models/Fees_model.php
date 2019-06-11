<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fees_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'fees';
    }
  
    function updateFees($data) 
	{
		$this->db->where("ID", 1)->update("fees", $data);
	}
  
    function get_fees()
	{
		return $this->db->get("fees");
	}

}