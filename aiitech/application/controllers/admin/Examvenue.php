<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class examvenue extends CI_Controller {
	var $arrField;
 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
		$this->common_model->isLoggedIn();
	    
	    $this->load->model('semester_model');
	    $this->load->model('admin/exam_venue_model', 'evm');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

		$i=0;
		$this->arrField[$i] = 'id'; $i++;
		$this->arrField[$i] = 'graduate'; $i++;
		$this->arrField[$i] = 'semester_id'; $i++;
		$this->arrField[$i] = 'session_start'; $i++;
		$this->arrField[$i] = 'session_end'; $i++;
		$this->arrField[$i] = 'address'; $i++;
		$this->arrField[$i] = 'area'; $i++;
		$this->arrField[$i] = 'city'; $i++;
		$this->arrField[$i] = 'pin'; $i++;
		$this->arrField[$i] = 'landmark'; $i++;
		$this->arrField[$i] = 'google_map'; $i++;
   }

	public function index() {
		$data['list'] = $this->evm->getList();
		$this->load->view('admin/exam_venue_list', $data);
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

		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->evm->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->evm->update($data, $id);
		}

		redirect('admin/examvenue');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->evm->delete($id);
		}
		redirect('/admin/examvenue');
	}


	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/examvenue');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->evm->delete($id);
		}
	}

	public function add(){
		$data['arrField'] = $this->arrField;
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		
		$this->load->view('admin/exam_venue_add', $data);
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->evm->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->evm->getList();
			$this->load->view('admin/exam_venue_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['arrField'] = $this->arrField;
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$data['semesterList'] = $this->semester_model->getListForDropdown();
		$this->load->view('admin/exam_venue_add', $data);
	}

}
