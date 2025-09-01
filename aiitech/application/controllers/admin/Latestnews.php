<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class latestnews extends CI_Controller {
	var $arrField;

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/latestnews_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   		$this->common_model->isLoggedIn();
		$i=0;
		$this->arrField[$i] = 'id'; $i++;
		$this->arrField[$i] = 'name'; $i++;
		$this->arrField[$i] = 'title'; $i++;
		$this->arrField[$i] = 'description'; $i++;

}

	public function index() {
		$data['list'] = $this->latestnews_model->getList();
		$this->load->view('admin/latestnews_list', $data);
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
			$id = $this->latestnews_model->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->latestnews_model->update($data, $id);
		}
		redirect('admin/latestnews');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->latestnews_model->delete($id);
		}
		redirect('/admin/latestnews');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->latestnews_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->latestnews_model->getList();
			$this->load->view('admin/latestnews_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;
		$data['arrField'] = $this->arrField;

		$this->load->view('admin/latestnews_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/latestnews');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->latestnews_model->delete($id);
		}
	}

	public function add(){
		$data['welcome'] = 'Great';
		$data['arrField'] = $this->arrField;
		$this->load->view('admin/latestnews_add', $data);
	}

}
