<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->library('session');
   $this->load->model('admin/Quiz_model','',TRUE);
   $this->load->model('admin/Group_model','',TRUE);
   $this->load->library('form_validation');
   /*if(!$this->session->userdata('logged_in'))
   {
   redirect('login');
   }*/
 }

 function index($limit='0')
 {
	 
	 if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'vaasthu/admin/login/', 'refresh');
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
   //$this->load->view($this->session->userdata('web_view').'/header',$data);
   //$this->load->view($this->session->userdata('web_view').'/quiz_list',$data);
  	//$this->load->view($this->session->userdata('web_view').'/footer',$data);
	
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
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}
/*if($logged_in['su']!="1"){
exit('Permission denied');
return;
}*/		
$this->load->model('admin/Settings_model','',TRUE);
$coursesArray = $this->Settings_model->getListwithCondition('courses','regulation_id',1);
$appendArray = array((object)array('course_id'=>'0','course_code'=>'Sample'));
$courses = array_merge($coursesArray,$appendArray); //echo '<pre>';print_r($courses);die;
$data['course'] = $courses;
 	/*$this->load->model('category','',TRUE);
  	$data['category'] = $this->category->category_dropdown();*/
	//$this->load->model('difficult_level','',TRUE);
	//$data['groups'] = $this->group_model->get_allgroups();
	
  	//$data['difficult_level'] = $this->difficult_level->level_dropdown();
	if($this->input->post('submit_quiz')){
	$data['resultstatus'] = $this->Quiz_model->add_quiz();
	$qselect=$this->input->post('qselect');
	redirect('vaasthu/admin/quiz/edit_quiz/'.$data['resultstatus'].'/'.$qselect);
	}	
	$data['title']="Add new quiz";
   $this->load->view('admin/quiz/quiz_header',$data);
   
   $this->load->view('admin/quiz/new_quiz',$data);
  	$this->load->view('admin/quiz/quiz_footer',$data);
 }


 function edit_quiz($id,$qselect='1')
 {
 $logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}
/*if($logged_in['su']!="1"){
exit('Permission denied');
return;
}*/		

 	//$this->load->model('category','',TRUE);
  	//$data['category'] = $this->category->category_dropdown();
	//$this->load->model('difficult_level','',TRUE);
	//$data['groups'] = $this->group_model->get_allgroups();
	
  	//$data['difficult_level'] = $this->difficult_level->level_dropdown();
	if($this->input->post('submit_quiz')){
	$data['resultstatus'] = $this->Quiz_model->edit_quiz($id);
	}	
	$data['result'] = $this->Quiz_model->quiz_detail($id);
	//echo '<pre>';print_r($data);die;
		//$data['assigned_gids'] = $this->Quiz_model->assigned_groups($id);
if( isset($data['result']->qselect) && !empty($data['result']->qselect) && $data['result']->qselect=="1"){
	$data['assigned_questions'] = $this->Quiz_model->assigned_questions($id);
	}else{
	$data['assigned_questions'] = $this->Quiz_model->assigned_questions_manually($id);
	
	}
	$data['qselect']=$qselect;
	$data['title']="Edit quiz";
	//echo '<pre>';print_r($data);die;
   	$this->load->view('admin/quiz/quiz_header',$data);
   
   	$this->load->view('admin/quiz/edit_quiz',$data);
  	$this->load->view('admin/quiz/quiz_footer',$data);
 }



	function remove_quiz($id){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}	

$data['resultstatus']=$this->Quiz_model->remove_quiz($id);
	redirect('vaasthu/admin/quiz/index', 'refresh');
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
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}	
	$this->Quiz_model->remove_question_quiz($quid,$qid);
	redirect('vaasthu/admin/quiz/edit_quiz/'.$quid, 'refresh');
	}
	
	
	
	function up_question($quid,$qid,$not='1'){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}
	for($i=1; $i <= $not; $i++){
	$this->Quiz_model->up_question($quid,$qid);
	}
	redirect('vaasthu/admin/quiz/edit_quiz/'.$quid, 'refresh');
	}
	
	function down_question($quid,$qid,$not='1'){
	$logged_in=$this->session->userdata('admin_logged_in');
 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'vaasthu/admin/login/', 'refresh');
}
			for($i=1; $i <= $not; $i++){
	$this->Quiz_model->down_question($quid,$qid);
	}
	redirect('vaasthu/admin/quiz/edit_quiz/'.$quid, 'refresh');
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
			redirect('vaasthu/admin/quiz/access_test/'.$id, 'refresh');
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
	 redirect('vaasthu/admin/quiz/index', 'refresh');
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
