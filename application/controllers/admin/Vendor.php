<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
        
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/vendor_model', 'vendor_model');
		$this->load->model('admin/Admin_model', 'admin_model');
        $this->load->model('Dashboard_Model','dashboard_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->load->model('admin/Services_Model', 'services_model');
		$this->load->model('Services_User_Model','services_user_model');
        $this->load->model('admin/Company_Model', 'company_model');
	}
	public function index()
	{
        
 
		$data['title']   = 'Vendor List';
		$records         = $this->vendor_model->all_vendors();
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/vendor/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	function staff()
	{
		$data['title'] = 'Vendor List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/vendor/state_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------
	public function staff_datatable_json()
	{				   					   
		$records = $this->vendor_model->get_all_states();
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
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/vendor/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
            	 <a title="Delete" class="delete btn btn-sm btn-danger" href="'.base_url('admin/vendor/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------
	public function add()
	{
        

		if($this->input->post()){

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	//	$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('vendor_rate', 'vendor_rate', 'trim|required');
		// $this->form_validation->set_rules('email', 'email', 'trim|is_unique[ci_staffs.name]|required');
		// $this->form_validation->set_rules('password', 'password', 'trim|required');

	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/vendor/add'),'refresh');
			}

			$data = array(
				'name'  => ucfirst($this->input->post('name')),
				'slug'  => make_slug($this->input->post('name')),
				'status'=> $this->input->post('status'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address'=> $this->input->post('address'),
				'vendor_currency'=> $this->input->post('vendor_currency'),
				'registeration_no' => $this->input->post('registeration_no'),
				'vendor_rate' => $this->input->post('vendor_rate'),
                'company_id'    =>$this->input->post('company_id'),
				'is_verify'=>1,
				'staff_id'=>$this->create_unique_slug($this->input->post('name')),
			);

			$data   = $this->security->xss_clean($data);
			$result = $this->vendor_model->add_state($data);
			$this->session->set_flashdata('success','Vendor has been added successfully');
			redirect(base_url('admin/vendor'));
		}
		else{
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['countries'] = $this->vendor_model->get_countries_list(); 
			$data['title'] = 'Add Vendor';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendor/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

    public function sendemail(){
        
        $project_id = 122;
        $userid    = "22";
        
        $base_url=''; 
        $config['upload_path']          =  $base_url.'uploads/';   
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

            $this->upload->initialize($this->set_upload_options($project_id, $userid));
            $this->upload->do_upload();
            $data = $this->upload->data();
            $image_name[] =$data['file_name'];
        }

        $to = $this->input->post('emails');
        
        
        $subject ="Call2Register";
        
        $message ="test";
        $senderEmail = $this->input->post('emails');
        $payment_link = $this->input->post('payment_link');
        
        $senderName  = "Call2Register";
        $from = $senderName." <".$senderEmail.">";  
        $headers = "From: $from"; 
        // Boundary  
        $semi_rand = md5(time());  
        $message = ' 
        <h3>Please click to below link for payment</h3> 
        <a href='.$payment_link.'>Pay</a>
        <p><b>Total Attachments:</b> '.count($files_my).'</p>'; 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
        // Preparing attachment 
        if(!empty($files_my)){ 
            for($i=0;$i<count($files_my);$i++){ 
                if(is_file($files_my[$i])){ 
                    $file_name = basename($files_my[$i]); 
                    $file_size = filesize($files_my[$i]); 

                    $message .= "--{$mime_boundary}\n"; 
                    $fp =    @fopen($files_my[$i], "rb"); 
                    $data =  @fread($fp, $file_size); 
                    @fclose($fp); 
                    $data = chunk_split(base64_encode($data)); 
                    $message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
                    "Content-Description: ".$file_name."\n" . 
                    "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                } 
            } 
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $senderEmail; 
        // Send email 
        $mail = mail($to, $subject, $message, $headers, $returnpath);  
        // Return true if email sent, otherwise return false 
        if($mail){ 
            $this->session->set_flashdata('success','Email send successfully!!');
            redirect($_SERVER['HTTP_REFERER']); 
        }else{ 
             $this->session->set_flashdata('success','Please try again something went wrong!!');
             redirect($_SERVER['HTTP_REFERER']); 

        } 
        redirect($_SERVER['HTTP_REFERER']); 
    
        
    }
    private function set_upload_options($project_id ='',$userid)
    {   
         $base_url='';
         $config = array();
        
        
         $config['upload_path']          =  $base_url.'uploads/'; 
        
         $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|txt|css|svg';
         $config['overwrite']     = FALSE;
         return $config;
    }
    
    function create_unique_slug($string,$field='order_id',$key=NULL,$value=NULL)
    {
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;

        if($key)$params["$key !="] = $value; 

        while ($t->db->where($params)->get('ci_services_form')->num_rows())
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
	public function edit($id=0)
	{
		if($this->input->post()){

            $this->form_validation->set_rules('name', 'name', 'trim|required');
	        $this->form_validation->set_rules('email', 'email', 'trim|required');
	         $this->form_validation->set_rules('status', 'status', 'trim|required');
            
			// $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
			// $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|matches[password]');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('admin/vendor/add'),'refresh');

				return;
			}

            $password = $this->input->post('password');

            if($password){
					$password = password_hash($password, PASSWORD_BCRYPT);
            }
            else{
            	  $password = $this->input->post('existpassword');
            }


			$data = array(
				'name' => ucfirst($this->input->post('name')),
				'slug' => make_slug($this->input->post('name')),
				'status' =>$this->input->post('status'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'registeration_no' => $this->input->post('registeration_no'),
				'vendor_currency'=> $this->input->post('vendor_currency'),
				'vendor_rate' => $this->input->post('vendor_rate'),
                'company_id'    =>$this->input->post('company_id'),
				'password' => $password,
			);


			$data = $this->security->xss_clean($data);

			$result = $this->vendor_model->edit_state($data, $id);

			if($result){
				$this->session->set_flashdata('success','Vendor has been updated successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		else{
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Update Vendor';
			$data['countries'] = $this->vendor_model->get_countries_list(); 
			$data['data'] = $this->vendor_model->get_state_by_id($id);
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendor/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{

        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_staffs', array('id' => $id));
		$this->session->set_flashdata('success', 'Vendor has been Deleted Successfully!');
		redirect(base_url('admin/vendor'));
	}
    	
    public function orders_del($id = 0)
	{
		$this->db->delete('ci_services_form', array('id' => $id));
		$this->session->set_flashdata('success', 'Orders has been Deleted Successfully!');
		redirect($_SERVER['HTTP_REFERER']);
        
	}
    
    
    public function orders($id = 0){
        
        $data['orders'] = $this->vendor_model->get_stfforder_by_id($id);
        $data['staff_id'] = $id;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/vendor/staff_orders.php', $data);
		$this->load->view('admin/includes/_footer', $data);

    }
    
    public function orders_edit($id = 0){
        
        
            $data['orders'] = $this->vendor_model->get_stfforder_by_order_id($id);
            $data['services'] = $this->dashboard_model->get_all_services();
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendor/staff_orders_edit.php', $data);
			$this->load->view('admin/includes/_footer', $data);
        
    }
    
    public function ordersupdate($id = 0){

        

      if($this->input->post()){

            $this->form_validation->set_rules('name','name','trim|required');
	        $this->form_validation->set_rules('email','email','trim|required');
	        $this->form_validation->set_rules('services','services','trim|required');
	        $this->form_validation->set_rules('mobile_no','mobile_no','trim|required');
	        $this->form_validation->set_rules('services','services','trim|required');
	        $this->form_validation->set_rules('subservicess','subservicess','trim|required');
	        $this->form_validation->set_rules('price','price','trim|required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');



            $eservices    =  serialize($this->input->post('eservices'));
            $esubservices =  serialize($this->input->post('esubservices'));
            $eprices      =  serialize($this->input->post('eprices'));
          
          
			$data = array(
				'name' => ucfirst($this->input->post('name')),
				'email'=> $this->input->post('email'),
				'mobile_no'=> $this->input->post('mobile_no'),
				'services'=> $this->input->post('services'),
				'subservices'=> $this->input->post('subservices'),
				'price'=> $this->input->post('prices'),
				'finalprice'=> $this->input->post('finalprice'),
                'userid'=>$this->input->post('userid'),
				'status'=> $this->input->post('status'),
				'remarks'=> $this->input->post('remarks'),
                'eservices'=> $eservices,
				'esubservices'=> $esubservices,
				'eprices'=> $eprices,
                'registered_users'=>1,
			);

          
            $staffid = $this->input->post('staffid');
			$data = $this->security->xss_clean($data);
			$result = $this->vendor_model->edit_orders($data, $id);

			if($result){
				$this->session->set_flashdata('success','Orders updated successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		else{
			$data['title'] = 'Update Vendor';
			$data['countries'] = $this->vendor_model->get_countries_list(); 
			$data['state'] = $this->vendor_model->get_state_by_id($id);
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendor/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
    }
    
    public function list_contact_query(){
        $data['info'] = $this->admin_model->list_contact_query();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/contacts/contacts_list', $data);
        $this->load->view('admin/includes/_footer', $data); 
    }
 
    public function addordersforstaff($staff_id = 0){
    	 
    	    $data['services'] = $this->dashboard_model->get_all_services();
    	    $data['staff_id'] = $staff_id;
            $this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendor/addorders', $data);
			$this->load->view('admin/includes/_footer', $data); 
    }


    public function addneworderssubmit(){
        

		if($this->input->post()){
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');

            $this->form_validation->set_rules('prices', 'prices', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $name         = $this->input->post('name');
            $mobile       = $this->input->post('mobile');
            $services     = $this->input->post('services');
            $subservicess = $this->input->post('subservices');
            $prices       = $this->input->post('prices');
            $message      = $this->input->post('message');
            $staffid      = $this->input->post('staffid');
            $userid       = $this->input->post('userid');
            
            
            
            $eservices    =  serialize($this->input->post('eservices'));
            $esubservices =  serialize($this->input->post('esubservices'));
            $eprices      =  serialize($this->input->post('eprices'));
            
            $date         = date('Y-m-d');

            $staff_data = $this->vendor_model->getstaff_byid($staffid); 
            $staffemail = $staff_data[0]['Email'];
            
            $order_id = "c2r".$this->create_unique_slug(rand(1,999999));
            
			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

			     redirect($_SERVER['HTTP_REFERER']);
			}
			$data = array(
                
				'name'       => ucfirst($this->input->post('name')),
                'date_entry' => date('Y-m-d'),
				'email'      => $this->input->post('email'),
				'mobile_no'  => $this->input->post('mobile'),
				'services'   => $this->input->post('services'),
				'subservices'=> $this->input->post('subservices'),
				'price'      => $this->input->post('prices'),
                'finalprice'=> $this->input->post('finalprice'),
                'userid'=>$this->input->post('userid'),
				'message'=>$this->input->post('message'),
				'status'=>$this->input->post('status'),
				'registered_users'=>1,
				'order_id'=>$order_id,
                'eservices'=> $eservices,
				'esubservices'=> $esubservices,
				'eprices'=> $eprices,
                'staffid'=>$staffid
                
			);
			$data   = $this->security->xss_clean($data);
			$result = $this->services_user_model->add_services($data);
            if($result)
            {
                
            $to   = $staffemail;
                
            $sstaff_id = "";
                
            $base = base_url();
            $subject = "Call2register";
            $message ="
            <html>
            <head>
                <title>Call2register</title>
            </head>
            <style>
             .wrap-image img
             {
                 width:120px;
                 text-align:center;
                 margin:auto;
             }
            </style>
            <body>
            <div class='wrap-image' style='max-width:300px;'>
                <img src='$base/assets/users/images/call2register-logo.png' style='width:100%'>
            </div>
            
            <p><b>Name:</b>$name<p>
            <p><b>Mobile:</b>$mobile<p>
            <p><b>Services</b>$services<p>
            <p><b>Subservices:</b>$subservicess<p>
            <p><b>Price:</b>$prices<p>
            <p><b>Date:</b>$date<p>
            <p><b>Message:</b>$message<p>
            <p><b>Customer Id:</b>$userid<p>
            <p>The Call2register team</p>
            <p>P.S. Need help? Contact us anytime with your questions and/or feedback.</p>

            </body>
            </html>";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Call2register  <support@call2register.com>' . "\r\n";
            $headers .= 'Cc: support@call2register.com' . "\r\n";
            $mail = mail($to,$subject,$message,$headers);
               
            }
			$this->session->set_flashdata('success','Order has been added successfully');
			redirect(base_url('admin/vendor/orders/'.$staffid.''),'refresh');
		}
		else{
            //redirect(base_url('dashboard/business_registeration'));
		}

    }
    
    public function contacts_del($id = 0){
		$this->db->delete('ci_contact', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect($_SERVER['HTTP_REFERER']);
 
    }
    
    public function generatepdf($id = 0){
        $data = []; 
        $data['orders'] = $this->vendor_model->get_stfforder_by_order_id_pdf($id);
        $this->load->view('invoice',$data);
    }
    
     public function vendorimportcsv(){
         
     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){

                    
                    
                $vendor_name           = $line[0];
                $email                 = $line[1];
                $phone                 = $line[2];
                $vendorrate            = $line[3];
                    
                $address               = $line[4];
                $vendor_currency       = $line[5];
                    
                $status                = $line[6];



                    
                $data = array(
                        'name'  =>$vendor_name,
                        'slug'  =>make_slug($vendor_name),
                        'email' =>$email,
                        'phone' =>$phone,
                        'address'=>$address,
                        'vendor_currency'=>$vendor_currency,
                        'vendor_rate' =>$vendorrate,
                        'staff_id'=>$this->create_unique_slug($vendor_name),
                );

			$data   = $this->security->xss_clean($data);
			$result = $this->vendor_model->add_state($data);      
            $this->session->set_flashdata('success','Agents has been added successfully');
           

                

                     // unset($explode_gallery);

                    //  }
                    
                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/vendor'),'refresh');
            }
            else{
                $qstring = '?status=err';
            }
        }else{
            $qstring = '?status=invalid_file';
              return redirect()->back();     
        }
        
    }
    
    public function count_vendors_byid($company_id)
        
        
    {
        return "try to count vendors thanks";
    }
    
    
}

?>