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
if(isset($_REQUEST['btnCenterApprove']))
{
		$mysql_datetime = date('Y-m-d H:i:s');
		$arrcentre = array('id'=>$centreid,'centreid'=> $_REQUEST['txtCentrecode'],'status'=>'Y');
		// $centremaster -> approveCentre ($arrcentre);
		 // header('location:admin_centre_listing.php');
		  $ackmsg =  $centremaster -> approveCentre ($arrcentre);
		if($ackmsg)
		{
			$_SESSION['ackmsg'] = 'Center approved successfully';
			header("location:admin_centre_listing.php");
		}
		else
		{
			$msg = "Internal error.Try again.";
		}
		
}
?>
<script type="text/javascript" src="../web/validation/centre.validate.js"></script>
<div class="content">
       <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li><a  href="approval_dashboard.html">Approvals</a></li>
        <li class="last"> &nbsp; Centre Approval Confiramtion</li>
      </ul>
    </div>
    <div class="studentViewContent">
       <h2>Centre Approval Confiramtion</h2>
      <div class="registrationForm">
            <div class="registrationFormStudents">
            <form method="post" id="frmCentreApproval" name="frmCentreApproval"   > 
           <ul><li>
           
        <label>Enter Reference Code  : <strong class="star">*</strong> </label>
<input type="text" value="<?php echo $centredetail->fields[centreid]; ?>" name="txtCentrecode" > </li></ul>
       <fieldset class="w100">
        <legend>Academy Details</legend>
      <ul>
      
         
      <li>
        <label>Academy Name:
		<?php echo $centredetail->fields[academy_name]; ?>  </label></li>
        
      <li><label>Email : 
		<?php echo $centredetail->fields[email_id]; ?>  </label> </li>
        
      
         
       <li><label> Website:  <?php if( $centredetail->fields[website] )echo $centredetail->fields[website]; else echo '-'; ?></label>
		  </li>
        
        <li><label> Phone Day Time : <?php echo $centredetail->fields[contact]; ?></label></li>
        
        <li>
           <label>Alternate Phone : <?php if( $centredetail->fields[alternate_contact] )echo $centredetail->fields[alternate_contact]; else echo '-'; ?></label></li>
        <li><label>Year of Establishment : <?php  if( $centredetail->fields[year_of_establishment] )echo $centredetail->fields[year_of_establishment]; else echo '-';   ?></label></li>
     
      </ul>
     
      <ul>
      
<li><label>Address:<?php  if( $centredetail->fields[address] )echo $centredetail->fields[address]; else echo '-'; ?></label></li>
        <li>
		<label> City : <?php echo $centredetail->fields[4]; ?></label></li>
        <li><label>State : <?php echo $centredetail->fields[state]; ?></label></li>
        <li><label>Country:  <?php echo $centredetail->fields[country]; ?></label></li>
        <li><label>Zip: <?php echo $centredetail->fields[zipcode]; ?></label></li>
        <li>
           <label>Number Arangetrams : <?php if( $centredetail->fields[no_of_arangetram] )echo $centredetail->fields[no_of_arangetram]; else echo '-'; ?></label>
		 </li>
         </ul>
      </fieldset>
     
      <fieldset class="w100">
        <legend>Director's Details</legend>
      <ul>
      
         
      <li>
        <label>Director Name : <?php echo $centredetail->fields[director_name]; ?></label></li>
        
      <li><label>Director's D.O.B:  <?php $dob =  split('-',$centredetail->fields[director_dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $directorDOB =date('d-M-Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0]));
		 echo $directorDOB; ?></label>
		</li>
        
      
         
       <li>
         <label>Email :  <?php echo $centredetail->fields[directorEmail_id]; ?> </label></li>
        
        <li>
           <label> Special Qualifications :   <?php  if( $centredetail->fields[special_qualification] )echo $centredetail->fields[special_qualification]; else echo '-'; ?></label></li>

       
      </ul>
     
      <ul>
      
<li><label>Address:  <?php if( $centredetail->fields[directorAdress] )echo $centredetail->fields[directorAdress]; else echo '-'; ?></label></li>
        
        <li><label>State : 
		 <?php echo $centredetail->fields[directorState]; ?> </label> </li>
        <li><label>Country:  <?php echo $centredetail->fields[directorCountry]; ?></label></li>
        <li><label>Zip:  <?php echo $centredetail->fields[directorZipcode]; ?></label></li>
     
      </ul>
      </fieldset>
         
        
        <fieldset class="w100">
        <legend>Bharatanatyam Details </legend>
     <ul>
              <li>
                <label>Experience in Bharathanatyam :<?php if( $centredetail->fields[bharathanatyam_experience] )echo $centredetail->fields[bharathanatyam_experience]; else echo '-'; ?> </label></li>
                     <li>
           <label>Events Performances :<?php if( $centredetail->fields[events_performed] )echo $centredetail->fields[events_performed]; else echo '-'; ?> </label></li>
        <li>
           <label> Awards Titles :<?php if( $centredetail->fields[awards_title] )echo $centredetail->fields[awards_title]; else echo '-'; ?> </label></li>
        <li>
           <label>Ballets Choreographed:<?php if( $centredetail->fields[ballets_choreographed] )echo $centredetail->fields[ballets_choreographed]; else echo '-'; ?></label></li>
         
     </ul>
            <ul>
              <li><label>Name of your Guru :<?php if( $centredetail->fields[name_of_guru] )echo $centredetail->fields[name_of_guru]; else echo '-'; ?> </label></li>
               <li><label>Located at 	:<?php if( $centredetail->fields[guru_location] )echo $centredetail->fields[guru_location]; else echo '-'; ?> </label> </li>
              <li> <label>Other relevant info :<?php if( $centredetail->fields[other_info] )echo $centredetail->fields[other_info]; else echo '-'; ?>  </label> </li>
              <!--<li>
                <label>Special accomplishments (if any) : -</label></li>-->
            </ul>
         <ul>
         
         </ul>
        </fieldset>
        
      </div>
       <ul> <li class="button"><input type="submit" class="backBtn fl" value="Approve" name="btnCenterApprove">      
      <a href="admin_centre_listing.php" class="cancelBtn">Cancel</a> </li>
       </ul>
       </form>
      </div>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>