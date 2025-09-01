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

class Settings_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		//$this->load->database();
		$this->db = $this->load->database( 'db1', TRUE );
		
    }
    public function getListwithCondition($table,$field,$value)
	{
		$this->db->select('*');
			$this->db->from($table.' p');
			//$this->db->join('fb_activity_images ai','ai.fb_activity_id = a.fb_activity_id','left');
			$this->db->where('p.'.$field.' =', $value);
			$this->db->where('p.status =','1');
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal;
	}
	public function getList($table)
	{
			$this->db->select('*');
			$this->db->from($table.' p');
			//$this->db->join('fb_activity_images ai','ai.fb_activity_id = a.fb_activity_id','left');
			//$this->db->where('p.program_id !=', '');
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
	
	public function Another_save( $table, $id, $post)
	{
		
		$pcnt = count($post['partition']);
		$qtcnt = count($post['question_type']);
		$qcnt = count($post['no_of_question']);
		for($i=0;$i<$pcnt;$i++){
			$courseExamData[] = array(
				'course_id' => $id,
				'questiontype_id' => $post['question_type'][$i],
				'partition_id' => $post['partition'][$i],
				'no_of_questions' => $post['no_of_question'][$i]
			);
		}
		$this->db->insert_batch($table, $courseExamData);
		return ((isset($id) && !empty($id)) ? $id : false);
	}
	
	public function update($table, $updateField, $data,$arg)
	{
		$this->db->where($updateField, $arg);
		$this->db->update($table, $data);
		return ((isset($arg) && !empty($arg)) ? $arg : false);
	}
	
	public function Another_update( $table, $updateField, $id, $post )
	{
		if(isset($id) && !empty($id)){
			$this->db->where_in($updateField, $id);
			$this->db->delete($table);
			
			$pcnt = count($post['partition']);
			$qtcnt = count($post['question_type']);
			$qcnt = count($post['no_of_question']);
			for($i=0;$i<$pcnt;$i++){
				$courseExamData[] = array(
					'course_id' => $id,
					'questiontype_id' => $post['question_type'][$i],
					'partition_id' => $post['partition'][$i],
					'no_of_questions' => $post['no_of_question'][$i]
				);
			}
			$this->db->insert_batch($table, $courseExamData);
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
	
	public function getSelected($table, $selected_field, $id)
	{
		if( !empty($table) && !empty($selected_field) && !empty($id) )
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($selected_field, $id);
			$query = $this->db->get();

			$queryVal = $query->result();
			return $queryVal[0];
		}
		return false;
	}
	
	public function getSelected_List($table, $selected_field, $id)
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
	
    public function saveUserAccount($data,$profile)
	{
		$this->db->insert('fb_users', $data);
        $uid = $this->db->insert_id(); 
		$profileuseridData = array(
			'user_id' => $uid
		);
		$profileData = array_merge($profileuseridData,$profile);
		$this->db->insert('fb_user_profiles', $profileData);
		$profileuid = $this->db->insert_id(); 
		return ((isset($profileuid) && !empty($profileuid)) ? true : false);
	}
    
	public function userLoginChk($data)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('user_role upr','upr.user_role_id = u.user_role_id','left');
		$this->db->where('u.username', $data['username']);
		$this->db->where('u.password', md5($data['password']));
		$this->db->where('u.status', 1);
		$this->db->where_in('u.user_role_id', array('1','2','7'));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal[0];
	}
	
	public function getUserRole()
	{
		$this->db->select( array('fb_user_role_id','user_role_name'));
		$this->db->from('fb_user_roles');
		$this->db->where('fb_user_role_id !=', 1);
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getUserData()
	{
		$this->db->select( '*' );
		$this->db->from('fb_users u');
		$this->db->join('fb_user_profiles up','up.user_id = u.user_id','right');
		$this->db->join('fb_user_roles ur','ur.fb_user_role_id = u.fb_user_role_id','right');
		$this->db->where('u.fb_user_role_id !=', 1);
		$this->db->order_by('u.user_id','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal;
	}
	
	
    
}    
