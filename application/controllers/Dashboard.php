<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct(){
        parent::__construct();
  		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('admin/staff_auth_model','staff_auth_model');
		$this->load->model('Dashboard_Model','dashboard_model');
       // $this->load->model('admin/dashboard_model', 'dashboard_model');
          
      
    }
	function index(){

        $data['documents'] = $this->dashboard_model->lastdocument();
        $data['allblogs'] = $this->dashboard_model->get_allblogs_grid();
		$this->load->view('header.php',$data);
		$this->load->view('index.php',$data);
		$this->load->view('footer.php',$data);
        
        
	}
	public function business_registeration(){
  
        $data['services'] = $this->dashboard_model->get_all_services();
        $this->load->view('header.php');
        $this->load->view('business_registeration.php',$data);
        $this->load->view('footer.php'); 
	}
	function login(){
        $this->load->view('header.php');
        $this->load->view('login.php');
        $this->load->view('footer.php');
	}
	public function selectservicesid(){
	    $serviceid = $_POST['selectservicesid'];
        $this->db->from('services');
        $this->db->where('id',$serviceid);
        $query=$this->db->get();
        $data = $query->result_array();

        $html = "<option>Select Sub Category</option>";
        foreach($data as $keys=>$values){
            if($values['subservices']){
                foreach(unserialize($values['subservices']) as $keys=>$values){
                        $html .= '<option value="'.$keys.'">'.$keys.'</option>';
                }
            }
        }
        
        echo $html;
	}
	public function selectprice_bykeys(){
        
	      $serviceid    = $_POST['selectservicesid'];
          $subservices_key = $_POST['subservices_key'];
         
         
         $this->db->from('services');
         $this->db->where('id',$serviceid);
         $query=$this->db->get();
         $data = $query->result_array();
        
        
         foreach($data as $keys=>$values){
            if($values['subservices']){

               $getprice = unserialize($values['subservices']);
              
               $html = $getprice[$subservices_key];
            }
        }
        echo $html;
	}
    
    
    public function llp(){
        $data['documents'] = $this->dashboard_model->lastdocument();
        $data['services'] = $this->dashboard_model->get_all_services();
        $this->load->view('header.php',$data);
		$this->load->view('llp.php',$data);
		$this->load->view('footer.php');
    }
    
    public function contact(){
        $data['services'] = $this->dashboard_model->get_all_services();
        $this->load->view('header.php',$data);
		$this->load->view('contact.php',$data);
		$this->load->view('footer.php',$data);
    }

    public function singleblog(){
        
        $data['services'] = $this->dashboard_model->get_all_services();
        
        $this->load->view('header.php');
		$this->load->view('singleblog.php',$data);
		$this->load->view('footer.php');
    }

    public function blogs(){
        

        $data['allblogs'] = $this->dashboard_model->get_allblogs_grid();
        $this->load->view('header.php');
		$this->load->view('blogs.php',$data);
		$this->load->view('footer.php');
        
    }
    
    public function gstregistration(){
        
        $data['services'] = $this->dashboard_model->get_all_services();
        
        $this->load->view('header.php');
		$this->load->view('gstregistration.php',$data);
		$this->load->view('footer.php');
    }

    
    public function download(){
        

        $data['alldownload'] = $this->dashboard_model->get_all_download();
        $this->load->view('header.php');
		$this->load->view('downloads.php',$data);
		$this->load->view('footer.php');
        
    }
    public function single_post($slug = 0){
        $data['blogs']    = $this->dashboard_model->get_blogs_slug($slug);
        $data['allblogs'] = $this->dashboard_model->get_allblogs($slug);
        $this->load->view('header.php');
		$this->load->view('singleblog.php',$data);
		$this->load->view('footer.php');
    }
    public function services_add()
	{
    
		if($this->input->post()){

		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|is_unique[email.name]|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');


	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/staff/add'),'refresh');
				//return;
			}

			$data = array(
				'name' => ucfirst($this->input->post('name')),
				'slug' => make_slug($this->input->post('name')),
				'Email' => $this->input->post('email'),
				'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'is_verify'=>1,
				'staff_id'=>$this->create_unique_slug($this->input->post('name')),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->location_model->add_state($data);
			$this->session->set_flashdata('success','Staff has been added successfully');
			redirect(base_url('admin/staff'));
		}
		else{
			$data['countries'] = $this->location_model->get_countries_list(); 
			$data['title'] = 'Add Staff';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/staff/staff_add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}
    
   public function forgot(){
            $this->load->view('header');
            $this->load->view('forgot');
            $this->load->view('footer');
    }
    
    
    public function contactformsubmit(){
    
        
        if($this->input->post()){

		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');   
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {


				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('dashboard/contact'),'refresh');
				//return;
			}
            $firstname = $this->input->post('firstname');
            $email     = $this->input->post('email');
            $mobile    = $this->input->post('mobile');
            $message   = $this->input->post('message');
			$data = array(
				'firstname' => ucfirst($this->input->post('firstname')),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'message' => $this->input->post('message'),
				'date'=>date('Y-m-d'),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->dashboard_model->add_contact_query($data);
            
            
            if($result)
            {
                
            $to   = "krishnakr82849@gmail.com";
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
            
            <p><b>Name:</b>$firstname<p>
            <p><b>Email:</b>$email<p>
            <p><b>Mobile:</b>$mobile<p>
            <p><b>Message</b>$message<p>
   

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
            
			$this->session->set_flashdata('success','Thank You for Contacting Us. We will respond to you as soon as possible.');
			redirect(base_url('dashboard/contact'));
		}
		else{

			$this->load->view('header');
			$this->load->view('contact');
			$this->load->view('footer');
		}
    }
    
    
    
    public function submitexpertcall(){
        
        if($this->input->post()){

            $this->form_validation->set_rules('fullname', 'fullname', 'trim|required');

            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            
         
            
            
   
                if ($this->form_validation->run() === FALSE) {


                    $data = array(
                        'errors' => validation_errors()
                    );
                    $this->session->set_flashdata('form_data', $this->input->post());
                    $this->session->set_flashdata('errors', $data['errors']);
                    redirect($_SERVER['HTTP_REFERER']);
                    //redirect(base_url('admin/staff/add'),'refresh');
                    //return;
                }

                $data = array(
                    'name' => ucfirst($this->input->post('fullname')),
                    'email' => $this->input->post('email'),
                    'mobile' => $this->input->post('mobile'),
                    'service' => $this->input->post('service'),
                    'message' => $this->input->post('message'),
                    'created_date' => date('Y-m-d'),

                );

                $data = $this->security->xss_clean($data);
                $result = $this->dashboard_model->add_expertcall($data);
                $this->session->set_flashdata('success','Thank You for Contacting us!');
                redirect($_SERVER['HTTP_REFERER']);
            }
		
    }
    
    
}

?>