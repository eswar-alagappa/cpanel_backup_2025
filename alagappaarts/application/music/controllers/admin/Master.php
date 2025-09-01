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
			$this->skey 	= 'Alagappaarts2017';
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
	       if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
	      
		$this->load->model('admin/Student_model');
		$userCnt = $this->Student_model->getUserCnt();
		
		$this->load->model('admin/Center_model');
		$centerCnt = $this->Center_model->getCenterCnt();
		
		$feedbackCnt = $this->Master_model->getfeedbackCnt();
		
		$assignedExam = $this->Master_model->checkAssignedExam();
		
		$data = array(
			'ErrorMessages' 				 			=> '',
			'ErrorMessage' 				 				=> '',
			'SiteTitle' 				 				=> $this->SiteMainTitle.'- Dashboard',
			'SiteMainTitle' 				 			=> $this->SiteMainTitle,
			'userCnt' 				 					=> $userCnt,
			'centerCnt'									=> $centerCnt,
			'feedbackCnt'								=> $feedbackCnt,
			'assignedExam'								=> $assignedExam,
		);			
	    
		$this->load->view('admin/header',$data);		
		$this->load->view('admin/sidebar');
		$this->load->view('admin/master/dashboard',$data);
		$this->load->view('admin/footer');
	}
	
	public function settings( $type=null, $id=null)
	{
            
//           echo  $this->encode('SANJAY21@st');
//           exit();
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		$post_set = $_POST;
		
		$selectedValues = $this->Master_model->getSelected('settings','settings_id', $this->session->userdata('admin_user_id') );
		
		
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$email = $this->input->post('email');
				$username = $this->input->post('username');
				$global_password = $this->input->post('global_password');
				$password = $this->input->post('password');
				
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[16]');
				
				if( isset($password) && !empty($password)){
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[16]');
				}if( isset($global_password) && !empty($global_password)){
					$this->form_validation->set_rules('global_password', 'Global Password', 'trim|required|min_length[8]|max_length[25]');
				}
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$update_settings_data = array(
						'email'			=> ((isset($email) && !empty($email)) ? addslashes(trim( $this->input->post('email') )) : $selectedValues->email ),
						'username'			=> ((isset($username) && !empty($username)) ? addslashes(trim( $this->input->post('username') )) : $selectedValues->username ),
						'password'			=> ((isset($password) && !empty($password)) ? $this->encode(addslashes(trim( $this->input->post('password') ))) : $selectedValues->password ),
						'global_password'	=> ((isset($global_password) && !empty($global_password)) ? $this->encode(addslashes(trim( $this->input->post('global_password') ))) : $selectedValues->global_password ),
						'modified_by'		=> $this->session->userdata('admin_user_id'),
						'modified_at'		=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'settings', 'settings_id',$update_settings_data,$this->session->userdata('admin_user_id') );
					if( isset($check) && !empty($check))
					{
						$AfterselectedValues = $this->Master_model->getSelected('settings','settings_id', $this->session->userdata('admin_user_id') );
						$user_data = array(
							'email' => addslashes(trim( $AfterselectedValues->email )),
							'name'	=> addslashes(trim( $AfterselectedValues->fullname )),
						);
			$content = '
				<table>
					<tr>
						<td>Username : </td><td>'.$AfterselectedValues->username.'</td>
					</tr><tr>
						<td>Password : </td><td>'.$this->decode($AfterselectedValues->password).'</td>
					</tr><tr>
						<td>Global Password : </td><td>'.$this->decode($AfterselectedValues->global_password).'</td>
					</tr>
				</table>
			';
			$this->common_mail($user_data,$content,'APAA music Super Admin Change Password',false);
						
						redirect(base_url().'music/admin/login/signout'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/settings'); 
					}
				}
		}
		
		
		$data = array(
			'ErrorMessages'					=> $this->ErrorMessages,
			'ErrorMessage'					=> '',
			'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
			'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Settings',
			'SiteMainTitle' 				=> $this->SiteMainTitle,
			'selectedValues'				=> $selectedValues,
			'post_set'						=> $post_set,
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings',$data);
			$this->load->view('admin/footer');
		
	}
	
	public function common_mail($user_data,$content,$subject,$cc)
	{
		
			$data = array(
				'name'		=> $user_data['name'],
				'content' 	=> $content
			);

			$this->load->helper(array('email'));
			$this->load->library(array('email'));
			$this->email->set_mailtype("html");
			//$data['sender_mail'] = 'thenmozhi@sanjaytechnologies.org';
			//$mail = 'sk@sanjaytechnologies.net';
			$this->load->library('email');
			$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
			$this->email->initialize($config);
			$this->email->from( $user_data['email'], $user_data['name'] ); //CUSTOMER_EMAIL
			$this->email->to($user_data['email'] );
			if( isset($cc) && !empty($cc) && $cc==true){
				$this->email->cc(CUSTOMER_EMAIL);
			}
			$this->email->bcc('rajeshnakshatra18@gmail.com');
			//$this->email->bcc();
			$this->email->subject($subject);

			$message=$this->load->view('admin/password_change_common_mail',$data,TRUE);
			//echo $message;die;
			$this->email->message($message);
			$resultMail = $this->email->send();
			return ((isset($resultMail) && !empty($resultMail) && $resultMail==1) ? true : false);
		
	}
	
	public  function encode($value){ 
		
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
	
	 public function decode($value){
		
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
	
	public  function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
	public function index()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
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
			redirect(base_url().'music/admin/login/', 'refresh');
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
						redirect(base_url().'music/admin/master/programs'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/programs'); 
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
						redirect(base_url().'music/admin/master/programs'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/programs'); 
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
			$programList = $this->Master_model->getList('programs','program_id');	
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
			redirect(base_url().'music/admin/login/', 'refresh');
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
				$this->form_validation->set_rules('course_type', 'Course Type', 'trim|required|min_length[1]');
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
							'type'								=> addslashes(trim( $this->input->post('course_type') )),
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
						/*if( isset($regulation_id) && !empty( $regulation_id ) && $regulation_id ==1){
							
							
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
						}*/
						//if( isset($another_check) && !empty($another_check)){
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'music/admin/master/courses'); 
						//}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/courses'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs','program_id');
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$course_type = array('1'=>'Instrumental Music','2'=>'Vocal Music');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programList'					=> $programList,
					'questionType'					=> $questionType,
					'regulationList'				=> $regulationList,
					'course_type'					=> $course_type,
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
				$this->form_validation->set_rules('course_type', 'Course Type', 'trim|required|min_length[1]');
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
							'type'								=> addslashes(trim( $this->input->post('course_type') )),
							'exam_duration_hour' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_hours') )),
							'exam_duration_minute' 		 	 	=> addslashes(trim( $this->input->post('exam_duration_mins') )),
							'exam_attempt_limit' 		 	 	=> addslashes(trim( $this->input->post('exam_attempt_limit') )),
							'status'								=> 1,							
							'updated_by'							=> 'Super Admin',							
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'courses', 'course_id',$set_course_data,$id );
					if($check){
						
						/*$pcnt = count($_POST['partition']);
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
			
			
						$another_check = $this->Master_model->Another_update('course_exam','course_id',$check, $courseExamData);*/
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'music/admin/master/courses'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/courses'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs','program_id');
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			$selectedValues = $this->Master_model->getSelected('courses','course_id', $id);
			$secondselectedValues = $this->Master_model->getSelected_List('course_exam','course_id', $id);
			$questionType = array('1'=>'Multiple Choice','2'=>'Match the following','3'=>'Subjective 5 Marks','4'=>'Subjective 4 Marks',
								'5'=>'Fill in the blanks','6'=>'Subjective 6 Marks','7'=>'Subjective 8 Marks');
			$course_type = array('1'=>'Instrumental Music','2'=>'Vocal Music');
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
					'course_type'					=> $course_type,
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
			$courseList = $this->Master_model->getList('courses','course_id');	
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
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$this->form_validation->set_rules('program_id', 'Program name', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('course_type', 'Course Type', 'trim|required|min_length[1]');
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
							'type' 		 	 						=> addslashes(trim( $this->input->post('course_type') )),
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
							redirect(base_url().'music/admin/master/fees'); 
						}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/fees'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs','program_id');
			$selectedCourse = $this->Master_model->getSelected_List('courses','program_id',$this->input->post('program_id'));
			$course_type = array('1'=>'Instrumental Music','2'=>'Vocal Music');
			//echo '<pre>';print_r($selectedCourse);
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Program fees',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programList'					=> $programList,
					'selectedCourse'				=> $selectedCourse,
					'course_type'					=> $course_type,
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
				$this->form_validation->set_rules('course_type', 'Course Type', 'trim|required|min_length[1]');
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
							'type' 		 	 						=> addslashes(trim( $this->input->post('course_type') )),
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
						redirect(base_url().'music/admin/master/fees'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/fees'); 
					}
				}
			}
			
			$programList = $this->Master_model->getList('programs','program_id');
			$program_id = $this->input->post('program_id');
			$selectedValues = $this->Master_model->getSelected('program_fees','program_fees_id', $id);
			
			if(!empty($selectedValues->program_id)){
				$selectedCourse = $this->Master_model->getSelected_List('courses','program_id',$selectedValues->program_id);
			}
			$selectedValues = $this->Master_model->getSelected('program_fees','program_fees_id', $id);
			$selectedPgmCourseFeesValues = $this->Master_model->getSelected_List('program_course_fees','program_fees_id', $id);
			$course_type = array('1'=>'Instrumental Music','2'=>'Vocal Music');
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
					'course_type'					=> $course_type,
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
			
			$feesList = $this->Master_model->getList('program_fees','program_fees_id');
			$programs = $this->Master_model->getList('programs','program_id');
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
		if( isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_POST['field_val']) && !empty($_POST['field_val']) && isset($_POST['course_type']) && !empty($_POST['course_type']) ){
			$table = trim($_POST['type']);
			$course_type = trim($_POST['course_type']);
			$field_id = trim($_POST['field_id']);
			$field_val = trim($_POST['field_val']);
			$getRes = $this->Master_model->getSelected_List_withcondition($table,$field_id,$field_val,'type',$course_type);
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
				redirect(base_url().'music/admin/master/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'music/admin/master/'.$process); 
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
				redirect(base_url().'music/admin/master/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'music/admin/master/'.$process); 
			}
		}
	}
	
	
}

