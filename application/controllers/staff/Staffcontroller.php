<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Staffcontroller extends MY_Controller
{
    function __construct(){
        parent::__construct();
  		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('admin/staff_auth_model','staff_auth_model');
        $this->load->model('admin/location_model', 'location_model');
        $this->load->model('Dashboard_Model','dashboard_model');
        $this->load->model('admin/Admin_model', 'admin_model');
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/Activity_model', 'activity_model');
        $this->load->model('Services_User_Model','services_user_model');
    }
	function index(){
		if($this->session->has_userdata('is_staff_login')){
			$this->load->view('staff/header.php');
			$this->load->view('staff/index.php');
			$this->load->view('staff/footer.php');
		}
		else{
			redirect('staff/login');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('staff/login'), 'refresh');
	}
	public function profile(){
		if($this->session->has_userdata('is_staff_login')){
			$data['results'] =  $this->staff_auth_model->getprofiledetails();
			$this->load->view('staff/header.php',$data);
			$this->load->view('staff/profile.php',$data);
			$this->load->view('staff/footer.php');
		}
		else{
			redirect('staff/login');
		}
	}

	public function update_profile(){


     if($this->session->has_userdata('is_staff_login')){

	 if($this->input->post()){
         
     
		$this->form_validation->set_rules('name', 'name', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim|is_unique[ci_states.name]');
		$this->form_validation->set_rules('password', 'password', 'trim');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|matches[password]');


	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('staff/staffcontroller/profile'),'refresh');
				//return;
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
				'Email' => $this->input->post('email'),
				'password' =>  $password,
				'is_verify'=>1,
				
			);

			$data   = $this->security->xss_clean($data);
			$result = $this->staff_auth_model->updatestaff($data);

			$this->session->set_flashdata('success','Staff has been added successfully');

			redirect(base_url('staff/staffcontroller/profile'));
		}
		else{

			$data['results'] =  $this->staff_auth_model->getprofiledetails();
			$this->load->view('staff/header.php',$data);
			$this->load->view('staff/profile.php',$data);
			$this->load->view('staff/footer.php');
		}




		}
		else{
			redirect('staff/login');
		}	
	}
    
    public function services_query(){
        
       if($this->session->has_userdata('is_staff_login')){
           
        $staffid = $this->session->userdata('staffid');
   
        $data['results'] =  $this->staff_auth_model->service_query_form($staffid);

            $this->load->view('staff/header.php');
			$this->load->view('staff/services_query.php',$data);
			$this->load->view('staff/footer.php');
        }
        else{
            redirect('staff/login');
        }
    }
    
    public function edit($id=0){
        
       if($this->session->has_userdata('is_staff_login')){
           
          //  $staffid         =  $this->session->userdata('staffid');
            $data['results'] =  $this->staff_auth_model->service_query_form_edit($id);
            $this->load->view('staff/header.php');
            $this->load->view('staff/service_query_form_edit.php',$data);
            $this->load->view('staff/footer.php');
        }
        else{
            redirect('staff/login');
        }
    }
    public function orders_edit($id=0){ 
        
       if($this->session->has_userdata('is_staff_login')){
           
   
            $data['orders'] =  $this->staff_auth_model->service_query_orders_edit($id);
            $this->load->view('staff/header.php');
            $this->load->view('staff/orders_edit.php',$data);
            $this->load->view('staff/footer.php');
        }
        else{
            redirect('staff/login');
        }
        
    }
    public function ordersupdate($id = 0){
        
      if($this->input->post()){

            $this->form_validation->set_rules('name', 'name', 'trim|required');
	        $this->form_validation->set_rules('email', 'email', 'trim|required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
                
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}
          
          
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
			);

          
            $orderid = $this->input->post('orderid');
			$data    = $this->security->xss_clean($data);
			$result  = $this->location_model->edit_orders($data, $orderid);

			if($result){
				$this->session->set_flashdata('success','Orders updated successfully');
				redirect(base_url('staff/staffcontroller/orders_edit/'.$orderid));
			}
			
		}
		else{
			$data['title'] = 'Update Staff';
			$data['countries'] = $this->location_model->get_countries_list(); 
			$data['state'] = $this->location_model->get_state_by_id($id);
			$this->load->view('staff/header', $data);
			$this->load->view('staff/orders_edit', $data);
			$this->load->view('staff/footer', $data);
		}
    }
    
    public function addorders(){
        $data['title'] = 'Add Staff';
        
        $data['services'] = $this->dashboard_model->get_all_services();
        $data['staff_id'] = $this->session->userdata('staffid');
        $this->load->view('staff/header', $data);
        $this->load->view('staff/addorder', $data);
        $this->load->view('staff/footer', $data);

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
    
    public function users(){
        
        $data['data'] = $this->user_model->get_all_users();
        $this->load->view('staff/header', $data);
        $this->load->view('staff/userlist', $data);
        $this->load->view('staff/footer', $data);

     
    }
    
    public function list_contact_query(){
        
        $data['info'] = $this->admin_model->list_contact_query();
        $data['staff_id'] = $this->session->userdata('staffid');
        $this->load->view('staff/header', $data);
        $this->load->view('staff/contactlist', $data);
        $this->load->view('staff/footer', $data);
    }  
    
    
    public function help(){
      	$data['data'] = $this->dashboard_model->get_all_help();

        $this->load->view('staff/header', $data);
        $this->load->view('staff/helplist', $data);
        $this->load->view('staff/footer', $data);
    }   
    public function expertcall(){
      	$data['data'] = $this->dashboard_model->get_all_expercall();

        $this->load->view('staff/header', $data);
        $this->load->view('staff/expertcall', $data);
        $this->load->view('staff/footer', $data);
    }   
    
    public function add(){
      	$data['data'] = $this->dashboard_model->get_all_help();
        $this->load->view('staff/header', $data);
        $this->load->view('staff/adduser', $data);
        $this->load->view('staff/footer', $data);
    }
    public function addusers(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
                
				redirect(base_url('staff/staffcontroller/add'),'refresh');
			}
			else{
                 $username    = $this->input->post('username');
                 $member_id   = "c2r".substr($username,0,2).rand(1,999999);
                 $member_id   = $this->create_unique_slug($member_id);
				 $data = array(
					'username'  => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname'  => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' =>$this->input->post('mobile_no'),
					'address' =>$this->input->post('address'),
					'password' =>password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'member_id'=>$member_id,
                    'is_verify'=>1,
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
                
                $email = $this->input->post('email');
                $pass = $this->input->post('password');
                
                
            $to   = $this->input->post('email');     
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
            
            <p>Please login to check your orders status.</p>
            <p><strong>Email: </strong>$email</p>
            <p><strong>Password: </strong>$pass</p>
            
            <a href='$base/login'>Login</a>

        
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
                
                
                
                
                
                
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'User has been added successfully!');
					redirect(base_url('staff/staffcontroller/users'));
				}
			}
		}
		
		
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
    
    public function users_edit($id = 0){
        
            $data['user'] = $this->user_model->get_user_by_id($id);
            $this->load->view('staff/header', $data);
            $this->load->view('staff/editusers', $data);
            $this->load->view('staff/footer', $data);
        
    }
    
    
    public function updateesuers($id = 0){

		if($this->input->post('submit')){
            
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'Username', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
            
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
                     redirect($_SERVER['HTTP_REFERER']);
					//redirect(base_url('staff/staffcontroller/user_edit/'.$id),'refresh');
			}
			else{  
            $project_id = 122;
            $userid = $this->input->post('userid');

            //    $size_img   =$_POST['file_size'];
            //    if($size_img == 'exceed')
            //    {
            //        $this->session->set_flashdata('size_exceed','Size should be less than 2MB'); 
            //        redirect('expert/Dashboard/expert_detail/'.$project_id);
            //    }

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

                $this->upload->initialize($this->set_upload_options_users($project_id, $userid));
                $this->upload->do_upload();
                $data = $this->upload->data();
                $image_name[] =$data['file_name'];
            }
                
//                echo '<pre>', var_dump($files_my); echo '</pre>';
//                
//                die();
                
                $serialize_files = serialize($files_my);
                
                
                
                $data = array(
                    
					'username'   =>$this->input->post('username'),
					'firstname'  =>$this->input->post('firstname'),
					'lastname'   =>$this->input->post('lastname'),
					'email'      =>$this->input->post('email'),
					'mobile_no'  =>$this->input->post('mobile_no'),
					'password'   =>password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_active'  =>$this->input->post('status'),
                    'files'      =>$serialize_files,
					'updated_at' =>date('Y-m-d  h:m:s')
                    
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);
				if($result){
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'User has been updated successfully!');
                    redirect($_SERVER['HTTP_REFERER']);
				}       
                
                
                
                
                
                
                
                
			}
		}
		
	}

    private function set_upload_options_users($project_id ='',$userid)
    {   
         $base_url='';
         $config = array();
        
        
         $config['upload_path']          =  $base_url.'uploads/users/'.$userid.'/'; 
        
         $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|txt|css|svg';
         $config['overwrite']     = FALSE;
         return $config;
    }
   
    public function addneworderssubmit(){
        
     
		if($this->input->post()){
            
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
            $this->form_validation->set_rules('prices', 'prices', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            
          //  $userid       = $this->session->userdata('customerid');
            $name         = $this->input->post('name');
            $mobile       = $this->input->post('mobile');
            $services     = $this->input->post('services');
            $subservicess = $this->input->post('subservices');
            $prices       = $this->input->post('prices');
            $message      = $this->input->post('message');
            $staffid      = $this->session->userdata('staffid');
            
            
            $eservices    =  serialize($this->input->post('eservices'));
            $esubservices =  serialize($this->input->post('esubservices'));
            $eprices      =  serialize($this->input->post('eprices'));
            $date         =  date('Y-m-d');

            $staff_data = $this->location_model->getstaff_byid($staffid); 
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
				'finalprice' => $this->input->post('finalprice'),
				'userid'     => $this->input->post('userid'),
				'message'    => $this->input->post('message'),
				'remarks'    => $this->input->post('remarks'),
				'status'     => $this->input->post('status'),
                'eservices'=> $eservices,
				'esubservices'=> $esubservices,
				'eprices'=> $eprices,
                'registered_users'=>1,
				'order_id'=>$order_id,
                'staffid'=>$staffid, 
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
			$this->session->set_flashdata('success','Services has been added successfully');
            redirect(base_url('staff/staffcontroller/services_query'));
		}
		else{
            //redirect(base_url('dashboard/business_registeration'));
		}

    } 
    public function users_delete($id = 0){

		$this->db->delete('ci_users', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect($_SERVER['HTTP_REFERER']);
 
    }
    
}

?>