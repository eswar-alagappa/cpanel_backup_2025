<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class staff extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('staff_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   		$this->common_model->isLoggedIn();
	}

	public function index() {
		$data['listStaff'] = $this->staff_model->getList();
		$this->load->view('admin/staff_list', $data);
	}

	public function save(){
		//print_r($_POST); die();

		$id = (int) trim($this->input->post('id'));
		$first_name =  trim($this->input->post('first_name'));
		$last_name =  trim($this->input->post('last_name'));
		$email_id =  trim($this->input->post('email_id'));
		$phone =  trim($this->input->post('phone'));
		$gender =  trim($this->input->post('gender'));
		$date_of_birth =  trim($this->input->post('date_of_birth'));
		$date_of_joining =  trim($this->input->post('date_of_joining'));
		$martial_status =  trim($this->input->post('martial_status'));
		$father_name =  trim($this->input->post('father_name'));
		$spouse_name =  trim($this->input->post('spouse_name'));
		$address =  trim($this->input->post('address'));
		$residential_address =  trim($this->input->post('residential_address'));
		$pincode =  trim($this->input->post('pincode'));
		$city =  trim($this->input->post('city'));
		$state =  trim($this->input->post('state'));
		$country =  trim($this->input->post('country'));
		$designation =  trim($this->input->post('designation'));
		$subject_taken =  trim($this->input->post('subject_taken'));
		$department_handling =  trim($this->input->post('department_handling'));
		$employeed_experience =  trim($this->input->post('employeed_experience'));
		$qualification =  trim($this->input->post('qualification'));
		$community =  trim($this->input->post('community'));
		$nationality =  trim($this->input->post('nationality'));

		$data['first_name'] = $first_name;
		$data['last_name'] = $last_name;
		$data['email_id'] = $email_id;
		$data['phone'] = $phone;
		$data['gender'] = $gender;
		$data['role'] = 2;
		$data['date_of_birth'] = $date_of_birth;
		$data['date_of_joining'] = $date_of_joining;
		$data['martial_status'] = $martial_status;
		$data['father_name'] =  $father_name;
		$data['spouse_name'] =  $spouse_name;
		$data['address'] =  $address;
		$data['pincode'] =  $pincode;
		$data['city'] =  $city;
		$data['state'] =  $state;
		$data['country'] =  $country;
		$data['designation'] =  $designation;
		$data['subject_taken'] =  $subject_taken;
		$data['department_handling'] =  $department_handling;
		$data['employeed_experience'] =  $employeed_experience;
		$data['qualification'] =  $qualification;
		$data['community'] =  $community;
		$data['nationality'] =  $nationality;
		$data['residential_address'] =  $residential_address;

		if ($this->staff_model->isExists($id, $email_id, $phone)){
			$data['id'] = $id;
			$data['error'] = "Email id/phone already exists!";
			$data['genderList'] = $this->common_model->getGenderListForDropdown();
			$data['martialStatusList'] = $this->common_model->getMartialStatusListForDropdown();
			$this->load->view('admin/staff_add', $data);
			return;
		} else {
			$data['date_of_birth'] = $this->common_model->getDateYMDfromDMY($date_of_birth);
			$data['date_of_joining'] = $this->common_model->getDateYMDfromDMY($date_of_joining);
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->staff_model->insert($data);	
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->staff_model->update($data, $id);
			}
		}

		redirect('admin/staff');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->staff_model->delete($id);
		}
		redirect('/admin/staff');
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/staff');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->staff_model->delete($id);
		}
	}

	public function add(){
		$data['genderList'] = $this->common_model->getGenderListForDropdown();
		$data['martialStatusList'] = $this->common_model->getMartialStatusListForDropdown();
		$this->load->view('admin/staff_add', $data);
	}
	
	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->staff_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listStaff'] = $this->staff_model->getList();
			$this->load->view('admin/staff_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['genderList'] = $this->common_model->getGenderListForDropdown();
		$data['martialStatusList'] = $this->common_model->getMartialStatusListForDropdown();

		$this->load->view('admin/staff_add', $data);
	}


}
