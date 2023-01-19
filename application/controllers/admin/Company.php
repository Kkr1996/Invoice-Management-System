<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Company_Model', 'company_model');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}
	public function index()
	{
	
		$records = $this->company_model->all_company();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/company/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------

	//-----------------------------------------------------
	public function add()
	{

	  if($this->input->post()){


		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/company/add'),'refresh');
			}


			$rand_no = "COM".rand(10000,99999);

            $company_code =   $this->input->post('company_code');
            if($company_code){
                $company_id = $company_code;
            }else{
                $company_id = $this->create_unique_slug($rand_no);  
            }
			
          
          
			$base_url=''; 


		
			mkdir('assets/company/'.$company_id, 0777, true);

			$config['upload_path']          = 'assets/company/'.$company_id.'/';   
			$config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|svg';
			$this->load->library('upload');
			$dataInfo = array();
			$files = $_FILES;
			$cpt = count($_FILES['userfile']['name']);

			$files_my = [];
			for($i=0; $i<$cpt; $i++)
			{   
				$_FILES['userfile']['name']= $files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];   
				
				$files_my[] = 'uploads/'.$files['userfile']['name'][$i];
	
				$this->upload->initialize($this->set_upload_options($company_id));
				$this->upload->do_upload();
				$data = $this->upload->data();
				$imagename =$data['file_name'];
			}
	


			$data = array(
				'company_name'       => $this->input->post('company_name'),
				'registeration_no'   => $this->input->post('registeration_no'),
				'fax'                => $this->input->post('fax'),
				'email'   => $this->input->post('email'),
				'phone'   => $this->input->post('phone'),
				'descriptions'   => $this->input->post('descriptions'),
				'service_tax_no'   => $this->input->post('service_tax_no'),
				'a_c_no'   => $this->input->post('a_c_no'),
				
                'disclaimer' =>$this->input->post('disclaimer'),
                'swift_code' =>$this->input->post('swift_code'),
                'company_id' =>$company_id,
                'bank_name' =>$this->input->post('bank_name'),
                'bank_address' =>$this->input->post('bank_address'),
				'image'     =>$imagename,
				'created_at' => date("Y-m-d"),
			);
			$data   = $this->security->xss_clean($data);
			$result = $this->company_model->add($data);
			$this->session->set_flashdata('success','Company has been added successfully');
			redirect(base_url('admin/company'));
		}
		else{
			$data['title'] = 'Add Company';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/company/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}
    private function set_upload_options($company_id)
    {   
         $base_url='';
         $config = array();
         $config['upload_path']          = 'assets/company/'.$company_id; 
         $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|txt|css|svg';
         $config['overwrite']     = FALSE;
         return $config;
    }
		function create_unique_slug($string,$field='company_id',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);

		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		 
		    if($key)$params["$key !="] = $value; 
		 
		    while ($t->db->where($params)->get('ci_company')->num_rows())
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

			

	        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/company/add'),'refresh');
				return;
			}


		    $company_id = $this->input->post('company_id');

			if (!file_exists('assets/company/'.$company_id)) {
				mkdir('assets/company/'.$company_id, 0777, true);
			}

			$config['upload_path']          = 'assets/company/'.$company_id.'/';   


			$config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|svg';
			$this->load->library('upload');
			$dataInfo = array();
			$files = $_FILES;
			$cpt = count($_FILES['userfile']['name']);


		
				$files_my = [];
				for($i=0; $i<$cpt; $i++)
				{   
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];   
					

				    $image_name = $files['userfile']['name'][$i];
			


					if($image_name){
						$files_my[] = 'uploads/'.$files['userfile']['name'][$i];
		
						$this->upload->initialize($this->set_upload_options($company_id));
						$this->upload->do_upload();
						$data = $this->upload->data();
						$imagename =$data['file_name'];
					}
					else{
						$imagename = $this->input->post('company_logo');
					}
	
				}



			$data = array(
				'company_name'     => $this->input->post('company_name'),
				'registeration_no' => $this->input->post('registeration_no'),
				'email'   => $this->input->post('email'),
				'phone'   => $this->input->post('phone'),
				'fax'   => $this->input->post('fax'),
				'descriptions'   => $this->input->post('descriptions'),
				'service_tax_no'   => $this->input->post('service_tax_no'),
                'disclaimer' =>$this->input->post('disclaimer'),
                'a_c_no'   => $this->input->post('a_c_no'),
                'swift_code' =>$this->input->post('swift_code'),
                'company_code' =>$this->input->post('company_code'),
                'bank_name' =>$this->input->post('bank_name'),
                'bank_address' =>$this->input->post('bank_address'),
				'image'     =>$imagename,
				'created_at' => date("Y-m-d"),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->company_model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Company has been updated successfully');
			
			}
			redirect(base_url('admin/company/edit'.'/'.$id));
		}
		else{

			$data['title'] = 'Update Company';
			$data['data'] = $this->company_model->get_by_id($id);

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/company/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}
    
    
    public function checkcompany_code($ccode){
     
        $result = $this->company_model->check_company_code($ccode);
        echo $result;
        
    }
	//-----------------------------------------------------
	public function del($id = 0)
	{
        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_company', array('id' => $id));
		$this->session->set_flashdata('success', 'Company has been Deleted Successfully!');
		redirect(base_url('admin/company'));
	}
 public function companyimportcsv(){

     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    $company_code                     = $line[0];
                    $company_name                     = $line[1];
                    $registeration_no                 = $line[2];
                    $email                            = $line[3];
                    $phone                            = $line[4];
                    $fax                              = $line[5];
                    $service_tax_no                   = $line[6];
                    $bank_name                        = $line[7];
                    $bank_address                        = $line[8];
                    $a_c_no                            = $line[9];
                    $swift_code                        = $line[10];
                    $image                        = $line[11];
                    $disclaimer                        = $line[12];
                    $bank_address                        = $line[13];
                    
                   
                    

                    
                    $rand_no = "COM".rand(10000,99999);

                    $data = array(
                        'company_name'     => $company_name,
                        'registeration_no' => $registeration_no,
                        'email'            => $email,
                        'phone'            => $phone,
                        'fax'              => $fax,
                        'service_tax_no'          => $service_tax_no,
                        'bank_name'               => $bank_name,
                        'bank_address'            => $bank_address,
                        'a_c_no'                  => $a_c_no,
                        'swift_code'              => $swift_code,
                        'image'                   => $image,
                        'disclaimer'              => $disclaimer,
                        'bank_address'            => $bank_address,
                        'company_id'              => $company_code,
                        'created_at'              => date("Y-m-d"),
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