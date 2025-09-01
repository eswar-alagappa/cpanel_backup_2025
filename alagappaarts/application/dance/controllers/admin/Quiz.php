<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->library('session');
   $this->load->model('admin/Quiz_model','',TRUE);
   //$this->load->model('admin/Group_model','',TRUE);
   $this->load->library('form_validation');   
 }

 function index($limit='0')
 {
	 
	 if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'dance/admin/login/', 'refresh');
		}
		
	$logged_in=$this->session->userdata('admin_logged_in');
	if($logged_in=="1"){
		$data['result'] = $this->Quiz_model->quiz_list($limit);
	}else{
		$gid=$logged_in['gid'];
		$data['result'] = $this->Quiz_model->quiz_list($limit,$gid);
	}
   
	$data['title']="Quiz/Test";
   $data['limit']=$limit;
   
	
	$this->load->view('admin/quiz/quiz_header',$data);
	$this->load->view('admin/quiz/quiz_list',$data);
	$this->load->view('admin/quiz/quiz_footer',$data);

	
 }
 
 
 
function photo_upload(){

if(isset($_FILES['webcam'])){
			$targets = 'photo/';
			$filename=time().'.jpg';
			$targets = $targets.''.$filename;
			if(move_uploaded_file($_FILES['webcam']['tmp_name'], $targets)){
			
				$this->session->set_flashdata('photoname', $filename);
				}
				}
}


		function add_new()
		{
				$logged_in=$this->session->userdata('logged_in');

				if($this->session->userdata('admin_logged_in') == False)
				{
				redirect(base_url().'dance/admin/login/', 'refresh');
				}
				$post_set = $_POST;
				if (($this->input->server('REQUEST_METHOD') == 'POST') && (!empty($_POST['submit_quiz']) && $_POST['submit_quiz']=='Submit') ) {
					
					$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
					$this->form_validation->set_rules('quiz_name', 'Name', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('quiz_time_duration', 'Time Duration', 'trim|required|is_numeric');
					$this->form_validation->set_rules('test_start_time', 'Start Date', 'trim|required');
					$this->form_validation->set_rules('test_end_time', 'End Date', 'trim|required');
					$this->form_validation->set_rules('pass_percentage', 'Pass Percentage', 'trim|required|is_numeric');
					$this->form_validation->set_rules('max_attemp', 'Max.Attempt', 'trim|required|is_numeric');
					$this->form_validation->set_rules('correct_answer_score', 'Correct Answer Score', 'trim|required|is_numeric');
					$this->form_validation->set_rules('incorrect_answer_score', 'InCorrect Answer Score', 'trim|required|is_numeric');
					
					if($this->form_validation->run() 			== FALSE)
					{
						$post_set		 					= $_POST;
						$this->ErrorMessages		 		= validation_errors();
					}else{
						//echo '<pre>post123->';print_r($_POST);die;
						$resultstatus = $this->Quiz_model->add_quiz();
						$qselect = $this->input->post('qselect');
						redirect(base_url().'dance/admin/quiz/edit_quiz/'.$resultstatus.'/'.$qselect);
					}
				}
				$this->load->model('admin/Settings_model','',TRUE);
				$coursesArray = $this->Settings_model->getListwithCondition('courses','regulation_id',1);
				$appendArray = array((object)array('course_id'=>'0','course_code'=>'Sample'));
				$courses = array_merge($coursesArray,$appendArray); //echo '<pre>';print_r($courses);die;
				//$data['course'] = $courses;
				$data = array(
					'title' => "Add new quiz",
					'course' => $courses,
					'post_set'	=> $post_set
				);
				$this->load->view('admin/quiz/quiz_header',$data);
				$this->load->view('admin/quiz/new_quiz',$data);
				$this->load->view('admin/quiz/quiz_footer',$data);
		}


		function edit_quiz($id,$qselect='1')
		{
				$logged_in=$this->session->userdata('admin_logged_in');
				if($this->session->userdata('admin_logged_in') == False)
				{
					redirect(base_url().'dance/admin/login/', 'refresh');
				}
				$post_set = $_POST;
				$resultstatus = '';
				
				if (($this->input->server('REQUEST_METHOD') == 'POST') && (!empty($_POST['submit_quiz']) && $_POST['submit_quiz']=='Submit') ) {
					
					$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
					$this->form_validation->set_rules('quiz_name', 'Name', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('quiz_time_duration', 'Time Duration', 'trim|required|is_numeric');
					$this->form_validation->set_rules('test_start_time', 'Start Date', 'trim|required');
					$this->form_validation->set_rules('test_end_time', 'End Date', 'trim|required');
					$this->form_validation->set_rules('pass_percentage', 'Pass Percentage', 'trim|required|is_numeric');
					$this->form_validation->set_rules('max_attemp', 'Max.Attempt', 'trim|required|is_numeric');
					$this->form_validation->set_rules('correct_answer_score', 'Correct Answer Score', 'trim|required|is_numeric');
					$this->form_validation->set_rules('incorrect_answer_score', 'InCorrect Answer Score', 'trim|required|is_numeric');
					
					if($this->form_validation->run() 			== FALSE)
					{
						$post_set		 					= $_POST;
						$this->ErrorMessages		 		= validation_errors();
					}else{
						//echo '<pre>';print_r($_POST);die;
						$resultstatus = $this->Quiz_model->edit_quiz($id);
					}
					
				}	
				
				$result = $this->Quiz_model->quiz_detail($id);
				if( isset($result->qselect) && !empty($result->qselect) && $result->qselect=="1"){
					$assigned_questions = $this->Quiz_model->assigned_questions($id);
				}else{ 
					$assigned_questions = $this->Quiz_model->assigned_questions_manually($id,$result->course_id);
				}
				
				$this->load->model('admin/Settings_model','',TRUE);
				$coursesArray = $this->Settings_model->getListwithCondition('courses','regulation_id',1);
				$appendArray = array((object)array('course_id'=>'0','course_code'=>'Sample'));
				$courses = array_merge($coursesArray,$appendArray); //echo '<pre>';print_r($courses);die;
				
				
				$data = array(
					'qselect'				=> $qselect,
					'title'					=> "Edit quiz",
					'course'				=> $courses,
					'result'				=> $result,
					'assigned_questions'	=> $assigned_questions,
					'post_set'				=> $post_set,
					'resultstatus'			=> $resultstatus
				);
				

				$this->load->view('admin/quiz/quiz_header',$data);

				$this->load->view('admin/quiz/edit_quiz',$data);
				$this->load->view('admin/quiz/quiz_footer',$data);
		}



	function remove_quiz($id){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'dance/admin/login/', 'refresh');
}	

$data['resultstatus']=$this->Quiz_model->remove_quiz($id);
	redirect('dance/admin/quiz/index', 'refresh');
	}

	 function attempt($id)
 	{
		//echo $this->session->userdata('web_view');die;
		$data['result'] = $this->Quiz_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		$this->load->view('admin/quiz/quiz_header',$data);
		$this->load->view('admin/quiz/quiz_detail',$data);
	  	$this->load->view('admin/quiz/quiz_footer',$data);
	}
	
	
	// update individual question time spent
	function update_time($id,$qtime){
	$this->Quiz_model->update_time($id,$qtime);
	}
	
	
	// update answer
	function update_answer($id,$oid){
	$this->Quiz_model->update_answer($id,$oid);
	}
	function update_fillups(){
	$this->Quiz_model->update_fillups();
	}
	
	function add_question($quid,$qid){
	$this->Quiz_model->add_question($quid,$qid);
	}
	
	function remove_question_quiz($quid,$qid){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'dance/admin/login/', 'refresh');
}	
	$this->Quiz_model->remove_question_quiz($quid,$qid);
	redirect('dance/admin/quiz/edit_quiz/'.$quid, 'refresh');
	}
	
	
	
	function up_question($quid,$qid,$not='1'){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'dance/admin/login/', 'refresh');
}
	for($i=1; $i <= $not; $i++){
	$this->Quiz_model->up_question($quid,$qid);
	}
	redirect('dance/admin/quiz/edit_quiz/'.$quid, 'refresh');
	}
	
	function down_question($quid,$qid,$not='1'){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'dance/admin/login/', 'refresh');
}
			for($i=1; $i <= $not; $i++){
	$this->Quiz_model->down_question($quid,$qid);
	}
	redirect('dance/admin/quiz/edit_quiz/'.$quid, 'refresh');
	}
	
	
	
	
	 function access_test($id)
 	{
		$this->load->helper('cookie');
 	
		$data['resultstatus'] = $this->Quiz_model->quiz_verify($id);
		
		//echo '<pre>';print_r($data['resultstatus']);die;
		$data['quiz_id']=$id;
		$data['result'] = $this->Quiz_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		//echo '<pre>';print_r($data);die;
		if( isset($data['resultstatus']) && !empty($data['resultstatus']) && $data['resultstatus'] == "1"){
			if(!$this->input->cookie('rid', TRUE)){
			redirect('dance/admin/quiz/access_test/'.$id, 'refresh');
			} 
			$rid= $this->input->cookie('rid', TRUE);
			//get the question answer 
			$data['user_answer']=$this->Quiz_model->get_user_answer($rid); 
			$question_user_ans=array();
			
			if( isset($data['user_answer']) && !empty($data['user_answer']))
			{
				foreach($data['user_answer'] as $val_ans){
					$question_user_ans[$val_ans['q_id']]=$val_ans['essay_cont'];				
				}
			}
			//echo '<pre>';print_r($question_user_ans);die;
			$data['question_user_ans']=$question_user_ans;
			// get assignied questions
			$data['assigned_question']=$this->Quiz_model->get_question($rid); //echo '<pre>';print_r($data['assigned_question']);die;
			// get time information
			$data['time_info']=$this->Quiz_model->get_time_info($rid);//echo '<pre>';print_r($data['time_info']);die;
			
			// time remaining in seconds
			// total time - time spent
			$data['seconds']=(($data['result']->duration)*60) - ($data['time_info']['time_spent']);
			
			// get quiz data like quiz duration, title
			$data['quiz_data']=$this->Quiz_model->get_quiz_data($id); //echo '<pre>';print_r($data['quiz_data']);die;
			
			//echo '<pre>user_answer->';print_r($data['user_answer']);
			//echo '<pre>question_user_ans->';print_r($data['question_user_ans']);
			//echo '<pre>assigned_question->';print_r($data['assigned_question']);
			//echo '<pre>seconds->';print_r($data['seconds']);
			//echo '<pre>quiz_data->';print_r($data['quiz_data']);
			//die;
			// load quiz access page
			$this->load->view('admin/quiz/quiz_header',$data);
			$this->load->view('admin/quiz/quiz_access',$data);
			$this->load->view('admin/quiz/quiz_footer',$data);
		
		
		}else{
		// load quiz detail page with error
		$data['result'] = $this->Quiz_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		$this->load->view('admin/quiz/quiz_header',$data);
		$this->load->view('admin/quiz/quiz_detail',$data);
	  	$this->load->view('admin/quiz/quiz_footer',$data);
		}
		
	}
	
	function close_practice(){
	 $result_id=$this->input->cookie('rid', TRUE);
	 $this->db->where('rid', $result_id);
if($this->db->delete('quiz_result')){
	$this->load->helper('cookie');
	delete_cookie("rid");
	 redirect('dance/admin/quiz/index', 'refresh');
} 
	 
	 
 } 
	function submit_quiz($id){
		
		$this->load->helper('cookie');
 	
		$data['resultstatus']=$this->Quiz_model->quiz_submit($id);
		$data['result'] = $this->Quiz_model->quiz_detail($id);
		$data['title']=$data['result']->quiz_name;
		$this->load->view('admin/quiz/quiz_header',$data);
		$this->load->view('admin/quiz/quiz_detail',$data);
	  	$this->load->view('admin/quiz/quiz_footer',$data);
	}
}
?>