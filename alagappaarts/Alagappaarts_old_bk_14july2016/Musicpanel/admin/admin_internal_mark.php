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
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/exammaster.class.php");
include('adminheader.php');
$studentid = $_GET[ studentid ];
$exammaster  = new exammaster();

$studentCourse =$exammaster -> getCourseforonlineexammark($studentid  );
foreach($studentCourse as $value)
 	{ 
	 $course_id = $value[id];  
	  $assign_exam_id = $value[examid]; }
$studentarray =array('student_id'=>$studentid,'course_id'=>$course_id,'assign_exam_id'=>$assign_exam_id);
$studentdetail = $exammaster -> getStudentdetailsforCourse($studentarray);
$onemarkquestions = $exammaster -> getStudentexamdetailforonemark($studentarray);
$subjectives = $exammaster -> getStudentexamdetailforSubjective($studentarray);
$gettotalforeachpartition=   $exammaster -> gettotalforeachpart($studentarray);
/*echo "<pre>"; print_r($gettotalforeachpartition);
print_r($subjectives);*/
if(isset($_REQUEST['examMarks'])){
	//echo "<pre>"; print_r($_REQUEST['markforQuestion']);
	$markforQuestion =  $_REQUEST['markforQuestion'];
		 $ackmsg =  $exammaster -> updateMarks($markforQuestion);
	if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Evaluation done and marks has been updated';
			header("location:admin_student_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#studentmarkForm").validate({
	});
$('#selectCourse').change(function() {
	  var selectedval= $('#selectCourse').val();
	  var studentid = $('#studentid').val();
		 $.ajax({
                       type: "GET",
                       url: "internalmark.php",
                       data: {course_id: selectedval, student_id: studentid}, 
                       success: function(result){
						       $(".internalmarkDetails").html(result);
							
                       }
                     });
  });
  $("fieldset.slideUp  legend").live("click",function()
    {
		$(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
				
				/*		if( $("div.menu_body").css('display') == 'none' )
			$(this).css({backgroundImage:"url(http://www.aestheticbrandmarketing.com/wp-content/themes/abm/images/sidebar-h3-bg-down.png)"})
		else 
			$(this).css({backgroundImage:"url(http://www.aestheticbrandmarketing.com/wp-content/themes/abm/images/sidebar-h3-bg-left.png)"})
		  		$(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
				$(this).siblings().css({backgroundImage:"url(http://www.aestheticbrandmarketing.com/wp-content/themes/abm/images/sidebar-h3-bg-left.png)"});*/
				 
	});
	 
	
	
	
	

});
</script>

<div class="content">
    <div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a href="students_listing.html">students</a></li>
        <li class="last"> &nbsp; Edit student</li>
        
      </ul>
    </div>
     <h2>Online Exam Mark </h2>
     <?php if($studentCourse) {?>
    <form id="studentmarkForm" action="" method="post">
     <input style="display:none" name="studentid" id="studentid" value="<?php echo $studentid;?>" />
    <div class="studentViewContent">
 <div class="onlineExamContent">
     <div class="addProgramForm question ">
    <ul class="w90p">
      <?php if($studentCourse){?>
      <fieldset>
        <legend>Select Course</legend>
       <label> Courses   : </label>
          <select name="selectCourse" id = "selectCourse" class="w250"> 
         <?php foreach($studentCourse as $value)
            {  echo "<option value='{$value[id]}'selected >{$value[code]}</option>";
            $exam_startdate = $value['exam_startdate']; }?>
             </select>
             </fieldset>
             <?php }?>
             </ul>
             </div>
             <div class="internalmarkDetails">
      <div class="onlineExamContentTitle">
      	<ul>
        <li><span>Student ID 		</span>:  <?php echo $studentdetail[0][enrollment_id]; ?> 	</li>
        <li><span>Student Name  		</span>: <?php echo $studentdetail[0][first_name]. ' '. $studentdetail[0][last_name]; ?>   	</li>
        <li><span>Centre Name 		</span>: <?php echo $studentdetail[0][academy_name]; ?> 		</li>
        </ul>
        <ul>
        <li><span>Program enrolled 		</span>: <?php echo $studentdetail[0][programname]; ?> 	</li>
        <li><span>Courses Name 		</span>: <?php echo $studentdetail[0][coursename]; ?> 	</li>
         <li><span>Exam Start Time 		</span>: <?php echo  date("d-m-Y", strtotime($exam_startdate)) ; ?> 	</li>
       
        </ul>
        
      </div>
      <div class="addProgramForm onlineexammark">
       <?php if($onemarkquestions){ ?>
      <ul class="w100p">
     
          
          <fieldset>
        <legend> <?php  foreach ($onemarkquestions as $key=> $onemarkquestion){
 				echo "  Part {$onemarkquestion[partition]} ";  
				if( $key != (count($onemarkquestions)-1))  
				echo "  &amp; "; }?> </legend>
        <div class="onlineExamMarkOuter w850">
       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="w850">
  <tr>
    <th>Question Type</th>
    <th>No of Questions</th>
    <th>Questioned Attended</th>
    <th>Answered Correctly</th>
  </tr>
 
					
  <?php   foreach ($onemarkquestions as $onemarkquestion)
 				{echo "
  <tr>
    <td>{$onemarkquestion[name]}</td>
    <td>{$onemarkquestion[no_of_questions]}</td>
    <td>{$onemarkquestion[questioned_attended]}</td>
    <td>{$onemarkquestion[answered_correctly]}</td></tr>";
				}
  ?>
  
       </table></div>
       <li class="marksobtained">
        <label class="subtotal">Sub total :</label>
        <?php $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'onemark','questiontype_id'=>'','assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail); ?>
		<span><input name="" type="text" disabled="disabled" value="<?php  echo $subtotal;?>"/></span>
         </li>
          </fieldset>
      </ul>
      <?php }?>
        <?php if($onemarkquestions){
	   $i = 0;
       foreach ($onemarkquestions as $onemarkquestion){ 
        echo " <ul class='w100p'>"; ?>
              <?php $studentarray =array('student_id'=>$studentid,'course_id'=>$course_id,'questiontype_id'=> $onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
$onemarkanswers = $exammaster -> getonemarkanswer($studentarray); // print_r($onemarkquestion );
//echo "<pre>";
//print_r( $onemarkquestions); 
//echo $assign_exam_id;?>

<?php if($onemarkanswers ){ 

if( $onemarkquestion[questiontype_id] == 3 ){ ?>
<?php  $j = 0;  
$studentarray =array('student_id'=>$studentid,'answers'=>$onemarkanswers,'questiontype_id'=> $onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
$matchanswers = $exammaster -> getMatchanswer($studentarray);
if($matchanswers ){
	if(isset($matchanswers[0][matchanswer])){?>
    <fieldset class="slideUp">
        <legend>  <?php  echo "Part {$onemarkquestion[partition]}  {$onemarkquestion[name]}" ; ?>  </legend>
        <div class="menu_body">
 <div id="match" class="multipleChoice"><ul class="w800"> 
 <div class='questionTopTitle'>
      <ul>
      <li class='questiontitle'>question</li>
      <li class='answerTitle'>answer</li>
      <li class='correctAnswerTitle'>correct answer</li>
      </ul>
      </div>
<?php foreach ($matchanswers as $matchanswer){  ?> 

 <li id='frmMatch'>
        <div class='dynamicfields'>
        <div>
       <span class='option'><?php echo $j+1; ?></span>
        <textarea    name='txtMatchQuestion' cols='28' rows='3' disabled='disabled'> <?php echo  $matchanswer[0]; ?></textarea>
        <textarea  name='txtAddress' cols='28' rows='3' disabled='disabled'><?php echo $matchanswer[2] ;?></textarea>
			 
         <input type='input' value='<?php echo $matchanswer[1] ;?>' class="matchAnswer"     title='Please fill the value' disabled="disabled" /> 
	 </div>
     </div>
       
      </li>
   
    <?php $j++;}  ?></ul></div>
    <ul class="w800">
        <li class="marksobtained">
     
        <label class="subtotal">Sub total :</label>
            <?php $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail);  ?>
		<span><input name="" type="text"  value="<?php  echo $subtotal ?> " disabled="disabled"/></span>
         </li> 
          </ul>
    </div>
    </fieldset>
<?php }} }else { ?><fieldset class="slideUp">
        <legend>  <?php  echo "Part {$onemarkquestion[partition]}  {$onemarkquestion[name]}" ; ?>  </legend>
        <div class="menu_body">
<?php  $j = 0; 
foreach ($onemarkanswers as $onemarkanswer){  ?> 
<ul class="w800">
      <li class="anwsers"><strong>
      <?php echo $j+1 .'. '; ?>
      <?php echo $onemarkanswer[question]; ?> </strong>
 </li> 
         <li>
   <strong>Answer</strong><br />
   <div class="fillupAnswer"><?php echo $onemarkanswer[answers]; ?> </div>

 </li> 
        <li>
         <?php if($onemarkquestion[questiontype_id] != 6 )  $disabled =  'disabled="disabled" '; else  $disabled ='';   ?>
         <table width="750px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="23"><strong>Comments   :</strong></td>
    <td width="50%" align="right"><strong>Marks :</strong></td>
  </tr>
  <tr>
    <td><textarea name="<?php echo "markforQuestion[{$onemarkanswer[id]}][comments]";?>" cols="" rows=""  <?php echo $disabled;  ?>> <?php echo $onemarkanswer[comments]; ?></textarea></td>
    <td valign="top" align="right">
   
    <input name="<?php echo "markforQuestion[{$onemarkanswer[id]}][mark]";   ?>"  <?php echo $disabled;  ?>value="<?php echo $onemarkanswer[mark]; ?>" maxlength="1" type="text" class="marks required number" id="<?php echo "fillUP".$j; ?>"    title="Enter mark"/>
    </td>
  </tr>
</table>
	</li>
    </ul>
    <?php $j++;} ?>
    <ul class="w800">
        <li class="marksobtained">
     
        <label class="subtotal">Sub total :</label>
            <?php $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail);  ?>
		<span><input name="" type="text"  value="<?php  echo $subtotal ?> " disabled="disabled"/></span>
         </li> 
          </ul>
    </div>
    </fieldset><?php }	}?>
   </ul>  
   <?php $i++;}  }?>
       <?php if($subjectives){  
	   $i = 0;
       foreach ($subjectives as $subjective){
		     ?>
                 <?php $studentarray =array('student_id'=>$studentid,'course_id'=>$subjective[course_id],'questiontype_id'=>$subjective[questiontype_id],'assign_exam_id'=>$assign_exam_id);
$subjectiveanswer = $exammaster -> getsubjectiveanswer($studentarray); 
/*print_r($subjectiveanswer);*/  ?>
             <ul class="w100p">
             <?php if($subjectiveanswer){  $j = 0;?>
             <fieldset class="slideUp">
        <legend> <?php echo "Part {$subjective[partition]}  {$subjective[questiontypename]}" ;?></legend>
        
        <div class="menu_body" >
    
<?php  foreach ($subjectiveanswer as $subjectiveanswer){  ?> 
<ul class="w800">
      <li class="anwsers"><strong>
      <?php echo $j+1 .'. '; ?>
      <?php echo $subjectiveanswer[question]; ?> </strong>
 </li> 
         <li>
   <strong>Answer</strong><br />
   <div class="subjectiveAnswer"><?php echo $subjectiveanswer[answers]; ?> </div>

 </li> 
        <li>
         <table width="750px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="23"><strong>Comments   :</strong></td>
    <td width="50%" align="right"><strong>Marks :</strong></td>
  </tr>
  <tr>
    <td><textarea name="<?php echo "markforQuestion[{$subjectiveanswer[id]}][comments]";?>" cols="" rows=""> <?php echo $subjectiveanswer[comments]; ?></textarea></td>
    <td valign="top" align="right"><input name="<?php echo "markforQuestion[{$subjectiveanswer[id]}][mark]";   ?>"  value="<?php echo $subjectiveanswer[mark]; ?>" maxlength="2" type="text" class="marks required number" id="<?php echo "part4mark1".$i.$j; ?>"    title="Enter mark"/></td>
  </tr>
</table>
	</li>
    </ul>
    <?php $j++;}?>
     <ul class="w800">
        <li class="marksobtained">
     
        <label class="subtotal">Sub total :</label>
            <?php $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$subjective[questiontype_id],'assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail);  ?>
		<span><input name="" type="text"  value="<?php  echo $subtotal ?> " disabled="disabled"/></span>
         </li> 
          </ul>   </div>
      </fieldset>
          <?php }?>
       
    </ul>  
   <?php $i++; }  }?>
    <?php  if($gettotalforeachpartition){ ?>
     <ul class="w100p">
        <fieldset>
        <legend>Mark Summary
        </legend>
     
        <ul class="w800">
        <?php  foreach ($gettotalforeachpartition as  $total)  {
		?>
           <li>
            <label>Part <?php  echo  $total[partition]; ?>:</label>
            <span><?php if($total[totalmark])  echo  $total[totalmark]; else echo "-"; ?></span></li>
            <?php } ?>
          <li>   <label>Mark Obtained : </label>
           <?php $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'grandtotal','questiontype_id'=>'','assign_exam_id'=>$assign_exam_id);
					$grandtotal = $exammaster -> getmarksubtotal($markdetail); ?>
                      <span><input name="" type="text" class="marks" value = "<?php  echo $grandtotal ?> " disabled="disabled"/></span></li>
            </ul>
       </fieldset>
     </ul>
     <?php }?>
     <ul><li class="button"><input name="examMarks" value="Update" type="submit" class="submitBtn fl" />
      <a href="admin_student_listing.php" class="cancelBtn">Cancel</a>
        </li></ul>   
    </div>
    </div>
      </div> 
    </div>
    </form>
    
    <?php } else { echo "<div class='adminError'>No exams attended</div>" ;}?>
  </div>
  
  <?php 
include('adminfooter.php');
}
?>