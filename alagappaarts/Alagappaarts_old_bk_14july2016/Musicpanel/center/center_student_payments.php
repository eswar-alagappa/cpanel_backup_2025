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
define( MAX_NO_OF_ROWS_PAGINATION,20);
include("../config/classes/centremaster.class.php");
include("../config/classes/keywordmaster.class.php");
$pagename='exam_listing';
global $DB;
$centremaster = new centremaster();
$keywordmaster = new keywordmaster;

$paymentstatus = $keywordmaster->getkeyword('paymentstatus');

if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchPaymentdetail']);
}
if($_REQUEST['btnPaymentsearch']){
$arrPayment =array('sm.first_name'=>$_REQUEST['txtName'],'se.enrollment_id'=>$_REQUEST['txtEnrollmentid'],'sp.payment_status_id'=>$_REQUEST['ddlPaymentStatus']);
$_SESSION['searchPaymentdetail'] = $arrPayment;
	
}else {
		$arrPayment = array('sm.first_name'=>$_SESSION['searchPaymentdetail']['sm.first_name'],'se.enrollment_id'=>$_SESSION['searchPaymentdetail']['se.enrollment_id'],
	'sp.payment_status_id'=>$_SESSION['searchPaymentdetail']['sp.payment_status_id']);
}
$getPaymentDetailsquery = $centremaster -> getPaymentDetailonView($userid).$filterObj->applyFilter($arrPayment,$pagename);

$getPaymentDetails = $DB -> execute( $paginationObj->getQuery($getPaymentDetailsquery ." order by sp.id  desc "));

$countofPayment = count($getPaymentDetails -> fields[id]);


static $recordcount=0;
$forcount = $DB->execute($getPaymentDetailsquery);
while(!$forcount->EOF)
{
		$recordcount++;
		$forcount -> MoveNext();
}


/*$centremaster = new centremaster();


$getPaymentDetails = $centremaster -> getPaymentDetailonView($userid);*/


?>
<script type="text/javascript" src="../web/validation/centerpanel.validate.js"></script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  To <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
<div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Payments </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2><span>Payment History</span>
    
      </h2>
     
      <div class="contentInner">
      <div class="searchBox">
<form method="post" id="frmStudentsearch"  >
<div class="searchBoxInner">
<label>Search By ID :</label>
<input type="text"  class="required_group" name="txtEnrollmentid" value="<?php  if($_SESSION['searchPaymentdetail']['se.enrollment_id']) echo  $_SESSION['searchPaymentdetail']['se.enrollment_id']; ?>" />
  <label> First  Name :</label>
 <input type="text" class="required_group" name="txtName" value="<?php  if($_SESSION['searchPaymentdetail']['sm.first_name']) echo  $_SESSION['searchPaymentdetail']['sm.first_name']; ?>" />   
 </div>
  <div class="searchBoxInner">
  <label>Payment Status:</label>
   <select class="mR10 studentListing required_group" name="ddlPaymentStatus">
      <option value="">Select</option>
<?php foreach($paymentstatus as $value)
 	{
		if( $value[id] == 8 ||$value[id] == 9 ){
		if($value[id] == $_SESSION['searchPaymentdetail']['sp.payment_status_id'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
		}
	 
	} ?>
    </select>
          <input name="btnPaymentsearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchPaymentdetail']))
		{
			echo ' <input name="btnViewAll" value="View All Payments" type="submit" class="viewAll" />';
		}
		 ?>
        </div>
        <div class="errorContainer" ></div>
       </form>
        </div>
       <?php if($countofPayment) {?>
      <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
              <th>Student Name</th>
                <th>Program Enrolled</th>
                <th> Payment Option	</th>
                <th>  Date of Payment</th>
                 <th> Amount paid ($)</th>
                 <th>Payment mode</th>
                 <th>Status</th>
              </tr>
             <?php  foreach  ($getPaymentDetails as $getPaymentDetail)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				     <td> {$getPaymentDetail[first_name]} {$getPaymentDetail[last_name]}  </td>
                <td>{$getPaymentDetail[name]}</td>
                <td> {$getPaymentDetail[paymentoption]}  </td>
                <td>{$getPaymentDetail[paid_on]} </td>";
               echo "<td>";
			      echo $getPaymentDetail[amount];
			   echo "</td>";
			   echo "<td>";
			   echo "{$getPaymentDetail[paymentmode]}";
			   echo "</td><td>{$getPaymentDetail[paymentstatus]}";
			   echo "</td>	 
              </tr>";
				  $i++;
 				 }?>
            
            </tbody>
          </table>
           <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getPaymentDetailsquery ); ?></ul></div>
      </div>
     
    
           <?php   }else{ echo "<div class='warning'> NO PAYMENTS MADE.  </div>" ;}  ?>
          </div>
       
      <div>
        
      </div>
           
    </div>
  </div>
<?php 
include('studentfooter.php');
}
?>