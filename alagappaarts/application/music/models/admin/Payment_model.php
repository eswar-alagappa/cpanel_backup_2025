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
		$this->load->database();
		
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
	
	public function paymentList($program_id,$center_id)
	{
		$condition = '';
		if( isset($program_id) && !empty($program_id)){
			//$this->db->where('upr.program_id', $program_id);
			$condition .= ' AND up.program_id='.$program_id;
		}if( isset($center_id) && !empty($center_id)){
			//$this->db->where('upr.center_id', $center_id);
			$condition .= ' AND up.center_id='.$center_id;
		}
		$data = $this->db->query("SELECT uu.firstname, uu.lastname, u.*,up.*,p.*,pf.Total_fee as totalFee FROM `users` as u JOIN user_program as up JOIN programs as p ON  p.program_id=up.program_id LEFT JOIN program_fees as pf ON pf.program_id=up.program_id LEFT JOIN user_profiles as uu ON uu.user_id=u.user_id where up.user_id=u.user_id ".$condition." GROUP BY up.user_program_id ORDER BY u.user_id DESC LIMIT 1000 ");
		$usersArray = $data->result_array();
		$paymentList = array();
		if( isset($usersArray) && !empty($usersArray)){			
			foreach($usersArray as $user){
				//echo '<pre>user->';print_r($user);
				$payment_detail = $this->getPayment($user['user_id'],$user['program_id']);
				if( count($payment_detail) >1){
					$sum = 0;
					foreach($payment_detail as $pay){
						$sum += $pay->amount;
					} 
					$sumAmt = $sum;
				}else{
					$sumAmt = ((isset($payment_detail[0]->amount) && !empty($payment_detail[0]->amount)) ? $payment_detail[0]->amount : '');
				}
				//echo '<pre>Payment->';print_r($payment_detail);
				if( (isset($payment_detail) && !empty($payment_detail) && $sumAmt != $user['totalFee']) || ( empty($payment_detail)) )
				$paymentList[] = array(
										'created' => $user['created_at'],
										'updated' => $user['updated_at'],
										'username' => $user['username'],
										'firstname' => $user['firstname'],
										'lastname' => $user['lastname'],
										'dateofjoin' => $user['enrollment_date'],
										'program' => $user['name'],
										'total_fee' => $user['totalFee'],
										'paidAmt' => ((isset($payment_detail[0]->amount) && !empty($payment_detail[0]->amount)) ? $payment_detail[0]->amount : '-'),
										'outstandingAmt' => ((isset($payment_detail[0]->amount) && !empty($payment_detail[0]->amount)) ? $user['totalFee'] - $payment_detail[0]->amount : '-'),
										'user_id' => $user['user_id']
									);
			}
		}//die;
		return $paymentList;		
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
