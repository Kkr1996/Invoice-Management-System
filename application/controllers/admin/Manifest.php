<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Company_Model', 'company_model');
		$this->load->model('admin/User_model', 'user_model');
		$this->load->model('admin/Agent_Model', 'agents_model');
		$this->load->model('admin/Manifest_Model', 'manifest_model');
		$this->load->model('admin/Truck_model', 'truck_model');
	}
	public function index()
	{
     
		$records = $this->manifest_model->all_manifest();
        $data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/manifest/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}


	public function allmanifesto($id = '')
	{
     
		$records = $this->manifest_model->all_manifest_by_job_id($id);
        $data['records'] = $records;

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/manifest/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}
	//-------------------------------------------------------

	//-----------------------------------------------------
	public function add()
	{

	  if($this->input->post()){
		$this->form_validation->set_rules('job_no', 'Job No', 'trim|required');
	
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/manifest/add'),'refresh');
			}
           
           // $row = $this->db->select("*")->limit(1)->order_by('id',"DESC")->get("ci_job")->row();
          //  $last_id=$row->id + 1;
            
            //$job_cat = $this->input->post('job_category');
            
          //  $get_three_letter = "JB".''.substr($job_cat, 0 , 1);
         
            
            // if(strlen($last_id) > 2)
            // {
            //   $job_id= $get_three_letter.''.date("ym").$last_id;  
            // }
            // else if(strlen($last_id) == 2)
            // {
            //   $job_id= $get_three_letter.''.date("ym").'0'.$last_id;   
            // }
            // else if(strlen($last_id) == 1)
            // {
            //   $job_id= $get_three_letter.''.date("ym").'00'.$last_id;     
            // }
            
			//$rand_no = "JBE".rand(10000,99999);
			
			$data = array(

				'job_id'      => $this->input->post('job_no'),
				'describe_f_e' => $this->input->post('describe_f_e'),
				'manifest_no'  => $this->input->post('manifest_no'),
				'loading_origin'   => $this->input->post('loading_origin'),
				'delivery_destination'  => $this->input->post('delivery_destination'),
				'created_at'   => date("Y-m-d"),
                'loading_date' => $this->input->post('loading_date'),
                'delivery_date'=> $this->input->post('delivery_date'),
                'po_do_ref'    => $this->input->post('po_do_ref'),
                'truck_type'   => $this->input->post('truck_type'),
                'container_no' => $this->input->post('container_no'),
                'truck_no'     => $this->input->post('truck_no'),
                'truck_location'     => $this->input->post('truck_location'),
                'special_marks' => $this->input->post('special_marks'),

                'descriptions_goods'  => $this->input->post('descriptions_goods'),
                'quantity'            => $this->input->post('quantity'),
                'gross_weigth'        => $this->input->post('gross_weigth'),

				
			);
			$data = $this->security->xss_clean($data);
			$result = $this->manifest_model->add($data);       
			
			$this->session->set_flashdata('success','Job has been added successfully');
			redirect(base_url('admin/manifest'));
		}
		else{
        

            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Job';
			$records = $this->job_model->all_job();
       	    $data['records'] = $records;

			$tuckrecords = $this->truck_model->alllist();       
			$data['trucklist'] = $tuckrecords;

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/manifest/add', $data);
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

	       	$this->form_validation->set_rules('job_no', 'job_no', 'trim|required');
		

			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/manifest/add'),'refresh');
				return;
			}
            
           
			
			$data = array(

				'job_id'      => $this->input->post('job_no'),
				'describe_f_e' => $this->input->post('describe_f_e'),
				'manifest_no'  => $this->input->post('manifest_no'),
				'loading_origin'   => $this->input->post('loading_origin'),
				'delivery_destination'  => $this->input->post('delivery_destination'),
				'created_at'   => date("Y-m-d"),
                'loading_date' => $this->input->post('loading_date'),
                'delivery_date'=> $this->input->post('delivery_date'),
                'po_do_ref'    => $this->input->post('po_do_ref'),
                'truck_type'   => $this->input->post('truck_type'),
				'truck_location'     => $this->input->post('truck_location'),
                'container_no' => $this->input->post('container_no'),
                'truck_no'     => $this->input->post('truck_no'),
                'special_marks' => $this->input->post('special_marks'),
                'descriptions_goods'  => $this->input->post('descriptions_goods'),
                'quantity'            => $this->input->post('quantity'),
                'gross_weigth'        => $this->input->post('gross_weigth'),

				
			);
			$data   = $this->security->xss_clean($data);
			$result = $this->manifest_model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Manifest has been updated successfully');
				redirect(base_url('admin/manifest/edit'.'/'.$id));
			}
			
		}
		else{
            
        
			$records = $this->job_model->all_job();
			$data['records'] = $records;
			$data['title'] = 'Update Manifest';
			$data['manifest'] = $this->manifest_model->get_manifest_id($id);

			
			$jobid        = $data['manifest']['job_id'];

			$data['joblist'] = $this->job_model->get_job_by_job_id_manifest($jobid);



			
			
			$cid                    =  $data['jobs']['company_id'];           
            $data['customers']      =  $this->user_model->get_customer_by_company_id($cid); 
            $agentsrecords = $this->agents_model->all_agents($cid);
            $data['agentsrecords'] = $agentsrecords;
			$tuckrecords = $this->truck_model->alllist();       
			$data['trucklist'] = $tuckrecords;
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/manifest/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
  
        //$this->rbac->check_operation_access(); 
		$this->db->delete('manifesto', array('id' => $id));
		$this->session->set_flashdata('success', 'Manifest has been Deleted Successfully!');
        redirect(base_url('admin/manifest'));
        
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
                $this->session->set_flashdata('success','Manifest has been added successfully');
              

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
    
	public function view($id)
	{
		// echo "test";
		// die();
        $this->load->library('pdf');


        $data_job_id = $this->manifest_model->get_job_id_by_id($id);


      	$com_id = $this->manifest_model->get_company_info_by_job_id($data_job_id);
        $data['company_info']    =$this->company_model->get_company_by_id($com_id);

 	    $data['manifesto']       =$this->manifest_model->get_manifesto_id($id);
		$data['job_list']        =$this->job_model->get_job_by_job_id($data_job_id);

	
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