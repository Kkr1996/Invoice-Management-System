<?php

class Vendorinvoice_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	//-----------------------------------------------------

	public function all_vendorinvoice(){
		        $this->db->order_by('id','desc');
		$query = $this->db->get('ci_vendor_invoice');
		return $result = $query->result_array();
	}
	public function add($data){
		$result = $this->db->insert('ci_vendor_invoice', $data);
        return $this->db->insert_id();	
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_vendor_invoice', $data);
		return true;
	}
	public function get_by_id($id){
		$query = $this->db->get_where('ci_vendor_invoice', array('id' => $id));
		return $result = $query->row_array();
	}		
    public function get_by_invoiceid($id){
		$query = $this->db->get_where('ci_vendor_invoice', array('invoice_id' => $id));
		return $result = $query->row_array();
	}	
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_vendor_invoice', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}	
	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_vendor_invoice', array('slug' => $slug));
		return $result = $query->row_array()['name'];
	}
    public function getvendorinvoice_count(){
        return $result = $this->db->count_all_results('ci_vendor_invoice');
        }
    
    public function count_bycompany_id($cid){
        $this->db->where('company_id',$cid);
        return $result    = $this->db->count_all_results('ci_vendor_invoice');
        }


}
?>