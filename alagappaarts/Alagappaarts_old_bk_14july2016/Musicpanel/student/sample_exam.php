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
include("../config/classes/onlineexam.class.php");
include('studentheader.php');
$onlineexam = new onlineexam();

?>
<script type="text/javascript" >
	
function btnradioselected(rdlName)
{
	var periods = $('#timer').countdown('getTimes');
	var currentseconds = $.countdown.periodsToSeconds(periods);
	
	if ($("input:radio[@name='"+rdlName+"']:checked").val()) {
			
		
		var answer = $("input:radio[@name='"+rdlName+"']:checked").val();
		changequestion(answer,'NEXT',currentseconds);
	}
	

}
function skipanswer(isskip)
{
	var periods = $('#timer').countdown('getTimes');
	var currentseconds = $.countdown.periodsToSeconds(periods);
	
	changequestion(null,isskip,currentseconds);
}
function changequestion(answer,option,seconds)
		{
			$(".onlineExamsBottom").html('<div class="ajax-loader"><img src="../web/images/ajax-loader.gif" /></div>');
			
		if(!seconds)
		{
			seconds = 0;
		}
			
			$.ajax({
					 type: "GET",
					 url: "sample-temp-question.php",
					 data:{selected:answer,option:option,seconds:seconds},
					 cache: false,
					 dataType:"html",
					 success: function(result){
					//alert(result);	 
					$(".dynamicInfo").html(result);
					 }
				 });
		
		
		}
function changematchquestion(answer,questionid,option,seconds)
		{
		$(".onlineExamsBottom").html('<div class="ajax-loader"><img src="../web/images/ajax-loader.gif" /></div>');
			$.ajax({
					 type: "GET",
					 url: "sample-temp-question.php",
					  data:{matchanswer:answer,matchquestionid:questionid,option:option,seconds:seconds},
					 success: function(result){
					//alert(result);	 
					$(".dynamicInfo").html(result);
					 }
				 });
		
		
		}
function subjectiveanswer(txtanswer)
{
	var periods = $('#timer').countdown('getTimes');
	var currentseconds = $.countdown.periodsToSeconds(periods);
	var subjectiveanswer = CKEDITOR.instances['txtAnswer'].getData();
	changequestion($.trim(subjectiveanswer),'NEXT',currentseconds);
}
function fillAnswer(txtanswer)
{
	var periods = $('#timer').countdown('getTimes');
	var currentseconds = $.countdown.periodsToSeconds(periods);
	
	var fillanswer = $("input:text[@name='"+txtanswer+"']").val();
	
	 
    var characterReg = /^[a-zA-Z0-9() ,]+$/;
	if(fillanswer &&   characterReg.test(fillanswer))
	changequestion($.trim(fillanswer),'NEXT',currentseconds);
	else {  $('.error').remove();$('.part2Content').append("<div class='error fillerror'> Please Enter only  alphabets and numbers  </div>");}
}
function matchthefollowing(txtCorrectanswer)
{
	var periods = $('#timer').countdown('getTimes');
	var currentseconds = $.countdown.periodsToSeconds(periods);
	var flag = false ;
	var currentseconds = $.countdown.periodsToSeconds(periods);
	$('.dynamicfields input.matchAnswer').each(function() {
		if( $(this).val() == '' || isNaN($(this).val()))
		flag = true ;
	});
	if(!flag){$('.dynamicfields input.matchAnswer').each(function() {
		answer = $(this).val() ;
		questionid= $(this).attr('id'); 
	
	 changematchquestion(answer,questionid,'NEXT',currentseconds);
	
    });}
	else { $('.error').remove();$('#match').append("<div class='error'> Please enter all the filed with valid number</div>");}
		
}
$(document).ready(function() {
$('input[name$="questAnswer"]').live ('click',function(){
			if($('input[name$="questAnswer"]:checked').length != 0 ){
			$('.nextd').hide();
			$('.next').show();
			}
	})
	$('input[name$="questAnswer"]').live ('keyup',function( ){
			if($.trim($(this).val())){
				$('.nextd').hide();
			$('.next').show();
		}
	})
	$('.matchAnswer').live ('keyup',function(){
		var flag = 0;
		$('.matchAnswer').each(function(){
			if(!$.trim($(this).val())){
			flag = 1;
				}
			})
		//	alert(flag);
			if(flag == 0){
				$('.nextd').hide();
			$('.next').show();
			}
		})
			
	$("#btnStartTest").click(function(){
		changequestion(null);
		});
	
});
</script>
<script type='text/javascript'>
function getckeditor()
{
delete CKEDITOR.instances['txtAnswer'];
	
CKEDITOR.replace( 'txtAnswer',
{
height: '200',
resize_enabled : 'false',
resize_maxHeight : '200',
resize_maxWidth : '450',
resize_minHeight: '200',
resize_minWidth: '450',
toolbar :
[
[ 'Styles','Format' ],
['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', ]
],
width:'800',
removePlugins : 'contextmenu' 
}
);


}
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
<br/><p style='color: red;font-size: 20px;font-weight: normal;'><b>Please enable Javascript in your browser to take up the exam</b></p>
<br/><br/>
</div>
</div>
</div>
</noscript>
";
  ?>
 
  <?php 
  if(isset($_SESSION['sampleuserexaminfo']))
  {
	 
	  $courseid = $_SESSION['sampleuserexaminfo']['course_id'];
	  $coursecode = $onlineexam->getcoursecodebyid( $courseid);
  }
  

	echo " <div class='content'>
    <div class='topNav'>
      <ul>
      <li><a  href='dashboard.php'>dashboard</a></li>
        <li class='last'> &nbsp; Online Exams</li>
             
      </ul>
    </div>
    <div class='contentOuter'>
    <h2 id='appendTimer'>Online Exams - {$coursecode}</h2>
	
      <div class='contentInner'>
      
	  
	
       <div class='dynamicInfo'> <div class='ajax-loader'><img src='../web/images/ajax-loader.gif' /></div>
       </div>
	  
	  <script type='text/javascript'>$(document).ready(function() {  changequestion(0); });</script>
      </div>
    </div>
    </div>";




	?>
    
<?php 

include('studentfooter.php');
}
?>