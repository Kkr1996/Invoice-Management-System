<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Dashboard_Model');
        $this->load->model('admin/Company_Model', 'company_model');
		$this->load->model('admin/Agent_Model', 'agents_model');
	}

	//-----------------------------------------------------------
	public function index(){
        $records = $this->user_model->all_users();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/users/user_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	public function usersbycompany_id($company_id){

		$records = $this->user_model->get_customer_by_company_id($company_id);
		
		$html="<option value=''>Select Customer Name</option>";
		foreach($records as $row)
		{
			$html .="<option value='".$row->customer_id."'>".$row->username."</option>";  
		}
		echo $html;  


	}
	public function datatable_json(){	
        
		$records['data'] = $this->user_model->get_all_users();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
            
			$status = ($row['is_active'] == 1)? 'checked': '';
			$verify = ($row['is_verify'] == 1)? 'Verified': 'Pending';
			$data[]= array(
				++$i,
				$row['username'],
				$row['email'],
				$row['mobile_no'],
				date_time($row['created_at']),	
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/users/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/users/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
            
		}
		
		$records['data']=$data;
		echo json_encode($records);	 
	}

	//-----------------------------------------------------------
	function change_status()
	{   
		$this->user_model->change_status();
	}

	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            
			$this->form_validation->set_rules('username', 'Username', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/users/add'),'refresh');
			}
			else{
                

                $username=$this->input->post('username');
				$customer_id  = "CUS".substr($username,0,2).rand(1000,9999);
				$customer_id  =  $this->create_unique_slug($customer_id);

				$data = array(
					'username'   =>$this->input->post('username'),
					'email'      =>$this->input->post('email'),
					'mobile_no'  =>$this->input->post('mobile_no'),
					'address'    =>$this->input->post('address'),
                    'account_number'    =>$this->input->post('account'),
                    'ibd'    =>$this->input->post('ibd'),
					'customer_currency'    =>$this->input->post('customer_currency'),
					'company_id'    =>$this->input->post('company_id'),
                    'customer_rate' =>serialize($this->input->post('customer_rate')),
                    'start_date'    =>$this->input->post('start_date'),
                    'end_date'      =>$this->input->post('end_date'),
                    'payment_term'  =>$this->input->post('payment_term'),
                    'attn'          =>$this->input->post('attn'),
					'gst'          =>$this->input->post('gst'),
					'sst'          =>$this->input->post('sst'),
                    'code'                 =>$this->input->post('code'),
                    'group_company_name'   =>$this->input->post('group_company_name'),
                    'billingaddress'       =>$this->input->post('billingaddress'),
                    'terms'       =>$this->input->post('terms'),
                    'mobile_no_2'       =>$this->input->post('mobile_no_2'),
                    'mobile_1'       =>$this->input->post('mobile_1'),
                    'agents'          =>$this->input->post('agents'),
                    'one_of_job_rate'          =>$this->input->post('one_of_job_rate'),
                    'account_code'   =>$this->input->post('account_code'),
					'customer_id'=>$customer_id,
					'is_verify'  =>1,
					'is_active'  =>$this->input->post('status'),
					'created_at' =>date('Y-m-d : h:m:s'),
					'updated_at' =>date('Y-m-d : h:m:s'),
				);
              
                
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
               
//                $customerrecords = $this->user_model->get_customer_by_company_id($company_id);
//                $data['customerrecords'] = $customerrecords;
                
				if($result){

					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'Customer has been added successfully!');
					redirect(base_url('admin/users'));


				}
			}
		}
		else{
            
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/users/user_add',$data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

	public function users_info($customer_id){
	//	echo $customer_id;
		$data = $this->user_model->get_user_by_id($customer_id);
        $customer_rates = unserialize($data['customer_rate']);
	
	//	echo '<pre>',var_dump($customer_rates); echo '</pre>';
        $html = '';
		foreach($customer_rates as $keys=>$vals){
			$html .= '<option>'.$vals.'</option>';
		}
     
		$data['allrates'] = $html;



		echo json_encode($data);


	}



    function create_unique_slug($string,$field='member_id',$key=NULL,$value=NULL)
    {
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;

        if($key)$params["$key !="] = $value; 

        while ($t->db->where($params)->get('ci_users')->num_rows())
        {   
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );

            $params [$field] = $slug;
        }   
        return $slug;   
    }
	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            
			$this->form_validation->set_rules('username', 'Username', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/users/user_edit/'.$id),'refresh');
			}
			else{
                  
            $project_id = 122;
            $userid = $this->input->post('userid');
            $base_url=''; 
            $config['upload_path']          =  $base_url.'uploads/users/'.$userid.'/';   
            $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|svg';
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);

	            for($i=0; $i<$cpt; $i++)
	            {   
	                $_FILES['userfile']['name']= $files['userfile']['name'][$i];
	                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	                $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
	                $files_my[] = $files['userfile']['name'][$i];
	                $this->upload->initialize($this->set_upload_options($project_id, $userid));
	                $this->upload->do_upload();
	                $data = $this->upload->data();
	                $image_name[] =$data['file_name'];
	            }
                $serialize_files = serialize($files_my);
                $data = array(
					'username'   =>$this->input->post('username'),
					'email'      =>$this->input->post('email'),
					'mobile_no'  =>$this->input->post('mobile_no'),
					'address'    =>$this->input->post('address'),
                    'account_number'    =>$this->input->post('account'),
                    'ibd'    =>$this->input->post('ibd'),
					'is_active'  =>$this->input->post('status'),
                    'company_id'    =>$this->input->post('company_id'),
					'agents'          =>$this->input->post('agents'),
					'customer_currency'    =>$this->input->post('customer_currency'),
                    'customer_rate' =>serialize($this->input->post('customer_rate')),
                    'start_date'    =>$this->input->post('start_date'),
                    'end_date'      =>$this->input->post('end_date'),
					'gst'          =>$this->input->post('gst'),
					'sst'          =>$this->input->post('sst'),
                    'code'                 =>$this->input->post('code'),
                    'group_company_name'   =>$this->input->post('group_company_name'),
                    'billingaddress'       =>$this->input->post('billingaddress'),
                    'terms'       =>$this->input->post('terms'),
                    'mobile_no_2'       =>$this->input->post('mobile_no_2'),
                    'mobile_1'       =>$this->input->post('mobile_1'),
                    'payment_term'  =>$this->input->post('payment_term'),
                    'one_of_job_rate'          =>$this->input->post('one_of_job_rate'),
                    'attn'          =>$this->input->post('attn'),
                    'account_code'   =>$this->input->post('account_code'),
					'updated_at' =>date('Y-m-d  h:m:s')
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);
				if($result){
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Customer has been updated successfully!');
					redirect(base_url('admin/users/edit'.'/'.$id));
				}       
                
			}
		}
		else{
            
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['user'] = $this->user_model->get_user_by_id($id);

			$company_id = $data['user']['company_id'];    
	

			$agentsrecords = $this->agents_model->all_agents($company_id);
			$data['agentsrecords'] = $agentsrecords;
            
            
            
            $customerrecords = $this->user_model->get_customer_by_company_id($company_id);
			$data['customerrecords'] = $customerrecords;
            
            
            
            
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/users/user_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

    private function set_upload_options($project_id ='',$userid)
    {   
         $base_url='';
         $config = array();
        
        
         $config['upload_path']          =  $base_url.'uploads/users/'.$userid.'/'; 
        
         $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|txt|css|svg';
         $config['overwrite']     = FALSE;
         return $config;
    }
    
    
	public function delete($id = 0)
	{
		
		$this->rbac->check_operation_access(); 
		$this->db->delete('ci_users', array('id' => $id)); 
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Customer has been deleted successfully!');
		redirect(base_url('admin/users'));
	}
    
    public function view($member_id = 0){
        
        	$data['alldocuments'] = $this->user_model->get_user_document_id($member_id);
            $this->load->view('admin/includes/_header');
			$this->load->view('admin/users/users_document', $data);
			$this->load->view('admin/includes/_footer');
			
    }
    
    public function users_document($id){
      
        $data['alldocuments'] = $this->user_model->get_users_files($id);
        $this->load->view('admin/includes/_header');
		$this->load->view('admin/users/usersfiles', $data);
		$this->load->view('admin/includes/_footer');
    }
    
    
   	public function delete_files_users($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('ci_uploaded_files', array('id' => $id));

		// Activity Log 
		$this->activity_model->add_log(3);

		$this->session->set_flashdata('success', 'Use has been deleted successfully!');
        redirect($_SERVER['HTTP_REFERER']);
	}
//    public function customerimportcsv(){
//      echo "test";
//         
//        
//        die();
//    }
//    
    
    
    public function customerimportcsv(){

     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                    $company_id                        = $line[0];
                   //  $CompanyName                    = $line[1];
                    $group_company_name                = $line[2];
                    
                    $billingaddress                    = $line[3];
                    $customer_currency                 = $line[4];
                    $payment_term                      = $line[5];
                    $attn                              = $line[6];
                    $email                             = $line[7];
                    
                    $mobile_no                        = $line[8];
                    $mobile_1                         = $line[9];
                    $mobile_no_2                      = $line[10];
                    $agents                           = $line[11];
                    $username                         = $line[12];
                    $address                          = $line[13];
                    
                    $status                           = $line[14];
                    $account_number                           = $line[15];
                    $customer_rate[]                           = $line[16];
                    $one_of_job_rate                           = $line[17];
                    $start_date                           = $line[18];
                    $end_date                            = $line[19];
                    $gst                                  = $line[20];
                    $sst                           = $line[21];
                    
                    
                    
                    
                    $customer_id  = "CUS".substr($username,0,2).rand(1000,9999);
                    $customer_id  =  $this->create_unique_slug($customer_id);

                    $data = array(
                        'company_id'              =>$company_id,
                        'group_company_name'      =>$group_company_name,
                        'billingaddress'          =>$billingaddress,
                        'customer_currency'       =>$customer_currency,
                        'payment_term'            =>$payment_term,
                        'attn'                    =>$attn,
                        'email'                   =>$email,
                        'mobile_no'               =>$mobile_no,
                        'mobile_1'                =>$mobile_1,
                        'mobile_no_2'             =>$mobile_no_2,
                        'agents'                  =>$agents,
                        'username'                  =>$username,
                        'address'                   =>$address,
                        'status'                    =>$status,
                        'account_number'            =>$account_number,
                        'customer_rate'             =>serialize($customer_rate),
                        'one_of_job_rate'        =>$one_of_job_rate,
                        'start_date'             =>$start_date,
                        'end_date'               =>$end_date,
                        'gst'                    =>$gst,
                        'sst'                    =>$sst,
                        
                        'customer_id'=>$customer_id,
                        'is_active'  =>$status,
                        'created_at' =>date('Y-m-d : h:m:s'),
                        'updated_at' =>date('Y-m-d : h:m:s'),
                    );
                    unset($customer_rate);

                   
                    $result = $this->user_model->add_user($data);
                    $this->session->set_flashdata('success', 'Customer has been added successfully!');
                 
                    

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/users'));
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