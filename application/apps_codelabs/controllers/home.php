<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("sliding_model");
		$this->load->model("content_model");
		$this->load->model("config_model");
		$this->load->model("login_admin_model");
		
	}	
	public function index()
	{
		$con=$this->login_admin_model->get_config();
                $config=$con->result_array();
		$temp=$config[0]["type"];
		$data["config"]=$config;
		$data["seo"]=$this->config_model->get_front("home");
		$data["data"]=$this->sliding_model->get_data();
		$data["get_data"]=$this->content_model->get_site("1");
		$data["page"]="home";
		$this->load->view($temp,$data);
	}
	
	
	
}
