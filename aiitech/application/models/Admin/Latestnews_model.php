<?php

class latestnews_model extends CI_Model {

	var $table = 'latest_news';

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
		$sql = "select ln.*   ";
		$sql .= " from " . $this->table . " ln " ;
		if ($filter != ''){
			$sql .= " where " . $filter;
		}
		$sql .= " order by ln.id  ";
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