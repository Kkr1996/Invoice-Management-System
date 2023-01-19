<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Services extends CI_Controller
{
    function __construct(){
        parent::__construct();
  		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Services_User_Model','services_user_model');
		$this->load->model('Dashboard_Model','dashboard_model');
      //  $this->load->model('admin/Vendor_Model', 'vendor_Model');
    }

	function index(){

         if($this->session->has_userdata('is_admin_login')){
                redirect('admin/dashboard');
            }
            else{
                redirect('admin/auth/login');
            }
	}
    
    public function services_form_submit()
	{
        

        if($this->session->has_userdata('is_user_login')){
            $registered_user  = 1;
        }
        else{
            //$this->session->set_flashdata('error','Please login before submit services forms');
           // redirect($_SERVER['HTTP_REFERER']);
            $registered_user  = 0;
        }
        
        
      
		if($this->input->post()){

            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');

            $this->form_validation->set_rules('prices', 'prices', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $userid       = $this->session->userdata('customerid');
            $name         = $this->input->post('name');
            $mobile       = $this->input->post('mobile');
            $services     = $this->input->post('services');
            $subservicess = $this->input->post('subservices');
            $prices       = $this->input->post('prices');
            $message      = $this->input->post('message');
            $staffid      = $this->input->post('staffid');
            
            
            $date         = date('Y-m-d');
            
            $order_id = "c2r".$this->create_unique_slug(rand(1,999999));
            $staff_data = $this->location_model->getstaff_byid($staffid);
          
            $staffemail = $staff_data[0]['Email'];
            
			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('dashboard/llp'),'refresh');
			}
            
			$data = array(
				'name'       => ucfirst($this->input->post('name')),
                'date_entry' => date('Y-m-d'),
				'email'      => $this->input->post('email'),
				'mobile_no'  => $this->input->post('mobile'),
				'services'   => $this->input->post('services'),
				'subservices'=> $this->input->post('subservices'),
				'price'      => $this->input->post('prices'),
				'message'=>$this->input->post('message'),
				'status'=>"New(default)",
				'order_id'=>$order_id,
                'staffid'=>$staffid,
                'userid'=>$userid,
                'registered_users'=>$registered_user 
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
            
            
			$this->session->set_flashdata('success','Thank you for successfully submit!!!');
			redirect(base_url('dashboard/llp'),'refresh');
		}
		else{
		//	$data['countries'] = $this->services_user_model->get_countries_list(); 
			//$data['title'] = 'Add Staff';
			//$this->load->view('admin/includes/_header');
			//$this->load->view('admin/staff/staff_add');
			//$this->load->view('admin/includes/_footer');
            redirect(base_url('dashboard/business_registeration'));
		}
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

    public function gstregisteration(){

        $this->load->view('header.php');
		$this->load->view('allservices/gstregisteration.php');
		$this->load->view('footer.php');
    }
    public function msmeregisteration(){
        $this->load->view('header.php');
		$this->load->view('allservices/msmeregisteration.php');
		$this->load->view('footer.php');
    }
    public function profesional_tax_registeration(){
        $this->load->view('header.php');
		$this->load->view('allservices/profesional_tax_registeration.php');
		$this->load->view('footer.php');
    }    
    public function import_export_code(){
        $this->load->view('header.php');
		$this->load->view('allservices/import_export_code.php');
		$this->load->view('footer.php');
    }   
    public function digital_signature_cert(){
        $this->load->view('header.php');
		$this->load->view('allservices/digital_signature_cert.php');
		$this->load->view('footer.php');
    }  
    public function pf_esi_registeration(){
        $this->load->view('header.php');
		$this->load->view('allservices/pf_esi_registeration.php');
		$this->load->view('footer.php');
    }   
    public function gem_registeration(){
        $this->load->view('header.php');
		$this->load->view('allservices/gem_registeration.php');
		$this->load->view('footer.php');
    }   
    public function startup_india_registeration(){
        $this->load->view('header.php');
		$this->load->view('allservices/startup_india_registeration.php');
		$this->load->view('footer.php');
    } 
    
    
    public function iso_9001_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_9001_certification.php');
		$this->load->view('footer.php');
    }   
    public function iso_13485_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_13485_certification.php');
		$this->load->view('footer.php');
    }   
    
    public function iso_14001_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_14001_certification.php');
		$this->load->view('footer.php');
    }    
        
    public function iso_22000_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_22000_certification.php');
		$this->load->view('footer.php');
    }    
    
    public function iso_27001_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_27001_certification.php');
		$this->load->view('footer.php');
    }   
    public function iso_45001_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_45001_certification.php');
		$this->load->view('footer.php');
    }   
    
    public function iso_50001_certification(){
        $this->load->view('header.php');
		$this->load->view('allservices/iso_50001_certification.php');
		$this->load->view('footer.php');
    }   
    public function other_compliance_certificate(){
        $this->load->view('header.php');
		$this->load->view('allservices/other_compliance_certificate.php');
		$this->load->view('footer.php');
    }
    
    
    
    
}

?>