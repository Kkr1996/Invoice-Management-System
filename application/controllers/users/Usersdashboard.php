    <?php 

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Usersdashboard extends MY_Controller
    {
        function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->model('users/users_model','users_model');
            $this->load->model('Dashboard_Model','dashboard_model');
        }

        public function index()
        {
            //I'm just using rand() function for data example
            $data=[];
            
            $code = "DMRN".' PJ '.rand(100000, 999990);

            //load library
            $this->load->library('zend');
            //load in folder Zend
            $this->zend->load('Zend/Barcode');
            //generate barcode
            $imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
            
            
            imagepng($imageResource, 'barcodes/'.$code.'.png');
            
            
            $data['barcode'] = 'barcodes/'.$code.'.png';
            
            
            $this->load->view('users/barcode',$data);
            
            
        }
	
        
    }

    ?>