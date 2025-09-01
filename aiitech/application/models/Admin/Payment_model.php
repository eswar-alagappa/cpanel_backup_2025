<?php

class payment_model extends CI_Model {

	var $table = 'payment';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getById($id){
		$sql = "select * from " . $this->table . " where id=" . $id;
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
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
		$sql = "select p.*, c.name as course_name, u.first_name, u.last_name, s.name as semester_name  ";
		$sql .= " from " . $this->table . " p " ;
		$sql .= " left join users u on u.id = p.student_id " ;
		$sql .= " left join course c on c.id = u.course_id " ;
		$sql .= " left join semester s on s.id = p.semester_id " ;
		if ($filter != ''){
			$sql .= " and " . $filter;
		}
		$sql .= " order by p.date desc  ";
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