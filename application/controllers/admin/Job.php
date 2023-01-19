<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Company_Model', 'company_model');
		$this->load->model('admin/User_model', 'user_model');
		$this->load->model('admin/Agent_Model', 'agents_model');
	}
	public function index()
	{
		$records = $this->job_model->all_job();
    
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/job/job_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	function staff()
	{
		$data['title'] = 'State List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/staff/state_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	//-------------------------------------------------------

	//-----------------------------------------------------
	public function add()
	{

	  if($this->input->post()){
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('details', 'details', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/job/add'),'refresh');
			}
           
            $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("ci_job")->row();
            $last_id=$row->id + 1;
            
            $job_cat = $this->input->post('job_category');
            
            $get_three_letter = "JB".''.substr($job_cat, 0 , 1);
         
            
            if(strlen($last_id) > 2)
            {
              $job_id= $get_three_letter.''.date("ym").$last_id;  
            }
            else if(strlen($last_id) == 2)
            {
              $job_id= $get_three_letter.''.date("ym").'0'.$last_id;   
            }
            else if(strlen($last_id) == 1)
            {
              $job_id= $get_three_letter.''.date("ym").'00'.$last_id;     
            }
            
			//$rand_no = "JBE".rand(10000,99999);
			
			$data = array(
				'name'    => $this->input->post('name'),
				'details' => $this->input->post('details'),
				'price'   => $this->input->post('price'),
				'agents'   => $this->input->post('agents'),
				'job_category' => $job_cat,
				'jobid'   => $job_id,
				'status'  => $this->input->post('status'),
				'customer_id'         => $this->input->post('customer_id'),
				'job_currency'        => $this->input->post('job_currency'),
				'created_at'          => date("Y-m-d"),
                'company_id'          => $this->input->post('company_id'),
                'shipper'     => $this->input->post('shipper'),
				'consignee'   => $this->input->post('consignee'),
				'notify_party'=> $this->input->post('notify_party'),
                'utm'=> $this->input->post('utm'),
                'billing_party'          => $this->input->post('billing_party'),
                'shipment'               => $this->input->post('shipment'),
                'commercial_invoices'    => $this->input->post('commercial_invoices'),
                'loading_point'          => $this->input->post('loading_point'),
                'delivery_point'         => $this->input->post('delivery_point'),
				'product_description'         => $this->input->post('product_description'),
				'qty'                         => $this->input->post('qty'),
				'weight'                      => $this->input->post('weight'),
				'slug'                        => make_slug($this->input->post('name')),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->job_model->add($data);       
			$this->session->set_flashdata('success','Job has been added successfully');
			redirect(base_url('admin/job'));
		}
		else{
        
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Job';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/job/job_add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

    function create_unique_slug($string,$field='jobid',$key=NULL,$value=NULL)
    {
        $t=&get_instance();
        $slug =url_title($string);
        $slug =strtolower($slug);

        $i = 0;
        $params = array ();
        $params[$field] = $slug;

        if($key)$params["$key !="] = $value; 

        while ($t->db->where($params)->get('ci_job')->num_rows())
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
			$this->form_validation->set_rules('details', 'details', 'trim|required');
			$this->form_validation->set_rules('price', 'price', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/services/add'),'refresh');
				return;
			}
            
            $job_cat = $this->input->post('job_category');
            
            
            //echo  $this->input->post('shipper');
            
            
       
			$data = array(
				'name'    => $this->input->post('name'),
				'details' => $this->input->post('details'),
				'price'   => $this->input->post('price'),
				'status'  => $this->input->post('status'),
				'product_description'         => $this->input->post('product_description'),
				'qty'                         => $this->input->post('qty'),
				'weight'                      => $this->input->post('weight'),
                'shipper'     => $this->input->post('shipper'),
				'consignee'   => $this->input->post('consignee'),
				'notify_party'=> $this->input->post('notify_party'),
                'utm'=> $this->input->post('utm'),
				'job_category'=> $job_cat,
				'job_currency'  => $this->input->post('job_currency'),
                'company_id'          => $this->input->post('company_id'),
				'customer_id'         => $this->input->post('customer_id'),
				'billing_party'          => $this->input->post('billing_party'),
                'shipment'               => $this->input->post('shipment'),
                'commercial_invoices'    => $this->input->post('commercial_invoices'),
                'loading_point'          => $this->input->post('loading_point'),
                'delivery_point'         => $this->input->post('delivery_point'),
				'agents'   => $this->input->post('agents'),
				'created_at' => date("Y-m-d"),
				'slug' => make_slug($this->input->post('name')),
			);
			
			$data   = $this->security->xss_clean($data);
			$result = $this->job_model->edit_job($data, $id);

			if($result){
				$this->session->set_flashdata('success','Job has been updated successfully');
				redirect(base_url('admin/job/edit'.'/'.$id));
			}
			
		}
		else{
            
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;

			$data['title'] = 'Update Job';
			$data['jobs'] = $this->job_model->get_job_id($id);
			$data['data'] = $this->job_model->get_job_id($id);

			$cid                    =  $data['jobs']['company_id'];    


            $data['customers']      =  $this->user_model->get_customer_by_company_id($cid); 

            

            $agentsrecords          =  $this->agents_model->all_agents($cid);
            $data['agentsrecords']  =  $agentsrecords;

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/job/job_edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
  
        //$this->rbac->check_operation_access(); 
		$this->db->delete('ci_job', array('id' => $id));
		$this->session->set_flashdata('success', 'Job has been Deleted Successfully!');
        redirect(base_url('admin/job'));
        
	}
    
     public function jobimportcsv(){
         
         
     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Allowed mime types
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
            // If the file is uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                fgetcsv($csvFile);

                while(($line = fgetcsv($csvFile)) !== FALSE){
 
                $job_name              = $line[0];
                $details               = $line[1];
                $price                 = $line[2];
                    
                $currency              = $line[3];
                $address               = $line[4];
                $status                = $line[5];
                    
	            $rand_no = "JBE".rand(10000,99999);
                    
                $data = array(
                    'name'    => $job_name,
                    'details' => $address,
                    'price'   => $price,
                    'jobid'   => $this->create_unique_slug($rand_no),
                    'status'  => $status,
                    'job_currency'  => $currency,
                    'created_at' => date("Y-m-d"),
                    'slug'       => make_slug($job_name),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->job_model->add($data);
                $this->session->set_flashdata('success','Job has been added successfully');
              

                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/job'));
            }
            else{
                $qstring = '?status=err';
            }
        }else{
            $qstring = '?status=invalid_file';
              return redirect()->back();     
        }
        
    }
    
	public function view($job_id)
	{
		// echo "test";
		// die();
        $this->load->library('pdf');
      // 	$data['data'] = $this->job_model->get_by_invoiceid($job_id);
        // $cus_id=$data['data']['customer_id'];
        // $com_id=$data['data']['company_id'];
        // $data['customer_details']=$this->user_model->get_customerby_cusid($cus_id);
        // $data['company_info']    =$this->company_model->get_company_by_id($com_id);

			$data = array("test");
        $html = $this->load->view('manifestopdf',$data);


        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        
        $dompdf->render();
        $dompdf->stream($invoice_id.".pdf", array("Attachment"=>0,'isRemoteEnabled' => true));
        
	}  

	public function jobgetbyid($jobid){
		//echo $jobid;
		$data = $this->job_model->get_job_by_job_id_manifest($jobid);

		//echo '<pre>',var_dump($data); echo '<pre>';
		echo json_encode($data);

	}
}

?>