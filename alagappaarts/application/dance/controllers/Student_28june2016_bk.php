<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Student extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */	
	public $skey 	= 'Alagappa2016';
	public  $SiteMainTitle							='Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	 public function __construct()
	{	
			parent::__construct();
			
			
			
			$this->load->helper('captcha');
			$this->load->library('session');
			$this->load->model('home/Student_model');
			$this->load->library('form_validation');
			
			$this->load->library('image_lib');
			
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
	}	
	
	public function checkOldPass( $str )
	{
		$user_id = $this->session->userdata('site_user_id');
		$oldPass = $this->encode($str);
		$check = $this->Student_model->checkPassword($oldPass,$user_id);
		if( !empty($check))
		{
			return true;
		}else{
			$this->form_validation->set_message('checkOldPass', 'The %s field has wrong. please enter correct password ');
			return false;
		}
	}
	
	public function change_password()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$post_set 				= $_POST;
		
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['btnChangepassword']) && $_POST['btnChangepassword']=='Submit') ) {
			
			$this->form_validation->set_rules('txtOldpassword', 'Old Password', 'trim|required|min_length[8]|callback_checkOldPass');
			$this->form_validation->set_rules('txtNewPassword', 'New Password', 'trim|required|min_length[8]|matches[txtRenewpassword]');	
			$this->form_validation->set_rules('txtRenewpassword', 'Renew Password', 'trim|required|min_length[8]');
				
			if($this->form_validation->run() == FALSE )
			{
				$post_set		 					= $_POST;
				$this->ErrorMessages		 		= validation_errors();
			}else{
				
				$set_user_data = array(
					'password' 			=> $this->encode( addslashes(trim( $this->input->post('txtNewPassword') )) ),
					'updated_by'		=> 'User',
					'updated_at'		=> date('Y-m-d H:i:s'),
				);
				
				 $check = $this->Student_model->update('users','user_id',$set_user_data,$user_id);
				 if( isset($check) && !empty($check)){
					 
					 $userData = $this->Student_model->getData( 'users','user_profiles','user_id',$user_id);
					 $content = 'Password has changed Successfully';
						$subject = 'Password change to APAA!';
						$user_data = array(
							'firstname'	=> $userData->firstname,
							'lastname'	=> $userData->lastname,
							'email'		=> $userData->email
						);
						
						$this->common_mail($user_data,$content,$subject,false);
						
						
					$this->session->set_flashdata('SucMessage', 'Successfully created');
					redirect(base_url().'dance/student/profile'); 
				}else{
					$this->session->set_flashdata('SucMessage', 'Invalid Details');
					redirect(base_url().'dance/student/change_password'); 
				}
				
			}
		}
		$data = array(
			'post_set'	=> $post_set
		);
		
		$this->load->view('student/header');	
		$this->load->view('student/change_password',$data);
		$this->load->view('student/footer');
	}
	
	public function edit_profile()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$post_set 				= $_POST;
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['btnEditstudent']) && $_POST['btnEditstudent']=='Update') ) {
				$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');	
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[10]');
				
				if($this->form_validation->run() == FALSE )
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
						//echo '<pre>';print_r($_POST);die;
						$set_userprofile_data = array(		
								'address' 		 	 							=> addslashes(trim( $this->input->post('address') )),
								'city' 		 	 								=> addslashes(trim( $this->input->post('city') )),
								'state' 		 	 							=> addslashes(trim( $this->input->post('state') )),
								'dob' 		 	 								=> addslashes(trim( date('Y-m-d',strtotime($this->input->post('dob'))) )),
								'country' 		 	 							=> addslashes(trim( $this->input->post('country') )),
								'zip' 		 	 								=> addslashes(trim( $this->input->post('zip') )),
								'phone' 		 	 							=> addslashes(trim( $this->input->post('contact') )),
								'updated_by'									=> 'User',
								'updated_at'							=> date('Y-m-d H:i:s'),
						);
						
						$set_user_data = array(	
								'email' 		 	 					=> addslashes(trim( $this->input->post('email') )),
								'mobile' 		 	 					=> addslashes(trim( $this->input->post('contact') )),
								'updated_by'							=> 'User',
								'updated_at'							=> date('Y-m-d H:i:s'),
								
						 );
						 
						 $check = $this->Student_model->update('users','user_id',$set_user_data,$user_id);
						if( isset($check) && !empty($check)){
							$another_check = $this->Student_model->update('user_profiles','user_id',$set_userprofile_data,$user_id);
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'dance/student/profile'); 
						}else{
							$this->session->set_flashdata('SucMessage', 'Invalid Details');
							redirect(base_url().'dance/student/edit_profile'); 
						}
						 
				}
			
		}
		
		$userData = array();
		if( isset($user_id) && !empty($user_id))
		{
			$userData = $this->Student_model->getData( 'users','user_profiles','user_id',$user_id);
			//echo '<pre>';print_r($userData);die;
		}
		
		$data = array(
			'user_data' => $userData,
			'post_set'	=> $post_set
		);
		
		$this->load->view('student/header');	
		$this->load->view('student/update_profile',$data);
		$this->load->view('student/footer');
	}
	
	public function profile()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$userData = array();
		if( isset($user_id) && !empty($user_id))
		{
			$userData = $this->Student_model->getData( 'users','user_profiles','user_id',$user_id);
			//echo '<pre>';print_r($userData);die;
		}
		
		$data = array(
			'user_data' => $userData
		);
		
		$this->load->view('student/header');	
		$this->load->view('student/profile',$data);
		$this->load->view('student/footer');
	}
	
	public function index()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		
		$paymentList = array();
		$user_id = $this->session->userdata('site_user_id');
		if( isset($user_id) && !empty($user_id))
		{
			$exam_schedule 	= $this->Student_model->getExamSchedule($user_id);
			$paymentList 		= $this->Student_model->PaymentList($user_id,'');
		}
		
		$data = array(
				'exam_schedule'	=> $exam_schedule,
				'paymentList'	=> $paymentList
			);
		
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/dashboard',$data);
		$this->load->view('student/footer');
	}
	public function exam_schedule()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		if( isset($user_id) && !empty($user_id))
		{
			$exam_schedule 	= $this->Student_model->getExamSchedule($user_id);
		}
		$data = array(
			'exam_schedule' 	=> $exam_schedule
		);
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/exam_schedule',$data);
		$this->load->view('student/footer');
	}
	
	
	public function exam_result()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		if( isset($user_id) && !empty($user_id) )
		{
			$examScore = $this->Student_model->ExamScore($user_id);
		}
		//echo '<pre>';print_r($examScore);die;
		$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
		$data = array(
			'examScore' 		=> $examScore,
			'regulationList'	=> $regulationList
		);
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/exam_result',$data);
		$this->load->view('student/footer');
	}
	
	
	public function ajaxPayroll()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		
		$loggedin_user_id 	= $this->session->userdata('site_user_id');
		$program_id	= $_POST['program_id']; 
		$postUserId = $_POST['user_id'];
		$user_id = ((isset($postUserId) && !empty($postUserId)) ? $postUserId : $loggedin_user_id);
		if( isset($user_id) && !empty($user_id) && isset($program_id) && !empty($program_id) ){
			
			$examTaken 				= $this->Student_model->examTaken($user_id,$program_id);
			
			$program_enrollArray 	= $this->Student_model->getPaymentData($user_id,$program_id);
			$program_enroll = array_merge( array('payroll'=>$program_enrollArray),array('exam'=>$examTaken));
			echo json_encode($program_enroll);
		}else{
			echo json_encode(false);
		}
	}
	
	public function program_enrolled()
	{	
	
		
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$program_id = '';
		$user_id = $this->session->userdata('site_user_id');
		$program_enroll = $paymentList = array();
		if( isset($user_id) && !empty($user_id))
		{
			$programList 		= $this->Student_model->getConnectedDataList('programs','user_program','program_id','user_id',$user_id);
				if( isset($programList) && !empty($programList) && count($programList)>0){
					$reversePgm = array_reverse($programList);
					$program_id = $reversePgm[0]->program_id;
				}
			$program_enroll 	= $this->Student_model->getPaymentData($user_id,null);
			$paymentListArray 		= $this->Student_model->PaymentList($user_id,$program_id);
			$examTaken 				= $this->Student_model->examTaken($user_id,$program_id);
		} 
		//echo '<pre>program_enroll->';print_r($programList);die;
		if( isset($paymentListArray) && !empty($paymentListArray)){
			$cnt = count($paymentListArray);
			$paymentList = $paymentListArray;
		}
		
		$getPaid = $this->Student_model->getPaidDate('payment',$user_id,1);
		//echo '<pre>paymentList->';print_r($paymentList);die;
			$data = array(
				'pgmEnroll' 	=> $program_enroll[0],
				'paymentList'	=> $paymentList,
				'programList'	=> $programList,
				'examTaken'		=> $examTaken,
				'getPaid'		=> $getPaid
			);
		//echo '<pre>';print_r($paymentList);die;
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/program_enroll',$data);
		$this->load->view('student/footer');
	}
	
	public function feedback_view( $arg )
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$selectedVal = array();
		if( isset($user_id) && !empty($user_id) && isset($arg) && !empty($arg) )
		{
			$selectedVal = $this->Student_model->getSelected('feedback','feedback_id',$arg);
		}
		$data = array(
			'selectedVal' => $selectedVal
		);
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/feedback_view',$data);
		$this->load->view('student/footer');
		
	}
			
	public function add_feedback()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$post_set = $_POST;
		$user_id = $this->session->userdata('site_user_id');
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Send') ) {
			$this->form_validation->set_rules('txtSubject', 'Subject', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('txtMessage', 'Comment', 'trim|required|min_length[10]');
			
			if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{ 
					
					$set_feedback_data = array(		
							'student_id'							=> $user_id,
							'subject' 		 	 					=> addslashes(trim( $this->input->post('txtSubject') )),
							'message' 		 	 					=> addslashes(trim( $this->input->post('txtMessage') )),
							'status'								=> 'unread',
							'mailed_on'								=> date('Y-m-d H:i:s'),
							'created_by'							=> $this->session->userdata('site_user_name'),
							'updated_by'							=> $this->session->userdata('site_user_name'),
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
						);
					$check = $this->Student_model->save('feedback',$set_feedback_data);
					if( isset($check) && !empty($check)){
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'dance/student/feedback'); 
					}
					
				}
				
		}
		$data = array(
			'ErrorMessages'					=> $this->ErrorMessages,
			'ErrorMessage'					=> '',
			'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
			'SiteTitle' 					=> $this->SiteMainTitle.'- Feedback Add',
			'SiteMainTitle' 				=> $this->SiteMainTitle,
			'post_set'						=> $post_set
		);
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/add_feedback',$data);
		$this->load->view('student/footer');
	}
	
	public function payments()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$paymentList = array();
		$user_id = $this->session->userdata('site_user_id');
		if( isset($user_id) && !empty($user_id))
		{
			
			$paymentList 		= $this->Student_model->PaymentList($user_id,'');
		}
		
		$data = array(
				'paymentList'	=> $paymentList
			);
			
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/payments',$data);
		$this->load->view('student/footer');
	}
	
	public function feedback()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		
		$user_id = $this->session->userdata('site_user_id');
		$selectedList = array();
		if( isset($user_id) && !empty($user_id))
		{
			$selectedList = $this->Student_model->getConditionalRecord('feedback','student_id',$user_id);
		}
		//echo '<pre>';print_r($selectedList);die;
		$data = array(
			'selectedList' => $selectedList
		);
		$this->load->view('student/header');
		//$this->setHeader();
		$this->load->view('student/feedback',$data);
		$this->load->view('student/footer');
	}
	
	public function captcha_refresh(){ 
                $values = array(
                'word' => '',
                'word_length' => 8,
                'img_path' => '../assets/images/',
                'img_url' =>  base_url() .'assets/images/',
                'font_path'  => base_url() . 'system_dance/fonts/texb.ttf',
                'img_width' => '150',
                'img_height' => 50,
                'expiration' => 3600
               ); //echo '<pre>';print_r($values);die;
            $data = create_captcha($values);
                  $_SESSION['captchaWord'] = $data['word'];
           echo $data['image'];
        
       }
	   
	   public function remove_img()
	   {
			if(  isset($_POST['imgname']) && !empty($_POST['imgname']))
			{
				unlink('../assets/profile/'.$_POST['imgname']);
				echo 1;
			}else{
				echo 0;
			}
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
	   
	    public function common_mail($user_data,$content,$subject,$cc)
	   {
		   
			$data = array(
				'name'		=> $user_data['firstname'].' '.$user_data['lastname'],
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
			$this->email->from( CUSTOMER_EMAIL, 'Customer Support' );
			$this->email->to($user_data['email'] );
			if( isset($cc) && !empty($cc) && $cc==true){
				$this->email->cc(CUSTOMER_EMAIL);
			}
			//$this->email->bcc();
			$this->email->subject($subject);
			
			$message=$this->load->view('common_mail',$data,TRUE);
			//echo $message;die;
			$this->email->message($message);
			$resultMail = $this->email->send();
			return ((isset($resultMail) && !empty($resultMail) && $resultMail==1) ? true : false);
	   }
	   
	   
	public function registration()
	{
		if($this->session->userdata('site_logged_in') == true)
		{
			redirect(base_url().'dance/student/index', 'refresh');
		}
		
		$post_set 				= $_POST;
		$UploadError 			= '';
		$alreadyErrorMessages	= '';
		$captcha_error			= '';
		
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Register') ) {
				//echo '<pre>post->';print_r($_POST);echo '<pre>session->';print_r($_SESSION);die;
				
				$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');		
				//$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUsername');
				$this->form_validation->set_rules('state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[3]');			
				$this->form_validation->set_rules('age', 'Age', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('contact', 'Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('program_id', 'Program', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('center_id', 'Center', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('exp_bharatanatyam', 'Experience of bharatanatyam', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('name_of_guru', 'Name of guru', 'trim|required|min_length[3]');
				
				
				 $fileName = $flag = '';
								if( isset($_FILES['flePhoto']['name']) &&  !empty($_FILES['flePhoto']['name']) && trim($_POST['uploadImage'])=='' )
								{
									$flag = 1;
								}else if( isset($_FILES['flePhoto']['name']) &&  !empty($_FILES['flePhoto']['name']) && trim($_POST['uploadImage'])!='' )
								{
									unlink('../assets/profile/'.$_POST['uploadImage']);
									$flag = 1;
								}else if( isset($_FILES['flePhoto']['name']) &&  empty($_FILES['flePhoto']['name']) && trim($_POST['uploadImage'])!='' )
								{
									$flag = 2;
								}
								
								//if( isset($_FILES['flePhoto']['name']) &&  !empty($_FILES['flePhoto']['name']) && trim($_POST['uploadImage'])=='' )
								if( isset($flag) && $flag==1)
								{
												$fileExtension = explode(".", $_FILES['flePhoto']['name']);
												$fileExt = array_pop( $fileExtension );
												$fileName = strtolower(  md5(time()) .".".$fileExt);
												$config['file_name'] = $fileName;
												$config['upload_path'] = '../assets/profile';
													$config['allowed_types'] = 'jpg|png|jpeg';
													//$config['max_size']	= '100';
													//$config['max_size'] = '125';
													//$config['max_width']  = '157';
													
													//strtolower(str_replace(' ', '-',$fileExtension[0]))
													//echo '<pre>';print_r($config);
													$this->load->library('upload', $config);
													
													if(!$this->upload->do_upload('flePhoto'))
                                        {
                                            $UploadError 	= array('error' => "Please select a valid 100kb size file");		
                                        }else{
                                                
                                                $upload_data = $this->upload->data();
                
                                                // set the resize config
                                                $resize_conf = array(
                                                    // it's something like "/full/path/to/the/image.jpg" maybe
                                                    'source_image'  => '../assets/profile/'.$fileName, 
                                                    // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                                                    // or you can use 'create_thumbs' => true option instead
                                                    'new_image'     => '../assets/profile/'.'thumb_'.$fileName,
                                                    'width'         => 150,
                                                    'height'        => 150
                                                    );

                                                // initializing
                                                $this->image_lib->initialize($resize_conf);

                                                // do it!
                                                if ( ! $this->image_lib->resize())
                                                {
                                                    // if got fail.
                                                    $error['resize'][] = $this->image_lib->display_errors();
                                                }
                                                else
                                                { 
                                                        $thumbImage = 'thumb_'.$fileName;
                                                        /*if( !empty($_POST['uploadImage'])){
                                                                $_POST['uploadImage'] = $_POST['uploadImage'];
                                                        }else{*/
                                                                $_POST['uploadImage'] = $post_set['uploadImage'] = 'thumb_'.$fileName;
																unlink('../assets/profile/'.$fileName);
                                                        //}
                                                }
                                                
                                        }
                                }
								/*if( isset($_POST['captcha']) && !empty($_POST['captcha']))
								{
									if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
										$captcha_error = '';
									}else{
										$captcha_error = 'Invalid Captcha';
									}
								}*/
					
				if($this->form_validation->run() == FALSE )
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>123->';print_r($_POST);die;//echo '<pre>';print_r($_POST);die;
					$set_userprofile_data = array(						
							'firstname' 		 	 						=> addslashes(trim( $this->input->post('first_name') )),
							'lastname' 		 	 							=> addslashes(trim( $this->input->post('last_name') )),
							'address' 		 	 							=> addslashes(trim( $this->input->post('address') )),
							'city' 		 	 								=> addslashes(trim( $this->input->post('city') )),
							'state' 		 	 							=> addslashes(trim( $this->input->post('state') )),
							'dob' 		 	 								=> addslashes(trim( date('Y-m-d',strtotime($this->input->post('dob'))) )),
							'country' 		 	 							=> addslashes(trim( $this->input->post('country') )),
							'age' 		 	 								=> addslashes(trim( $this->input->post('age') )),
							'zip' 		 	 								=> addslashes(trim( $this->input->post('zip') )),
							'gender' 		 	 							=> addslashes(trim( $this->input->post('gender') )),
							'phone' 		 	 							=> addslashes(trim( $this->input->post('contact') )),
							'alternate_phone' 		 	 					=> addslashes(trim( $this->input->post('other_contact') )),
							//'program_id' 		 	 						=> addslashes(trim( $this->input->post('program_id') )),
							'photo'											=> addslashes(trim( $this->input->post('uploadImage') )),
							//'stream' 		 	 							=> addslashes(trim( $this->input->post('stream') )),
							'center_id' 		 	 						=> addslashes(trim( $this->input->post('center_id') )),
							'bharathanatiyam_experience' 		 	 		=> addslashes(trim( $this->input->post('exp_bharatanatyam') )),
							'special_accomplishment' 		 	 			=> addslashes(trim( $this->input->post('txtSpecqualification') )),
							'name_of_master' 		 	 					=> addslashes(trim( $this->input->post('name_of_guru') )),
							'master_located_at' 		 	 				=> addslashes(trim( $this->input->post('txtLoca') )),
							'other_relevant_info' 		 	 				=> addslashes(trim( $this->input->post('txtotherinfo') )),
							'created_by'									=> 'User',
							'updated_by'									=> 'User',
							'created_at'									=> date('Y-m-d H:i:s'),
					);
					
					$set_user_data = array(						
							//'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('contact') )),
							'password' 		 	 					=> addslashes(trim( $this->encode($this->randomPassword()) )),	
							'user_role_id'							=> 2,
							'status'								=> 0,
							'created_by'							=> 'User',
							'updated_by'							=> 'User',
							'created_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					$check = $this->Student_model->save('users',$set_user_data);
					if( isset($check) && !empty($check)){
						
						/*User Program*/
						$user_program = array(
							'user_id' 		=> $check,
							'program_id' 	=> addslashes(trim( $this->input->post('program_id') )),
							'center_id' 	=> addslashes(trim( $this->input->post('center_id') )),
							'enrollment_date'	=> date('Y-m-d H:i:s'),
							'is_fasttrack'	=> 'N'
						);
						$this->Student_model->save('user_program',$user_program);
						
						$another_check = $this->Student_model->Another_save('user_profiles',$check,'user_id',$set_userprofile_data);
						
						$content = '
Greetings from APAA! Your request for registering as APAA Dance Student has been successfully completed. The APAA customer support team will get back to you shortly.';
						$subject = 'Greetings from APAA!';
						$user_data = array(
							'firstname'	=> addslashes(trim( $this->input->post('first_name') )),
							'lastname'	=> addslashes(trim( $this->input->post('last_name') )),
							'email'		=> addslashes(trim( $this->input->post('email') ))
						);
						$this->common_mail($user_data,$content,$subject,false);
						
						$this->session->set_flashdata('SucMessage', 'Thanks for your Registration. Please wait for Admin approval');
						redirect(base_url().'dance/student/registration'); 
					}else{
						$this->session->set_flashdata('ErrMessage', 'Invalid Details');
						redirect(base_url().'dance/student/registration'); 
					}
				}
			}
			$programs = $this->Student_model->getListactiveState('programs');
			$sreatm = array('Fast Track'=>'Fast Track','Noraml'=>'Noraml');
			$centers = $this->Student_model->getListactiveState('center_academy');
			
			
			 /*$values = array(
                'word' => '',
                'word_length' => 8,
                'img_path' => '../assets/images/',
                'img_url' =>  base_url() .'assets/images/',
                'font_path'  => base_url() . 'system_dance/fonts/texb.ttf',
                'img_width' => '150',
                'img_height' => 50,
                'expiration' => 3600
               );*/
            //$data = create_captcha($values);
			
				//echo '<pre>';print_r($post_set);die;
			/*$captchadata = create_captcha($values);
			$_SESSION['captchaWord'] = $captchadata['word'];*/
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'UploadError' 				 	=> $UploadError,
					'alreadyErrorMessages'          => $alreadyErrorMessages,
					'captcha_error'				=> $captcha_error,
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'programs'						=> $programs,
					'sreatm'						=> $sreatm,
					'centers'						=> $centers,
					//'image'							=> create_captcha($values),
					'post_set'						=> $post_set
			);
			
		//$this->load->view('student/header');
		
		//echo '<pre>';print_r($data);die;
		$this->setHomeHeader();
		$this->load->view('student/registration',$data);
		$this->load->view('student/footer');
	}
	
	function update_time($id,$qtime){
		$this->Student_model->update_time($id,$qtime);
	}
	function update_answer($id,$oid){
		$this->Student_model->update_answer($id,$oid);
	}
	function update_fillups(){
		$this->Student_model->update_fillups();
	}
	
	
	public function online_exam()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$onlineExam = array();
		if( isset($user_id) && !empty($user_id))
		{
			$onlineExam = $this->Student_model->getExam($user_id);
		} //echo '<pre>';print_r($onlineExam);die;
		$data = array(
			'onlineExam' => $onlineExam
		);
		$this->load->view('student/header');
		$this->load->view('student/online_exam',$data);
		$this->load->view('student/footer');
	}
	
	
	
	
	public function sample_exam()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$data = array();
		$this->load->view('student/header');
		$this->load->view('student/sample_exam',$data);
		$this->load->view('student/footer');
	}
	
	public function sample_exam_process()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$this->load->helper('cookie'); 
		
		$id = 1;//((isset($arg_id) && !empty($arg_id) && $arg_id==1) ? $arg_id : 1);
			
		$data['resultstatus'] = $this->Student_model->sample_quiz_verify();
		$data['quiz_id']=$id;
		$data['result'] = $this->Student_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		if( isset($data['resultstatus']) && !empty($data['resultstatus']) && $data['resultstatus'] != ""){
				if(!$this->input->cookie('rid', TRUE)){  
				redirect('dance/student/sample_exam_process/', 'refresh');
				} 
				$Cookie_rid = $this->input->cookie('rid', TRUE);
				$rid = ((isset($Cookie_rid) && !empty($Cookie_rid)) ? $Cookie_rid : $data['resultstatus']);
				//get the question answer 
				$data['user_answer']=$this->Student_model->get_user_answer($rid); 
				$question_user_ans=array();
				
				if( isset($data['user_answer']) && !empty($data['user_answer']))
				{
					foreach($data['user_answer'] as $val_ans){
						$question_user_ans[$val_ans['q_id']]=$val_ans['essay_cont'];				
					}
				}
				//echo '<pre>';print_r($question_user_ans);die;
				$data['question_user_ans']=$question_user_ans;
				// get assignied questions
				$data['assigned_question'] = $this->Student_model->get_question($rid); //echo '<pre>';print_r($assignedQuestion);	die;
				
				// get time information
				$data['time_info']=$this->Student_model->get_time_info($rid);//echo '<pre>';print_r($data['time_info']);die;
				if( isset($data['time_info']) && !empty($data['time_info'])){
					// time remaining in seconds
					// total time - time spent
					$data['seconds']=(($data['result']->duration)*60) - ($data['time_info']['time_spent']);
					
					// get quiz data like quiz duration, title
					$data['quiz_data']=$this->Student_model->get_quiz_data($id);
					//echo '<pre>';print_r($data);die;
					$this->load->view('student/quiz_header',$data);
					$this->load->view('student/sample_exam_process',$data);
					$this->load->view('student/quiz_footer',$data);
				}else{
					
				}
		}else{	
			$data['result'] = $this->Student_model->quiz_detail($id);
			$data['title']=$data['result']->quiz_name;
			$this->load->view('student/header');
			$this->load->view('student/sample_exam',$data);
			$this->load->view('student/footer');
		}
	}
	
	
	public function exam_process( $course = '')
	{
		
		//echo 'course->'.$course;die;
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		//$this->load->helper('cookie'); 
		$user_id = $this->session->userdata('site_user_id');
		
		if( isset($user_id) && !empty($user_id))
		{ 
			if( isset($course) && !empty($course) && $course != 'online_exam_process' ){
				$course_id = $this->decode($course);
				$checkCourse = $this->Student_model->getConditionalRecord('quiz','course_id',$course_id);
				if( isset($checkCourse) && !empty($checkCourse)){
					$getAssignedExam = $this->Student_model->getExamWithID( $user_id );	
					$qid = $course_id;
				}else{
					$this->session->set_flashdata('ErrMessage', 'Invalid Course Id. Please check your Course code');
					redirect('dance/student/online_exam/', 'refresh');
				}
			}elseif( empty($course)){
				$getAssignedExam = $this->Student_model->getExamWithID( $user_id );	
				$qid = ((isset($getAssignedExam[0]) && !empty($getAssignedExam[0]) ) ? $getAssignedExam[0]->course_id : '');	
			}
			$quiz_qid = ((isset($_SESSION['qid']) && !empty($_SESSION['qid'])) ? $_SESSION['qid'] : $qid);
			$checkBendingExam = $this->Student_model->checkWriteExamAlready( $user_id,$quiz_qid );
			//echo '<pre>checkBendingExam->';print_r($checkBendingExam);echo $quiz_qid;die;
			log_message('error','Check Pending Exam ->'.print_r( json_encode($checkBendingExam),TRUE));
			if( isset($checkBendingExam) && !empty($checkBendingExam) && $checkBendingExam[0]->quid != $quiz_qid && empty($checkBendingExam[0]->score_ind)){
				
				$this->session->set_flashdata('ErrMessage', 'Already You exam Pending . course code '.$checkBendingExam[0]->course_code.' Please Contact APAA Support team.');
				redirect('dance/student/online_exam/', 'refresh');
				
			}else{  
				if( isset($qid) && !empty($qid)){
					$id = $_SESSION['qid'] = $qid;
				}if( isset($_SESSION['qid']) && !empty($_SESSION['qid'])){
					$id = $_SESSION['qid'];
				}
			} 
			//$id = ((isset($qid) && !empty($qid)) ? $qid : $_SESSION['qid']);
		}  
			//echo 'id->'.$id;
			//echo '<pre>session->';print_r($_SESSION);
			//die;
		if( isset($_SESSION['qid']) && !empty($_SESSION['qid'])){
			$checkAlready = $this->Student_model->checkWriteExamAlready( $user_id, $_SESSION['qid'] );	
			if( isset($checkAlready) && !empty($checkAlready) && empty($checkAlready[0]->score_ind) && !empty($checkAlready[0]->quid) ){  
				$quiz_id = $checkAlready[0]->quid;	
				$data['resultstatus'] = 1;
				$data['quiz_id']=$quiz_id;
				$data['result'] = $this->Student_model->quiz_detail($quiz_id);
				$data['title']=$data['result']->quiz_name; 
				if( isset($data['resultstatus']) && !empty($data['resultstatus']) && $data['resultstatus'] == "1"){				
							
						//echo 'a->data';print_r($data);die;
						if( isset($checkAlready[0]->rid) && !empty($checkAlready[0]->rid)){
							$rid= $checkAlready[0]->rid;
						}else{ 
							redirect('dance/student/exam_process/', 'refresh');
						}
						
						//get the question answer 
						$data['user_answer']=$this->Student_model->get_user_answer($rid); 
						$question_user_ans=array();
						
						if( isset($data['user_answer']) && !empty($data['user_answer']))
						{
							foreach($data['user_answer'] as $val_ans){
								$question_user_ans[$val_ans['q_id']]=$val_ans['essay_cont'];				
							}
						}
						//echo '<pre>';print_r($question_user_ans);die;
						$data['question_user_ans']=$question_user_ans;
						// get assignied questions
						$data['assigned_question']=$this->Student_model->get_question($rid); //echo '<pre>';print_r($data['assigned_question']);die;
						// get time information
						$data['time_info']=$this->Student_model->get_time_info($rid);//echo '<pre>';print_r($data['time_info']);die;
						if( isset($data['time_info']) && !empty($data['time_info'])){
							// time remaining in seconds
							// total time - time spent
							$data['seconds']=(($data['result']->duration)*60) - ($data['time_info']['time_spent']);
							
							// get quiz data like quiz duration, title
							$data['quiz_data']=$this->Student_model->get_quiz_data($quiz_id);
							
							if((isset($getAssignedExam[0]) && !empty($getAssignedExam[0])) && isset($user_id) && !empty($user_id) ){
								$this->Student_model->Online_Exam_Processing_status( 'exam_startdate', date('Y-m-d H:i:s'), 'Processing', $getAssignedExam[0]->id);
							}	
							//echo '<pre>';print_r($data);die;
							//echo '<pre>';print_r($data['assigned_question']);die;
							$this->load->view('student/quiz_header',$data);
							$this->load->view('student/online_exam_process',$data);
							$this->load->view('student/quiz_footer',$data);
						}else{
							
						}
				}
				
			}			
			else if( isset($_SESSION['qid']) && !empty($_SESSION['qid']) )
			{	 
				$quiz_id = $_SESSION['qid'];
				$data['resultstatus'] = $this->Student_model->quiz_verify($quiz_id);
				$data['quiz_id']=$quiz_id;
				$data['result'] = $this->Student_model->quiz_detail($quiz_id);
				$data['title']=$data['result']->quiz_name;
				if( isset($data['resultstatus']) && !empty($data['resultstatus']) && $data['resultstatus'] == "1"){				
							
						/*if(!$this->input->cookie('rid', TRUE)){  
						redirect('dance/student/exam_process/', 'refresh');
						} 
						$rid= $this->input->cookie('rid', TRUE);
						*/
						if( isset($_SESSION['session_rid']) && !empty($_SESSION['session_rid'])){
							$rid= $_SESSION['session_rid'];
						}else{
							redirect('dance/student/exam_process/', 'refresh');
						}
						
						//get the question answer 
						$data['user_answer']=$this->Student_model->get_user_answer($rid); 
						$question_user_ans=array();
						
						if( isset($data['user_answer']) && !empty($data['user_answer']))
						{
							foreach($data['user_answer'] as $val_ans){
								$question_user_ans[$val_ans['q_id']]=$val_ans['essay_cont'];				
							}
						}
						//echo '<pre>';print_r($question_user_ans);die;
						$data['question_user_ans']=$question_user_ans;
						// get assignied questions
						$data['assigned_question']=$this->Student_model->get_question($rid); //echo '<pre>';print_r($data['assigned_question']);die;
						// get time information
						$data['time_info']=$this->Student_model->get_time_info($rid);//echo '<pre>';print_r($data['time_info']);die;
						if( isset($data['time_info']) && !empty($data['time_info'])){
							// time remaining in seconds
							// total time - time spent
							$data['seconds']=(($data['result']->duration)*60) - ($data['time_info']['time_spent']);
							
							// get quiz data like quiz duration, title
							$data['quiz_data']=$this->Student_model->get_quiz_data($quiz_id);
							
							if((isset($getAssignedExam[0]) && !empty($getAssignedExam[0])) && isset($user_id) && !empty($user_id) ){
								$this->Student_model->Online_Exam_Processing_status( 'exam_startdate', date('Y-m-d H:i:s'), 'Processing', $getAssignedExam[0]->id);
							}	
							//echo '<pre>';print_r($data);die;
							//echo '<pre>';print_r($data['assigned_question']);die;
							$this->load->view('student/quiz_header',$data);
							$this->load->view('student/online_exam_process',$data);
							$this->load->view('student/quiz_footer',$data);
						}else{
							
						}
				}else{	
					$data['result'] = $this->Student_model->quiz_detail($id);
					$data['title']=$data['result']->quiz_name;
					$this->load->view('student/header');
					$this->load->view('student/online_exam',$data);
					$this->load->view('student/footer');
				}
			}
		}else{ 
			$data['resultstatus'] = 'Exam Not assigned. Please Contact APAA support Team.';
			$this->load->view('student/header');
			$this->load->view('student/online_exam',$data);
			$this->load->view('student/footer');
		}
	}
	
	
	function online_submit_quiz(){
		
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$this->load->helper('cookie');
		$user_id = $this->session->userdata('site_user_id');
		if( isset($user_id) && !empty($user_id))
		{
			$getAssignedExam = $this->Student_model->getSelected( 'assign_exam','exam_status','Processing' );
			if((isset($getAssignedExam) && !empty($getAssignedExam))){
				$findStatus = $this->Student_model->Online_Exam_Processing_status( 'exam_completiondate', date('Y-m-d H:i:s'), 'Processing', $getAssignedExam->id );
			
				$getQid = $this->Student_model->getQuidFromQuiz($getAssignedExam->course_id);
			
				$id = ((isset($getQid->quid) && !empty($getQid->quid)) ? $getQid->quid : 
					((isset($_SESSION['qid']) && !empty($_SESSION['qid'])) ? $_SESSION['qid'] : ''));
			}/*else{
				redirect('dance/student/exam_process/', 'refresh');
			}*/
			
		} 
		
 	
		$data['resultstatus']	= $this->Student_model->quiz_submit($id);
		$data['result'] 		= $this->Student_model->quiz_detail($id);
		$data['title']			= '';//$data['result']->quiz_name;
		$_SESSION['qid'] = '';
		$_SESSION['session_rid'] = '';
		$this->load->view('student/header',$data);
		$this->load->view('student/online_exam',$data);
	  	$this->load->view('student/footer',$data);
	}
	
	function submit_quiz($id){
		
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$this->load->helper('cookie');
 	
		$data['resultstatus']='Exam submitted successfully. Please wait for the result';//$this->Student_model->quiz_submit($id);
		$data['result'] = $this->Student_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		$this->load->view('student/header',$data);
		$this->load->view('student/sample_exam',$data);
	  	$this->load->view('student/footer',$data);
	}
	
	public function test()
	{
		
		echo $this->decode('Fgk2tTUpl1_2D3E_tR85TerQeQYK6Ptnq9uf5NLxFf0'); //ePJzfHFC
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
	
	
	function buildMenu($parent, $menu, $parentMenu) { 
		$html = "";
		if (isset($menu['parent_menus'][$parent])) {
			if($parent ==0){
				$html .= "<ul class='menu' id='menu-menu-1'>";				
			}
			$i=1;$selectedParentId = array();
			
			foreach ($menu['parent_menus'][$parent] as $k=>$menu_id) {
				if (!isset($menu['parent_menus'][$menu_id])) {
					if(!empty($parent)){ 
						$html .= (($i==1) ? '<li class="current_page_item"><div class="caret-1"></div></li>' :'<li class="divider"></li>');
						if( $menu['menus'][$menu_id]['type'] == 'popup'){
							$menuPopup = stripslashes( $menu['menus'][$menu_id]['menuPopup'] );
							$html .= '<li class="menu-item"><a ' . $menuPopup . '>' . $menu["menus"][$menu_id]["name"] . '</a></li>';
						}else{
							
							$urlString = uri_string();
					$isActive = ((!empty($urlString) && $urlString == $menu['menus'][$menu_id]['link']) ? 'current_page_item active' : '');
					
							$html .= "<li class='menu-item menu-item-type-post_type menu-item-object-page ".$isActive."'><a class='has-parent' href='" . base_url().'dance/'.$menu['menus'][$menu_id]['link'] . "'>" . stripslashes($menu['menus'][$menu_id]['name']) . "</a></li>";	
						}
					}else{
						$urlString = uri_string();
					$isActive = (( empty($urlString) && $menu['menus'][$menu_id]['name']=='Home') ? 'current_page_item active': (!empty($urlString) && $urlString == $menu['menus'][$menu_id]['link']) ? 'current_page_item active' : '');
						$html .= "<li class='menu-item menu-item-type-post_type menu-item-object-page ".$isActive."'><a href='" . base_url().'dance/'.$menu['menus'][$menu_id]['link'] . "'>" . stripslashes($menu['menus'][$menu_id]['name']) . "</a></li>";
					}
					$i++;
				} 
				if (isset($menu['parent_menus'][$menu_id])) { $urlString = uri_string();
					$isActive = ((!empty($urlString) && !empty($parentMenu) && ($menu['menus'][$menu_id]['menu_id'] == $parentMenu)) ? ' current_page_item active' : '');
					$html .= '<li class=" '.$isActive.'"><a class="dropdown-toggle" data-toggle="dropdown" href=' . base_url().'dance/'.$menu['menus'][$menu_id]['link'] . '>' . $menu['menus'][$menu_id]['name'] . '<span class="caret"></span></a>';
					$html .= '<ul class="sub-menu" role="menu">';
					$html .= $this->buildMenu($menu_id, $menu, $parentMenu);
					$html .= '</ul></li>';
					
				}
				
			}
				if($parent ==0){
					$html .= "</ul>";
				}
			
		}
		return $html;
	}
	
	public function setHomeHeader()
	{
			//$settingsDetail = $this->Home_model->get_settings_details();
			$this->load->model('home/Home_model');
			$urlString = uri_string();
			$getMenu = $this->Home_model->dynamicMenu();
			
			$getParentMenu = $this->Home_model->getParentMenuFromTable( trim($urlString)  );
			
			$setMenuList = $this->buildMenu( 0, $getMenu , $getParentMenu);
			//echo '<pre>';print_r($setMenuList);die;
			$data = array(
				'menuList' => $setMenuList,
				//'settingsDetail' => $settingsDetail
			);
			
			$this->load->view('header', $data);
	}
	
	public function getLeftbanners()
	{
		$this->load->model('home/Home_model');
		$urlParams = $this->uri->segment(1);
		if( isset($urlParams) && !empty($urlParams))
		{	
			$url = (( $urlParams == 'student' ) ? 'registration' : $urlParams );
			$getMenuList = $this->Home_model->menuList($url);
			//echo '<pre>';print_r($getMenuList);die;
			return $getMenuList;
		}
		
	}
	
	
	public function logout()
	{
		$user_data = array('admin_user_name' => '',
                           'admin_user_id' => '',
                           'admin_email' => '',
                           'admin_logged_in' => 0);
        $this->session->unset_userdata($user_data);
		$this->session->sess_destroy();
        redirect(base_url().'dance');
	}
	
	
	
}
