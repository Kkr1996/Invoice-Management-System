<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/Supplier_model', 'supplier_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('Dashboard_Model');
        $this->load->model('admin/Company_Model', 'company_model');
		$this->load->model('admin/Agent_Model', 'agents_model');
        $this->load->model('admin/supplier_model', 'supplier_model');
    
	}

	//-----------------------------------------------------------
	public function index(){
        $records = $this->supplier_model->all_users();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/supplier/list', $data);
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
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/users/add'),'refresh');
			}
			else{
                

                $username=$this->input->post('username');
				$supplier_id  = "SUP".substr($username,0,2).rand(1000,9999);
				$supplier_id  =  $this->create_unique_slug($supplier_id);

				$data = array(
					'name'   =>$this->input->post('username'),
					'email'      =>$this->input->post('email'),
					'contact_person'  =>$this->input->post('contact_person'),
					'address'    =>$this->input->post('address'),
                    'account_code'    =>$this->input->post('account'),
					'currency'        =>$this->input->post('customer_currency'),
                    'term'            =>$this->input->post('payment_term'),
                    'mobile'        =>$this->input->post('mobile'),
                    'phone_2'     =>$this->input->post('mobile_no_2'),
                    'phone_1'        =>$this->input->post('mobile_1'),
                    'supplier_id'     =>$supplier_id,
					'is_verify'  =>1,
					'is_active'  =>$this->input->post('status'),
					'created_at' =>date('Y-m-d : h:m:s'),
					
				);
              
                
				$data   = $this->security->xss_clean($data);
				$result = $this->supplier_model->add_user($data);
               
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'Supplier has been added successfully!');
					redirect(base_url('admin/supplier'));
				}
                
			}
		}
		else{
            
//            $records = $this->company_model->all_company();
//            $data['company_list'] = $records;
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/supplier/add');
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



    function create_unique_slug($string,$field='supplier_id',$key=NULL,$value=NULL)
    {
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;

        if($key)$params["$key !="] = $value; 

        while ($t->db->where($params)->get('ci_supplier')->num_rows())
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
		
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/users/user_edit/'.$id),'refresh');
			}
			else{
                  
             $data = array(
					'name'   =>$this->input->post('username'),
					'email'      =>$this->input->post('email'),
					'contact_person'  =>$this->input->post('contact_person'),
					'address'    =>$this->input->post('address'),
                    'account_code'    =>$this->input->post('account'),
					'currency'        =>$this->input->post('customer_currency'),
                    'term'            =>$this->input->post('payment_term'),
                    'mobile'        =>$this->input->post('mobile'),
                    'phone_2'        =>$this->input->post('mobile_no_2'),
                    'phone_1'        =>$this->input->post('mobile_1'),
					'is_verify'  =>1,
					'is_active'  =>$this->input->post('status'),
					'created_at' =>date('Y-m-d : h:m:s'),
					
				);
              
				$result = $this->supplier_model->edit_user($data, $id);
				if($result){
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Supplier has been updated successfully!');
					redirect(base_url('admin/supplier/edit'.'/'.$id));
				}       
                
			}
		}
		else{
            
          
			$data['user'] = $this->supplier_model->get_user_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/supplier/edit', $data);
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
    
    
    public function importcsv(){

     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                    $account_code                        = $line[0];
                    $suppliername                    = $line[1];
                    $address                         = $line[2];
                    
                    $currency                          = $line[3];
                    $payment_term                      = $line[4];
                    
                    $contact_person_name                      = $line[5];
                    $email                               = $line[6];

                    $mobile_no                        = $line[7];
                    $mobile_1                         = $line[8];
                    $mobile_no_2                      = $line[9];
                  
                    
                    
                    
                    
                    $supplier_id  = "CUS".substr($suppliername,0,2).rand(1000,9999);
                    $supplier_id  =  $this->create_unique_slug($customer_id);

                    $data = array(
                        'account_code'              =>$account_code,
                        'name'                      =>$suppliername,
                        'address'                   =>$address,
                        'currency'                  =>currency,
                        'term'               =>$payment_term,
                        'contact_person'             =>$contact_person_name,
                        'email'                      =>$email,
                        'mobile'                     =>$mobile_no,
                        'phone_1'                    =>$mobile_1,
                        'phone_2'                    =>$mobile_no_2,
                        'is_verify'                  =>1,
                        'is_active'                  =>1,
                        'created_at'                 =>date('Y-m-d : h:m:s'),
                        'supplier_id'                =>$supplier_id,
                    );
                    unset($customer_rate);

                   
                    $result = $this->supplier_model->add_user($data);
                    $this->session->set_flashdata('success', 'Customer has been added successfully!');
                 
                    

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/supplier'));
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