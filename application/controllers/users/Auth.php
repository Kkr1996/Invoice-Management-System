<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('users/Auth_model', 'auth_model');
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/Activity_model', 'activity_model');
	}
	//--------------------------------------------------------------
	public function index(){
		if($this->session->has_userdata('is_user_login')){
		///	redirect('admin/dashboard');
		}
		else{
			//redirect('admin/auth/login');
		}
	}
    
	//--------------------------------------------------------------
	public function login(){
        
		if($this->input->post('submit')){
            
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/login'),'refresh'); 
			}
			else {
                
				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password')
				);
				$result = $this->auth_model->login($data);
				if($result){
                    
           
					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(base_url('login'));
						exit();
					}
                    if($result['is_active'] == 0){
						$this->session->set_flashdata('error', 'Please contact with administration');
						redirect(base_url('login'));
						exit();
					}
//					if($result['is_active'] == 0){
//						$this->session->set_flashdata('error', 'Account is disabled by Admin!');
//						redirect(base_url('auth/login'));
//						exit();
//					}
                    
                    
					if($result['is_verify'] == 1){
						$user_data = array(
							'userid' => $result['id'],
							'username' => $result['username'],
							'customerid' => $result['member_id'],
							'is_user_login' => TRUE
						);
						$this->session->set_userdata($user_data);
						$this->rbac->set_access_in_session(); 
                        redirect(base_url('/users/auth/dashboard'), 'refresh');
					}
					else{
						$this->session->set_flashdata('errors', 'Invalid Username or Password!');
						redirect(base_url('auth/login'));
					}
                    
                    
				}
                else{
                    $this->session->set_flashdata('error','Invalid');
                    redirect(base_url('login'),'refresh');
                }
			}
            
            }
            
			else{
				$data['title'] = 'Login';
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;

				$this->load->view('admin/includes/_header', $data);
				$this->load->view('admin/auth/login');
				$this->load->view('admin/includes/_footer', $data);
			}
		}	
    
      public function dashboard(){
           if($this->session->has_userdata('is_user_login')){

                    $this->load->view('users/header');
                    $this->load->view('users/index');
                    $this->load->view('users/footer');
            }
            else{
                    redirect('/');
            }     
      }

		//-------------------------------------------------------------------------
		public function register(){
		 if($this->input->post('submit')){
             
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
             
            $username          = $this->input->post('username');
            $email             = $this->input->post('email');
             
            $member_id         = "c2r".substr($username,0,2).rand(1,999999);
             
             
            $member_id =  $this->create_unique_slug($member_id);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('users/auth/register'),'refresh');
			}
			else{
                
                $response = $this->auth_model->check_user_mail($email);
                if($response == "true"){
       
                    $this->session->set_flashdata('errors', "Email is already registered, Please login");
                    redirect(base_url('login'),'refresh'); 
                }
                else{

                }

				$data = array(
                    
					'username'   =>$this->input->post('username'),
					'email'      =>$this->input->post('email'),
					'mobile_no'  =>$this->input->post('mobile'),
					'password'   =>password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'member_id'  =>$member_id,
					'created_at' =>date('Y-m-d : h:m:s'),
					'updated_at' =>date('Y-m-d : h:m:s'),
                    
				);
                
            mkdir($base_url.'uploads/users/'.$member_id , 0777, TRUE);
                
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
            <p>Please click this link to verify your   address and activate your account:</p>
            <a href='$base/users/auth/confirmation/$member_id'>Confirm my account</a>

            <p>Note : After verification your account will be activated. Thank You!</p>
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
                
                
            $data   = $this->security->xss_clean($data);
            $result = $this->user_model->add_user($data);
                if($result){
                    $this->activity_model->add_log(1);
                    $this->session->set_flashdata('success', 'User has been added successfully! Please verify your email address!');
                    redirect(base_url('login'));
                }
			}
			}
			else{
				$data['title'] = 'Create an Account';
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;

				$this->load->view('admin/includes/_header', $data);
				$this->load->view('admin/auth/register');
				$this->load->view('admin/includes/_footer', $data);
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
		//----------------------------------------------------------	
		public function verify(){

			$verification_id = $this->uri->segment(4);
			$result = $this->auth_model->email_verification($verification_id);
			if($result){
				$this->session->set_flashdata('success', 'Your email has been verified, you can now login.');
				redirect(base_url('admin/auth/login'));
			}
			else{
				$this->session->set_flashdata('success', 'The url is either invalid or you already have activated your account.');	
				redirect(base_url('admin/auth/login'));
			}	
		}

    
 
    
    
		//--------------------------------------------------		
		public function forgot_password(){

			if($this->input->post('submit')){
				//checking server side validation
				$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/auth/forget_password'),'refresh');
				}

				$email = $this->input->post('email');
				$response = $this->auth_model->check_user_mail($email);

				if($response){

					$rand_no = rand(0,1000);
					$pwd_reset_code = md5($rand_no.$response['admin_id']);
					$this->auth_model->update_reset_code($pwd_reset_code, $response['admin_id']);
					
					// --- sending email
					$to = $response['email'];
					$mail_data= array(
						'fullname' => $response['firstname'].' '.$response['lastname'],
						'reset_link' => base_url('admin/auth/reset_password/'.$pwd_reset_code)
					);
					$this->mailer->mail_template($to,'forget-password',$mail_data);

					if($email){
						$this->session->set_flashdata('success', 'We have sent instructions for resetting your password to your email');

						redirect(base_url('admin/auth/forgot_password'));
					}
					else{
						$this->session->set_flashdata('error', 'There is the problem on your email');
						redirect(base_url('admin/auth/forgot_password'));
					}
				}
				else{
					$this->session->set_flashdata('error', 'The Email that you provided are invalid');
					redirect(base_url('admin/auth/forgot_password'));
				}
			}
			else{

				$data['title'] = 'Forget Password';
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;

				$this->load->view('admin/includes/_header', $data);
				$this->load->view('admin/auth/forget_password');
				$this->load->view('admin/includes/_footer', $data);
			}
		}

		//----------------------------------------------------------------		
		public function reset_password($id=0){

			// check the activation code in database
			if($this->input->post('submit')){
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
				$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);

					$this->session->set_flashdata('reset_code', $id);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
  
				else{
					$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
					$this->auth_model->reset_password($id, $new_password);
					$this->session->set_flashdata('success','New password has been Updated successfully.Please login below');
					redirect(base_url('admin/auth/login'));
				}
			}
			else{
				$result = $this->auth_model->check_password_reset_code($id);

				if($result){

					$data['title'] = 'Reseat Password';
					$data['reset_code'] = $id;
					$data['navbar'] = false;
					$data['sidebar'] = false;
					$data['footer'] = false;
					$data['bg_cover'] = true;

					$this->load->view('admin/includes/_header', $data);
					$this->load->view('admin/auth/reset_password');
					$this->load->view('admin/includes/_footer', $data);

				}
				else{
					$this->session->set_flashdata('error','Password Reset Code is either invalid or expired.');
					redirect(base_url('admin/auth/forgot_password'));
				}
			}
		}

		//-----------------------------------------------------------------------
    
        public function confirmation($userid)
        {
            $results = $this->auth_model->confirmation($userid);

            if($results)
            {
                $this->session->set_flashdata('message','Confirm successfully,account activated Please login.');
                redirect('login');
            }
            else
            {
                $this->session->set_flashdata('message','Something Wrong please contact to admin');
                redirect('login'); 
            }
        }
    
    
    
		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url('/'), 'refresh');
		}
		
		// Get Country. State and City
		//----------------------------------------
		public function get_country_states()
		{
			$states = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('ci_states')->result_array();
		    $options = array('' => 'Select Option') + array_column($states,'name','id');
		    $html = form_dropdown('state',$options,'','class="form-control select2" required');
			$error =  array('msg' => $html);
			echo json_encode($error);
		}

		//----------------------------------------
		public function get_state_cities()
		{
			$cities = $this->db->select('*')->where('state_id',$this->input->post('state'))->get('ci_cities')->result_array();
		    $options = array('' => 'Select Option') + array_column($cities,'name','id');
		    $html = form_dropdown('city',$options,'','class="form-control select2" required');
			$error =  array('msg' => $html);
			echo json_encode($error);
		}

	}  // end class


?>