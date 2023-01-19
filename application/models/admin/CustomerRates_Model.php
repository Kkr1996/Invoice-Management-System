<?php
class CustomerRates_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	//-----------------------------------------------------


	public function all_agents(){
		$query = $this->db->get('customer_rates');
		return $result = $query->result_array();
	}
	
	public function add($data){
		 $result = $this->db->insert('customer_rates', $data);
         return $this->db->insert_id();	
	}

	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('customer_rates', $data);
		return true;
	}
	
	public function get_customerrates_id($id){
		$query = $this->db->get_where('customer_rates', array('id' => $id));
		return $result = $query->row_array();
	}
    
    public function getcustomers_rates_count(){
        return $result = $this->db->count_all_results('customer_rates');
        }
    
    public function count_bycompany_id($cid){
        $this->db->where('company_id',$cid);
        return $result    = $this->db->count_all_results('customer_rates');
        }
    
}
?>