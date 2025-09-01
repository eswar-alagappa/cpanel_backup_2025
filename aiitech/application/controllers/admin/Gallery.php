<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('Admin/gallery_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();
   }

	public function index() {
		$data['list'] = $this->gallery_model->getList();
		$this->load->view('admin/gallery_list', $data);
	}

	public function add(){
		$data['welcome'] = 'greetings';
		$this->load->view('admin/gallery_add', $data);
	}

	public function view(){
		$action = trim($this->input->post('action'));
		$filter = '';
		if ($action == 'deleteall'){
			$this->deleteAll();
		}
		redirect('admin/gallery');
	}

	public function save(){
		$id = (int) trim($this->input->post('id'));
		$title = trim($this->input->post('title'));
		$description = trim($this->input->post('description'));
		$image_url = trim($this->input->post('image_url'));

		$data['title'] = $title;
		$data['description'] = $description;
		

		if ($id == 0) {
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			$id = $this->gallery_model->insert($data);	
		} else {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->gallery_model->update($data, $id);
		}

		$file = $this->common_model->getFilesUploadedName('image');
		if ($file != ''){
			$file_saved = $this->common_model->getFilesUploadedSavedName('image', 'gallery'. $id);
			$data1['image_url'] = $file_saved;
			$this->gallery_model->update($data1, $id);
		}

		redirect('/admin/gallery');
	}

	public function delete($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		if ($id > 0) {
			$this->gallery_model->delete($id);
		}
		redirect('/admin/gallery');
	}

	public function edit($eid) {
		$id = $this->common_model->myDecode($eid);
		$id = (int) $id;
		$rows = $this->gallery_model->getById($id);
		if (!$rows) {
			$data['error'] = 'Record not found!';
			$data['list'] = $this->gallery_model->getList();
			$this->load->view('admin/gallery_list', $data);
			return;
		}
		$row = $rows[0];
		$data['details'] = $rows;
		$data['id'] = $id;
		$this->load->view('admin/gallery_add', $data);
	}

	function deleteAll(){
		$ids = $this->input->post('chkDelete');
		foreach ($ids as $key => $id) {
			$this->gallery_model->delete($id);
		}
	}

}

/* */
/* */
