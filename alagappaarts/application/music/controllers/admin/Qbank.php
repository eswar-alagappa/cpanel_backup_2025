<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Qbank extends CI_Controller {

		 function __construct()
		 {
				parent::__construct();
				$this->load->library('session');
				$this->load->model('admin/Qbank_model','',TRUE);
				$this->load->library('form_validation');
		 }

		function index($limit='0',$cid='0')
		{
			$logged_in=$this->session->userdata('admin_logged_in');

			 if($this->session->userdata('admin_logged_in') == False)
			{
				redirect(base_url().'music/admin/login/', 'refresh');
			}

			$this->load->helper('form');

			$data['result'] = $this->Qbank_model->question_list($limit,$cid,'');
			$data['title']="Question Bank";
			$data['limit']=$limit;
			$data['fcid']=$cid;
			$this->load->view('admin/quiz/quiz_header',$data);
			$this->load->view('admin/quiz/question_list',$data);
			$this->load->view('admin/quiz/quiz_footer',$data);
		}

function select_questions($quid='0',$quiz_name1='',$limit='0',$cid='1',$course_id='0')
 {
	 $quiz_name = str_replace("-"," ",$quiz_name1);

$logged_in=$this->session->userdata('admin_logged_in');

 if($this->session->userdata('admin_logged_in') == False)
{
	redirect(base_url().'music/admin/login/', 'refresh');
}

/*if($logged_in['su']!="1"){
exit('Permission denied');
return;
}*/		
 $data['fcid']=$cid;
  
   $this->load->helper('form');
	//$this->load->model('category','',TRUE);
  	//$data['category'] = $this->category->category_dropdown();
	//$this->load->model('difficult_level','',TRUE);
  	//$data['difficult_level'] = $this->difficult_level->level_dropdown();
	$data['result'] = $this->Qbank_model->question_list($limit,$cid,$course_id); //echo '<pre>';print_r($data['result']);die;
	$data['title']="Question Bank";
   $data['limit']=$limit;
    $data['quid']=$quid;
	$data['course_id']=$course_id;
    $data['quiz_name']=$quiz_name;
    $this->load->model('admin/quiz_model','',TRUE); 
   $data['assigned_questions'] = $this->quiz_model->assigned_questions_manually($quid,$course_id);
	
   $this->load->view('admin/quiz/select_questions',$data);
  	
 }


 function import()
		{	
$logged_in=$this->session->userdata('logged_in');
if($logged_in['su']!="1"){
exit('Permission denied');
return;
}		
if(isset($_FILES['xlsfile'])){
			$targets = 'xls/';
			$targets = $targets . basename( $_FILES['xlsfile']['name']);
			$docadd=($_FILES['xlsfile']['name']);
			if(move_uploaded_file($_FILES['xlsfile']['tmp_name'], $targets)){
				$Filepath = $targets;
$allxlsdata = array();
	date_default_timezone_set('UTC');

	$StartMem = memory_get_usage();
	//echo '---------------------------------'.PHP_EOL;
	//echo 'Starting memory: '.$StartMem.PHP_EOL;
	//echo '---------------------------------'.PHP_EOL;

	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();

		$Sheets = $Spreadsheet -> Sheets();

		//echo '---------------------------------'.PHP_EOL;
		//echo 'Spreadsheets:'.PHP_EOL;
		//print_r($Sheets);
		//echo '---------------------------------'.PHP_EOL;
		//echo '---------------------------------'.PHP_EOL;

		foreach ($Sheets as $Index => $Name)
		{
			//echo '---------------------------------'.PHP_EOL;
			//echo '*** Sheet '.$Name.' ***'.PHP_EOL;
			//echo '---------------------------------'.PHP_EOL;

			$Time = microtime(true);

			$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)
			{
				//echo $Key.': ';
				if ($Row)
				{
					//print_r($Row);
					$allxlsdata[] = $Row;
				}
				else
				{
					var_dump($Row);
				}
				$CurrentMem = memory_get_usage();
		
				//echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
				//echo '---------------------------------'.PHP_EOL;
		
				if ($Key && ($Key % 500 == 0))
				{
					//echo '---------------------------------'.PHP_EOL;
					//echo 'Time: '.(microtime(true) - $Time);
					//echo '---------------------------------'.PHP_EOL;
				}
			}
		
		//	echo PHP_EOL.'---------------------------------'.PHP_EOL;
			//echo 'Time: '.(microtime(true) - $Time);
			//echo PHP_EOL;

			//echo '---------------------------------'.PHP_EOL;
			//echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
			//echo '---------------------------------'.PHP_EOL;
		}
		
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}


$this->Qbank_model->import_question($allxlsdata);   
		
				}
			
				}
				
			else{
			echo "Error: " . $_FILES["file"]["error"];
			}	
redirect('qbank');
	}

function add_new_mul(){

$logged_in=$this->session->userdata('logged_in');
if($logged_in['su']!="1"){
exit('Permission denied');
return;
}		

  $this->load->model('category','',TRUE);
  	$data['category'] = $this->category->category_dropdown();
	$this->load->model('difficult_level','',TRUE);
  	$data['difficult_level'] = $this->difficult_level->level_dropdown();

	$data['resultstatus'] = $this->Qbank_model->add_new_mul();
	
	$data['title']="Add new question";
   $this->load->view('/header',$data);
   
   $this->load->view('/new_question_1',$data);
  	$this->load->view('/footer',$data);




}

 function add_new($q_t='0')
		{ 
			$logged_in=$this->session->userdata('admin_logged_in');

			if($this->session->userdata('admin_logged_in') == False)
			{
			redirect(base_url().'music/admin/login/', 'refresh');
			}
			$resultstatus = '';

			$post_set = $_POST;
		
	
			//if($this->input->post('cid')){
			if (($this->input->server('REQUEST_METHOD') == 'POST') && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				$_POST['question'] = trim($_POST['question']);
				$_POST['description'] = trim($_POST['description']);
				
				$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
				$this->form_validation->set_rules('qus_type', 'Quest Type', 'trim|required');
				$this->form_validation->set_rules('question', 'Question', 'trim|required');
				$this->form_validation->set_rules('description', 'Description', 'trim|required');
				
				if( $_POST['qus_type'] ==0 || $_POST['qus_type'] ==6){
					$this->form_validation->set_rules('score', 'Score', 'trim|required');
					//$this->form_validation->set_rules('option[]', 'Option', 'trim|required');
				}
				if( $_POST['qus_type'] ==2 || $_POST['qus_type'] ==5){
					$this->form_validation->set_rules('option[]', 'Option', 'trim|required');
				}
				//echo '<pre>';print_r($_POST);
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					//echo '<pre>';print_r($_POST);die;
					$resultstatus = $this->Qbank_model->add_question();
				}
			}	
			
			$this->load->model('admin/Settings_model','',TRUE);
			$coursesArray = $this->Settings_model->getListwithCondition('courses','regulation_id',1);
			$appendArray = array((object)array('course_id'=>'0','course_code'=>'Sample'));
			$appendArray1 = array((object)array('course_id'=>'-1','course_code'=>'Sample1'));
			$courses = array_merge($coursesArray,$appendArray,$appendArray1); //echo '<pre>';print_r($courses);die;

			
			$data = array(
				'title' 		=> "Add new question",
				'q_t'			=> $q_t,
				'course'		=> $courses,
				'resultstatus'	=> $resultstatus,
				'post_set'		=> $post_set
			);
			
			
				$this->load->view('admin/quiz/quiz_header',$data); 
				//echo 'q_t->'.$q_t; 
			if($q_t==0){ //echo 'a';die;
				$this->load->view('admin/quiz/new_question',$data);
			}
			if($q_t==1){
				$this->load->view('admin/quiz/new_question_1',$data);
			}
			if($q_t==2){ 
				$this->load->view('admin/quiz/new_question_2',$data);
			}
			if($q_t==3){
				$this->load->view('admin/quiz/new_question_3',$data);
			}
			if($q_t==4){
				$this->load->view('admin/quiz/new_question_4',$data);
			}
			if($q_t==5){
				$this->load->view('admin/quiz/new_question_5',$data);
			}
			if($q_t==6){
				$this->load->view('admin/quiz/new_question_6',$data);
			}
				$this->load->view('admin/quiz/quiz_footer',$data);
		}

		
		
		 function edit_question($id,$q_type='0')
		 {
		 
			$logged_in=$this->session->userdata('admin_logged_in');

			if($this->session->userdata('admin_logged_in') == False)
			{
				redirect(base_url().'music/admin/login/', 'refresh');
			}	

			$resultstatus = '';
			$post_set = $_POST;
		   
			//if($this->input->post('cid')){
			if (($this->input->server('REQUEST_METHOD') == 'POST') && (!empty($_POST['submit']) && $_POST['submit']=='Submit') ) {
				
				$_POST['question'] = trim($_POST['question']);
				$_POST['description'] = trim($_POST['description']);
				
				$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
				$this->form_validation->set_rules('qus_type', 'Quest Type', 'trim|required');
				$this->form_validation->set_rules('question', 'Question', 'trim|required');
				$this->form_validation->set_rules('description', 'Description', 'trim|required');
				
				if( $_POST['qus_type'] ==0 || $_POST['qus_type'] ==6){
					$this->form_validation->set_rules('score', 'Score', 'trim|required');
					//$this->form_validation->set_rules('option[]', 'Option', 'trim|required');
				}
				if( $_POST['qus_type'] ==2 || $_POST['qus_type'] ==5){
					$this->form_validation->set_rules('option[]', 'Option', 'trim|required');
					
				}
				//echo '<pre>';print_r($_POST);
				if($this->form_validation->run() 			== FALSE)
				{
					$post_set		 					= $_POST;
					$this->ErrorMessages		 		= validation_errors();
				}else{
					$resultstatus = $this->Qbank_model->update_question($id,$q_type);
				}
			}	
			
			
			$this->load->model('admin/Settings_model','',TRUE);
			$coursesArray = $this->Settings_model->getListwithCondition('courses','regulation_id',1);
			$appendArray = array((object)array('course_id'=>'0','course_code'=>'Sample'));
			$courses = array_merge($coursesArray,$appendArray); //echo '<pre>';print_r($courses);die;
			$course = $courses;
		
			$result = $this->Qbank_model->get_question($id);
				$q_type = $result['0']['q_type'];
				//echo $q_type;die;
				
				$data = array(
					'title' 	=> "Edit question",
					'course' 	=> $course,
					'result'	=> $result,
					'resultstatus'	=> $resultstatus,
					'post_set'		=> $post_set
				);
				
			   $this->load->view('admin/quiz/quiz_header',$data);
			   if($q_type=="0"){
					$this->load->view('admin/quiz/edit_question',$data);
			   }
			   if($q_type=="1"){
					$this->load->view('admin/quiz/edit_question_1',$data);
			   }
			   if($q_type=="2"){
					$this->load->view('admin/quiz/edit_question_2',$data);
			   }
			   if($q_type=="3"){
					$this->load->view('admin/quiz/edit_question_3',$data);
			   }
			   if($q_type=="4"){
					$this->load->view('admin/quiz/edit_question_4',$data);
			   }
			   if($q_type=="5"){
					$this->load->view('admin/quiz/edit_question_5',$data);
			   }
			     if($q_type=="6"){
					$this->load->view('admin/quiz/edit_question_6',$data);
			   }
				$this->load->view('admin/quiz/quiz_footer',$data);
		 }


			function remove_question($id){
				$this->load->helper('url');
			$logged_in=$this->session->userdata('admin_logged_in');
			 if($this->session->userdata('admin_logged_in') == False)
			{
				redirect(base_url().'music/admin/login/', 'refresh');
			}			
				$data['resultstatus']=$this->Qbank_model->remove_question($id);
				redirect(base_url().'music/admin/qbank/index', 'refresh');
			}

		function remove_qids($limit){
		$logged_in=$this->session->userdata('admin_logged_in');

		if($this->session->userdata('admin_logged_in') == False)
		{
			redirect(base_url().'music/admin/login/', 'refresh');
		}			
			$qids=$this->input->post('qid');
			$data['resultstatus']=$this->Qbank_model->remove_qids($qids);
			redirect(base_url().'music/admin/qbank/index/'.$limit, 'refresh');
		}
		
		// get desired question for particular subject and difficulty level
		function get_level_question($difficulty_level,$category){
			$this->db->where("cid",$category);
			$this->db->where("did",$difficulty_level);
			$query =	$this->db->get("qbank");
			$num = $query->num_rows();
			echo $num;
			}

}
?>













