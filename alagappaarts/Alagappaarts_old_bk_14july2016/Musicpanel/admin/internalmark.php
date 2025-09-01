<?php
include("../config/config.inc.php");
include("../config/classes/exammaster.class.php");
if(isset($_GET['course_id']) && isset($_GET['student_id'])){
	
	
	$studentarrayforexamid =array('student_id'=>$_GET['student_id'],'course_id'=>$_GET['course_id']);
  		$exammaster  = new exammaster();
$studentid = $_GET['student_id'];
$course_id = $_GET['course_id'];
$assign_exam_id = $exammaster -> getExamidforStudent($studentarrayforexamid);

$studentarray =array('student_id'=>$_GET['student_id'],'course_id'=>$_GET['course_id'],'assign_exam_id'=>$assign_exam_id);
$studentCourse =$exammaster -> getCourseforonlineexammark($studentid  );
$studentdetail = $exammaster -> getStudentdetailsforCourse($studentarray);
$onemarkquestions = $exammaster -> getStudentexamdetailforonemark($studentarray);
$subjectives = $exammaster -> getStudentexamdetailforSubjective($studentarray);
$gettotalforeachpartition=   $exammaster -> gettotalforeachpart($studentarray);

foreach($studentCourse as $value)
            {  if($value[id]==$course_id) $exam_startdate = $value['exam_startdate'];
            }
            $exam_startdate =date("d-m-Y", strtotime($exam_startdate));
?>

<?php 
echo "<div class='onlineExamContentTitle'>
      	<ul>
        <li><span>Student ID 		</span>: {$studentdetail[0][enrollment_id]}</li>
        <li><span>Student Name  		</span>:{$studentdetail[0][first_name]} {$studentdetail[0][last_name]}</li>
        <li><span>Centre Name 		</span>:{$studentdetail[0][academy_name]}</li>
        </ul>
        <ul>
        <li><span>Program enrolled 		</span>: {$studentdetail[0][programname]}</li>
        <li><span>Courses Name 		</span>: {$studentdetail[0][coursename]}</li>
         <li><span>Exam Start Time 		</span>:$exam_startdate	</li>
        </ul>
        
      </div>";
     echo "<div class='addProgramForm onlineexammark'>";
        if($onemarkquestions){ 
    echo "<ul class='w100p'>
     
          
          <fieldset>
        <legend>";
		
		  foreach ($onemarkquestions as $key => $onemarkquestion){
 				echo "  Part {$onemarkquestion[partition]}   "; 
				if( $key != (count($onemarkquestions)-1))  
				echo "  &amp; ";
		  }
                echo "</legend>";
       echo " <div class='onlineExamMarkOuter w850'>
       <table width='100%' border='0' cellspacing='0' cellpadding='0' class='w850'>
  <tr>
    <th>Question Type</th>
    <th>No of Questions</th>
    <th>Questioned Attended</th>
    <th>Answered Correctly</th>
  </tr>
 ";
					
   foreach ($onemarkquestions as $onemarkquestion)
 				{echo "
  <tr>
    <td>{$onemarkquestion[name]}</td>
    <td>{$onemarkquestion[no_of_questions]}</td>
    <td>{$onemarkquestion[questioned_attended]}</td>
    <td>{$onemarkquestion[answered_correctly]}</td></tr>";
				}
   echo " </table></div>
       <li class='marksobtained'>
        <label class='subtotal'>Sub total :</label>";
         $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'onemark','questiontype_id'=>'','assign_exam_id'=>$assign_exam_id);
		$subtotal = $exammaster -> getmarksubtotal($markdetail); 
		echo "<span><input name='' type='text' disabled='disabled' value='{$subtotal}'/></span>
         </li>
          </fieldset>
      </ul>";
       }
	   ?>

  <?php  if($onemarkquestions){
	   $i = 0;
       foreach ($onemarkquestions as $onemarkquestion){ 
        echo " <ul class='w100p'>"; 
	 $studentarray =array('student_id'=>$studentid,'course_id'=>$course_id,'questiontype_id'=> $onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
	$onemarkanswers = $exammaster -> getonemarkanswer($studentarray); 
	 if($onemarkanswers ){ 
	if( $onemarkquestion[questiontype_id] == 3){ 
	$j = 0;  
$studentarray =array('student_id'=>$studentid,'answers'=>$onemarkanswers,'questiontype_id'=> $onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
$matchanswers = $exammaster -> getMatchanswer($studentarray);
if($matchanswers){
	if(isset($matchanswers[0][matchanswer])){
    echo "<fieldset class='slideUp'>
        <legend>   Part {$onemarkquestion[partition]}  {$onemarkquestion[name]}   </legend>
   <div class='menu_body'>";
      echo '<div id="match" class="multipleChoice"><ul class="w800">'; 
 echo "<div class='questionTopTitle'>
      <ul>
      <li class='questiontitle'>question</li>
      <li class='answerTitle'>answer</li>
      <li class='correctAnswerTitle'>correct answer</li>
      </ul>
      </div>";
  foreach ($matchanswers as $matchanswer){  
$k=$j+1;
 echo " <li id='frmMatch'>
        <div class='dynamicfields'>
        <div>
       <span class='option'>  {$k}   </span>
        <textarea    name='txtMatchQuestion' cols='28' rows='3' disabled='disabled'> ". $matchanswer[0]."</textarea>
        <textarea  name='txtAddress' cols='28' rows='3' disabled='disabled'>".$matchanswer[2]."</textarea>
			 
         <input type='input' value= '".$matchanswer[1]."' class='matchAnswer'     title='Please fill the value' disabled='disabled' /> 
	 </div>
     </div>
       
      </li>";
   
      $j++; }
	  echo "</ul></div>";
   echo ' <ul class="w800">
        <li class="marksobtained">
     
        <label class="subtotal">Sub total :</label>';
		 $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail);  
		echo '<span><input name="" type="text"  value="{$subtotal}" disabled="disabled"/></span>
         </li> 
          </ul>
    </div>
    </fieldset>';
  }}}else { 
  echo "<fieldset class='slideUp'>
        <legend>Part {$onemarkquestion[partition]}  {$onemarkquestion[name]}</legend>
        <div class='menu_body'>";
  $j = 0; 
foreach ($onemarkanswers as $onemarkanswer){   
echo ' <ul class="w800">
      <li class="anwsers"><strong>';
       echo   $j+1 .'. ';  
        echo $onemarkanswer[question]; 
		echo '</strong>
 </li> 
         <li>
   <strong>Answer</strong><br />
   <div class="fillupAnswer">';
   echo  $onemarkanswer[answers] ;
   echo ' </div>

 </li> 
        <li>';
         
		 if($onemarkquestion[questiontype_id] != 6 )  $disabled =  'disabled="disabled" '; else  $disabled ='';   
      echo '   <table width="750px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="23"><strong>Comments   :</strong></td>
    <td width="50%" align="right"><strong>Marks :</strong></td>
  </tr>
  <tr>';
    echo "<td><textarea name='markforQuestion[{$onemarkanswer[id]}][comments]' cols='' rows='' {$disabled}   >
     ".$onemarkanswer[comments]."  </textarea></td>";
    echo "<td valign='top' align='right'>
   
    <input name='markforQuestion[{$onemarkanswer[id]}][mark]'    {$disabled}  value='{$onemarkanswer[mark]}' maxlength='1' type='text' class='marks required number' id='fillUP".$j."'    title='Enter mark'/>
    </td>
  </tr>
</table>
	</li>
    </ul>";
      $j++;}  
   echo ' <ul class="w800">
        <li class="marksobtained">
     
        <label class="subtotal">Sub total :</label>';
              $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$onemarkquestion[questiontype_id],'assign_exam_id'=>$assign_exam_id);
		
$subtotal = $exammaster -> getmarksubtotal($markdetail);  
	echo '<span><input name="" type="text"  value="'.$subtotal.'" disabled="disabled"/></span>
         </li> 
          </ul>
    </div>
    </fieldset>'; }	}
   echo '</ul>';  ?>
   <?php $i++;}}?>
       <?
       if($subjectives){  
	   $i = 0;
       foreach ($subjectives as $subjective){ 
        echo " <ul class='w100p'>";
		       $studentarray =array('student_id'=>$studentid,'course_id'=>$subjective[course_id],'questiontype_id'=>$subjective[questiontype_id],'assign_exam_id'=>$assign_exam_id);
$subjectiveanswer = $exammaster -> getsubjectiveanswer($studentarray); 
/*print_r($subjectiveanswer);*/ 
 if($subjectiveanswer){   $j = 0;
          echo "  <fieldset  class='slideUp'>
        <legend> Part {$subjective[partition]}  {$subjective[questiontypename]}</legend>";
		echo '<div class="menu_body">';
 foreach ($subjectiveanswer as $subjectiveanswer){ 
  echo "<ul class='w800'>
      <li class='anwsers'><strong>
    {$subjectiveanswer[question]}</strong>
 </li> 
         <li>
   <strong>Answer</strong><br />
<div class='subjectiveAnswer'>{$subjectiveanswer[answers]}</div>"; ?>

 

<?php echo "
 </li> 
        <li>
         <table width='750px' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='50%' height='23'><strong>Comments   :</strong></td>
    <td width='50%' align='right'><strong>Marks :</strong></td>
  </tr>
  <tr>
    <td><textarea name='markforQuestion[{$subjectiveanswer[id]}][comments]' cols='' rows=''> {$subjectiveanswer[comments]}</textarea></td>
    <td valign='top' align='right'><input name='markforQuestion[{$subjectiveanswer[id]}][mark] ' value='{$subjectiveanswer[mark]}' maxlength='2' type='text' class='marks required number' id='part4mark1{$i}{$j}'    title='Enter mark'/></td>
  </tr>
</table>
	</li>
    </ul>";
     $j++;}
    echo "<ul class='w800'>
        <li class='marksobtained'>
     <label class='subtotal'>Sub total :</label>";
        $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'subjective','questiontype_id'=>$subjective[questiontype_id],'assign_exam_id'=>$assign_exam_id);
	$subtotal = $exammaster -> getmarksubtotal($markdetail);  
		echo "<span><input name='' type='text'  value='{$subtotal}' disabled='disabled'/></span>
         </li> 
          </ul>
		  </div>
      </fieldset>";
	  }
	  echo "
    </ul>  ";
 $i++;}}
    if($gettotalforeachpartition){ 
    echo "<ul class='w100p'>
        <fieldset>
        <legend>Mark Summary
        </legend>
     
        <ul class='w800'>";
         foreach ($gettotalforeachpartition as  $total)  {
		
          echo "<li>
            <label>Part{$total[partition]} :</label>";
			
         echo " <span>";
	if($total[totalmark])  echo  $total[totalmark]; else echo "-"; 
		 echo "</span></li>";
             } 
          echo "<li>   <label>Mark Obtained : </label>";
           $markdetail =array('student_id'=>$studentid,'course_id'=>$course_id,'controller'=>'grandtotal','questiontype_id'=>'','assign_exam_id'=>$assign_exam_id);
					$grandtotal = $exammaster -> getmarksubtotal($markdetail); 
                      echo "<span><input name='' type='text' class='marks' value = '{$grandtotal}' disabled='disabled'/></span></li>
            </ul>
       </fieldset>
     </ul>";
     }
     echo "<ul><li class='button'><input name='examMarks' value='Update' type='submit' class='submitBtn fl' />
      <a href='admin_student_listing.php' class='cancelBtn'>Cancel</a>
        </li></ul>   
    </div> ";
 }?>