<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class management extends CI_Controller {

	public function index() {
		$this->load->view('management');
	}
}
