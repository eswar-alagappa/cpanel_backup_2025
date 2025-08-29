<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	
	  public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
		
        $this->load->library('form_validation');
		$this->load->model('home_model');
		$this->load->library('session');
    }

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		
		$this->load->view('admin/login');
		
	}
	
	public function create_slug($string){     
		$replace = '-';         
		$string = strtolower($string);     

		//replace / and . with white space     
		$string = preg_replace("/[\/\.]/", " ", $string);     
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     

		//remove multiple dashes or whitespaces     
		$string = preg_replace("/[\s-]+/", " ", $string);     

		//convert whitespaces and underscore to $replace     
		$string = preg_replace("/[\s_]/", $replace, $string);     

		//limit the slug size     
		$string = substr($string, 0, 100);     

		//slug is generated     
		return $string; 
	}    

	public function login()
	{
		
		if( isset($_POST) && !empty($_POST['submit']) && trim($_POST['submit'])== "Login" ){
			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]'); 
			
			if ($this->form_validation->run() == TRUE) {
				
				
				$inputArray = array(
					'email' 	=> trim( $_POST['email']),
					'password'		=> trim($_POST['password'])
				);
				//$res = $this->home_model->insert_entry('content',$inputArray);
				if( $inputArray['email'] == 'admin@gmail.com' && $inputArray['password'] == 'admin@1234'){
					
					$sess_array = array(
					 'email' => $inputArray['email']
				   );
				   $this->session->set_userdata('logged_in', $sess_array);
	   
					$this->session->set_flashdata('message', 'Content Added Successfully.');
					redirect("admin/home/dashboard");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin");
				}
			}else{
				redirect("admin");
			}
			
			
		}
	}
	
	
	public function pages($type=null, $id= null)
	{
		if( isset($type) && !empty($type) && $type == 'add' && isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit"){
			
			
			$this->form_validation->set_rules('content', 'Content', 'required|min_length[50]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]'); 
			$this->form_validation->set_rules('alias', 'Alias', 'required|min_length[5]'); 
			
			if ($this->form_validation->run() == TRUE) {
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					'title' 	=> trim( $_POST['title']),
					'alias'		=> $this->create_slug(trim($_POST['alias'])),
					'content'	=> trim($_POST['content']),
					'status'	=> 1
				);
				$res = $this->home_model->insert_entry('content',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Content Added Successfully.');
					redirect("admin/home/pages");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/pages");
				}
			}
			
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/pages');
		}
		if( isset($type) && !empty($type) && $type == 'edit' && isset($id) && !empty($id) || (!empty($_POST['submit']) && trim($_POST['submit'])== "Update") ){
			
			
			$this->form_validation->set_rules('content', 'Content', 'required|min_length[50]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]'); 
			$this->form_validation->set_rules('alias', 'Alias', 'required|min_length[5]'); 
			
			if ($this->form_validation->run() == TRUE) {
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					'title' 	=> trim( $_POST['title']),
					'alias'		=> $this->create_slug( trim($_POST['alias'])),
					'content'	=> trim($_POST['content']),
					'status'	=> 1
				);
				$res = $this->home_model->update_entry('content',$inputArray, $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Content Updated Successfully.');
					redirect("admin/home/pages");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/pages");
				}
			}
			
			$selected = $this->home_model->select_data_byid('content',$id);
			$result = $this->home_model->select_data('content');
			$data = array(
				'result' => $result,
				'selected' => $selected,
				'id'	=> $id
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/pages', $data);
		}
		if( isset($type) && !empty($type) && $type == 'delete' && isset($id) && !empty($id) )
		{
			$selected = $this->home_model->select_data_byid('content',$id);
			if($selected){
				
				$res = $this->home_model->delete_data('content', $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Content Deleted Successfully.');
					redirect("admin/home/pages");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/pages");
				}
			}else{
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect("admin/home/pages");
			}
		}
		if( $type == null){
			
			$result = $this->home_model->select_data('content');
			
			$data = array(
				'result' => $result
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/pages',$data);
			//$this->load->view('admin/footer');
		}
		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("admin");
	}
	
	public function dashboard()
	{
		if($this->session->userdata('logged_in'))
       {
		   $this->load->view('admin/header');
		   $this->load->view('admin/left');
		   $this->load->view('admin/content');
		   $this->load->view('admin/footer');
		   //echo 'ddddd';
	   }else{
		  redirect("home/admin"); 
	   }
	}
}
