<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[userinfo][role_id];
$userid = $_SESSION[userinfo][user_id];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$admin  = $loginmaster->isadmin($arrlogin);
if(!$admin)
{
	header('location:index.php?msg=Login again');
}
else{
include('adminheader.php');
include("../config/classes/coursemaster.class.php");
$courseid = $_GET[ courseid ];
$courseMaster = new coursemaster();
$getCourse = $courseMaster -> getcoursesbyid($courseid);
//print "<pre>";
//print_r($getCourse);
//exit;
}
?>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="admin_course_listing.php">courses</a></li>
         <li class="last"> &nbsp; View course</a></li>
        
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View course</h2>
      
      <div class="addProgramForm">
      <?php
	  if(count($getCourse))
	  { ?>
		
	 
      <ul  class="w90p">
      <li>
        <label>Program : </label>
<span><?php echo $getCourse->fields['program_name']?></span>  </li> 
                 
         <li>
        <label>Course Code : </label>
		<span><?php echo $getCourse->fields['code']?></span>   </li> 
        <li>
        <label>Course Name : </label>
		<span><?php echo $getCourse->fields['name']?></span>  </li>
        <li>
        <label>Course Description  : </label>
		<span><?php echo $getCourse->fields['description']?></span> </li>
        
        <li>
        <label>Regulation   : </label>
		<span><?php echo $getCourse->fields['regulation']?></span> </li>
        <?php 
		if(trim($getCourse->fields['regulation'])=='Theory')
		{
			$getCourseExam = $courseMaster -> getcourseexam($courseid);
			
			if($getCourseExam)
			{
				
		?>
        <fieldset class="w97p">
        <legend>Exam & Question settings </legend> 
        <table cellspacing="0" cellpadding="0" border="0" class="vendartable wAuto">
  <tbody><tr>
    <th valign="top" align="left">Partition </th>
    <th valign="top" align="left">
      Question Type </th>
      <th valign="top" align="left">Num of Question </th>
     <!-- <th valign="top" align="left">Duration in minutes</th>-->


    </tr>
    <?php
	foreach($getCourseExam as $courseexam)
	{
		echo'<tr>';
		
		echo "<td valign='top' align='left'>Part - {$courseexam[partition]}</td>";
		echo "<td valign='top' align='left'>{$courseexam[question_type]}</td>";
		echo "<td valign='top' align='left'>{$courseexam[no_of_questions]}</td>";
		//echo "<td valign='top' align='left'>{$courseexam[duration_minute]}</td>";
		echo'</tr>';
	}
	
	?>
    
</tbody></table><br />
<br />


        </fieldset>
		<?php 	
		}
		}
		?>
       
        <li>
        <label> Exam duration  : </label>
		<span class="year">Hours : </span><span class="year"><?php echo $getCourse->fields['exam_duration_hour']?></span>
        <span class="year">Mins :  </span><span class="year"><?php echo $getCourse->fields['exam_duration_minute']?></span> </li>
        <li>
        <label>Exam attempt limit    : </label>
		<?php echo $getCourse->fields['exam_attempt_limit']?>  </li> 
        <li>
        <label>Status	 : </label>
        
         <?php if( $getCourse->fields['status'] == 'Y' ) echo 'Active'; else   echo 'Inactive';?>
		
		
		</li>
     <li class="btn"><a href="admin_course_listing.php"><input type="submit" class="saveBtn" value="Back" name=""></a>
        </li>
      </ul>
      <?php
  		  }
	  ?>
      </div>
      
    </div>
  </div>