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

class Payment_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		//$this->load->database();
		$this->db = $this->load->database( 'db1', TRUE );
    }
    
	public function getPayment($user_id, $program_id){
		$this->db->select('p.*');
		$this->db->from('payment p');
		$this->db->where('p.student_id', $user_id);
		$this->db->where('p.program_id', $program_id);
		//$this->db->group_by('p.program_id');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getJoinRecordList()
	{
		$this->db->select('u.created_at as dateofjoining,u.*,up.*,p.*,pf.*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->join('user_program upgm','upgm.user_id = u.user_id','left');
		$this->db->join('programs p','p.program_id = upgm.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = upgm.program_id','left');
		//$this->db->join('payment pay','pay.student_id = u.user_id','left');
		$this->db->where('up.user_id !=', '');
		$this->db->order_by('upgm.user_id','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getJoinRecord($user_id)
	{
		$this->db->select('u.created_at as dateofjoining,u.*,up.*,p.*,pf.*,ca.name as centerName,pay.amount as paidAmt');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->join('programs p','p.program_id = up.program_id','left');
		$this->db->join('program_fees pf','pf.program_id = up.program_id','left');
		$this->db->join('center_academy ca','ca.center_academy_id = up.center_id','left');
		$this->db->join('payment pay','pay.program_id = p.program_id AND pay.student_id='.$user_id.'','left');
		$this->db->where('up.user_id', $user_id);
		//$this->db->where('pay.student_id', $user_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal[0];
	}
	
	public function save($table,$data)
	{
		$this->db->insert($table, $data);
        $insert_id = $this->db->insert_id(); 
		return ((isset($insert_id) && !empty($insert_id)) ? $insert_id : false);
	}
	
    
}    
