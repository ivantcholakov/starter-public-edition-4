<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Common 
{

		public function replace_keywords($array, $message) 
    {
        foreach($array as $k=>$v) {
            $message = str_replace($k, $v, $message);
        }
        return $message;
    }

}

?>
