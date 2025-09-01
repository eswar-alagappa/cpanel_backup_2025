<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class feetype extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/feetype_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['listFeetype'] = $this->feetype_model->getList();
		$this->load->view('admin/feetype_list', $data);
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$name =  trim($this->input->post('name'));


		$data['name'] = $name;

		if ($this->feetype_model->isExists($roll_num, $id)){
			$data['id'] = $id;
			$data['error'] = "Roll number already exists!";
			$this->load->view('admin/feetype_add', $data);
			return;
		} else {
			if ($id == 0) {
				$data['created_at'] = date('Y-m-d H:i:s');
				$data['updated_at'] = date('Y-m-d H:i:s');
				$id = $this->feetype_model->insert($data);	
			} else {
				$data['updated_at'] = date('Y-m-d H:i:s');
				$this->feetype_model->update($data, $id);
			}
		}

		redirect('admin/feetype');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->feetype_model->delete($id);
		}
		redirect('/admin/feetype');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->feetype_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['listFeetype'] = $this->feetype_model->getList();
			$this->load->view('admin/feetype_list', $data);
			return;
		}
		$row = $rows[0];
		$data['id'] = $id;
		$data['details'] = $rows;

		$this->load->view('admin/feetype_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('/admin/feetype');
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->feetype_model->delete($id);
		}
	}

	public function add(){
		$data['dummy'] = '';
		$this->load->view('admin/feetype_add', $data);
	}

}
