<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app_form extends CI_Controller {

	public function index() {
		$this->load->view('app_form');
	}
}
