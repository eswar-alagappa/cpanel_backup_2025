<?php 
class keywordmaster
{
	 function getkeyword($code)
	 {
		 global $DB;
		 $getkeyword = "select id,value from keywordmaster where code='{$code}' and status='Y'";
		 $rsKeyword = $DB -> getArray($getkeyword);
		
		 return $rsKeyword;
	 }
	 /*Deepika 28/10 */
	  function getstudentstatusactive()
	 {
		 global $DB;
		 $getStudentstatus = "select id,value from keywordmaster where code='studentstatus' and status='Y' and (value='Inactive ' or value= 'Active')";
		
		 $rsStudentstatus= $DB -> getArray($getStudentstatus);
		return $rsStudentstatus;
	 }
	   function getIdforvalue($arrCodevalue)
	 {
		 global $DB;
		 $getId = "select id from keywordmaster where code='{$arrCodevalue[code]}' and value ='{$arrCodevalue[value]}' ";
		 $rsgetId= $DB -> getArray($getId);
		// echo $rsgetId[0][id];
		return $rsgetId[0][id];	 }
		function getkeywordforresult($code)
	 {
		 global $DB;
		 $getkeyword = "select id,value from keywordmaster where code='{$code}' and status='Y' and  value!='Unpublished'";
		 $rsKeyword = $DB -> getArray($getkeyword);
		
		 return $rsKeyword;
	 }
	  function getkeywordforgrade($code)
	 {
		 global $DB;
		 $getkeyword = "select id,value from keywordmaster where code='{$code}' and status='Y' and  value!='O'";
		 $rsKeyword = $DB -> getArray($getkeyword);
		
		 return $rsKeyword;
	 }
	 
	 
}
?>