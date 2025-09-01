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


class Students extends CI_Controller {
	public $skey 	= 'Alagappa2016';	
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/Student_model');
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
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$listData = $this->Student_model->getList('users');	
		//echo '<pre>';print_r($listData);die;
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'listData'						=> $listData
				//'post_set'						=> $post_set
		);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/students/list',$data);
		$this->load->view('admin/footer');
	}
	
	
	public function uniqueUsername( $str )
	{
		$check = $this->Student_model->checkUsername($str);
		if( !empty($check))
		{	
			$this->form_validation->set_message('uniqueUsername', 'The %s field has unique. please enter another username ');
			return false;				
		}else{
			return true;
		}
	}
	
	public function uniqueUpdateUsername( $str )
	{
		$user_id = $this->uri->segment(4);
		if( isset($user_id) && !empty($user_id))
		{
			$check = $this->Student_model->checkEditUsername($str,$user_id);
			//echo '<pre>';print_r($check);
			if( !empty($check))
			{	
				$this->form_validation->set_message('uniqueUpdateUsername', 'The %s field has unique. please enter another username ');
				return false;				
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	
	
	public function add()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');		
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUsername');
				$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[3]');			
				$this->form_validation->set_rules('age', 'Age', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('program_id[]', 'Program', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('center_id', 'Center', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('exp_bharatanatyam', 'Experience of bharatanatyam', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('name_of_guru', 'Name of guru', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					
					$set_userprofile_data = array(						
							'firstname' 		 	 						=> addslashes(trim( $this->input->post('first_name') )),
							'lastname' 		 	 							=> addslashes(trim( $this->input->post('last_name') )),
							'address' 		 	 							=> addslashes(trim( $this->input->post('address') )),
							'city' 		 	 								=> addslashes(trim( $this->input->post('city') )),
							'state' 		 	 							=> addslashes(trim( $this->input->post('state') )),
							'dob' 		 	 								=> addslashes(trim( $this->input->post('dob') )),
							'country' 		 	 							=> addslashes(trim( $this->input->post('country') )),
							'age' 		 	 								=> addslashes(trim( $this->input->post('age') )),
							'zip' 		 	 								=> addslashes(trim( $this->input->post('zip') )),
							'gender' 		 	 							=> addslashes(trim( $this->input->post('gender') )),
							'phone' 		 	 							=> addslashes(trim( $this->input->post('contact') )),
							'alternate_phone' 		 	 					=> addslashes(trim( $this->input->post('alternate_contact') )),
							//'program_id' 		 	 						=> addslashes(trim( $this->input->post('program_id') )),
							'stream' 		 	 							=> addslashes(trim( $this->input->post('stream') )),
							'center_id' 		 	 						=> addslashes(trim( $this->input->post('center_id') )),
							'bharathanatiyam_experience' 		 	 		=> addslashes(trim( $this->input->post('exp_bharatanatyam') )),
							'special_accomplishment' 		 	 			=> addslashes(trim( $this->input->post('special_accomplished') )),
							'name_of_master' 		 	 					=> addslashes(trim( $this->input->post('name_of_guru') )),
							'master_located_at' 		 	 				=> addslashes(trim( $this->input->post('located_at') )),
							'other_relevant_info' 		 	 				=> addslashes(trim( $this->input->post('other_relevant_info') )),
							'created_by'									=> 'Super Admin',
							'updated_by'									=> 'Super Admin',
							'created_at'									=> date('Y-m-d H:i:s'),
					);
					
					$set_user_data = array(						
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('contact') )),
							'password' 		 	 					=> addslashes(trim( $this->encode($this->randomPassword()) )),	
							'user_role_id'							=> 2,
							'status'								=> 0,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					$check = $this->Student_model->save('users',$set_user_data);
					if( isset($check) && !empty($check)){
						$another_check = $this->Student_model->Another_save('user_profiles',$check,'user_id',$set_userprofile_data);
						
						if( isset( $_POST['program_id'])){
							$user_program_data = array();
							$stream = $_POST['stream'];
							foreach( $_POST['program_id'] as $pgm)
							{
								$user_program_data[] = array(
									'user_id'			=> $check,
									'program_id'		=> $pgm,
									'center_id'			=> addslashes(trim( $this->input->post('center_id') )),
									'is_fasttrack'		=> ((isset($stream) && !empty($stream) && in_array($pgm,$stream)) ? 'Y' : 'N'),
									'enrollment_date'	=> date('Y-m-d H:i:s'),
								);
							}
							$this->Student_model->batchInsert('user_program',$user_program_data);
						}
					
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}
				}
			}
			$programs = $this->Student_model->getListactiveState('programs');
			
			$sreatm = array();
			if( isset($programs) && !empty($programs))
			{
				foreach($programs as $pgm)
				{
					$sreatm[$pgm->program_id]='Fast Track';
				}
			}
			//$sreatm = array('1'=>'Fast Track','2'=>'Fast Track','3'=>'Fast Track','4'=>'Fast Track','5'=>'Fast Track');
			
			$centers = $this->Student_model->getListactiveState('center_academy');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programs'						=> $programs,
					'sreatm'						=> $sreatm,
					'centers'						=> $centers,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/students/add',$data);
			$this->load->view('admin/footer');
		
			
		
	}

	public function update($id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		
		if( isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');		
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUpdateUsername');
				$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[3]');			
				$this->form_validation->set_rules('age', 'Age', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('program_id[]', 'Program', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('center_id', 'Center', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('exp_bharatanatyam', 'Experience of bharatanatyam', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('name_of_guru', 'Name of guru', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{ //echo '<pre>'; print_r($_POST);die;
				
					$set_userprofile_data = array(						
							'firstname' 		 	 						=> addslashes(trim( $this->input->post('first_name') )),
							'lastname' 		 	 							=> addslashes(trim( $this->input->post('last_name') )),
							'address' 		 	 							=> addslashes(trim( $this->input->post('address') )),
							'city' 		 	 								=> addslashes(trim( $this->input->post('city') )),
							'state' 		 	 							=> addslashes(trim( $this->input->post('state') )),
							'dob' 		 	 								=> addslashes(trim( $this->input->post('dob') )),
							'country' 		 	 							=> addslashes(trim( $this->input->post('country') )),
							'age' 		 	 								=> addslashes(trim( $this->input->post('age') )),
							'zip' 		 	 								=> addslashes(trim( $this->input->post('zip') )),
							'gender' 		 	 							=> addslashes(trim( $this->input->post('gender') )),
							'phone' 		 	 							=> addslashes(trim( $this->input->post('contact') )),
							'alternate_phone' 		 	 					=> addslashes(trim( $this->input->post('alternate_contact') )),
							//'program_id' 		 	 						=> addslashes(trim( $this->input->post('program_id') )),
							'stream' 		 	 							=> addslashes(trim( $this->input->post('stream') )),
							'center_id' 		 	 						=> addslashes(trim( $this->input->post('center_id') )),
							'bharathanatiyam_experience' 		 	 		=> addslashes(trim( $this->input->post('exp_bharatanatyam') )),
							'special_accomplishment' 		 	 			=> addslashes(trim( $this->input->post('special_accomplished') )),
							'name_of_master' 		 	 					=> addslashes(trim( $this->input->post('name_of_guru') )),
							'master_located_at' 		 	 				=> addslashes(trim( $this->input->post('located_at') )),
							'other_relevant_info' 		 	 				=> addslashes(trim( $this->input->post('other_relevant_info') )),
							//'created_by'									=> 'Super Admin',
							'updated_by'									=> 'Super Admin',
							'updated_at'									=> date('Y-m-d H:i:s'),
					);
					
					$set_user_data = array(						
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('contact') )),
							//'password' 		 	 				=> addslashes(trim( md5($this->randomPassword()) )),	
							'user_role_id'							=> 2,
							//'status'								=> 0,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'updated_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					$check = $this->Student_model->update( 'users', 'user_id',$set_user_data,$id );
					if($check){
							
						if( isset( $_POST['program_id'])){
							$user_program_data = array();
							$stream = $_POST['stream'];
							foreach( $_POST['program_id'] as $pgm)
							{
								$user_program_data[] = array(
									'user_id'			=> $id,
									'program_id'		=> $pgm,
									'center_id'			=> addslashes(trim( $this->input->post('center_id') )),
									'is_fasttrack'		=> ((isset($stream) && !empty($stream) && in_array($pgm,$stream)) ? 'Y' : 'N'),
									'enrollment_date'	=> date('Y-m-d H:i:s'),
								);
							}
							$this->Student_model->batchUpdate('user_program',$user_program_data,'user_id', $id);
						}
					
						$another_check = $this->Student_model->Another_update('user_profiles','user_id',$id, $set_userprofile_data);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}
				}
			}
			
			$programs = $this->Student_model->getListactiveState('programs');
			//$sreatm = array('Fast Track'=>'Fast Track','Noraml'=>'Noraml');
			//$sreatm = array('1'=>'Fast Track','2'=>'Fast Track','3'=>'Fast Track','4'=>'Fast Track','5'=>'Fast Track');
			$sreatm = array();
			if( isset($programs) && !empty($programs))
			{
				foreach($programs as $pgm)
				{
					$sreatm[$pgm->program_id]='Fast Track';
				}
			}
			$centers = $this->Student_model->getListactiveState('center_academy');
			$selectedValues = $this->Student_model->getSelected('user_id', $id);
			$selectListedValuesArray = $this->Student_model->getSelectedFromUserpgmList('user_program','user_id', $id);
			$selectedPgmList = $selectedStreamList = array();
			if( isset($selectListedValuesArray) && !empty($selectListedValuesArray))
			{
				foreach($selectListedValuesArray as $selected){
					$selectedPgmList[] = $selected->program_id;
					$selectedStreamList[] = (($selected->is_fasttrack == 'Y') ? $selected->program_id : '');
				}
			}
			//echo '<pre>';print_r($selectListedValuesArray);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,	
					'selectedPgmList'				=> $selectedPgmList,
					'selectedStreamList'			=> $selectedStreamList,
					'arg'							=> $id,
					'programs'						=> $programs,
					'sreatm'						=> $sreatm,
					'centers'						=> $centers,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/students/edit',$data);
			$this->load->view('admin/footer');
			
		}
		
	}	
	
	public function result_exam($id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}		
		$post_set = $_POST;
		
		if( isset($id) && !empty($id))
		{
			
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$this->form_validation->set_rules('program_id', 'Program Id', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('result[]', 'Result', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('grade[]', 'Grade', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					if( isset($_POST['aeId']) && !empty($_POST['aeId']) && count($_POST['aeId'])>0 ){
						$cnt = count($_POST['aeId']);
						for($i=0;$i<$cnt;$i++){
							$assignExamData[] = array(
								'score' => addslashes(trim( $_POST['score'][$i])),
								'result' => addslashes(trim( $_POST['result'][$i])),
								'exam_status' 	=> 'Completed',
								'grade' => addslashes(trim( $_POST['grade'][$i])),
								'publish' 		=> 'Y',
								'id'	=> addslashes(trim( $_POST['aeId'][$i]))
							);
						}
					}
					//echo '<pre>post->';print_r($_POST);
					//echo '<pre>assignExamData->';print_r($assignExamData);die;
					$check = $this->Student_model->myupdatebatch('assign_exam',$assignExamData,'id');
					
					if( isset($check) && !empty($check))
					{
						$this->session->set_flashdata('SucMessage', 'Added Successfully');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/students/result_exam/'.$id);
					}
				}
				
			}
			
			$getDefaultPgmArray = $this->Student_model->getSelectedFromUserpgmList('user_program','user_id',$id);
			rsort($getDefaultPgmArray);
			$defaultProgram_id = $getDefaultPgmArray[0]->program_id;
			
			$program_id = ((isset($_POST['program_id']) && !empty($_POST['program_id'])) ? $_POST['program_id'] : $defaultProgram_id);
			$ExamScore   	= $this->Student_model->ExamScore($id,$program_id);
			//echo '<pre>';print_r($ExamScore);
			$programList 	= $this->Student_model->getConnectedDataList('programs','user_program','program_id','user_id',$id);
			$enroll_detail 	= $this->Student_model->getMultiTableRecord('users','user_program','programs','center_academy','user_profiles','user_id',$id);
			//$ExamScore   	= $this->Student_model->ExamScore($id,'');
			//echo '<pre>';print_r($ExamScore);die;
			$resultArray = array(25=>'Pass',26=>'Fail',27=>'Unpublished',48=>'Admin reassign');
			$gradeArray = array(28=>'A+',29=>'A',30=>'A-',31=>'B+',32=>'B',33=>'B-',34=>'O',42=>'C+',43=>'C',44=>'C-',45=>'D+',46=>'D',47=>'D-');
			$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
			
			$selectedPgm = array();
			if( isset($_POST['program_id']) && !empty($_POST['program_id']))
			{
				$selectedCourse = $this->Student_model->getSelected_List('courses','program_id',$_POST['program_id']);
			}
			
			//echo '<pre>';print_r($ExamScore);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students Assign Exam',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					//'selectedValues'				=> $selectedValues,					
					'arg'							=> $id,
					'programList'					=> $programList,
					'enroll_detail'					=> $enroll_detail,
					'ExamScore'						=> $ExamScore,
					'selectedCourse'				=> $selectedCourse,
					'resultArray'					=> $resultArray,
					'gradeArray'					=> $gradeArray,
					'regulationList'				=> $regulationList,
					'post_set'						=> $post_set,
					'defaultProgram_id'				=> $defaultProgram_id
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/students/result_exam',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function course_completion($arg)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		$post_set = $_POST;
		if(isset($arg) && !empty($arg))
		{
			
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($arg) && (!empty($_POST['submit']) && trim($_POST['submit']) =='Submit') ) {
				$this->form_validation->set_rules('program_id', 'Program Id', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('graduation_status', 'Graduation Status', 'trim|required');
				$graduation_status = trim($this->input->post('graduation_status'));
				if( isset($graduation_status) && !empty($graduation_status) && $graduation_status == 'Y')
				{ 
					$this->form_validation->set_rules('graduate_date', 'Graduate Date', 'trim|required');
					$this->form_validation->set_rules('grade', 'Grade', 'trim|required|min_length[1]');
				}
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>post->';print_r($_POST);die;
					if( isset($_POST['is_eligible']) && !empty($_POST['is_eligible']) && $_POST['is_eligible']==1){
						
						$user_program_id = addslashes(trim( $this->input->post('user_program_id') ));
						$graduation_data = array(
							'completion_date' 				=> addslashes(trim( $this->input->post('graduate_date') )),
							'graduation_status_comments' 	=> addslashes(trim( $this->input->post('comment') )),
							'graduation_status' 			=> addslashes(trim( $this->input->post('graduation_status') )),
							'grade' 						=> addslashes(trim( $this->input->post('grade') )),
						);
						//echo '<pre>graduation_data->';print_r($graduation_data);die;
						$check = $this->Student_model->update('user_program','user_program_id',$graduation_data,$user_program_id);
						
						if( isset($check) && !empty($check))
						{
							$this->session->set_flashdata('SucMessage', 'Added Successfully');
							redirect(base_url().'vaasthu/admin/students/index'); 
						}else{
							$this->session->set_flashdata('SucMessage', 'Invalid Details');
							redirect(base_url().'vaasthu/admin/students/course_completion/'.$arg);
						}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/students/course_completion/'.$arg);
					}
					
				}
			}
			
			$getDefaultPgmArray = $this->Student_model->getSelectedFromUserpgmList('user_program','user_id',$arg);
			rsort($getDefaultPgmArray);
			$defaultProgram_id = $getDefaultPgmArray[0]->program_id;
			
			$programList 	= $this->Student_model->getConnectedDataList('programs','user_program','program_id','user_id',$arg);
			$program_id = ((isset($_POST['program_id']) && !empty($_POST['program_id'])) ? $_POST['program_id'] : $defaultProgram_id);
			
			$enroll_detail 	= $this->Student_model->getMultiTableRecord('users','user_program','programs','center_academy','user_profiles','user_id',$arg,'program_id',$program_id);
			
			$ExamScore   	= $this->Student_model->ExamScore($arg,$program_id);
			$paymentList   	= $this->Student_model->PaymentList($arg,$program_id);
			$gradeArray = array(28=>'A+',29=>'A',30=>'A-',31=>'B+',32=>'B',33=>'B-',34=>'O',42=>'C+',43=>'C',44=>'C-',45=>'D+',46=>'D',47=>'D-');
			
			$selectedPgm = array();
			if( isset($_POST['program_id']) && !empty($_POST['program_id']))
			{
				$selectedCourse = $this->Student_model->getSelected_List('courses','program_id',$_POST['program_id']);
			}
			//echo '<pre>paymentList->';print_r($paymentList);
			//echo '<pre>ExamScore->';print_r($ExamScore);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students Assign Exam',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					//'selectedValues'				=> $selectedValues,					
					'arg'							=> $arg,
					'programList'					=> $programList,
					'enroll_detail'					=> $enroll_detail,
					'ExamScore'						=> $ExamScore,
					'selectedCourse'				=> $selectedCourse,
					'resultArray'					=> $resultArray,
					'paymentList'					=> $paymentList,
					'gradeArray'					=> $gradeArray,
					'regulationList'				=> $regulationList,
					'post_set'						=> $post_set,
					'defaultProgram_id'				=> $defaultProgram_id
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/students/course_completion',$data);
			$this->load->view('admin/footer');
		}
	}
	
	
	public function assign_exam($id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('program_id', 'Program Id', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('course_code[]', 'Course Code', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('from_schedule[]', 'From Schedule', 'trim|required');
				$this->form_validation->set_rules('to_schedule[]', 'To Schedule', 'trim|required');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					/*$courseCodeArray = trim($_POST['course_code']);
					$quizResultArray = array();
					if( isset($courseCodeArray) && !empty($courseCodeArray))
					{
						foreach($courseCodeArray as $coursecode){
								$quizResultArray[] = $this->Student_model->getQuizDetail( $coursecode );
								$examStatusArray[] = $this->Student_model->checkExamStatus( $id, $coursecode );
						}
					}*/
					
					
					$check = $this->Student_model->assignExam('assign_exam',$id,$_POST);
					if( isset($check) && !empty($check))
					{
						$this->session->set_flashdata('SucMessage', 'Added Successfully');
						redirect(base_url().'vaasthu/admin/students/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/students/assign_exam/'.$id);
					}
				}
				
			}
			
			$getDefaultPgmArray = $this->Student_model->getSelectedFromUserpgmList('user_program','user_id',$id);
			rsort($getDefaultPgmArray);
			$defaultProgram_id = $getDefaultPgmArray[0]->program_id;
			
			$programList 	= $this->Student_model->getConnectedDataList('programs','user_program','program_id','user_id',$id);
			$enroll_detail 	= $this->Student_model->getMultiTableRecord('users','user_program','programs','center_academy','user_profiles','user_id',$id);
			$paymentList   	= $this->Student_model->PaymentList($id,$defaultProgram_id);
			$selectedPgm = array();
			if( isset($_POST['program_id']) && !empty($_POST['program_id']))
			{
				$selectedCourse = $this->Student_model->getSelected_List('courses','program_id',$_POST['program_id']);
			}
			//echo '<pre>paymentList->';print_r($paymentList);die;
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students Assign Exam',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					//'selectedValues'				=> $selectedValues,					
					'arg'							=> $id,
					'programList'					=> $programList,
					'enroll_detail'					=> $enroll_detail,
					'paymentList'					=> $paymentList,
					'selectedCourse'				=> $selectedCourse,
					//'sreatm'						=> $sreatm,
					//'centers'						=> $centers,
					'post_set'						=> $post_set,
					'defaultProgram_id'				=> $defaultProgram_id
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/students/assign_exam',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function ajaxCourseCompletion()
	{
		if( isset($_POST['program_id']) && !empty($_POST['program_id']) && isset($_POST['user_id']) && !empty($_POST['user_id']) ){
			$program_id = trim($_POST['program_id']);
			$id = trim($_POST['user_id']);
			$ExamScore   	= $this->Student_model->ExamScore($id,$program_id);
			$paymentList   	= $this->Student_model->PaymentList($id,$program_id);
			$getRes = array_merge( array('exam'=>$ExamScore), array('payment'=>$paymentList));
			echo json_encode($getRes);
		}
	}
	
	public function ajaxResultExam()
	{
		if( isset($_POST['program_id']) && !empty($_POST['program_id']) && isset($_POST['user_id']) && !empty($_POST['user_id']) ){
			$program_id = trim($_POST['program_id']);
			$id = trim($_POST['user_id']);
			$getRes = $this->Student_model->ExamScore($id,$program_id);
			echo json_encode($getRes);
		}
	}
	
	public function ajaxPgm()
	{
		if( isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_POST['field_val']) && !empty($_POST['field_val']) ){
			$table = trim($_POST['type']);
			$field_id = trim($_POST['field_id']);
			$field_val = trim($_POST['field_val']);
			$id = trim($_POST['user_id']);
			$ExamScore   	= $this->Student_model->ExamScore($id,$field_val);
			$paymentList   	= $this->Student_model->PaymentList($id,$field_val);
			$course = $this->Student_model->getSelected_List($table,$field_id,$field_val);
			$getRes = array_merge(array('exam'=>$ExamScore), array('payment'=>$paymentList),array('course'=>$course));
			echo json_encode($getRes);
		}
	}
	
	public function view( $arg )
	{
		$selectedValues = $this->Student_model->getSelected('user_id', $arg); //echo '<pre>';print_r($selectedValues);die;
		$data = array(
			'ErrorMessages'					=> $this->ErrorMessages,
			'ErrorMessage'					=> '',
			'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
			'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
			'SiteMainTitle' 				=> $this->SiteMainTitle,
			'selectedValues'				=> $selectedValues,					
			);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/students/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function reset_password( $arg )
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		if(isset($arg) && !empty($arg))
		{
				$user_data = $this->Student_model->getSelected('user_id',$arg);
				//echo '<pre>';print_r($user_data);die;
				if( $user_data->status ==1)
				{
					/* Mail sent */
					$data = array(
						'name'		=> $user_data->firstname.' '.$user_data->lastname,
						'username' 	=> $user_data->username,
						'password'	=> $this->decode($user_data->password)
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
					$this->email->from( CUSTOMER_EMAIL, 'Customer Support' );
					$this->email->to( $user_data->email );
					//$this->email->cc('sk@sanjaytechnologies.net');
					//$this->email->bcc();
					$this->email->subject('APAA User Credentials');
					
					$message=$this->load->view('forgetpassword_mail',$data,TRUE);
					//echo $message;die;
					$this->email->message($message);
					$this->email->send();
					/* end of mail */
					
					$this->session->set_flashdata('SucMessage', 'Successfully Send Mail');
					redirect(base_url().'vaasthu/admin/students/index');
				}
		}
		
	}
	
	public function status( $arg )
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		if(isset($arg) && !empty($arg))
		{
			$getRes = $this->Student_model->changeStatus('users', 'user_id', 'status', $arg);
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
				redirect(base_url().'vaasthu/admin/students/index'); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'vaasthu/admin/students/index'); 
			}
		}
		
	}
	
	public function remove( $arg )
	{
		
		$getRes = $this->Student_model->isDelete('users', 'user_id',$arg);
		
		if($getRes==true){
			//$this->Student_model->remove('user_profiles', 'user_id',$arg);
			//$this->Student_model->remove('user_program', 'user_id',$arg);
			$this->session->set_flashdata('SucMessage', 'Successfully deleted');
			redirect(base_url().'vaasthu/admin/students/index'); 
		}else{
			$this->session->set_flashdata('SucMessage', 'Invalid Details');
			redirect(base_url().'vaasthu/admin/students/index'); 
		}
		
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
	function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
}

