<?php if (! defined('BASEPATH'))exit('No direct script access allowed');

class Login_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_admin_model");
    }

    public function index() {
        $data["title"] = "Ecocare CMS";
        $this->load->view('login_admin', $data);
    }

    public function login_check() {
        echo "<pre>";
        print_r($this->input->post());
        die();
    }
}
