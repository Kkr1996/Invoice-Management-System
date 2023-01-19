<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model{

	public function get_all_services(){
			     //$this->db->from('services');
		$query = $this->db->get('services');
		return $result = $query->result_array();
	}
	//--------------------------------------------------------------------
	public function update_user($data){
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
	//-----------------------------------------------------
	function get_admin_roles()
	{
		$this->db->from('ci_admin_roles');
		$this->db->where('admin_role_status',1);
		$query=$this->db->get();
		return $query->result_array();
	}
    public function get_document_download($id){

            $this->db->where('member_id', $id);
             $query = $this->db->get('ci_users');
			return $result = $query->result_array();
    }        

    
    public function get_blogs_slug($slug){

             $this->db->where('slug', $slug);
             $query = $this->db->get('blogs');
			 return $result = $query->result_array();
    }
	//-----------------------------------------------------
	function get_admin_by_id($id)
	{
	    
		$this->db->from('ci_admin');
		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_admin.admin_role_id');
		$this->db->where('admin_id',$id);
		$query=$this->db->get();
		return $query->row_array();
		
	}
    public function get_allblogs($slugs){
        $this->db->from('blogs');    
		$this->db->where('slug !=',$slugs);
		$query=$this->db->get();
		return $query->result_array();
        
    }    
    public function get_allblogs_grid(){
        $this->db->from('blogs');    
		$query=$this->db->get();
		return $query->result_array();
        
    }

	//-----------------------------------------------------
	function get_all()
	{

		$this->db->from('ci_admin');

		$this->db->join('ci_admin_roles','ci_admin_roles.admin_role_id=ci_admin.admin_role_id');

		if($this->session->userdata('filter_type')!='')

        $this->db->where('ci_admin.admin_role_id',$this->session->userdata('filter_type'));

		if($this->session->userdata('filter_status')!='')

        $this->db->where('ci_admin.is_active',$this->session->userdata('filter_status'));
		$filterData = $this->session->userdata('filter_keyword');

		$this->db->like('ci_admin_roles.admin_role_title',$filterData);
		$this->db->or_like('ci_admin.firstname',$filterData);
		$this->db->or_like('ci_admin.lastname',$filterData);
		$this->db->or_like('ci_admin.email',$filterData);
		$this->db->or_like('ci_admin.mobile_no',$filterData);
		$this->db->or_like('ci_admin.username',$filterData);

		$this->db->where('ci_admin.is_supper !=', 1);

		$this->db->order_by('ci_admin.admin_id','desc');

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}

		return $module;
	}

	//-----------------------------------------------------
    public function add_admin($data){
        $this->db->insert('ci_admin', $data);
        return true;
    }
    public function add_token($data){
        $this->db->insert('help', $data);
        return true;
    }

	//---------------------------------------------------
	// Edit Admin Record
    public function edit_admin($data, $id){
        $this->db->where('admin_id', $id);
        $this->db->update('ci_admin', $data);
        return true;
    }  
    
    public function edit_help($data, $id){
        $this->db->where('id', $id);
        $this->db->update('help', $data);
        return true;
    }    
    
    public function edit_expertedit($data, $id){
        $this->db->where('id', $id);
        $this->db->update('expertcall', $data);
        return true;
    }
    
    

	//-----------------------------------------------------
    function change_status()
    {		
        $this->db->set('is_active',$this->input->post('status'));
        $this->db->where('admin_id',$this->input->post('id'));
        $this->db->update('ci_admin');
    } 

	//-----------------------------------------------------
    function delete($id)
    {		
        $this->db->where('admin_id',$id);
        $this->db->delete('ci_admin');
    } 


    public function add_contact_query($data){
        $this->db->insert('ci_contact', $data);
        return true;
    }
    
    public function get_all_help(){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        return $this->db->get('help')->result_array(); 
    }    
    
    public function get_all_expercall(){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        return $this->db->get('expertcall')->result_array(); 
    }
    
     public function add_expertcall($data){
        $this->db->insert('expertcall', $data);
        return true;
    }    
    
    public function get_all_expertcall(){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        return $this->db->get('expertcall')->result_array(); 
    }  
    
     public function get_expertcall_by_id($id){
     	$query = $this->db->get_where('help', array('id' => $id));
		return $result = $query->row_array();  
    }    
    
    public function get_expertedit_by_id($id){
     	$query = $this->db->get_where('expertcall', array('id' => $id));
		return $result = $query->row_array();  
    } 
    public function lastdocument(){
    $query = $this->db->query("SELECT * FROM users_document ORDER BY id DESC LIMIT 1");
    $result = $query->result_array();
    return $result;

    }
    public function get_all_download(){
         $query = $this->db->query("SELECT * FROM users_document ORDER BY id DESC");
         $result = $query->result_array();
         return $result;
    }    
     
    
   public function getuser_files($id){
    
    die();
		$query = $this->db->get_where('ci_uploaded_files', array('userid' => $id));
		return $result = $query->row_array();
	}
    
}

?>