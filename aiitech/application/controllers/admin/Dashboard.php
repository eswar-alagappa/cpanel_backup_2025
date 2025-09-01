<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/student_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['Welcome'] = 'Happy';
		$arr = $this->student_model->getCount();
		$data['staff_count'] = $arr[2];
		$data['student_count'] = $arr[3];
		$this->load->view('admin/dashboard', $data);
	}

}
