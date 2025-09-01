<?php

class login_model extends CI_Model {

	public function __construct()	{
		parent::__construct(); 
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
	}

	function checkLogin($username, $password){
		$_SESSION['role'] = 0;
		$sql = "select * from users where username='" . $username . "' and password='" . md5($password) . "' ";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		if (!$rows){
			return -1;
		}
		if ($rows){
			if ($rows[0]['status'] == 0) {
				return -2;
			}
		}
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $rows[0]['id'];
		$_SESSION['role'] = $rows[0]['role'];
		$_SESSION['rolename'] = $this->common_model->getRoleNameById($rows[0]['role']);
		$_SESSION['key'] = 'ai';
		$_SESSION['first_name'] = $rows[0]['first_name'];
		$_SESSION['last_name'] = $rows[0]['last_name'];
		$_SESSION['image_url'] = $rows[0]['image_url'];
		return $rows[0]['id'];
	}

}

?>