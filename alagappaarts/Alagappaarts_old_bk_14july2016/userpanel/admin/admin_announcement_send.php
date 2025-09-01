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
	include("../config/classes/messagemaster.class.php");
    include('adminheader.php');
	define( FROM_MAILID_ANNOUNCEMENT, "iswarya.sharaj@gmail.com" );
$messageMaster  = new messagemaster();
$arrStudent = array('id'=>$_GET['id']);
$placeofCentre = $messageMaster->getCentre();
$centrename = $messageMaster->getCentrename();
$centredetailonchange = $messageMaster -> getstudent($arrStudent);
//$Emaildetail=$messageMaster -> getMessageDetailtosent($arrMessage);
if(isset($_REQUEST['announcementSend']))
{
	$msg = "";
	$mysql_datetime = date('Y-m-d H:i:s');
	if($_REQUEST['ddlAnnouncedto']=='student')
	{
	$arrMessage = array('subject'=>$_REQUEST['txtSubject'],'message'=>$_REQUEST['txtMessage'],'centre_id'=>$_REQUEST['ddlCentre'],'student_id'=>$_REQUEST['student'],'mailed_on'=>$mysql_datetime ,'mailed_by'=> $_SESSION[userinfo][user_id]);
	}
	else
	{
	$arrMessage = array('subject'=>$_REQUEST['txtSubject'],'message'=>$_REQUEST['txtMessage'],'centre_id'=>$_REQUEST['centre'],'student_id'=>'','mailed_on'=>$mysql_datetime ,'mailed_by'=> $_SESSION[userinfo][user_id]);
   }
 $storeMessageDB=$messageMaster->addStudentCentreMsg($arrMessage);

    	if($storeMessageDB)
		{
			$_SESSION['ackmsg'] = 'Your message sent successfully';
			header("location:admin_announcements_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}	
}
?>
     <script type="text/javascript" src="../web/validation/send-announcement.validate.js"></script>
<script>
$(document).ready(function() {
	$("#sendCentre").click(function(){
	 $("#centre").show();
	 $("select ddlCenter").show();
		   $("#student").hide();
	});
	$("#sendStudent").click(function(){
	  $("#centre").hide();
		   $("#student").show();
		    $("select ddlCenter").hide();
	});
 $(function(){
    $("#certificate_0").change(function(){
        if (this.checked === true) {
            $("input:checkbox.subcheck").attr("checked", "checked");
        }
        else {
            $("input:checkbox.subcheck").removeAttr("checked");
        }
    });
});
$(function(){
    $("#studentcheck").change(function(){
        if (this.checked === true) {
            $("input:checkbox.subcheck1").attr("checked", "checked");
        }
        else {
            $("input:checkbox.subcheck1").removeAttr("checked");
        }
    });
});
});

</script>
<script type="text/javascript">
$(document).ready(function(){

$(".centreselectall").click(function() {
	     		var checked_status = this.checked;
				var checkbox_name = this.title;
				$("input."+this.title).each(function() {
				this.checked = checked_status;
				});
			});
$(".studentselectall").live("click",function() {
	     		var checked_status = this.checked;
				var checkbox_name = this.title;
				$("input."+this.title).each(function() {
				this.checked = checked_status;
				});
			});

$('#selectStudent').change(function() {
	  var selctedval= $('#selectStudent').val();
	 $.ajax({
                       type: "GET",
                       url: "sendannouncement.php",
                       data: {id: selctedval}, 
                       success: function(result){
						  $(".studentdetails").html(result);
							
                       }
                     });
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
    <form id="frmSendAnnouncement" method="post" action="">
    <div class="studentViewContent">
        
     <h2>Send Announcement</h2>
    
      <div class="addProgramForm sendAnnouncement">
      <ul class="w90p">
      <li>
    <label>Announcement to :</label>
    <span> <input type="radio" value="centre" name="ddlAnnouncedto"  class="radiobtn" checked="checked" id="sendCentre">
         Centre
		 <input type="radio" value="student" name="ddlAnnouncedto" class="radiobtn" id="sendStudent">
		 Student</span>
         
   </li>
   
  
    <div id="centre"> 
       <fieldset>
          <legend>Centre</legend>
          <span class="centreError"></span>     
  <?php  $centredetailonchange= $messageMaster -> getCentrename();
$countCentre = count($centredetailonchange);
if($countCentre){
echo  "<ul class='studentSelectAll'><li><label><input type='checkbox' name='' title='centrechk' value='{$centredetailonchangelist[id]}' class='centreselectall' /><strong>Select All</strong></label></li></ul>";
echo "<ul class='student'>";
foreach($centredetailonchange as $centredetailonchangelist)
{

echo "<li><label><input type='checkbox' name='centre[]' class='centrechk' title='centrechk' value='{$centredetailonchangelist[id]}'/>{$centredetailonchangelist[academy_name]}</label></li>";

}
echo "</ul>";
}?>
</fieldset>

     
    </div>   
    
    <div id="student" style="display:none;">
    
    <li>
    <label>Select Centre :</label> <?php $country=$centrename->fields[country];
	//print_r($country);?>
    <span><select name="ddlCentre" id="selectStudent" class="mR10">
   <option value="">Select</option>
<?php while(!$centrename->EOF)
{
echo "<option value='{$centrename->fields[id]}'> {$centrename->fields[academy_name]}</option>";
$centrename -> MoveNext();
} ?>
</select>
</span></li>
    <div class="studentdetails">
    <fieldset>
          <legend>Student</legend>
          
  <span class="studentError"></span>     
  <?php  
  $centredetailonchange= $messageMaster -> getstudent($arrStudent);

$countStudent = count($centredetailonchange);
if($countStudent){
echo  "<ul class='studentSelectAll'><li><label><input type='checkbox' name='' title='studentchk' class='studentselectall' /><strong>Select All</strong></label></li></ul>";
foreach($centredetailonchange as $centredetailonchangelist)
{
echo "<ul class='student'>";
echo "<li><label><input type='checkbox' name='student[]' class='studentchk' title='studentchk' value='{$centredetailonchangelist[id]}'/>{$centredetailonchangelist[first_name]}</label></li>";
echo "</ul>";
}
}

 ?>
   </fieldset>
   </div>  </div>
         <li>
    <label>Subject :<strong class="star">*</strong></label>
    <span><input name="txtSubject" type="text" /></span></li>
    <li>
    <label>Message :<strong class="star">*</strong></label>
    <span><textarea name="txtMessage" cols="" rows=""></textarea></span></li>
  
    <li class="announcementbtn"><input name="announcementSend" value="Send" type="submit" class="saveBtn" />
        <a href="admin_announcements_listing.php" class="cancelBtn">Cancel</a>
        </li>
  
      </ul>

      </div>
  
    </div>
    </form>
  </div>

<?php 
include('adminfooter.php');
}
?>