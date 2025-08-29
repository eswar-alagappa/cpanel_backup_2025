<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	
	  public function __construct() {
        parent::__construct();
		
		ini_set('post_max_size', '222264M');
		ini_set('upload_max_filesize', '222264M');

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
	
	public function ImgUpload($files, $path)
	{
	    if(! is_dir($path))
                        mkdir($path,0777,TRUE);
                        
			$config['upload_path']          	= $path;
			$config['allowed_types']        	= 'jpeg|jpg|png';
			$config['max_size']             	= 500000;
			//$config['max_width']           	= 1024;
			//$config['max_height']           	= 768;
			$config['encrypt_name'] 			= TRUE;
			$config['overwrite'] 				= TRUE;
			$config['remove_spaces'] 			= TRUE;
			$new_name = time().md5($files['name']);
			$config['file_name'] 				= $new_name;
            
           
            
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('photo'))
			{
				//$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
				$data['photo_error'] = $this->upload->display_errors();
				//echo '<pre>';print_r($data['img_error']);die;
			}
			else
			{
			    
			     
				//$this->load->helper('thumb');
				$image_data = $this->upload->data();
				//create_thumb($image_data, '200', '200', $thumbPath, TRUE);
					

				$data['upload_data'] = $this->upload->data();
			//echo 'test->'.$this->upload->data();
		
				chmod($path.''.$data['upload_data']['file_name'], 0777);
				
				//echo '<pre>';print_r($upload_data);die;
			}
			return $data;
	}
	
	public function ImgUploadThumb($files, $path, $thumbPath)
	{
	    if(! is_dir($path))
                        mkdir($path,0777,TRUE);
	    
	    if(! is_dir($thumbPath))
                        mkdir($thumbPath,0777,TRUE);
                        
		$config['upload_path']          	= $path;
		$config['allowed_types']        	= 'jpeg|jpg|png';
		$config['max_size']             	= 500000;
		//$config['max_width']           	= 1024;
		//$config['max_height']           	= 768;
		$config['encrypt_name'] 			= TRUE;
		$config['overwrite'] 				= TRUE;
		$config['remove_spaces'] 			= TRUE;
		$new_name = time().md5($files['name']);
		$config['file_name'] 				= $new_name;

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('photo'))
		{
			//$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$data['photo_error'] = $this->upload->display_errors();
			//echo '<pre>';print_r($data['img_error']);die;
		}
		else
		{
			$this->load->helper('thumb');
			$image_data = $this->upload->data();
			create_thumb($image_data, '217', '144', $thumbPath, TRUE);
				

			$data['upload_data'] = $this->upload->data();
			
			chmod($path.''.$data['upload_data']['file_name'], 0777);
			chmod($thumbPath.''.$data['upload_data']['file_name'], 0777);
			//echo '<pre>';print_r($upload_data);die;
		}
		return $data;
	}
	
	public function gallery($type=null, $id= null)
	{
		$profileData = '';
		if( isset($type) && !empty($type) && $type == 'add' && isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit"){
			
			//$this->form_validation->set_rules('type', 'Type', 'required|min_length[1]');
			//$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]'); 
			//$this->form_validation->set_rules('imagePath', 'image Path', 'required');
			 
			
			if ($this->form_validation->run() == TRUE) {
				
				if( isset($_FILES['photo']) && !empty($_FILES['photo']) && count($_FILES['photo'])>0){
					
					$gallery_photo = trim($this->input->post('gallery_photo'));
					if( empty($gallery_photo))
					{ 
						
						$photoResult = $this->ImgUploadThumb($_FILES['photo'], 'upload/gallery/','upload/gallery/thumb/');
						
						if(isset($photoResult['photo_error']) && !empty($photoResult['photo_error'])){
							$data['photo_error'] = $photoResult['photo_error'];
						}else{
							$data['upload_data'] = $photoResult['upload_data'];
							$profileData = $photoResult['upload_data']['file_name'];
						}
					}
				}
				//echo '<pre>';print_r($_FILES);
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					
					'title'		=> trim($_POST['title']),
					'small_img' => ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'big_img'	=> ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'status' 	=> 1
				);
				//echo '<pre>inputArray->';print_r($inputArray);die;
				$res = $this->home_model->insert_entry('gallery',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Gallery Added Successfully.');
					redirect("admin/home/gallery");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/gallery");
				}
			}
			
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/gallery');
		}
		if( isset($type) && !empty($type) && $type == 'edit' && isset($id) && !empty($id) || (!empty($_POST['submit']) && trim($_POST['submit'])== "Update") ){
			
			
			//$this->form_validation->set_rules('type', 'Type', 'required|min_length[1]');
			//$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');  
			
			if ($this->form_validation->run() == TRUE) {
				
					if( isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name']) ){
						
						$gallery_photo = trim($this->input->post('gallery_photo'));
						//unlink('upload/adminProfile/'.$banner_photo);
						//unlink('upload/adminProfile/thumb/'.$banner_photo);
						
						
							unlink('upload/gallery/'.$gallery_photo);
							unlink('upload/gallery/thumb/'.$gallery_photo);
							$photoResult = $this->ImgUploadThumb($_FILES['photo'], 'upload/gallery/','upload/gallery/thumb/');
						
						
						//$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/adminProfile/', 'upload/adminProfile/thumb/');
								
						if(isset($photoResult['photo_error']) && !empty($photoResult['photo_error'])){
							$data['photo_error'] = $photoResult['photo_error'];
						}else{
							$data['upload_data'] = $photoResult['upload_data'];
							$profileData = $photoResult['upload_data']['file_name'];
						}
								
					}else{
						$profileData = trim($this->input->post('gallery_photo'));
					}
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					//'type' 		=> trim( $_POST['type']),
					//'name'		=> trim($_POST['name']),
					'title'		=> trim($_POST['title']),
					'small_img'	=> ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'big_img'	=> ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'status' 	=> 1
				);
				$res = $this->home_model->update_entry('gallery',$inputArray, $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Gallery Updated Successfully.');
					redirect("admin/home/gallery");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/gallery");
				}
			}
			
			$selected = $this->home_model->select_data_byid('gallery',$id);
			$result = $this->home_model->select_data('gallery');
			$data = array(
				'result' => $result,
				'selected' => $selected,
				'id'	=> $id
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/gallery', $data);
		}
		if( isset($type) && !empty($type) && $type == 'delete' && isset($id) && !empty($id) )
		{
			$selected = $this->home_model->select_data_byid('gallery',$id);
			if($selected){
				
				
					unlink('upload/gallery/'.$selected->big_img);
					unlink('upload/gallery/thumb/'.$selected->small_img);
				
				$res = $this->home_model->delete_data('gallery', $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Gallery Deleted Successfully.');
					redirect("admin/home/gallery");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/gallery");
				}
			}else{
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect("admin/home/gallery");
			}
		}
		if( $type == null){
			
			$result = $this->home_model->select_data('gallery');
			
			$data = array(
				'result' => $result
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/gallery',$data);
			//$this->load->view('admin/footer');
		}
	}
	
	public function banners($type=null, $id= null)
	{
		$profileData = '';
		if( isset($type) && !empty($type) && $type == 'add' && isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit"){
			
			$this->form_validation->set_rules('type', 'Type', 'required|min_length[1]');
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]'); 
			//$this->form_validation->set_rules('imagePath', 'image Path', 'required');
			 
			
			if ($this->form_validation->run() == TRUE) {
				
				if( isset($_FILES['photo']) && !empty($_FILES['photo']) && count($_FILES['photo'])>0){
					
					$banner_photo = trim($this->input->post('banner_photo'));
					if( empty($banner_photo))
					{ 
						if( $_POST['type'] ==1){
						$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/slider/');
						}
						else if( $_POST['type'] ==2){
						$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/banner/');
						}
						//echo '$photoResult->';print_r($photoResult);die;
						if(isset($photoResult['photo_error']) && !empty($photoResult['photo_error'])){
							$data['photo_error'] = $photoResult['photo_error'];
						}else{
							$data['upload_data'] = $photoResult['upload_data'];
							$profileData = $photoResult['upload_data']['file_name'];
						}
					}
				}
				//echo '<pre>';print_r($_FILES);
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					'type' 		=> trim( $_POST['type']),
					'name'		=> trim($_POST['name']),
					'title'		=> trim($_POST['title']),
					'imgPath'	=> ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'status' 	=> 1
				);
				//echo '<pre>inputArray->';print_r($inputArray);die;
				$res = $this->home_model->insert_entry('banners',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Banner Added Successfully.');
					redirect("admin/home/banners");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/banners");
				}
			}
			
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/banner');
		}
		if( isset($type) && !empty($type) && $type == 'edit' && isset($id) && !empty($id) || (!empty($_POST['submit']) && trim($_POST['submit'])== "Update") ){
			
			
			$this->form_validation->set_rules('type', 'Type', 'required|min_length[1]');
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]'); 
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');  
			
			if ($this->form_validation->run() == TRUE) {
				
					if( isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name']) ){
						
						$banner_photo = trim($this->input->post('banner_photo'));
						//unlink('upload/adminProfile/'.$banner_photo);
						//unlink('upload/adminProfile/thumb/'.$banner_photo);
						
						if( $_POST['type'] ==1){
							unlink('upload/slider/'.$banner_photo);
							$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/slider/');
						}
						else if( $_POST['type'] ==2){
							unlink('upload/banner/'.$banner_photo);
							$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/banner/');
						}
						
						//$photoResult = $this->ImgUpload($_FILES['photo'], 'upload/adminProfile/', 'upload/adminProfile/thumb/');
								
						if(isset($photoResult['photo_error']) && !empty($photoResult['photo_error'])){
							$data['photo_error'] = $photoResult['photo_error'];
						}else{
							$data['upload_data'] = $photoResult['upload_data'];
							$profileData = $photoResult['upload_data']['file_name'];
						}
								
					}else{
						$profileData = trim($this->input->post('banner_photo'));
					}
				//echo '<pre>';print_r($_POST);die;
				
				$inputArray = array(
					'type' 		=> trim( $_POST['type']),
					'name'		=> trim($_POST['name']),
					'title'		=> trim($_POST['title']),
					'imgPath'	=> ((isset($profileData) && !empty($profileData)) ? $profileData : ''),
					'status' 	=> 1
				);
				$res = $this->home_model->update_entry('banners',$inputArray, $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Banner Updated Successfully.');
					redirect("admin/home/banners");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/banners");
				}
			}
			
			$selected = $this->home_model->select_data_byid('banners',$id);
			$result = $this->home_model->select_data('banners');
			$data = array(
				'result' => $result,
				'selected' => $selected,
				'id'	=> $id
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/banner', $data);
		}
		if( isset($type) && !empty($type) && $type == 'delete' && isset($id) && !empty($id) )
		{
			$selected = $this->home_model->select_data_byid('banners',$id);
			if($selected){
				
				if( $selected->type == 1){
					unlink('upload/slider/'.$selected->imgPath);
				}
				if( $selected->type == 2){
					unlink('upload/banner/'.$selected->imgPath);
				}
				$res = $this->home_model->delete_data('banners', $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Content Deleted Successfully.');
					redirect("admin/home/banners");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/banners");
				}
			}else{
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect("admin/home/banner");
			}
		}
		if( $type == null){
			
			$result = $this->home_model->select_data('banners');
			
			$data = array(
				'result' => $result
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/banner',$data);
			//$this->load->view('admin/footer');
		}
	}
	
	public function valid_url($url){
       if (filter_var($url, FILTER_VALIDATE_URL))
          return TRUE;
       else 
          return FALSE;    
    }
    
	public function events($type=null, $id= null)
	{
		if( isset($type) && !empty($type) && $type == 'add' && isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit"){
				
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]'); 
			//$this->form_validation->set_rules('event_desc', 'Desc', 'required|min_length[3]'); 
			$url = (isset($_POST['url']) ? trim($_POST['url']) : '');
			if( isset($url) && !empty($url)){
				$this->form_validation->set_rules('url', 'Link', 'required|callback_valid_url'); 
			}
			
			if ($this->form_validation->run() == TRUE) {
				
				$inputArray = array(
					
					//'event_desc'	=> trim($_POST['event_desc']),
					'url'			=> trim($_POST['url']),
					'title'			=> trim($_POST['title']),
					'status' 		=> 1
				);
				//echo '<pre>inputArray->';print_r($inputArray);die;
				$res = $this->home_model->insert_entry('events',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Event Added Successfully.');
					redirect("admin/home/events");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/events");
				}
			}
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/event');
		}
		if( isset($type) && !empty($type) && $type == 'edit' && isset($id) && !empty($id) || (!empty($_POST['submit']) && trim($_POST['submit'])== "Update") ){
			
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]'); 
			//$this->form_validation->set_rules('event_desc', 'Desc', 'required|min_length[3]'); 
			$url = (isset($_POST['url']) ? trim($_POST['url']) : '');
			if( isset($url) && !empty($url)){
				$this->form_validation->set_rules('url', 'Link', 'required|callback_valid_url'); 
			}	
			
			if ($this->form_validation->run() == TRUE) {
				
				$inputArray = array(
					
					//'event_desc'	=> trim($_POST['event_desc']),
					'url'			=> trim($_POST['url']),
					'title'			=> trim($_POST['title']),
					'status' 		=> 1
				);
				$res = $this->home_model->update_entry('events',$inputArray, $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Event Updated Successfully.');
					redirect("admin/home/events");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/events");
				}
				
			}
			
			$selected = $this->home_model->select_data_byid('events',$id);
			$result = $this->home_model->select_data('events');
			$data = array(
				'result' => $result,
				'selected' => $selected,
				'id'	=> $id
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/event', $data);
		}
		if( isset($type) && !empty($type) && $type == 'delete' && isset($id) && !empty($id) )
		{
			$selected = $this->home_model->select_data_byid('events',$id);
			if($selected){
				
				$res = $this->home_model->delete_data('events', $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Event Deleted Successfully.');
					redirect("admin/home/events");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/events");
				}
			}else{
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect("admin/home/event");
			}
		}
		if( $type == null){
			$result = $this->home_model->select_data('events');
			
			$data = array(
				'result' => $result
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/event',$data);
		}
	}
	
	public function static_content($type=null, $id= null)
	{
		if( isset($type) && !empty($type) && $type == 'add' && isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit"){
				
			$this->form_validation->set_rules('type', 'Type', 'required|min_length[3]'); 
			$this->form_validation->set_rules('content', 'Content', 'required|min_length[3]'); 
			
			if ($this->form_validation->run() == TRUE) {
				
				$inputArray = array(
					
					'type'		=> trim($_POST['type']),
					'content'	=> trim($_POST['content']),
					'status' 	=> 1
				);
				//echo '<pre>inputArray->';print_r($inputArray);die;
				$res = $this->home_model->insert_entry('static_content',$inputArray);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Static Content Added Successfully.');
					redirect("admin/home/static_content");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/static_content");
				}
			}
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/static_content');
		}
		if( isset($type) && !empty($type) && $type == 'edit' && isset($id) && !empty($id) || (!empty($_POST['submit']) && trim($_POST['submit'])== "Update") ){
			
			$this->form_validation->set_rules('type', 'Type', 'required|min_length[3]'); 
			$this->form_validation->set_rules('content', 'Content', 'required|min_length[3]'); 
			
			if ($this->form_validation->run() == TRUE) {
				
				$inputArray = array(
					
					'type'		=> trim($_POST['type']),
					'content'	=> trim($_POST['content']),
					'status' 		=> 1
				);
				$res = $this->home_model->update_entry('static_content',$inputArray, $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Static Content Updated Successfully.');
					redirect("admin/home/static_content");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/static_content");
				}
				
			}
			
			$selected = $this->home_model->select_data_byid('static_content',$id);
			$result = $this->home_model->select_data('static_content');
			$data = array(
				'result' => $result,
				'selected' => $selected,
				'id'	=> $id
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/static_content', $data);
		}
		if( isset($type) && !empty($type) && $type == 'delete' && isset($id) && !empty($id) )
		{
			$selected = $this->home_model->select_data_byid('static_content',$id);
			if($selected){
				
				$res = $this->home_model->delete_data('static_content', $id);
				if($res != false){
					
					$this->session->set_flashdata('message', 'Static Content Deleted Successfully.');
					redirect("admin/home/static_content");
				}else{
					$this->session->set_flashdata('message', 'Something went wrong, please try again.');
					redirect("admin/home/static_content");
				}
			}else{
				$this->session->set_flashdata('message', 'Something went wrong, please try again.');
				redirect("admin/home/static_content");
			}
		}
		if( $type == null){
			$result = $this->home_model->select_data('static_content');
			
			$data = array(
				'result' => $result
			);
			$this->load->view('admin/header');
			$this->load->view('admin/left');
			$this->load->view('admin/static_content',$data);
		}
	}
	
	public function pages($type=null, $id= null)
	{
		if( isset($type) && !empty($type) && $type == 'add'){
			
			if( isset($_POST) 
			&& !empty($_POST['submit']) && trim($_POST['submit'])== "Submit")
			{
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
		redirect("admin/home/");
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
