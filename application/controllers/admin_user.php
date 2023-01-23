<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("admin_user_model");
		$this->load->model('Aktiviti_log_model');

		$page=$this->uri->segment(2);

		if($page=='') priv('view');
		else if($page=='add') priv('add');
		else if($page=='edit') priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');

	}


	public function index()
	{
		priv("view");
		$data["page"]="user/view";
		$data["title"]="Manage User";
		$data["get_user"]=$this->admin_user_model->get_user();
		$this->load->view('admin',$data);
	}

	function add(){
		priv("add");
		$branch_id="";
		if($this->input->post()){
			$post=$this->input->post();

			if ($post["priv"] != "1") {
				$branch_id=$post["branch_id"];
			}

			$input=array(
				"admin_username" => $post["username"],
				"admin_password" => md5($post["password1"]),
				"admin_email" => $post["email"],
				"admin_name" => $post["name"],
				"admin_photo" => "",
				"user_group_id" => $post["priv"],
				"created_date" => date("Y-m-d H:i:s"),
				"created_by" => $this->session->userdata("admin_id"),
			);

			$this->db->insert("admin",$input);
			$action="Create User Name ".$post["username"];
			$this->Aktiviti_log_model->create($action);
			redirect("admin_user");
		}

		$data["page"]="user/add";
		$data["title"]="Add User";
		$data["priv"]=$this->admin_user_model->get_priv();
		$this->load->view('admin',$data);
	}

	function delete($id){
		priv("delete");

		$data=array(
					"deleted" => "1",
					);
		$this->db->where("admin_id",$id);
		$this->db->update("admin",$data);

		$action="Delete User ID ".$id;
		$this->Aktiviti_log_model->create($action);

		redirect("admin_user");

	}

	function edit($id){
		priv("edit");
		$branch_id="";
		if($this->session->userdata("user_group_id")>1){
			$id=$this->session->userdata("admin_id");
		}
		if($this->input->post()){
			$post=$this->input->post();


			if($post["pass_status"]==1){
				$input["admin_password"]=md5($post["password1"]);
			}

			if($post["priv"]=="1"):
				$branch_id="";
			else:
				$branch_id=$post["branch_id"];
			endif;

				$input["admin_username"]=$post["username"];
				$input["admin_email"]=$post["email"];
				$input["admin_name"]=$post["name"];
				$input["user_group_id"]=$post["priv"];
				//$input["branch_id"]=$branch_id;
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");


				$this->db->where("admin_id",$id);
				$this->db->update("admin",$input);

				$action="Edit User". $post["username"];
				$this->Aktiviti_log_model->create($action);


			redirect("admin_user");
		}

		$data["page"]="user/edit";
		$data["title"]="Edit User";
		$data["get_user"]=$this->admin_user_model->get_user($id);

		//print_r($data["get_user"]);
		//echo $data["get_user"][0]["user_group_id"];
		/*if($data["get_user"][0]["user_group_id"]>1){
			$data["restaurant"]=$this->admin_user_model->rest($data["get_user"][0]["restaurant_location_id"]);

		}
		$data["rest"]=$this->admin_user_model->get_rest();*/
		$data["priv"]=$this->admin_user_model->get_priv();
		//$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}

	function get_loc(){
		$id=$this->input->post("rest_id");
		$this->db->where("deleted","0");
		$this->db->where("restaurant_id",$id);
		$query=$this->db->get("restaurant_location");
		echo "<option value=''>Please Select</option>";
		foreach($query->result_array() as $row){
			echo "<option value='".$row["restaurant_location_id"]."'>".$row["restaurant_location_desc"]."</option>";
		}


	}


	function image_resize($image){
			$this->load->library('image_lib');
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/user/'.$image.'';
			$config2['new_image'] = './media/user/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 400;
			$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}




}
