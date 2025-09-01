<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class semester extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('semester_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['listSemester'] = $this->semester_model->getList();
		$this->load->view('admin/semester_list', $data);
	}

	public function save(){
		$name =  trim($this->input->post('name'));
		$id = (int) trim($this->input->post('id'));

		$data['name'] = $name;

		if ($this->semester_model->isNameExists($name, $id)){
			$data['id'] = $id;
			$data['error'] = "Semester name already exists!";
			$this->load->view('admin/semester_add', $data);
			return;
		} else {
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->semester_model->insert($data);	
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->semester_model->update($data, $id);
			}
		}

		redirect('admin/semester');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->semester_model->delete($id);
		}
		redirect('/admin/semester');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->semester_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listSemester'] = $this->semester_model->getList();
			$this->load->view('admin/semester_list', $data);
			return;
		}
		$row = $rows[0];
		$data['name'] = $row['name'];
		$data['status'] = $row['status'];
		$data['id'] = $id;
		$this->load->view('admin/semester_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/semester');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->semester_model->delete($id);
		}
	}

	public function add(){
		$this->load->view('admin/semester_add');
	}

}
