<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center extends CI_Controller {

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
			$this->load->model('home/Center_model');
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
	}	
	
	public function checkOldPass( $str )
	{
		$user_id = $this->session->userdata('site_user_id');
		$oldPass = $this->encode($str);
		$check = $this->Center_model->checkPassword($oldPass,$user_id);
		if( !empty($check))
		{
			return true;
		}else{
			$this->form_validation->set_message('checkOldPass', 'The %s field has wrong. please enter correct password ');
			return false;
		}
	}
	
	public function students_excel()
	{ 
			$this->load->library("Excel");

			$this->load->model("home/Home_model");

			$username = $this->session->userdata('site_user_name');
			$center_academy_id = $this->session->userdata('center_academy_id');
			
			$data = $this->Home_model->getStudentDetails($username,$center_academy_id);
			//echo '<pre>data->';print_r($data);die;
			$this->excel->setActiveSheetIndex(0);
			$this->excel->stream( $username.'_center_student_listing.xls', $data);
		
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
				
				 $check = $this->Center_model->update('users','user_id',$set_user_data,$user_id);
				 if( isset($check) && !empty($check)){
					$this->session->set_flashdata('SucMessage', 'Successfully created');
					redirect(base_url().'dance/center/profile'); 
				}else{
					$this->session->set_flashdata('SucMessage', 'Invalid Details');
					redirect(base_url().'dance/center/change_password'); 
				}
				
			}
		}
		$data = array(
			'post_set'	=> $post_set
		);
		
		$this->load->view('center/header');	
		$this->load->view('center/change_password',$data);
		$this->load->view('center/footer');
	}
	
	public function edit_profile()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$user_id = $this->session->userdata('site_user_id');
		$center_academy_id = $this->session->userdata('center_academy_id');
		$post_set 				= $_POST;
		if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['btnCenteredit']) && $_POST['btnCenteredit']=='Update') ) {
				$this->form_validation->set_rules('txtAcademyname', 'Academy Name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtacademyEmail', 'Academy Email', 'trim|required|valid_email');	
				$this->form_validation->set_rules('txtPhonedaytime', 'Phone Day Time', 'trim|required|min_length[8]|max_length[15]');
				$this->form_validation->set_rules('txtAcademycity', 'City', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtAcademystate', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtAcademycountry', 'Country', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtAcademyzipcode', 'Zipcode', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtDirectorname', 'Director Name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtDirectordob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('txtDirectorEmail', 'Director Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('txtDirectorstate', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtDirectorcountry', 'Country', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('txtDirectorzip', 'zipcode', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() == FALSE )
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
						//echo '<pre>';print_r($_POST);die;
						$set_academy_data = array(		
								'name' 		 	 							=> addslashes(trim( $this->input->post('txtAcademyname') )),
								'email' 		 	 						=> addslashes(trim( $this->input->post('txtacademyEmail') )),
								'website' 		 	 						=> addslashes(trim( $this->input->post('txtWebsite') )),
								//'contact' 		 	 						=> addslashes(trim( $this->input->post('txtPhonedaytime') )),
								'alternate_contact' 		 	 			=> addslashes(trim( $this->input->post('txtAlternatephoneno') )),
								'no_of_establishment' 		 	 			=> addslashes(trim( $this->input->post('txtYearofestablishment') )),
								'no_of_arangetram' 		 	 				=> addslashes(trim( $this->input->post('txtNumberarangetrams') )),
								'address' 		 	 						=> addslashes(trim( $this->input->post('txtAcademyaddress') )),
								'city' 		 	 							=> addslashes(trim( $this->input->post('txtAcademycity') )),
								'state' 		 	 						=> addslashes(trim( $this->input->post('txtAcademystate') )),
								'country' 		 	 						=> addslashes(trim( $this->input->post('txtAcademycountry') )),
								'zip' 		 	 							=> addslashes(trim( $this->input->post('txtAcademyzipcode') )),
								'updated_by'								=> 'User',
								'updated_at'								=> date('Y-m-d H:i:s'),
						);
						
						$set_director_data = array(		
								'name' 		 	 							=> addslashes(trim( $this->input->post('txtDirectorname') )),
								'dob' 		 	 							=> addslashes(trim( date('Y-m-d',strtotime($this->input->post('txtDirectordob'))) )),
								'email' 		 	 						=> addslashes(trim( $this->input->post('txtDirectorEmail') )),
								'special_qualification' 		 	 		=> addslashes(trim( $this->input->post('txtDirectorspecialqualifications') )),
								'address' 		 	 						=> addslashes(trim( $this->input->post('txtDirectoraddress') )),
								'state' 		 	 						=> addslashes(trim( $this->input->post('txtDirectorstate') )),
								'country' 		 	 						=> addslashes(trim( $this->input->post('txtDirectorcountry') )),
								'zip' 		 	 							=> addslashes(trim( $this->input->post('txtDirectorzip') )),
								'experience_bharathanatiyam' 		 	 	=> addslashes(trim( $this->input->post('txtExperienceinBhar') )),
								'events_performance' 		 	 			=> addslashes(trim( $this->input->post('txtEvents') )),
								'award_title' 		 	 					=> addslashes(trim( $this->input->post('txtAwarsds') )),
								'ballets_choreographed' 		 	 		=> addslashes(trim( $this->input->post('txtBalletschoreographed') )),
								'master_name' 		 	 					=> addslashes(trim( $this->input->post('txtGuruname') )),
								'located_at' 		 	 					=> addslashes(trim( $this->input->post('txtguruLocatedat') )),
								'other_relevant_info' 		 	 			=> addslashes(trim( $this->input->post('txtOtherInfo') )),
								
								'updated_by'								=> 'User',
								'updated_at'								=> date('Y-m-d H:i:s'),
						);
						 
						 $check = $this->Center_model->update('center_academy','center_academy_id',$set_academy_data,$center_academy_id);
						if( isset($check) && !empty($check)){
							$another_check = $this->Center_model->update('center_director','center_academy_id',$set_director_data,$center_academy_id);
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'dance/center/profile'); 
						}else{
							$this->session->set_flashdata('SucMessage', 'Invalid Details');
							redirect(base_url().'dance/center/edit_profile'); 
						}
						 
				}
			
		}
		
		$userData = array();
		if( isset($user_id) && !empty($user_id))
		{
			$userData = $this->Center_model->getData( 'users','center_academy','center_director','user_id',$user_id);
			//echo '<pre>';print_r($userData);die;
		}
		
		$data = array(
			'user_data' => $userData,
			'post_set'	=> $post_set
		);
		
		$this->load->view('center/header');	
		$this->load->view('center/update_profile',$data);
		$this->load->view('center/footer');
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
			$userData = $this->Center_model->getData( 'users','center_academy','center_director','user_id',$user_id);
			//echo '<pre>';print_r($userData);die;
		}
		
		$data = array(
			'user_data' => $userData
		);
		
		$this->load->view('center/header');	
		$this->load->view('center/profile',$data);
		$this->load->view('center/footer');
	}
	
	
	public function index()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$center_id = $this->session->userdata('center_academy_id');
		$exam_schedule = $paymentList = $examResult = array();
		if( isset($center_id) && !empty($center_id))
		{
			$examSchedule 		= $this->Center_model->examScheduleCnt($center_id);
			$paymentList 		= $this->Center_model->PaymentList($center_id,5,0);
			$examResult 		= $this->Center_model->examResultCnt($center_id);
		}
		//echo '<pre>';print_r($paymentList);die;
		$data = array(
				'examSchedule'	=> $examSchedule,
				'paymentList'	=> $paymentList,
				'examResult'	=> $examResult
			);
		$this->load->view('center/header');
		//$this->setHomeHeader();
		$this->load->view('center/dashboard',$data);
		$this->load->view('center/footer');
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
	
	public function uniqueUsername( $str )
	{
		$check = $this->Center_model->checkUsername($str);
		if( !empty($check))
		{	
			$this->form_validation->set_message('uniqueUsername', 'The %s field has unique. please enter another username ');
			return false;				
		}else{
			return true;
		}
	}
	
	public function exam_result()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		
		$center_id = $this->session->userdata('center_academy_id');
		$config['per_page'] = '10';
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';
		if( isset($center_id) && !empty($center_id))
		{
			$examResult = $this->Center_model->examResult($center_id,$config['per_page'], $data['page']);
			$examResultCnt = $this->Center_model->examResultCnt($center_id);
		}
		
		//echo '<pre>';print_r($examResult );die;
		
		/* pagination */
		//pagination settings
        $config['base_url'] = site_url('dance/center/exam_result');
        $config['total_rows'] = count($examResultCnt);
        
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        
		/* end */ 
		
		$data = array(
				'page' 			=> ($this->uri->segment(3)) ? $this->uri->segment(3) : '0',
				'examResult'	=> $examResult,
				'pagination' 	=> $this->pagination->create_links( )
			);
		$this->load->view('center/header');
		//$this->setHeader();
		$this->load->view('center/exam_result',$data);
		$this->load->view('center/footer');
		
	}
	
	public function exam_schedule()
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$center_id = $this->session->userdata('center_academy_id');
		$config['per_page'] = '10';
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';
		if( isset($center_id) && !empty($center_id))
		{
			$examSchedule 		= $this->Center_model->examSchedule($center_id,$config['per_page'], $data['page']);
			$examScheduleCnt 	= $this->Center_model->examScheduleCnt($center_id);
		}
		//echo '<pre>';print_r($examSchedule);die;
		
		/* pagination */
		//pagination settings
        $config['base_url'] = site_url('dance/center/exam_schedule');
        $config['total_rows'] = count($examScheduleCnt);
        
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        
		/* end */ 
		
		$data = array(
				'page' 			=> ($this->uri->segment(3)) ? $this->uri->segment(3) : '0',
				'examSchedule'	=> $examSchedule,
				'pagination' 	=> $this->pagination->create_links( )
			);
		$this->load->view('center/header');
		//$this->setHeader();
		$this->load->view('center/exam_schedule',$data);
		$this->load->view('center/footer');
		
	}
	
	
	public function student_view($arg)
	{
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		if( isset($arg) && !empty($arg))
		{
			$this->load->model('home/Student_model');
			$programList 			= $this->Student_model->getConnectedDataList('programs','user_program','program_id','user_id',$arg);
			
			if( isset($programList) && !empty($programList) && count($programList)>0){
				$reversePgm = array_reverse($programList);
				$program_id = $reversePgm[0]->program_id;
			}
			
			$program_enroll 		= $this->Student_model->getPaymentData($arg,null);
			$paymentListArray 		= $this->Student_model->PaymentList($arg,$program_id);
			$examTaken 				= $this->Student_model->examTaken($arg,$program_id);
			$personal 				= $this->Center_model->studentPersonal($arg);
			//echo '<pre>';print_r($paymentListArray);die;
			$data = array(
				'personal' 			=> $personal,
				'programList' 		=> $programList,
				'pgmEnroll' 		=> $program_enroll[0],
				'paymentList' 		=> $paymentListArray[0],
				'examTaken'			=> $examTaken,
				'user_id'			=> $arg
			);
			$this->load->view('center/header');
			//$this->setHeader();
			$this->load->view('center/student_view',$data);
			$this->load->view('center/footer');
		}
	}
	
	
	public function students()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$studentList = array();
		$center_id = $this->session->userdata('center_academy_id');
		$config['per_page'] = '10';
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';
		if( isset($center_id) && !empty($center_id))
		{
			$studentList 		= $this->Center_model->StudentList($center_id,$config['per_page'], $data['page']);
			$studentListCnt 	= $this->Center_model->StudentListCnt($center_id);
		}
		//echo '<pre>';print_r($studentList);die;
		
		
		/* pagination */
		//pagination settings
        $config['base_url'] = site_url('dance/center/students');
        $config['total_rows'] = count($studentListCnt);
        
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        
		/* end */ 
		
		$data = array(
				'page' 			=> ($this->uri->segment(3)) ? $this->uri->segment(3) : '0',
				'studentList'	=> $studentList,
				'pagination' 	=> $this->pagination->create_links( )
			);
		$this->load->view('center/header');
		//$this->setHeader();
		$this->load->view('center/students',$data);
		$this->load->view('center/footer');
	}
	
	public function payments()
	{	
		if($this->session->userdata('site_logged_in') == false){
			redirect(base_url().'dance', 'refresh');
		}
		$paymentList = $paymentListCnt = array();
		$center_id = $this->session->userdata('center_academy_id');
		$config['per_page'] = '10';
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : '0';
		if( isset($center_id) && !empty($center_id))
		{
			
			$paymentList 		= $this->Center_model->PaymentList($center_id,$config['per_page'], $data['page']);
			$paymentListCnt 	= $this->Center_model->PaymentListCnt($center_id);
		}
		//echo count($paymentListCnt);//echo '<pre>';print_r($paymentList );
		/* pagination */
		//pagination settings
        $config['base_url'] = site_url('dance/center/payments');
        $config['total_rows'] = count($paymentListCnt);
        
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        
		/* end */ 
		
		$data = array(
				'page' 			=> ($this->uri->segment(3)) ? $this->uri->segment(3) : '0',
				'paymentList'	=> $paymentList,
				'pagination' 	=> $this->pagination->create_links( )
			);
			
		$this->load->view('center/header');
		//$this->setHeader();
		$this->load->view('center/payments',$data);
		$this->load->view('center/footer');
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
		
		
		$post_set 				= $_POST;
		$UploadError 			= '';
		$alreadyErrorMessages	= '';
		$captcha_error			= '';
		
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Register') ) {
				//echo '<pre>post->';print_r($_POST);//echo '<pre>session->';print_r($_SESSION);die;
				
				$this->form_validation->set_rules('academy_name', 'Academy Name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('academy_address', 'Academy Address', 'trim|required|min_length[3]');
				
				//$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUsername');
				$this->form_validation->set_rules('academy_email', 'Academy Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('academy_city', 'Academy City', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('academy_state', 'Academy State', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('academy_phone', 'Academy Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('academy_country', 'Academy Country', 'trim|required|min_length[2]|max_length[100]');
				$this->form_validation->set_rules('academy_zip', 'Academy Zipcode', 'trim|required|min_length[2]');
				$this->form_validation->set_rules('director_name', 'Director name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_address', 'Director Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_dob', 'Director Date of birth', 'trim|required');
				$this->form_validation->set_rules('director_state', 'Director State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_email', 'Director Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('director_country', 'Director Country', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_zip', 'Director Zipcode', 'trim|required|min_length[3]');
				
				
				/* $fileName = $flag = '';
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
                                                        
                                                                $_POST['uploadImage'] = $post_set['uploadImage'] = 'thumb_'.$fileName;
																unlink('../assets/profile/'.$fileName);
                                                        //}
                                                }
                                                
                                        }
                                }*/
								
					
				if($this->form_validation->run() == FALSE )
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>123->';print_r($_POST);die;//echo '<pre>';print_r($_POST);die;
					
					$set_user_data = array(						
							//'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'password' 		 	 					=> addslashes(trim( $this->encode($this->randomPassword()) )),	
							'user_role_id'							=> 3,
							'status'								=> 0,
							'created_by'							=> 'User',
							'updated_by'							=> 'User',
							'created_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 $center_user_id = $this->Center_model->save('users',$set_user_data);
					 
					 if($this->input->post('academy_no_of_arrangetram') == ''){
					     $no_of_arangetram = 0;
					 }else{
					     $no_of_arangetram = $this->input->post('academy_no_of_arrangetram');
					 }
					 
					 if($this->input->post('academy_year_of_establishment') == ''){
					     $no_of_establishment = 0;
					 }else{
					     $no_of_establishment = $this->input->post('academy_year_of_establishment');
					 }
					 
					$set_academy_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('academy_name') )),
							'center_user_id' 		 	 			=> ((isset($center_user_id) && !empty($center_user_id)) ? $center_user_id : ''),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'address' 		 	 					=> addslashes(trim( $this->input->post('academy_address') )),
							'website' 		 	 					=> addslashes(trim( $this->input->post('academy_website') )),
							'contact' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'alternate_contact' 		 	 		=> addslashes(trim( $this->input->post('academy_alternate_phone') )),
							'city' 		 	 						=> addslashes(trim( $this->input->post('academy_city') )),
							'state' 		 	 					=> addslashes(trim( $this->input->post('academy_state') )),
							'country' 		 	 					=> addslashes(trim( $this->input->post('academy_country') )),
							'zip' 		 	 						=> addslashes(trim( $this->input->post('academy_zip') )),
							'no_of_arangetram' 		 	 			=> addslashes(trim( $no_of_arangetram )),
							'no_of_establishment	' 		 	 	=> addslashes(trim( $no_of_establishment )),
							'status'								=> 0,
							'created_by'							=> 'User',
							'updated_by'							=> 'User',
							'created_at'							=> date('Y-m-d H:i:s'),
					);
					
					$set_directory_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('director_name') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('director_email') )),
							'dob' 		 	 						=> addslashes(trim( date('Y-m-d',strtotime( $this->input->post('director_dob'))) )),
							'address' 		 	 					=> addslashes(trim( $this->input->post('director_address') )),							
							'state' 		 	 					=> addslashes(trim( $this->input->post('director_state') )),
							'country' 		 	 					=> addslashes(trim( $this->input->post('director_country') )),
							'zip' 		 	 						=> addslashes(trim( $this->input->post('director_zip') )),
							'special_qualification' 		 	 	=> addslashes(trim( $this->input->post('director_special_qualification') )),
							'experience_bharathanatiyam	' 		 	=> addslashes(trim( $this->input->post('exp_bharatanatyam') )),
							'master_name' 		 	 				=> addslashes(trim( $this->input->post('name_of_guru') )),
							'events_performance	' 		 	 		=> addslashes(trim( $this->input->post('events_performance') )),
							'located_at' 		 	 				=> addslashes(trim( $this->input->post('located_at') )),
							'award_title	' 		 	 			=> addslashes(trim( $this->input->post('awards_title') )),
							'other_relevant_info' 		 	 		=> addslashes(trim( $this->input->post('other_relevant_info') )),
							'ballets_choreographed	' 		 	 	=> addslashes(trim( $this->input->post('ballets_choreograph') )),
							'created_by'							=> 'User',
							'updated_by'							=> 'User',
							'created_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					 
					 
					$check = $this->Center_model->save('center_academy',$set_academy_data);
					
					if( isset($check) && !empty($check)){
						$another_check = $this->Center_model->Another_save('center_director',$check,'center_academy_id',$set_directory_data);
						
						$content = '
Greetings from APAA! Your request for registering as APAA Dance Center has been successfully completed. The APAA customer support team will get back to you shortly.';
						$subject = 'Greetings from APAA!';
						$user_data = array(
							'firstname'	=> addslashes(trim( $this->input->post('academy_name') )),
							'lastname'	=> '',
							'email'		=> addslashes(trim( $this->input->post('academy_email') ))
						);
						$this->common_mail($user_data,$content,$subject,false);
						
						$this->session->set_flashdata('SucMessage', 'Thanks for your Registration. Please wait for Admin approval');
						redirect(base_url().'dance/center/registration'); 
					}else{
						$this->session->set_flashdata('ErrMessage', 'Invalid Details');
						redirect(base_url().'dance/center/registration'); 
					}
				}
			}
			$programs = $this->Center_model->getListactiveState('programs');
			$sreatm = array('Fast Track'=>'Fast Track','Noraml'=>'Noraml');
			$centers = $this->Center_model->getListactiveState('center_academy');
			
			
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
		$this->load->view('center/registration',$data);
		$this->load->view('center/footer');
	}
	
	public function test()
	{
		echo $this->decode('Nz_72168A6ukDAoOhtsjJpLKetrBlmxeDgB--0n2p3Y');
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
	
	
	public function getLeftbanners()
	{
		$this->load->model('home/Home_model');
		$urlParams = $this->uri->segment(1);
		if( isset($urlParams) && !empty($urlParams))
		{	
			$url = (( $urlParams == 'center' ) ? 'registration' : $urlParams );
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
