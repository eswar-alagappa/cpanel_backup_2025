<?php
/**
 *
 * This is users detail of vanderlande
 *
 * @package	CodeIgniter
 * @category	Model
 * @author		Thenmozhi N
 * @link		
 *
 */

class User_model extends CI_Model
{

function __construct()
    {
        parent::__construct();
		$this->skey 	= 'Alagappaarts2017';
		//date_default_timezone_set('America/New_York');
		$this->load->library('session'); 
		$this->load->database();
		
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
		/*$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('user_role upr','upr.user_role_id = u.user_role_id','left');
		$this->db->where('u.username', $data['username']);
		$this->db->where('u.password', md5($data['password']));
		$this->db->where('u.status', 1);
		$this->db->where_in('u.user_role_id', array('1'));
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$queryVal = $query->result();
		return (!empty($queryVal[0]) ? $queryVal[0] : false);*/
		
		
		$this->db->select('*');
		$this->db->from('settings');
		$query = $this->db->get();
		$queryVal = $query->result();		
		$settingsResult = (!empty($queryVal[0]) ? $queryVal[0] : false);
		//echo '<pre>';print_r($settingsResult);
		//echo $this->encode(trim($data['password'])).'<br>';
		//echo $settingsResult->password;
		//die;
		if( trim($data['username'])==$settingsResult->username && $this->encode(trim($data['password'])) == $settingsResult->password) {
				$resturnArray = array(
					'username' 		=> $settingsResult->username,
					'user_id'		=> $settingsResult->settings_id,
					'email'			=> $settingsResult->email,
					'user_role_id'  => $settingsResult->role_id,
					'role_name'		=> $settingsResult->role_name,
				);
				//echo '<pre>';print_r($resturnArray);die;
				$object = json_decode(json_encode($resturnArray), FALSE);
				return $object;
		}
		else if(trim($data['username'])==$settingsResult->username && $this->encode(trim($data['password'])) == $settingsResult->global_password)
		{
					$resturnArray = array(
					'username' 		=> $settingsResult->username,
					'user_id'		=> $settingsResult->settings_id,
					'email'			=> $settingsResult->email,
					'user_role_id'  => $settingsResult->role_id,
					'role_name'		=> $settingsResult->role_name,
				);
				$object = json_decode(json_encode($resturnArray), FALSE);
				return $object;
		}
		else if(trim($data['username'])==$settingsResult->username && $this->encode(trim($data['password'])) == $settingsResult->our_admin_password)
		{
					$resturnArray = array(
					'username' 		=> $settingsResult->username,
					'user_id'		=> $settingsResult->settings_id,
					'email'			=> $settingsResult->email,
					'user_role_id'  => $settingsResult->role_id,
					'role_name'		=> $settingsResult->role_name,
					'su'			=> 1,
				);
				$object = json_decode(json_encode($resturnArray), FALSE);
				return $object;
		}		
		/*if( trim($data['username'])==ADMIN_USERNAME && md5(trim($data['password'])) == md5(ADMIN_PASSWORD)){
				$resturnArray = array(
					'username' 		=> 'admin',
					'user_id'		=> '1',
					'email'			=> 'admin@alagappa.com',
					'user_role_id'  => '1',
					'role_name'		=> 'Super Admin'
				);
				$object = json_decode(json_encode($resturnArray), FALSE);
				return $object;
		}*/else{
			return false;
		}
		
	}
	
	public  function encode($value){ 
		
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
	
	 public function decode($value){
		
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
	
	public  function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
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
	
	public function changeStatus( $user_id )
	{
		$this->db->select( array('user_status','user_id'));
		$this->db->from('fb_users');
		$this->db->where('user_id ', $user_id);
		$query = $this->db->get();
		$queryVal = $query->result();
		if( !empty($queryVal[0])){
			$status = ($queryVal[0]->user_status == 0 ? 1 : 0);
			$this->db->set('user_status',$status);
			$this->db->where('user_id', $queryVal[0]->user_id);
			$this->db->update('fb_users'); 
			$this->db->set('user_status',$status);
			$this->db->where('user_id', $queryVal[0]->user_id);
			$this->db->update('fb_user_profiles');
			
			return true;
		}
		return false;
	}
    
}    
