<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Truckdetails extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Truck_model', 'truck_model');
        $this->load->model('admin/Company_Model', 'company_model');
		$this->load->model('admin/User_model', 'user_model');
		$this->load->model('admin/Agent_Model', 'agents_model');
	}
	public function index()
	{
		$records = $this->truck_model->alllist();
    
		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/truckdetails/list', $data);
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
		$this->form_validation->set_rules('trucknumber', 'trucknumber', 'trim|required');
	
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/truckdetails/add'),'refresh');
			}
		
			$data = array(
				'truck_number'    => $this->input->post('trucknumber'),
				'truck_details'   => $this->input->post('truckdetails'),
                'chasis_number'   => $this->input->post('chasis_number'),
                'vendor'          => $this->input->post('vendor'),
				'created_at'      => date("Y-m-d"),
				'slug'            => make_slug($this->input->post('trucknumber')),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->truck_model->add($data);       
			$this->session->set_flashdata('success','Truck Details has been added successfully');
			redirect(base_url('admin/truckdetails'));
		}
		else{
        
            $records = $this->truck_model->alllist();
            $data['trucknumber'] = $records;
			$data['title'] = 'Add Truck Details';
            
            
            
            
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/truckdetails/add', $data);
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

	       	$this->form_validation->set_rules('trucknumber', 'trucknumber', 'trim|required');
	
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/truckdetails/add'),'refresh');
				return;
			}
            
           
            
       
			$data = array(
				'truck_number'    => $this->input->post('trucknumber'),
				'truck_details' => $this->input->post('truckdetails'),
                'chasis_number'   => $this->input->post('chasis_number'),
                'vendor'          => $this->input->post('vendor'),
				'created_at' => date("Y-m-d"),
				'slug' => make_slug($this->input->post('name')),
			);
			
			$data   = $this->security->xss_clean($data);
			$result = $this->truck_model->edit_job($data, $id);

			if($result){
				$this->session->set_flashdata('success','Truck Details has been updated successfully');
				redirect(base_url('admin/truckdetails/edit'.'/'.$id));
			}
			
		}
		else{

			$data['title'] = 'Update Truck Details';
			$data['data'] = $this->truck_model->get_details_id($id);
		

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/truckdetails/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
  
        //$this->rbac->check_operation_access(); 
		$this->db->delete('truck_details', array('id' => $id));
		$this->session->set_flashdata('success', 'Truck Details has been Deleted Successfully!');
        redirect(base_url('admin/truckdetails'));
        
	}
    
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
 
                $vendor                = $line[0];
                $truck_number          = $line[1];
                $chasis_number         = $line[2];
    
                $data = array(
                    'truck_number'    => $truck_number,
                    'truck_details'   => "",
                    'chasis_number'   => $chasis_number,
                    'vendor'          => $vendor,
                    'created_at'      => date("Y-m-d"),
                    'slug'            => make_slug($truck_number),
                );
                  
                 
                $data = $this->security->xss_clean($data);
                $result = $this->truck_model->add($data);
                $this->session->set_flashdata('success','Truck Details has been added successfully');
              

                }
                // Close opened CSV file
                fclose($csvFile);

                $qstring = '?status=succ';
                redirect(base_url('admin/truckdetails'));
            }
            else{
                $qstring = '?status=err';
            }
        }else{
              echo "File must be CSV";
              die();
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
}

?>