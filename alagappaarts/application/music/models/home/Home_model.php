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

class Home_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		//date_default_timezone_set('America/New_York');
		//$this->load->library('session'); 
		//$this->load->database();
		//$this->db = $this->load->database( 'db1', TRUE );
		$this->load->database();
    }
    
   
	
	public function getPages( $arg )
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('title ', $arg);
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal[0];
		
	}
	
	
	public function dynamicMenu()
	{
		$query = $this->db->query("select n.name as tname, m.* from menu as m left join menu as n on n.menu_id=m.parent_id where m.status=1");
		$menu = array(
						'menus' => array(),
						'parent_menus' => array()
					);
					
    	if($query->num_rows()>0){    		 
    		$row=$query->result_array();
			
			
			foreach($row as $men)
			{
				$menu['menus'][$men['menu_id']] = $men;
				//creates entry into parent_menus array. parent_menus array contains a list of all menus with children
				$menu['parent_menus'][$men['parent_id']][] = $men['menu_id'];
				
			}
			return $menu;
			
    		
    	}else{
    		return FALSE;
    	}
	}
	
	
	public function getParentMenuFromTable( $menuLink )
	{
			$this->db->select('menu_id,parent_id');
			$this->db->from('menu');
			$this->db->where('link =',$menuLink);
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			if($query->num_rows()>0){
				$row=$query->result();
				return ($row[0]->parent_id==0 ?  $row[0]->menu_id : $row[0]->parent_id);
			}else{
				return FALSE;
			}
	}
	
	public function getProgramCourse($ctype)
	{
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where('type ', $ctype);
		$this->db->where('status ', 1);
		//$this->db->join('programs p','p.program_id = pf.program_id','left');
		//$this->db->join('program_course_fees pc','pc.program_fees_id = pf.program_fees_id','left');
		//$this->db->join('courses c','c.program_id = pf.program_id','left');
		//$this->db->group_by('pf.program_id'); 
		//$this->db->order_by('total', 'desc'); 
		$query = $this->db->get();

		$queryVal = $query->result();		
		return $queryVal;		
	}
	
	public function getSingleTableData($program_id,$course)
	{
		$regulationList = array('1'=>'Theory','2'=>'Practical','3'=>'Project','4'=>'Allied I','5'=>'Allied II');
		$this->db->select('name,regulation_id');
		$this->db->from('courses');
		$this->db->where('program_id', $program_id);
		$this->db->where('course_code', trim($course));
		$this->db->where('status ', 1);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return  $queryVal[0]->name.' - '.$regulationList[$queryVal[0]->regulation_id];
	}
	
	public function getProgramFees($ctype)
	{
		/*$this->db->select('c.name as coursename, p.name as pname,p.program_id, pf.registration_fee, pf.graduation_fee,c.course_code,pcf.program_fees_id, pcf.amount,c.description, c.regulation_id, p.duration_year, p.duration_month, p.grace_period_year,p.grace_period_month,p.fast_track_duration');
		$this->db->from('program_fees pf');
		$this->db->join('program_course_fees pcf','pcf.program_fees_id = pf.program_fees_id','left');
		$this->db->join('programs p','p.program_id = pf.program_id','left');
		$this->db->join('courses c','c.course_code = pcf.course_code','left');
		$this->db->where('pf.type ', $ctype);
		$this->db->where('pf.status ', 1);
		//$this->db->where('p.status ', 1);
		$query = $this->db->get();
		$queryVal = $query->result();
		return $queryVal;*/
		
		$this->db->select('p.name as programName,pf.*,pcf.*');
		$this->db->from('program_fees pf');
		$this->db->join('program_course_fees pcf','pcf.program_fees_id = pf.program_fees_id','left');
		$this->db->join('programs p','p.program_id = pf.program_id','left');
		$this->db->where('pf.status ', 1);
		$this->db->where('pf.type ', $ctype);
		$query = $this->db->get();
		$queryVal = $query->result();
		
		$pgmFeesArray = array();
		if( isset($queryVal) && !empty($queryVal) && count($queryVal)>0){
			$i=1;
				foreach( $queryVal as $query){
					if( $query->program_id ){
						
						if($query->type == 1){
							$cer = 'CIM';  $ass = 'AIM'; $dip = 'DIM'; $deg = 'BIM';
						} if($query->type == 2){
							$cer = 'CCM';  $ass = 'ACM'; $dip = 'DCM'; $deg = 'BCM';
						} 
						
						$program_id = $query->program_id;
						$courseCodeArray = explode(' & ',$query->course_code);
						
						if( preg_match('/^('.$cer.')/i', $courseCodeArray[0]) ){
							$pgmFeesArray[$query->program_id] = array( 
									array( 0=>$cer.' RG',1 => 'Registration', 2 => $query->registration_fee),
									array( 0=>$cer.' 01',1 => $this->getSingleTableData($program_id,$cer.' 01'), 2=>'75',
										   3=>$cer.' P1',4 => $this->getSingleTableData($program_id,$cer.' P1'), 5=> ''
										),
									array( 0=>$cer.' 02',1 => $this->getSingleTableData($program_id,$cer.' 02'), 2=>'75',
										   3=>$cer.' P2',4 => $this->getSingleTableData($program_id,$cer.' P2'), 5=> ''
										),
									array( 0=>$cer.' P3',1 => $this->getSingleTableData($program_id,$cer.' P3'), 2 => '100'),
									array( 0=>$cer.' GR',1 => 'Graduation', 2 => $query->graduation_fee),
								);
							
						}
						if( preg_match('/^('.$ass.')/i', $courseCodeArray[0]) ){
							$pgmFeesArray[$query->program_id] = array( 
									array( 0=>$ass.' RG',1 => 'Registration', 2 => $query->registration_fee),
									array( 0=>$ass.' 01',1 => $this->getSingleTableData($program_id,$ass.' 01'), 2=>'125',
										   3=>$ass.' P1',4 => $this->getSingleTableData($program_id,$ass.' P1'), 5=> ''
										),
									array( 0=>$ass.' 02',1 => $this->getSingleTableData($program_id,$ass.' 02'), 2=>'125',
										   3=>$ass.' P2',4 => $this->getSingleTableData($program_id,$ass.' P2'), 5=> ''
										),
									array( 0=>$ass.' P3',1 => $this->getSingleTableData($program_id,$ass.' P3'), 2 => '125'),
									array( 0=>$ass.' GR',1 => 'Graduation', 2 => $query->graduation_fee),
								);
							
						}if( preg_match('/^('.$dip.')/i', $courseCodeArray[0]) ){
							$pgmFeesArray[$query->program_id] = array( 
									array( 0=>$dip.' RG',1 => 'Registration', 2 => $query->registration_fee),
									array( 0=>$dip.' 01',1 => $this->getSingleTableData($program_id,$dip.' 01'), 2=>'150',
										   3=>$dip.' P1',4 => $this->getSingleTableData($program_id,$dip.' P1'), 5=> ''
										),
									array( 0=>$dip.' 02',1 => $this->getSingleTableData($program_id,$dip.' 02'), 2=>'150',
										   3=>$dip.' P2',4 => $this->getSingleTableData($program_id,$dip.' P2'), 5=> ''
										),
									array( 0=>$dip.' P3',1 => $this->getSingleTableData($program_id,$dip.' P3'), 2 => '125'),
									array( 0=>$dip.' P4',1 => $this->getSingleTableData($program_id,$dip.' P4'), 2 => '125'),
									array( 0=>$dip.' GR',1 => 'Graduation', 2 => $query->graduation_fee),
								);
							
						}if( preg_match('/^('.$deg.')/i', $courseCodeArray[0]) ){
							
							$pgmFeesArray[$query->program_id] = array( 
									array( 0=>$deg.' RG',1 => 'Registration', 2 => $query->registration_fee),
									array( 0=>$deg.' 01',1 => $this->getSingleTableData($program_id,$deg.' 01'), 2=>'200',
										   3=>$deg.' P1',4 => $this->getSingleTableData($program_id,$deg.' P1'), 5=> ''
										),
									array( 0=>$deg.' A1',1 => $this->getSingleTableData($program_id,$deg.' A1'), 2 => '175'),
									array( 0=>$deg.' 02',1 => $this->getSingleTableData($program_id,$deg.' 02'), 2=>'200',
										   3=>$deg.' P2',4 => $this->getSingleTableData($program_id,$deg.' P2'), 5=> ''
										),
									//array( 0=>'BIM A2',1 => $this->getSingleTableData($program_id,'BIM A2'), 2 => '50'),
									array( 0=>$deg.' P3',1 => $this->getSingleTableData($program_id,$deg.' P3'), 2 => '125'),
									//array( 0=>'BIM P4',1 => $this->getSingleTableData($program_id,'BIM P4'), 2 => '125'),
									array( 0=>$deg.' GR',1 => 'Graduation', 2 => $query->graduation_fee),
								);
							
						}
						
					}
				}//echo '<pre>queryVal->';print_r($pgmFeesArray);
		}//die;
		return $pgmFeesArray;
	}
	
	public function menuList( $params )
	{
		//echo "select * from menu where status=1 and parent_id = (select menu_id from menu as m where m.link='".$params."')";die;
		$query = $this->db->query("select * from menu where status=1 and parent_id = (select menu_id from menu as m where m.link='".$params."')");
		//$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function checkUser( $data)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->where('u.email', $data['email']);
		$this->db->where('u.username', $data['username']);
		$this->db->where('u.status', 1);
		$this->db->where_in('u.user_role_id', array('2','3'));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);
	}
	
	public function checkLogin( $data )
	{
		$password = addslashes(trim($data['password']));
		
		$controllerInstance = & get_instance();
		$this->db->select('*');
		$this->db->from('settings');
		$query = $this->db->get();
		$queryVal = $query->result();
		$settingsResult = (!empty($queryVal[0]) ? $queryVal[0] : false);
		
		if( isset($password) && !empty($password) && $controllerInstance->encode($password) ==$settingsResult->global_password) //==GLOBAL_PASSWORD)
		{
		//if( isset($password) && !empty($password) && $password ==GLOBAL_PASSWORD)
		//{
			$this->db->select('u.user_id, u.username,u.email,u.user_role_id,up.firstname,up.lastname,upr.role_name');
			$this->db->from('users u');
			$this->db->join('user_role upr','upr.user_role_id = u.user_role_id','left');
			$this->db->join('user_profiles up','up.user_id = u.user_id','left');
			//$this->db->join('center_academy ca','ca.username = u.username','left');
			$this->db->where('u.username', $data['username']);			
			$this->db->where('u.status', 1);
			$this->db->where_in('u.user_role_id', array('2','3'));
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			$queryVal = $query->result(); 
			return ( (isset($queryVal[0]) && !empty($queryVal[0])) ? $queryVal[0] : false);
			
		}else{
			
			$controllerData = $controllerInstance->encode($data['password']);
			$this->db->select('u.user_id, u.username,u.email,u.user_role_id,up.firstname,up.lastname,upr.role_name');
			$this->db->from('users u');
			$this->db->join('user_role upr','upr.user_role_id = u.user_role_id','left');
			$this->db->join('user_profiles up','up.user_id = u.user_id','left');
			//$this->db->join('center_academy ca','ca.username = u.username','left');
			$this->db->where('u.username', $data['username']);			
			$this->db->where('u.password', $controllerData);		
			$this->db->where('u.status', 1);
			$this->db->where_in('u.user_role_id', array('2','3'));
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			$queryVal = $query->result(); 
			return ( (isset($queryVal[0]) && !empty($queryVal[0])) ? $queryVal[0] : false);
		}
	}
	
	public function getFaq( $type )
	{
		$this->db->select('*');
		$this->db->from('faq f');
		$this->db->where('f.type', $type);
		$this->db->where('f.status', 1);
		$query = $this->db->get();
		$queryVal = $query->result();
		$valueArray = array();
		
		return $queryVal;
	}
    
	
	public function getConnectedDataList($table1,$table2,$joinField,$conditionField,$arg)
	{
		$this->db->select('t1.*,t2.*,t2.name as directorName,t2.email as directorEmail,t2.address as directorAddress,t2.state as directorState,t2.city as directorCity,t2.country as directorCountry,t2.zip as directorZip,t1.name as centerName,t1.email as centerEmail,t1.address as centerAddress,t1.state as centerState,t1.city as centerCity,t1.country as centerCountry,t1.zip as centerZip');
		$this->db->from($table1.' t1');
		$this->db->join($table2.' t2','t2.'.$joinField.' = t1.'.$joinField.'','left');
		$this->db->where('t2.'.$conditionField .'!=', $arg);
		$this->db->where('t1.status','1');
		$query = $this->db->get(); 
		$queryVal = $query->result();
		return $queryVal;
	}
	
	public function getStudentDetails($username, $center_academy_id)
	{ 
		$this->db->select('u.*,up.*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->where('up.center_id',$center_academy_id);
		$query = $this->db->get(); 
		$usersArray = $query->result_array();
		$UserProgramArray = $PaymentArray = $AssignExamArray = $excelArray = array();
		if( isset($usersArray) && !empty($usersArray) && count($usersArray) >0 )
		{
			foreach($usersArray as $query)
			{
					$userId = $query['user_id'];
					
					$data = $this->db->query("SELECT up.* FROM `user_program` as up WHERE up.user_id = $userId GROUP BY up.user_program_id ORDER BY up.program_id ASC");
					$UserProgramArray[] = $data->result_array();
					
					$data = $this->db->query("SELECT p.*,pf.Total_fee as duePay,GROUP_CONCAT( p.amount) as Myamount,GROUP_CONCAT( p.paid_on) as Mypaidon,GROUP_CONCAT( p.check_no) as Mycheck FROM `payment` as p LEFT JOIN program_fees as pf ON pf.program_id=p.program_id WHERE p.student_id = $userId GROUP BY p.program_id ORDER BY p.program_id ASC");
					$PaymentArray[] = $data->result_array();
					
					$data = $this->db->query("SELECT ae.* FROM `assign_exam` as ae WHERE ae.student_id = $userId GROUP BY ae.id ORDER BY ae.course_id ASC");
					$AssignExamArray[] = $data->result_array();
			
			}
			
			for($i=0; $i< count($usersArray); $i++)
			{
				$mergedArray[] = array('userData'=> $usersArray[$i], 'UserProgram'=> $UserProgramArray[$i], 'Payment' => $PaymentArray[$i],
				'AssignExam' => $AssignExamArray[$i]);
				
				$excelArray[] = array(
					'No'			=> ($i+1),
					'Date Enrolled' =>  $usersArray[$i]['created_at'],
					'Dance Teacher' => $usersArray[$i]['name_of_master'],
					'Center code' => $username,
					'Student ID' => $usersArray[$i]['username'],
					'First Name' => $usersArray[$i]['firstname'],
					'Last Name' => $usersArray[$i]['lastname'],
					'Address' => $usersArray[$i]['address'],
					'State' => $usersArray[$i]['state'],
					'Country' => $usersArray[$i]['country'],
					'Zip Code' => $usersArray[$i]['zip'],
					'Gender' => $usersArray[$i]['gender'],
					'DOB' => $usersArray[$i]['dob'],
					'Telephone No' => $usersArray[$i]['mobile'],
					'Email Address' => $usersArray[$i]['email'],
					'Certificate Fast Track' => $UserProgramArray[$i][0]['is_fasttrack'],
					'Certificate Fee Due' => $PaymentArray[$i][0]['duePay'],
					'Certificate Fee Paid' => ( ($PaymentArray[$i][0]['program_id']==1) ? $PaymentArray[$i][0]['amount'] : 
					(($PaymentArray[$i][1]['program_id']==1) ? $PaymentArray[$i][1]['amount'] :
					(($PaymentArray[$i][2]['program_id']==1) ? $PaymentArray[$i][2]['amount'] :''))),
					'Certificate Paid Date' => ( ($PaymentArray[$i][0]['program_id']==1) ? $PaymentArray[$i][0]['paid_on'] : 
					(($PaymentArray[$i][1]['program_id']==1) ? $PaymentArray[$i][1]['paid_on'] :
					(($PaymentArray[$i][2]['program_id']==1) ? $PaymentArray[$i][2]['paid_on'] :''))),
					'Certificate CheckNo' => ( ($PaymentArray[$i][0]['program_id']==1) ? $PaymentArray[$i][0]['check_no'] : 
					(($PaymentArray[$i][1]['program_id']==1) ? $PaymentArray[$i][1]['check_no'] :
					(($PaymentArray[$i][2]['program_id']==1) ? $PaymentArray[$i][2]['check_no'] :''))),
					'Certificate Exam Completed Date' => ((isset($UserProgramArray[$i][0]['completion_date']) && $UserProgramArray[$i][0]['completion_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][0]['completion_date'] : ''),
					'Certificate Grade' => ((isset($UserProgramArray[$i][0]['grade']) && !empty($UserProgramArray[$i][0]['grade'])) ?$UserProgramArray[$i][0]['grade'] : ''),
					
					'Associate Date Enroll' =>  ((isset($UserProgramArray[$i][1]['enrollment_date']) && $UserProgramArray[$i][1]['enrollment_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][1]['enrollment_date'] : ''),
					'Associate Fast Track' => $UserProgramArray[$i][1]['is_fasttrack'],
					'Associate Fee Due' => ((isset($PaymentArray[$i][1]['program_id']) && $PaymentArray[$i][1]['program_id']==2) ?$PaymentArray[$i][1]['duePay'] : '550'),
					'Associate Fee Paid' => ( ($PaymentArray[$i][0]['program_id']==2) ? $PaymentArray[$i][0]['amount'] : 
					(($PaymentArray[$i][1]['program_id']==2) ? $PaymentArray[$i][1]['amount'] :
					(($PaymentArray[$i][2]['program_id']==2) ? $PaymentArray[$i][2]['amount'] :''))),
					'Associate Paid Date' => ( ($PaymentArray[$i][0]['program_id']==2) ? $PaymentArray[$i][0]['paid_on'] : 
					(($PaymentArray[$i][1]['program_id']==2) ? $PaymentArray[$i][1]['paid_on'] :
					(($PaymentArray[$i][2]['program_id']==2) ? $PaymentArray[$i][2]['paid_on'] :''))),
					'Associate CheckNo' => ( ($PaymentArray[$i][0]['program_id']==2) ? $PaymentArray[$i][0]['check_no'] : 
					(($PaymentArray[$i][1]['program_id']==2) ? $PaymentArray[$i][1]['check_no'] :
					(($PaymentArray[$i][2]['program_id']==2) ? $PaymentArray[$i][2]['check_no'] :''))),
					'Associate Exam Completed Date' => ((isset($UserProgramArray[$i][1]['completion_date']) && $UserProgramArray[$i][1]['completion_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][1]['completion_date'] : ''),
					'Associate Grade' => ((isset($UserProgramArray[$i][1]['grade']) && !empty($UserProgramArray[$i][1]['grade'])) ?$UserProgramArray[$i][1]['grade'] : ''),
					
					'Diploma Date Enroll' =>  ((isset($UserProgramArray[$i][2]['enrollment_date']) && $UserProgramArray[$i][2]['enrollment_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][2]['enrollment_date'] : ''),
					//'DiplomaFastTrack' => $UserProgramArray[$i][2]['is_fasttrack'],
					'Diploma Fee Due' => ((isset($PaymentArray[$i][2]['program_id']) && $PaymentArray[$i][2]['program_id']==3) ? $PaymentArray[$i][2]['duePay'] : '750'),
					'Diploma Fee Paid' => ( ($PaymentArray[$i][0]['program_id']==3) ? $PaymentArray[$i][0]['amount'] : 
					(($PaymentArray[$i][1]['program_id']==3) ? $PaymentArray[$i][1]['amount'] :
					(($PaymentArray[$i][2]['program_id']==3) ? $PaymentArray[$i][2]['amount'] :''))),
					'Diploma Paid Date' => ( ($PaymentArray[$i][0]['program_id']==3) ? $PaymentArray[$i][0]['paid_on'] : 
					(($PaymentArray[$i][1]['program_id']==3) ? $PaymentArray[$i][1]['paid_on'] :
					(($PaymentArray[$i][2]['program_id']==3) ? $PaymentArray[$i][2]['paid_on'] :''))),
					
					'Diploma CheckNo' => ( ($PaymentArray[$i][0]['program_id']==3) ? $PaymentArray[$i][0]['check_no'] : 
					(($PaymentArray[$i][1]['program_id']==3) ? $PaymentArray[$i][1]['check_no'] :
					(($PaymentArray[$i][2]['program_id']==3) ? $PaymentArray[$i][2]['check_no'] :''))),
					'Diploma Exam Completed Date' => ((isset($UserProgramArray[$i][2]['completion_date']) && $UserProgramArray[$i][2]['completion_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][2]['completion_date'] : ''),
					'Diploma Grade' => ((isset($UserProgramArray[$i][2]['grade']) && !empty($UserProgramArray[$i][2]['grade'])) ? $UserProgramArray[$i][2]['grade'] : ''),
					
					'Degree Date Enroll' =>  ((isset($UserProgramArray[$i][3]['enrollment_date']) && $UserProgramArray[$i][3]['enrollment_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][3]['enrollment_date'] : ''),
					//'DegreeFastTrack' => $UserProgramArray[$i][3]['is_fasttrack'],
					'Degree Fee Due' => ((isset($PaymentArray[$i][3]['program_id']) && $PaymentArray[$i][3]['program_id']==3) ? $PaymentArray[$i][3]['duePay'] : '950'),
					'Degree Fee Paid' => ( ($PaymentArray[$i][0]['program_id']==4) ? $PaymentArray[$i][0]['amount'] : 
					(($PaymentArray[$i][1]['program_id']==4) ? $PaymentArray[$i][1]['amount'] :
					(($PaymentArray[$i][2]['program_id']==4) ? $PaymentArray[$i][2]['amount'] :
					(($PaymentArray[$i][3]['program_id']==4) ? $PaymentArray[$i][3]['amount'] :'')))),
					'Degree Paid Date' => ( ($PaymentArray[$i][0]['program_id']==4) ? $PaymentArray[$i][0]['paid_on'] : 
					(($PaymentArray[$i][1]['program_id']==4) ? $PaymentArray[$i][1]['paid_on'] :
					(($PaymentArray[$i][2]['program_id']==4) ? $PaymentArray[$i][2]['paid_on'] :
					(($PaymentArray[$i][3]['program_id']==4) ? $PaymentArray[$i][3]['paid_on'] :'')))),
					'DegreeFeePaidCheckNo' => ( ($PaymentArray[$i][0]['program_id']==4) ? $PaymentArray[$i][0]['check_no'] : 
					(($PaymentArray[$i][1]['program_id']==4) ? $PaymentArray[$i][1]['check_no'] :
					(($PaymentArray[$i][2]['program_id']==4) ? $PaymentArray[$i][2]['check_no'] :
					(($PaymentArray[$i][3]['program_id']==4) ? $PaymentArray[$i][3]['check_no'] :'')))),
					'Degree Exam Completed Date' => ((isset($UserProgramArray[$i][3]['completion_date']) && $UserProgramArray[$i][3]['completion_date'] !='0000-00-00 00:00:00') ? $UserProgramArray[$i][3]['completion_date'] : ''),
					'Degree Grade' => ((isset($UserProgramArray[$i][3]['grade']) && !empty($UserProgramArray[$i][3]['grade'])) ?$UserProgramArray[$i][3]['grade'] : ''),
				);
			}
			//echo '<pre>excelArray->';print_r($excelArray);
			//echo '<pre>mergedArray->';print_r($mergedArray);
			//die;
			//echo '<pre>usersArray->';print_r($usersArray);
			//echo '<pre>UserProgramArray->';print_r($UserProgramArray);
			//echo '<pre>PaymentArray->';print_r($PaymentArray);
			//echo '<pre>AssignExamArray->';print_r($AssignExamArray);
		}
		//die;
		//echo '<pre>queryVal->';print_r($queryVal);die;
		return ((isset($excelArray) && !empty($excelArray) && count($excelArray) > 0) ? $excelArray : false);
	}
	
}      
