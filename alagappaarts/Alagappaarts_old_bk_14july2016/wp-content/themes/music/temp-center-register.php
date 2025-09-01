<?php
/*
Template Name:center register
*/
$wpdbnew = new wpdb("alagappa_usermus", "FG9T}AHXAA~4", "alagappa_music", "localhost");

if(isset($_REQUEST['btnStudentreg']))
{
	function rpHash($value) {
	$hash = 5381;
	$value = strtoupper($value);
	for($i = 0; $i < strlen($value); $i++) {
		$hash = (($hash << 5) + $hash) + ord(substr($value, $i));
	}
			return $hash;
		}

if ( strtoupper($_POST['defaultReal'])  == $_POST['defaultRealHash']) {
	
	

	 
	 $directorDOB=date('Y-m-d', strtotime($_REQUEST['txtDirectordob']));// exit;
	$mysql_datetime = date('Y-m-d H:i:s');
		$arrcentre = array('academy_name'=> $_REQUEST['txtAcademyname'],'address'=>$_REQUEST['txtAcademyaddress'],'city'=>$_REQUEST['txtAcademycity'],
		'state'=>$_REQUEST['txtAcademystate'],'country'=>$_REQUEST['txtAcademycountry'],'zipcode'=>$_REQUEST['txtAcademyzipcode'],'email_id'=>$_REQUEST['txtEmail1'],
		'website'=>$_REQUEST['txtWebsite'],'contact'=>$_REQUEST['txtPhonedaytime'],'alternate_contact'=>$_REQUEST['txtAlternatephoneno'],
		'year_of_establishment'=>$_REQUEST['txtYearofestablishment'],'no_of_arangetram'=>$_REQUEST['txtNumberarangetrams'],'status'=>  'N',
		'created_on'=>$mysql_datetime ,'modified_on'=>$mysql_datetime,'director_name'=> $_REQUEST['txtDirectorname'],'director_dob'=>$directorDOB,'director_address'=>$_REQUEST['txtDirectoraddress'],'director_city'=>'',
				'director_state'=>$_REQUEST['txtDirectorstate'],'director_country'=>$_REQUEST['txtDirectorcountry'],'director_zipcode'=>$_REQUEST['txtDirectorzip'],'director_email_id'=>$_REQUEST['txtDirectorEmail'],
				'special_qualification'=>$_REQUEST['txtDirectorspecialqualifications'],'bharathanatyam_experience'=>$_REQUEST['txtExperienceinBhar'],'events_performed'=>$_REQUEST['txtEvents'],
				'awards_title'=>$_REQUEST['txtAwarsds'],'ballets_choreographed'=>'','name_of_guru'=>$_REQUEST['txtGuruname'],
				'guru_location'=>$_REQUEST['txtguruLocatedat'] ,'other_info'=>$_REQUEST['txtOtherInfo']);// $_REQUEST['txtBalletschoreographed']
		
		$studentmastersql = "insert into centremaster(academy_name,address,city,state,country,zipcode,email_id,website,contact,alternate_contact,year_of_establishment,no_of_arangetram,status,created_on,modified_on) values('{$arrcentre[academy_name]}','{$arrcentre[address]}','{$arrcentre[city]}','{$arrcentre[state]}',
		'{$arrcentre[country]}','{$arrcentre[zipcode]}','{$arrcentre[email_id]}','{$arrcentre[website]}','{$arrcentre[contact]}',
		'{$arrcentre[alternate_contact]}','{$arrcentre[year_of_establishment]}','{$arrcentre[no_of_arangetram]}','{$arrcentre[status]}',
		'{$arrcentre[created_on]}','{$arrcentre[modified_on]}')";
		
		$checkstudentEmailID = $wpdbnew->get_results("select academy_name from centremaster where academy_name='{$arrcentre[academy_name]}'");

		$count = count($checkstudentEmailID);
		
		if($count){
			$errormsg = "You are already Registered";
		}
		else{
		 
			$wpinsertquery =$wpdbnew->query($studentmastersql);
			
			$getLastinsertedId = $wpdbnew->get_results("select max(id) as id from centremaster where academy_name='{$arrcentre[academy_name]}'");
			$lasid= $getLastinsertedId[0]->id;
			
			$insertEnrollmentId = $wpdbnew->get_results("insert into student_enrollmentid  values('','{$lasid}','501','500')");
			
			$insertDirector = "insert into centre_director values('','{$lasid}','{$arrcentre[director_name]}','{$arrcentre[director_dob]}','{$arrcentre[director_address]}',
		'{$arrcentre[director_city]}','{$arrcentre[director_state]}','{$arrcentre[director_country]}','{$arrcentre[director_zipcode]}','{$arrcentre[director_email_id]}',
		'{$arrcentre[special_qualification]}','{$arrcentre[bharathanatyam_experience]}','{$arrcentre[events_performed]}','{$arrcentre[awards_title]}',
		'{$arrcentre[ballets_choreographed]}','{$arrcentre[name_of_guru]}','{$arrcentre[guru_location]}','{$arrcentre[other_info]}')";
		$wpinsertDirector = $wpdbnew->query($insertDirector);
			if($wpinsertquery)
			{
				$mailto=$arrcentre[email_id];
				$name=$arrcentre[academy_name];
				$my_subject = "Greetings from APAA!";
				$my_message = "Dear ".$arrcentre[academy_name].",<br/><strong> Greetings from APAA! </strong>Your request  for registering as APAA Music Center has been successfully completed. The APAA customer support team will provide you with a user id and password shortly.<br/><br/>Regards<br/>The APAA Team ";
				
				$header = "From: \"The APAA Team\" <customersupport@alagappaarts.com> \r\n";
				$header .= "Reply-To: customersupport@alagappaarts.com \r\n";
				$header .= 'MIME-Version: 1.0' . "\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					wp_mail($mailto, $my_subject, $my_message,  $header);
					 $msg ="Thank you for registering";
			}
			
		}
		
}else
{
	 $errormsg ="Please Enter Correct Captcha code";
	 }
}

?>
<?php

get_header(); ?>
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/formcss.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/ui.datepick.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.datepick.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.min.js"> </script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.validate.js"> </script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/student.validate.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/datetimepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/datetimepicker/jquery.datepick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/datetimepicker/jquery.datepick.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.realperson.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#datepicker").datepick({
buttonImage: '<?php bloginfo('stylesheet_directory'); ?>/images/calendar-img.png',
buttonImageOnly: true,
showOn: 'button',
/*minDate: 0, */
dateFormat:'M-dd-yy',
buttonText:'Select date',
minDate: new Date(1900, 12-1, 01),
maxDate: new Date(2015,12-1,31),
yearRange: "-60:+0",
onClose: function() { $("#datepicker").focus(); }
});
$('#selector').realperson({includeNumbers: true});
});
</script>
 <div class="musicInnerContentOuter">
<div class="musicInnerContent">
<?php get_sidebar(); ?>
<div class="musicInnerContentRight">
<div class="musicInnerBanner"><?php the_title(); ?></div>
<div class="musicApaaform"> <a href="<?php bloginfo('wpurl'); ?>/wp-content/themes/music/images/Music-Center-Accreditation.pdf" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/registration-btn.png" width="284" height="40" class="registerBtn" /></a>
<div class="registerFormOuter">
<div class="registerFormTitle">
<div class="registerFormTitleLeftBg"></div>
<div class="registerFormTitleBg">Please use the following information to register.</div>
<div class="registerFormTitleRightBg"></div>

</div>
 
    

 

   <div class="registerFormOuter">
  
<div class="registerForm">
<center><span class="studentregCorrect"><?php if( $msg) echo $msg ; ?></span></center>
<center><span class="studentregError"><?php if($errormsg ) echo $errormsg ;?></span></center>
<form id="frmCentreadd"  method="post"  enctype="multipart/form-data">

<ul>
<li><label>Academy Name :<strong class="star">*</strong></label>
<input type="text" name="txtAcademyname"></li>
 <li><label>Address:<strong class="star">*</strong> </label>
		<input type="text" name="txtAcademyaddress"/> </li>
        <li>
		<label> City :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycity">  </li>
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtAcademystate">  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademycountry">  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtAcademyzipcode">  </li>


      <li>
        <label>Director Name :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorname">  </li>
        
      <li class="studentdate"><label>Director's D.O.B:<strong class="star">*</strong></label>
		 <input type="text" class="w200 fL" name="txtDirectordob" id="datepicker"  readonly="readonly"> 
         <!--<a href="#"><img width="21" height="21" src="images/calendar-img.gif" alt=" "></a></li>-->
 
       <li><label>Email :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorEmail">  </li>
        
        <li>
           <label> Special Qualifications : </label>
		<input type="text" name="txtDirectorspecialqualifications" /> </li>

                <li><label>Experience in Music:</label>
                     <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExperienceinBhar"></li>
                     <li>
           <label>Events Performances : </label>
		<input type="text" name="txtEvents" />  </li>
        <li>
           <label> Awards Titles : </label>
		<textarea rows="" cols="" name="txtAwarsds" style="height: 30px;"></textarea>  </li>
       <!-- <li>
           <label>Ballets Choreographed: </label>
		<textarea rows="" cols="" name="txtBalletschoreographed"></textarea>  </li> -->
 
      <li>
  <label>What code is in the image? :<strong class="star">*</strong></label>
      <input type="text" name="defaultReal" id="selector" maxlength="6" size="6"/>

  <div class="captcha"></div>
</li>
        
        </ul>
        <ul>
        <li>
  <label>Email :<strong class="star">*</strong></label><input type="text" name="txtEmail1"></li>

<li>
  <label>Website : </label><input type="text" name="txtWebsite"></li>

      <li><label> Phone Day Time :<strong class="star">*</strong></label>
		<input type="text" name="txtPhonedaytime"></li>
 
        <li>
           <label>Alternate Phone : </label>
		<input type="text" name="txtAlternatephoneno">  </li>
         <li>
           <label>Number Arangetrams : </label>
		<input type="text" name="txtNumberarangetrams">  </li>
         <li><label>Year of Establishment : </label>
		<input type="text" name="txtYearofestablishment">  </li>
       
      
<li><label>Address: </label>
		<input type="text" name="txtDirectoraddress"  /> </li>
        
        <li><label>State :<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorstate">  </li>
        <li><label>Country:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorcountry">  </li>
        <li><label>Zip:<strong class="star">*</strong></label>
		<input type="text" name="txtDirectorzip">  </li>
 

                <li><label>Name of your Guru : </label><input class="frm_element" id="txtGuru" tabindex="18" maxlength="50" name="txtGuruname"></li>
                     
                      <li><label>Located at 	:</label><input class="frm_element" id="txtLoca" tabindex="19" maxlength="50" name="txtguruLocatedat"></li>
                      
                   <li><label>Other relevant info</label><textarea class="frm_element" id="txtInfo" style="height: 30px;" tabindex="20" name="txtOtherInfo"></textarea> 
              </li>

     
</ul>

 
          
<div class="centerregisterBtn"><input name="btnStudentreg" type="submit" class="registerBtn" value="Register" id="submit"/></div>

</form>
</div>
  </div>
  
  

 
 </div>
  </div>
</div>
</div>
</div> 
  

<?php get_footer(); ?>