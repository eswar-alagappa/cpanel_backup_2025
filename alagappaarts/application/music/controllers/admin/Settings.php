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


class Settings extends CI_Controller {
		
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/Settings_model');
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
	
	
	public function con_qes($param){
            if($param != ''){
                
             
                    $data = array('status'=>$param);
                
            $check = $this->Settings_model->update('con_qes', 'id',$data,'1');
            
           
             if($param == '1'){
						$this->session->set_flashdata('SucMessage', 'Condition disabled Successfully');
						redirect(base_url().'music/admin/students/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Condition Enabled Successfully');
						redirect(base_url().'music/admin/students/index'); 
					}   
           
            }
          
        }
	public function menu($type=null, $id=null)
	{
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		$post_set = $_POST;
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('name', 'Program name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('menutype', 'Description', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('link', 'Description', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					$set_menu_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('name') )),
							'parent_id' 		 	 				=> addslashes(trim( $this->input->post('parent_id') )),
							'type' 		 	 						=> addslashes(trim( $this->input->post('menutype') )),
							'link' 		 	 						=> mysql_real_escape_string(trim( $this->input->post('link') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->save('menu',$set_menu_data);
					if( isset($check) && !empty($check)){
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'music/admin/settings/menu'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/menu'); 
					}
				}
			}
			$menuType = array('link'=>'Link','page'=>'Page');
			$getParentMenu = $this->Settings_model->getListwithCondition('menu','parent_id',0);
			//echo '<pre>';print_r($getParentMenu);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Menu',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'menuType'						=> $menuType,
					'getParentMenu'					=> $getParentMenu,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/menu_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				
				$this->form_validation->set_rules('name', 'Program name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('menutype', 'Description', 'trim|required|min_length[1]');
				$this->form_validation->set_rules('link', 'Description', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$set_menu_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('name') )),
							'parent_id' 		 	 				=> addslashes(trim( $this->input->post('parent_id') )),
							'type' 		 	 						=> addslashes(trim( $this->input->post('menutype') )),
							'link' 		 	 						=> mysql_real_escape_string(trim( $this->input->post('link') )),
							'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->update( 'menu', 'menu_id',$set_menu_data,$id );
					if($check){
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'music/admin/settings/menu'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/menu'); 
					}
				}
			}
			$selectedValues = $this->Settings_model->getSelected('menu','menu_id', $id);
			$menuType = array('link'=>'Link','page'=>'Page');
			$getParentMenu = $this->Settings_model->getListwithCondition('menu','parent_id',0);
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Menu',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'menuType'						=> $menuType,
					'getParentMenu'					=> $getParentMenu,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/menu_edit',$data);
			$this->load->view('admin/footer');
			
		}if( !isset($type) && empty($type)){
			$menuList = $this->Settings_model->getList('menu');	
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Menu',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'menuList'						=> $menuList,
					//'tidyHTML'						=> $this->tidyHTML()
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/menu_list',$data);
			$this->load->view('admin/footer');
		}
		
		
	}
	
	public function pages($type=null, $id=null)
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('page_content', 'Description', 'trim|required|min_length[10]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$content1 = str_replace(">\r\n<", "><", trim( stripslashes( addslashes($this->input->post('page_content') ))));
					$content = str_replace("\r\n", "", trim( $content1 ));
					
					$set_page_data = array(						
							'title' 		 	 					=> addslashes(trim( $this->input->post('title') )),
							'content' 		 	 					=> mysql_real_escape_string( $content ),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->save('pages',$set_page_data);
					if( isset($check) && !empty($check)){
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'music/admin/settings/pages'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/pages'); 
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
			$this->load->view('admin/settings/page_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				
				$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('page_content', 'Description', 'trim|required|min_length[10]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$content1 = str_replace(">\r\n<", "><", trim( $this->input->post('page_content') ));
					$content = str_replace("\r\n", "", trim( $content1 ));
					$set_page_data = array(						
							'title' 		 	 					=> addslashes(trim( $this->input->post('title') )),
							'content' 		 	 					=>  mysql_real_escape_string( $content ),
							//'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);//echo '<pre>';print_r($set_page_data);die;
					$check = $this->Settings_model->update( 'pages', 'page_id',$set_page_data,$id );
					if($check){
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'music/admin/settings/pages'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/pages'); 
					}
				}
			}
			$selectedValues = $this->Settings_model->getSelected('pages','page_id', $id);
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Page',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/page_edit',$data);
			$this->load->view('admin/footer');
			
		}if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Settings_model->getSelected('pages','page_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Page',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,					
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/page_view',$data);
			$this->load->view('admin/footer');
		}if( !isset($type) && empty($type)){
			$pageList = $this->Settings_model->getList('pages');	
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Page',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'pageList'						=> $pageList,
					//'tidyHTML'						=> $this->tidyHTML()
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/page_list',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function feedback($type=null, $id=null)
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='reply' && isset($id) && !empty($id))
		{
			if(($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update')) {
				
				$this->form_validation->set_rules('reply', 'Reply', 'trim|required|min_length[3]');
				
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$set_feedback_data = array(						
							
							'reply'									=> addslashes( trim($this->input->post('reply') )),
							'status'								=> 'read',
							'replied_by'							=> 1,
							'updated_by'							=> 'Super Admin',
							'replied_on'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->update( 'feedback', 'feedback_id',$set_feedback_data,$id );
					if($check){
						$this->session->set_flashdata('SucMessage', 'Replied Successfully');
						redirect(base_url().'music/admin/settings/feedback'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/feedback/reply/'.$id); 
					}
				}
			}
			$selectedValues = $this->Settings_model->getSelected('feedback','feedback_id', $id);
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Feedback',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/feedback_reply',$data);
			$this->load->view('admin/footer');
			
		}
		if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$set_feedback_data = array(
				'status'								=> 'read',
			);
			$check = $this->Settings_model->update( 'feedback', 'feedback_id',$set_feedback_data,$id );
			
			$selectedValues = $this->Settings_model->getSelected('feedback','feedback_id', $id); //echo '<pre>';print_r($selectedValues);die;
			
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Feedback',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,	
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/feedback_view',$data);
			$this->load->view('admin/footer');
		}
		if( !isset($type) && empty($type)){
			
			$feedback = $this->Settings_model->getList('feedback');
			$data = array(
						'ErrorMessages'					=> $this->ErrorMessages,
						'ErrorMessage'					=> '',
						'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
						'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Feedback',
						'SiteMainTitle' 				=> $this->SiteMainTitle,
						'type'							=> $type,
						'feedback'						=> $feedback
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/feedback_list',$data);
			$this->load->view('admin/footer');
		}
	}
	
	public function faq($type=null, $id=null)
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		if( isset($type) && !empty($type) && $type=='add')
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('faq_content', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('type_id', 'Type', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					
					$faq_title1 = str_replace(">\r\n<", "><", trim( stripslashes( addslashes($this->input->post('title') ))));
					$faq_title = str_replace("\r\n", "", trim( $faq_title1 ));
					
					$faq_content1 = str_replace(">\r\n<", "><", trim( stripslashes( addslashes($this->input->post('faq_content') ))));
					$faq_content = str_replace("\r\n", "", trim( $faq_content1 ));
					
					$set_page_data = array(						
							'title' 		 	 					=> mysql_real_escape_string( $faq_title ),
							'content' 		 	 					=> mysql_real_escape_string( $faq_content ),
							'type'									=> addslashes( trim($this->input->post('type_id') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->save('faq',$set_page_data);
					if( isset($check) && !empty($check)){
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'music/admin/settings/faq'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/faq'); 
					}
				}
			}
			
			$type = array('1'=>'Academics','2'=>'Events');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Faq',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'type'							=> $type,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/faq_add',$data);
			$this->load->view('admin/footer');
		}
		if( isset($type) && !empty($type) && $type=='update' && isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				
				$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('faq_content', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('type_id', 'Type', 'trim|required|min_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$faq_title1 = str_replace(">\r\n<", "><", trim( $this->input->post('title') ));
					$faq_title = str_replace("\r\n", "", trim( $faq_title1 ));
					
					$faq_content1 = str_replace(">\r\n<", "><", trim( $this->input->post('faq_content') ));
					$faq_content = str_replace("\r\n", "", trim( $faq_content1 ));
					
					$set_page_data = array(						
							'title' 		 	 					=> mysql_real_escape_string( $faq_title ),
							'content' 		 	 					=> mysql_real_escape_string( $faq_content ),
							'type'									=> addslashes( trim($this->input->post('type_id') )),
							//'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Settings_model->update( 'faq', 'faq_id',$set_page_data,$id );
					if($check){
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'music/admin/settings/faq'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/settings/faq'); 
					}
				}
			}
			$selectedValues = $this->Settings_model->getSelected('faq','faq_id', $id);
			$type = array('1'=>'Academics','2'=>'Events');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Faq',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,
					'arg'							=> $id,
					'type'							=> $type,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/faq_edit',$data);
			$this->load->view('admin/footer');
			
		}if( isset($type) && !empty($type) && $type=='view' && isset($id) && !empty($id))
		{
			$selectedValues = $this->Settings_model->getSelected('faq','faq_id', $id); //echo '<pre>';print_r($selectedValues);die;
			$type = array('1'=>'Academics','2'=>'Events');
			$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Faq',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'selectedValues'				=> $selectedValues,	
				'type'							=> $type	
				);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/faq_view',$data);
			$this->load->view('admin/footer');
		}if( !isset($type) && empty($type)){
			$faqList = $this->Settings_model->getList('faq');	
			$faqtype = array('1'=>'Academics','2'=>'Events');
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Faq',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'faqList'						=> $faqList,
					'faqtype'							=> $faqtype
					//'tidyHTML'						=> $this->tidyHTML()
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/settings/faq_list',$data);
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
				$this->form_validation->set_rules('exam_duration_hours', 'Exam Duration Hours', 'trim|required|max_length[2]');
				$this->form_validation->set_rules('exam_duration_mins', 'Exam Duration Mins', 'trim|required|max_length[2]');	
				$this->form_validation->set_rules('exam_attempt_limit', 'Exam Attempt Limit', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('partition[]', 'Partition', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('question_type[]', 'Question type', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('no_of_question[]', 'No of Question', 'trim|required');
				
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
							'created_on'							=> date('Y-m-d H:i:s'),
							'updated_on'							=> date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($set_course_data);die;
					$check = $this->Master_model->save('courses',$set_course_data);
					if( isset($check) && !empty($check)){
						$another_check = $this->Master_model->Another_save('course_exam',$check, $_POST);
						if( isset($another_check) && !empty($another_check)){
							$this->session->set_flashdata('SucMessage', 'Successfully created');
							redirect(base_url().'music/admin/master/courses'); 
						}
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/courses'); 
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
							'updated_on'							=> date('Y-m-d H:i:s'),
					);
					$check = $this->Master_model->update( 'courses', 'course_id',$set_course_data,$id );
					if($check){
						$another_check = $this->Master_model->Another_update('course_exam','course_id',$check, $_POST);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'music/admin/master/courses'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/master/courses'); 
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
			
		}if( !isset($type) && empty($type)){
			
			$courseList = $this->Master_model->getList('courses');	
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Courses',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'courseList'					=> $courseList
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/master/course_list',$data);
			$this->load->view('admin/footer');
		}
		
	}	
	
	
	public function status( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'pages'){
				$table = 'pages';$key_field = 'page_id';$status_field = 'status';
			}
			if( $process == 'faq'){
				$table = 'faq';$key_field = 'faq_id';$status_field = 'status';
			}
			if( $process == 'menu'){
				$table = 'menu';$key_field = 'menu_id';$status_field = 'status';
			}
			if( $process == 'courses'){
				$table = 'courses';$key_field = 'course_id';$status_field = 'status';
			}
			$getRes = $this->Settings_model->changeStatus($table, $key_field, $status_field, $arg);
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
				redirect(base_url().'music/admin/settings/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'music/admin/settings/'.$process); 
			}
		}
	}
	
	public function remove( $process, $arg )
	{
		if(isset($process) && !empty($process) && isset($arg) &&!empty($arg))
		{
			if( $process == 'pages'){
				$table = 'pages';$key_field = 'page_id';
			}
			if( $process == 'faq'){
				$table = 'faq';$key_field = 'faq_id';
			}
			if( $process == 'menu'){
				$table = 'menu';$key_field = 'menu_id';
			}
			if( $process == 'courses'){
				$table = 'courses';$key_field = 'course_id';
			}
			if( $process == 'feedback'){
				$table = 'feedback';$key_field = 'feedback_id';
			}
			$getRes = $this->Settings_model->remove($table, $key_field,$arg);
			if( $process == 'courses'){
				$getRes1 = $this->Settings_model->remove('course_exam', 'course_id',$arg);
			}
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully deleted');
				redirect(base_url().'music/admin/settings/'.$process); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'music/admin/settings/'.$process); 
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

