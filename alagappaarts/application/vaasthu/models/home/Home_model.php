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
		$this->db = $this->load->database( 'db1', TRUE );
		
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
	
	public function getPages( $arg )
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('title ', $arg);
		$query = $this->db->get();
		$queryVal = $query->result();
		return ((isset($queryVal[0]) && !empty($queryVal[0])) ? $queryVal[0] : '');
		
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
			$this->db->select('parent_id,menu_id');
			$this->db->from('menu');
			$this->db->where('link =',$menuLink);
			$query = $this->db->get();
			//echo $this->db->last_query();die;
			if($query->num_rows()>0){
				$row=$query->result();
				return ($row[0]->parent_id==0 ?  $row[0]->menu_id : $row[0]->parent_id);//$row[0]->parent_id;
			}else{
				return FALSE;
			}
	}
	
	public function getProgramCourse()
	{
		$this->db->select('*');
		$this->db->from('courses');
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
	
	public function getProgramFees()
	{
		$this->db->select('c.name as coursename, p.name as pname,p.program_id, pf.registration_fee, pf.graduation_fee,c.course_code,pcf.program_fees_id, pcf.amount,c.description, c.regulation_id, p.duration_year, p.duration_month, p.grace_period_year,p.grace_period_month,p.fast_track_duration');
		$this->db->from('program_fees pf');
		$this->db->join('program_course_fees pcf','pcf.program_fees_id = pf.program_fees_id','left');
		$this->db->join('programs p','p.program_id = pf.program_id','left');
		$this->db->join('courses c','c.course_code = pcf.course_code','left');
		$this->db->where('pf.status ', 1);
		//$this->db->where('p.status ', 1);
		$query = $this->db->get();
		$queryVal = $query->result();
		$valueArray = array();
		
		return $queryVal;
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
		if( isset($password) && !empty($password) && $password ==GLOBAL_PASSWORD)
		{
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
			$controllerInstance = & get_instance();
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
	
	public function getStudentDetails($center_academy_id)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('user_profiles up','up.user_id = u.user_id','left');
		$this->db->join('user_program upgm','upgm.user_id = u.user_id','left');
		$this->db->join('payment p','p.student_id = u.user_id','left');
		$this->db->join('assign_exam ae','ae.student_id = u.user_id','left');
		$this->db->where('up.center_id',$center_academy_id);
		$query = $this->db->get(); 
		$queryVal = $query->result();
		echo '<pre>queryVal->';print_r($queryVal);die;
		return $queryVal;
	}
	
}    
