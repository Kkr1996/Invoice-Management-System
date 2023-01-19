<?php

class Delivery_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	//-----------------------------------------------------

	public function all_delivery(){
		        $this->db->order_by('id','desc');
		$query = $this->db->get('ci_delivery');
		return $result = $query->result_array();
	}
	public function add($data){
		$result = $this->db->insert('ci_delivery', $data);
        return $this->db->insert_id();	
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_delivery', $data);
		return true;
	}
	public function get_by_id($id){
		$query = $this->db->get_where('ci_delivery', array('id' => $id));
		return $result = $query->row_array();
	}	
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_delivery', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}	
	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_delivery', array('slug' => $slug));
		return $result = $query->row_array()['name'];
	}
    public function getdeliverycount(){
        return $result = $this->db->count_all_results('ci_delivery');
    }
    public function count_bycompany_id($cid){
                             $this->db->where('company_id',$cid);
         return $result    = $this->db->count_all_results('ci_delivery');
    }

}
?>