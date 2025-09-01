<?php
include("../config/config.inc.php");
include("../config/classes/programmaster.class.php");
if(isset($_GET['programID'])){
   

 
	 
		$programmaster  = new programmaster();
		$excuteCoursename = $programmaster -> getprogramCourse($_GET['programID']);
		while(!$excuteCoursename->EOF)
		{
		 echo "<option value='{$excuteCoursename->fields[code]}' >{$excuteCoursename->fields[code]}</option>";
		$excuteCoursename -> MoveNext();
		}
 }
?>