<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class viewprofile extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('user_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   		$this->common_model->isLoggedIn();
	}

	public function index($id_md5 ) {
	}

	public function display($id_md5) {
		$data['details'] = $this->user_model->getByIdmd5($id_md5);
		$this->load->view('admin/view_profile', $data);
	}

	public function edit() {
		$id = $this->input->post('id');
		$id = (int) $id;
		$rows = $this->user_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['details'] = $this->user_model->getByIdmd5(md5($id));
			$this->load->view('admin/view_profile', $data);
			return;
		}
		$row = $rows[0];
		$data['details'] = $rows;
		$data['id'] = $id;
		$this->load->view('admin/profile_edit', $data);
	}
	
	public function save($eid) {
		$id = (int) trim($this->input->post('id'));
		$first_name = trim($this->input->post('first_name'));
		$last_name = trim($this->input->post('last_name'));
		$image_url = trim($this->input->post('image_url'));

		$data['first_name'] = $first_name;
		$data['last_name'] = $last_name;

		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->user_model->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->user_model->update($data, $id);
		}

		$file = $this->common_model->getFilesUploadedName('image');
		if ($file != ''){
			$file_saved = $this->common_model->getFilesUploadedSavedName('image', 'photo'. $id);
			$data1['image_url'] = $file_saved;
			$this->user_model->update($data1, $id);
		}

		redirect('admin/dashboard');
	}

}
