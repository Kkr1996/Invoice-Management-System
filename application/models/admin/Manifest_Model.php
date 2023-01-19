<?php

class Manifest_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------

	//-----------------------------------------------------
	public function all_manifest_by_job_id($id){

			$this->db->order_by('id','desc');
			         $this->db->where('job_id',$id);
			$query = $this->db->get('manifesto');
			return $result = $query->result_array();
	}



	public function get_company_info_by_job_id($id){

	     $query = $this->db->get_where('ci_job', array('jobid' => $id));
	    	return $result = $query->row_array()['company_id'];


	}

	public function all_job(){
		        $this->db->order_by('id','desc');
		$query = $this->db->get('ci_job');
		return $result = $query->result_array();
	}
     public function all_manifest(){
		        $this->db->order_by('id','desc');
		$query = $this->db->get('manifesto');
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
		$result = $this->db->insert('manifesto', $data);
        return $this->db->insert_id();	
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('manifesto', $data);
		return true;
	}
	public function get_manifest_id($id){
		$query = $this->db->get_where('manifesto', array('id' => $id));
		return $result = $query->row_array();
	}	
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_job', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}

	public function get_job_id_by_id($id){
		$query = $this->db->get_where('manifesto', array('id' => $id));
		return $result = $query->row_array()['job_id'];
	}

	public function get_manifesto_id($id){
		$query = $this->db->get_where('manifesto', array('id' => $id));
		return $result = $query->row_array();
	}

	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_job', array('slug' => $slug));
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

	public function checkmanifest($manifest_id){

		$this->db->where('manifest_no',$manifest_id);
		return $this->db->count_all_results('manifesto');

	}
 
    
}
?>