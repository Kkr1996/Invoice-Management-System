<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Agents extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Agent_Model', 'agents_model');
        $this->load->model('admin/Company_Model', 'company_model');
	}

	public function index()
	{

	
		$records         = $this->agents_model->all_agents_list();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/agents/agents_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	
	function agent()
	{
		$data['title'] = 'Agent List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/agents/agents_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}



	public function agentsbycompany_id($id){
		$data = $this->agents_model->get_agents_by_company_id($id);
		$html ="<option value=''>Select Agents Name</option>";
		foreach($data as $keys=>$row)
		{
		  $html .="<option value='".$row['agents_id']."'>".$row['name']."</option>"; 
		}
		echo $html;  

	}


	public function add()
	{
	  if($this->input->post()){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('details', 'Details', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('agents_id', 'Agents id', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		
			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/agents/add'),'refresh');
			}

		
  


			$data = array(
				'name'      => $this->input->post('name'),
				'details'   => $this->input->post('details'),
				'email'     => $this->input->post('email'),
				'phone'     => $this->input->post('phone'),
				'agents_id' => $this->input->post('agents_id'),
				'status'    => $this->input->post('status'),
				'commission'    => $this->input->post('commission'),
				'created_at'=> date("Y-m-d"),
				'slugs'     => make_slug($this->input->post('name')),
                 'company_id'      => $this->input->post('company_id'),
			);
			$data  = $this->security->xss_clean($data);
			$result = $this->agents_model->add($data);
			$this->session->set_flashdata('success','Agents has been added successfully');
			redirect(base_url('admin/agents'));
		}
		else{
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Agents';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/agents/agents_add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

		function create_unique_slug($string,$field='agents_id',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);
		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		    if($key)$params["$key !="] = $value; 
		    while ($t->db->where($params)->get('ci_agents')->num_rows())
		    {   
		        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
		            $slug .= '' . ++$i;
		        else
		            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
		        $params [$field] = $slug;
		    }   
		    return $slug;   
		}


	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
	       	$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('details', 'details', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/agents/edit'.'/'.$id),'refresh');
				return;
			}
			$data = array(
				'name'    => $this->input->post('name'),
				'details' => $this->input->post('details'),
				'status'  => $this->input->post('status'),
				'email'   => $this->input->post('email'),
				'phone'   => $this->input->post('phone'),
				'agents_id' => $this->input->post('agents_id'),
				'commission' => $this->input->post('commission'),
				'created_at' => date("Y-m-d"),
                'company_id'      => $this->input->post('company_id'),
				'slugs' => make_slug($this->input->post('name')),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->agents_model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Agents has been updated successfully');
				redirect(base_url('admin/agents/edit'.'/'.$id));
			}
			
		}
		else{

			$data['title'] = 'Update Agents';
			$data['agents'] = $this->agents_model->get_agents_id($id);
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			
            
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/agents/agents_edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_agents', array('id' => $id));
		$this->session->set_flashdata('success', 'Agents has been Deleted Successfully!');
		redirect(base_url('admin/agents'));
	}
    
    
 public function agentsimportcsv(){
     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){

                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                $agents_name           = $line[0];
                $email                 = $line[1];
                $phone                 = $line[2];
                $commission            = $line[3];
                $details               = $line[4];
                $agents_id             = $line[5];
                $status                = $line[6];


                $rand_no = "AGE".rand(10000,99999);
                    
                $data = array(
                    'name'       => $agents_name,
                    'details'    => $details,
                    'email'      => $email,
                    'phone'      => $phone,
                    'agents_id'  => $agents_id,
                    'status'     => $status,
                    'commission' => $commission,
                    'created_at' => date("Y-m-d"),
                    'slugs'      => make_slug($this->input->post('name')),
                );
                $data  = $this->security->xss_clean($data);
                $result = $this->agents_model->add($data);
                $this->session->set_flashdata('success','Agents has been added successfully');

               

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/agents'),'refresh');
            }
            else{
                $qstring = '?status=err';
            }
        }else{
            $qstring = '?status=invalid_file';
              return redirect()->back();     
        }
        
    }

}

?>