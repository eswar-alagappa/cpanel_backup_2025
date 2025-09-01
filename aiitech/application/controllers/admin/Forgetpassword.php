<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forgetpassword extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->helper('email');
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/admin_model');

		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['Welcome'] = 'Happy';
		$this->load->view('admin/forget_password', $data);
	}

   function sendResetMail(){
		$email = $this->input->post('email');
		$id = $this->common_model->getUserIdByEmail($email);
		if ($id < 1) {
			$data['error'] = 'Email is not registered';
			$this->load->view('admin/forget_password', $data);
			return;
		}
		$eid = $this->common_model->myEncode($id);

	    $body =  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "Hi " . $email . ", ";
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $url = site_url('/') . 'admin/forgetpassword/reset/' . $eid;
	    $body .=  'please click the link to reset your password <a href="' . $url . '">' . $url . '</a>'  ;
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "regards";
	    $body .=  "\n\r";
	    $body .=  "aiitech";
	    $body .=  "\n\r";
	    $body = nl2br($body);
	      

	    $subject = 'Reset your password';

	    $from_email = 'info@aiitech.com';
	    $reply_to = 'info@aiitech.com'; 

	    $email_object = &$this->email; 
	    $email_object->from($from_email, $from_email);
	    $email_object->to($email);
	    $email_object->reply_to($reply_to);
	    $email_object->subject($subject);
	    $email_object->message($body);
	    $status = $email_object->send();
	    $email_object->clear(TRUE);

		$data['status'] = 'Please check your mail';
		$this->load->view('admin/forget_password', $data);

	}

	function reset($eid){
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id < 1) {
			redirect('admin/login');
			return;
		}
		$data['id_md5'] = md5($id);
		$this->load->view('admin/new_password', $data);
	} 


	function setpassword(){
		$id_md5 =  trim($this->input->post('id_md5'));
		$new_password = trim($this->input->post('new_password'));

		$data['password'] = md5($new_password);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->admin_model->update($data, $id_md5);


		$data = array();
		$data['id_md5'] = md5($id_md5);
		$data['status'] = 'Password changed successfully';

		$this->load->view('admin/new_password', $data);
	}

}
