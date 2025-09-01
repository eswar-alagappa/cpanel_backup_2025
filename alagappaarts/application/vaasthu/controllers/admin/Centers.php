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


class Centers extends CI_Controller {
	
	public $skey 	= 'Alagappa2016'; 	
	public  $SiteMainTitle							= 'Alagappa';
	public  $ErrorMessage 							= '';
	public  $ErrorMessages 							= '';
	public  $ErrorMessageanotherUser 				= '';
	
	public function __construct()
	{	
			parent::__construct();
			$this->load->library('session');
			$this->load->model('admin/Center_model');
			$this->load->library('form_validation');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
			$this->output->set_header("Pragma: no-cache");
	}	

	
	public function view( $arg )
	{
		$selectedValues = $this->Center_model->getSelected('center_academy_id', $arg); //echo '<pre>';print_r($selectedValues);die;
		$data = array(
			'ErrorMessages'					=> $this->ErrorMessages,
			'ErrorMessage'					=> '',
			'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
			'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel centers',
			'SiteMainTitle' 				=> $this->SiteMainTitle,
			'selectedValues'				=> $selectedValues,					
			);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/centers/view',$data);
		$this->load->view('admin/footer');
	}
	
	public function index()
	{	
		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
		}
		
		$listData = $this->Center_model->getList('center_academy');	
		//echo '<pre>';print_r($listData);die;
		$data = array(
				'ErrorMessages'					=> $this->ErrorMessages,
				'ErrorMessage'					=> '',
				'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
				'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Centers',
				'SiteMainTitle' 				=> $this->SiteMainTitle,
				'listData'						=> $listData
				//'post_set'						=> $post_set
		);
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/centers/list',$data);
		$this->load->view('admin/footer');
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
	
	public function uniqueUpdateUsername( $str )
	{
		$academy_id = $this->uri->segment(4);
		
		if( isset($academy_id) && !empty($academy_id))
		{	
			$user_data = $this->Center_model->getUserId('center_academy','center_academy_id',$academy_id);
			$check = $this->Center_model->checkEditUsername($str,$user_data->user_id);
			//echo '<pre>';print_r($check);die;
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
				$this->form_validation->set_rules('academy_name', 'Name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUsername');
				$this->form_validation->set_rules('academy_address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('academy_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('academy_city', 'City', 'trim|required|min_length[3]');	
				//$this->form_validation->set_rules('academy_website', 'Grace Period Year', 'trim|required|max_length[1]');				
				$this->form_validation->set_rules('academy_state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('academy_phone', 'Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('academy_country', 'Country', 'trim|required|min_length[3]|max_length[100]');
				//$this->form_validation->set_rules('academy_alternate_phone', 'Description', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('academy_zip', 'Zipcode', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('academy_year_of_establishment', 'Duration Month', 'trim|required|max_length[1]');	
				//$this->form_validation->set_rules('academy_no_of_arrangetram', 'Grace Period Year', 'trim|required|max_length[1]');				
				$this->form_validation->set_rules('director_name', 'Director name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('director_state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('director_country', 'Country', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('director_special_qualification', 'Grace Period Year', 'trim|required|max_length[1]');
				$this->form_validation->set_rules('director_zip', 'Zipcode', 'trim|required|min_length[3]');
				//$this->form_validation->set_rules('exp_bharatanatyam', 'Grace Period Year', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('name_of_guru', 'Fast track duration', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('events_performance', 'Grace Period Year', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('located_at', 'Fast track duration', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('awards_title', 'Grace Period Year', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('other_relevant_info', 'Fast track duration', 'trim|required|max_length[1]');
				//$this->form_validation->set_rules('ballets_choreograph', 'Fast track duration', 'trim|required|max_length[1]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					
					$set_user_data = array(						
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'password' 		 	 					=> addslashes(trim( $this->encode($this->randomPassword()) )),	
							'user_role_id'							=> 3,
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),							
				     );
					 $center_user_id = $this->Center_model->save('users',$set_user_data);
					$set_academy_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('academy_name') )),
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'center_user_id'						=> ((isset($center_user_id) && !empty($center_user_id)) ? $center_user_id : ''),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'address' 		 	 					=> addslashes(trim( $this->input->post('academy_address') )),
							'website' 		 	 					=> addslashes(trim( $this->input->post('academy_website') )),
							'contact' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'alternate_contact' 		 	 		=> addslashes(trim( $this->input->post('academy_alternate_phone') )),
							'city' 		 	 						=> addslashes(trim( $this->input->post('academy_city') )),
							'state' 		 	 					=> addslashes(trim( $this->input->post('academy_state') )),
							'country' 		 	 					=> addslashes(trim( $this->input->post('academy_country') )),
							'zip' 		 	 						=> addslashes(trim( $this->input->post('academy_zip') )),
							'no_of_arangetram' 		 	 			=> addslashes(trim( $this->input->post('academy_no_of_arrangetram') )),
							'no_of_establishment	' 		 	 	=> addslashes(trim( $this->input->post('academy_year_of_establishment') )),
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					
					$set_directory_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('director_name') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('director_email') )),
							'dob' 		 	 						=> addslashes(trim( $this->input->post('director_dob') )),
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
							'ballets_choreographed' 		 	 	=> addslashes(trim( $this->input->post('ballets_choreograph') )),
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
							
				     );
					 
					 
					  
					 
					 
					$check = $this->Center_model->save('center_academy',$set_academy_data);
					
					if( isset($center_user_id) && !empty($center_user_id) && isset($check) && !empty($check)){
						$another_check = $this->Center_model->Another_save('center_director',$check,$set_directory_data);
						$this->session->set_flashdata('SucMessage', 'Successfully created');
						redirect(base_url().'vaasthu/admin/centers/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/centers/index'); 
					}
				}
			}
			
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Centers',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/centers/add',$data);
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
				$this->form_validation->set_rules('academy_name', 'Name', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|callback_uniqueUpdateUsername');
				$this->form_validation->set_rules('academy_address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('academy_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('academy_city', 'City', 'trim|required|min_length[3]');			
				$this->form_validation->set_rules('academy_state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('academy_phone', 'Contact', 'trim|required|min_length[10]');
				$this->form_validation->set_rules('academy_country', 'Country', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('academy_zip', 'Zipcode', 'trim|required|min_length[3]');			
				$this->form_validation->set_rules('director_name', 'Director name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_address', 'Address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_dob', 'Date of birth', 'trim|required');
				$this->form_validation->set_rules('director_state', 'State', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('director_country', 'Country', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('director_zip', 'Zipcode', 'trim|required|min_length[3]');
				
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{ //echo '<pre>';print_r($_POST);die;
				
					
					$set_user_data = array(						
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'mobile' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'password' 		 	 					=> addslashes(trim( $this->encode($this->randomPassword()) )),	
							'user_role_id'							=> 3,
							'status'								=> 1,
							'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							'created_at'							=> date('Y-m-d H:i:s'),							
				     );
					 $center_user_id = addslashes(trim( $this->input->post('center_user_id') ));
					 $center_user_id = $this->Center_model->update('users','user_id',$set_user_data,$center_user_id);
					 
					$set_academy_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('academy_name') )),
							'username' 		 	 					=> addslashes(trim( $this->input->post('username') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('academy_email') )),
							'address' 		 	 					=> addslashes(trim( $this->input->post('academy_address') )),
							'website' 		 	 					=> addslashes(trim( $this->input->post('academy_website') )),
							'contact' 		 	 					=> addslashes(trim( $this->input->post('academy_phone') )),
							'alternate_contact' 		 	 		=> addslashes(trim( $this->input->post('academy_alternate_phone') )),
							'city' 		 	 						=> addslashes(trim( $this->input->post('academy_city') )),
							'state' 		 	 					=> addslashes(trim( $this->input->post('academy_state') )),
							'country' 		 	 					=> addslashes(trim( $this->input->post('academy_country') )),
							'zip' 		 	 						=> addslashes(trim( $this->input->post('academy_zip') )),
							'no_of_arangetram' 		 	 			=> addslashes(trim( $this->input->post('academy_no_of_arrangetram') )),
							'no_of_establishment	' 		 	 	=> addslashes(trim( $this->input->post('academy_year_of_establishment') )),
							'status'								=> 1,
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
					);
					
					$set_directory_data = array(						
							'name' 		 	 						=> addslashes(trim( $this->input->post('director_name') )),
							'email' 		 	 					=> addslashes(trim( $this->input->post('director_email') )),
							'dob' 		 	 						=> addslashes(trim( $this->input->post('director_dob') )),
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
							'ballets_choreographed' 		 	 	=> addslashes(trim( $this->input->post('ballets_choreograph') )),
							//'created_by'							=> 'Super Admin',
							'updated_by'							=> 'Super Admin',
							//'created_at'							=> date('Y-m-d H:i:s'),
							'updated_at'							=> date('Y-m-d H:i:s'),
							
				     );
					$check = $this->Center_model->update( 'center_academy', 'center_academy_id',$set_academy_data,$id );
					if($check){
						$another_check = $this->Center_model->Another_update('center_director','center_academy_id',$id, $set_directory_data);
						$this->session->set_flashdata('SucMessage', 'Updated Successfully');
						redirect(base_url().'vaasthu/admin/centers/index'); 
					}else{
						$this->session->set_flashdata('SucMessage', 'Invalid Details');
						redirect(base_url().'vaasthu/admin/centers/index'); 
					}
				}
			}
			
			
			$selectedValues = $this->Center_model->getSelected('center_academy_id', $id);
			//echo '<pre>';print_r($selectedValues);die;
			$data = array(
					'ErrorMessages'					=> $this->ErrorMessages,
					'ErrorMessage'					=> '',
					'ErrorMessageanotherUser' 		=> $this->ErrorMessageanotherUser,
					'SiteTitle' 					=> $this->SiteMainTitle.'- Admin Panel Centers',
					'SiteMainTitle' 				=> $this->SiteMainTitle,
					'selectedValues'				=> $selectedValues,					
					'arg'							=> $id,
					'post_set'						=> $post_set
			);
			$this->load->view('admin/header',$data);
			$this->load->view('admin/sidebar');
			$this->load->view('admin/centers/edit',$data);
			$this->load->view('admin/footer');
			
		}
		
	}	
	
	
	public function status( $arg )
	{
		
		
		$getRes = $this->Center_model->changeStatus('center_academy', 'center_academy_id', 'status', $arg);
		if($getRes==true){
			$selectedValues = $this->Center_model->getSelected('center_academy_id', $arg);
			$getUserId = $this->Center_model->tableCheck('users','email',$selectedValues->academyemail,'mobile',$selectedValues->contact);
			//echo '<pre>';print_r($selectedValues);die;
			if( isset($getUserId) && !empty($getUserId)){
				$this->Center_model->changeStatus('users', 'user_id', 'status', $getUserId);
			}
			$this->session->set_flashdata('SucMessage', 'Successfully Changed status');
			redirect(base_url().'vaasthu/admin/centers/index'); 
		}else{
			$this->session->set_flashdata('SucMessage', 'Invalid Details');
			redirect(base_url().'vaasthu/admin/centers/index'); 
		}
		
	}
	
	public function remove( $arg )
	{
		
		$userDataremove = $this->Center_model->findandremove('center_academy','users', 'center_academy_id',$arg);		
		
		if($userDataremove==true){
			$getRes = $this->Center_model->delete_status('center_academy', 'center_academy_id',$arg);
			$directory = true;//$this->Center_model->remove('center_director', 'center_academy_id',$arg);
			
			if( $directory== true && $getRes == true)
			{
				$this->session->set_flashdata('SucMessage', 'Successfully deleted');
				redirect(base_url().'vaasthu/admin/centers/index'); 
			}else{
				$this->session->set_flashdata('SucMessage', 'Invalid Details');
				redirect(base_url().'vaasthu/admin/centers/index'); 
			}
		}else{
			$this->session->set_flashdata('SucMessage', 'Invalid Details');
			redirect(base_url().'vaasthu/admin/centers/index'); 
		}
		
	}
	
	
}

