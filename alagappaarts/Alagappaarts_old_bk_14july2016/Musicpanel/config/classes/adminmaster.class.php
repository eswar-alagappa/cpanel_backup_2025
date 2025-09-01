<?php

class adminmaster
{
	function checkadmin($arradmin)
	{
		global $DB;
		$adminemailid  = $arradmin[email_id];
		$checkadminemailid = "select email_id from adminmaster where email_id='$adminemailid'";
		$checkadminemailids = $DB->Execute($checkadminemailid);
		$count = count($checkadminemailids->fields[0]);
		return $count;
	}
	
	function addadmin($arradmin){
		global $DB;
		$insert = "insert into adminmaster values('','{$arradmin[name]}','{$arradmin[email_id]}','{$arradmin[telephone]}','{$arradmin[mobile]}','{$arradmin[status]}',
		'{$arradmin[created_on]}','{$arradmin[created_by]}','{$arradmin[modified_by]}','{$arradmin[modified_on]}')";
		$excuteInsert = $DB->Execute($insert);
		if($excuteInsert){
			$getLastinsertedIdquery = "select max(id) as id from adminmaster";
			$getLastinsertedId = $DB->Execute($getLastinsertedIdquery);
		}
		$lastid =  $getLastinsertedId->fields[id];
		return $lastid ;
	}
	function addusername($arrusername){
		global $DB;
		$insert = "insert into loginmaster values('','{$arrusername[user_id]}','{$arrusername[username]}','{$arrusername[password]}','1','{$arrusername[status]}')";
		$excuteInsert = $DB->Execute($insert);
		return true;
		}
	function addmoduleuser($arrmodule){
		global $DB;
		$getmodule = "select name,id  from modulemaster where parent_id = {$arrmodule['parent_id']}";
		$adminmodule = $DB -> getArray($getmodule);
		return $adminmodule;
		}
	function adduserrole($arrmastermodule){
		global $DB;
		$insertuserrole="insert into adminmrolemaster values('','{$arrmastermodule['admin_id']}','{$arrmastermodule['responsibility']}','{$arrmastermodule['status']}')";
		$excuteInsert = $DB->Execute($insertuserrole);
		return true;
		}
	/*code for admin-listing page*/	
	function getAdmin($arradmin)
	{
		global $DB;
		$getAdmins ="select ad.id,ad.name,ad.email_id,ad.status from adminmaster ad where 1=1";
		return $getAdmins;
	}
	
	/*code for admin-edit page*/
	function getadmins($adminid)
	{
		global $DB;
		$getadmininfo ="select ad.id,ad.name as adminName,ad.email_id,ad.telephone,ad.mobile,ad.status ,lm.id, lm.user_id, lm.username, lm.password, lm.role_id, lm.status, ar.responsibility, mm.name as moduleName from adminmaster ad JOIN adminmrolemaster ar ON ad.id = ar.admin_id JOIN loginmaster lm ON lm.user_id=ad.id JOIN modulemaster mm ON ar.responsibility=mm.id where ad.id=$adminid";
		//echo $getadmininfo; 
		$excuteAdmin  = $DB->Execute($getadmininfo);
		return $excuteAdmin; 
		
	}
	function updateadmin($arradmin){
		global $DB;
		$update = "update adminmaster ad set  name= '{$arradmin[name]}',email_id='{$arradmin[email_id]}',telephone='{$arradmin[telephone]}',mobile='{$arradmin[mobile]}',
		status='{$arradmin[status]}',created_on='{$arradmin[created_on]}',created_by='{$arradmin[created_by]}',modified_by='{$arradmin[modified_by]}',modified_on='{$arradmin[modified_on]}' where  ad.id ={$arradmin[id]}";
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function updateuser($arrusername){
		global $DB;
		$update = "update loginmaster lm set user_id='{$arrusername[user_id]}',username='{$arrusername[username]}',password='{$arrusername[password]}',status='{$arrusername[status]}' where lm.user_id ={$arrusername[user_id]}";
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function updateuserrole($arrmastermodule){
	    global $DB;
		$update = "update adminmrolemaster ar set responsibility='{$arrmastermodule[responsibility]}',status='{$arrmastermodule[status]}' where ar.admin_id ={$arrmastermodule[admin_id]}";
		echo $update;
		$excuteUpdate = $DB->Execute($update);
		return true;	
	}  
	
}
?>