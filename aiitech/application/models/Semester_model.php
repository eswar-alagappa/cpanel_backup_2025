<?php

class semester_model extends CI_Model {

	var $table = 'semester';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getById($id){
		$sql = "select * from " . $this->table . " where id=" . $id;
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return $rows;
	}


	function isNameExists($name, $id = 0){
		$sql = "select * from " . $this->table . " where (name='" . $name . "') and id != " . $id;
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
		$sql = "select s.* from " . $this->table . " s" ;
		if ($filter != ''){
			$sql .= " where " . $filter;
		}
		$sql .= " order by s.name";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return ($rows);
	}

	function delete($id) {
		$sql = "delete from " . $this->table . " where id = " . $id;
		$this->db->query($sql);
	}

	function getListForDropdown($flag = ''){
        $sql  = " select id, name as value  from " ;
		$sql  .=  $this->table ;
		$sql  .= ' order by name';
        $query = $this->db->query($sql);
        $data_result = $query->result_array();
		$data_r  = Array();
		if ($flag == 'all') {
			$data_r[0] = 'All';
		}
		if ($flag == 'select') {
			$data_r[0] = 'Select';
		}
  		foreach ($data_result as $d){
			$data_r[$d['id']] = $d['value'];
		}
		if (!$data_r) {
			$data_r[0] = '';
		}
        return $data_r;
	}

}

?>