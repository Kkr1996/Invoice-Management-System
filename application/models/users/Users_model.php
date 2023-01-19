<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

	public function service_query_form($id){

		$this->db->from('ci_services_form');
		$this->db->where('userid', $id);

		$query = $this->db->get();
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			
		        return $result = $query->result_array();
		    }
		
	}

	//--------------------------------------------------------------------
	public function register($data){
        
		$this->db->insert('ci_users', $data);
		return true;
        
        
	}
	public function all_users(){
		$query = $this->db->get('ci_users');
		return $result = $query->result_array();
	}
	//--------------------------------------------------------------------


    
      public function confirmation($userid)
      {
          $this->db->where('member_id',$userid);

          $this->db->set('is_verify',1);
          return   $this->db->update('ci_users');

      }
    //--------------------------------------------------------------------
	public function get_admin_detail(){
		$id = $this->session->userdata('admin_id');
		$query = $this->db->get_where('ci_admin', array('admin_id' => $id));
		return $result = $query->row_array();
	}

	//--------------------------------------------------------------------
	public function update_admin($data){
		$id = $this->session->userdata('admin_id');
		$this->db->where('admin_id', $id);
		$this->db->update('ci_admin', $data);
		return true;
	}

	//--------------------------------------------------------------------
	public function change_pwd($data, $id){
		$this->db->where('admin_id', $id);
		$this->db->update('ci_admin', $data);
		return true;
	}

}

?>