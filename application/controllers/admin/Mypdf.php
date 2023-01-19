<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class MYPDF extends CI_Controller
{
    
    
	function __construct()
	{
		parent ::__construct();
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->library('session'); // loaded my custom serverside datatable library
		$this->load->model('admin/Services_Model', 'services_model');
		$this->load->model('admin/Blogs_model', 'blogs_model');
        $this->load->model('admin/user_model', 'user_model');
        
	}
	public function index()
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
    public function mypdftest()
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
        $dompdf->stream("welcome.pdf", array("Attachment"=>0));
        
	}
    
    public function add(){
        
        $data['title'] = 'Add Staff';
        $this->load->view('admin/includes/_header',$data);
        $this->load->view('admin/blogs/blogs_add',$data);
        $this->load->view('admin/includes/_footer',$data); 
        
    }
    
    public function insertblogs(){
        
        if($this->input->post()){

            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $base_url = base_url();
                if ($this->form_validation->run() === FALSE) {


                    $data = array(
                        'errors' => validation_errors()
                    );
                    $this->session->set_flashdata('form_data', $this->input->post());
                    $this->session->set_flashdata('errors', $data['errors']);
                    redirect(base_url('admin/staff/add'),'refresh');
                }

            
            
            
                $config['upload_path']          =  $base_url.'uploads/blogs';   
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

            
            
            
            
            
                $data = array(
                    
                    'name' => $this->input->post('title'),
                    'slug'=>$this->create_unique_slug($this->input->post('title')),
                    'status' => $this->input->post('status'),
                    'icon' =>$new_name,
                    'publish_date' => $this->input->post('publish_date'),
                    'info' => $this->input->post('info')
                    
                );

                 $data = $this->security->xss_clean($data);
                 $result = $this->blogs_model->add_blogs($data);
            
                 $this->session->set_flashdata('success','Blog has been added successfully');
                 redirect(base_url('admin/blogs'),'refresh');
            }
        
    }
    
    
    
    function create_unique_slug($string,$field='slug',$key=NULL,$value=NULL)
    {
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;

        if($key)$params["$key !="] = $value; 

        while ($t->db->where($params)->get('blogs')->num_rows())
        {   
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );

            $params [$field] = $slug;
        }   
        return $slug;   
    }
    private function set_upload_options($new_name)
    {   
         $base_url='';
       
         $config = array();
         $config['upload_path']          =  $base_url.'uploads/blogs/'; 
         $config['allowed_types']        = '*';
         $config['overwrite']     = FALSE;
         $config['file_name']     = $new_name;
         return $config;
    }
    
    
    
    
    
    
	function staff()
	{
		$data['title'] = 'State List';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/blogs/blogs_list', $data);
		$this->load->view('admin/includes/_footer', $data);
	}

	//-------------------------------------------------------
	public function staff_datatable_json()
	{				   					   
		$records = $this->services_model->get_all_states();
		$data = array();
		$count=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['status'] == 0)? 'Inactive': 'Active'.'<span>';
			$data[]= array(
				++$count,
				get_country_name($row['country_id']),
				$row['name'],
				'<span class="btn btn-xs btn-success" title="status">'.$status.'<span>',				
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/staff/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
            	 <a title="Delete" class="delete btn btn-sm btn-danger" href="'.base_url('admin/staff/del/'.$row['id']).'" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	//-----------------------------------------------------
	public function blogs_edit($id=0)
	{
		if($this->input->post()){
            $this->form_validation->set_rules('title', 'title', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            
            
            
            $records['data'] = $this->user_model->get_all_users();
            $data = array();
            $i=0;

            foreach ($records['data']   as $row) 
            {  
                $all_email[] = $row['email'];
            }
            
           
            
          $post_title =   $this->input->post('title');
             $slugs =  $this->create_unique_slug($this->input->post('title'));
        foreach($all_email as $keys=>$mails){
         
            $to   = $mails;     
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
            <p>Blogs updated</p>
            <h1>$post_title</h1>
            <a href='$base/dashboard/single_post/$slugs'>View</a>
            
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

            
			if ($this->form_validation->run() === FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect($_SERVER['HTTP_REFERER']);
				return;
			}

                $base_url =  base_url();
                $config['upload_path']          =  $base_url.'uploads/blogs';   
                $config['allowed_types']        = 'gif|jpg|png|pdf|$config|zip|rar|svg';
                $this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
            
                 $array_filters = array_filter($_FILES['userfile']['name']);
                 $count_files = count($array_filters);
                 $files_my = [];
            

                    if($count_files > 0) {

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
                 }
            else{
                $new_name = $this->input->post('uploadimage');
            }
                      

               // die();
                $data = array(
                    
                    'name' => $this->input->post('title'),
                    'slug'=>$this->create_unique_slug($this->input->post('title')),
                    'status' => $this->input->post('status'),
                    'icon' =>$new_name,
                    'publish_date' => $this->input->post('publish_date'),
                    'info' => $this->input->post('info')
                    
                );


			$data = $this->security->xss_clean($data);
			$result = $this->blogs_model->edit_blogs($data, $id);

			if($result){
                
				$this->session->set_flashdata('success','Blogs has been updated successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		else{

			$data['title'] = 'Update Staff';
			$data['data'] = $this->blogs_model->get_blogs_id($id);

			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/blogs/blogs_edit', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{

		$this->db->delete('blogs', array('id' => $id));
		$this->session->set_flashdata('success', 'Blog has been Deleted Successfully!');
		redirect(base_url('admin/blogs'));
	}


}

?>