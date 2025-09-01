<?php

class admin_model extends CI_Model {

	var $table = 'users';

	public function __construct()	{
	  parent::__construct(); 
	}

	function update($data, $id_md5){
		$username = 'system';
		if (isset($_SESSION['username'])){
			$username = $_SESSION['username'];
		}
		$data['updated_by'] = $username;
		$this->db->where('md5(id)', $id_md5);
		$this->db->update($this->table, $data); 
	}

}

?>