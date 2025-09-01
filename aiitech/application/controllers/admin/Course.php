<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class course extends CI_Controller {
	var $arrField;
 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

		$i=0;
		$this->arrField[$i] = 'id'; $i++;
		$this->arrField[$i] = 'name'; $i++;
		$this->arrField[$i] = 'semester'; $i++;
		$this->arrField[$i] = 'graduate'; $i++;
		$this->arrField[$i] = 'duration'; $i++;
		$this->arrField[$i] = 'fees'; $i++;
		$this->arrField[$i] = 'university'; $i++;
		$this->arrField[$i] = 'medium'; $i++;

   }

	public function index() {
		$data['listCourse'] = $this->course_model->getList();
		$this->load->view('admin/course_list', $data);
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$data = array();
		foreach ($this->arrField as $key => $value) {
			if ($value != 'id') {
				$$value =  trim($this->input->post($value));
				$data[$value] = $$value;
			}
		}		

		if ($this->course_model->isNameExists($name, $id)){
			$data['id'] = $id;
			$data['error'] = "Course name already exists!";
			$data['arrField'] = $this->arrField;
			$this->load->view('admin/course_add', $data);
			return;
		} else {
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->course_model->insert($data);	
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->course_model->update($data, $id);
			}
		}

		redirect('admin/course');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->course_model->delete($id);
		}
		redirect('/admin/course');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->course_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listCourse'] = $this->course_model->getList();
			$this->load->view('admin/course_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['arrField'] = $this->arrField;
		$data['semesterList'] = $this->common_model->getSemesterListForDropdown();
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$data['universityList'] = $this->common_model->getUniversityListForDropdown();
		$data['mediumList'] = $this->common_model->getMediumListForDropdown();
		$this->load->view('admin/course_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/course');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->course_model->delete($id);
		}
	}

	public function add(){
		$data['arrField'] = $this->arrField;
		$data['semesterList'] = $this->common_model->getSemesterListForDropdown();
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$data['universityList'] = $this->common_model->getUniversityListForDropdown();
		$data['mediumList'] = $this->common_model->getMediumListForDropdown();
		$this->load->view('admin/course_add', $data);
	}

}
