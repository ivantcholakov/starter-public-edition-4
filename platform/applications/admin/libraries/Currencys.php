<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Currencys
{

	var $display=array();

	public function __construct() 
	{
		$CI =& get_instance();
		$site = $CI->db->select("base_name, base_code, extra1_check, extra1_code, extra1_name, extra1_rate, extra2_check, extra2_code, extra2_name, extra2_rate, extra3_check, extra3_code, extra3_name, extra3_rate, extra4_check, extra4_code, extra4_name, extra4_rate, extra5_check, extra5_code, extra5_name, extra5_rate")
		->where("ID", 1)
		->get("currencys");
		
		if($site->num_rows() == 0) {
			$CI->template->error(
				"You are missing the site settings database row."
			);
		} else {
			$this->display = $site->row();
		}
	}

}

?>