<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Get_api{
	
	
	
	
	
	public function get_item($type="all",$id=""){
		$url = "http://codelabsid.com/auction_cms/api/item/".$type."/".$id;
		$json = file_get_contents($url);
		$json_data = json_decode($json, true);
		
		return $json_data;
	}
	
	
		
	
	
	
	
}