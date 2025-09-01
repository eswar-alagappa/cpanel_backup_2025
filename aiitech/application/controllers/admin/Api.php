<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api  extends CI_Controller {

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
   }

	function getFeesDurationByCourseSemester(){
		$course_id = (int) trim($this->input->post('course_id'));
		$sql = "select c.* from course c where id = " . $course_id;
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$msg['status'] = false;
		if ($rows) {
			$msg['status'] = true;
			$msg['fees'] = $rows[0]['fees'] ;
			$msg['duration'] = $rows[0]['duration'] ;
		}
		echo json_encode($msg);
	}

}
