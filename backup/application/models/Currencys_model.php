<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Currencys_model extends CI_Model {

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
        $this->_db = 'currencys';
    }
  
    function updateCurrencys($data) 
	{
		$this->db->where("ID", 1)->update("currencys", $data);
	}
  
    function get_currencys()
	{
	   return $this->db->get("currencys");
	}

}