<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment  extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('Admin/feetype_model');
	    $this->load->model('Admin/payment_model');
	    $this->load->model('Admin/student_model');
	    $this->load->model('semester_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['list'] = $this->payment_model->getList();
		$this->load->view('admin/payment_list', $data);
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$date =  trim($this->input->post('date'));
		$student_id =  trim($this->input->post('student_id'));
		$course_id =  trim($this->input->post('course_id'));
		$old_semester_id =  trim($this->input->post('old_semester_id'));
		$semester_id =  trim($this->input->post('semester_id'));
		$fee_type_id =  trim($this->input->post('fee_type_id'));
		$received_amount =  trim($this->input->post('received_amount'));

		$data['date'] = $this->common_model->getDateYMDfromDMY($date);
		$data['student_id'] = $student_id;
		$data['fee_type_id'] = $fee_type_id;
		$data['course_id'] = $course_id;
		$data['old_semester_id'] = $old_semester_id;
		$data['semester_id'] = $semester_id;
		$data['received_amount'] = $received_amount;

		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->payment_model->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->payment_model->update($data, $id);
		}
		redirect('admin/payment');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->payment_model->delete($id);
		}
		redirect('/admin/payment');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->payment_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->payment_model->getList();
			$this->load->view('admin/payment_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['feetypeList'] = $this->feetype_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$data['studentList'] = $this->student_model->getListForDropdown();

		$this->load->view('admin/payment_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/payment');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->student_model->delete($id);
		}
	}

	public function add(){
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['feetypeList'] = $this->feetype_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$data['studentList'] = $this->student_model->getListForDropdown();
		$this->load->view('admin/payment_add', $data);
	}

}
