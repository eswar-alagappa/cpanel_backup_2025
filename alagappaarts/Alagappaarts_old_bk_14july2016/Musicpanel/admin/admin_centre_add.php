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
include("../config/classes/centremaster.class.php");
include('adminheader.php');
if(isset($_REQUEST['btnCenteradd']))
{
		$msg = "";
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrcentre = array('centreid'=> $_REQUEST['txtCentreid'],'academy_name'=> $_REQUEST['txtAcademyname'],'address'=>$_REQUEST['txtAcademyaddress'],'city'=>$_REQUEST['txtAcademycity'],
		'state'=>$_REQUEST['txtAcademystate'],'country'=>$_REQUEST['txtAcademycountry'],'zipcode'=>$_REQUEST['txtAcademyzipcode'],'email_id'=>$_REQUEST['txtEmail1'],
		'website'=>$_REQUEST['txtWebsite'],'contact'=>$_REQUEST['txtPhonedaytime'],'alternate_contact'=>$_REQUEST['txtAlternatephoneno'],
		'year_of_establishment'=>$_REQUEST['txtYearofestablishment'],'no_of_arangetram'=>$_REQUEST['txtNumberarangetrams'],'status'=>  $_REQUEST['rdstatus'],
		'created_on'=>$mysql_datetime ,'created_by'=> $_SESSION[userinfo][user_id] ,'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		$centremaster  = new centremaster();
		$count = $centremaster -> checkcentre($arrcentre);
		/*if($count){
			$msg = "Center Already Exsist";
		}
		else{
			$centreID = $centremaster -> addcentre ($arrcentre);
			if($centreID){
				$directorDOB =date('Y-m-d', strtotime($_REQUEST['txtDirectordob']));
				$arrcentredirector = array('','centre_id'=>$centreID,'director_name'=> $_REQUEST['txtDirectorname'],'director_dob'=>$directorDOB,'address'=>$_REQUEST['txtDirectoraddress'],
				'city'=>'','state'=>$_REQUEST['txtDirectorstate'],'country'=>$_REQUEST['txtDirectorcountry'],'zipcode'=>$_REQUEST['txtDirectorzip'],'email_id'=>$_REQUEST['txtDirectorEmail'],
				'special_qualification'=>$_REQUEST['txtDirectorspecialqualifications'],'bharathanatyam_experience'=>$_REQUEST['txtExperienceinBhar'],'events_performed'=>$_REQUEST['txtEvents'],
				'awards_title'=>$_REQUEST['txtAwarsds'],'ballets_choreographed'=>$_REQUEST['txtBalletschoreographed'],'name_of_guru'=>$_REQUEST['txtGuruname'],
				'guru_location'=>$_REQUEST['txtguruLocatedat'] ,'other_info'=>$_REQUEST['txtOtherInfo']);
				$centremaster -> addDirectordetail ($arrcentredirector);
			}
			header('location:admin_centre_listing.php');
		}*/
		if(!$count){
			$centreID = $centremaster -> addcentre ($arrcentre);
			if($centreID){
				$directorDOB =date('Y-m-d', strtotime($_REQUEST['txtDirectordob']));
				$arrcentredirector = array('','centre_id'=>$centreID,'director_name'=> $_REQUEST['txtDirectorname'],'director_dob'=>$directorDOB,'address'=>$_REQUEST['txtDirectoraddress'],
				'city'=>'','state'=>$_REQUEST['txtDirectorstate'],'country'=>$_REQUEST['txtDirectorcountry'],'zipcode'=>$_REQUEST['txtDirectorzip'],'email_id'=>$_REQUEST['txtDirectorEmail'],
				'special_qualification'=>$_REQUEST['txtDirectorspecialqualifications'],'bharathanatyam_experience'=>$_REQUEST['txtExperienceinBhar'],'events_performed'=>$_REQUEST['txtEvents'],
				'awards_title'=>$_REQUEST['txtAwarsds'],'ballets_choreographed'=>$_REQUEST['txtBalletschoreographed'],'name_of_guru'=>$_REQUEST['txtGuruname'],
				'guru_location'=>$_REQUEST['txtguruLocatedat'] ,'other_info'=>$_REQUEST['txtOtherInfo']);
				$centremaster -> addDirectordetail ($arrcentredirector);}
		//$ackmsg = $centremaster -> addcentre ($arrcentre);
		if($centreID)
		{
			$_SESSION['ackmsg'] = 'Center added successfully';
			header("location:admin_centre_listing.php");
			
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
	}
	else
	{
		$msg = "Center already exists";
	}
}
?>
<script type="text/javascript" src="../web/validation/centre.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#datepicker").datepick({
        buttonImage: '../web/images/calendar-img.gif',
        buttonImageOnly: true,
        showOn: 'button',
		/*minDate: 0, */
		dateFormat:'mm/dd/yy',
		buttonText:'Select date',
		minDate: new Date(1900, 12-1, 01), 
		maxDate: new Date(1991,01-1,01),
		yearRange: "-60:+0",
		onClose: function() { $("#datepicker").focus(); }
});

});
</script>

<div class="content">
          <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li><a  href="centre_listing.html">centre</a></li>
        <li class="last"> &nbsp; Add centre</li>
      </ul>
    </div>
    <div class="registrationContent">
      <h2>add centre </h2>
      <form id="frmCentreadd"  name="centreformadd" method="post">
      <div class="registrationForm">
      <?php if($msg)
	  {
		   echo "<div class='adminError'>{$msg}</div>";
	  }
	  ?>
              <div class="registrationFormStudents">
          <fieldset class="w100">
        <legend>Academy Details</legend>
      <ul>
      
      <li><label>Academy Name:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademyname">  </li>
        
      <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" name="txtEmail1">  </li>
      
       <li><label> Website:</label>
		<input type="text" name="txtWebsite">  </li>
        
        <li><label> Phone Day Time :<strong class="star">*</strong></label>
		<input type="text" name="txtPhonedaytime"></li>
        
        <li>
           <label>Alternate Phone : </label>
		<input type="text" name="txtAlternatephoneno">  </li>
        <li><label>Year of Establishment : </label>
		<input type="text" name="txtYearofestablishment">  </li>
        
        <li>
           <label>Number Arangetrams : </label>
		<input type="text" name="txtNumberarangetrams">  </li>
     
      </ul>
     
      <ul>
<li><label>Address: </label>
		<textarea class="h71" name="txtAcademyaddress"></textarea> </li>
        <li>
		<label> City :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycity">  </li>
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademystate">  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycountry">  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademyzipcode">  </li>
       </ul>
      </fieldset>
      <fieldset class="w100">
        <legend>Director's Details</legend>
      <ul>

      <li>
        <label>Director Name :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorname">  </li>
        
      <li class="studentdate"><label>Director's D.O.B:<strong class="star">*</strong></label>
		 <input type="text" class="w200 fL" name="txtDirectordob" id="datepicker"> 
         <!--<a href="#"><img width="21" height="21" src="images/calendar-img.gif" alt=" "></a></li>-->
 
       <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorEmail">  </li>
        
        <li>
           <label> Special Qualifications : </label>
		<textarea name="txtDirectorspecialqualifications"  class="h71" cols="" rows=""></textarea> </li>

      </ul>
     
      <ul>
      
<li><label>Address: </label>
		<textarea name="txtDirectoraddress"  class="h71"></textarea> </li>
        
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorstate">  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorcountry">  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorzip">  </li>
 
      </ul>
      </fieldset>

        <fieldset class="w100">
        <legend>Music Details </legend>
     <ul>
                <li><label>Experience in Music :</label>
                     <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExperienceinBhar"></li>
                     <li>
           <label>Events Performances : </label>
		<textarea rows="" cols="" name="txtEvents"></textarea>  </li>
        <li>
           <label> Awards Titles : </label>
		<textarea rows="" cols="" name="txtAwarsds"></textarea>  </li>
        <li>
           <label>Ballets Choreographed: </label>
		<textarea rows="" cols="" name="txtBalletschoreographed"></textarea>  </li>
     </ul>
            <ul>
                <li><label>Name of your Guru : </label><input class="frm_element" id="txtGuru" tabindex="18" maxlength="50" name="txtGuruname"></li>
                     
                      <li><label>Located at 	:</label><input class="frm_element" id="txtLoca" tabindex="19" maxlength="50" name="txtguruLocatedat"></li>
                      
                   <li><label>Other relevant info</label><textarea class="frm_element" id="txtInfo" style="height: 30px;" tabindex="20" name="txtOtherInfo"></textarea> 
              </li>
              
            </ul>
         <ul>
         
         </ul>
        </fieldset>
        <fieldset class="w100">
        <legend>Center Status  </legend>
       <ul class="experience">
       <li class="w100">
        <label class="w100">Status :<strong class="star">*</strong> </label>
         </li>  
        <li> <div class="centrestatus"><input type="radio" value="Y" name="rdstatus" class="radiobtn">Active
         <input type="radio" value="N" name="rdstatus" class="radiobtn" /> Inactive
        </div></li>
              </ul>
             <ul class="referenceCode" style="display:none"><li>
        <label>Enter Reference Code  : <strong class="star">*</strong></label>
<input type="text" name="txtCentreid" value=""> </li></ul>
          </fieldset>
      </div>
      <ul><li class="button"><input name="btnCenteradd" value="add" type="submit" class="submitBtn fL" />
          <input name="resetbtn" value="reset" type="reset" class="cancelBtn" /><!--<a href="admin_center_listing.php" class="cancelBtn">Cancel</a>-->
        </li></ul>
      </div>
      </form>
    </div>

  </div>
<?php 
include('adminfooter.php');
}
?>