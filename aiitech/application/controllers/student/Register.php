<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
	    $this->load->model('user_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   }

	public function index() {
		$this->load->view('student/register');
	}

	public function doRegister(){
		$roll_num = trim($this->input->post('roll_num'));
		$email_id = trim($this->input->post('email_id'));
		$verification_code = $this->common_model->getUUID();

		$sql = "update users set verification_code = '" . "' where roll_num='" . $roll_num . "'";
		$this->db->query($sql);

		$this->sendVerificatoinMail($roll_num);
	}

	public function checkForRegister(){
		$roll_num = trim($this->input->post('roll_num'));
		$email_id = trim($this->input->post('email_id'));
		$msg['status'] = true;

		$rows = $this->user_model->getByRollnum($roll_num);
		if ($rows) {
			$row = $rows[0];
			if ($row['is_activated'] == 1){
				$msg['status'] = false;
				$msg['result'] = 'Already registered for this roll num';
				echo json_encode($msg);
				return;
			}
			if ($row['email_id'] != '' && $row['is_activated'] == 0){
				$msg['status'] = false;
				$msg['result'] = 'Please verify your email link sent to your mail id';
				echo json_encode($msg);
				return;
			}
		} else {
			$msg['status'] = false;
			$msg['result'] = 'Invalid Roll Number';
			echo json_encode($msg);
			return;
		}
		if ($this->user_model->isEmailExist($email_id)){
			$msg['status'] = false;
			$msg['result'] = 'Email id is already Registered';
			echo json_encode($msg);
			return;
		}
		echo json_encode($msg);
		return;
	}

	function sendVerificatoinMail($roll_num){
		$rows = $this->user_model->getByRollnum($roll_num);
		if (!$rows) {
			return;
		}
		$row = $rows[0];
	}
}
