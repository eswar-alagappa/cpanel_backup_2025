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
$centreid = $_GET[ centreid ];
$centremaster  = new centremaster();
$centredetail = $centremaster -> getcentredetails($centreid);
//echo "<pre>";
//print_r($centredetail);
if(isset($_REQUEST['btnCenteredit']))
{
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrcentre = array('id'=>$centreid,'centreid'=> $_REQUEST['txtCentreid'],'academy_name'=> $_REQUEST['txtAcademyname'],'address'=>$_REQUEST['txtAcademyaddress'],'city'=>$_REQUEST['txtAcademycity'],
		'state'=>$_REQUEST['txtAcademystate'],'country'=>$_REQUEST['txtAcademycountry'],'zipcode'=>$_REQUEST['txtAcademyzipcode'],'email_id'=>$_REQUEST['txtEmail1'],
		'website'=>$_REQUEST['txtWebsite'],'contact'=>$_REQUEST['txtPhonedaytime'],'alternate_contact'=>$_REQUEST['txtAlternatephoneno'],
		'year_of_establishment'=>$_REQUEST['txtYearofestablishment'],'no_of_arangetram'=>$_REQUEST['txtNumberarangetrams'],'status'=>$_REQUEST['rdstatus'],
		'modified_by' => $_SESSION[userinfo][user_id],'modified_on'=>$mysql_datetime);
		 $centremaster -> updatecentre ($arrcentre);
		 $directorDOB =date('Y-m-d', strtotime($_REQUEST['txtDirectordob']));
		 $arrcentredirector = array('centre_id'=>$centreid,'director_name'=> $_REQUEST['txtDirectorname'],'director_dob'=>$directorDOB,'address'=>$_REQUEST['txtDirectoraddress'],
		 'city'=>'','state'=>$_REQUEST['txtDirectorstate'],'country'=>$_REQUEST['txtDirectorcountry'],'zipcode'=>$_REQUEST['txtDirectorzip'],'email_id'=>$_REQUEST['txtDirectorEmail'],
		 'special_qualification'=>$_REQUEST['txtDirectorspecialqualifications'],'bharathanatyam_experience'=>$_REQUEST['txtExperienceinBhar'],'events_performed'=>$_REQUEST['txtEvents'],
		 'awards_title'=>$_REQUEST['txtAwarsds'],'ballets_choreographed'=>$_REQUEST['txtBalletschoreographed'],'name_of_guru'=>$_REQUEST['txtGuruname'],
		 'guru_location'=>$_REQUEST['txtguruLocatedat'] ,'other_info'=>$_REQUEST['txtOtherInfo']);
		// $centremaster -> updateDirectordetail ($arrcentredirector);
		// header('location:admin_centre_listing.php');
		 
		 $ackmsg =  $centremaster -> updateDirectordetail ($arrcentredirector);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Center updated successfully';
			header("location:admin_centre_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
		
}

/*echo "<pre>";
print_r ($centredetail);*/
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
        <li><a  href="course_listing.html">courses</a></li>
         <li class="last"> &nbsp; Edit course</a></li>
       </ul>
    </div>
    <div class="registrationContent">
      <h2>Edit center </h2>
      <form id="frmCentreadd"  name="centreformedit" method="post">
      <div class="registrationForm">
              <div class="registrationFormStudents">
          <fieldset class="w100">
        <legend>Academy Details</legend>
      <ul>
      
      <li><label>Academy Name:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademyname" value="<?php echo $centredetail->fields[academy_name]; ?>" >  </li>
        
      <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" name="txtEmail1" value="<?php echo $centredetail->fields[centreEmail_id]; ?>" >  </li>
      
       <li><label> Website:</label>
		<input type="text" name="txtWebsite" value="<?php echo $centredetail->fields[website]; ?>" >  </li>
        
        <li><label> Phone Day Time :<strong class="star">*</strong></label>
		<input type="text" name="txtPhonedaytime" value="<?php echo $centredetail->fields[contact]; ?>" ></li>
        
        <li>
           <label>Alternate Phone : </label>
		<input type="text" name="txtAlternatephoneno" value="<?php echo $centredetail->fields[alternate_contact]; ?>" >  </li>
        <li><label>Year of Establishment : </label>
		<input type="text" name="txtYearofestablishment" value="<?php echo $centredetail->fields[year_of_establishment]; ?>" >  </li>
        
        <li>
           <label>Number Arangetrams : </label>
		<input type="text" name="txtNumberarangetrams" value="<?php echo $centredetail->fields[no_of_arangetram]; ?>" >  </li>
     
      </ul>
     
      <ul>
<li><label>Address: </label>
		<textarea class="h71" name="txtAcademyaddress"><?php echo $centredetail->fields[address]; ?></textarea> </li>
        <li>
		<label> City :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycity" value="<?php echo $centredetail->fields[4]; ?>" >  </li>
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademystate" value="<?php echo $centredetail->fields[5]; ?>" >  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycountry" value="<?php echo $centredetail->fields[6]; ?>" >  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademyzipcode" value="<?php echo $centredetail->fields[7]; ?>" >  </li>
       </ul>
      </fieldset>
      <fieldset class="w100">
        <legend>Director's Details</legend>
      <ul>

      <li>
        <label>Director Name :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorname" value="<?php echo $centredetail->fields[director_name]; ?>" >  </li>
        
      <li class="studentdate"><label>Director's D.O.B:<strong class="star">*</strong></label>
      <?php   $dob =  split('-',$centredetail->fields[director_dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $directorDOB =date('m/d/Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0])); ?>
		 <input type="text" class="w200 fL" name="txtDirectordob" id="datepicker" value="<?php  echo $directorDOB; ?>"> 
         <!--<a href="#"><img width="21" height="21" src="images/calendar-img.gif" alt=" "></a></li>-->
 
       <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorEmail" value="<?php echo $centredetail->fields[directorEmail_id]; ?>" >  </li>
        
        <li>
           <label> Special Qualifications : </label>
		<textarea name="txtDirectorspecialqualifications"  class="h71" cols="" rows=""><?php echo $centredetail->fields[special_qualification]; ?></textarea> </li>

      </ul>
     
      <ul>
      
<li><label>Address: </label>
		<textarea name="txtDirectoraddress"  class="h71"><?php echo $centredetail->fields[directorAdress]; ?></textarea> </li>
        
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorstate" value="<?php echo $centredetail->fields[directorState]; ?>" >  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorcountry" value="<?php echo $centredetail->fields[directorCountry]; ?>" >  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorzip" value="<?php echo $centredetail->fields[directorZipcode]; ?>" >  </li>
 
      </ul>
      </fieldset>

        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
     <ul>
                <li><label>Experience in Bharathanatyam :</label>
                     <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExperienceinBhar" value="<?php echo $centredetail->fields[bharathanatyam_experience]; ?>" ></li>
                     <li>
           <label>Events Performances : </label>
		<textarea rows="" cols="" name="txtEvents"><?php echo $centredetail->fields[events_performed]; ?></textarea>  </li>
        <li>
           <label> Awards Titles : </label>
		<textarea rows="" cols="" name="txtAwarsds"> <?php echo $centredetail->fields[awards_title]; ?></textarea>  </li>
        <li>
           <label>Ballets Choreographed: </label>
		<textarea rows="" cols="" name="txtBalletschoreographed"> <?php echo $centredetail->fields[ballets_choreographed]; ?></textarea>  </li>
     </ul>
            <ul>
                <li><label>Name of your Guru : </label><input class="frm_element" id="txtGuru" tabindex="18" maxlength="50" name="txtGuruname" value="<?php echo $centredetail->fields[name_of_guru]; ?>" ></li>
                     
                      <li><label>Located at 	:</label><input class="frm_element" id="txtLoca" tabindex="19" maxlength="50" name="txtguruLocatedat" value="<?php echo $centredetail->fields[guru_location]; ?>" ></li>
                      
                   <li><label>Other relevant info</label><textarea class="frm_element" id="txtInfo" style="height: 30px;" tabindex="20" name="txtOtherInfo"><?php echo $centredetail->fields[other_info]; ?></textarea> 
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
        <li> <div class="centrestatus"><input type="radio" value="Y" name="rdstatus" <?php  if( $centredetail->fields[status] == 'Y') echo "checked"; ?> class="radiobtn">Active
         <input type="radio" value="N" name="rdstatus" class="radiobtn"  <?php  if( $centredetail->fields[status] == 'N') echo "checked"; ?> /> Inactive
        </div></li>
              </ul>
             <ul class="referenceCode" <?php if( $centredetail->fields[status] != 'Y') echo "style='display:none'"; ?> ><li>
        <label>Enter Reference Code  :  </label>
<input type="text" name="txtCentreid" value="<?php  echo  $centredetail->fields[centreid] ; ?> "> </li></ul>
          </fieldset>
      </div>
      <ul><li class="button"><input name="btnCenteredit" value="UPDATE" type="submit" class="submitBtn fL" />
          <a href="admin_centre_listing.php" class="cancelBtn">Cancel</a>
        </li></ul>
      </div>
      </form>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>