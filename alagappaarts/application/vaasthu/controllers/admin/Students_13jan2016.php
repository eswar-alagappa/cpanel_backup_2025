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
			redirect(base_url().'admin/login/', 'refresh');
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

	public function add()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'dance/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		
			if (($this->input->server('REQUEST_METHOD') == 'POST') && empty($arg) && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');		
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
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
							'program_id' 		 	 						=> addslashes(trim( $this->input->post('program_id') )),
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
							'password' 		 	 					=> addslashes(trim( md5($this->randomPassword()) )),	
							'user_role_id'							=> 2,
							'status'								=> 0,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					$check = $this->Student_model->save('users',$set_user_data);
					if( isset($check) && !empty($check)){
						$another_check = $this->Student_model->Another_save('user_profiles',$check,'user_id',$set_userprofile_data);
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'dance/admin/students'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/students'); 
					}
				}
			}
			$programs = $this->Student_model->getListactiveState('programs');
			$sreatm = array('Fast Track'=>'Fast Track','Noraml'=>'Noraml');
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
			redirect(base_url().'dance/admin/login/', 'refresh');
		}
		
		$post_set = $_POST;
		
		
		if( isset($id) && !empty($id))
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST') && !empty($id) && (!empty($_POST['update']) && $_POST['update']=='Update') ) {
				$this->form_validation->set_rules('first_name', 'Firstname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('last_name', 'Lastname', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');		
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
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
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
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
							'program_id' 		 	 						=> addslashes(trim( $this->input->post('program_id') )),
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
							//'password' 		 	 					=> addslashes(trim( md5($this->randomPassword()) )),	
							'user_role_id'							=> 2,
							//'status'								=> 0,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'updated_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					$check = $this->Student_model->update( 'users', 'user_id',$set_user_data,$id );
					if($check){
						$another_check = $this->Student_model->Another_update('user_profiles','user_id',$id, $set_userprofile_data);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'dance/admin/students'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'dance/admin/students'); 
					}
				}
			}
			
			$programs = $this->Student_model->getListactiveState('programs');
			$sreatm = array('Fast Track'=>'Fast Track','Noraml'=>'Noraml');
			$centers = $this->Student_model->getListactiveState('center_academy');
			$selectedValues = $this->Student_model->getSelected('user_id', $id);
			//echo '<pre>';print_r($selectedValues);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Students',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,					
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
	
	
	public function status( $arg )
	{
		
		
		$getRes = $this->Student_model->changeStatus('users', 'user_id', 'status', $arg);
		if($getRes==true){
			$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
			redirect(base_url().'dance/admin/students'); 
		}else{
			$this->session->set_flashdata('SucMessage', 'Invalid Details');
			redirect(base_url().'dance/admin/students'); 
		}
		
	}
	
	public function remove( $arg )
	{
		
		$getRes = $this->Student_model->remove('users', 'user_id',$arg);
		
		if($getRes==true){
			$this->Student_model->remove('user_profiles', 'user_id',$arg);
			$this->session->set_flashdata('SucMessage', 'Successfully deleted');
			redirect(base_url().'dance/admin/students'); 
		}else{
			$this->session->set_flashdata('SucMessage', 'Invalid Details');
			redirect(base_url().'dance/admin/students'); 
		}
		
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

