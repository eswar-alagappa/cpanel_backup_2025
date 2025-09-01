<?php 
include("../config/config.inc.php"); 
include("../config/classes/loginmaster.class.php");
include("../config/classes/exam.class.php");
include("studentheader.php");
$roleid = $_SESSION['studentinfo'][role_id];
$userid = $_SESSION['studentinfo'][user_id];
$username = $_SESSION['studentinfo'][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);

$courseid= $_SESSION['userexaminfo']['course_id'];
$key = $_SESSION['uniqueTestKey'];

//print_r($_SESSION); exit;
//$examquestions=onlineexamquestions::examquestions($userid,$courseid);
//echo "<pre>";
//print_r($examquestions); exit;
?>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" id="logOut" href="javascript:;">Log out</a></li>
        </ul>
      </div>
    </div>
    <?php 
  if(isset($_SESSION['userexaminfo']))
  {
	  $courseid = $_SESSION['userexaminfo']['course_id'];
	  $coursecode = onlineexamquestions::getcoursecodebyid($courseid);
	  if($_SESSION['userexaminfo']['currenttiming']=='' || $_SESSION['userexaminfo']['currenttiming']==0)
	{
		$updatetime = "update assign_exam set currenttiming ='".$_SESSION['userexaminfo']['examduration']."'  where id = '".$_SESSION['userexaminfo'][assignedid]."'";
		$_SESSION['userexaminfo']['currenttiming']=$_SESSION['userexaminfo']['examduration'];
	}
  }
		$examdetails = $_SESSION['userexaminfo'];
		$diffseconds = $examdetails['examduration'] - $examdetails['currenttiming'];
		$remainingsecond = $examdetails['examduration'] - $diffseconds;
		echo " <div class='content'>
    <div class='topNav'>
      <ul>
      <li><a  href='dashboard.php'>dashboard</a></li>
        <li class='last'> &nbsp; Online Exams</li>
             
      </ul>
    </div>
    <div class='contentOuter'>
    <h2 id='appendTimer'>Online Exams - {$coursecode}</h2>
	<div><span id='timer'><span></div>
      <div class='contentInner'>";
	  $questiontypecount = count($examdetails['questiontypeid']);
	  //echo $questiontypecount;
	echo "<div class='navi'>
	<ul>";
	$j=0;
	foreach($examquestions as $questionpart)
	{ 
		if($j<$questiontypecount)
		{
		$classname = "disableBtn";
		$part = $j+1;
		/*if($examdetails['questiontypeid'][$j]==$questionpart["quetypeid"])
		{
			$classname ="activebtn";
		}*/
		echo "<li id='".$questionpart["quetypeid"]."' class='{$classname}'><a href='javascript:;'><span>Part {$part}</span></a></li>";
		$j++;
		}
	}
	echo "</ul> </div>";	  
	  ?>    
<!--<script src="../web/scripts/jquery-1.11.0.min.js"></script>-->
<script type="text/javascript" src="../web/scripts/jquery.plugin.js"></script>
<script type="text/javascript" src="../web/scripts/jquery.countdown.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	
//questions();
var examkey = '<?php echo $key; ?>'
var studentid='<?php echo $userid; ?>';
var courseid='<?php echo $courseid; ?>';
//var seconds='<?php echo $_SESSION['userexaminfo']['currenttiming']; ?>';
var openseconds='<?php echo $_SESSION['userexaminfo']['examduration']; ?>';
var i=1;
updateanswers('','',courseid,examkey,openseconds,i,'');
function disableF5(e) { if ((e.which || e.keyCode) == 116) {e.preventDefault();} };
$(document).bind("keydown", disableF5);

});
/*function questions()
{
	
$.ajax({
type:"POST",
url:"temp-question.php",
data:{},
success:function(result)
{
	//alert(result);
	$('.dynamicInfo').html(result);
	var matchcount =$("#hdnmatchcnt").val();
	var quetype =$("#hdnquetype").val();
	
}
});
}*/

function updateanswers(typeID,queid,courseid,examkey,seconds,i,answers)
{
	
	$(".dynamicInfo").html("<div class='ajax-loader'><img src='../web/images/ajax-loader.gif' /></div>");
$.ajax({
type:"POST",
url:"temp-question.php",
data:{typeID:typeID,queid:queid,courseid:courseid,examkey:examkey,seconds:seconds,inc:i,answers:answers},
success:function(result)
{
	//alert(result);
	$(".dynamicInfo").html("");
	$('.dynamicInfo').html(result);
	//i++;
}
});
}

</script>
<div class='dynamicInfo'>
  

      </div>
     
      </div>
      </div>
      </div>
   
  <?php
  echo "<noscript>
<div class='content'>
<div class='contentOuter'>
<div style='height: 300px' >
<br/><p style='color: red;font-size: 20px;font-weight: normal;'><b>Please enable Javascript in your browser to take up the exam</b></p>
<br/><br/>
</div>
</div>
</div>
</noscript>
";
  include('studentfooter.php');
  ?>