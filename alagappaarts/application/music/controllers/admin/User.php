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


class User extends CI_Controller {
		
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/User_model');
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
	
	public function add()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}
		$post_set		 		                	= $_POST;
		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|min_length[3]|max_length[60]');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[3]|max_length[60]');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[60]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[100]');	
			$this->form_validation->set_rules('user_role', 'User role', 'trim|required|min_length[1]');				
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[8]|max_length[20]');
			
			if($this->form_validation->run() 			== FALSE)
			{
				$post_set		 					= $_POST;
				$this->ErrorMessages		 		= validation_errors();
			}else{
				//echo '<pre>';print_r($_POST);die;
				
				$set_user_data = array(						
					'username' 		 	 						=> addslashes(trim( $this->input->post('username') )),
					'email_id' 		 	 						=> addslashes(trim( $this->input->post('email') )),
					'password' 		 	 						=> md5(addslashes( trim( $this->input->post('password') ) )),
					'fb_user_role_id'							=> addslashes(trim( $this->input->post('user_role') )),
					'user_status'								=> 1,
					'createdby'									=> 'Super Admin',
					'createdat'									=> date('Y-m-d H:i:s'),
					'updatedat'									=> date('Y-m-d H:i:s'),
					'user_status'								=> '1'
				);
				$set_user_profile_data = array(
					'user_first_name' 		 	 				=> addslashes(trim( $this->input->post('firstname') )),
					'user_last_name' 		 	 				=> addslashes(trim( $this->input->post('lastname') )),
					'user_status'								=> 1,
				);
				$check = $this->User_model->saveUserAccount( $set_user_data,$set_user_profile_data );
				if($check==true){
					$this->session->set_flashdata('SucMessage', 'Successfully created account');
					redirect(base_url().'music/admin/user'); 
				}else{
					$this->session->set_flashdata('SucMessage', 'Invalid Details');
					redirect(base_url().'music/admin/user'); 
				}
					
					 
			}
			
		}
			$userRole = $this->User_model->getUserRole();
			//echo '<pre>';print_r($userRole);die;
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel User - Add',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set,
				'user_role'						=> $userRole
		);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/user/add',$data);
		$this->load->view('admin/footer');
		
	}
	
	public function status($arg)
	{
		if(!empty($arg))
		{
			$getRes = $this->User_model->changeStatus($arg);
			if($getRes==true){
				$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
				redirect(base_url().'music/admin/user'); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'music/admin/user'); 
			}
		}
	}
	
	
	
}

