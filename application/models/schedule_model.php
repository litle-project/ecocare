<?php

class Schedule_model extends CI_Model
{
    
        
    public function get_data($id=''){
        $this->db->select('*');
        $this->db->from('contract');
        if (!empty($id)) {
            $this->db->where('contract_id', $id);
        }
        $this->db->order_by('contract_id', 'desc');
        $query = $this->db->get()->result_array();
        foreach ($query as $key) {
            $array['contract_id']       = $key['contract_id'];
            $array['contract_no']       = $key['contract_no'];
            $array['contract_period']   = $key['contract_period'];
            $array['contract_purpose']  = $key['contract_purpose'];
            $array['assign_status']     = $key['assign_status'];
            $array['install_date']      = $key['install_date'];
            $array['contract_date']     = $key['contract_date'];
            $array['working_day']       = $key['working_day'];
            $array['contract_note']     = $key['contract_note'];
            if($key['assign_status'] == '1'){
                $array['installer'] = $this->check_installer($key['contract_id']);
            }else{
                $array['installer'] = "";
            }
            $all[] = $array;
        }
        if (!empty($all)) {
            return $all;
        }else{
            return array();
        }
    }

    public function check_installer($id){
        $this->db->select('*');
        $this->db->from('contract_installer a');
        $this->db->join('teknisi_master b', 'b.teknisi_id = a.installer_id', 'left');
        $this->db->where('a.deleted', '0');
        $this->db->where('a.contract_id', $id);
        $this->db->order_by('a.contract_id', 'desc');
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_data_schedule($id)
    {
        $this->db->select("*");
        $this->db->from("contract_schedule a");
        $this->db->join("contract b", "b.contract_id = a.contract_id");
        $this->db->where("a.contract_id", $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}