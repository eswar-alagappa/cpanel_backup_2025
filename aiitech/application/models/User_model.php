<?php

class user_model extends CI_Model {

	var $table = 'users';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getByIdmd5($id_md5){
		$sql = "select * from " . $this->table . " where md5(id)='" . $id_md5 . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}

	function getById($id){
		$sql = "select * from " . $this->table . " where (id)='" . $id . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}

	function getByRollnum($roll_num){
		$sql = "select * from " . $this->table . " where roll_num='" . $roll_num . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}

	function isEmailExist($email_id){
		$sql = "select * from " . $this->table . " where email_id='" . $email_id . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		if ($rows){
			return true;
		}
		return false;
	}

	function insert($data){
		$data['updated_by'] = $_SESSION['username'];
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		return ($id);
	}

	function update($data, $id){
		$data['updated_by'] = $_SESSION['username'];
		$this->db->where('id', $id);
		$this->db->update($this->table, $data); 
	}
}

?>