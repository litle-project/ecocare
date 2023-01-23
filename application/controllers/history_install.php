<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class history_install extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model("global_model");
		$this->load->model("history/history_model");
	}


	public function index()
	{
		priv("view");
		$data["data"] = $this->history_model->install();
        // echo "<pre>"; print_r($data); die();
		$data["page"]	="history/install/view";
		$data["title"]	= "History Install";
		// echo"<pre>"; print_r($data['data']); die();
		$this->load->view('admin',$data);
	}

    public function detail($id='')
    {
        priv("view");
        $data["data"] = $this->history_model->install($id);
        // echo "<pre>"; print_r($data); die();
        $data["page"]	="history/install/view";
        $data["title"]	= "History Install";
        // echo"<pre>"; print_r($data['data']); die();
        $this->load->view('admin',$data);
    }
}
