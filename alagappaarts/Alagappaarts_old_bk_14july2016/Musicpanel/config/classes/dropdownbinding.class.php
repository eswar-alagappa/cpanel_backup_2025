<?php

class binddropdown
{
	
	
	function bindqtype()
	{
		global $DB;
		$queryQtype = "select qtypeid,qtypename from qtypemaster where qtypestatus = 'Active'";
	   $rsQtype = $DB -> Execute($queryQtype);
	   return $rsQtype;
			
	}
	
	function bindlevel()
	{
		global $DB;
		$queryLevel = "select levelid,levelname from levelmaster where levelstatus ='Active' and 1=1";
		$rsLevel = $DB -> Execute($queryLevel);
		return $rsLevel;
	}
	
	function bindsubject($levelid)
	{
		
		//echo $levelid;exit;
		global $DB;
		$querySubject = "select s.subjectid,s.subjectname from subjectmaster s
		join subjectlevelmapping slm on s.subjectid=slm.subjectid
		where slm.levelid={$levelid} and s.subjectstatus='Active'";
		$rsSubject = $DB -> Execute($querySubject);
		return $rsSubject;
	}
	
	function bindtopic($subjectid,$levelid)
	{
		
		global $DB;
		$queryTopic = "Select tm.topicid,tm.topicname from topicmaster tm
	join topicslmapping tslm on tslm.topicid=tm.topicid
	join subjectmaster sm on sm.subjectid=tslm.subjectid
	join levelmaster lm on lm.levelid=tslm.levelid
	where 1=1 && sm.subjectid={$subjectid} && lm.levelid={$levelid} && tm.topicstatus='Active'";
	$rsTopic = $DB -> Execute($queryTopic);
	return $rsTopic;
	
	}
	
	
}
?>