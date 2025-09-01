<?php

class subject_model extends CI_Model {

	var $table = 'subject';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getById($id){
		$sql = "select * from " . $this->table . " where id=" . $id;
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}


	function isNameExists($name, $id = 0, $course_id = 0, $semester_id = 0){
		$sql = "select * from " . $this->table . " where (name='" . $name . "' and course_id=$course_id and semester_id=$semester_id) and id !=$id";
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
		$sql = "select su.*, s.name as semester_name, c.name as course_name ";
		$sql .= " from " . $this->table . " su " ;
		$sql .= " left join course c on c.id = su.course_id " ;
		$sql .= " left join semester s on s.id = su.semester_id " ;
		if ($filter != ''){
			$sql .= " where " . $filter;
		}
		$sql .= " order by c.name, s.name, su.name ";
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