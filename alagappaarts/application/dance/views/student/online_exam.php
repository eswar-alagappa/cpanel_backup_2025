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
	<center>
		<span class="errorMsg">
			<?php if ($this->session->flashdata('ErrMessage')) { ?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('ErrMessage'); ?>
				</div>
			<?php }   ?>
	
		</span>
	</center>
	<?php if( isset($resultstatus) && !empty($resultstatus) && $resultstatus){ echo "<center><div class='alert alert-success'>".$resultstatus."</div></center>"; } ?>
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
      <div class="onlineExamsRight"><div class="title"><?php //echo ((isset($onlineExam->course_code) && !empty($onlineExam->course_code)) ? $onlineExam->course_code : 'Invalid Request. Please Contact APAA Admin'); ?></div><div class="subTitle">Instructions</div><div class="onlineExamsContent"><div class="onlineExamsContentTop"><div class="onlineExamsContentTopLeft">There are part of questions<br><br>1. Multiple Choice<br>2. Fill in the Blank<br>3. Match the following<br>4.  Subjective 5 Marks<br></div><div class="onlineExamsContentTopRight"><span>Marks</span>:100<br>
<span>Duration </span>:90 mins</div></div>

<ul><span>Part 1</span>
<li>This part contains the <strong><i> Multiple Choice</i></strong>.</li>

<li>You have 40 number of questions in this part.</li></ul>

<ul><span>Part 2</span>
<li>This part contains the <strong><i> Fill in the Blank</i></strong>.</li>

<li>You have 20 number of questions in this part.</li><li>For the question contains more than one answer, provide your answer using comma like answer 1,answer 2</li></ul>

<ul><span>Part 3</span>
<li>This part contains the <strong><i> Match the following</i></strong>.</li>

<li>You have 10 number of questions in this part.</li></ul>

<ul><span>Part 4</span>
<li>This part contains the <strong><i>  Subjective 5 Marks</i></strong>.</li>

<li>You have 6 number of questions in this part.</li></ul>

<!--<ul><span>While Writing Online Exam Actions Do not Do</span>
<li><strong><i> F5 Button CTRL + R</i></strong> Don't Press this button Once you Pressed you will get an alter that your exam will not submit.</li>
<li><strong><i> Reload</i></strong> Don't try to Refresh or Reload the page. Then your exam will not be submit</li>
</ul>

<ul><span>Note</span>
<li><strong><i> Right click</i></strong> Don't Press the right click button.</li>
</ul>-->


<p style="margin-top: 12px;"><b>Dear APAA Students. </b><br/></p>
<p style="margin-top: 12px; font-size:14px; color:red;"><b>PLEASE READ CAREFULLY BEFORE TAKING ON LINE EXAMINATIONS </b><br/></p>
<!--<p style="margin-top: 12px;"><b>Note: Instruction for Online exam</b><br/></p>-->
													
												<p>(Make certain that you have received the Username & Password from APAA) </p>
												<p style="margin-left: 40px;">	1. Log in to: http: alagappaarts.com/dance/registration/students-log-in/<br/><br/>
																				2. Enter your username and password<br/><br/>
																				3. Online exam page will open<br/><br/>
																				4. You will see the exam schedule box<br/><br/>
																				5. Click on to CEB 01/02 icon (or) ADB01/02 icon<br/><br/>
																				6. You will see an instruction page.<br/><br/>
																				7. Click on to start test icon<br/><br/>
																				8. Start your exams, when you finish first question click on to next icon to
																				move on to the next question<br/><br/>
																				9. On completion of exam click complete icon<br/><br/>
																				10. You will get a message “successful”<br/></p>
												<p style="margin-left: 40px; margin-top:10px; color:red;"> DO NOT DO while taking the online exam : </p>
												<p style="margin-left: 40px; margin-top:10px; color:red;"> 1. Don’t Right click in mouse <br/><br/>
																										2. Do not press F5 button in keyboard <br/><br/>
																										3. Don’t click Refresh button in browser <br/><br/>
																										4. Do not click Back button and forward in browser's <br/><br/>
																										5. Don’t Copy and Paste: <br/>
																										Even if a question expects an essay answer, don’t copy and
																										paste. Doing so is very likely to also copy bogus HTML code that will break your browser. Thus, compose your answer by your
																										own. <br/> <br/>
																										6. Don't press the following keys: <br/> </p><br/>
												<div style="width:100%;color:red; ">
												<div style="float:left;width:50%; ">
												<b style="margin-left: 40px;margin-top: 20px;">> F5 Button</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL + R</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL + F5</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> Command + R</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + A</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + S</b><br>
												</div>                                                 
												<div style="float:right;width:50%;">
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + N</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + C</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + V</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + X</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + J</b><br>
												<b style="margin-left: 40px;margin-top: 20px;">> CTRL/Command  + W</b><br>
												</div></div>
												<p style="margin-left: 40px; margin-top:18%; color:red;">Do not use multiple tabs, close other tabs before starting the online exam.</p>
												<p style="margin-left: 40px;font-weight: 600;text-align: justify;margin-bottom:20px; color:red;">Once You started the online exam don't log-out or close the browser, if you are doing this, your exam will not be submitted.</p>
												<p style="margin-left: 40px;font-weight: 600;text-align: justify;margin-bottom:20px; color:red;">If your not following the above instruction while writing online exam your exam will be failed.</p>
												
												<p style="margin-left: 40px;font-weight: 600;margin-bottom:20px;">In case of difficulties please state your name, refer to exam date and email <a href="mailto:customersupport@alagappaarts.com">customersupport@alagappaarts.com</a><br/><br/>
												Wish you all the best<br/><br/>
												APAA Team. </p>

												

<div>

<?php if($getExamSchedule->exam_status == "Assigned" || $getExamSchedule->exam_status == "Reassigned") { ?>

<div class="browserWarningLeft"> <input type="checkbox" name="agree" id="agree"> Tick this checkbox , if you have read all instructions. Students must not stop the exam session and then return to it. Closing the browser window or navigating the browser Back will interrupt the online exam.
<div id="warning_checkbox"  class="arrow_box" style="display:none;color:#ffffff;background:#D03800;padding:2px; width:150px;">Tick above check box ! </div>
</div>

<div class="browserWarningRight"><a href="javascript:;" class="" id="" onClick="javascript:checkbox_validate();"><img width="164" height="115" src="<?php echo base_url() ?>assets/home/images/start-quiz-btn.gif"></a></div>

 <?php } ?>  
 
</div>

</div>
 

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
    