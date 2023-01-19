<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Delivery_Model', 'delivery_model');
        $this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Company_Model', 'company_model');
	}
	public function index()
	{
		$records = $this->delivery_model->all_delivery();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/delivery/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	function staff()
	{
		$data['title'] = 'State List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/delivery/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------
	//-----------------------------------------------------

	public function add()
	{
	  if($this->input->post()){
			$this->form_validation->set_rules('deliveryname', 'deliveryname', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/delivery/add'),'refresh');
			}
			$rand_no = "DEL".rand(10000,99999);
			
			$data = array(
				'deliveryname'    => $this->input->post('deliveryname'),
				'pickup'          => $this->input->post('pickup'),
				'droplocation'    => $this->input->post('droplocation'),
				'delivery_id'     => $this->create_unique_slug($rand_no),
				'deiverydetails'  => $this->input->post('deiverydetails'),
                'company_id'      => $this->input->post('company_id'),
				'job_id'          => $this->input->post('job_id'),
				'email'           => $this->input->post('email'),
				'mobile'          => $this->input->post('mobile'),
				'created_at'      => date("Y-m-d")
			);
			$data = $this->security->xss_clean($data);
			$result = $this->delivery_model->add($data);
          
			$this->session->set_flashdata('success','Delivery has been added successfully');
			redirect(base_url('admin/delivery'));
          
		}
		else{
            
            $data['joblist'] = $this->job_model->all_job_active();
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Delivery';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/delivery/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

		function create_unique_slug($string,$field='delivery_id',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);

		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		 
		    if($key)$params["$key !="] = $value; 
		 
		    while ($t->db->where($params)->get('ci_delivery')->num_rows())
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
	       	$this->form_validation->set_rules('deliveryname', 'deliveryname', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/delivery/add'),'refresh');
				return;
			}
			$data = array(
				'deliveryname'    => $this->input->post('deliveryname'),
				'pickup' => $this->input->post('pickup'),
				'droplocation'   => $this->input->post('droplocation'),
				'deiverydetails'  => $this->input->post('deiverydetails'),
				'company_id'  => $this->input->post('company_id'),
				'job_id'  => $this->input->post('job_id'),
				'email'  => $this->input->post('email'),
				'mobile'  => $this->input->post('mobile'),
				'created_at'    => date("Y-m-d")
			);
			$data = $this->security->xss_clean($data);
			$result = $this->delivery_model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Delivery has been updated successfully');
				redirect(base_url('admin/delivery/edit'.'/'.$id));
			}
			
		}
		else{
            $data['joblist'] = $this->job_model->all_job_active();
			$data['title'] = 'Update Delivery';
			$data['data'] = $this->delivery_model->get_by_id($id);
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/delivery/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_delivery', array('id' => $id));
		$this->session->set_flashdata('success', 'Delivery has been Deleted Successfully!');
		redirect(base_url('admin/delivery'));
	}

   public function deliveryimportcsv(){

     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                    $name                  = $line[0];
                    $email                 = $line[1];
                    $mobile_no             = $line[2];
                    $pick_up_loc           = $line[3];
                    $drop_up_loc           = $line[4];
                    $delivery_details      = $line[5];
 
                    
                    $rand_no = "DEL".rand(10000,99999);

                    $data = array(
                        'deliveryname'    => $name,
                        'pickup'          => $pick_up_loc,
                        'droplocation'    => $drop_up_loc,
                        'delivery_id'     => $this->create_unique_slug($rand_no),
                        'deiverydetails'  => $delivery_details,
                        'email'           => $email,
                        'mobile'          => $mobile_no,
                        'created_at'      => date("Y-m-d")
                    );
                    $data   = $this->security->xss_clean($data);
                    $result = $this->delivery_model->add($data);
                    $this->session->set_flashdata('success','Delivery has been added successfully');
		

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
               	redirect(base_url('admin/delivery'));
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