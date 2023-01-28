<?php if (! defined('BASEPATH'))exit('No direct script access allowed');


class Login_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_admin_model");
    }

    public function index() {
        $data["title"] = "Ecocare CMS";
        $this->load->view('login_admin', $data);
    }

    public function login_check() {
		if ($this->input->post()) {
			$post=$this->input->post();
			$check=$this->login_admin_model->login_check($post);
			$conn=$this->login_admin_model->get_config();
			$num=$check->num_rows();

			if ($num==1) {
				$ck=$check->row_array();
				$ck["admin_password"]="";
				$ck["logged_in"]=true;
				$this->session->set_userdata($ck);
				$co=$conn->row_array();
				$this->session->set_userdata($co);

				redirect("admin");
			} else {
				$con = $conn->result_array();

				if ($post["username"]==$con[0]["username"]) {
					if (md5($post["password"])==$con[0]["password"]) {
						$co=$conn->row_array();

						$this->session->set_userdata($co);
						redirect("config");
					}
				}

               redirect("login_admin");
			}
		}
	}


	public function logout() {
		$this->session->sess_destroy();

		redirect("login_admin");
	}
}
