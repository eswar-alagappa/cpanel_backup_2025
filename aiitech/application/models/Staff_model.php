<?php

class staff_model extends CI_Model {

	var $table = 'users';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getById($id){
		$sql = "select * from " . $this->table . " where id=" . $id;
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}


	function isExists($id, $email, $phone){
		$sql = "select * from $this->table where (email_id='$email' or phone='$phone') and id !=$id";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		if ($rows) {
			return true;
		} else {
			return false;
		}
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

	function getList($filter = ''){
		$sql = "select s.*  ";
		$sql .= " from " . $this->table . " s " ;
		$sql .= " where role=2 ";
		if ($filter != ''){
			$sql .= " and " . $filter;
		}
		$sql .= " order by s.first_name, s.last_name  ";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return ($rows);
	}

	function delete($id) {
		$sql = "delete from " . $this->table . " where id = " . $id;
		$this->db->query($sql);
	}


}

?>