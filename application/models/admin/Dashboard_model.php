<?php
	class Dashboard_model extends CI_Model{

		public function get_all_users(){
			return $this->db->count_all('ci_users');
		}
		public function get_active_users(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('ci_users');
		}
		public function get_deactive_users(){
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('ci_users');
		}
        
        public function insertdocument($data){
            $this->db->insert('users_document', $data);
            return true;
        }
        public function lastdocument(){
            $query = $this->db->query("SELECT * FROM users_document ORDER BY id DESC");
            $result = $query->result_array();
            return $result;
            
        }
        public function getimagepath($id){
            $this->db->where('id', $id);
            $query = $this->db->get('users_document');
            return $result = $query->result_array();
        }
    
	}

?>
