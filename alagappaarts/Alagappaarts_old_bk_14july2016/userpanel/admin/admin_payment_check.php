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
include("../config/classes/programmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/paymentmaster.class.php");
include("../config/classes/centremaster.class.php");
include('adminheader.php');
$programmaster  = new programmaster();
$centremaster  = new centremaster();
$paymentmaster = new paymentmaster();
define( MAX_NO_OF_ROWS_PAGINATION,20);


$programname = $programmaster->getProgramname();
$centrenames = $centremaster->getcentrenames();
$pagename='check_payment';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchPayment']);
}
if($_REQUEST['btnPaymentsearch']){
$arrPayment =array('se.enrollment_id'=>$_REQUEST['txtName'],'se.program_id'=>$_REQUEST['ddlProgram'],'se.centre_id'=>$_REQUEST['ddlCenter']);
$_SESSION['searchPayment'] = $arrPayment;
header('location:admin_payment_check.php');
}else{
		$arrPayment = array('se.enrollment_id'=>$_SESSION['searchPayment']['se.enrollment_id'],'se.program_id'=>$_SESSION['searchPayment']['se.program_id'],
	'se.centre_id'=>$_SESSION['searchPayment']['se.centre_id']);
}
$paymentDetails = $paymentmaster -> listPaymentPendingStudents();
$paymentDetails =$paymentDetails.$filterObj->applyFilter($arrPayment,$pagename);
$listPaymentDetails = $DB -> execute( $paginationObj->getQuery($paymentDetails));

$countofPayments = count($listPaymentDetails -> fields[id]);
static $recordcount=0;
	$forcount = $DB->execute($paymentDetails);
	while(!$forcount->EOF)
	{
		$recordcount++;
		$forcount -> MoveNext();
	}

?>
<script type="text/javascript" src="../web/validation/payment.validate.js"></script>
<div class="content">
    <div class="topNav">
      <ul>
         <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li><a  href="approval_dashboard.html">Approvals</a></li>
        <li class="last"> &nbsp; Payment Approvals</li>
      </ul>
    </div>
    <div class="studentViewContent">
     <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
      <h2><span>Pending payments</span>
     
      </h2>
      <div class="searchBox">
<form method="post" id="frmPaymentsearch"  >
<div class="searchBoxInner">


        <label>Search By ID :</label>
        <input type="text"    class="required_group" name="txtName" value="<?php  if($_SESSION['searchPayment']['se.enrollment_id']) echo  $_SESSION['searchPayment']['se.enrollment_id']; ?>" />
      
       </div>
       <div class="searchBoxInner">
	   <label>Program :</label>
       <select class="studentListing required_group" name="ddlProgram">
      <option value="">Select</option>
<?php while(!$programname->EOF)
 	{
		if($_SESSION['searchPayment']['se.program_id'] == $programname->fields[id] )
		echo "<option value='{$programname->fields[id]}' selected>{$programname->fields[name]}</option>";
		else 
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>
    </select>
        <label class="statusTxt">Center :</label>
        <select class="studentListing required_group" name="ddlCenter">
<option  value="">Select</option>

 <?php while(!$centrenames->EOF)
 	{
		if($centrenames->fields[id] ==  $_SESSION['searchPayment']['se.centre_id'])
		echo "<option value='{$centrenames->fields[id]}' selected >{$centrenames->fields[academy_name]}</option>";
		else 
	echo "<option value='{$centrenames->fields[id]}'  >{$centrenames->fields[academy_name]}</option>";
	 $centrenames-> MoveNext();
	} ?>
</select> 
        <input name="btnPaymentsearch" value="go" type="submit" class="goBtn" />
     
        </div>
        <div class="errorContainer" ></div>
       </form>
       <form method="post" id="frmviewallPayment"  >
           <?php if(isset($_SESSION['searchPayment']))
		{
			echo ' <input name="btnViewAll" value="View All Students" type="submit" class="viewAll" />';
		}
		 ?>
         </form>
        </div>
     <?php if($countofPayments)
		{ ?>
       
      <div class="studentList">
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                    <th> Student ID</th>
                <th> Student Name</th>
                <th> Program Enrolled</th>
                <th> Date of Joining </th>
                <th>Program Fee</th>
                <th> Amount Paid($)</th>
                <th>Outstanding Amount($)</th>
                <th width="75"> Actions</th>
              </tr> 
              <?php  foreach  ($listPaymentDetails as $listPaymentDetail)
 				{
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				     <td>{$listPaymentDetail[enrollment_id]}</td> 
				   <td>{$listPaymentDetail[studentname]} {$listPaymentDetail[studentlastname]}</td> 
                <td>{$listPaymentDetail[programname]}</td> 
				   <td>{$listPaymentDetail[doj]} </td> 
				   <td>{$listPaymentDetail[total_fee]} </td>";
				   
               echo  "<td>";
			   if(!$listPaymentDetail[paid_amount])
			   echo '-';
			   else
			    echo $listPaymentDetail[paid_amount];  
				
				echo "</td>";
				echo "<td>";
					$outstanding_amount = $listPaymentDetail[total_fee] - $listPaymentDetail[paid_amount];
            echo "{$outstanding_amount}";
			echo "</td>";
					
			   
			     echo "<td><a href='admin_payment_check_add.php?studentid={$listPaymentDetail[id]}&program_id={$listPaymentDetail[program_id]}'><img src='../web/images/cheque-payment.png' width='20' height='18' title='Make check payment'/></a> ";
				 echo "<a href='admin_payment_paypal_add.php?studentid={$listPaymentDetail[id]}&program_id={$listPaymentDetail[program_id]}'><img src='../web/images/paypal-icon.png' width='20' height='18' title='Make paypal payment'/></a> ";
			   echo "</td>	 
              </tr>";
				  $i++;
 				 }?>
              
             
            </tbody>
          </table>
        </div>
      </div>
   <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $paymentDetails ); ?></ul></div>
      </div>
     
      <?php  }	else{
			echo "<div class='adminError'>No Results Found</div>";}?>
    </div>
  </div>

<?php
include('adminfooter.php');
}
?>