<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {
	var $arrField;

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('course_model');
	    $this->load->model('user_model');
	    $this->load->model('Admin/student_model');
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
   }

	public function index() {
		$id = $_SESSION['id'];
		$rows = $this->user_model->getById($id);
		if (!$rows) {
			redirect('admin/dashboard');
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

		$this->load->view('admin/myaccount_view', $data);
	}

}
