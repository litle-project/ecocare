<?php

class Contract_lost extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
		$this->load->model('contract_lost_model');
	}
	
	public function index()
	{
		priv("view");
		$data["data"] 	= $this->contract_lost_model->get_data();
		// print_r($data['data']); die();
		$data["page"]	= "contract/lost/view";
		$data["title"]	= "Contract Product Lost List";
		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");
		$data["data"] 		= $this->contract_lost_model->get_data_detail($id);
		// echo"<pre>"; print_r($data['data']); die();
		$data['product']	= $this->contract_lost_model->get_data_product($id);
		$data['teknisi']	= $this->contract_lost_model->get_data_teknisi($id);
		$data["page"]		= "contract/lost/detail";
		$data["title"]		= "Contract Product Lost List";
		$this->load->view('admin',$data);
	}

	function print_ba($contract_id) {
    	priv("view");
        $data["print"] 		= FALSE;
        $pdf 				= $this->input->post('pdf');
        $data["title"]		= "Berita Acara Kehilangan";
		$data["page"]		= "contract/lost/print_bak";	    
		$data["data"]		= $this->contract_lost_model->get_data_detail($contract_id);
		$data["teknisi"]	= $this->contract_lost_model->get_data_teknisi($contract_id);
		$data['product']	= $this->contract_lost_model->get_data_product($contract_id);

        if (($pdf)) {
            $data["print"] = TRUE;
    		$data["data"]		= $this->contract_lost_model->get_data_detail($contract_id);
			$data["teknisi"]	= $this->contract_lost_model->get_data_teknisi($contract_id);
			$data['product']	= $this->contract_lost_model->get_data_product($contract_id);
            $this->_to_pdf($data);
        }
		$this->load->view("admin",$data);
    }

    function _to_pdf($all_data = array()) {
        $this->load->library('pdf_exporter', '', 'pdf');
        $view = $this->load->view('admin/'.$all_data["page"], $all_data, TRUE);
        $this->pdf->output_pdf($view, $all_data["title"] . '.pdf');
        // print_r($view);
        // die();
    }
}