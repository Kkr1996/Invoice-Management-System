<?php

class Company_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------

	//-----------------------------------------------------
	public function get_all_states(){

		$wh =array();

		$query = $this->db->get('ci_company');
		$SQL = $this->db->last_query();

		if(count($wh)>0)
		{
			$WHERE = implode(' and ',$wh);
			return $this->datatable->LoadJson($SQL,$WHERE);
		}
		else
		{
			return $this->datatable->LoadJson($SQL);
		}
	}
	public function all_company(){
                 $this->db->order_by("company_name", "asc");
		$query = $this->db->get('ci_company');
        
		return $result = $query->result_array();
	}
    public function getcompanyscount(){
        return $result = $this->db->count_all_results('ci_company');
    }
	public function add($data){
		$result = $this->db->insert('ci_company', $data);
        return $this->db->insert_id();	
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_company', $data);
		return true;
	}
	public function get_by_id($id){
		$query = $this->db->get_where('ci_company', array('id' => $id));
		return $result = $query->row_array();
	}	
    
     public function get_company_by_id($id){
		$query = $this->db->get_where('ci_company', array('company_id' => $id));
		return $result = $query->row_array();
	}	
     public function check_company_code($id){
        $this->db->where('company_id',$id);
         
        $query = $this->db->get('ci_company');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
	}
    
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_company', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}	
	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_company', array('slug' => $slug));
		return $result = $query->row_array()['name'];
	}
    public function get_company_details_byid($cid)
    {
        $query = $this->db->get_where('ci_company', array('company_id' => $cid));
        return $result = $query->row_array();
    }
}
?>