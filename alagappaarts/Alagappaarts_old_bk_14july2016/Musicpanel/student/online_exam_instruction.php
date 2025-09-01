<?php include("../config/config.inc.php"); 
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/keywordmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/onlineexam.class.php");
include('studentheader.php');

$onlineexam = new onlineexam();
$assignedexam = $onlineexam->listassignedexamcourse($userid);
$isexamassigned = count($assignedexam);
$courseid = $_REQUEST['courseid'];

?>
<script type="text/javascript" >
$(document).ready(function() {

	var studentid = $("#hdnStudentId").val();
 
	var courseid = $("#hdnCourseId").val();
	instructionLoad(courseid,studentid);	
		function instructionLoad(courseid,studentid)
		{
			$.ajax({
                       type: "GET",
                       url: "examinstruction.php",
                       data: {course_id: courseid, student_id: studentid},
                       success: function(result){
 
                         $(".onlineExamsRight").html(result);
                       }
         });
		}
	
	$(".onlineExamsNav ul li a").click(function(){
		var courseid = $(this).attr('rel');
		if(courseid){
		instructionLoad(courseid,studentid);
					$(".onlineExamsNav ul li a").each(function(){
					$(this).removeClass('active');
					}
					);			 
					$(this).addClass('active');
		}
		});
		
		
	
		
});
</script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
    </div>
   <?php
   		 echo "<noscript>
<div class='content'>
<div class='contentOuter'>
<div style='height: 300px' >
<br/><div class='error'><b>Please enable Javascript in your browser to take up the exam</b></div>
<br/><br/>
</div>
</div>
</div>
</noscript>
";

?> 
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Online Exams </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
     <h2>Online Exams</h2>
     <div class="contentInner">
     <input type="hidden" value="<?php echo $userid ?>" name="hdnStudentId" id="hdnStudentId"/>
     <input type="hidden" value="<?php if($courseid){ echo $courseid; }
	 else { echo $assignedexam[0]['course_id']; } ?>" name="hdnCourseId" id="hdnCourseId"/>
     <?php if($isexamassigned)
{ ?>
      <div class="onlineExamsLeft">
      <div class="onlineExamsNav">
      <ul>
      <?php 
	  $i=1;
	  foreach($assignedexam as $courselist)
	  {
		  $classname = "disableBtn";
		  if($courseid)
		  {
			  if($courselist[course_id]==$courseid)
		  	$classname = "active";
		  }
		  else
		  {	  if($i==1)
		  	 $classname = "active";
		  }
		  
		   if($i==1)
		  echo "<li><a class='{$classname}' href='javascript:;' rel='{$courselist[course_id]}'>{$courselist[code]}</a></li>";
		  else   echo "<li class='disableBtnhr'> <a href='javascript:;' >{$courselist[code]}</a></li>";
		  $i++;
	  }
	  ?>
     
     
      </ul>
      </div>
      </div>
      <div class="onlineExamsRight">
       <div class="ajax-loader"><img src="../web/images/ajax-loader.gif" /></div>
     
      </div>
      <?php } 
	  else
	  {
		  echo "<div class='warning'>Exams not assigned.</div>";
	  }
	  
	  ?>
      
      </div>
    </div>
    </div>
<?php 

	

include('studentfooter.php');
}
?>