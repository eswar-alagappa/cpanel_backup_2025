<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->model('common_model');
	}

	public function index() {
		$data['PDF_COURSE_OFFERED'] = $this->settings_model->getValueByKey('PDF_COURSE_OFFERED');
		if ($data['PDF_COURSE_OFFERED'] != '') {
			$data['PDF_COURSE_OFFERED'] = base_url('/') . 'doc/' . $data['PDF_COURSE_OFFERED'];
		}
		$this->load->view('home', $data);
	}
}
