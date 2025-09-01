<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('login_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   }

	public function index() {
		$this->load->view('admin/login');
	}

	public function checkValidLogin(){
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));

		$status = $this->login_model->checkLogin($username, $password);

		$msg['status'] = true;
		$msg['id'] = 0;
		if ($status == -1){
			$msg['status'] = false;
			$msg['result'] = "Invalid credential";
		} else if ($status == -2){
			$msg['status'] = false;
			$msg['result'] = "Username is locked";
		} else {
			$msg['result'] = "Login is success";
			$msg['id'] = $status;
		}
		$msg['role'] = $_SESSION['role'];
		echo json_encode($msg);
	}
}
