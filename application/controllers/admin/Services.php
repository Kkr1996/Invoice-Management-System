<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Services_Model', 'services_model');
	}
	public function index()
	{
		$data['title'] = 'Country List';
		$records = $this->services_model->all_services();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/services/services_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	
	function staff()
	{
		$data['title'] = 'State List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/staff/state_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------
	public function staff_datatable_json()
	{				   					   
		$records = $this->services_model->get_all_states();
		$data = array();
		$count=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				get_country_name($row['country_id']),
				$row['name'],
				'<span class="btn btn-xs btn-success" title="status">'.$status.'<span>',				
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/staff/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
            	 <a title="Delete" class="delete btn btn-sm btn-danger" href="'.base_url('admin/staff/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------
	public function services_add()
	{
		if($this->input->post()){

		$this->form_validation->set_rules('service_title', 'service_title', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {


				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/staff/add'),'refresh');
			}

			$data = array(
				'services' => ucfirst($this->input->post('service_title')),
				'slug' => make_slug($this->input->post('service_title')),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->services_model->add_services($data);
			$this->session->set_flashdata('success','Staff has been added successfully');
			redirect(base_url('admin/services'));
		}
		else{
			$data['countries'] = $this->services_model->get_countries_list(); 
			$data['title'] = 'Add Staff';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/services/services_add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

		function create_unique_slug($string,$field='slug',$key=NULL,$value=NULL)
		{
		    $t =& get_instance();
		    $slug = url_title($string);
		    $slug = strtolower($slug);
		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		 
		    if($key)$params["$key !="] = $value; 
		 
		    while ($t->db->where($params)->get('ci_states')->num_rows())
		    {   
		        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
		            $slug .= '-' . ++$i;
		        else
		            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
		         
		        $params [$field] = $slug;
		    }   
		    return $slug;   
		}


	//-----------------------------------------------------
	public function services_edit($id=0)
	{
		if($this->input->post()){
            $this->form_validation->set_rules('services', 'services', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/services/add'),'refresh');
				return;
			}



$subservices = $this->input->post('subservices');
$subprice    = $this->input->post('subprices');



            $merge_two_array = array_combine($subservices,$subprice);

			$data = array(
				'services'    => ucfirst($this->input->post('services')),
				'subservices' => serialize($merge_two_array),
			);


			$data = $this->security->xss_clean($data);
			$result = $this->services_model->edit_services($data, $id);

			if($result){
				$this->session->set_flashdata('success','Services has been updated successfully');
				redirect(base_url('admin/services'));
			}
			
		}
		else{

			$data['title'] = 'Update Staff';
			$data['services'] = $this->services_model->get_services_by_id($id);

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/services/services_edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function services_del($id = 0)
	{

		$this->db->delete('services', array('id' => $id));
		$this->session->set_flashdata('success', 'Services has been Deleted Successfully!');
		redirect(base_url('admin/services'));
	}


}

?>