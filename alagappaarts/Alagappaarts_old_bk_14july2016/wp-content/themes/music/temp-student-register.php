<?php
/*
Template Name:student register new
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

if (strtoupper($_POST['defaultReal']) == $_POST['defaultRealHash']) {
	
	 
$studentStatusSQL = $wpdbnew->get_results("select id from keywordmaster where code='studentstatus' and value ='Waiting for Approval'");
$studentpaymentstatus = $wpdbnew->get_results("select id from keywordmaster where code='paymentstatus' and value ='Pending'");
$attName = $_FILES["flePhoto"]["name"];
$mysql_datetime = date('Y-m-d H:i:s');
  $studentDOB =date('Y-m-d', strtotime($_REQUEST['txtdob']));// exit;
$firstname=$_REQUEST['txtFname'];$lastname=$_REQUEST['txtLname']; $age=	$_REQUEST['txtAge'];$gender=$_REQUEST['rdgender'];$phone=$_REQUEST['txtcontact'];
$mobile=$_REQUEST['txtMobile'];$email_id=$_REQUEST['txtEmail'];$address=$_REQUEST['txtAddress'];$city=$_REQUEST['txtCity'];$state=$_REQUEST['txtState'];
		$country=$_REQUEST['txtCountry'];$zipcode=$_REQUEST['txtZip'];$bharathanatyam_experience=$_REQUEST['txtExpBha'];
		$special_qualification=$_REQUEST['txtSpecqualification'];$name_of_guru=$_REQUEST['txtguruname'];$guru_location=$_REQUEST['txtLoca'];$photo=$attName;
		$other_info=$_REQUEST['txtotherinfo'];$status=$studentStatusSQL[0]->id;
		$created_on=$mysql_datetime ;$modified_on=$mysql_datetime;
		$studentmastersql= "INSERT INTO studentmaster (first_name, last_name, dob, age, gender, photo, mobile, phone, email_id, address, city, state, country, zipcode,
		 bharathanatyam_experience, special_qualification, name_of_guru, guru_location, other_info, status,created_on,modified_on) VALUES('$firstname','$lastname',
		 '$studentDOB','$age','$gender','$photo','$mobile','$phone','$email_id','$address','$city','$state','$country','$zipcode','$bharathanatyam_experience',
		 '$special_qualification','$name_of_guru','$guru_location','$other_info','$status','$created_on','$modified_on')";
		
		$checkstudentEmailID = $wpdbnew->get_results("select email_id from studentmaster where  email_id = '{$email_id}'");
	
		$count = count($checkstudentEmailID);
		if($count){
			$errormsg = "You are already Registered";
		}
		else{
                    
			$wpinsertquery=$wpdbnew->query($studentmastersql);
			$getLastinsertedId =$wpdbnew->get_results("select max(id) as id from studentmaster where email_id='{$email_id}'");
			$lasid= $getLastinsertedId[0]->id;
			$student_id= $lasid;
			$program_id=$_REQUEST['ddlProgram'];
			$centre_id=$_REQUEST['ddlCenter'];
			$payment_status_id=$studentpaymentstatus[0]->id;
			$graduation_status='N';
			$cc_issued='N';
			
			
			$studentdeducationsql="INSERT INTO student_education (student_id,program_id,centre_id,payment_status_id,graduation_status,cc_issued) 
			VALUES('$student_id','$program_id','$centre_id','$payment_status_id','$graduation_status','$cc_issued')";
			$studenteducationinsert=$wpdbnew->query($studentdeducationsql);
			
			$sql = "select cm.academy_name as centername,pm.name as programname from student_education se join centremaster cm on cm.id = se.centre_id join programmaster pm on pm.id = se.program_id where se.student_id={$student_id}";
			$programcenter = $wpdbnew->get_results($sql);
			
			$my_file =$_FILES['flePhoto']['name'];
            $target_path = "/home/alagappa/public_html/up/music/uploads/student/";
			
			$target_paths = $target_path . basename( $_FILES['flePhoto']['name']); 
			if($_FILES['flePhoto']['name'] ) move_uploaded_file($_FILES['flePhoto']['tmp_name'], $target_paths) ;
			if($wpinsertquery)
			{
				$mailto=$email_id;
				$name=$firstname;
				$my_subject = "Greetings from APAA!";
				$my_message = "Dear ".$firstname.' '.$lastname.",<br/><strong> Greetings from APAA! </strong>Your request  for enrolling under the <strong>".$programcenter[0]->programname."</strong> through the music center - <strong>".$programcenter[0]->centername."</strong> has been successfully completed. The APAA customer support team will contact you  shortly.<br/><br/>Regards<br/>The APAA Team ";
				
				$header = "From: \"The APAA Team\" <customersupport@alagappaarts.com> \r\n";
				$header .= "Reply-To: customersupport@alagappaarts.com \r\n";
				$header .= 'MIME-Version: 1.0' . "\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				wp_mail($mailto, $my_subject, $my_message,  $header);
				
				$amailto = "customersupport@alagappaarts.com";
				//$amailto = "damuslm@gmail.com";
				$a_subject = "APAA - New student registration request";
				$amessage = "Dear APAA Team,<br/><br/><strong>".$firstname." ".$lastname."</strong> has requested for enrolling under the <strong>".$programcenter[0]->programname."</strong> through the music center - <strong>".$programcenter[0]->centername."</strong>.". "The student details are,<br/><br/>";
				$amessage .= "<table border='1'><tr><td>Name</td><td>".$firstname." ".$lastname."</td></tr>
				<tr><td>Program Enrolled </td><td>".$programcenter[0]->programname."</td></tr>
				<tr><td>Center Name </td><td>".$programcenter[0]->centername."</td></tr>
				<tr><td>Email Id </td><td>".$mailto."</td></tr>
				<tr><td>Phone </td><td>".$phone."</td></tr>
				<tr><td>Mobile </td><td>".$mobile."</td></tr>
				<tr><td>Address </td><td>".$address."</td></tr>
				<tr><td>City </td><td>".$city."</td></tr>
				<tr><td>State </td><td>".$state."</td></tr>
				<tr><td>Country </td><td>".$country."</td></tr>
				<tr><td>Zipcode </td><td>".$zipcode."</td></tr>
				<tr><td>Date of Birth </td><td>".$studentDOB."</td></tr>
				<tr><td>Age </td><td>".$age."</td></tr>
				<tr><td>Gender </td><td>".$gender."</td></tr>
				<tr><td>Bharathanatyam Experience </td><td>".$bharathanatyam_experience."</td></tr>
				<tr><td>Special Qualification </td><td>".$special_qualification."</td></tr>
				<tr><td>Name of Guru </td><td>".$name_of_guru."</td></tr>
				<tr><td>Guru's Location </td><td>".$guru_location."</td></tr>
				<tr><td>Other Info</td><td>".$other_info."</td></tr>
				<tr><td>Student Status</td><td>Waiting for Approval</td></tr>
				</table>";
				$aheader = "From: \"".$firstname." ".$lastname."\" <".$mailto."> \r\n";
				$aheader .= "Reply-To: ".$mailto." \r\n";
				$aheader .= 'MIME-Version: 1.0' . "\r\n";
				$aheader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					wp_mail($amailto, $a_subject, $amessage,  $aheader);
					 $msg ="Thank you for registering";
					
			}
		
	}
}
else
{
	 $errormsg ="Please Enter Correct Captcha code";
	 }
}
?>

<?php 

get_header(); 


?>
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
<div class="musicApaaform"> <a href="<?php bloginfo('wpurl'); ?>/wp-content/themes/music/images/application-form-music.pdf" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/registration-btn.png" width="284" height="40" class="registerBtn" /></a>
<div class="registerFormOuter">
<div class="registerFormTitle">
<div class="registerFormTitleLeftBg"></div>
<div class="registerFormTitleBg">To Get Admissions, Please fill in the form given below</div>
<div class="registerFormTitleRightBg"></div>

</div>
 
   <div class="registerFormOuter">
 
<div class="registerForm">
<center><span class="studentregCorrect"><?php if( $msg) echo $msg ; ?></span></center>
<center><span class="studentregError"><?php if($errormsg ) echo $errormsg ;?></span></center>
 <form id="studentForm"  method="post"  enctype="multipart/form-data">
<ul>
<li><label>Program :<strong class="star">*</strong></label>

<select name="ddlProgram">
  <option value="">Select</option>
  <?php 
global  $wpdb;
$myquery = $wpdb->get_results("SELECT * FROM programmaster where status='Y'");
foreach ($myquery as $queries) {
	echo "<option value='{$queries->id}' >{$queries->name}</option>";
}
?>
 </select></li>
 <li>
  <label>Firsts Name :<strong class="star">*</strong></label><input name="txtFname" type="text" /></li>
<li>
<li>
  <label>Last Name : </label><input name="txtLname" type="text" /></li>
<li>
<li>
  <label>Age :<strong class="star">*</strong></label>
  <input name="txtAge" type="text" maxlength="3" /></li>
<li class="studentdate"><label>D.O.B : <strong class="star">*</strong></label><input name="txtdob" type="text" class="datetxtbox"  readonly="readonly"  id="datepicker"/></li>
<li><label> Gender :<strong class="star">*</strong></label>
		<div class="studentgender"><input class="radiobtn" name="rdgender" type="radio" value="M" />Male
        <input class="radiobtn" name="rdgender" type="radio" value="F" />Female</div> </li>

    

 <li>
 
  <label>Photo : </label><input name="flePhoto" id="flePhoto" type="file" class="custom_upload" /></li>
<li>
  <li><label>Alternate Phone Number: </label><input name="txtcontact" type="text" />  </li>     
  <li><label>Special accomplishments (if any)</label><input  tabindex="17" maxlength="100" name="txtSpecqualification"></li>
  <li><label>Other relevant info</label><textarea   style="height: 30px;" tabindex="20" name="txtotherinfo"></textarea> </li>

   <li>
  <label>What code is in the image? :<strong class="star">*</strong></label>
      <input type="text" name="defaultReal" id="selector" maxlength="6" size="6"/>

  <div class="captcha"></div>
</li>
</ul>
<ul>
<li><label>Center :<strong class="star">*</strong> </label><select name="ddlCenter">
  <option value="">Select</option>
   <?php  
 
$coursequery = $wpdb->get_results("SELECT * FROM centremaster where status='Y' ");
foreach ($coursequery as $coursequeries) {
	echo "<option value='{$coursequeries->id}' >{$coursequeries->academy_name}</option>";
}

?>
</select></li>


  <li><label>Address:<strong class="star">*</strong> </label><textarea name="txtAddress" cols="" rows=""></textarea></li>
  <li> <label>City :<strong class="star">*</strong></label><input name="txtCity" type="text" /></li>

<li>
  <label>State :<strong class="star">*</strong></label><input name="txtState" type="text" /></li>


<li>
  <label>Country :<strong class="star">*</strong></label><input name="txtCountry" type="text" /></li>
<li>
  <label>Zip :<strong class="star">*</strong></label><input name="txtZip" type="text" /></li>
  <li><label>Mobile :<strong class="star">*</strong> </label><input name="txtMobile" type="text" /></li>
 <li><label>Email:<strong class="star">*</strong></label><input name="txtEmail" type="text" />  </li>

  <li><label>Experience in Music:<strong class="star">*</strong></label>
 <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExpBha"></li>

  <li><label>Name of your Guru :<strong class="star">*</strong> </label><input  tabindex="18" maxlength="50" name="txtguruname"></li>
 <li><label>Your Guru Located at 	:</label><input  tabindex="19" maxlength="50" name="txtLoca"></li>
<br />
    
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