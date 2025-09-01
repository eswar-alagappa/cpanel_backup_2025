<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student_semester extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('user_model');
	    $this->load->model('semester_model');
	    $this->load->model('Admin/student_semester_model');

		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

   }

	public function index() {
		$data['semesterNumList'] = $this->semester_model->getListForDropdown();
		if (isset($_SESSION['student_semester_transfer_status'])) {
			$data['saved_status'] = $_SESSION['student_semester_transfer_status'];
		}
		$this->load->view('admin/student_semester_transfer', $data);
	}

	public function transfer(){
		$from_semester_id = (int) trim($this->input->post('from_semester_id'));
		$to_semester_id = (int) trim($this->input->post('to_semester_id'));

		$sql = "select * from student_semester where semester_id=" . $from_semester_id;
        $query = $this->db->query($sql);
        $rows = $query->result_array();
  		foreach ($rows as $row){
			$data['user_id'] = $row['user_id'];
			$data['course_id'] = $row['course_id'];
			$data['semester_id'] = $to_semester_id;
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->student_semester->insert($data);	
		}
		$_SESSION['student_semester_transfer_status'] = 'Transfer successful';
		redirect('admin/student_semester');
	}


}
