<?phpclass Api_price_list_model extends CI_Controller{		function get_data($id,$limit,$offset){				$this->db->select("*");		$this->db->from("treatment a");		$this->db->join("treatment_price b","b.treatment_id=a.treatment_id");		$this->db->join("branch c","c.branch_id=b.branch_id");				$this->db->where("b.branch_id",$id);								$this->db->limit($limit,$offset);					$this->db->where("a.deleted","0");		$this->db->where("b.deleted","0");		$query=$this->db->get();				return $query->result_array();	}		function get_branch($id){		$this->db->where("deleted","0");				$this->db->where("branch_name",$id);					$query=$this->db->get("branch");				return $query->row_array();	}		}