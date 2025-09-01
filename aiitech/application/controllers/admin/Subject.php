<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class subject extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('semester_model');
	    $this->load->model('subject_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['listSubject'] = $this->subject_model->getList();
		$this->load->view('admin/subject_list', $data);
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$name =  trim($this->input->post('name'));
		$code =  trim($this->input->post('code'));
		$course_id = (int) trim($this->input->post('course_id'));
		$semester_id = (int) trim($this->input->post('semester_id'));

		$data['name'] = $name;
		$data['code'] = $code;
		$data['course_id'] = $course_id;
		$data['semester_id'] = $semester_id;

		if ($this->subject_model->isNameExists($name, $id, $course_id, $semester_id)){
			$data['id'] = $id;
			$data['error'] = "Subject name already exists!";
			$this->load->view('admin/semester_add', $data);
			return;
		} else {
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->subject_model->insert($data);	
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->subject_model->update($data, $id);
			}
		}

		redirect('admin/subject');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->subject_model->delete($id);
		}
		redirect('/admin/subject');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->subject_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listSubject'] = $this->subject_model->getList();
			$this->load->view('admin/subject_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['name'] = $row['name'];
		$data['code'] = $row['code'];
		$data['status'] = $row['status'];
		$data['course_id'] = $row['course_id'];
		$data['semester_id'] = $row['semester_id'];
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$this->load->view('admin/subject_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/subject');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->subject_model->delete($id);
		}
	}

	public function add(){
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$this->load->view('admin/subject_add', $data);
	}

}
