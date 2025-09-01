<?php
/*
Template Name:student register
*/

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

if (rpHash($_POST['defaultReal']) == $_POST['defaultRealHash']) {
	global  $wpdb;
	
			
$studentStatusSQL = $wpdb->get_results("select id from keywordmaster where code='studentstatus' and value ='Waiting for Approval'");
$studentpaymentstatus = $wpdb->get_results("select id from keywordmaster where code='paymentstatus' and value ='Pending'");
$attName = $_FILES["flePhoto"]["name"];
$mysql_datetime = date('Y-m-d H:i:s');
$studentDOB =date('Y-m-d', strtotime($_REQUEST['txtdob']));
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
		
		$checkstudentEmailID = $wpdb->get_results("select email_id from studentmaster where  email_id = '{$email_id}'");
	
		$count = count($checkstudentEmailID);
		if($count){
			$errormsg = "You are already Registered";
		}
		else{
                    
			$wpinsertquery=$wpdb->query($studentmastersql);
			$getLastinsertedId = $wpdb->get_results("select max(id) as id from studentmaster where email_id='{$email_id}'");
			$lasid= $getLastinsertedId[0]->id;
			$centre_id=$_REQUEST['ddlCenter'];
			$getLastEnrollmentidquery = "select seid.end_index as id  , cm.centreid as  centre_code from  
			centremaster cm join student_enrollmentid  seid on cm.id = seid.centre_id  where seid.centre_id ='$centre_id'";
			$getLastEnrollmentid = $wpdb->get_results($getLastEnrollmentidquery);
			$Enrollmentid= $getLastEnrollmentid[0]->id;
			
			$last_index =  $Enrollmentid + 1;
			$updaterenrollmentid ="update student_enrollmentid set end_index = '{$last_index}' where  centre_id = '$centre_id' ";
			$wpdb->query($updaterenrollmentid);
			$studentenrollmentid =  $getLastEnrollmentid[0]->centre_code.$last_index;
		
			$student_id= $lasid;
			$program_id=$_REQUEST['ddlProgram'];
			
			$payment_status_id=$studentpaymentstatus[0]->id;
			$graduation_status='N';
			$cc_issued='N';
			$studentdeducationsql="INSERT INTO student_education (student_id,program_id,centre_id,enrollment_id,payment_status_id,graduation_status,cc_issued) 
			VALUES('$student_id','$program_id','$centre_id','$studentenrollmentid','$payment_status_id','$graduation_status','$cc_issued')";
			$studenteducationinsert=$wpdb->query($studentdeducationsql);
			$my_file =$_FILES['flePhoto']['name'];
                        $target_path = "C:/xampp/htdocs/apaa/userpanel/uploads/student/";
			
			$target_paths = $target_path . basename( $_FILES['flePhoto']['name']); 
			if($_FILES['flePhoto']['name'] ) move_uploaded_file($_FILES['flePhoto']['tmp_name'], $target_paths) ;
			if($wpinsertquery)
			{
				$mailto=$email_id;
				$name=$firstname;
				$my_subject = "Successful Registeration of your Admission Form";
				$my_message = " You have been registering succesfully. Our Consultants will contact you soon. Thank You For your Registeration!";
				$header = "From: info@alagappaarts.com \r\n";
				$header .= "Reply-To: info@alagappaarts.com \r\n";
				$header .= 'MIME-Version: 1.0' . "\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					wp_mail($mailto, $my_subject, $my_message,  $header);
					 $msg ="Thanks for your Registration";
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

<div class="danceInnerContent">
        
 <?php get_sidebar();
 echo $q=$_SERVER['REQUEST_URL'];
 
  ?>       
        
<div class="danceInnerContentRight">
<div class="danceBanner">
<h2><span><?php the_title(); ?></span></h2>
</div>

    
<div class="apaaContent">


<div class="fr mB10">
<a href="<?php bloginfo('wpurl'); ?>/wp-content/themes/dance/images/application_form-dance.pdf" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/download-btn.gif" width="270" height="30" /></a>
</div>

   <div class="registerFormOuter">
<div class="fl"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-left.png" width="5" height="44" /></div><div class="registerFormTitle">To Get School Admissions, Please fill in the form given below.</div><div class="fr"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/register-title-bg-right.png" width="5" height="44" /></div>
<div class="registerForm">
<center><span class="studentregCorrect"><?php if( $msg) echo $msg ; ?></span></center>
<center><span class="studentregError"><?php if($errormsg ) echo $errormsg ;?></span></center>
 <form id="studentForm"  method="post"  enctype="multipart/form-data">
<ul>
<li><label>Program :<strong class="star"> *</strong></label><select name="ddlProgram">
  <option value="">Select</option>
  <?php global  $wpdb;
$myquery = $wpdb->get_results("SELECT * FROM programmaster where status='Y' ");
foreach ($myquery as $queries) {
	echo "<option value='{$queries->id}' >{$queries->name}</option>";
}

?>
 </select></li>
 <li>
  <label>First Name <strong class="star"> *</strong>:</label><input name="txtFname" type="text" /></li>
<li>
<li>
  <label>Last Name : </label><input name="txtLname" type="text" /></li>
<li>
<li>
  <label>Age <strong class="star"> *</strong>:</label>
  <input name="txtAge" type="text" /></li>
<li class="studentdate"><label>D.O.B <strong class="star"> *</strong>: </label><input name="txtdob" type="text" class="datetxtbox"  id="datepicker"/></li>
<li><label> Gender <strong class="star">*</strong>:</label>
		<div class="studentgender"><input class="radiobtn" name="rdgender" type="radio" value="M" />Male
        <input class="radiobtn" name="rdgender" type="radio" value="F" />Female</div> </li>

    

 <li>
 
  <label>Photo : </label><input name="flePhoto" id="flePhoto" type="file" class="custom_upload" /></li>
<li>
  <li><label>Alternate Phone Number: </label><input name="txtcontact" type="text" />  </li>     
  <li><label>Special accomplishments (if any)</label><input  tabindex="17" maxlength="100" name="txtSpecqualification"></li>
  <li><label>Other relevant info</label><textarea   style="height: 30px;" tabindex="20" name="txtotherinfo"></textarea> </li>

   <li>
  <label>What code is in the image? <strong class="star"> *</strong>:</label>
      <input type="text" name="defaultReal" id="selector" maxlength="6" size="6"/>

  <div class="captcha"></div>
</li>
</ul>
<ul>
<li><label>Center <strong class="star"> *</strong>: </label><select name="ddlCenter">
  <option value="">Select</option>
   <?php global  $wpdb;
$coursequery = $wpdb->get_results("SELECT * FROM centremaster where status='Y' ");
foreach ($coursequery as $coursequeries) {
	echo "<option value='{$coursequeries->id}' >{$coursequeries->academy_name}</option>";
}

?>
</select></li>


  <li><label>Address <strong class="star"> *</strong>: </label><textarea name="txtAddress" cols="" rows=""></textarea></li>
  <li> <label>City <strong class="star"> *</strong>:</label><input name="txtCity" type="text" /></li>

<li>
  <label>State <strong class="star"> *</strong>:</label><input name="txtState" type="text" /></li>


<li>
  <label>Country <strong class="star"> *</strong>:</label><input name="txtCountry" type="text" /></li>
<li>
  <label>Zip <strong class="star"> *</strong>:</label><input name="txtZip" type="text" /></li>
  <li><label>Mobile :<strong class="star"> *</strong> </label><input name="txtMobile" type="text" /></li>
 <li><label>Email:<strong class="star">*</strong></label><input name="txtEmail" type="text" />  </li>

  <li><label>Experience in Bharathanatyam <strong class="star">*</strong>:</label>
 <input class="frm_element" id="txtExpBha" tabindex="16" maxlength="20" name="txtExpBha"></li>

  <li><label>Name of your Guru <strong class="star">*</strong>: </label><input  tabindex="18" maxlength="50" name="txtguruname"></li>
 <li><label>Your Guru Located at 	:</label><input  tabindex="19" maxlength="50" name="txtLoca"></li>
<br />
    
</ul>
<div class="registerBtn"><input name="btnStudentreg" type="submit" class="registerBtn" value="Register" id="submit"/></div>

</form>
	
</div>

  </div>
  
  
</div>
</div>
</div>
</div>


<?php get_footer(); ?>
