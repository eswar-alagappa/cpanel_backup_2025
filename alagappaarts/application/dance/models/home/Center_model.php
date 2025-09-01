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

class Center_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		$this->load->database();
		
    }
    
    public function update($table, $updateField, $data,$arg)
	{
		$this->db->where($updateField, $arg);
		$this->db->update($table, $data);
		return ((isset($arg) && !empty($arg)) ? $arg : false);
	}
	
	public function checkPassword($pass, $user_id)
	{
		$this->db->select('*');
		$this->db->from('users u');
		//$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->where('u.password', $pass);
		$this->db->where('u.user_id', $user_id);
		$this->db->where('u.status', 1);
		$this->db->where_in('u.user_role_id', '3');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
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
	
	public function Another_save( $table, $id, $relevant_id, $data)
	{
		$this->db->set($relevant_id, $id);
		$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id(); 
		return ((isset($id) && !empty($id)) ? $id : false);
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
	
	
	public function getData( $table, $table2,$table3, $field, $user_id)
	{
		//$this->db->select('u.*,up.*,cd.address as caddress,cd.name as cname,cd.city as ccity,cd.state as cstate, cd.country as ccountry,cd.zip as czip,ca.contact as ccontact');
		$this->db->select('u.*,ca.*, ca.name as academyName,ca.email as academyEmail,ca.address as academyAddress,ca.city as academyCity, ca.state as academyState,ca.zip as academyZip,ca.country as academyCountry,cd.*');
		$this->db->from($table.' u');
		$this->db->join($table2.' ca','ca.contact = u.mobile','left');
		$this->db->join($table3.' cd','cd.center_academy_id = ca.center_academy_id','left');
		$this->db->where('u.'.$field, $user_id);
		$this->db->where('u.status', 1);	
		$this->db->where('u.user_role_id', 3);		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function getId($table,$field,$id)
	{
		$this->db->select('t.*');
		$this->db->from($table.' t');
		//$this->db->where('t.'.$field, $id);
		$this->db->like('t.'.$field, $id);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function studentPersonal($user_id)
	{
		$this->db->select('u.*,up.*,p.name as programName,c.name as centerName');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->join('user_program upgm','upgm.user_id = u.user_id','left');
		$this->db->join('programs p','p.program_id = upgm.program_id','left');
		$this->db->join('center_academy c','c.center_academy_id = upgm.center_id','left');
		$this->db->where('u.user_id',$user_id);
		$this->db->where('u.status',1);
		$this->db->order_by('u.user_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal[0];
	}
	
	public function StudentList( $center_id ,$limit, $start)
	{
		$this->db->select('u.*,up.*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->where('u.status',1);
		$this->db->order_by('u.user_id','DESC');
		$this->db->limit($limit,$start );
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function StudentListCnt( $center_id)
	{
		$this->db->select('u.*,up.*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->where('u.status',1);
		$this->db->order_by('u.user_id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function PaymentList( $center_id ,$limit, $start)
	{
		$this->db->select('up.*,p.*,pr.name as programName');
		$this->db->from('payment p');
		$this->db->join('user_profiles up','up.user_id = p.student_id','left');
		$this->db->join('programs pr','pr.program_id = p.program_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->order_by('p.paid_on','DESC');
		$this->db->limit($limit,$start );
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function PaymentListCnt( $center_id)
	{
		$this->db->select('up.*,p.*,pr.name as programName');
		$this->db->from('payment p');
		$this->db->join('user_profiles up','up.user_id = p.student_id','left');
		$this->db->join('programs pr','pr.program_id = p.program_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->order_by('p.paid_on','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function examSchedule($center_id,$limit, $start)
	{
		$this->db->select('ae.*,p.name as programName,c.course_code,up.firstname,up.lastname,u.username');
		$this->db->from('assign_exam ae');
		$this->db->join('user_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->join('programs p','p.program_id = c.program_id','left');
		$this->db->join('users u','u.user_id = up.user_id','left');
		$this->db->where('up.center_id',$center_id);
		//$this->db->where_in('ae.result',array('Pass','Fail','Admin reassign'));
		$this->db->order_by('ae.id','DESC');
		$this->db->limit($limit,$start );
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function examScheduleCnt($center_id)
	{
		$this->db->select('ae.*,p.name as programName,c.course_code,up.firstname,up.lastname,u.username');
		$this->db->from('assign_exam ae');
		$this->db->join('user_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->join('programs p','p.program_id = c.program_id','left');
		$this->db->join('users u','u.user_id = up.user_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->where_in('ae.result',array('Pass','Fail','Admin reassign'));
		$this->db->order_by('ae.id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	
	public function examResult($center_id,$limit, $start) 
	{
		$this->db->select('up.firstname,up.lastname,p.name as programName,c.name as CourseName,c.course_code,ae.*');
		$this->db->from('assign_exam ae');
		$this->db->join('user_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->join('programs p','p.program_id = c.program_id','left');
		$this->db->join('users u','u.user_id = up.user_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->where_in('ae.result',array('Pass','Fail','Admin reassign'));
		$this->db->where('u.status',1);
		$this->db->order_by('ae.id','DESC');
		$this->db->limit($limit,$start );
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
	
	public function examResultCnt($center_id)  
	{
		$this->db->select('up.firstname,up.lastname,p.name as programName,c.name as CourseName,c.course_code,ae.*');
		$this->db->from('assign_exam ae');
		$this->db->join('user_profiles up','up.user_id = ae.student_id','left');
		$this->db->join('courses c','c.course_id = ae.course_id','left');
		$this->db->join('programs p','p.program_id = c.program_id','left');
		$this->db->join('users u','u.user_id = up.user_id','left');
		$this->db->where('up.center_id',$center_id);
		$this->db->where_in('ae.result',array('Pass','Fail','Admin reassign'));
		$this->db->where('u.status',1);
		$this->db->order_by('ae.id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal;
	}
    
	
	
}    
