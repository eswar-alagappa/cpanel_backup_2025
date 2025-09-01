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


class Login extends CI_Controller {
	
	public  $SiteMainTitle							='Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->model('admin/User_model');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
			/*if( $this->uri->segments[count($this->uri->segments)] != 'signout' ){
				if( $this->session->userdata('admin_logged_in') ){
					redirect('admin/user');
				}
			}*/
			
	}
	
	public function index()
	{
            
//            print_r($_POST);
//            
//            exit();
		
		$admin_logged_in = $this->session->userdata('admin_logged_in');
		
        if ( isset($admin_logged_in) && $admin_logged_in == false)
        {
            redirect(base_url().'music/admin/login');die;
        }
		else if ( isset($admin_logged_in) && $admin_logged_in == 1)
        { 
            redirect(base_url().'music/admin/master/dashboard');die;
        }
		$post_set		 		                	= $_POST;
		
		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]');
			
			if($this->form_validation->run() 		== FALSE)
			{
				$post_set		 					= $_POST;
				$this->ErrorMessages				= validation_errors();
			}else{
				
				$set_user_data = array(
						'username' 		 	 				=> addslashes(trim( $this->input->post('username') )),
						'password' 		 	 				=> addslashes(trim( $this->input->post('password') ) ),
					);
					
				$loginChk = $this->User_model->userLoginChk( $set_user_data );
				if(!empty($loginChk))
				{
					
				//echo '<pre>';print_r($loginChk);die;
                //$this->session->sess_create();
					$user_data = array('admin_user_name' 		=> $loginChk->username,
									   'admin_user_id' 			=> $loginChk->user_id,
									   'admin_email' 			=> $loginChk->email,
									   'admin_user_role' 		=> $loginChk->user_role_id,
									   'admin_user_role_name'	=> $loginChk->role_name,
									   'admin_logged_in' 		=> true
									  );  
					//Add User data to session
					$this->session->set_userdata($user_data);
					
					if( !empty($loginChk->user_role_id) && $loginChk->user_role_id ==1){ 
						redirect(base_url().'music/admin/user');
					}else{ 
						redirect(base_url().'music/admin/login/signout');
					}
				
					
				}else{
					$this->session->set_flashdata('SucMessage', 'Invalid Details');
					redirect(base_url().'music/admin/login');
				}
			}
			
		}
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Login',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
		);
			
		$this->load->view('admin/login',$data);
	}
	
	 public function signout(){ 
        $user_data = array('admin_user_name' => '',
                           'admin_user_id' => '',
                           'admin_email' => '',
                           'admin_logged_in' => 0);
        $this->session->unset_userdata($user_data);
        unset($_SESSION['admin_log']);
		$this->session->sess_destroy();
        redirect(base_url().'music/admin/login');
    }
	
	public function register()
	{	
		$post_set		 		                	= $_POST;
		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			
			
			//$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|min_length[3]|max_length[60]|callback_alphabetValid');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[60]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[100]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[8]|max_length[20]');
			
			if($this->form_validation->run() 			== FALSE)
			{
				$post_set		 					= $_POST;
				$this->ErrorMessages		 		= validation_errors();
			}else{
					$set_user_data = array(
						'username' 		 	 				=> addslashes(trim( $this->input->post('username') )),
						'email_id' 		 	 				=> addslashes(trim( $this->input->post('email') )),
						'password' 		 	 				=> md5(addslashes( trim( $this->input->post('password') ) )),
						'createdby'								=> 'Super Admin',
						'createdat'								=> date('Y-m-d H:i:s'),
						'updatedat'								=> date('Y-m-d H:i:s'),
						'user_status'							=> '1'
					 );
					 
					$check = $this->User_model->saveUserAccount( $set_user_data );
					if($check==true){
						$this->session->set_flashdata('SucMessage', 'Successfully created account');
						redirect(base_url().'music/admin/login'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'music/admin/login'); 
					}
			}
			
		}
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Register',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'post_set'						=> $post_set
		);
			
		$this->load->view('admin/login',$data);
	}
	
	public function alphabetValid( $str)
	{
	         $first_ch = substr($str,0,1);
                if ( ! preg_match("/^([a-z A-Z .])+$/i", $str) )
                {
                    //set your error message here
                   $this->form_validation->set_message('alphabetValid','Given Field should be Alphabet');
                    return FALSE;
                }
                else
            return TRUE;
	}
	
	
}

