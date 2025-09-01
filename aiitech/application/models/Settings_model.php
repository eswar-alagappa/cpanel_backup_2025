<?php

class Settings_model extends CI_Model {
	var $table = 'settings';

	public function __construct()	{
	  parent::__construct(); 
	}

	function getValueByKey($key){
		$sql = "select * from " . $this->table . " where key_name='" . $key . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		if ($rows){
			return $rows[0]['key_value'];
		}
		return '';
	}

	function isExistKey($key){
		$sql = "select * from " . $this->table . " where key_name='" . $key . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		if ($rows){
			return true;
		}
		return false;
	}

	function saveValueByKey($key, $value){
		if ($this->isExistKey($key)){
			$data['updated_by'] = $_SESSION['username'];
			$data['key_value'] = $value;
			$this->db->where('key_name', $key);
			$this->db->update($this->table, $data); 
		} else {
			$data['updated_by'] = $_SESSION['username'];
			$data['key_name'] = $key;
			$data['key_value'] = $value;
			$this->db->insert($this->table, $data);
		}
	}

}

?>