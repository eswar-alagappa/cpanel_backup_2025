<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	var $arrField;

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('user_model');
	    $this->load->model('Admin/student_model');
	    $this->load->model('semester_model');

		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

		$i=0;
		$this->arrField[$i] = 'id'; $i++;
		$this->arrField[$i] = 'roll_num'; $i++;
		$this->arrField[$i] = 'gender'; $i++;
		$this->arrField[$i] = 'first_name'; $i++;
		$this->arrField[$i] = 'last_name'; $i++;
		$this->arrField[$i] = 'father_name'; $i++;
		$this->arrField[$i] = 'email_id'; $i++;
		$this->arrField[$i] = 'phone'; $i++;
		$this->arrField[$i] = 'address'; $i++;
		$this->arrField[$i] = 'address'; $i++;
		$this->arrField[$i] = 'residential_address'; $i++;
		$this->arrField[$i] = 'pincode'; $i++;
		$this->arrField[$i] = 'city'; $i++;
		$this->arrField[$i] = 'state'; $i++;
		$this->arrField[$i] = 'country'; $i++;
		$this->arrField[$i] = 'fees'; $i++;
		$this->arrField[$i] = 'highest_qualification'; $i++;
		$this->arrField[$i] = 'medium'; $i++;
		$this->arrField[$i] = 'university'; $i++;
		$this->arrField[$i] = 'semester'; $i++;
		$this->arrField[$i] = 'course_id'; $i++;
		$this->arrField[$i] = 'duration'; $i++;
		$this->arrField[$i] = 'martial_status'; $i++;
		$this->arrField[$i] = 'date_of_birth'; $i++;
		$this->arrField[$i] = 'image_url'; $i++;
		$this->arrField[$i] = 'password'; $i++;
		$this->arrField[$i] = 'semester_joining_id'; $i++;

   }

	public function index() {
		$data['listStudent'] = $this->student_model->getList();
		$this->load->view('admin/student_list', $data);
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
		$data['role'] = 3;
		if ($id == 0) {
			$data['username'] = $email_id;
			$data['password'] = md5($password);
		}

		if ($this->student_model->isExists($id, $roll_num, $email_id)){
			$data['id'] = $id;
			$data['error'] = "Roll number already exists!";
			$data['courseList'] = $this->course_model->getListForDropdown();
			$this->load->view('admin/student_add', $data);
			return;
		} else {
			$data['date_of_birth'] = $this->common_model->getDateYMDfromDMY($date_of_birth);
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->student_model->insert($data);	
				$this->student_model->sendMailToStudent($this, $id, $password);
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->student_model->update($data, $id);
			}

			$file = $this->common_model->getFilesUploadedName('image_url');
			if ($file != ''){
				$file_saved = $this->common_model->getFilesUploadedSavedName('image_url', 'student'. $id);
				$data1['image_url'] = $file_saved;
				$this->student_model->update($data1, $id);
			}


		}

		redirect('admin/student');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->student_model->delete($id);
		}
		redirect('/admin/student');
	}


	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/student');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->student_model->delete($id);
		}
	}

	public function add(){
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['universityList'] = $this->common_model->getUniversityListForDropdown();
		$data['mediumList'] = $this->common_model->getMediumListForDropdown();
		$data['genderList'] = $this->common_model->getGenderListForDropdown();
		$data['martialStatusList'] = $this->common_model->getMartialStatusListForDropdown();
		$data['semesterList'] = $this->common_model->getSemesterListForDropdown();
		$data['semesterNumList'] = $this->semester_model->getListForDropdown();
		$data['arrField'] = $this->arrField;
		$this->load->view('admin/student_add', $data);
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->user_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listStudent'] = $this->student_model->getList();
			$this->load->view('admin/student_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['courseList'] = $this->course_model->getListForDropdown();
		$data['universityList'] = $this->common_model->getUniversityListForDropdown();
		$data['mediumList'] = $this->common_model->getMediumListForDropdown();
		$data['genderList'] = $this->common_model->getGenderListForDropdown();
		$data['martialStatusList'] = $this->common_model->getMartialStatusListForDropdown();
		$data['semesterList'] = $this->common_model->getSemesterListForDropdown();
		$data['arrField'] = $this->arrField;
		$data['semesterNumList'] = $this->semester_model->getListForDropdown();

		$this->load->view('admin/student_add', $data);
	}

}
