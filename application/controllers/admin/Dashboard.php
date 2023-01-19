<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends My_Controller {
	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth

		$this->load->model('admin/dashboard_model', 'dashboard_model');
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/Company_Model', 'company_model');
        $this->load->model('admin/vendor_model', 'vendor_model');
        $this->load->model('admin/Job_Model', 'job_model');
        $this->load->model('admin/Delivery_Model', 'delivery_model');
        $this->load->model('admin/Agent_Model', 'agents_model');
        $this->load->model('admin/CustomerRates_Model', 'customerrates_model');
        $this->load->model('admin/Vendorinvoice_Model', 'vendorinvoice_model');
        $this->load->model('admin/Invoice_Model', 'invoice_model');
        
        
	}

	//--------------------------------------------------------------------------

	public function index($id = ""){

        if($id){
            
            $data['vendor']    = $this->vendor_model->count_bycompany_id($id);
            $data['customers'] = $this->user_model->count_bycompany_id($id);
            $data['company']   = $this->company_model->getcompanyscount();
            $data['jobs']      = $this->job_model->count_bycompany_id($id);
            $data['delivery']  = $this->delivery_model->count_bycompany_id($id);
            $data['agents']    = $this->agents_model->count_bycompany_id($id);
            $data['customerrates']= $this->customerrates_model->count_bycompany_id($id);
            $data['vendorinvoice']= $this->vendorinvoice_model->count_bycompany_id($id);
            $data['invoice']= $this->invoice_model->count_bycompany_id($id);
            $data['company_id_s'] = $id;
            
            
        }
        else{
            
            $data['customers'] = $this->user_model->getcustomerscount();
            $data['company']   = $this->company_model->getcompanyscount();
            $data['vendor']    = $this->vendor_model->getvendorscount();
            $data['jobs']      = $this->job_model->getjobscount();
            $data['delivery']  = $this->delivery_model->getdeliverycount();
            $data['agents']    = $this->agents_model->getagentscount();
            $data['customerrates']= $this->customerrates_model->getcustomers_rates_count();
            $data['vendorinvoice']= $this->vendorinvoice_model->getvendorinvoice_count();
            $data['invoice']= $this->invoice_model->getinvoice_count();
            $data['company_id_s'] = $id;
          
           
        }
        $statusArray= $this->job_model->count_job_status();
        $data['count_status']=$statusArray;
        $data['vendor_total_revenue']=$this->vendor_revenue();
        $data['customer_total_revenue']=$this->customer_revenue();
        $data['profit']=(int)$this->customer_revenue() - (int)$this->vendor_revenue();
        $data['title']     = 'Dashboard';
        $records = $this->company_model->all_company();
        $data['company_list'] = $records;   

        //          echo "<pre>";
        //          print_r($data);die;



        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/dashboard/dashboard',$data);
        $this->load->view('admin/includes/_footer',$data);
        
        
	}
    //---------------------------------------------------------------------
    public function customer_revenue()
    {
        error_reporting(0);
        $records = $this->invoice_model->all_invoices();
        $totalsum=0; 
        foreach($records as $record)
        {

           $priceList    =unserialize($record['price']);
           $quantityList =unserialize($record['qty']);
           $taxStatusList=unserialize($record['tax']);   
           $extra_price  =unserialize($record['extra_price']);  
           $sum=0;

       //    echo '<pre>',var_dump();
          // die();
          
           for($i=0;$i<count($priceList);$i++) 
           {
               $total_extra_price = (int)$extra_price[$i] * (int)$quantityList[$i];
               $actual_price=(int)$priceList[$i] * (int)$quantityList[$i];
               $total_actual_price =$total_extra_price + $actual_price;
               $percentage_price=$total_actual_price +($total_actual_price * 6) / 100;
               
               if($taxStatusList[$i]==1)
               {
                   $sum= $sum + $percentage_price;               
               }
               else
               {
                   $sum= $sum + $actual_price;  
               }     
           }
        
           $totalsum = $totalsum+$sum;    
            
            
        } 
        return  $totalsum;
    }
    //--------------------------------------------------------------------------
    public function vendor_revenue()
    {
        $records = $this->vendorinvoice_model->all_vendorinvoice();
        $totalsum=0; 
        foreach($records as $record)
        {

           $priceList=unserialize($record['price']);
           $quantityList=unserialize($record['qty']);
           $extra_price=unserialize($record['additional_custom_charge']);  
            
            
            $sum=0;
           for($i=0;$i<count($priceList);$i++) 
           {
               $total_extra_price = (int)$extra_price[$i];
               $actual_price=(int)$priceList[$i] * (int)$quantityList[$i];
               $total_actual_price =$total_extra_price + $actual_price;
               $percentage_price=$total_actual_price +($total_actual_price * 6) / 100;
               $sum=$sum+$percentage_price;                  
           }
          
            $totalsum=$totalsum+$sum;
            
        }
        return $totalsum;
    }

	//--------------------------------------------------------------------------

	public function index_1(){

		$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}

	//--------------------------------------------------------------------------

	public function index_2(){
		$data['title'] = 'Dashboard';
		$this->load->view('admin/includes/_header');
    	$this->load->view('admin/dashboard/index2');
    	$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------------------------------

	public function index_3(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}
    
    public function usersdocument(){
        
        $data['documents'] = $this->dashboard_model->lastdocument();
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/userdocument', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

    public function uploaddocument(){

        $base_url=''; 
        $config['upload_path']          =  $base_url.'uploads/documents';   
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
            
            $files_my[] = $files['userfile']['name'][$i];
            
            $new_name = time().str_replace(' ', '', $_FILES["userfile"]['name']);

            $this->upload->initialize($this->set_upload_options($new_name));
            $this->upload->do_upload();
            $data = $this->upload->data();
            $image_name[] =$data['file_name'];
        }

        $documentname = $this->input->post('title');

        $data = array(
            'files'        =>$new_name,
            'name'         =>$documentname,
            'created_date' =>date('Y-m-d  h:m:s')
        );
        $data   = $this->security->xss_clean($data);
        $result = $this->dashboard_model->insertdocument($data);
        redirect($_SERVER['HTTP_REFERER']);  
 
    }
    private function set_upload_options($new_name)
    {   
         $base_url='';
         $config = array();
         $config['upload_path']          =  $base_url.'uploads/documents/'; 
         $config['allowed_types']        = '*';
         $config['overwrite']     = FALSE;
         $config['file_name']     = $new_name;
         return $config;
    }
    
    public function del($id = 0){

        $row = $this->dashboard_model->getimagepath($id);
        
        foreach($row as $kkeys=>$kvals){
            
            $files_image = $kvals['files'];
            
        }
        $fullpath = $base_url.'uploads/documents/'.$files_image; 
        
        @unlink($fullpath); // correct
        
 
		$this->db->delete('users_document', array('id' => $id));
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect($_SERVER['HTTP_REFERER']);
 
    }
    
}
?>	