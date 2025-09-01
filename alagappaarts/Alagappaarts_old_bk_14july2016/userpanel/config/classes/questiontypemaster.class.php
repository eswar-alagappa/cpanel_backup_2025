<?php

class questiontypemaster
{
	function checkquestiontype($arrquestiontype)
	{
		global $DB;
		$programname  = $arrquestiontype[name];
		$checkquestiontype = "select name from questiontype where name='$programname'";
		$checkquestiontypers = $DB->Execute($checkquestiontype);
		$count = count($checkquestiontypers->fields[0]);
		//echo $count ;
		return $count;
	}
	function addquestiontype($arrquestiontype){
		global $DB;
		$insert = "insert into questiontype values('','{$arrquestiontype[name]}','{$arrquestiontype[description]}','{$arrquestiontype[marks_per_question]}','{$arrquestiontype[controller_id]}','{$arrquestiontype[status]}','{$arrquestiontype[created_on]}','{$arrquestiontype[created_by]}','{$arrquestiontype[modified_by]}','{$arrquestiontype[modified_on]}')";
		//echo $insert;
		$excuteInset = $DB->Execute($insert);
		//echo $excuteInset;
		return $excuteInset ;
	}
	function getquestiontypes()
	{	
		$getquestiontypes =" select * from questiontype";//where status='Y'
		return $getquestiontypes;
	}
	function getquestiontypedetail($questiontypeid)
	{
		global $DB;
		$getquestiontype = "select * from questiontype where id = $questiontypeid" ;
		$excuteQuestiontype  = $DB->Execute($getquestiontype);
		return $excuteQuestiontype; 
	}
	function updatequestiontype($arrquestiontype){
		global $DB;
		$update = "update questiontype set  name= '{$arrquestiontype[name]}',description='{$arrquestiontype[description]}',marks_per_question='{$arrquestiontype[marks_per_question]}',controller_id='{$arrquestiontype[controller_id]}', status ='{$arrquestiontype[status]}' ,modified_by='{$arrquestiontype[modified_by]}', modified_on='{$arrquestiontype[modified_on]}' where  id ='{$arrquestiontype[id]}' ";
		//echo $update ;
		//echo $insert;
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function activequestiontypes()
	{	global $DB;
		
		$getquestiontypes = "select qt.id,qt.name,km.value as controller from questiontype qt join keywordmaster km on km.id = qt.controller_id where qt.status='Y'";
		$rsQuestionType = $DB -> getArray($getquestiontypes);
		return $rsQuestionType;
	}
	function getquestiontype_controller($questiontypeid)
	{	global $DB;
		$getquestiontypes = "select qt.id,qt.name,km.value as controller from questiontype qt join keywordmaster km on km.id = qt.controller_id where qt.status='Y' AND qt.id={$questiontypeid}";
		$rsQuestionType = $DB -> getArray($getquestiontypes);
		return $rsQuestionType;
	}
	
}

?>