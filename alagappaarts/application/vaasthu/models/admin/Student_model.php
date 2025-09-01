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

class Student_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		//$this->load->database();
		$this->db = $this->load->database( 'db1', TRUE );
		
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
	
	public function getList($table)
	{
			$this->db->select('*');
			$this->db->from($table.' p');
			$this->db->join('user_profiles up','up.user_id = p.user_id','left');
			$this->db->where('up.user_id !=', '');
			//$this->db->where('p.status', '1');
			$this->db->where('p.is_delete', '0');
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
	}
	
	public function getListactiveState($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status', 1);
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
		$this->db->select( array($statusField,$changeField));
		$this->db->from($table);
		$this->db->where($changeField, $category_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0])){
			$status = ($queryVal[0]->$statusField == 0 ? 1 : 0);
			$this->db->set($statusField,$status);
			$this->db->where($changeField, $queryVal[0]->$changeField);
			$this->db->update($table); 
			
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
	
	public function getSelected($selected_field, $id)
	{
		if( !empty($selected_field) && !empty($id) )
		{
			$this->db->select('*');
			$this->db->from('users p');
			$this->db->join('user_profiles up','up.user_id = p.user_id','left');
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
		$this->db->from('users u');
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
		$this->db->from('users u');
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
		if( isset($joinval2) && !empty($joinval2)){
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
		}else{
			$this->db->select('u.*,up.*,pro.*,p.name as programName,c.name as centerName');
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
	
	public function ExamScore($user_id,$program_id=null)
	{
		$this->db->select('c.course_code,c.regulation_id,qr.score,ae.id as id,ae.result as aeResult,ae.grade as aeGrade, ae.score as aeScore,c.program_id,ae.exam_startdate,p.name as programName,pf.Total_fee,up.user_program_id,up.completion_date, up.graduation_status_comments,up.graduation_status,up.grade');
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
				if( isset($assignExamArray) && !empty($assignExamArray)){
					$this->db->insert_batch($table, $assignExamArray);
				}else if( isset($updateassignExamArray) && !empty($updateassignExamArray) ){
					$this->db->update_batch($table, $updateassignExamArray,'id');
				}
			}else{
				$checkStatus = $this->checkExamStatus( $userid, $post['course_code'][0]);
				$course = $this->getQuizDetail($post['course_code'][0]);
				if( isset($checkStatus) && !empty($checkStatus))
				{
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
    
}    
