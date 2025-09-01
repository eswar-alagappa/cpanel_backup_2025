<?php

class programmaster
{
	function checkprogram($arrprogram)
	{
		global $DB;
		$programname  = $arrprogram[name];
		$checkprogram = "select name from programmaster where name='$programname'";
		$checkprogramrs = $DB->Execute($checkprogram);
		$count = count($checkprogramrs->fields[0]);
		//echo $count ;
		return $count;
	}
	
	function addprogram($arrprogram){
		global $DB;
		$insert = "insert into programmaster (name, description, duration_year, duration_month, fasttrack_duration, grace_period_year, grace_period_month, status, total_fee, created_on, created_by, modified_by,modified_on)values('{$arrprogram[name]}','{$arrprogram[description]}','{$arrprogram[duration_year]}','{$arrprogram[duration_month]}','{$arrprogram[fasttrack_duration]}','{$arrprogram[grace_period_year]}','{$arrprogram[grace_period_month]}','{$arrprogram[status]}','0','{$arrprogram[created_on]}','{$arrprogram[created_by]}','{$arrprogram[modified_by]}','{$arrprogram[modified_on]}')";
		//echo $insert;
		//exit;
		$excuteInset = $DB->Execute($insert);
		//echo $excuteInset;
		return $excuteInset ;
	}
	function getprograms()
	{
		$getprograms =" select * from programmaster";//where status='Y'
		return $getprograms;
	}
	function getprogramdetails($programid)
	{
		global $DB;
		$getprogram =" select * from programmaster where id=$programid";
		
		$excuteProgram  = $DB->Execute($getprogram);
		return $excuteProgram; 
	}
	function updateprogram($arrprogram){
		global $DB;
		$update = "update programmaster set  name= '{$arrprogram[name]}',description='{$arrprogram[description]}',duration_year='{$arrprogram[duration_year]}', duration_month ='{$arrprogram[duration_month]}',
	fasttrack_duration = '{$arrprogram[fasttrack_duration]}',grace_period_year ='{$arrprogram[grace_period_year]}', grace_period_month='{$arrprogram[grace_period_month]}', status = '{$arrprogram[status]}',
		modified_by='{$arrprogram[modified_by]}', modified_on='{$arrprogram[modified_on]}' where  id ='{$arrprogram[id]}' ";
		//echo $update ;
		//exit;
		//echo $insert;
		$excuteUpdate = $DB->Execute($update);
		return true;
	}
	function  getProgramname(){
		global $DB;
		$getProgramname ="select id,name from programmaster where status ='Y'";
		$excuteProgramname  = $DB->Execute($getProgramname);
		return $excuteProgramname; 
	}
	function  getProgramnamebyid($programid ){
		global $DB;
		$getProgramname ="select id,name from programmaster  where id= '{$programid}'";
		$excuteProgramname  = $DB->Execute($getProgramname);
		return $excuteProgramname; 
	}
	
	function getprogramCourse($programID){
		global $DB;
		$getCoursename ="select * from coursemaster where program_id= '{$programID}' and status='Y'";
		//echo $getCoursename;
		$excuteCoursename  = $DB->Execute($getCoursename);
		return $excuteCoursename; 
	}
	function checkprogramfee($programid )
	{
		global $DB;
	
		$checkprogramfee = "select program_id from programfee where program_id='$programid'";
		//echo $checkprogramfee;
		$checkprogramfeers = $DB->Execute($checkprogramfee);
		$count = count($checkprogramfeers->fields[0]);
	//	echo $checkprogramfeers->fields[0];
		//exit;
		return $count;
	}
	function addprogramfee($feedatils){
		global $DB;
		$programid= $feedatils['ddlProgram'];
		foreach ($feedatils as $key =>$value ){
			switch ( $key){
				case "txtregfee":
				$feedetail = "Registration Fee";
				break;
				case "txtgradfee":
				$feedetail = "Graduation Fee";
				break;
				case "txtPenaltyfee":
				$feedetail = "Penalty Fee";
				break;
				case "txtotherfee":
				$feedetail = "Other Fee";
				break;
				default :
				$feedetail = "";
				break;
			}
			if($feedetail){
			$insert = "insert into programfee values('','{$programid}','{$feedetail}','{$value}')";
			$excuteInset = $DB->Execute($insert);}
			}
			$i =  1;
			foreach ($feedatils['listcourse1']['array1'] as $feedatil )
			{ 
				$countfeedetail =  count ($feedatil) ;
				$k = 1;
				foreach ($feedatil  as $key => $value ) {
					if($k == $countfeedetail)
					$courses[$i] .= $value;
					else 
					$courses[$i] .= $value." & ";
					$k++;
				}
			  	$i++;
			 }
			$j =  1;
			foreach ($courses as $course ){
					$feedatils['listcourse1']['newarray'][$j]= $course;
					$j++;}
			 foreach ($feedatils['listcourse1']['newarray'] as $key=>$value){
				 $amount = $feedatils['listcourse1']['array2'][$key];
				 $insert = "insert into programfee values('','{$programid}','{$value}','{$amount }')";
					$excuteInset = $DB->Execute($insert);
				}
		}
		function getprogramfees(){
			global $DB;
			$getprogramfee ="SELECT pf.program_id, pm.name,sum(pf.amount) as amounttotal  FROM programfee pf JOIN programmaster pm ON pf.program_id = pm.id  where pf.fee_detail<>'Penalty Fee' and pf.fee_detail<>'Other Fee' group by program_id ";
			
			//$excuteProgram  = $DB->Execute($getprogram);
			return $getprogramfee; 
		}
		function getprogramfeedetails($programid)
		{
			global $DB;
			//echo $programid;
			$getprogramfeedetails ="select * from programfee where program_id = '$programid'";
			$excuteProgramfeedetails  = $DB->Execute($getprogramfeedetails);
			return $excuteProgramfeedetails; 
		}
		function  updateprogramfee ($programfeedatails){
		   
			global $DB;
			//echo $programid;
			foreach ($programfeedatails as $programfeedatail ){
			$update = "update programfee set  amount = '{$programfeedatail[1]}' where  id ='{$programfeedatail[0]}' ";
			 $DB->Execute($update);
			}
			return true;	
		}
		function  updateProgramFeeonProg ($programID){
			global $DB;
			$getProgramfeeTotal ="select sum(amount) as total from programfee  where program_id= '{$programID}' and fee_detail<> 'Penalty Fee' and fee_detail<> 'Other Fee'";
			
			$excuteProgramfeeTotal  = $DB->Execute($getProgramfeeTotal);
			$feeTotal =  $excuteProgramfeeTotal->fields[total];
			$update = "update programmaster set  total_fee = '{$feeTotal}' where  id ='{$programID}' ";
			 $DB->Execute($update);
			 return true;	
		}
		function  getProgramforProgramFee(){
		global $DB;
		$getProgramname ="select pm.id,pm.name from programmaster pm where pm.id not in (select pf.program_id from programfee pf) and pm.status='Y'";
		$excuteProgramname  = $DB->Execute($getProgramname);
		return $excuteProgramname; 
	}
	function getprogramYearMonth($programs)
	{
		global $DB;
		$countProgram = count($programs);
		$i=1;
		foreach($programs as $programid)
		{
			$programids .= $programid;
			if($i < $countProgram)
			$programids .= ',';
			$i++;
		}
		
		$getprogram ="select * from programmaster where id IN (".$programids.")";
		
		$excuteProgram  = $DB->getArray($getprogram);
		return $excuteProgram; 
	}
	function  getProgramnameFasttrack(){
		global $DB;
		$getProgramname ="select id,name,fasttrack_duration from programmaster where status ='Y'";
		$excuteProgramname  = $DB->getArray($getProgramname);
		return $excuteProgramname; 
	}
	
}

?>