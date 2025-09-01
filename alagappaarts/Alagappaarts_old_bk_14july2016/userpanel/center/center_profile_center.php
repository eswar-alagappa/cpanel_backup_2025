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
include('centerheader.php');
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
$studentmaster = new studentmaster();
$centremaster = new centremaster();
$centreid = $userid;
$centremaster  = new centremaster();
$centredetail = $centremaster -> getcentredetails($centreid);
/*echo "<pre>";
print_r($centredetail );*/
?><div class="headerBottom">

      <div class="admiTitle">Welcome To  <?php  echo $username; ?></div>
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
      <h2><span>Center's Profile</span> 
       <div class="profileRightBtn">
       <ul>
      <li class="edit"><a href="center_profile_edit.php">Edit Profile</a></li>
       <li class="changePassword"><a href="center_change_password.php">Change password</a></li>
       </ul>
       </div>
      </h2>
      
      <?php if(isset($_SESSION['ackmsg']))
		{
		echo '<center><div class="success">'.$_SESSION['ackmsg'].'</div></center>';
		unset($_SESSION['ackmsg']);
		
		}
		?>

       <div class="contentInner">
       <div class="profileContent">
       <?php //echo "<pre>"; print_r( $centredetail);?>
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="500" scope="col">Centre Profile</th>
    <th width="500" scope="col">Director Profile</th>
  </tr>
  <tr>
    <td>
     <span >RefCode</span>		:<?php echo $centredetail->fields[centreid]; ?>    <br />
      <span>Academy Name: </span>
	<?php echo $centredetail->fields[academy_name]; ?>  <br/>
   
      <span>Address	</span>	:    <?php echo $centredetail->fields[3]; ?> <br />
     <span> City</span>		: <?php echo $centredetail->fields[4]; ?><br />
     <span> State</span>		: <?php echo $centredetail->fields[5]; ?><br />
     <span> Zip code</span>		: <?php echo $centredetail->fields[7]; ?><br />
     <span> Country	</span>	: <?php echo $centredetail->fields[6]; ?><br />
      <span> Phone Day Time : </span><?php echo $centredetail->fields[contact]; ?><br/>
<span>  Alternate Phone :	</span>	:  <?php if( $centredetail->fields[alternate_contact] )echo $centredetail->fields[alternate_contact]; else echo '-'; ?><br />
  <span>Email :  </span>
	<?php echo $centredetail->fields[centreEmail_id]; ?> <br/>
      <span> Website: </span> <?php if( $centredetail->fields[website] )echo $centredetail->fields[website]; else echo '-'; ?><br/>
       <span>Year of Establishment	</span>		: <?php  if( $centredetail->fields[year_of_establishment] )echo $centredetail->fields[year_of_establishment]; else echo '-';   ?><br />
        <span>Number Arangetrams	</span>		: <?php  if( $centredetail->fields[no_of_arangetram] )echo $centredetail->fields[no_of_arangetram]; else echo '-';   ?><br />

	
    
     </td>
    <td>
         
     <span>Director Name :</span> <?php echo $centredetail->fields[director_name]; ?><br />
        
      <span>Director's D.O.B: </span>  <?php $dob =  split('-',$centredetail->fields[director_dob]); 
	$dob[1].'/'.$dob[2].'/'.$dob[0];
	 $directorDOB =date('d-M-Y', strtotime($dob[1].'/'.$dob[2].'/'.$dob[0]));
		 echo $directorDOB; ?><br />
        
      
         
       <span>Email : </span>  <?php echo $centredetail->fields[directorEmail_id]; ?> <br />
        <span  style="width:160px">Special Qualifications : </span>   <?php  if( $centredetail->fields[special_qualification] )echo $centredetail->fields[special_qualification]; else echo '-'; ?><br />

      
 <span>Address: </span>   <?php if( $centredetail->fields[directorAdress] )echo $centredetail->fields[directorAdress]; else echo '-'; ?><br />
        
       <span>State : </span>   
		 <?php echo $centredetail->fields[directorState]; ?> <br />
               <span>Country: </span>    <?php echo $centredetail->fields[directorCountry]; ?><br />
               <span>Zip: </span>    <?php echo $centredetail->fields[directorZipcode]; ?><br />
    
    <span  style="width:240px">   Experience in Bharathanatyam :</span>   <?php if( $centredetail->fields[bharathanatyam_experience] )echo $centredetail->fields[bharathanatyam_experience]; else echo '-'; ?> <br/>
                  
             <span>Events Performances :</span> <?php if( $centredetail->fields[events_performed] )echo $centredetail->fields[events_performed]; else echo '-'; ?> <br/>
          <span>Awards Titles :</span> <?php if( $centredetail->fields[awards_title] )echo $centredetail->fields[awards_title]; else echo '-'; ?><br/>
         <span style="width:160px">Ballets Choreographed:</span> <?php if( $centredetail->fields[ballets_choreographed] )echo $centredetail->fields[ballets_choreographed]; else echo '-'; ?><br/>
         
       <span>Name of your Guru :</span> <?php if( $centredetail->fields[name_of_guru] )echo $centredetail->fields[name_of_guru]; else echo '-'; ?><br/>
                <span>Located at 	:</span> <?php if( $centredetail->fields[guru_location] )echo $centredetail->fields[guru_location]; else echo '-'; ?><br/>
               <span> Other relevant info :</span> <?php if( $centredetail->fields[other_info] )echo $centredetail->fields[other_info]; else echo '-'; ?> <br/>
    </td>
  </tr>
</table>
</div>
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