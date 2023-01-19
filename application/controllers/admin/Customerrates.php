<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customerrates extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/CustomerRates_Model', 'customerrates_model');
		$this->load->model('admin/vendor_model', 'vendor_model');
		$this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Company_Model', 'company_model');
	}

	public function index()
	{

		$records              = $this->customerrates_model->all_agents();
		$data['records']      = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/customerrates/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	
	function agent()
	{
		$data['title'] = 'Customer List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/customerrates/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	public function add()
	{
	  if($this->input->post()){
          
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
          
			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/customerrates/add'),'refresh');
			}

			$job_type = $this->input->post('job_type');
			$job_type  = serialize($job_type);


			$vendor = $this->input->post('vendor');
			$svendor  = serialize($vendor);
			

	        $job_price = $this->input->post('job_price');
		    if($job_price){
		    	$sjob_price  = serialize($job_price);
		    }
		    else{
	    		$sjob_price  = serialize(array());
		    }


			$rand_no = "AGE".rand(10000,99999);
			$data = array(
				'name'      => $this->input->post('name'),
				'customer_id'   => $this->input->post('customer_id'),
                'company_id'   => $this->input->post('company_id'),
                'invoice_id'   => $this->input->post('invoice_id'),
				'job_type'    => $job_type,
				'vendor'    => $svendor,
				'job_price'    => $sjob_price,
				'extra_price'    => $this->input->post('extra_price'),
				'created_at'=> date("Y-m-d"),
				'slugs'     => make_slug($this->input->post('name')),
			);
			$data  = $this->security->xss_clean($data);
			$result = $this->customerrates_model->add($data);
			$this->session->set_flashdata('success','Customer Rates has been added successfully');
			redirect(base_url('admin/customerrates'));
		}
		else{

			$job_records           = $this->job_model->all_job();
			$data['job_records']   = $job_records;
			$data['title']         = "Add Customer Rates";

			$vrecords = $this->vendor_model->all_vendors();
			$data['vrecords'] = $vrecords;

            
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
            
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/customerrates/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

		function create_unique_slug($string,$field='invoice_id',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);
		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		    if($key)$params["$key !="] = $value; 
		    while ($t->db->where($params)->get('customer_rates')->num_rows())
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
		$this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');


		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/customerrates/edit/'.'/'.$id),'refresh');
				return;
			}
			$job_type = $this->input->post('job_type');
			$job_type  = serialize($job_type);


			$vendor = $this->input->post('vendor');
			$svendor  = serialize($vendor);		


		    $job_price = $this->input->post('job_price');
		    if($job_price){
		    	$sjob_price  = serialize($job_price);
		    }
		    else{
	    		$sjob_price  = serialize(array());
		    }
			




			$data = array(
				'name'          => $this->input->post('name'),
				'customer_id'   => $this->input->post('customer_id'),
                'company_id'    => $this->input->post('company_id'),
                'invoice_id'    => $this->input->post('invoice_id'),
				'job_type'      => $job_type,
				'vendor'        => $svendor,
				'job_price'     => $sjob_price,
				'extra_price'   => $this->input->post('extra_price'),
				'created_at'    => date("Y-m-d"),
				'slugs'         => make_slug($this->input->post('name')),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->customerrates_model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Customer Rates has been updated successfully');
				redirect(base_url('admin/customerrates/edit'.'/'.$id));
			}
			
		}
		else{
            
            $recordss = $this->company_model->all_company();
            $data['company_list'] = $recordss;
            
            
			$job_records           = $this->job_model->all_job();
			$data['job_records']   = $job_records;
			$data['title'] = 'Update Customer Rates';
			$data['data'] = $this->customerrates_model->get_customerrates_id($id);

			$vrecords = $this->vendor_model->all_vendors();
			$data['vrecords'] = $vrecords;

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/customerrates/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
        $this->rbac->check_operation_access(); 
		$this->db->delete('customer_rates', array('id' => $id));
		$this->session->set_flashdata('success', 'Customer Rates has been Deleted Successfully!');
		redirect(base_url('admin/customerrates'));
	}
	public function jobrateslist(){
		$alljob = $this->input->post('selectservicesid');
		$html="";
		if($alljob){
			foreach($alljob as $keys=>$vals){
				$job_records_price  = $this->job_model->get_job_price_slug($vals);
				$job_records_name  = $this->job_model->get_job_name_slug($vals);
		
				$html .= '<div class="col-xl-12 col-md-4 col-sm-6">
	             <div class="form-group">
		              <label>'.$job_records_name.' (Job Rate)</label>
		              <input type="text" name="job_price[]" class="form-control" id="extra_price" placeholder="Extra Price" value="'.$job_records_price.'">
		            </div>
		         </div>';
			}
		}
		echo $html;
	}
    
 public function customerratesimportcsv(){

     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                    $company_name                     = $line[0];
                    $registeration_no                 = $line[1];
                    $email                            = $line[2];
                    $phone                            = $line[3];
                    $descriptions                     = $line[4];

                    
                    $rand_no = "COM".rand(10000,99999);

                    $data = array(
                        'company_name'     => $company_name,
                        'registeration_no' => $registeration_no,
                        'email'            => $email,
                        'phone'            => $phone,
                        'descriptions'     => $descriptions,
                        'company_id'       => $this->create_unique_slug($rand_no),
                        'created_at'       => date("Y-m-d"),
                    );
                    
                    $data = $this->security->xss_clean($data);
                    $result = $this->company_model->add($data);
                    $this->session->set_flashdata('success','Company has been added successfully');
                   

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/company'),'refresh');
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