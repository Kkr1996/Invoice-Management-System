<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller
{
    function __construct(){
        parent::__construct();
  		$this->load->helper('url');
		$this->load->library('session');
    }
	function index(){
		//$this->load->view('staff/header.php');
		$this->load->view('staff/register.php');
		//$this->load->view('staff/footer.php');
	}
}

?>