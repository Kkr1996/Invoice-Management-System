<?php

class Agent_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------

	//-----------------------------------------------------
	public function get_all_states(){

		$wh =array();
                 $this->db->orderby('id','desc');
		$query = $this->db->get('ci_states');
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

	public function all_agents($cid){
                 $this->db->order_by('id','desc');
				 $this->db->where('company_id',$cid);
		$query = $this->db->get('ci_agents');
		return $result = $query->result_array();
	}
		public function all_agents_list(){
			$this->db->order_by('id','desc');
			$query = $this->db->get('ci_agents');
			return $result = $query->result_array();
		}

	public function get_agents_by_company_id($id){

		$query = $this->db->get_where('ci_agents', array('company_id' => $id));
		return $result = $query->result_array();

	}
	public function add($data){
		 $result = $this->db->insert('ci_agents', $data);
         return $this->db->insert_id();	
	}

	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_agents', $data);
		return true;
	}
	
	public function get_agents_id($id){
		$query = $this->db->get_where('ci_agents', array('id' => $id));
		return $result = $query->row_array();
	}
    public function getagentscount(){
        return $result = $this->db->count_all_results('ci_agents');
    }
    public function count_bycompany_id($cid){
                             $this->db->where('company_id',$cid);
         return $result    = $this->db->count_all_results('ci_agents');
    }
}
?>