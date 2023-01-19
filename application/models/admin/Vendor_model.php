<?php
class Vendor_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	public function get_all_countries(){
		$wh =array();
		$query = $this->db->get('ci_countries');
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

	//-----------------------------------------------------
	public function get_all_states(){

        $wh =array();

        $this->db->get('ci_staffs');
        $query =  $this->db->order_by('id','desc');
        $SQL  = $this->db->last_query();

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
    public function getvendorscount(){
         return $result = $this->db->count_all_results('ci_staffs');
    }
    
    public function count_bycompany_id($cid){
                             $this->db->where('company_id',$cid);
         return $result    = $this->db->count_all_results('ci_staffs');
    }
    
	public function all_vendors(){

    $this->db->from('ci_staffs');
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    $module = array();

    if ($query->num_rows() > 0) 
    {
        $module = $query->result_array();
    }
    return $module;

	}

	public function all_active_vendor(){

        $this->db->from('ci_staffs');
        $this->db->order_by('id','desc');
        $this->db->where('status',1);
        $query = $this->db->get();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;

	}
	//-----------------------------------------------------
	public function get_all_cities(){

		$wh =array();

		$query = $this->db->get('ci_cities');
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


	//-----------------------------------------------------
	public function add_country($data){

		$result = $this->db->insert('ci_countries', $data);
        return $this->db->insert_id();	
	}

	//-----------------------------------------------------
	public function add_state($data){

		$result = $this->db->insert('ci_staffs', $data);
        return true;	
	}

	//-----------------------------------------------------
	public function add_city($data){

		$result = $this->db->insert('ci_cities', $data);
        return true;	
	}

	//-----------------------------------------------------
	public function edit_country($data, $id){

		$this->db->where('id', $id);
		$this->db->update('ci_countries', $data);
		return true;

	}
    public function getstaff_byid($staffid){
                           $this->db->where('id', $staffid);
                  $query = $this->db->get('ci_staffs');
            
	 	  return $result = $query->result_array();
        
    }
	//-----------------------------------------------------
	public function edit_state($data, $id){


		$this->db->where('id', $id);
		$this->db->update('ci_staffs', $data);
		return true;

	}
     
    
    
	//-----------------------------------------------------
	public function edit_city($data, $id){

		$this->db->where('id', $id);
		$this->db->update('ci_staffs', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_country_by_id($id){return $result = $query->row_array();

		$query = $this->db->get_where('ci_countries', array('id' => $id));
		return $result = $query->row_array();
	}

	//-----------------------------------------------------
	public function get_state_by_id($id){

		$query = $this->db->get_where('ci_staffs', array('id' => $id));
		return $result = $query->row_array();
	}

	//-----------------------------------------------------
	public function get_city_by_id($id){

		$query = $this->db->get_where('ci_cities', array('id' => $id));
		return $result = $query->row_array();
	}

		//------------------------------------------------
	// Get Countries
	function get_countries_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('ci_countries')->result_array();	
		}
		else
		{
			return  $this->db->select('id,country')->from('ci_countries')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Cities
	function get_cities_list($id=0)
	{
		if($id==0){
			return  $this->db->get('ci_cities')->result_array();	
		}
		else{
			return  $this->db->select('id,city')->from('ci_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get States
	function get_states_list($id=0)
	{
		if($id==0){
			return  $this->db->get('ci_staffs')->result_array();	
		}
		else{
			return  $this->db->select('id,s')->from('ci_cities')->where('id',$id)->get()->row_array();	
		}
	}
    
    public function get_stfforder_by_id($id=0){

		$this->db->from('ci_services_form');
        $this->db->order_by('id', 'desc');
		$this->db->where('staffid', $id);

        $query = $this->db->get();
        if ($query->num_rows() == 0){
            return false;
        }
        else{
                return $result = $query->result_array();
            }
		
	}
    
    public function get_stfforder_by_order_id($id=0){
        $query = $this->db->get_where('ci_services_form', array('order_id' => $id));
		return $result = $query->row_array();

    }    
    
    public function get_stfforder_by_order_id_pdf($id=0){
        $query = $this->db->get_where('ci_services_form', array('order_id' => $id));
		return $result = $query->result_array();

    }
    
    public function edit_orders($data, $id){
        
		$this->db->where('order_id', $id);
		$this->db->update('ci_services_form', $data);
		return true;
        
	}
    
    public function get_vendor_by_company_id($cid)
    {
        $this ->db->select('*');
        $this ->db->from('ci_staffs');
        $this ->db->where('company_id',$cid);
        $query = $this->db->get();
        return $result = $query->result();
    }
    public function get_vendor_details_byid($vid)
    {
        $query = $this->db->get_where('ci_staffs', array('id' => $vid));
        return $result = $query->row_array();
    }
	
}
?>