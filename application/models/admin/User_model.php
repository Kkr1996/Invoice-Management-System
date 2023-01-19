<?php
	class User_model extends CI_Model{

		public function add_user($data){
			$this->db->insert('ci_users', $data);
			return true;
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_users(){

			$this->db->select('*');
            $this->db->order_by('username','asc');
			$this->db->where('is_admin',0);
           
			return $this->db->get('ci_users')->result_array();
		}

			public function all_users(){
			 			$this->db->order_by('id','desc');
				$query = $this->db->get('ci_users');
				return $result = $query->result_array();
			}	
        
            public function getcustomerscount(){
			 		
				return $result = $this->db->count_all_results('ci_users');
			}
		//---------------------------------------------------
		// Get user detial by ID
		public function get_user_by_id($id){
			$query = $this->db->get_where('ci_users', array('id' => $id));
			return $result = $query->row_array();
		}	
        
        public function get_user_document_id($id){
			$query = $this->db->get_where('ci_services_form', array('userid' => $id));
			return $result = $query->result_array();
		}
        public function count_bycompany_id($cid){
                                 $this->db->where('company_id',$cid);
             return $result    = $this->db->count_all_results('ci_users');
        }
		

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_users', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_users');
		} 
		
        public function get_users_files($id){
            
			$query = $this->db->get_where('ci_uploaded_files', array('userid' => $id));
			
			return $result = $query->result_array();
		}
        public function get_customer_by_company_id($cid)
        {
            $this ->db->select('*');
            $this ->db->from('ci_users');
            $this ->db->where('company_id',$cid);
            $query = $this->db->get();
            return $result = $query->result();
        }
         public function get_customerby_cusid($cus_id)
        {
             
             $query = $this->db->get_where('ci_users', array('id' => $cus_id));
             return $result = $query->row_array();
            
        }
		

	}

?>