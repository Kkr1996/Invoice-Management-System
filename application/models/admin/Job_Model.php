<?php

class Job_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------

	//-----------------------------------------------------

	public function all_job(){
		        $this->db->order_by('id','desc');
		$query = $this->db->get('ci_job');
		return $result = $query->result_array();
	}
    public function all_job_active(){
		         $this->db->order_by('id','desc');
                 $this->db->where('status','published');
		$query = $this->db->get('ci_job');
		return $result = $query->result_array();
	}	

    public function all_job_invoice(){
		         $this->db->order_by('id','desc');
                 $this->db->where('status','draft');
		$query = $this->db->get('ci_job');
		return $result = $query->result_array();
	}
    
    public function getjobscount(){
         return $result = $this->db->count_all_results('ci_job');
    }
	public function add($data){
		$result = $this->db->insert('ci_job', $data);
        return $this->db->insert_id();	
	}
	public function edit_job($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_job', $data);
		return true;
	}
	public function get_job_id($id){
		$query = $this->db->get_where('ci_job', array('id' => $id));
		return $result = $query->row_array();
	}	

	
	public function get_job_by_job_id($id){
		$this->db->where('jobid',$id);
		$query = $this->db->get('ci_job');
		return $result = $query->result_array();
	}
	public function get_job_by_job_id_manifest($id){
		$this->db->where('jobid',$id);
		$query = $this->db->get('ci_job');
		return $result = $query->row_array();
	}
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_job', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}	
	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_job', array('slug' => $slug));
		return $result = $query->row_array()['name'];
	}
	public function get_job_name_by_id($id){
		$query = $this->db->get_where('ci_job', array('jobid' => $id));
		return $result = $query->row_array()['name'];
	}
    
    public function count_bycompany_id($cid){
                             $this->db->where('company_id',$cid);
         return $result    = $this->db->count_all_results('ci_job');
    }   
    public function get_job_by_company_id($cid)
    {
        $this ->db->select('*');
        $this ->db->from('ci_job');
        $this ->db->where('status','active');
        $this ->db->where('company_id',$cid);
        $query = $this->db->get();
        return $result = $query->result();
        
    }
    public function get_descriptions_byjobid($jobid){
        $query = $this->db->get_where('ci_job', array('jobid' =>$jobid));
        return $result = $query->row_array();
    }  
    
    public function count_job_status(){
        
        $statusArray=array('active','processing','completed');
        $status_record=array(
            "active" =>0,
            "processing"=>0,
            "completed"=>0,
        );
        foreach($statusArray as $status)
        {
            
          $query = $this->db->get_where('ci_job', array('status' =>$status));   
          $result =  $query->num_rows();
          $status_record[$status]=  $result; 
         
        }
        return $status_record;
       
    }  
    
}
?>