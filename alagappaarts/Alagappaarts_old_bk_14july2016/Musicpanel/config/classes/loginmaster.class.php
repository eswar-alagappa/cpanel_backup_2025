<?php

class loginmaster
{
	function checklogin($arrlogindetails)
	{
		global $DB;
		
		$queryloginDetails = "select u.userid,u.userroleid,s.studentname,s.studentid from usermaster u
join studentmaster s on s.userid = u.userid
where username='{$arrlogindetails[username]}' and password='{$arrlogindetails[password]}' and userstatus='Active'";

//echo $queryloginDetails;exit;
				
		$rsLoginDetails = $DB -> getArray($queryloginDetails);
		
		
		$count = count($rsLoginDetails);
			
	if($count)
	{			
		$_SESSION[ userinfo ] = $rsLoginDetails[0];
		/**/	if($_SESSION[quesioninfo]){
			header('location:student/editpost.php');
		}
		else{
			
			header("location:student/index.php");
	/**/}
	}
	else 
	{
		$querytutloginDetails = " 	select u.userid,u.userroleid,tm.tutorname,tm.tutorid from usermaster u
										join tutormaster tm on tm.userid = u.userid
										where username='{$arrlogindetails[username]}' and password='{$arrlogindetails[password]}' and userstatus='Active'";
										
										$rstutLoginDetails = $DB -> getArray($querytutloginDetails);
										
										$count = count($rstutLoginDetails);
										
										if($count)
										{
											$_SESSION[ userinfo ] = $rstutLoginDetails[0];
											
											header('location:tutor/index.php');
											
										}
										else{
											
											return "Enter valid username and Password";
										}
	}
	
	
	}
	
	function checkadminlogin($arrlogindetails)
	{
		global $DB;
		//echo $arrlogindetails[username]."<br>";
		//echo $arrlogindetails[]."<br>";
		$admindetail = "SELECT lm.user_id,lm.role_id,am.name ,lm.id
		FROM loginmaster lm JOIN adminmaster am on lm.user_id = am.id 
		JOIN rolemaster rm on lm.role_id = rm.id
		 WHERE lm.username ='{$arrlogindetails[username]}' 
		  AND am.status='Y'";
	//	echo $admindetail ;
		//exit;
		$adminlogindetail = $DB -> getArray($admindetail);
		$count = count($adminlogindetail);
		if($count)
		{
			$ispassword = "SELECT lm.user_id
			FROM loginmaster lm 
			JOIN adminmaster am on lm.user_id = am.id
			 JOIN rolemaster rm on lm.role_id = rm.id WHERE 
			lm.password ='{$arrlogindetails[password]}' and lm.username ='{$arrlogindetails[username]}' and lm.role_id = 1 ";
		//	echo $ispassword;
			//echo md5(GLOBAL_PASSWORD) ."===". $arrlogindetails[password];
			$ispasswordRS = $DB -> getArray($ispassword);
			$countPassword = count($ispasswordRS);
			//exit;
			if($countPassword){
			 $_SESSION[ userinfo ] = $adminlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else if($arrlogindetails[password] == md5(GLOBAL_PASSWORD) ){
			  $_SESSION[ userinfo ] = $adminlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else 
			{
			return "Enter valid email or password";
			}
		}
		else 
		{
		return "Enter valid email or password";
		}
	
	}
	function checkstudentlogin($arrlogindetails)
	{
		global $DB;
		
		$studentdetail = "SELECT lm.user_id,lm.role_id,sm.first_name ,sm.last_name ,lm.id
		  FROM loginmaster lm 
		  JOIN studentmaster sm on lm.user_id = sm.id
		   JOIN rolemaster rm on lm.role_id = rm.id
		    WHERE lm.username ='{$arrlogindetails[username]}' AND sm.status=10";
		$studentlogindetail = $DB -> getArray($studentdetail);
		$count = count($studentlogindetail);
		if($count)
		{
			$ispassword = "SELECT lm.user_id
			FROM loginmaster lm 
			JOIN studentmaster sm on lm.user_id = sm.id
			 JOIN rolemaster rm on lm.role_id = rm.id WHERE 
			lm.password ='{$arrlogindetails[password]}' and lm.username ='{$arrlogindetails[username]}' and lm.role_id = 2 ";
			//echo $ispassword;
			//echo md5(GLOBAL_PASSWORD) ."===". $arrlogindetails[password];
			$ispasswordRS = $DB -> getArray($ispassword);
			$countPassword = count($ispasswordRS);
			//exit;
			if($countPassword){
			 $_SESSION[ studentinfo ] = $studentlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else if($arrlogindetails[password] == md5(GLOBAL_PASSWORD) ){
			  $_SESSION[ studentinfo ] = $studentlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else 
			{
			return "Enter valid email or password";
			}
		}
	 	else 
		{
		return "Enter valid email or password";
		}
	
	}
	function checkStudentloginDetail($studentDetail){
			 global $DB;
		 $isStudentinLoginmaster = "select id from loginmaster where user_id='{$studentDetail[user_id]}' and role_id ='{$studentDetail[role_id]}' ";
		 $rsisStudentinLoginmaster= $DB -> getArray($isStudentinLoginmaster);
	
		return  $rsisStudentinLoginmaster;	
		}
	function getroleid($userrole)
	{
		global $DB;
		$isnull=0;
		$rmroleid = "select id from rolemaster where rolename ='{$userrole}' and status ='Y'";
		echo $rmroleid;
		$result = $DB ->Execute($rmroleid);
		return $result->fields[id];
	}
	function isadmin($arrlogin)
	{
		global $DB;
		$isadmin = 0;
		$queryroleid = "select user_id from adminmaster JOIN loginmaster on adminmaster.id = loginmaster.user_id where
		 loginmaster.role_id= '{$arrlogin[role_id]}' and loginmaster.user_id = '{$arrlogin[user_id]}' and adminmaster.status ='Y'";
		$rsroleid = $DB -> Execute($queryroleid);
		
		if($rsroleid->fields[user_id])
		{
			$isadmin =1;
			
		}
	
		return $isadmin;
	}
	function isstudent($arrlogin)
	{
		global $DB;
		$isstudent = 0;
		$queryroleid = "select user_id from studentmaster JOIN loginmaster on studentmaster.id = loginmaster.user_id where
		 loginmaster.role_id= '{$arrlogin[role_id]}' and loginmaster.user_id = '{$arrlogin[user_id]}' and studentmaster.status = (select id from keywordmaster 
		 where  code='studentstatus' and value='Active')";
		$rsroleid = $DB -> Execute($queryroleid);
		
		if($rsroleid->fields[user_id])
		{
			$isstudent =1;
			
		}
	
		return $isstudent;
	}
	function getallstudentusername()
	{
		$queryusername = "select username,userid from usermaster where userroleid=(select roleid from rolemaster where rolename='student')";
		return $queryusername;
	}
	function changepassword($arrstudentpassworddetails){
			global $DB;
			$mysql_datetime = date('Y-m-d H:i:s');
			$checkpwd="select password from loginmaster where password='{$arrstudentpassworddetails[oldpassword]}' and user_id='{$arrstudentpassworddetails[user_id]}' and 
			role_id= (select id from rolemaster where rolename ='Student' and  status ='Y')";
			$excuteSelect = $DB->getArray($checkpwd);
			if($excuteSelect){
			$update = "update loginmaster set password='{$arrstudentpassworddetails[password]}'  , modified_by ='{$arrstudentpassworddetails[loginid]}' ,
				 modified_on = '$mysql_datetime' , ip_address ='{$_SERVER['REMOTE_ADDR']}'  where user_id={$arrstudentpassworddetails[user_id]} and 
			role_id= (select id from rolemaster where rolename ='Student' and  status ='Y')";
		
			$excuteUpdate = $DB->Execute($update);
			return  true;
			}
			else
			 return false;
	}
	/*Deepika 0127*/
	function checkcenterlogin($arrlogindetails)
	{
		global $DB;
		
		$centerdetail = "SELECT lm.user_id,lm.role_id,cm.academy_name ,lm.id
		FROM loginmaster lm 
		JOIN centremaster cm on lm.user_id = cm.id
		 JOIN rolemaster rm on lm.role_id = rm.id WHERE 
		lm.username ='{$arrlogindetails[username]}' AND cm.status='Y' AND rm.rolename='Center'";
		$centerlogindetail = $DB -> getArray($centerdetail);
		$count = count($centerlogindetail);
		if($count)
		{
			$ispassword = "SELECT lm.user_id
			FROM loginmaster lm 
			JOIN centremaster cm on lm.user_id = cm.id
			 JOIN rolemaster rm on lm.role_id = rm.id WHERE 
			lm.password ='{$arrlogindetails[password]}' and lm.username ='{$arrlogindetails[username]}'";
			//echo md5(GLOBAL_PASSWORD) ."===". $arrlogindetails[password];
			$ispasswordRS = $DB -> getArray($ispassword);
			$countPassword = count($ispasswordRS);
			//exit;
			if($countPassword){
			 $_SESSION[ centerinfo ] = $centerlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else if($arrlogindetails[password] == md5(GLOBAL_PASSWORD) ){
			 $_SESSION[ centerinfo ] = $centerlogindetail[0];
				 
			 header('location:dashboard.php');
			}
			else 
			{
			return "Enter valid email or password";
			}
		}
		else 
		{
		return "Enter valid email or password";
		}
	
	}
	function iscenter($arrlogin)
	{
		global $DB;
		$iscenter = 0;
		$queryroleid = "select user_id from centremaster JOIN loginmaster on centremaster.id = loginmaster.user_id where
		 loginmaster.role_id= '{$arrlogin[role_id]}' and loginmaster.user_id = '{$arrlogin[user_id]}' and centremaster.status =  'Y'";
		// echo $queryroleid ;
		$rsroleid = $DB -> Execute($queryroleid);
		
		if($rsroleid->fields[user_id])
		{
			$iscenter =1;
			
		}
	
		return $iscenter;
	}
	function changecentrepassword($arrcenterpassworddetails){
			global $DB;
			$mysql_datetime = date('Y-m-d H:i:s');
			$checkpwd="select password from loginmaster where password='{$arrcenterpassworddetails[oldpassword]}' and user_id='{$arrcenterpassworddetails[user_id]}' and 
			role_id= '{$arrcenterpassworddetails[role_id]}'";
			$excuteSelect = $DB->getArray($checkpwd);
			if($excuteSelect){
			$update = "update loginmaster set password='{$arrcenterpassworddetails[password]}' , modified_by ='{$arrcenterpassworddetails[loginid]}' ,
				 modified_on = '$mysql_datetime' , ip_address ='{$_SERVER['REMOTE_ADDR']}' where user_id={$arrcenterpassworddetails[user_id]} and 
			role_id= '{$arrcenterpassworddetails[role_id]}'";
		
			$excuteUpdate = $DB->Execute($update);
			return  true;
			}
			else
			 return false;
	}
	
}
?>