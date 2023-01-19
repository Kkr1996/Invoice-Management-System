<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Invoice_Model', 'invoicemodel');
        $this->load->model('admin/Company_Model', 'company_model');
        $this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/vendor_model', 'vendor_model');
        $this->load->model('admin/User_model', 'user_model');
        $this->load->model('admin/Manifest_Model', 'manifest_model');
        $this->load->model('admin/Truck_model', 'truck_model');
	}
	public function index()
	{
	     error_reporting(0);
//
		$records = $this->invoicemodel->all_invoices();
		$data['records'] = $records;
        $cus_name=[];
        foreach($records as $record)
        {
            $customer_data=$this->user_model->get_customerby_cusid($record['customer_id']);
            array_push( $cus_name,$customer_data['username']);
             
        }
        $data['match_jobid_counter']= $test_count;
        $data['customers']=$cus_name; 
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/invoice/list', $data);
		$this->load->view('admin/includes/_footer', $data);
        $this->load->model('admin/Company_Model', 'company_model');
	}
    
    public function get_match_jobid_counter($jobid)
    {
        $records = $this->invoicemodel->all_invoices();
        $test_count=0;
        foreach($records as $record)
        {
          
            $jobid_list=unserialize($record['jobid']);
            if(!empty($jobid_list))
            {
                for($i=0;$i<count($jobid_list);$i++)
                {
                    if($jobid == $jobid_list[$i])
                    $test_count++; 
                }
            }
            
                 
        }
        echo $test_count;
        
     
    }
	//-------------------------------------------------------

	//-----------------------------------------------------
	public function add()
	{

	  if($this->input->post()){

            $this->form_validation->set_rules('company_id', 'company_id', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $manifesto = $this->manifest_model->all_manifest();
            $data['manifesto'] = $manifesto;


			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/invoices/add'),'refresh');
			}
            $lastid = $this->invoicemodel->get_last_invoiceid();
  
          
            if($lastid){
                $rand_no = "INV".++$lastid;  
            }
            else{
                $lastid  = 1;
                $rand_no = "INV".$lastid;  
            }
           // die();
          
                $jobid        = serialize($this->input->post('jobid'));
                $qty          = serialize($this->input->post('qty'));
                $price        = serialize($this->input->post('price'));
                $extra_price  = serialize($this->input->post('extra_price'));
                 $tax          = serialize($this->input->post('checkbox_1'));
                $description  = serialize($this->input->post('description'));

          
			$data = array(
                'vendor_id'           => $this->input->post('vendor_id'),
                'customer_id'         => $this->input->post('customer_id'),
				'job_no'              => $this->input->post('job_no'),
				'truck_manifest_no'   => $this->input->post('truck_manifest_no'),
				'my_th_truck'         => $this->input->post('my_th_truck'),
				'shipement_no'        => $this->input->post('shipement_no'),
				'invoice_no'          => $rand_no,
				'vendor'              => $this->input->post('vendor'),
				'vendor_invoice'      => $this->input->post('vendor_invoice'),
				'typetruck'           => $this->input->post('typetruck'),
				'lodading_at_border'  => $this->input->post('lodading_at_border'),
				'delivery_point'      => $this->input->post('delivery_point'),
				'destination'         => $this->input->post('destination'),
				'cost'                => $this->input->post('cost'),
				'remarks'             => $this->input->post('remarks'),
                'company_id'          => $this->input->post('company_id'),
                'start_no'            => $lastid,
                'loa_number'          => $this->input->post('loa_number'),
                'do_number'           => $this->input->post('do_number'),    
                'po_reference'        => $this->input->post('po_reference'),
                'term'                => $this->input->post('term'),
                'fax'                 => $this->input->post('fax'),
                'utm'                 => $this->input->post('utm'),
                'attn'                  => $this->input->post('attn'),
                'ibd'                   => $this->input->post('ibd'),
                'jobname'               => $this->input->post('jobname'),
                'start_date'            => $this->input->post('start_date'),
                'end_date'              => $this->input->post('end_date'),
                'customer_rates'        => $this->input->post('customer_rates'),
                
                'jobid'               => $jobid,
                'qty'                 =>$qty,
                'price'               =>$price,
                'extra_price'            =>$extra_price,
                'description'            =>$description,
                'tax'                    =>$tax,
				'created_at'             =>date("Y-m-d"),
                
			);

			$data   = $this->security->xss_clean($data);
			$result = $this->invoicemodel->add($data);
          	$this->session->set_flashdata('success', 'Invoice has been added successfully!');
			redirect(base_url('admin/invoices'));

		}
		else{

            
            $activevendor         = $this->vendor_model->all_active_vendor();
            $data['vendorlist']   = $activevendor;
            $manifesto = $this->manifest_model->all_manifest();
            $data['manifesto'] = $manifesto;
            $activejob = $this->job_model->all_job_active();
            $data['joblist'] = $activejob;
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Invoice';

			$tuckrecords = $this->truck_model->alllist();       
			$data['trucklist'] = $tuckrecords;

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/invoice/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}
    public function get_extra_price_byjobid($jobid)
    {
        $data = $this->job_model->get_descriptions_byjobid($jobid);
        
        
      //  echo '<pre>',var_dump($data['price']); echo '</pre>';
            
        
      echo $data['price'];
    }
    

		function create_unique_slug($string,$field='invoice_no',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);

		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		 
		    if($key)$params["$key !="] = $value; 
		 
		    while ($t->db->where($params)->get('ci_invoices')->num_rows())
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
            
			$this->form_validation->set_rules('company_id', 'company_id', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/invoices/edit/'.'/'.$id),'refresh');
				return;
			}
			// echo $this->input->post('vendor');

			// die();
            $jobid        = serialize($this->input->post('jobid'));
            $qty          = serialize($this->input->post('qty'));
            $price        = serialize($this->input->post('price'));
            $extra_price  = serialize($this->input->post('extra_price'));
            $description  = serialize($this->input->post('description'));
            $tax          = serialize($this->input->post('checkbox_1'));
         
 
           // echo '<pre>',var_dump($this->input->post('checkbox_1')); echo '</pre>';
           
			$data = array(
                'vendor_id'           => $this->input->post('vendor_id'),
                'customer_id'         => $this->input->post('customer_id'),
				'job_no'              => $this->input->post('job_no'),
				'truck_manifest_no'   => $this->input->post('truck_manifest_no'),
				'my_th_truck'         => $this->input->post('my_th_truck'),
				'shipement_no'        => $this->input->post('shipement_no'),
				'vendor'              => $this->input->post('vendor'),
				'vendor_invoice'      => $this->input->post('vendor_invoice'),
				'typetruck'           => $this->input->post('typetruck'),
				'lodading_at_border'  => $this->input->post('lodading_at_border'),
				'delivery_point'      => $this->input->post('delivery_point'),
				'destination'         => $this->input->post('destination'),
				'cost'                => $this->input->post('cost'),
				'remarks'             => $this->input->post('remarks'),
                'company_id'          =>$this->input->post('company_id'),
                'loa_number'          => $this->input->post('loa_number'),
                'do_number'           => $this->input->post('do_number'),    
                'po_reference'        => $this->input->post('po_reference'),
                'term'                => $this->input->post('term'),
                'fax'                 => $this->input->post('fax'),
                'attn'                => $this->input->post('attn'),
                'customer_rates'        => $this->input->post('customer_rates'),
                'jobid'               => $jobid,
                'ibd'                 => $this->input->post('ibd'),
                'utm'                 => $this->input->post('utm'),
                'jobname'             => $this->input->post('jobname'),
                'start_date'          => $this->input->post('start_date'),
                'end_date'            => $this->input->post('end_date'),
                'qty'                 =>$qty,
                'price'               =>$price,
                'extra_price'         =>$extra_price,
                'description'            =>$description,
                'tax'            =>$tax,
				'created_at' => date("Y-m-d"),
			);

			$data = $this->security->xss_clean($data);
			$result = $this->invoicemodel->edit($data, $id);
            $this->session->set_flashdata('success', 'Invoice has been updated successfully!');
            redirect(base_url('admin/invoices/edit'.'/'.$id));
			

		}
		else{
            
            $manifesto = $this->manifest_model->all_manifest();
            $data['manifesto'] = $manifesto;

            $activevendor         = $this->vendor_model->all_active_vendor();
            $data['vendorlist']   = $activevendor;
            
            $activejob = $this->job_model->all_job();


            $tuckrecords = $this->truck_model->alllist();       
			$data['trucklist'] = $tuckrecords;

            $data['joblist'] = $activejob;
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Update Job';
			$data['data'] = $this->invoicemodel->get_by_id($id);

            $current_job_id = $data['data']['job_no'];
            
            $data['job_name']        =  $this->job_model->get_job_name_by_id($current_job_id); 


           
            $cid                    =  $data['data']['company_id'];           
            $data['vendors']        =  $this->vendor_model->get_vendor_by_company_id($cid);
            $data['customers']      =  $this->user_model->get_customer_by_company_id($cid); 
            $data['job_ids']        =  $this->job_model->get_job_by_company_id($cid); 
            $data['job_ids']        =  $this->job_model->get_job_by_company_id($cid); 
            $data['company_info']   =  $this->company_model->get_by_id($cid);

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/invoice/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_invoices', array('id' => $id));
		$this->session->set_flashdata('success', 'Invoice has been Deleted Successfully!');
		redirect(base_url('admin/invoices'));
	}

	public function view_invoice(){

		    $data['invoice'] = 'View Invoice';
		//	$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/invoice/invoice_pdf', $data);
		//	$this->load->view('admin/includes/_footer', $data);
	}
    
    
    
    public function viewpdfhtml(){
            $data['data'] = "Title";
			$this->load->view('customerinvoicepdf', $data);
        
    }
    public function view($invoice_id)
	{
        $this->load->library('pdf');
       	$data['data'] = $this->invoicemodel->get_by_invoiceid($invoice_id);
        $cus_id=$data['data']['customer_id'];
        $com_id=$data['data']['company_id'];
        $data['customer_details']=$this->user_model->get_customerby_cusid($cus_id);
        $data['company_info']    =$this->company_model->get_company_by_id($com_id);

        
        $html = $this->load->view('customerinvoicepdf',$data);


        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        
        $dompdf->render();
        $dompdf->stream($invoice_id.".pdf", array("Attachment"=>0,'isRemoteEnabled' => true));
        
	}   
    
    public function download($invoice_id)
	{
        $this->load->library('pdf');
     
        $data['data'] = $this->invoicemodel->get_by_invoiceid($invoice_id);
        //$dompdf = new Dompdf\Dompdf();
        // Set Font Style
//        $dompdf->set_option('defaultFont', 'Courier');
//        
//        $filename ="test";
//        
//        $dompdf = $this->load->view('vendorinvoicepdf');
        $html = $this->load->view('customerinvoicepdf',$data);
//        $dompdf->stream( $filename.'.pdf',array("Attachment" => true));
        
        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
       
        $dompdf->render();
        //   $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
      //  $dompdf->output();
        // Output the generated PDF to Browser
       // $dompdf->stream("My.pdf");
        $dompdf->stream("customerinvoicepdf", array("Attachment"=>1));
        
	}
    public function send($id)
	{

        $this->load->library('pdf');
        $data['title'] = 'Add Staff';
        $html = $this->load->view('customerinvoicepdf');
        $html = $this->output->get_output();
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/customerinvoice/'.$id.'.pdf', $output);
        
        
        
         $inv_data  = $this->invoicemodel->get_by_invoiceid($id);
        // echo '<pre>',var_dump($inv_data); echo '</pre>';
        
      //  die();
        //Mail

 //Admin Things           
        
         $to = "krishnakr82849@gmail.com";   
         $baseurl = base_url();
         $files_my =  $baseurl.'assets/customerinvoice/'.$id.'.pdf';
         $files_size =  'assets/customerinvoice/'.$id.'.pdf';

        $subject ="Call2Register";
        
        $message ="test";
        $senderEmail = "no-replay@brainamaze.org";

        
        $senderName  = "Call2Register";
        $from = $senderName." <".$senderEmail.">";  
        $headers = "From: $from"; 
        // Boundary  
        $semi_rand = md5(time());  
        $message = '<h3>Invoice Receipt</h3>';
        
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
        // Preparing attachment 
        if(!empty($files_my)){ 
            
              
                    $file_name = basename($files_my); 
                    $file_size = filesize($files_size); 

                    $message .= "--{$mime_boundary}\n"; 
                    $fp =    @fopen($files_my, "rb"); 
                    $data =  @fread($fp, $file_size); 
                    @fclose($fp); 
                    $data = chunk_split(base64_encode($data)); 
                    $message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
                    "Content-Description: ".$file_name."\n" . 
                    "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
             
            
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $senderEmail; 
        // Send email 
        $mail = mail($to, $subject, $message, $headers, $returnpath);  
 
       if($mail){ 
             $this->session->set_flashdata('success','Invoice has been sent successfully');
			 redirect(base_url('admin/invoices'));
           
        }else{ 
             $this->session->set_flashdata('success','Please try again something went wrong!!');
            
            echo "false";
        }
             
	}
    
    public function checkmanifest($mid){

        if($mid){

            $manifest_id = $mid;
            echo  $data = $this->manifest_model->checkmanifest($manifest_id);     

        }
    }

    
    
}

?>