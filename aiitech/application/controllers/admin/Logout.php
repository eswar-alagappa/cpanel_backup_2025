<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logout extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		session_destroy();
		redirect('admin/login');
	}
}
