<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fees  extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('Admin/feetype_model');
	    $this->load->model('Admin/fees_model');
	    $this->load->model('semester_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['list'] = $this->fees_model->getList();
		$this->load->view('admin/fees_list', $data);
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$course_id =  trim($this->input->post('course_id'));
		$semester_id =  trim($this->input->post('semester_id'));
		$fee_type_id =  trim($this->input->post('fee_type_id'));
		$fees =  trim($this->input->post('fees'));

		$data['course_id'] = $course_id;
		$data['semester_id'] = $semester_id;
		$data['fee_type_id'] = $fee_type_id;
		$data['fees'] = $fees;

		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->fees_model->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->fees_model->update($data, $id);
		}
		redirect('admin/fees');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->fees_model->delete($id);
		}
		redirect('/admin/fees');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->fees_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->fees_model->getList();
			$this->load->view('admin/fees_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['feetypeList'] = $this->feetype_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();

		$this->load->view('admin/fees_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/fees');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->fees_model->delete($id);
		}
	}

	public function add(){
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['feetypeList'] = $this->feetype_model->getListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$this->load->view('admin/fees_add', $data);
	}

}
