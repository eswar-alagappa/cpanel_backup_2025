<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors',0);
ERROR_REPORTING(0);
class Mail extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function  __construct()
	 {
		 	parent::__construct();
			
	         $this->load->helper('url_helper');
		 $this->load->library('session');
                 $this->load->library('user_agent');
		  
	 }
      
      
	public function index() {
	    $this->load->helper('form'); 
	    $this->load->view('contact');
	  
	}
	
	
	
	public function send_mail(){
                             
                $this->load->helper(array('email'));
				$this->load->library(array('email'));
				$this->email->set_mailtype("text");
				
		
				$mail = 'info@aiitech.com';
				$this->load->library('email');
				$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
                                
                             $msg=   '<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <div class="content">
      <table>
        <tr>
          <td>
            <p>Dear Admin,</p>
			<p>Name :  '.$_POST['email'].'</p>
			<p>E-mail :  '.$_POST['email'].'</p>
			<p>Phone No :  '.$_POST['phone'].'</p>
			<p>Message :  '.$_POST['message'].'</p>
			
			
            
          </td>
        </tr>
      </table>
      </div>

    </td>
    <td></td>
  </tr>
</table>';
				$this->email->initialize($config);
				$this->email->from('info@alagappa.org');
				$this->email->to($mail);
				$this->email->subject('Aiitech - Contactus');
				$this->email->message($msg);
				$this->email->send();
                                $this->email->print_debugger();
                           $_SESSION['msg'] = '<div class="alert alert-sucess">Your Enquiry details submitted successfully.</div>';
                            ?>
                            <script>
                             window.location.href = "<?= base_url('contact')?>";
                            </script>
                    
			<?php 
	}
}?>
