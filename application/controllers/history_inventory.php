<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class history_inventory extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model("global_model");
		$this->load->model("history/history_model");
	}


	public function index()
	{
		priv("view");
		$data["data"] = $this->history_model->inventory();
        // echo "<pre>"; print_r($data); die();
		$data["page"]	="history/inventory/view";
		$data["title"]	= "History Inventory";
		// echo"<pre>"; print_r($data['data']); die();
		$this->load->view('admin',$data);
	}
}
