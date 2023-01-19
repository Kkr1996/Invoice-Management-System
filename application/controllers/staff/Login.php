<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{

    function __construct(){
        parent::__construct();
  		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin/staff_auth_model','staff_auth_model');
    }
	function index(){
		//$this->load->view('staff/header.php');
			$this->load->view('staff/login.php');
		//$this->load->view('staff/footer.php');
	}

	public function loginverify(){
		if($this->input->post('submit')){
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('staff/auth/login'),'refresh');

			}
			else {

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password')
				);


				$result = $this->staff_auth_model->login($data);


				if($result){



					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(base_url('admin/auth/login'));
						exit();
					}
					
					if($result['is_verify'] == 1){

						$staff_data = array(
							'staffid' => $result['id'],
							'username' => $result['name'],
							'is_staff_login' => TRUE
						);
						$this->session->set_userdata($staff_data);
						$this->rbac->set_access_in_session(); // set access in session
						redirect(base_url('staff/Staffcontroller'), 'refresh');
					}

					}
					else{
						$this->session->set_flashdata('errors', 'Invalid Username or Password!');
						redirect(base_url('staff/login'));
					}
				}
			}
			else{
				$data['title'] = 'Login';
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;

				$this->load->view('admin/includes/_header', $data);
				$this->load->view('admin/auth/login');
				$this->load->view('admin/includes/_footer', $data);
			}
	}
}

?>