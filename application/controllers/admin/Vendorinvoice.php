<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendorinvoice extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('admin/Vendorinvoice_Model', 'vendorinvoice_Model');
        $this->load->model('admin/Company_Model', 'company_model');
        $this->load->model('admin/vendor_model', 'vendor_model');
        $this->load->model('admin/User_model', 'user_model');
        $this->load->model('admin/Job_Model', 'job_model');
	}
	public function index()
	{
		$records = $this->vendorinvoice_Model->all_vendorinvoice();

		$data['records'] = $records;
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/vendorinvoice/list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------
	//-----------------------------------------------------

	public function add()
	{
	  if($this->input->post()){

			$this->form_validation->set_rules('vendor_id', 'Vendor Id', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

                if ($this->form_validation->run() === FALSE) {
                    $data = array(
                    'errors' => validation_errors()
                    );
                    $this->session->set_flashdata('form_data', $this->input->post());
                    $this->session->set_flashdata('errors', $data['errors']);
                    redirect(base_url('admin/vendorinvoice/add'),'refresh');
                }

			    $rand_no                      = "INV".rand(10000,99999);
                $itemcode                     = serialize($this->input->post('item_code'));
                $jobid                        = serialize($this->input->post('jobid'));
                $qty                          = serialize($this->input->post('qty'));
                $price                        = serialize($this->input->post('price'));
                $discount                     = serialize($this->input->post('discount'));
                $additional_custom_charge     = serialize($this->input->post('additional_custom_charge'));
          
    
			
			$data = array(
                'vendor_id'      => $this->input->post('vendor_id'),
                'company_id'     => $this->input->post('company_id'),
                'customer_id'    => $this->input->post('customer_id'),
                'email'          => $this->input->post('email'),
                'mobile'         => $this->input->post('mobile'),
                'invoice_id'     => $this->create_unique_slug($rand_no),
                'order_no'       => $this->input->post('order_no'),
                'reference_no'   => $this->input->post('reference_no'),
                'invoice_date'   => $this->input->post('invoice_date'),
                'terms'          => $this->input->post('terms'),
                'attn_no'        => $this->input->post('attn_no'),
                'd_o_no'         => $this->input->post('d_o_no'),
                'fax'            => $this->input->post('fax'),
                'jobid'          => $jobid,
                'item_code'      =>$itemcode,
                'qty'            =>$qty,
                'price'          =>$price,
                'discount'       =>$discount,
                'additional_custom_charge' =>$additional_custom_charge,
				'created_at'     => date("Y-m-d")
			);
          
			$data = $this->security->xss_clean($data);
			$result = $this->vendorinvoice_Model->add($data);
			$this->session->set_flashdata('success','Delivery has been added successfully');
			redirect(base_url('admin/vendorinvoice'));
		}
		else{
            

            
            $records = $this->company_model->all_company();
            $data['company_list'] = $records;
			$data['title'] = 'Add Invoice';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendorinvoice/add', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}
    public function vendorbycompany_id($cid)
    {
       
            $data= $this->vendor_model->get_vendor_by_company_id($cid);
            $html="<option value=''>Select Vendor Name</option>";
            foreach($data as $row)
            {
              $html .="<option value='".$row->id."'>".$row->name."</option>"; 
            }
            echo $html;               

    }
    public function customerbycompany_id($cid)
    {
           $data= $this->user_model->get_customer_by_company_id($cid);
           $html="<option value=''>Select Customer Name</option>";
           foreach($data as $row)
           {
             $html .="<option value='".$row->id."'>".$row->username."</option>";  
           }
           echo $html;  
    }  
    
    public function jobbycompany_id($cid)
    {
           $data = $this->job_model->get_job_by_company_id($cid);
           $html="<select class='form-control select_job_id'  name='jobid[]'><option value=''>Select Job Name</option>";
           foreach($data as $row)
           {
             $html  .="<option value='".$row->jobid."'>".$row->name."</option>";  
           }
            $html  .="</select>";
            echo $html;
    }
        
    

		function create_unique_slug($string,$field='invoice_id',$key=NULL,$value=NULL)
		{
		    $t    =&get_instance();
		    $slug =url_title($string);
		    $slug =strtolower($slug);

		    $i = 0;
		    $params = array ();
		    $params[$field] = $slug;
		 
		    if($key)$params["$key !="] = $value; 
		 
		    while ($t->db->where($params)->get('ci_vendor_invoice')->num_rows())
		    {   
		        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
		            $slug .= '' . ++$i;
		        else
		            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
		         
		        $params [$field] = $slug;
		    }   
		    return $slug;   
		}

    public function vendors_all_by_cid(){
       
        $company_id =  $this->input->post('company_id');
        
    }
	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
	       	$this->form_validation->set_rules('vendor_id', 'vendor_id', 'trim|required');
		    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/vendorinvoice/edit'.'/'.$id),'refresh');
				return;
			}
            
            
                $itemcode     = serialize($this->input->post('item_code'));
                $descriptions = serialize($this->input->post('descriptions'));
                $qty          = serialize($this->input->post('qty'));
                $price        = serialize($this->input->post('price'));
                $discount     = serialize($this->input->post('discount'));
                $jobid        = serialize($this->input->post('jobid'));
                $additional_custom_charge        = serialize($this->input->post('additional_custom_charge'));
          
			
	       		$data = array(
                'vendor_id'      => $this->input->post('vendor_id'),
                'company_id'    => $this->input->post('company_id'),
                'email'          => $this->input->post('email'),
                'mobile'         => $this->input->post('mobile'),
                'order_no'       => $this->input->post('order_no'),
                'reference_no'   => $this->input->post('reference_no'),
                'invoice_date'   => $this->input->post('invoice_date'),
                'terms'          => $this->input->post('terms'),
                'attn_no'        => $this->input->post('attn_no'),
                'fax'            => $this->input->post('fax'),
                'customer_id'    => $this->input->post('customer_id'),
                'd_o_no'        => $this->input->post('d_o_no'),
                'jobid'          => $jobid,
                'item_code'      =>$itemcode,
                'descriptions'   =>$descriptions,
                'qty'            =>$qty,
                'price'          =>$price,
                'discount'       =>$discount,
                'additional_custom_charge'       =>$additional_custom_charge,
			        	'created_at'     =>date("Y-m-d")
		      	);
            
            
			$result = $this->vendorinvoice_Model->edit($data, $id);

			if($result){
				$this->session->set_flashdata('success','Delivery has been updated successfully');
				redirect(base_url('admin/vendorinvoice/edit'.'/'.$id));
			}
			
		}
		else{
            
            $activevendor           =  $this->vendor_model->all_active_vendor();
            $data['vendorlist']     =  $activevendor;
            $records                =  $this->company_model->all_company();
            $data['company_list']   =  $records;
            $data['title']          =  'Update Invoice';
            $data['data']           =  $this->vendorinvoice_Model->get_by_id($id);
            $cid                    =  $data['data']['company_id'];           
            $data['vendors']        =  $this->vendor_model->get_vendor_by_company_id($cid);
            $data['customers']      =  $this->user_model->get_customer_by_company_id($cid); 
            $data['job_ids']        =  $this->job_model->get_job_by_company_id($cid); 
            
//            echo "<pre>";
//            print_r($data['job_ids']);
//            echo "<pre>";
//            $alljobid=unserialize($data['data']['jobid']);
//            print_r($alljobid);
//            die;
            
            
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/vendorinvoice/edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{

        $this->rbac->check_operation_access(); 
		$this->db->delete('ci_vendor_invoice', array('id' => $id));
		$this->session->set_flashdata('success', 'Delivery has been Deleted Successfully!');
		redirect(base_url('admin/vendorinvoice'));
	}
    
    public function myview()
	{
        $this->load->library('pdf');
        $dompdf = new Dompdf\Dompdf();
        // Set Font Style
        $dompdf->set_option('defaultFont', 'Courier');
        
        
        
        $html = "<p style='text-align: center'>My First Dom Pdf Example 22222222</p>";
        
        $dompdf->loadHtml($html);
        // To Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Get the generated PDF file contents
        $pdf = $dompdf->output();
        // Output the generated PDF to Browser
        $dompdf->stream("My.pdf");

        
	}
    
    public function viewpdfhtml($invoice_id){
            $data['data'] = $this->vendorinvoice_Model->get_by_invoiceid($invoice_id);

			$this->load->view('vendorinvoicepdf', $data);

        
    }
    public function view($invoice_id)
	{
        $this->load->library('pdf');
       	$data['data'] = $this->vendorinvoice_Model->get_by_invoiceid($invoice_id);
        $vendor_id = $data['data']['vendor_id'];
        $company_id=$data['data']['company_id'];   
        $data['company_details']=$this->company_model->get_company_details_byid($company_id);
        $data['vendor_details']=$this->vendor_model->get_vendor_details_byid($vendor_id);
        
        $jobid_data=$data['data']['jobid'];
        $jobid_desc=array();
        if( $jobid_data!="N;")
        {
            $jobid_arr=unserialize($data['data']['jobid']);
            if(count($jobid_arr) > 0 )
            {
                $jobid_desc=array();
                foreach($jobid_arr as $jobid)
                {
                    $jobid_data=$this->job_model->get_descriptions_byjobid($jobid);
                    array_push($jobid_desc,$jobid_data['details']);
                }
            }
               
        
        }
        $data['jobid_desc']= $jobid_desc; 
        
        
       
            
        
        
        
        
        
       
//        
//        echo "<pre>";
//        print_r($data);
//        die;

        //$dompdf = new Dompdf\Dompdf();
        // Set Font Style
//        $dompdf->set_option('defaultFont', 'Courier');
//        
//        $filename ="test";
//        
//        $dompdf = $this->load->view('vendorinvoicepdf');
        $html = $this->load->view('vendorinvoicepdf',$data);
//        $dompdf->stream( $filename.'.pdf',array("Attachment" => true));

        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        


        $dompdf->render();
        //   $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
      //  $dompdf->output();
        // Output the generated PDF to Browser
       // $dompdf->stream("My.pdf");
        $dompdf->stream($invoice_id.".pdf", array("Attachment"=>0,'isRemoteEnabled' => true));
        
	}   
    
    public function download()
	{
        $this->load->library('pdf');
        $data['title'] = 'Add Staff';
        //$dompdf = new Dompdf\Dompdf();
        // Set Font Style
//        $dompdf->set_option('defaultFont', 'Courier');
//        
//        $filename ="test";
//        
//        $dompdf = $this->load->view('vendorinvoicepdf');
        $html = $this->load->view('vendorinvoicepdf');
//        $dompdf->stream( $filename.'.pdf',array("Attachment" => true));
        
        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
       
        $dompdf->render();
        //   $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
      //  $dompdf->output();
        // Output the generated PDF to Browser
       // $dompdf->stream("My.pdf");
        $dompdf->stream("welcome.pdf", array("Attachment"=>1));
        
	}
    public function send()
	{
        $this->load->library('pdf');
        $data['title'] = 'Add Staff';
        //$dompdf = new Dompdf\Dompdf();
        // Set Font Style
//        $dompdf->set_option('defaultFont', 'Courier');
//        
//        $filename ="test";
//        
//        $dompdf = $this->load->view('vendorinvoicepdf');
        $html = $this->load->view('vendorinvoicepdf');
//        $dompdf->stream( $filename.'.pdf',array("Attachment" => true));
        
        $html = $this->output->get_output();
      
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->render();
       
        $output = $dompdf->output();
        file_put_contents('assets/img/myfile2.pdf', $output);
        //   $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
      //  $dompdf->output();
        // Output the generated PDF to Browser
       // $dompdf->stream("My.pdf");
       // $dompdf->stream("welcome.pdf", array("Attachment"=>1));
        
	}

}

?>