<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Help extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
        
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/location_model', 'location_model');
		$this->load->model('admin/Admin_model', 'admin_model');
        $this->load->model('Dashboard_Model','dashboard_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->load->model('admin/Services_Model', 'services_model');
		$this->load->model('Services_User_Model','services_user_model');
	}
    
    
	public function index()
	{
     	$data['data'] = $this->dashboard_model->get_all_help();
		$this->load->view('admin/includes/_header',$data);
		$this->load->view('admin/help/index',$data);
		$this->load->view('admin/includes/_footer',$data);   
	}
    public function expertcall(){
      
      	$data['data'] = $this->dashboard_model->get_all_expertcall();
		$this->load->view('admin/includes/_header',$data);
		$this->load->view('admin/help/expertcall',$data);
		$this->load->view('admin/includes/_footer',$data);
    }
    
	function staff()
	{
		$data['title'] = 'Staff List';
        
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/staff/state_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

    
    
	//-------------------------------------------------------
	public function datatable_json()
	{				   					   
		$records = $this->dashboard_model->get_all_help();

        
        echo "Test";
        
        die();
		$data  = array();
		$count = 0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				$row['subject'],
				'<span class="btn btn-xs btn-success" title="status">'.$status.'<span>',				
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/staff/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
            	 <a title="Delete" class="delete btn btn-sm btn-danger" href="'.base_url('admin/staff/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------

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
            $this->form_validation->set_rules('subject', 'subject', 'trim|required');
        
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
			$data = array(
				'subject' => $this->input->post('subject'),
				'message' => $this->input->post('message'),

			);
			$data = $this->security->xss_clean($data);
			$result = $this->dashboard_model->edit_help($data, $id);

			if($result){
				$this->session->set_flashdata('success','Remarks has been updated successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		else{
          
		
			$data['data']     = $this->dashboard_model->get_expertcall_by_id($id);
            
           
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/help/helpedit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}	
    
    public function expertedit($id=0)
	{
		if($this->input->post()){
     
			$data = array(
				'message' => $this->input->post('message'),

			);
			$data = $this->security->xss_clean($data);
			$result = $this->dashboard_model->edit_expertedit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Remarks has been updated successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		else{
			$data['data']     = $this->dashboard_model->get_expertedit_by_id($id);
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/help/expertedit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function staff_del($id = 0)
	{

		$this->db->delete('ci_staffs', array('id' => $id));
		$this->session->set_flashdata('success', 'Staff has been Deleted Successfully!');
		redirect(base_url('admin/staff'));
	}
    	
    public function orders_del($id = 0)
	{
		$this->db->delete('ci_services_form', array('id' => $id));
		$this->session->set_flashdata('success', 'Orders has been Deleted Successfully!');
		redirect($_SERVER['HTTP_REFERER']);
        
	}
    
    
    public function orders($id = 0){
        
        $data['orders'] = $this->location_model->get_stfforder_by_id($id);
        $data['staff_id'] = $id;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/staff/staff_orders.php', $data);
		$this->load->view('admin/includes/_footer', $data);

    }
    
    public function orders_edit($id = 0){
        
        
            $data['orders'] = $this->location_model->get_stfforder_by_order_id($id);
            $data['services'] = $this->dashboard_model->get_all_services();
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/staff/staff_orders_edit.php', $data);
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


			// if ($this->form_validation->run() === FALSE) {
			// 	$data = array(
			// 		'errors' => validation_errors()
			// 	);
			// 	$this->session->set_flashdata('form_data', $this->input->post());
			// 	$this->session->set_flashdata('errors', $data['errors']);
			// 	redirect($_SERVER['HTTP_REFERER']);
			// 	return;
			// }



            //$services = $this->input->post('services');


			// echo $this->input->post('servicess');
			// echo $this->input->post('subservices');
			// echo $this->input->post('prices');

        

			$data = array(
				'name' => ucfirst($this->input->post('name')),
				'email'=> $this->input->post('email'),
				'mobile_no'=> $this->input->post('mobile_no'),
				'services'=> $this->input->post('servicess'),
				'subservices'=> $this->input->post('subservicess'),
				'price'=> $this->input->post('prices'),
                'userid'=>$this->input->post('userid'),
				'status'=> $this->input->post('status'),
				'remarks'=> $this->input->post('remarks'),
			);

          
            $staffid = $this->input->post('staffid');
			$data = $this->security->xss_clean($data);
			$result = $this->location_model->edit_orders($data, $id);

			if($result){
				$this->session->set_flashdata('success','Orders updated successfully');
				redirect(base_url('admin/staff/orders/'.$staffid));
			}
			
		}
		else{
			$data['title'] = 'Update Staff';
			$data['countries'] = $this->location_model->get_countries_list(); 
			$data['state'] = $this->location_model->get_state_by_id($id);
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/staff/staff_edit', $data);
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
			$this->load->view('admin/staff/addorders', $data);
			$this->load->view('admin/includes/_footer', $data); 
    }


    public function addneworderssubmit(){
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

            $staff_data = $this->location_model->getstaff_byid($staffid); 
            $staffemail = $staff_data[0]['Email'];
            
            $order_id = "c2r".$this->create_unique_slug(rand(1,999999));
            
			if ($this->form_validation->run() === FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('dashboard/business_registeration'),'refresh');
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
				'status'=>$this->input->post('status'),
				'order_id'=>$order_id,
                'staffid'=>$staffid,
                'userid'=>$userid
                
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
			redirect(base_url('admin/staff/orders/'.$staffid.''),'refresh');
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
    public function del($id = 0){

  
		$this->db->delete('help', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect($_SERVER['HTTP_REFERER']);
 
    }    
    
    public function expertdel($id = 0){

  
		$this->db->delete('expertcall', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect($_SERVER['HTTP_REFERER']);
 
    }
    
    public function generatepdf($id = 0){
        
        $this->load->library('pdf');
        $data = []; 
        $data['orders'] = $this->location_model->get_stfforder_by_order_id_pdf($id);
        $this->load->view('invoice',$data);
        
    }
}

?>