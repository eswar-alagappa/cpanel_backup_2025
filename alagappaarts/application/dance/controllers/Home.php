<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public $skey 	= 'Alagappaarts2017'; 
	public  $SiteMainTitle							='Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	 public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('home/Home_model');
			$this->load->library('form_validation');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
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
	
	
	public function index()
	{	
		if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
		{
			redirect(base_url().'dance/student/index', 'refresh');
		}
		if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '3' )
		{
			redirect(base_url().'dance/center/index', 'refresh');
		}
		//$this->load->view('header');
		$this->setHomeHeader();
		$this->load->view('content');
		$this->load->view('footer');
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
			
			$urlString = uri_string();
			$getMenu = $this->Home_model->dynamicMenu();
			
			$getParentMenu = $this->Home_model->getParentMenuFromTable( trim($urlString)  );
			//echo '<pre>123->';print_r($getParentMenu);die;
			$setMenuList = $this->buildMenu( 0, $getMenu , $getParentMenu);
			//echo '<pre>';print_r($setMenuList);die;
			$data = array(
				'menuList' => $setMenuList,
				//'settingsDetail' => $settingsDetail
			);
			
			$this->load->view('header', $data);
	}
	
	public function forgetpassword()
	{
			if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
			{
				redirect(base_url().'dance/student/index', 'refresh');
			}
			$data = array();
			$post_set		 		                	= $_POST;
			
			if (($this->input->server('REQUEST_METHOD') == 'POST')) {
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() 		== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages				= validation_errors();
				}else{
						
						$set_user_data = array(
							'email' 		 	 				=> addslashes(trim( $this->input->post('email') )),
							'username' 		 	 				=> addslashes(trim( $this->input->post('username') ) ),
						);
						
						$loginChk = $this->Home_model->checkUser( $set_user_data );
						
						if( !empty($loginChk))
						{
							//echo '<pre>';print_r($loginChk);die;
							$data = array(
								'name'		=> $loginChk->firstname.' '.$loginChk->lastname,
								'username' 	=> $loginChk->username,
								'password'	=> $this->decode($loginChk->password)
							);
							
							$this->load->helper(array('email'));
							$this->load->library(array('email'));
							$this->email->set_mailtype("html");
							//$data['sender_mail'] = 'thenmozhi@sanjaytechnologies.org';
							$this->load->library('email');
							$config = array (
							  'mailtype' => 'html',
							  'charset'  => 'utf-8',
							  'priority' => '1'
							   );
							$this->email->initialize($config);
							$this->email->from( CUSTOMER_EMAIL , 'Customer Support' );
							$this->email->to( $loginChk->email );
							
							//$this->email->bcc();
							$this->email->subject('APAA User Credentials');
							
							$message=$this->load->view('forgetpassword_mail',$data,TRUE);
							//echo $message;die;
							$this->email->message($message);
							$this->email->send();
							redirect(base_url().'dance/registration');
						}else{
							$this->session->set_flashdata('SucMessage', 'Incorrect Email and Contact');
							redirect(base_url().'dance/forgetpassword');
						}
					
					//echo '<pre>';print_r($_POST);die;
				}
			}
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Login',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
			);
		
			//$chkLogin = $this->Home_model->checkLogin();	
			$this->setHomeHeader();
			$this->load->view('login',$data);
			$this->load->view('footer');
			
			
	}
	
	
	public function studentforgetpassword()
	{
			if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
			{
				redirect(base_url().'dance/student/index', 'refresh');
			}
			$data = array();
			$post_set		 		                	= $_POST;
			
			if (($this->input->server('REQUEST_METHOD') == 'POST')) {
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() 		== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages				= validation_errors();
				}else{
						
						$set_user_data = array(
							'email' 		 	 				=> addslashes(trim( $this->input->post('email') )),
							'username' 		 	 				=> addslashes(trim( $this->input->post('username') ) ),
						);
						
						$loginChk = $this->Home_model->checkStudent( 'students','student_profiles','user_id',$set_user_data );
						
						if( !empty($loginChk))
						{
							//echo '<pre>';print_r($loginChk);die;
							$data = array(
								'name'		=> $loginChk->firstname.' '.$loginChk->lastname,
								'username' 	=> $loginChk->username,
								'password'	=> $this->decode($loginChk->password)
							);
							
							$this->load->helper(array('email'));
							$this->load->library(array('email'));
							$this->email->set_mailtype("html");
							//$data['sender_mail'] = 'thenmozhi@sanjaytechnologies.org';
							$this->load->library('email');
							$config = array (
							  'mailtype' => 'html',
							  'charset'  => 'utf-8',
							  'priority' => '1'
							   );
							$this->email->initialize($config);
							$this->email->from( CUSTOMER_EMAIL , 'Customer Support' );
							$this->email->to( $loginChk->email );
							
							//$this->email->bcc();
							$this->email->subject('APAA User Credentials');
							
							$message=$this->load->view('forgetpassword_mail',$data,TRUE);
							//echo $message;die;
							$this->email->message($message);
							$this->email->send();
							redirect(base_url().'dance/syllabuslogin');
						}else{
							$this->session->set_flashdata('SucMessage', 'Incorrect Email and Contact');
							redirect(base_url().'dance/studentforgetpassword');
						}
					
					//echo '<pre>';print_r($_POST);die;
				}
			}
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Login',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
			);
		
			//$chkLogin = $this->Home_model->checkLogin();	
			$this->setHomeHeader();
			$this->load->view('login',$data);
			$this->load->view('footer');
			
			
	}
	
	
	public function syllabuslogin($type)
	{
	    
	    	if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
			{
				redirect(base_url().'dance/student/index', 'refresh');
			}
			$data = array();
			$post_set		 		                	= $_POST;
			
		
			if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			    
			
				
				$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[8]|max_length[20]');
				
				if($this->form_validation->run() 		== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages				= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					$set_user_data = array(
							'username' 		 	 				=> addslashes(trim( $this->input->post('txtUsername') )),
							'password' 		 	 				=> addslashes(trim( $this->input->post('txtPassword') ) ),
						);
					
					$loginChk = $this->Home_model->checkStudentLogin( $set_user_data );
					
					//echo '<pre>$loginChk->';print_r($loginChk);die;
					if(!empty($loginChk))
					{
					//echo '<pre>';print_r($loginChk);die;
						
						//Add User data to session
						
						if( !empty($loginChk->user_role_id) && $loginChk->user_role_id == 2)
						{ 
							$user_data = array('site_user_name' 	=> $loginChk->username,
											'profileName'			=> $loginChk->firstname.' '.$loginChk->lastname,
										   'site_user_id' 			=> $loginChk->user_id,
										   'site_email' 			=> $loginChk->email,
										   'site_user_role' 		=> $loginChk->user_role_id,
										   'site_user_role_name'	=> $loginChk->role_name,
										   'site_logged_in' 		=> true
										  );  
								$this->session->set_userdata($user_data);	
								$login_details = array('user_id'=>$user_data['site_user_id'],'user_type'=>"Student",'date'=>date('Y-m-d H:i:s'),'ip_address'=>$this->Home_model->get_client_ip());
								$this->Home_model->insert_values('login_details',$login_details);
							redirect(base_url().'dance/student/studentprofile');
						}
						/*elseif( !empty($loginChk->user_role_id) && $loginChk->user_role_id == 3)
						{ 
							$this->load->model('home/Center_model');
							$getAcademyData = $this->Center_model->getId('center_academy','username',trim($loginChk->username));
							//echo '<pre>';print_r($getAcademyData);die;
							$user_data = array('site_user_name' 	=> $loginChk->username,
											'profileName'			=> $getAcademyData->name,
										   'site_user_id' 			=> $loginChk->user_id,
										   'site_email' 			=> $loginChk->email,
										   'site_user_role' 		=> $loginChk->user_role_id,
										   'site_user_role_name'	=> $loginChk->role_name,
										   'center_academy_id'		=> $getAcademyData->center_academy_id,
										   'site_logged_in' 		=> true
										  );  
								$this->session->set_userdata($user_data);
								$login_details = array('user_id'=>$user_data['site_user_id'],'user_type'=>"Center",'date'=>date('Y-m-d H:i:s'),'ip_address'=>$this->Home_model->get_client_ip());
								$this->Home_model->insert_values('login_details',$login_details);								
							redirect(base_url().'dance/center/index');
						}*/						
						else
						{ 
							redirect(base_url().'dance/admin/login/signout');
						}											
					}
					else
					{
						$this->session->set_flashdata('SucMessage', 'Incorrect Username and Password');
						redirect(base_url().'dance/syllabuslogin');
					}
				}
				
			}
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Login',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
		);
		
			//$chkLogin = $this->Home_model->checkLogin();	
			$this->setHomeHeader();
			$this->load->view('student_login_syllabus',$data);
			$this->load->view('footer');
	}
	
	public function registration( $type )
	{
			if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
			{
				redirect(base_url().'dance/student/index', 'refresh');
			}
			$data = array();
			$post_set		 		                	= $_POST;
		
			if (($this->input->server('REQUEST_METHOD') == 'POST')) 
			
			{
				
				
				$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[8]|max_length[20]');
				
				if($this->form_validation->run() 		== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages				= validation_errors();
				}else{
					
					$set_user_data = array(
							'username' 		 	 				=> addslashes(trim( $this->input->post('txtUsername') )),
							'password' 		 	 				=> addslashes(trim( $this->input->post('txtPassword') ) ),
						);
						
					$loginChk = $this->Home_model->checkLogin( $set_user_data );
					
					if(!empty($loginChk))
					{
					//echo '<pre>';print_r($loginChk);die;
						
						//Add User data to session
						
						if( !empty($loginChk->user_role_id) && $loginChk->user_role_id == 2)
						{ 
							$user_data = array('site_user_name' 	=> $loginChk->username,
											'profileName'			=> $loginChk->firstname.' '.$loginChk->lastname,
										   'site_user_id' 			=> $loginChk->user_id,
										   'site_email' 			=> $loginChk->email,
										   'site_user_role' 		=> $loginChk->user_role_id,
										   'site_user_role_name'	=> $loginChk->role_name,
										   'site_logged_in' 		=> true
										  );  
								$this->session->set_userdata($user_data);	
								$login_details = array('user_id'=>$user_data['site_user_id'],'user_type'=>"Student",'date'=>date('Y-m-d H:i:s'),'ip_address'=>$this->Home_model->get_client_ip());
								$this->Home_model->insert_values('login_details',$login_details);
							redirect(base_url().'dance/student/index');
						}
						elseif( !empty($loginChk->user_role_id) && $loginChk->user_role_id == 3)
						{ 
							$this->load->model('home/Center_model');
							$getAcademyData = $this->Center_model->getId('center_academy','username',trim($loginChk->username));
							//echo '<pre>';print_r($getAcademyData);die;
							$user_data = array('site_user_name' 	=> $loginChk->username,
											'profileName'			=> $getAcademyData->name,
										   'site_user_id' 			=> $loginChk->user_id,
										   'site_email' 			=> $loginChk->email,
										   'site_user_role' 		=> $loginChk->user_role_id,
										   'site_user_role_name'	=> $loginChk->role_name,
										   'center_academy_id'		=> $getAcademyData->center_academy_id,
										   'site_logged_in' 		=> true
										  );  
								$this->session->set_userdata($user_data);
								$login_details = array('user_id'=>$user_data['site_user_id'],'user_type'=>"Center",'date'=>date('Y-m-d H:i:s'),'ip_address'=>$this->Home_model->get_client_ip());
								$this->Home_model->insert_values('login_details',$login_details);								
							redirect(base_url().'dance/center/index');
						}						
						else
						{ 
							redirect(base_url().'dance/admin/login/signout');
						}											
					}
					else
					{
						$this->session->set_flashdata('SucMessage', 'Incorrect Username and Password');
						redirect(base_url().'dance/registration');
					}
				}
				
			}
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Login',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
		);
		
			//$chkLogin = $this->Home_model->checkLogin();	
			$this->setHomeHeader();
			$this->load->view('login',$data);
			$this->load->view('footer');
				
	}
	
	public function ourCenters()
	{
		$centers = $this->Home_model->getConnectedDataList('center_academy','center_director','center_academy_id','center_academy_id','');
		$data = array(
			'centers' => $centers
		);
		$this->setHomeHeader();
		$this->load->view('ourcenters',$data);
		$this->load->view('footer');
	}
	
	public function contactus()
	{
		$post_set 				= $_POST;
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['sendbutton']) && $_POST['sendbutton']=='Submit') ) {
			
			$this->form_validation->set_rules('contact_name', 'Name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('contact_phone', 'Phone', 'trim|required|min_length[10]');
			$this->form_validation->set_rules('contact_company', 'Company', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('contact_message', 'Message', 'trim|required|min_length[3]');		
			$this->form_validation->set_rules('contact_mail', 'Mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_country', 'Country', 'trim|required|min_length[2]');
			
			if($this->form_validation->run() == FALSE )
			{
				$post_set		 					= $_POST;
				$this->ErrorMessages		 		= validation_errors();
			}else{
				//echo '<pre>';print_r($_POST);die;
				$contact_name 		= trim($this->input->post('contact_name'));
				$contact_phone 		= trim($this->input->post('contact_phone'));
				$contact_company 	= trim($this->input->post('contact_company'));
				$contact_message 	= trim($this->input->post('contact_message'));
				$contact_mail 		= trim($this->input->post('contact_mail'));
				$contact_country 	= trim($this->input->post('contact_country'));
				
				$data = array(
					'name' 		=> $contact_name,
					'phone' 	=> $contact_phone,
					'company' 	=> $contact_company,
					'message' 	=> $contact_message,
					'country' 	=> $contact_country,
				);
				$this->load->helper(array('email'));
				$this->load->library(array('email'));
				$this->email->set_mailtype("html");
				
				
				//$data['sender_mail'] = 'thenmozhi@sanjaytechnologies.org';
				$mail = CUSTOMER_EMAIL;
				$this->load->library('email');
				$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
				$this->email->initialize($config);
				$this->email->from($contact_mail, $contact_name);
				$this->email->to($mail);
				$this->email->subject('Alagappaarts - Contactus');
				
				$message=$this->load->view('contact_mail',$data,TRUE);
				//echo $message;die;
				$this->email->message($message);
				//$this->email->send();
				
				$this->session->set_flashdata('SucMessage', 'Mail Sent Successfully. We will get back to you soon...');
				redirect(base_url().'dance/contact-us'); 
				
			}
		}
		
		$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					//'UploadError' 				 	=> $UploadError,
					//'alreadyErrorMessages'          => $alreadyErrorMessages,
					//'captcha_error'				=> $captcha_error,
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Contact us',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'post_set'						=> $post_set
			);
		$this->setHomeHeader();
		$this->load->view('contactus',$data);
		$this->load->view('footer');
	}
	
	public function gallery( $type )
	{
		if( isset($type) && !empty($type) && $type== 'photo'){
			$data = array();
			$this->setHomeHeader();
			$this->load->view('photo_gallery',$data);
			$this->load->view('footer');
		}else if( isset($type) && !empty($type) && $type == 'video')
		{
			$data = array();
			$this->setHomeHeader();
			$this->load->view('video_gallery',$data);
			$this->load->view('footer');
		}
		
		
	}
	
	public function pages( $arg )
	{
		if($this->session->userdata('site_logged_in') == true && $this->session->userdata('site_user_role') == '2' )
		{
			redirect(base_url().'dance/student/index', 'refresh');
		}
		//echo '<pre>';print_r($arg);
		$arg1 = $this->uri->segment(1);
		$arg2 = $this->uri->segment(2);
		
		$fetchArgument = '';
		if( isset($arg1) && !empty($arg1) && isset( $arg2 ) && !empty($arg2) && ($arg2!='apaa-programs' && $arg2 !='fee-structure' && $arg2 !='faq' && $arg2 !='photo-gallery' && $arg2 !='video-gallery' ))
		{
			$fetchArgument = $arg2;
		}else if( isset($arg1) && !empty($arg1) && isset($arg2) && !empty($arg2) && (($arg1=='events' && $arg2 =='faq') || ($arg1=='academics' && $arg2 =='faq')) ){
			//echo 'b';die; 
			$this->faq($arg1);
		}else if( isset($arg1) && !empty($arg1) && isset( $arg2 ) && !empty($arg2) && (($arg1=='academics') && ($arg2=='apaa-programs' || $arg2 =='fee-structure')) ){//else{ echo 'c';die;
			//echo 'c';die;
			$this->pgm_course($arg2);
			
		}else if( isset($arg1) && !empty($arg1) && isset( $arg2 ) && !empty($arg2) && (($arg1=='academics') && ($arg2=='photo-gallery')) ){//else{ echo 'c';die;
			//echo 'd';die;
			$this->gallery('photo');
			
		}else if( isset($arg1) && !empty($arg1) && isset( $arg2 ) && !empty($arg2) && (($arg1=='academics') && ($arg2=='video-gallery' )) ){//else{ echo 'c';die;
			//echo 'e';die;
			$this->gallery('video');
			
		}else if( isset($arg1) && !empty($arg1) && $arg1=='our-centers' && empty($arg2)){
			$this->ourCenters();
		}else if( isset($arg1) && !empty($arg1) && $arg1=='contact-us' && empty($arg2)){
			$this->contactus();
		}else if( isset($arg1) && !empty($arg1) && $arg1=='forgetpassword' && empty($arg2)){
			$this->forgetpassword();
		}else if( isset($arg1) && !empty($arg1) && $arg1=='studentforgetpassword' && empty($arg2)){
			$this->studentforgetpassword();
		}else if( isset($arg1) && !empty($arg1) && isset( $arg2 ) && !empty($arg2) && $arg1 == 'academics' && $arg2 == 'master-program'){
			$this->newMasterProgram();
		}else{
			$fetchArgument = ((isset($arg1) && !empty($arg1) && $arg1=='login') ? 'login' : $arg1);
		}
		/*$fetchArgument = ((isset( $arg2 ) && !empty($arg2) && ($arg2!='apaa-programs' && $arg2 !='fee-structure' && $arg2 !='faq' )) ? $arg2 :
		(( ( ($arg1=='academics' || $arg1=='events' || $arg1=='our-centers') && ($arg2=='apaa-programs' || $arg2 =='fee-structure' || $arg2 =='faq' )) ) ? '' : $arg1));
		*/
		if( isset( $fetchArgument ) && !empty($fetchArgument) )
		{ //echo 'a->'.$fetchArgument;die;
			if( $fetchArgument == 'login'){
				$this->registration();
			}else if($fetchArgument == 'master-program'){
			    $this->newMasterProgram();
			}else{
				$search = str_replace('-',' ',$fetchArgument);
			
			
				$page = $this->Home_model->getPages($search);	
				//echo '<pre>';print_r($page);die;			
					$data = array(
						'title' => $page->title,
						'page' => stripslashes($page->content)
					);
				//$this->load->view('header');
				$this->setHomeHeader();
				$this->load->view('pages',$data);
				$this->load->view('footer');
			}
		}
	}
	
	public function faq( $type )
	{
		$faq_type = '';
		if( isset($type) && !empty($type) && $type == 'academics')
		{
			$getFaqs = $this->Home_model->getFaq(1);
			$faq_type = 1;
		}
		if( isset($type) && !empty($type) && $type == 'events')
		{
			$getFaqs = $this->Home_model->getFaq(2);
			$faq_type = 2;
		}
		//echo '<pre>';print_r($getFaqs);die;
		$data = array(
			'getFaqs' 		=> $getFaqs,
			'faq_type'		=> $faq_type
		);
		$this->setHomeHeader();
		$this->load->view('faq',$data);
		$this->load->view('footer');
			
	}
	
	public function pgm_course( $type )
	{
		if( isset($type) && !empty($type) && $type == 'apaa-programs')
		{ //echo 'a';die;
			$pgmCourse = $this->Home_model->getProgramCourse();
			$pgmCourseArray = array();
			if( isset($pgmCourse) && !empty($pgmCourse))
			{
				foreach($pgmCourse as $k=> $pgmcrs)
				{
					$pgmCourseArray[$pgmcrs->program_id][] = $pgmcrs; 
				}
			}
			//echo '<pre>';print_r($pgmCourse);die;
			$data = array(
				'pgmCourse' => $pgmCourseArray
			);
			
			$this->setHomeHeader();
			$this->load->view('course',$data);
			$this->load->view('footer');
			
		}
		else if( isset($type) && !empty($type) && $type == 'fee-structure')
		{ //echo 'b';die;
			$pgmFeesList = $this->Home_model->getProgramFees();
			//echo '<pre>';print_r($pgmFeesList);die;
			/*$pgmFeesArray = $emptyArray = array();
			if( isset($pgmFeesList) && !empty($pgmFeesList))
			{
				foreach($pgmFeesList as $k=> $pgmfees)
				{
					$pgmFeesArray[$pgmfees->program_fees_id][] = $pgmfees; 
				}
			}*/
			//echo '<pre>';print_r($pgmFeesArray);die;
			$data = array(
				//"left_banner" => $this->load->view('left_banner',true),
				'pgmFees' => $pgmFeesList
			);
			
			$this->setHomeHeader();
			$this->load->view('course',$data);
			$this->load->view('footer');
			
		}
		
		
		
		
	}
	
	
	public function getLeftbanners()
	{
		$urlParams = $this->uri->segment(1);
		if( isset($urlParams) && !empty($urlParams))
		{
			$urlParams = ((isset($urlParams) && !empty($urlParams) && $urlParams == 'login') ? 'registration' : $urlParams);
			$getMenuList = $this->Home_model->menuList($urlParams);
			return $getMenuList;
		}
		
	}
	
	/*function strip_html_tags( $text )
	{
		$text = preg_replace(
			array(
			  // Remove invisible content
				'@<head[^>]*?>.*?</head>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
			  // Add line breaks before and after blocks
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );
		return strip_tags( $text );
	}*/
    
    public function newMasterProgram()
	{
		$this->setHomeHeader();
		$this->load->view('master-course');
		$this->load->view('footer');
	}
	
	
}
