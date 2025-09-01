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
include("../config/classes/questiontypemaster.class.php");
include("../config/classes/questionmaster.class.php");
$questionTypeMaster = new questiontypemaster();
$questionMaster = new questionmaster();
$questionid = $_GET[ questionid ];

$getQuestion = $questionMaster -> viewquestion($questionid);

//print "<pre>";
//print_r($getQuestion);
//exit;
?>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="dashboard.php">dashboard</a></li>
          <li class="first">Online Exam </li>
        <li><a  href="admin_question_listing.php">Questions</a></li>
         <li class="last"> &nbsp; View Question</li>
      </ul>
    </div>
    <div class="studentViewContent">
     
      
     <h2>View Question </h2>
      <div class="addProgramForm">
       <?php
	  if(count($getQuestion))
	  { ?>
      <ul class="w90p"> 
      <li>
        <label>Question Type  : </label> 
        <span><?php echo $getQuestion->fields['questiontype']?></span>
</li> 
<?php if($getQuestion->fields['coursecount']) { ?>
<li>
        <label>Courses  : </label> 
        	
        <span><?php 
		$getCourses = $questionMaster -> getquestioncourse($questionid);
		$i=1;
		$courseCount = count($getCourses);
		foreach($getCourses as $courses)
		{
			if($courseCount==$i)
			echo $courses['code'];
			else
			echo $courses['code'].' , ';
			$i++;
			
		}
		//echo $coursestr;
		?></span>
</li> 
<?php } ?>
         <li>
        <label>Question   : </label>
<span><?php echo $getQuestion->fields['question']?></span>  </li>
         </li>
      <?php if($getQuestion->fields['controllid']=='multiple-choice')
		 {
			 $getMultipleAnswer = $questionMaster -> getmultipleanswers($questionid);
		 ?>    
         <li class="anwsers">
           <label><strong>Choices</strong> : </label>
    </li>
    
    <?php 
	$j=1;
	foreach($getMultipleAnswer as $answer)
	{
		echo ' <li><label>'.$j.'</label><span>'.$answer['choice'].'</span></li>';
		$j++;
	}
	}
	 ?>
         <?php if($getQuestion->fields['answer'])
		 {
		 ?>
         <li>
           <label>Answer  : </label> 
           <span><?php 
		   if($getQuestion->fields['controllid']=='multiple-choice')
		 {
		   $mAnswers = explode(',',$getQuestion->fields['answer']);
		  
		  $answerCount = count($mAnswers);
		  $j = 1;
					foreach($mAnswers as $mAnswer)
					{
						
						$answerInc = $mAnswer + 1;
						if($answerCount==$j)
						$pAnswer .= $answerInc;
						else
						$pAnswer .= $answerInc.',';
						$j++;
					}
		   
		   echo $pAnswer;
		 }
		 else
		 {
			 echo $getQuestion->fields['answer'];
		 }
		 ?></span>
		</li>
		<?php 
		 }
		?>
<li>
           <label>Status  : </label> 
           <span><?php if($getQuestion->fields['status']=='Y')
		   				echo 'Active';
						else
						echo 'Inactive';
				 ?>
           </span>
</li>
         <li class="btn"><a href="admin_question_listing.php" class="saveBtn">Back</a>
         </li>
      </ul>
      <?php
		}
		?>
      </div>
    </div>
  </div>

<?php
}
?>