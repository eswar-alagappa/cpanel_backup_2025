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
		$this->load->view('header');
		$this->load->view('banner');
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	public function showBanner($type=null)
	{
		if( isset($type) && !empty($type) && ($type=='alagappa-academy' || $type=='mission-and-vision' 
		|| $type=='message-from-the-management' || $type=='message-from-the-principals-desk') ){
			$type = 'about';
		}
		else if( isset($type) && !empty($type) && ($type=='modern-smart-class-rooms' || $type=='library' 
		|| $type=='computer-lab' || $type=='sport-facilities' || $type=='residential-facilities' 
		|| $type=='other-facilities') ){
			$type = 'facilities';
		}else{
			$type = $type;
		}
		$data = array(
			'type' => $type
		);
		
		$this->load->view('inner_banner', $data);
	}
	
	public function showRight()
	{
		$this->load->view('right');
	}
	
	public function galleryPage($type)
	{
		$data = array(
			'type' => $type
		);
		$this->load->view('header');
		$this->load->view('gallery',$data);
		//$this->load->view('right');
		$this->load->view('footer');
		
	}
	
	public function contactPage($type)
	{
		$data = array(
			'type' => $type
		);
		$this->load->view('header');
		$this->load->view('contact',$data);
		//$this->load->view('right');
		$this->load->view('footer');
		
	}
	
	public function content($type)
	{
		if( $type == "gallery"){
			$this->galleryPage($type);
		}
		else if( $type == "contact"){
			$this->contactPage($type);
		}else{
			$page = $this->home_model->getPage('content',$type);
			$data = array(
				'page' => $page,
				'type' => $type
			);
			//echo '<pre>';print_r($data);die;
			$this->load->view('header');
			$this->load->view('content',$data);
			$this->load->view('right');
			$this->load->view('footer');
		}
	}
	public function admin()
	{
		
		if( isset($_POST) && !empty($_POST['submit']) && trim($_POST['submit'])== "Submit" ){
			
			$this->form_validation->set_rules('content', 'Content', 'required|min_length[50]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]'); 
			$this->form_validation->set_rules('alias', 'Alias', 'required|min_length[5]'); 
			
			if ($this->form_validation->run() == TRUE) {
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					'title' 	=> trim( $_POST['title']),
					'alias'		=> trim($_POST['alias']),
					'content'	=> trim($_POST['content']),
					'status'	=> 1
				);
				$res = $this->home_model->insert_entry('content',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Content Added Successfully.');
					redirect("home/admin");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("home/admin");
				}
			}
			
			$this->load->view('admin');
		}else{
			$this->load->view('admin');
		}
	}
}
