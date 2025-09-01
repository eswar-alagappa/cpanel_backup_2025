<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class settings extends CI_Controller {
	var $arr;
	var $arrTitle;

 	public function __construct(){
	    parent::__construct();
		$this->load->library('encrypt');
	    $this->load->model('common_model');
		if (!isset($_SESSION) ){ 	
			session_start();
		} 
		$this->common_model->isLoggedIn();

		$i = 0;
		$this->arr[$i]= 'PDF_COURSE_OFFERED'; $i++;
		$this->arr[$i]= 'PDF_REGULATION'; $i++;
		$this->arr[$i]= 'PDF_SEMESTER_PROGRAMES'; $i++;
		$this->arr[$i]= 'PDF_NON_SEMESTER_PROGRAMES'; $i++;
		$this->arr[$i]= 'PDF_ELIGIBLITY'; $i++;
		$this->arr[$i]= 'PDF_APPLICATION'; $i++;
		$this->arr[$i]= 'PDF_DIRECTORATE_OF_DISTANCE_EDUCATION'; $i++;
		$this->arr[$i]= 'PDF_MBA_NON_SEMESTER_APPLICATION'; $i++;
		$this->arr[$i]= 'WELCOME'; $i++;
		$this->arr[$i]= 'PDF_ALAGAPPA_CLASS_SCHEDULE'; $i++;
		$this->arr[$i]= 'PDF_PONDICHERRY_SCHEDULE'; $i++;
		$this->arr[$i]= 'PDF_SYLLABUS'; $i++;
		$this->arr[$i]= 'PDF_ADD_ANOTHER_FOR_DUMMY_FOR_EXTRA_PURPOSE'; $i++;
		$this->arr[$i]= 'PDF_FEE_STRUCTURE'; $i++;

		$i = 0;
		$this->arrTitle[$i]= 'Course Offered'; $i++;
		$this->arrTitle[$i]= 'TITLE-Regulation'; $i++;
		$this->arrTitle[$i]= 'Semester Programmes'; $i++;
		$this->arrTitle[$i]= 'Non-semester Programmes'; $i++;
		$this->arrTitle[$i]= 'Eligibility'; $i++;
		$this->arrTitle[$i]= 'TITLE-Application'; $i++;
		$this->arrTitle[$i]= 'a. Directorate of distance education'; $i++;
		$this->arrTitle[$i]= 'b. MBA (Non-semester) Application'; $i++;
		$this->arrTitle[$i]= 'TITLE-Schedule'; $i++;
		$this->arrTitle[$i]= 'Alagappa class schedule'; $i++;
		$this->arrTitle[$i]= 'Pondicherry class schedule'; $i++;
		$this->arrTitle[$i]= 'Syllabus'; $i++;
		$this->arrTitle[$i]= 'Add another for dummy for extra propose.'; $i++;
		$this->arrTitle[$i]= 'Fee structure.'; $i++;
   }

	public function index() {
		$data['welcome'] = 'Greetings!';

		$this->load->view('admin/settings', $data);
	}

	public function pdfUpload() {
		$data['SCREEN_NAME'] = 'pdfupload';
		foreach ($this->arr as $key => $value) {
			$data[$value] = $this->settings_model->getValueByKey($value);
		}
		$data['arr'] = $this->arr;
		$data['arrTitle'] = $this->arrTitle;
		$this->load->view('admin/settings', $data);
	}

	public function save(){
		$SCREEN_NAME  = trim($this->input->post('SCREEN_NAME'));
		if ($SCREEN_NAME == 'pdfupload'){
			$this->savePdfUpload();
			return;
		}
	}

	public function savePdfUpload(){
		$data['message'] = 'Saved successfully.';
		foreach ($this->arr as $key => $value) {
			$$value  = trim($this->input->post($value));
			$file = $this->common_model->getFilesUploadedName($value, 'pdf');
			if ($file != ''){
				$file_saved = $this->common_model->getFilesUploadedSavedName($value, $value, 'pdf', 'doc');
				$this->settings_model->saveValueByKey($value, $file_saved);
				$data[$value] = $file_saved;
			} else {
				$data[$value] = $this->settings_model->getValueByKey($value);
			}
		}
		$data['SCREEN_NAME'] = 'pdfupload';
		$data['arr'] = $this->arr;
		$data['arrTitle'] = $this->arrTitle;
		$this->load->view('admin/settings', $data);
	}
}

/* */
/* */
