<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This is login authentication
 *
 * @package	CodeIgniter
 * @category	Controller
 * @author		Swamykannan.M
 * @link		
 *
 */


class Master extends CI_Controller {
		
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/Master_model');
			$this->load->library('form_validation');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
	}	

	public function dashboard()
	{
	        $data = array(
			'ErrorMessages' 				 			=> '',
			'ErrorMessage' 				 				=> '',
			'SiteTitle' 				 				=> $this->SiteMainTitle.'- Add User',
			'SiteMainTitle' 				 			=> $this->SiteMainTitle
			//'user_details' 				 				=> $user_details
		);			
	        $this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
	}
	
	public function index()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		//$user_details = $this->User_model->getUserData();	
		//echo '<pre>';print_r($user_details);die;
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel User',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				//'user_data'						=> $user_details
				//'post_set'						=> $post_set
		);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/user/list',$data);
		$this->load->view('admin/footer');
	}

	public function programs($type=null, $id=null)
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('program_name', 'Program name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('program_description', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('duration_year', 'Duration Year', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('duration_month', 'Duration Month', 'trim|required|max_length[1]');	
				$this->form_validation->set_rules('grace_period_year', 'Grace Period Year', 'trim|required|max_length[1]');				
				$this->form_validation->set_rules('grace_period_month', 'Grace Period Year', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('fasttrack_duration', 'Fast track duration', 'trim|required|max_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$set_program_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('program_name') )),
							'program_desc' 		 	 				=> addslashes(trim( $this->input->post('program_description') )),
							'duration_year' 		 	 			=> addslashes(trim( $this->input->post('duration_year') )),
							'duration_month' 		 	 			=> addslashes(trim( $this->input->post('duration_month') )),
							'grace_period_year' 		 	 		=> addslashes(trim( $this->input->post('grace_period_year') )),
							'grace_period_month' 		 	 		=> addslashes(trim( $this->input->post('grace_period_month') )),
							'fast_track_duration' 		 	 		=> addslashes(trim( $this->input->post('fasttrack_duration') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->save('programs',$set_program_data);
					if( isset($check) && !empty($check)){
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'vaasthu/admin/master/programs'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/programs'); 
					}
				}
			}
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/program_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				
				$this->form_validation->set_rules('program_name', 'Program name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('program_description', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('duration_year', 'Duration Year', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('duration_month', 'Duration Month', 'trim|required|max_length[1]');	
				$this->form_validation->set_rules('grace_period_year', 'Grace Period Year', 'trim|required|max_length[1]');				
				$this->form_validation->set_rules('grace_period_month', 'Grace Period Year', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('fasttrack_duration', 'Fast track duration', 'trim|required|max_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$set_program_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('program_name') )),
							'program_desc' 		 	 				=> addslashes(trim( $this->input->post('program_description') )),
							'duration_year' 		 	 			=> addslashes(trim( $this->input->post('duration_year') )),
							'duration_month' 		 	 			=> addslashes(trim( $this->input->post('duration_month') )),
							'grace_period_year' 		 	 		=> addslashes(trim( $this->input->post('grace_period_year') )),
							'grace_period_month' 		 	 		=> addslashes(trim( $this->input->post('grace_period_month') )),
							'fast_track_duration' 		 	 		=> addslashes(trim( $this->input->post('fasttrack_duration') )),
							'status'								=> 1,							
							'updated_by'							=> 'Super Admin',							
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'programs', 'program_id',$set_program_data,$id );
					if($check){
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'vaasthu/admin/master/programs'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/programs'); 
					}
				}
			}
			$selectedValues = $this->Master_model->getSelected('programs','program_id', $id);
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/program_edit',$data);
			$this->load->view('admin/footer');
			
		}
		if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Master_model->getSelected('programs','program_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,					
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/program_view',$data);
			$this->load->view('admin/footer');
		}
		if( !isset($type) && empty($type)){
			$programList = $this->Master_model->getList('programs');	
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programList'					=> $programList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/program_list',$data);
			$this->load->view('admin/footer');
		}
	}

	public function courses($type=null, $id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$this->form_validation->set_rules('program_id', 'Program name', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('course_code', 'Course Code', 'trim|required|min_length[2]|max_length[20]');
				$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('course_description', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('regulation_id', 'Regulation', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('exam_duration_hours', 'Exam Duration Hours', 'trim|required|max_length[2]');
				$this->form_validation->set_rules('exam_duration_mins', 'Exam Duration Mins', 'trim|required|max_length[2]');	
				$this->form_validation->set_rules('exam_attempt_limit', 'Exam Attempt Limit', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('partition[]', 'Partition', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('question_type[]', 'Question type', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('no_of_question[]', 'No of Question', 'trim|required');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$set_course_data = array(						
							'program_id' 		 	 			=> addslashes(trim( $this->input->post('program_id') )),
							'course_code' 		 	 			=> addslashes(trim( $this->input->post('course_code') )),
							'name' 		 	 					=> addslashes(trim( $this->input->post('course_name') )),
							'description' 		 	 			=> addslashes(trim( $this->input->post('course_description') )),
							'regulation_id' 		 	 		=> addslashes(trim( $this->input->post('regulation_id') )),
							'exam_duration_hour' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_hours') )),
							'exam_duration_minute' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_mins') )),
							'exam_attempt_limit' 		 	 	=> addslashes(trim( $this->input->post('exam_attempt_limit') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($set_course_data);die;
					$check = $this->Master_model->save('courses',$set_course_data);
					if( isset($check) && !empty($check)){
						$regulation_id = trim($this->input->post('regulation_id'));
						if( isset($regulation_id) && !empty( $regulation_id ) && $regulation_id ==1){
							
							
							$pcnt = count($_POST['partition']);
							$qtcnt = count($_POST['question_type']);
							$qcnt = count($_POST['no_of_question']);
							for($i=0;$i<$pcnt;$i++){
								$courseExamData[] = array(
									'course_id' => $check,
									'questiontype_id' => $_POST['question_type'][$i],
									'partition_id' => $_POST['partition'][$i],
									'no_of_questions' => $_POST['no_of_question'][$i]
								);
							}
		
		
							$another_check = $this->Master_model->Another_save('course_exam',$check, $courseExamData);
						}
						//if( isset($another_check) && !empty($another_check)){
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'vaasthu/admin/master/courses'); 
						//}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/courses'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs');
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programList'					=> $programList,
					'questionType'					=> $questionType,
					'regulationList'				=> $regulationList,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/course_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('program_id', 'Program name', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('course_code', 'Course Code', 'trim|required|min_length[2]|max_length[20]');
				$this->form_validation->set_rules('course_name', 'Course Name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('course_description', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('regulation_id', 'Regulation', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('exam_duration_hours', 'Exam Duration Hours', 'trim|required|max_length[2]');
				$this->form_validation->set_rules('exam_duration_mins', 'Exam Duration Mins', 'trim|required|max_length[2]');	
				$this->form_validation->set_rules('exam_attempt_limit', 'Exam Attempt Limit', 'trim|required|max_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$set_course_data = array(						
							'program_id' 		 	 			=> addslashes(trim( $this->input->post('program_id') )),
							'course_code' 		 	 			=> addslashes(trim( $this->input->post('course_code') )),
							'name' 		 	 					=> addslashes(trim( $this->input->post('course_name') )),
							'description' 		 	 			=> addslashes(trim( $this->input->post('course_description') )),
							'regulation_id' 		 	 		=> addslashes(trim( $this->input->post('regulation_id') )),
							'exam_duration_hour' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_hours') )),
							'exam_duration_minute' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_mins') )),
							'exam_attempt_limit' 		 	 	=> addslashes(trim( $this->input->post('exam_attempt_limit') )),
							'status'								=> 1,							
							'updated_by'							=> 'Super Admin',							
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'courses', 'course_id',$set_course_data,$id );
					if($check){
						
						$pcnt = count($_POST['partition']);
						$qtcnt = count($_POST['question_type']);
						$qcnt = count($_POST['no_of_question']);
						for($i=0;$i<$pcnt;$i++){
							$courseExamData[] = array(
								'course_id' => $id,
								'questiontype_id' => $_POST['question_type'][$i],
								'partition_id' => $_POST['partition'][$i],
								'no_of_questions' => $_POST['no_of_question'][$i]
							);
						}
			
			
						$another_check = $this->Master_model->Another_update('course_exam','course_id',$check, $courseExamData);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'vaasthu/admin/master/courses'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/courses'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs');
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$selectedValues = $this->Master_model->getSelected('courses','course_id', $id);
			$secondselectedValues = $this->Master_model->getSelected_List('course_exam','course_id', $id);
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'secondselectedValues'			=> $secondselectedValues,
					'questionType'					=> $questionType,
					'programList'					=> $programList,
					'regulationList'				=> $regulationList,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/course_edit',$data);
			$this->load->view('admin/footer');
			
		}if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Master_model->getJointSelected('courses','programs','course_id','program_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'regulationList'				=> $regulationList,
				'selectedValues'				=> $selectedValues,					
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/course_view',$data);
			$this->load->view('admin/footer');
		}if( !isset($type) && empty($type)){
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$courseList = $this->Master_model->getList('courses');	
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'regulationList'				=> $regulationList,
					'courseList'					=> $courseList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/course_list',$data);
			$this->load->view('admin/footer');
		}
		
	}	
	
	
	public function fees($type=null, $id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$this->form_validation->set_rules('program_id', 'Program name', 'trim|required|min_length[1]');
				
				$program_id = $this->input->post('program_id');
				if( isset($program_id) && !empty($program_id)){
					//$this->form_validation->set_rules('course[]', 'Course', 'trim|required');
					$this->form_validation->set_rules('amount[]', 'Amount', 'trim|required');
				}
				
				$this->form_validation->set_rules('register_fee', 'Registration Fee', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('graduate_fee', 'Graduation Fee', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('penalty_fee', 'Penality', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('other_fee', 'Other Fee', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{ 
					
					$Course = $_POST['course']; $CourseData = array();
					foreach($Course as $k => $tt){
						$CourseData[] = implode(' & ',$tt);
					}
					$totalFee = array_sum($_POST['amount']) + $this->input->post('register_fee') + $this->input->post('graduate_fee') + $this->input->post('penalty_fee') + $this->input->post('other_fee');
					
					$set_fees_data = array(						
							'program_id' 		 	 				=> addslashes(trim( $this->input->post('program_id') )),
							'registration_fee' 		 	 			=> addslashes(trim( $this->input->post('register_fee') )),
							'graduation_fee' 		 	 			=> addslashes(trim( $this->input->post('graduate_fee') )),
							'penalty_fee' 		 	 				=> addslashes(trim( $this->input->post('penalty_fee') )),
							'Other_fee' 		 	 				=> addslashes(trim( $this->input->post('other_fee') )),
							'Total_fee'								=> $totalFee,
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
				
					$check = $this->Master_model->save('program_fees',$set_fees_data);
					if( isset($check) && !empty($check)){
						
						$courseExamData = array();
						if( isset($CourseData) && !empty($CourseData) && count($CourseData) >0 )
						{
							$pcnt = count($CourseData);
							$qtcnt = count($_POST['amount']);
							for($i=0;$i<$pcnt;$i++){
								$courseExamData[] = array(
									'program_fees_id' 	=> addslashes(trim($check)),
									'course_code' 		=> addslashes(ltrim( trim($CourseData[$i]),' & ')),
									'amount' 			=> addslashes(trim($_POST['amount'][$i])),
								);
							}
							
							$another_check = $this->Master_model->Another_save('program_course_fees',$check, $courseExamData);
						}
		
		
						
						if( isset($another_check) && !empty($another_check)){
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'vaasthu/admin/master/fees'); 
						}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/fees'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs');
			$selectedCourse = $this->Master_model->getSelected_List('courses','program_id',$this->input->post('program_id'));
			//echo '<pre>';print_r($selectedCourse);
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program fees',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programList'					=> $programList,
					'selectedCourse'				=> $selectedCourse,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/fee_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('program_id', 'Program name', 'trim|required|min_length[1]');
				
				$program_id = $this->input->post('program_id');
				if( isset($program_id) && !empty($program_id)){
					//$this->form_validation->set_rules('course[]', 'Course', 'trim|required');
					$this->form_validation->set_rules('amount[]', 'Amount', 'trim|required');
				}
				
				$this->form_validation->set_rules('register_fee', 'Registration Fee', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('graduate_fee', 'Graduation Fee', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('penalty_fee', 'Penality', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('other_fee', 'Other Fee', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$Course = $_POST['course']; $CourseData = array();
					foreach($Course as $k => $tt){
						$CourseData[] = implode(' & ',$tt);
					}
					$totalFee = array_sum($_POST['amount']) + $this->input->post('register_fee') + $this->input->post('graduate_fee') + $this->input->post('penalty_fee') + $this->input->post('other_fee');
					
					$set_fees_data = array(						
							'program_id' 		 	 				=> addslashes(trim( $this->input->post('program_id') )),
							'registration_fee' 		 	 			=> addslashes(trim( $this->input->post('register_fee') )),
							'graduation_fee' 		 	 			=> addslashes(trim( $this->input->post('graduate_fee') )),
							'penalty_fee' 		 	 				=> addslashes(trim( $this->input->post('penalty_fee') )),
							'Other_fee' 		 	 				=> addslashes(trim( $this->input->post('other_fee') )),
							'Total_fee'								=> $totalFee,
							//'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'program_fees', 'program_fees_id',$set_fees_data,$id );
					if($check){
						
						$courseExamData = array();
						if( isset($CourseData) && !empty($CourseData) && count($CourseData) >0 )
						{
							$pcnt = count($CourseData);
							$qtcnt = count($_POST['amount']);
							for($i=0;$i<$pcnt;$i++){
								$courseExamData[] = array(
									'program_fees_id' 	=> addslashes(trim($check)),
									'course_code' 		=> addslashes(ltrim( trim($CourseData[$i]),' & ')),
									'amount' 			=> addslashes(trim($_POST['amount'][$i])),
								);
							}
							
							$another_check = $this->Master_model->Another_update('program_course_fees','program_fees_id',$check, $courseExamData);
						}
						
						//$another_check = $this->Master_model->Another_update('program_course_fees','program_fees_id',$check, $courseExamData);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'vaasthu/admin/master/fees'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/master/fees'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs');
			$program_id = $this->input->post('program_id');
			$selectedValues = $this->Master_model->getSelected('program_fees','program_fees_id', $id);
			
			if(!empty($selectedValues->program_id)){
				$selectedCourse = $this->Master_model->getSelected_List('courses','program_id',$selectedValues->program_id);
			}
			$selectedValues = $this->Master_model->getSelected('program_fees','program_fees_id', $id);
			$selectedPgmCourseFeesValues = $this->Master_model->getSelected_List('program_course_fees','program_fees_id', $id);
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program fees',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedPgmCourseFeesValues'	=> $selectedPgmCourseFeesValues,
					'selectedValues'				=> $selectedValues,					
					'programList'					=> $programList,
					'selectedCourse'				=> $selectedCourse,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/fee_edit',$data);
			$this->load->view('admin/footer');
			
		}if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues 			= $this->Master_model->getJointSelected('program_fees','programs','program_fees_id','program_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$selectedProgramFeesValues 	= $this->Master_model->getSelected_List('program_course_fees','program_fees_id', $id);
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program fees',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,		
				'selectedProgramFeesValues'		=> $selectedProgramFeesValues,
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/fee_view',$data);
			$this->load->view('admin/footer');
		}if( !isset($type) && empty($type)){
			
			$feesList = $this->Master_model->getList('program_fees');
			$programs = $this->Master_model->getList('programs');
			$pgmList = array();
			if( isset($programs) && !empty($programs)){
				foreach($programs as $pgm)
				{
					$pgmList[$pgm->program_id] = stripslashes($pgm->name);
				}
			}
			//echo '<pre>';print_r($pgmList);die;			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program fees',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'feesList'						=> $feesList,
					'pgmList'						=> $pgmList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/fee_list',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function ajaxPgm()
	{
		if( isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_POST['field_val']) && !empty($_POST['field_val']) ){
			$table = trim($_POST['type']);
			$field_id = trim($_POST['field_id']);
			$field_val = trim($_POST['field_val']);
			$getRes = $this->Master_model->getSelected_List($table,$field_id,$field_val);
			echo json_encode($getRes);
		}
	}
	
	public function status( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'programs'){
				$table = 'programs';$key_field = 'program_id';$status_field = 'status';
			}
			if( $process == 'courses'){
				$table = 'courses';$key_field = 'course_id';$status_field = 'status';
			}
			if( $process == 'fees'){
				$table = 'program_fees';$key_field = 'program_fees_id';$status_field = 'status';
			}
			$getRes = $this->Master_model->changeStatus($table, $key_field, $status_field, $arg);
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
				redirect(base_url().'vaasthu/admin/master/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'vaasthu/admin/master/'.$process); 
			}
		}
	}
	
	public function remove( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'programs'){
				$table = 'programs';$key_field = 'program_id';
			}
			if( $process == 'courses'){
				$table = 'courses';$key_field = 'course_id';
			}
			if( $process == 'fees'){
				$table = 'program_fees';$key_field = 'program_fees_id';
			}
			$getRes = $this->Master_model->remove($table, $key_field,$arg);
			if( $process == 'courses'){
				$getRes1 = $this->Master_model->remove('course_exam', 'course_id',$arg);
			}
			if( $process == 'fees'){
				$getRes1 = $this->Master_model->remove('program_course_fees', 'program_fees_id',$arg);
			}
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully deleted');
				redirect(base_url().'vaasthu/admin/master/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'vaasthu/admin/master/'.$process); 
			}
		}
	}
	
	
}

