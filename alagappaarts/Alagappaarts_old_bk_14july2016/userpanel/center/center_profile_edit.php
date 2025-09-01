<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);
/*echo $iscenter ;
exit;*/
if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
include("../config/classes/centremaster.class.php");
include('centerheader.php');
$centreid =$userid;
$centremaster  = new centremaster();
$centredetail = $centremaster -> getcentredetails($centreid);
/*echo "<pre>";
print_r($centredetail );*/
if(isset($_REQUEST['btnCenteredit']))
{
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrcentre = array('id'=>$centreid,'centreid'=>  $centredetail->fields[centreid],'academy_name'=> $_REQUEST['txtAcademyname'],'address'=>$_REQUEST['txtAcademyaddress'],'city'=>$_REQUEST['txtAcademycity'],
		'state'=>$_REQUEST['txtAcademystate'],'country'=>$_REQUEST['txtAcademycountry'],'zipcode'=>$_REQUEST['txtAcademyzipcode'],'email_id'=>$_REQUEST['txtEmail1'],
		'website'=>$_REQUEST['txtWebsite'],'contact'=>$_REQUEST['txtPhonedaytime'],'alternate_contact'=>$_REQUEST['txtAlternatephoneno'],
		'year_of_establishment'=>$_REQUEST['txtYearofestablishment'],'no_of_arangetram'=>$_REQUEST['txtNumberarangetrams'],'status'=>$centredetail->fields[status],
		'modified_by' => $_SESSION[centerinfo][user_id],'modified_on'=>$mysql_datetime);
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
			$_SESSION['ackmsg'] = 'Profile updated successfully';
			header("location:center_profile_center.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
		
}

?>
<script type="text/javascript" src="../web/validation/centreedit.validate.js"></script>
<!--<script type="text/javascript" src="../web/validation/centre.validate.js" ></script>-->
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
		maxDate: new Date(1995,12-1,31),
		yearRange: "-60:+0",
		onClose: function() { $("#datepicker").focus(); }
     });

});
 </script>

<div class="headerBottom">

      <div class="admiTitle">Welcome To <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenavactive"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">
<div class="content">
     <div class="contentOuter">
      <h2>Edit Profile</h2>
   <div class="contentInner">
          <?php if( $msg )
	{
       echo "<div class='error'> {$msg} </div>";
      }
	  ?>
       <?php /*?><div class="profileContent">
      <div class="makePaymentForm">
      <ul>
      <li>
        <label> Ref. Code   : </label> 
<span><?php echo $studentdetail->fields[enrollment_id]; ?></span>

         </select>

  </li> 
         <li>
        <label> First Name 	   :  </label>
         <?php echo $studentdetail->fields[first_name]; ?>		</li>
         <li>
           <label> Last Name     : </label> 
  <span><?php echo $studentdetail->fields[last_name]; ?></span>
		</li>
         <!--<li>
           <label> Date Of Birth     : </label> 
  <span>Ramasamy</span>
		</li>-->
       <li class="studentdate"><label>D.O.B:<strong class="star"> *</strong></label>
      <?php   $dob =  split('-',$studentdetail->fields[dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $studentDOB =date('m/d/Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0])); 
		  ?> 
         <input class="w200" name="txtdob" type="text" id="datepicker" value="<?php echo $studentDOB;?>"/> </li>
    <li>
        <label> Address   :<strong class="star"> *</strong></label>  <textarea name="txtAddress" cols="" rows=""><?php echo $studentdetail->fields[address]; ?></textarea>
		 </li>
<li>
        <label> City   :<strong class="star"> *</strong>  </label><input name="txtCity" type="text" class="fL" value="<?php echo $studentdetail->fields[city]; ?>"></li>
        <li>
        <label> State	   :<strong class="star"> *</strong>  </label><input name="txtState" type="text" class="fL" value="<?php echo $studentdetail->fields[state]; ?>"></li>
        <li>
        <label> Country   :<strong class="star"> *</strong>  </label><input name="txtCountry" type="text" class="fL" value="<?php echo $studentdetail->fields[country]; ?>"></li>
        <li>
        <label> Zip code   :<strong class="star"> *</strong>  </label><input name="txtZip" type="text" class="fL" value="<?php echo $studentdetail->fields[zipcode]; ?>"></li>
        <li>
        <label> Email   :<strong class="star"> *</strong>  </label><input name="txtEmail" type="text" class="fL" value="<?php echo $studentdetail->fields[email_id]; ?>"></li>
        <li>
        <label> Phone   :<strong class="star"> *</strong>  </label><input name="txtMobile" type="text" class="fL" value="<?php echo $studentdetail->fields[mobile]; ?>"></li>

         <li class="btn"><input name="btnEditstudent" value="Update" type="submit" class="saveBtn fL" />
        <a href="student_profile_students.php" class="cancelBtn" >Cancel</a>
        </li>
      </ul>
      </div>
      </div><?php */?>
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
        
      </div>
      <ul><li class="button"><input name="btnCenteredit" value="UPDATE" type="submit" class="submitBtn fL" />
          <a href="center_profile_center.php" class="cancelBtn">Cancel</a>
        </li></ul>
      </div>
      </form>
      </div>
     
<div>
  
</div>
           
    </div>
</div>
</div>
 
<?php 
include('centerfooter.php');
}
?>