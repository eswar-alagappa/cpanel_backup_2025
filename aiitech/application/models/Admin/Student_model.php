<?php

class Student_model extends CI_Model {

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


	function isExists($roll_num, $id = 0){
		$sql = "select * from " . $this->table . " where (roll_num='$roll_num') and id !=$id";
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
		$sql = "select s.*, c.name as course_name  ";
		$sql .= " from " . $this->table . " s " ;
		$sql .= " left join course c on c.id = s.course_id " ;
		$sql .= " where role=3 ";
		if ($filter != ''){
			$sql .= " and " . $filter;
		}
		$sql .= " order by s.roll_num, s.first_name, s.last_name  ";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		return ($rows);
	}

	function getCount($filter = ''){
		$sql = "select role, count(1) as cnt ";
		$sql .= " from " . $this->table . " s " ;
		if ($filter != ''){
			$sql .= " and " . $filter;
		}
		$sql .= " group by role ";



		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$count[2] = 0;
		$count[3] = 0;
		if ($rows){
			foreach ($rows as $row) {
				$count[$row['role']] = $row['cnt'];
			}
		}
		return ($count);
	}

	function delete($id) {
		$sql = "delete from " . $this->table . " where id = " . $id;
		$this->db->query($sql);
	}

	function getListForDropdown($flag = ''){
        $sql  = " select id, concat(first_name, ' ', last_name) as value  from " ;
		$sql  .=  $this->table ;
		$sql  .= ' where role=3 ';
		$sql  .= ' order by first_name, last_name';
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

	function sendMailToStudent(&$baseObject, $id, $password){
		$rows = $this->getById($id);
		if (!$rows){
			return ;
		}
		$row = $rows[0];

	    $body =  'Hi ' . $row['first_name'] . ' ' . $row['last_name'];
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "Login url : " . '<a href="' . site_url('/admin/login') . '">' . site_url('/admin/login')  . ' </a>';
	    $body .=  "\n\r";
	    $body .=  "Username : " . $row['username'];
	    $body .=  "\n\r";
	    $body .=  "Password: " . $password;
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body .=  "Regards,";
	    $body .=  "\n\r";
	    $body .=  "AIITECH";
	    $body .=  "\n\r";
	    $body .=  "\n\r";
	    $body = nl2br($body);

	    $subject = 'Aiitech - your login details';
	    $from_email =  'info@aiitech.com';
	    $email = $row['email_id'];
	    $reply_to = "info@aiitech.com";

	    $email_object = &$baseObject->email; 
	    $email_object->from($from_email, $from_email);
	    $email_object->to($email);
	    $email_object->reply_to($reply_to);
	    $email_object->subject($subject);
	    $email_object->message($body);
	    $status = $email_object->send();
	    $email_object->clear(TRUE);
	}
}

?>