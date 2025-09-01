<?php

class fees_model extends CI_Model {

	var $table = 'fee_details';

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
		$sql = "select f.*, c.name as course_name, s.name as semester_name, ft.name as fee_type_name  ";
		$sql .= " from " . $this->table . " f " ;
		$sql .= " left join course c on c.id = f.course_id " ;
		$sql .= " left join semester s on s.id = f.semester_id " ;
		$sql .= " left join fee_type ft on ft.id = f.fee_type_id " ;
		if ($filter != ''){
			$sql .= " and " . $filter;
		}
		$sql .= " order by c.name, s.name, ft.name desc  ";
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