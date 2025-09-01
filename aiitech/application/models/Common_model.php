<?php

include_once('simpleimage.php');

class Common_model extends CI_Model {

	public function __construct()	{
	  parent::__construct(); 
	    $this->load->model('settings_model');
		//error_reporting(E_ALL ^ E_DEPRECATED);
	}

	function myEncode($id){
		return str_replace(array('+', '/', '='), array('-', '_', '~'),$this->encrypt->encode($id));
	}

	function myDecode($id){
		$id = str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
		$id = $this->encrypt->decode($id);
		return $id;
	}

	function isLoggedIn() {
		if (!isset($_SESSION) ){ 	
			session_start();
		}

		$key = '';
		$id = -1;
		$role = -1;
		$username = -1;

		if (isset($_SESSION['key'])) {
			$key = $_SESSION['key'];
		}

		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}

		if (isset($_SESSION['role'])) {
			$role = $_SESSION['role'];
		}

		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
		}

		if( $key='ai' && $id > 0 && $role > 0 )  {
			return true;
		} else {
			session_destroy();
			redirect("admin/login");
			return false;
		}

	}

	function getUserRole() {
		if (!isset($_SESSION) ){ 	
			session_start();
		}

		$role = -1;

		if (isset($_SESSION['role'])) {
			$role = $_SESSION['role'];
		}
		if ($role == 1) {
			return 'superadmin';
		} else if ($role == 2) {
			return 'admin';
		} else {
			return '';
		}
	}

	function getUserId() {
		if (!isset($_SESSION) ){ 	
			session_start();
		}

		$id = 0;

		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
		}
		return $id;
	}

	function right($value, $count){ return substr($value, ($count*-1)); }
	function left($string, $count){ return substr($string, 0, $count); }
	function number($num){ return ((int) $num); }


	function getDateYMDfromDMY($date, $chr='/'){
		$arr = explode($chr, $date);
		if (count($arr) == 3) {
		    $date = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
		}
		return ($date);
	}

	function getFilesUploadedName($upload_name, $upload_ext = '') {
		if (!isset($_FILES[$upload_name])){
			return '';
		}
		if ($_FILES[$upload_name]['error'] != 0) {
			return '';
		}
		$name = $_FILES[$upload_name]['name'];
		$ext = $this->common_model->right($name,4);
		$ext = strtolower($ext);
		$allowed = false;
		if ($upload_ext != ''){
			if (strpos($ext, $upload_ext) > 0){
		    	$allowed = true;
			}
		} else if (strpos($ext,'jpg') > 0 || strpos($ext,'png') > 0 || strpos($ext,'jpeg') > 0 || strpos($ext,'jpg') > 0 || strpos($ext,'gif') > 0){
		    $allowed = true;
		}
		if (!$allowed) {
		    return '';
		}
		return ($name);
	}

	function getFilesUploadedSavedName($upload_name, $fileId, $upload_ext = '', $upload_dir = 'uploads') {
		if (!isset($_FILES[$upload_name])){
			return '-';
		}
		if ($_FILES[$upload_name]['error'] != 0) {
			return '-';
		}
		$tmp_name = $_FILES[$upload_name]['tmp_name'];
		$type = $_FILES[$upload_name]['type'];
		$name = $_FILES[$upload_name]['name'];
		$ext = $this->common_model->right($name,4);
		$ext = strtolower($ext);
		$allowed = false;
		if ($upload_ext != ''){
			if (strpos($ext, $upload_ext) > 0){
		    	$allowed = true;
			}
		} else if (strpos($ext,'jpg') > 0 || strpos($ext,'png') > 0 || strpos($ext,'jpeg') > 0 || strpos($ext,'jpg') > 0 || strpos($ext,'gif') > 0){
		    $allowed = true;
		}
		if (!$allowed) {
		    return '';
		}

		$path = pathinfo($name);
		$extension = '';
		if (isset($path['extension'])) {
		    $extension = $path['extension'];
		}


		$image_file_name =  $fileId . '';
		if ($extension != '') $image_file_name .= "." . $extension;
		$os = strtoupper (PHP_OS);
		$dir = $_SERVER['SCRIPT_FILENAME'];
		$dir = str_replace('index.php', '', $dir);
		$dest_path = '';
		$dest_dir = '';
		if ($os == 'LINUX') {
			$dest_dir = $dir . $upload_dir . '/';
			$dest_path = $dir . $upload_dir . '/' . $image_file_name;
		} else {
			$dest_dir = $dir . $upload_dir . "\\";
			$dest_path = $dir . $upload_dir . "\\" . $image_file_name;
		}
		if (move_uploaded_file($tmp_name, $dest_path)) {
			return ($image_file_name);
		} else {
			return "";
		}
	}

	function getRoleNameById($id = 0){
		if ($id == 1) return 'admin';
		if ($id == 2) return 'staff';
		if ($id == 3) return 'student';
        return '';
	}

	
	function resizeImage($src, $tar, $width, $height) {
	    $image = new SimpleImage();
	    $image->load($src);
	    $image->resize($width, $height);
	    $image->save($tar);
	    return $tar; 
	}	

	function getFullDir($dir_name){
		$os = strtoupper (PHP_OS);
		$dir = $_SERVER['SCRIPT_FILENAME'];
		$dir = str_replace('index.php', '', $dir);
		$dest_path = '';
		if ($os == 'LINUX') {
			$dest_path = $dir . $dir_name . '/';
		} else {
			$dest_path = $dir . $dir_name . "\\";
		}
		return ($dest_path);
	}

	function deleteUploadedImage($file, $dir){
		$path = $this->getFullDir($dir);
		$file = $path . $file;
		if (file_exists ($file)){
			unlink($file);
		}
	}


	function getCategoryIdByMD5($categoryId){
		$sql = "select id from category where md5(id)='" . $categoryId . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$id = 0;
		if ($rows) {
			$id = $rows[0]['id'];
		}
		 return ($id);
	}

	function getSubCategoryIdByMD5($subCategoryId){
		$sql = "select id from sub_category where md5(id)='" . $subCategoryId . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$id = 0;
		if ($rows) {
			$id = $rows[0]['id'];
		}
		 return ($id);
	}

	public function getMartialStatusListForDropdown($value=''){
		$data_r['single'] = 'Single';
		$data_r['married'] = 'Married';
		$data_r['others'] = 'others';
		return ($data_r);
	}


	public function getGenderListForDropdown($value=''){
		$data_r['male'] = 'Male';
		$data_r['female'] = 'Female';
		$data_r['others'] = 'others';
		return ($data_r);
	}

	public function getSemesterListForDropdown($value=''){
		$data_r['semester'] = 'Semester';
		$data_r['nonsemester'] = 'Non semester';
		return ($data_r);
	}

	public function getGraduateListForDropdown($value=''){
		$data_r['UG'] = 'UG';
		$data_r['PG'] = 'PG';
		$data_r['PGD'] = 'PG Diploma';
		$data_r['Diploma'] = 'Diploma';
		$data_r['Certificate Course'] = 'Certificate Course';
		return ($data_r);
	}

	public function getUniversityListForDropdown($value=''){
		$data_r['alagappa'] = 'Alagappa university';
		$data_r['pondicherry'] = 'Pondicherry university';
		$data_r['madras'] = 'Madras university';
		$data_r['anna'] = 'Anna university';
		$data_r['tnou'] = 'Tamilnadu open university';
		$data_r['others'] = 'others';
		return ($data_r);
	}

	public function getMediumListForDropdown($value=''){
		$data_r['tamil'] = 'Tamil';
		$data_r['english'] = 'English';
		$data_r['others'] = 'others';
		return ($data_r);
	}


	function getUserIdByEmail($email){
		$sql = "select id from users where email_id='" . $email . "'";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$id = 0;
		if ($rows) {
			$id = $rows[0]['id'];
		}
		 return ($id);
	}


	function getUUID(){
		$sql = "select uuid() as id";
		$query = $this->db->query($sql);
		$rows = $query->result_array();
		$id = sha1('sanjay');
		if ($rows) {
			$id = sha1($rows[0]['id']);
		}
		 return ($id);
	}
}

?>