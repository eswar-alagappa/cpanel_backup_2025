<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class examnotification extends CI_Controller {
	var $arrField;
 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/exam_notification_model', 'enm');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

		$i=0;
		$this->arrField[$i] = 'id'; $i++;
		$this->arrField[$i] = 'graduate'; $i++;
		$this->arrField[$i] = 'apply_date'; $i++;
		$this->arrField[$i] = 'last_date'; $i++;
		$this->arrField[$i] = 'penalty'; $i++;
		$this->arrField[$i] = 'fees'; $i++;

   }

	public function index() {
		$data['list'] = $this->enm->getList();
		$this->load->view('admin/exam_notification_list', $data);
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

		$data['apply_date'] = $this->common_model->getDateYMDfromDMY($apply_date);
		$data['last_date'] = $this->common_model->getDateYMDfromDMY($last_date);
		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->enm->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->enm->update($data, $id);
		}

		redirect('admin/examnotification');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->enm->delete($id);
		}
		redirect('/admin/examnotification');
	}


	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/examnotification');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->enm->delete($id);
		}
	}

	public function add(){
		$data['arrField'] = $this->arrField;
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$this->load->view('admin/exam_notification_add', $data);
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->enm->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->enm->getList();
			$this->load->view('admin/exam_notification_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['arrField'] = $this->arrField;
		$data['graduateList'] = $this->common_model->getGraduateListForDropdown();
		$this->load->view('admin/exam_notification_add', $data);
	}

}
