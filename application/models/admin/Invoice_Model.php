<?php

class Invoice_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------

	//-----------------------------------------------------

	public function all_invoices(){
		         $this->db->order_by('id','desc');
		$query = $this->db->get('ci_invoices');
		return $result = $query->result_array();
	}
	public function add($data){
		$result = $this->db->insert('ci_invoices', $data);
        return $this->db->insert_id();	
	}
	public function edit($data, $id){
		$this->db->where('id', $id);
		$this->db->update('ci_invoices', $data);
		return true;
	}
	public function get_by_id($id){
		$query = $this->db->get_where('ci_invoices', array('id' => $id));
		return $result = $query->row_array();
	}		
    
    public function get_by_invoiceid($id){
		$query = $this->db->get_where('ci_invoices', array('invoice_no' => $id));
		return $result = $query->row_array();
	}	
    
    
	public function get_job_price_slug($slug){
		$query = $this->db->get_where('ci_invoices', array('slug' => $slug));
		return $result = $query->row_array()['price'];
	}	
	public function get_job_name_slug($slug){
		$query = $this->db->get_where('ci_invoices', array('slug' => $slug));
		return $result = $query->row_array()['name'];
	}
    
	public function get_last_invoiceid(){
            $query = $this->db->query("SELECT * FROM ci_invoices ORDER BY id DESC LIMIT 1");
            $result = $query->row_array()['start_no'];
            return $result;
	}
    
     public function getinvoice_count(){
        return $result = $this->db->count_all_results('ci_invoices');
        }
    
    public function count_bycompany_id($cid){
        $this->db->where('company_id',$cid);
        return $result    = $this->db->count_all_results('ci_invoices');
        }
    
    
	public function get_invoice_by_id($id){

			$this->db->select('
					ci_payments.id,
					ci_payments.user_id as client_id,
	    			ci_payments.invoice_no,
	    			ci_payments.items_detail,
	    			ci_payments.payment_status,
	    			ci_payments.sub_total,
	    			ci_payments.total_tax,
	    			ci_payments.discount,
					ci_payments.grand_total,
					ci_payments.currency,
					ci_payments.client_note,
					ci_payments.termsncondition,
					ci_payments.due_date,
					ci_payments.created_date,
					ci_users.username as client_name,
					ci_users.firstname,
					ci_users.lastname,
					ci_users.email as client_email,
					ci_users.mobile_no as client_mobile_no,
					ci_users.address as client_address,
					ci_companies.id as company_id,
					ci_companies.name as company_name,
					ci_companies.email as company_email,
					ci_companies.address1 as company_address1,
					ci_companies.address2 as company_address2,
					ci_companies.mobile_no as company_mobile_no,
					'
	    	);
	    	$this->db->from('ci_payments');
	    	$this->db->join('ci_users', 'ci_users.id = ci_payments.user_id ', 'Left');
	    	$this->db->join('ci_companies', 'ci_companies.id = ci_payments.company_id ', 'Left');
	    	$this->db->where('ci_payments.id' , $id);
	    	$query = $this->db->get();					 
			return $query->row_array();

		}
}
?>