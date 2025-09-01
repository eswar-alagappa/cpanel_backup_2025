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


class Exams extends CI_Controller {
		
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/Exams_model');
			$this->load->library('form_validation');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
	}	

	
	public function index()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'dance/admin/login/', 'refresh');
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

	

	public function questiontypes($type=null, $id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'dance/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$this->form_validation->set_rules('qt_name', 'Program name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('qt_description', 'Course Code', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('mark_per_question', 'Course Name', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('controller_type', 'Description', 'trim|required|min_length[1]');
				
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$set_questiontype_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('qt_name') )),
							'description' 		 	 				=> addslashes(trim( $this->input->post('qt_description') )),
							'mark_per_question' 		 	 		=> addslashes(trim( $this->input->post('mark_per_question') )),
							'controller_id' 		 	 			=> addslashes(trim( $this->input->post('controller_type') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($set_course_data);die;
					$check = $this->Exams_model->save('questiontype',$set_questiontype_data);
					if( isset($check) && !empty($check)){
						//$another_check = $this->Master_model->Another_save('course_exam',$check, $_POST);
						//if( isset($another_check) && !empty($another_check)){
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'dance/admin/exams/questiontypes'); 
						//}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/exams/questiontypes'); 
					}
				}
			}
			
			
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,					
					'questionType'					=> $questionType,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/questiontype_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('qt_name', 'Program name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('qt_description', 'Course Code', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('mark_per_question', 'Course Name', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('controller_type', 'Description', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$set_questiontype_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('qt_name') )),
							'description' 		 	 				=> addslashes(trim( $this->input->post('qt_description') )),
							'mark_per_question' 		 	 		=> addslashes(trim( $this->input->post('mark_per_question') )),
							'controller_id' 		 	 			=> addslashes(trim( $this->input->post('controller_type') )),
							'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Exams_model->update( 'questiontype', 'questiontype_id',$set_questiontype_data,$id );
					if($check){
						//$another_check = $this->Exams_model->Another_update('course_exam','course_id',$check, $_POST);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'dance/admin/exams/questiontypes'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/exams/questiontypes'); 
					}
				}
			}
			
			
			$selectedValues = $this->Exams_model->getSelected('questiontype','questiontype_id', $id);			
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,					
					'questionType'					=> $questionType,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/questiontype_edit',$data);
			$this->load->view('admin/footer');
			
		}
		if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Exams_model->getSelected('questiontype','questiontype_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Question Type',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,					
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/questiontype_view',$data);
			$this->load->view('admin/footer');
		}
		if( !isset($type) && empty($type)){
			
			$questionTypeList = $this->Exams_model->getList('questiontype');	
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'questionTypeList'					=> $questionTypeList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/questiontype_list',$data);
			$this->load->view('admin/footer');
		}
		
	}	
	
	
	public function questions($type=null, $id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'dance/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				//echo '<pre>123->';print_r($_POST);
				$this->form_validation->set_rules('question_type', 'Question Type', 'trim|required');
				$this->form_validation->set_rules('course[]', 'Course Code', 'trim|required');
				$question_type = $this->input->post('question_type');
				if( empty($question_type) || $question_type=='1'){
					$this->form_validation->set_rules('question', 'Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('multiple_choice[0]', 'Multiple Choice', 'trim|required|min_length[1]');
					$this->form_validation->set_rules('multiple_choice_answer[0]', 'Answer', 'trim|required|min_length[1]');
				}
				if($question_type=='2'){
					//$this->form_validation->set_rules('question', 'Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('match_question[]', 'Match the following Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('match_answer[]', 'Match the following Answer', 'trim|required|min_length[3]');
				}
				if($question_type=='3'){
					$this->form_validation->set_rules('sub_question_5', '5 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='4'){
					$this->form_validation->set_rules('sub_question_4', '4 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='5'){
					$this->form_validation->set_rules('fill_in_blank_question', 'Fill in the blank Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('fill_in_blank_answer', 'Fill in the blank Answer', 'trim|required|min_length[1]');
				}
				if($question_type=='6'){
					$this->form_validation->set_rules('sub_question_6', '6 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='7'){
					$this->form_validation->set_rules('sub_question_8', '8 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{ 
				
					
					$getQuestion = (($question_type=='1') ? $this->input->post('question') : 
					(($question_type=='3') ? $this->input->post('sub_question_5') : 
					(($question_type=='4') ? $this->input->post('sub_question_4') :
					(($question_type=='5') ? $this->input->post('fill_in_blank_question') :
					(($question_type=='6') ? $this->input->post('sub_question_6') :
					(($question_type=='7') ? $this->input->post('sub_question_8') : '')))))      );
					
					
					$getAnswer = (($question_type=='1') ? $this->input->post('multiple_choice_answer[0]') : 
					(($question_type=='5') ? $this->input->post('fill_in_blank_answer') : '' ));
					
					if( $question_type != '2'){
						$set_question_data = array(						
								'question_type_id' 		 	 		=> addslashes(trim( $this->input->post('question_type') )),
								'question' 		 	 				=> addslashes(trim( $getQuestion )),
								'answer' 		 	 				=> addslashes(trim( $getAnswer )),							
								'status'							=> 1,
								'created_by'						=> 'Super Admin',
								'updated_by'						=> 'Super Admin',
								'created_at'						=> date('Y-m-d H:i:s'),
								'updated_at'						=> date('Y-m-d H:i:s'),
						);
						$check = $this->Exams_model->save('questions',$set_question_data);
						
						if( isset($_POST['course']) && !empty($_POST['course'] )){
						$pcnt = count($_POST['course']);
								for($i=0;$i<$pcnt;$i++){
									$multiDataInsert1[] = array(
										'question_id' => $check,
										'course_id' => $_POST['course'][$i]
									);
								}
								$this->Exams_model->Another_save('question_course',$check, $multiDataInsert1);
						}
								
						if( $question_type==1){
								
								$pcnt = count($_POST['multiple_choice']);
								for($i=0;$i<$pcnt;$i++){
									$multiDataInsert[] = array(
										'question_id' => $check,
										'choice' => $_POST['multiple_choice'][$i],
										'answerindex' => $i,
									);
								}
		
							$this->Exams_model->Another_save('multiple_choice_answer',$check, $multiDataInsert);
						}
					}else{	
						$check = $this->Exams_model->multi_save_with_loop('questions','question_course',$_POST);
					}
					
					
					//echo '<pre>';print_r($set_course_data);die;
					
					if( isset($check) && !empty($check)){						
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'dance/admin/exams/questions');
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/exams/questions'); 
					}
				}
			}
			
			
			$questionType = $this->Exams_model->getList('questiontype');
			$Courses = $this->Exams_model->getJoinList('courses','programs','program_id');
			$courseRes = array();
			if( isset($Courses) && !empty($Courses))
			{
				foreach($Courses as $crs)
				{
					$courseRes[$crs->name][] = $crs;
				}
			}
			//echo '<pre>';print_r($post_set);
			//die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Question',
					'SiteMainTitle' 				=> $this->SiteMainTitle,					
					'questionType'					=> $questionType,
					'Courses'						=> $courseRes,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/question_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{ 
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('question_type', 'Question Type', 'trim|required');
				$this->form_validation->set_rules('course[]', 'Course Code', 'trim|required');
				$question_type = $this->input->post('question_type');
				if( empty($question_type) || $question_type=='1'){
					$this->form_validation->set_rules('question', 'Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('multiple_choice[0]', 'Multiple Choice', 'trim|required|min_length[1]');
					$this->form_validation->set_rules('multiple_choice_answer[0]', 'Answer', 'trim|required|min_length[1]');
				}
				if($question_type=='2'){
					$this->form_validation->set_rules('match_question[]', 'Match the following Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('match_answer[]', 'Match the following Answer', 'trim|required|min_length[3]');
				}
				if($question_type=='3'){
					$this->form_validation->set_rules('sub_question_5', '5 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='4'){
					$this->form_validation->set_rules('sub_question_4', '4 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='5'){
					$this->form_validation->set_rules('fill_in_blank_question', 'Fill in the blank Question', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('fill_in_blank_answer', 'Fill in the blank Answer', 'trim|required|min_length[1]');
				}
				if($question_type=='6'){
					$this->form_validation->set_rules('sub_question_6', '6 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				if($question_type=='7'){
					$this->form_validation->set_rules('sub_question_8', '8 Mark Subjective Question', 'trim|required|min_length[3]');
				}
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					
					$getQuestion = (($question_type=='1') ? $this->input->post('question') : 
					(($question_type=='3') ? $this->input->post('sub_question_5') : 
					(($question_type=='4') ? $this->input->post('sub_question_4') :
					(($question_type=='5') ? $this->input->post('fill_in_blank_question') :
					(($question_type=='6') ? $this->input->post('sub_question_6') :
					(($question_type=='7') ? $this->input->post('sub_question_8') : '')))))      );
					
					
					$getAnswer = (($question_type=='1') ? $this->input->post('multiple_choice_answer[0]') : 
					(($question_type=='5') ? $this->input->post('fill_in_blank_answer') : '' ));
					
					if( $question_type != '2'){
						$set_question_data = array(						
								'question_type_id' 		 	 		=> addslashes(trim( $this->input->post('question_type') )),
								'question' 		 	 				=> addslashes(trim( $getQuestion )),
								'answer' 		 	 				=> addslashes(trim( $getAnswer )),							
								'status'							=> 1,
								'created_by'						=> 'Super Admin',
								'updated_by'						=> 'Super Admin',
								'created_at'						=> date('Y-m-d H:i:s'),
								'updated_at'						=> date('Y-m-d H:i:s'),
						);
						$check = $this->Exams_model->update('questions','question_id',$set_question_data,$id);
						
						if( isset($_POST['course']) && !empty($_POST['course'] )){
						$pcnt = count($_POST['course']);
								for($i=0;$i<$pcnt;$i++){
									$multiDataInsert1[] = array(
										'question_id' => $check,
										'course_id' => $_POST['course'][$i]
									);
								}
								$this->Exams_model->Another_update('question_course','question_id',$id, $multiDataInsert1);
						}
								
						if( $question_type==1){
								
								$pcnt = count($_POST['multiple_choice']);
								for($i=0;$i<$pcnt;$i++){
									$multiDataInsert[] = array(
										'question_id' => $check,
										'choice' => $_POST['multiple_choice'][$i],
										'answerindex' => $i,
									);
								}
		
							$this->Exams_model->Another_update('multiple_choice_answer','question_id',$id, $multiDataInsert);
						}
					}else{	
						$this->Exams_model->remove('questions','question_id',$id);
						$this->Exams_model->remove('question_course','question_id',$id);
						$check = $this->Exams_model->multi_save_with_loop('questions','question_course',$_POST);
					}
						
					if($check){
						//$another_check = $this->Exams_model->Another_update('course_exam','course_id',$check, $_POST);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'dance/admin/exams/questions'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/exams/questions'); 
					}
				}
			}
			
			
			$selectedValues = $this->Exams_model->getSelected('questions','question_id', $id);	
			$selectedQuestCourseValues = $this->Exams_model->getSelected_List('question_course','question_id', $id);	
			$selectedMultipleChoice = $this->Exams_model->getSelected_List('multiple_choice_answer','question_id', $id);
			$questionType = $this->Exams_model->getList('questiontype');
			$Courses = $this->Exams_model->getJoinList('courses','programs','program_id');
			$courseRes = $selectedCourseQuestion = $selectedMultiChoice = array();
			if( isset($Courses) && !empty($Courses))
			{
				foreach($Courses as $crs)
				{
					$courseRes[$crs->name][] = $crs;
				}
			}
			if( !empty($selectedQuestCourseValues))
			{
				foreach( $selectedQuestCourseValues as $questcourse)
				{ 
					$selectedCourseQuestion[] = $questcourse->course_id;
				}
			}
			if( !empty($selectedMultipleChoice))
			{
				foreach( $selectedMultipleChoice as $multichoice)
				{ 
					$selectedMultiChoice[] = $multichoice->choice;
				}
			}
			//echo '<pre>';print_r($selectedMultiChoice);
			//die;
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,	
					'selectedCourseQuestion'		=> $selectedCourseQuestion,
					'selectedMultiChoice'			=> $selectedMultiChoice,
					'questionType'					=> $questionType,
					'Courses'						=> $courseRes,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/question_edit',$data);
			$this->load->view('admin/footer');
			
		}
		if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Exams_model->getSelected('questions','question_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$questionType = $this->Exams_model->getList('questiontype');
			$qtypeList = array();
			if( isset($questionType) && !empty($questionType))
			{
				foreach($questionType as $qtype)
				{
					$qtypeList[$qtype->questiontype_id] = $qtype->name;
				}
			}
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Questions',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,	
				'qtypeList'						=> $qtypeList
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/question_view',$data);
			$this->load->view('admin/footer');
		}
		if( !isset($type) && empty($type)){
			
			$questionList = $this->Exams_model->getList('questions');
			$questionType = $this->Exams_model->getList('questiontype');			
			$qtypeList = array();
			if( isset($questionType) && !empty($questionType))
			{
				foreach($questionType as $qtype)
				{
					$qtypeList[$qtype->questiontype_id] = $qtype->name;
				}
			}
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Questions',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'questionList'					=> $questionList,
					'qtypeList'						=> $qtypeList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/exams/question_list',$data);
			$this->load->view('admin/footer');
		}
		
	}	
	
	
	public function status( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'questiontypes'){
				$table = 'questiontype';$key_field = 'questiontype_id';$status_field = 'status';
			}
			if( $process == 'questions'){
				$table = 'questions';$key_field = 'question_id';$status_field = 'status';
			}
			$getRes = $this->Exams_model->changeStatus($table, $key_field, $status_field, $arg);
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
				redirect(base_url().'dance/admin/exams/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'dance/admin/exams/'.$process); 
			}
		}
	}
	
	public function remove( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'questiontypes'){
				$table = 'questiontype';$key_field = 'questiontype_id';
			}
			if( $process == 'questions'){
				$table = 'questions';$key_field = 'question_id';
			}
			$getRes = $this->Exams_model->remove($table, $key_field,$arg);
			if( $process == 'questions'){
				$this->Exams_model->remove('question_course', 'question_id',$arg);
				//$this->Settings_model->remove('question_course', 'question_id',$arg);
			}
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully deleted');
				redirect(base_url().'dance/admin/exams/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'dance/admin/exams/'.$process); 
			}
		}
	}
	
		function tidyHTML($buffer) {
		// load our document into a DOM object
		$dom = new DOMDocument();
		// we want nice output
		$dom->preserveWhiteSpace = false;
		$dom->loadHTML($buffer);
		$dom->formatOutput = true;
		return($dom->saveHTML());
	}
	
	
}

