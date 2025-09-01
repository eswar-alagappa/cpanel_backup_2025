<?php
/**
 *
 * This is users detail of vanderlande
 *
 * @package	CodeIgniter
 * @category	Model
 * @author		Swamykannan M
 * @link		
 *
 */

class Syllabus_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		$this->load->database();
    }
    
	public function getAssignExamList()
	{
		$curDate = date('Y-m-d');
		$this->db->select('c.course_code,up.firstname,up.lastname,u.*,ae.*');
		$this->db->from('assign_exam ae');
		//$this->db->join('quiz_result qr','qr.assign_exam_id = ae.id','left');
		$this->db->join('students u','u.user_id = ae.student_id','left');
		$this->db->join('student_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		//$this->db->where('DATE(ae.exam_date_starttime) >=', $curDate);
		//$this->db->where('DATE(ae.exam_date_endtime) <=', $curDate);
		
		$this->db->where("(DATE(ae.exam_date_starttime)  >= '".$curDate."' OR DATE(ae.exam_date_endtime) >= '".$curDate."') ");
		
		$this->db->where("(ae.exam_status  = 'Assigned' OR ae.exam_status  = 'Reassigned') ");
		//$this->db->group_by('ae.student_id');
		
		$query = $this->db->get(); 
		$assignedExam = $query->result();
		return $assignedExam;
	}
	
	public function Bulkinsert($table, $data = array()){
        $insert = $this->db->insert_batch($table,$data);
        return $insert?true:false;
    }
	
	public function getExamAttendFailList()
	{
		$curDate = date('Y-m-d');
		$this->db->select('c.course_code,up.firstname,up.lastname,u.*,ae.*');
		$this->db->from('assign_exam ae');
		$this->db->join('quiz_result qr','qr.assign_exam_id = ae.id','left');
		$this->db->join('students u','u.user_id = ae.student_id','left');
		$this->db->join('student_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->where('DATE(ae.exam_date_endtime) <=', $curDate);
		$this->db->where('ae.exam_status', 'Processing');
		$this->db->where('qr.score_ind', '');
		$this->db->where('qr.status', 0);
		//$this->db->group_by('ae.student_id');
		$query = $this->db->get(); 
		$assignedExamExpire = $query->result(); 
		return $assignedExamExpire;
	}
	
	
	public function getUserCnt()
	{
		$this->db->select('count(*) as registeredCnt');
		$this->db->from('students u');
		$this->db->join('student_profiles up','up.user_id = u.user_id','left');
		$this->db->where('u.user_role_id', 2);
		//$this->db->where('u.status', 1);
		$this->db->where('up.user_id !=', '');
		$query = $this->db->get(); 
		$registeredStudent = $query->result();
		
		$this->db->select('count(*) as approved');
		$this->db->from('students u');
		$this->db->join('student_profiles up','up.user_id = u.user_id','left');
		$this->db->where('u.user_role_id', 2);
		$this->db->where('u.status', 1);
		$this->db->where('up.user_id !=', '');
		$query = $this->db->get(); 
		$approvedStudent = $query->result();
		
		$this->db->select('count(*) as waiting');
		$this->db->from('students u');
		$this->db->join('student_profiles up','up.user_id = u.user_id','left');
		$this->db->where('u.user_role_id', 2);
		$this->db->where('u.status', 0);
		$this->db->where('up.user_id !=', '');
		$query = $this->db->get(); 
		$waitingStudent = $query->result();
		
		$queryVal = array($registeredStudent[0]->registeredCnt, $approvedStudent[0]->approved, $waitingStudent[0]->waiting);
		return $queryVal;
	}
	
	public function fetchStudent($type)
	{
		if( isset($type) && !empty($type) && $type==2){
			$this->db->select('*');
		}if( isset($type) && !empty($type) && $type==3){
			$this->db->select('*,cd.name as directorName');
		}
		$this->db->from('students u');
		if( isset($type) && !empty($type) && $type==2){
			$this->db->join('student_profiles up','up.user_id = u.user_id','left');
			$this->db->where('up.user_id !=', '');
		}if( isset($type) && !empty($type) && $type==3){
			$this->db->join('center_academy ca','ca.center_user_id = u.user_id','left');
			$this->db->join('center_director cd','cd.center_academy_id = ca.center_academy_id','left');
			$this->db->where('u.user_id !=', '');
		}
		$this->db->where('u.user_role_id', $type);
		$this->db->where('u.status', 1);		
		$query = $this->db->get(); 
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getPaidDate($table,$id,$program_id)
	{
		$this->db->select('*');
		$this->db->from($table.' t');
		$this->db->where('t.student_id',$id);
		$this->db->where('t.program_id',$program_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return ( isset($queryVal[0]) && !empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function getConnectedDataList($table1,$table2,$joinField,$conditionField,$arg)
	{
		$this->db->select('*');
		$this->db->from($table1.' t1');
		$this->db->join($table2.' t2','t2.'.$joinField.' = t1.'.$joinField.'','left');
		$this->db->where('t2.'.$conditionField, $arg);
		$query = $this->db->get(); 
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getListProgram($table)
	{
			$this->db->select('*');
			$this->db->from($table.' p');
			//$this->db->join('fb_activity_images ai','ai.fb_activity_id = a.fb_activity_id','left');
			$this->db->where('p.status ', '1');
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
	}
	
	public function getList($table,$program_id,$center_id,$status)
	{
			$this->db->select('*');
			$this->db->from($table.' p');
			$this->db->join('student_profiles up','up.user_id = p.user_id','left');
			$this->db->join('user_program upr','upr.user_id = p.user_id','left');
			$this->db->where('up.user_id !=', '');
			if( isset($program_id) && !empty($program_id)){
				$this->db->where('upr.program_id', $program_id);
			}if( isset($center_id) && !empty($center_id)){
				$this->db->where('upr.center_id', $center_id);
			}if( isset($status) && !empty($status) && $status ==1 ){
				$this->db->where('p.status', $status);
			}if( isset($status) && !empty($status) && $status == 2){
				$this->db->where('p.status', 0);
			}if( isset($status) && !empty($status) && $status == 'waiting'){
				$this->db->where('p.username', '');
			}
			$this->db->group_by('upr.user_id');
			//$this->db->where('p.status', '1');
			$this->db->where('p.is_delete', '0');
			//$this->db->order_by('p.user_id','desc');
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
	}
	
	public function getListactiveState($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status', 1);
		if( $table =='center_academy'){
			$this->db->order_by('name','asc');
		}
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function save($table,$data)
	{
		$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id(); 
		return ((isset($insert_id) && !empty($insert_id)) ? $insert_id : false);
	}
	
	public function batchInsert($table,$data)
	{
		$this->db->insert_batch($table, $data);
		 if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
        //$insert_id = $this->db->insert_id(); 
		//return ((isset($insert_id) && !empty($insert_id)) ? $insert_id : false);
	}
	
	public function Another_save( $table, $id, $relevant_id, $data)
	{
		$this->db->set($relevant_id, $id);
		$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id(); 
		return ((isset($id) && !empty($id)) ? $id : false);
	}
	
	public function update($table, $updateField, $data,$arg)
	{
		$this->db->where($updateField, $arg);
		$this->db->update($table, $data);
		return ((isset($arg) && !empty($arg)) ? $arg : false);
	}
	
	public function myupdatebatch($table, $data, $title)
	{
		$this->db->update_batch($table, $data, $title); 
		return true;
	}
	
	public function batchUpdate($table, $data, $updateField, $arg)
	{
		$this->remove($table, $updateField, $arg);
		
		$this->db->insert_batch($table, $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function Another_update( $table, $updateField, $id, $data )
	{
		if(isset($id) && !empty($id)){
			$this->db->where_in($updateField, $id);
			$this->db->update($table, $data);
			return ((isset($id) && !empty($id)) ? $id : false);
		
		}
	}
	
	public function changeStatus( $table, $changeField, $statusField, $category_id )
	{
		
		$username = 'username';
		$this->db->select( array($statusField,$changeField,$username));
		$this->db->from($table);
		$this->db->where($changeField, $category_id );
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0]))
		{
			if(!empty($queryVal[0]->username))
			{				
			$status = ($queryVal[0]->$statusField == 0 ? 1 : 0);
			$this->db->set($statusField,$status);
			$this->db->where($changeField, $queryVal[0]->$changeField);
			$this->db->update($table); 
			
			return true;
			}
		}
		return false;
	}
	
	
	public function issyllabusDelete($table, $changeField, $category_id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($changeField, $category_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0])){
			
			/*$data = array(
				'is_delete'	=> 1,
				'status'	=> 0,
				'updated_by'=> 1,
				'updated_at'=> date('Y-m-d H:i:s')
			);
			$this->db->where_in($changeField, $category_id);
			$this->db->update($table, $data);*/
			//echo '<pre>';print_r($queryVal[0]);
			if( $queryVal[0]->type == 'Pdf'){
			    if(file_exists( $_SERVER['DOCUMENT_ROOT'].'/syllabuspdf/'.$queryVal[0]->path )){
			       
			        unlink( $_SERVER['DOCUMENT_ROOT'].'/syllabuspdf/'.$queryVal[0]->path );
			        
			        $this->db->where_in($changeField, $category_id);
        		    $this->db->delete($table);
			    }
			}
			
			if( $queryVal[0]->type == 'Video'){
    			$this->db->where_in($changeField, $category_id);
        		$this->db->delete($table);
			}
			
			return true;
		}
		return false;
	}
	
	public function isDelete($table, $changeField, $category_id)
	{
		$this->db->select( array($changeField));
		$this->db->from($table);
		$this->db->where($changeField, $category_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0])){
			
			$data = array(
				'is_delete'	=> 1,
				'status'	=> 0,
				'updated_by'=> 1,
				'updated_at'=> date('Y-m-d H:i:s')
			);
			$this->db->where_in($changeField, $category_id);
			$this->db->update($table, $data);
			
			//$this->db->where_in($changeField, $category_id);
    		//$this->db->delete($table);
			
			return true;
		}
		return false;
	}
	
	
	public function remove($table, $changeField, $category_id)
	{
		$this->db->select( array($changeField));
		$this->db->from($table);
		$this->db->where($changeField, $category_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0])){
			
			$this->db->where_in($changeField, $category_id);
    		$this->db->delete($table);
			
			return true;
		}
		return false;
	}
	
	public function getSelectedcolumn($table, $field, $id)
	{
	    $this->db->select('*');
			$this->db->from($table);
			$this->db->where($field, $id);
			$query = $this->db->get();

			$queryVal = $query->result();
			return ((isset($queryVal) && !empty($queryVal)) ? $queryVal[0] : '');
	}
	
	public function getSelected_table($table, $selected_field1, $val1,$selected_field2,$val2)
	{
		if( !empty($table) && !empty($selected_field1) && !empty($val1) && !empty($selected_field2) && !empty($val2) )
		{
			$this->db->select('SUM(amount) as amount');
			$this->db->from($table);
			$this->db->where($selected_field1, $val1);
			$this->db->where($selected_field2, $val2);
			$query = $this->db->get();

			$queryVal = $query->result();
			return ((isset($queryVal) && !empty($queryVal)) ? $queryVal[0] : '');
		}
		return false;
	}
	
	public function getSelected_table_array($table, $selected_field1, $val1,$selected_field2,$val2)
	{
		if( !empty($table) && !empty($selected_field1) && !empty($val1) && !empty($selected_field2) && !empty($val2) )
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($selected_field1, $val1);
			$this->db->where_in($selected_field2, $val2);
			if( $table == 'quiz_result'){
				$this->db->where('status', 1);
				$this->db->where('score_ind !=','');
			}
			$query = $this->db->get();
			$queryVal = $query->result();
			return ((isset($queryVal) && !empty($queryVal)) ? $queryVal : '');
		}
		return false;
	}
	
	public function getSelected($selected_field, $id)
	{
		if( !empty($selected_field) && !empty($id) )
		{
			$this->db->select('*');
			$this->db->from('students p');
			$this->db->join('student_profiles up','up.user_id = p.user_id','left');
			$this->db->where('p.'.$selected_field, $id);
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal[0];
		}
		return false;
	}

	
	public function checkUsername( $uname )
	{
		$this->db->select('*');
		$this->db->from('students u');
		$this->db->where('u.username', $uname);
		$this->db->where_in('u.user_role_id', array('2','3'));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function checkEditUsername( $uname,$user_id )
	{
		$this->db->select('*');
		$this->db->from('students u');
		$this->db->where('u.username', $uname);
		$this->db->where('u.user_id !=', $user_id);
		$this->db->where_in('u.user_role_id', array('2','3'));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function getMultiTableRecord($table1,$table2,$table3,$table4,$table5,$joinId,$joinval,$joinid2,$joinval2)
	{
		if( isset($joinval2) && !empty($joinval2))
		{
			$this->db->select('u.*,up.*,pro.*,p.name as programName,c.name as centerName');
			$this->db->from($table1.' u');
			$this->db->join($table2.' up','up.'.$joinId.' = u.'.$joinId.'','left');
			$this->db->join($table5.' pro','pro.'.$joinId.' = u.'.$joinId.'','left');
			$this->db->join($table3.' p','p.program_id = up.program_id','left');
			$this->db->join($table4.' c','c.center_academy_id  = up.center_id','left');
			$this->db->where('u.'.$joinId, $joinval);
			
				$this->db->where('p.'.$joinid2, $joinval2);
			
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			$queryVal = $query->result();
		}
		else
		{
			$this->db->select('u.*,up.*,pro.*,p.name as programName,c.name as centerName,up.program_id as program_id');
			$this->db->from($table1.' u');
			$this->db->join($table2.' up','up.'.$joinId.' = u.'.$joinId.'','left');
			$this->db->join($table5.' pro','pro.'.$joinId.' = u.'.$joinId.'','left');
			$this->db->join($table3.' p','p.program_id = up.program_id','left');
			$this->db->join($table4.' c','c.center_academy_id  = up.center_id','left');
			$this->db->where('u.'.$joinId, $joinval);
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			$queryVal = $query->result();
		}
		return ( isset($queryVal[0]) && !empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function getPgmFee($user_id,$program_id)
	{
		$this->db->select('p.name as programName,pf.Total_fee,up.user_program_id,up.completion_date, up.graduation_status_comments,up.graduation_status,up.grade');
		$this->db->from('user_program up');
		$this->db->join('programs p','p.program_id = up.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = up.program_id','left');
		$this->db->where('up.user_id',$user_id);
		$this->db->where('up.program_id',$program_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return (!empty($queryVal) ? $queryVal : false);
	}
	
	public function ExamScore($user_id,$program_id=null)
	{
		/*$this->db->select('c.course_code,c.regulation_id,qr.score,ae.id as id,ae.result as aeResult,ae.grade as aeGrade, ae.score as aeScore,c.program_id,ae.exam_startdate,p.name as programName,pf.Total_fee,up.user_program_id,up.completion_date, up.graduation_status_comments,up.graduation_status,up.grade');
		$this->db->from('quiz_result qr');		
		//$this->db->join('quiz q','q.quid = qr.quid','left');
		$this->db->join('assign_exam ae','ae.course_id = qr.quid','left');
		$this->db->join('courses c','c.course_id = qr.quid','left');
		$this->db->join('programs p','p.program_id = ae.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = ae.program_id','left');
		$this->db->join('user_program up','up.program_id = ae.program_id','left');
		if( isset($program_id) && !empty($program_id)){
			$this->db->where('ae.program_id',$program_id);
		}
		$this->db->where('up.user_id',$user_id);
		$this->db->where('qr.uid',$user_id);
		$this->db->where('ae.student_id',$user_id);
		$this->db->group_by('qr.rid');
		//$this->db->where('ae.exam_status','Processing');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal) ? $queryVal : false);*/
		
		$this->db->select('c.course_code,c.regulation_id,qr.score,ae.id as id,ae.result as aeResult,ae.grade as aeGrade, ae.score as aeScore,c.program_id,ae.exam_startdate,p.name as programName,pf.Total_fee,up.user_program_id,up.completion_date, up.graduation_status_comments,up.graduation_status,up.grade');
		$this->db->from('assign_exam ae');	
		$this->db->join('quiz_result qr','qr.assign_exam_id = ae.id','left');	
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->join('programs p','p.program_id = ae.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = ae.program_id','left');
		$this->db->join('user_program up','up.program_id = ae.program_id','left');
		if( isset($program_id) && !empty($program_id)){
			$this->db->where('ae.program_id',$program_id);
			$this->db->where('up.program_id',$program_id);
			$this->db->where('up.user_id',$user_id);
		}
		$this->db->where('qr.uid',$user_id);
		//$this->db->where('ae.student_id',$user_id);
		
		$this->db->group_by('qr.rid');
		//$this->db->where('ae.exam_status','Processing');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal) ? $queryVal : false);
	}
	
	public function PaymentList( $user_id,$program_id)
	{
		$this->db->select('pay.status as paymentStatus, pay.*,p.*,pf.*');
		$this->db->from('payment pay');
		$this->db->join('programs p','p.program_id = pay.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = pay.program_id','left');
		$this->db->where('pay.student_id', $user_id);
		$this->db->where('pay.program_id', $program_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getSelectedFromUserpgmList($table, $selected_field, $id)
	{
		if( !empty($table) && !empty($selected_field) && !empty($id) )
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($selected_field, $id);
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
		}
		return false;
	}
	
	public function getSelected_List( $table, $selected_field, $id )
	{
		if( !empty($table) && !empty($selected_field) && !empty($id) )
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($selected_field, $id);
			$this->db->where('regulation_id','1');
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
		}
		return false;
	}
	
	public function getQuizDetail( $course_id )
	{
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->where('course_id', $course_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function checkQuizResult($user_id, $course_id,$assign_exam_id )
	{
		$this->db->select('*');
		$this->db->from('quiz_result');
		$this->db->where('quid', $course_id);
		$this->db->where('assign_exam_id', $assign_exam_id);
		$this->db->where('uid', $user_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function checkExamStatus( $user_id, $course_id )
	{
		$this->db->select('*');
		$this->db->from('assign_exam');
		$this->db->where('course_id', $course_id);
		$this->db->where('student_id', $user_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function PendingExam( $userid )
	{
		$this->db->select('c.*');
		$this->db->from('assign_exam ae');
		$this->db->join('quiz_result qr','qr.uid = ae.student_id','left');	
		$this->db->join('courses c','c.course_id = qr.quid','left');		
		$this->db->where('qr.quid !=',0);
		$this->db->where('ae.student_id', $userid);
		$this->db->where('qr.score_ind','');
		$this->db->where('qr.status ',0);
		$this->db->where('qr.uid ',$userid);
		$this->db->group_by('qr.rid');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function assignExam($table, $userid, $post)
	{
		if( isset($post) && !empty($post))
		{
			
			$course_codeCnt = count($post['course_code']);
			$j=1;$i=0;
			if( $course_codeCnt >1)
			{
				for($i=0,$j=1;$i<$course_codeCnt;$i++,$j++)
				{		
					$checkStatus = $this->checkExamStatus( $userid, $post['course_code'][$i]);
					$course = $this->getQuizDetail($post['course_code'][$i]);
					if( isset($checkStatus) && !empty($checkStatus))
					{
						$updateassignExamArray[] = array(
							'id'					=> $checkStatus->id,
							'student_id' 			=> $userid,
							'course_id'				=> $post['course_code'][$i],
							'program_id'			=> $post['program_id'],
							'exam_date_starttime'	=> $post['from_schedule'][$i],
							'exam_date_endtime'		=> $post['to_schedule'][$i],
							'no_of_attempt'			=> ($checkStatus->no_of_attempt + 1),//((isset($course->max_attempts) && !empty($course->max_attempts)) ? $course->max_attempts : ''),
							'examkey'				=> 'APAA-1234',
							'questions_assigned'	=> ((isset($course->qids_static) && !empty($course->qids_static)) ? $course->qids_static : ''),
							'exam_status'			=> ((isset($checkStatus) && !empty($checkStatus) && $checkStatus->exam_status =='Assigned' ) ? 'Reassigned' : 'Assigned')
						);	
						
					}else{
						$assignExamArray[] = array(
							'student_id' 			=> $userid,
							'course_id'				=> $post['course_code'][$i],
							'program_id'			=> $post['program_id'],
							'exam_date_starttime'	=> $post['from_schedule'][$i],
							'exam_date_endtime'		=> $post['to_schedule'][$i],
							'no_of_attempt'			=> 1,//((isset($course->max_attempts) && !empty($course->max_attempts)) ? $course->max_attempts : ''),
							'examkey'				=> 'APAA-1234',
							'questions_assigned'	=> ((isset($course->qids_static) && !empty($course->qids_static)) ? $course->qids_static : ''),
							'exam_status'			=> ((isset($checkStatus) && !empty($checkStatus) && $checkStatus->exam_status =='Assigned' ) ? 'Reassigned' : 'Assigned')
						);
					}
				}
				if( isset($assignExamArray) && !empty($assignExamArray))
				{
					$this->db->insert_batch($table, $assignExamArray);
				}
				else if( isset($updateassignExamArray) && !empty($updateassignExamArray) )
				{
					foreach($updateassignExamArray as $assign)
					{
						$this->remove('quiz_result','assign_exam_id',$assign['id']);						
					}					
					$this->db->update_batch($table, $updateassignExamArray,'id');
				}
			}else{
				$checkStatus = $this->checkExamStatus( $userid, $post['course_code'][0]);
				$course = $this->getQuizDetail($post['course_code'][0]);
				if( isset($checkStatus) && !empty($checkStatus))
				{
					$checkQuizNonAttenExam = $this->checkQuizResult($userid, $post['course_code'][0],$checkStatus->id);
					
					if( isset($checkQuizNonAttenExam) && !empty($checkQuizNonAttenExam))
					{
						$this->remove('quiz_result','rid',$checkQuizNonAttenExam->rid);
					}
					
					$assignExamArray = array(
						'student_id' 			=> $userid,
						'course_id'				=> $post['course_code'][0],
						'program_id'			=> $post['program_id'],
						'exam_date_starttime'	=> $post['from_schedule'][0],
						'exam_date_endtime'		=> $post['to_schedule'][0],
						'no_of_attempt'			=> ($checkStatus->no_of_attempt + 1),//((isset($course->max_attempts) && !empty($course->max_attempts)) ? $course->max_attempts : ''),
						'examkey'				=> 'APAA-1234',
						'questions_assigned'	=> ((isset($course->qids_static) && !empty($course->qids_static)) ? $course->qids_static : ''),
						'exam_status'			=> ((isset($checkStatus) && !empty($checkStatus) && $checkStatus->exam_status =='Assigned' ) ? 'Reassigned' : 'Assigned')
					);
					$this->db->where('id', $checkStatus->id);
					$this->db->update($table, $assignExamArray);
					
					//
					
				}else{
					$assignExamArray = array(
						'student_id' 			=> $userid,
						'course_id'				=> $post['course_code'][0],
						'program_id'			=> $post['program_id'],
						'exam_date_starttime'	=> $post['from_schedule'][0],
						'exam_date_endtime'		=> $post['to_schedule'][0],
						'no_of_attempt'			=> 1,//((isset($course->max_attempts) && !empty($course->max_attempts)) ? $course->max_attempts : ''),
						'examkey'				=> 'APAA-1234',
						'questions_assigned'	=> ((isset($course->qids_static) && !empty($course->qids_static)) ? $course->qids_static : ''),
						'exam_status'			=> ((isset($checkStatus) && !empty($checkStatus) && $checkStatus->exam_status =='Assigned' ) ? 'Reassigned' : 'Assigned')
					);
					$this->db->insert($table, $assignExamArray);
				}
			}
			return true;
		}
		return false;
	}
	
	function getDoubleCondition($table,$condition1, $value1, $condition2, $value2)
	{
		$this->db->select('*');
		$this->db->from($table.' u');
		$this->db->where('u.'.$condition1, $value1);
		$this->db->where('u.'.$condition2, $value2);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		//echo '<pre>queryVal->';print_r($queryVal);die;
		return ((isset($queryVal) && !empty($queryVal)) ? $queryVal[0] : '');
	}
	
	function getCondition($table,$condition, $uname)
	{
		$this->db->select('*');
		$this->db->from($table.' u');
		$this->db->where('u.'.$condition, $uname);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		//echo '<pre>queryVal->';print_r($queryVal);die;
		return ((isset($queryVal) && !empty($queryVal)) ? $queryVal[0] : '');
	}
	
	
	public function getLists( $table )
	{
		$this->db->select('*');
		$this->db->from($table);
		//$this->db->where('course_id', $course_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function dbQuery($table)
	{
		$query=$this->db->query($table);
		$queryVal = $query->result_array();
		return $queryVal;
	}
	
	public function delete_Data($table,$id)
	{
         $this->db->where($id);
         $this->db->delete($table);
	} 
    
}    
