<script>
function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};

</script>
    <div class="topNav">
      <ul>
      <li><a href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Online Exam </li>
        
       
      </ul>
    </div>
	
	<?php if( isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<div class='alert alert-success'>".$resultstatus."</div>"; } ?>
    <div class="contentOuter">
     <h2>Online Exams</h2>
     <div class="contentInner">
      <input type="hidden" id="hdnCourseId" name="hdnCourseId" value="17">
           <div class="onlineExamsLeft">
      <div class="onlineExamsNav">
      <ul>
      <li><a rel="17" href="javascript:;" class="active"><?php echo ((isset($onlineExam->course_code) && !empty($onlineExam->course_code)) ? $onlineExam->course_code : 'Online Exams'); ?></a></li>     
     
      </ul>
      </div>
      </div>
      <div class="onlineExamsRight"><div class="title"><?php echo ((isset($onlineExam->course_code) && !empty($onlineExam->course_code)) ? $onlineExam->course_code : 'Invalid Request. Please Contact APAA Admin'); ?></div><div class="subTitle">Instructions</div><div class="onlineExamsContent"><div class="onlineExamsContentTop"><div class="onlineExamsContentTopLeft">There are part of questions<br><br>1. Multiple Choice<br>2. Fill in the Blank<br>3. Match the following<br>4.  Subjective 5 Marks<br></div><div class="onlineExamsContentTopRight"><span>Marks</span>:100<br>
<span>Duration </span>:90 mins</div></div><ul><span>Part 1</span>
<li>This part contains the <strong><i> Multiple Choice</i></strong>.</li>

<li>You have 40 number of questions in this part.</li></ul><ul><span>Part 2</span>
<li>This part contains the <strong><i> Fill in the Blank</i></strong>.</li>

<li>You have 20 number of questions in this part.</li><li>For the question contains more than one answer, provide your answer using comma like answer 1,answer 2</li></ul><ul><span>Part 3</span>
<li>This part contains the <strong><i> Match the following</i></strong>.</li>

<li>You have 10 number of questions in this part.</li></ul><ul><span>Part 4</span>
<li>This part contains the <strong><i>  Subjective 5 Marks</i></strong>.</li>

<li>You have 6 number of questions in this part.</li></ul><div>

<div class="browserWarningLeft"> <input type="checkbox" name="agree" id="agree"> Tick this checkbox , if you have read all instructions. Students must not stop the exam session and then return to it. Closing the browser window or navigating the browser Back will interrupt the online exam.
<div id="warning_checkbox"  class="arrow_box" style="display:none;color:#ffffff;background:#D03800;padding:2px; width:150px;">Tick above check box ! </div>
</div>

<div class="browserWarningRight"><a href="javascript:;" class="" id="" onClick="javascript:checkbox_validate();"><img width="164" height="115" src="<?php echo base_url() ?>assets/home/images/start-quiz-btn.gif"></a></div>
</div></div>

</div>
            
      </div>
    </div>
	
	
	<script>
	function checkbox_validate(){

	if(document.getElementById('agree').checked==true){
		window.location='<?php echo site_url('dance/student/exam_process');?>';
		}else{
	document.getElementById('warning_checkbox').style.display="block";
		}
	
	}
	
</script>
    