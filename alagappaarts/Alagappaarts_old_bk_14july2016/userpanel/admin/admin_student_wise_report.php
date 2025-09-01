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
include('adminheader.php');
include("../config/classes/programmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$keywordmaster  = new keywordmaster();
$studentpaymentstatus = $keywordmaster->getkeyword('paymentstatus');
$examresult = $keywordmaster->getkeyword('result');

?>
<script type="text/javascript" src="../web/scripts/report.js"></script>
<div class="content">
    <div class="topNav">
      <ul>
        <li><a href="masters_dashboard.html">dashboard</a></li>
      
        <li class="last"> &nbsp; Reports</li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>Student Reports</h2>
      <div class="searchBox">

      <div class="searchBoxInner">
      <form id = "frmStudentreport" name="frmStudentreport" method="post" action="admin_student_search_result.php" >
<div class="dynamicfields">
<div class="searchBoxInnerStudentTop" >
        <select name="searchContion[]" class="mR10 studentListing" id="studentListing">
       <option  value="First Name" selected="selected" >First Name</option>
          <option value="Last Name">Last Name</option>
           <option value="Program">Program</option>
           <option value="Centre" >Centre</option>
           <option value="Date of Joining" >Date of Joining</option>
           	<option value="Payment Status" >Payment Status</option>
            <option value="Graduation Status" >Graduation Status</option>
          <!--   <option value="Exam Result"> Exam Result</option>-->
        </select>
      <div class="inputSelect" > <input type="text"  name="txtFirstname[]" id="inputBox" title="Enter First Name" class="required"  />
      
       <input type="text"  name="txLasttname[]" id="inputBox2"  style="display:none;" title="Enter Last Name"/>
      <select class="mR10 studentListingnew CertificateList" name="ddlProgram[]"  title="Select Program" >
      <option value="" >Select</option>
        <?php while(!$programname->EOF)
 	{
		if($_SESSION['searchStudent']['se.program_id'] == $programname->fields[id] )
		echo "<option value='{$programname->fields[id]}' selected>{$programname->fields[name]}</option>";
		else 
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>
            </select>
      <select name="ddlCenter[]" class="mR10 studentListingnew centersList" title="Select center">
            <option value="" >Select</option>
                   <?php while(!$centrenames->EOF)
 	{
		if($centrenames->fields[id] ==  $_SESSION['searchStudent']['se.centre_id'])
		echo "<option value='{$centrenames->fields[id]}' selected >{$centrenames->fields[academy_name]}</option>";
		else 
	echo "<option value='{$centrenames->fields[id]}'  >{$centrenames->fields[academy_name]}</option>";
	 $centrenames-> MoveNext();
	} ?>
        </select>
        <select class="mR10 studentListingnew dateDiff" name="ddlDateofjoining[]" >
        <option selected="selected">Between</option>
           <option>After</option>
           <option>Before</option>
           </select>
           <select class="mR10 studentListingnew paymentStatus" name="ddlPaymentstatus[]" title="Select Payment Status">
                 <option value="" >Select</option>
       <?php foreach($studentpaymentstatus as $value)
 	{
		if( $value[value] != 'Processing') {
			if( $value[value] != 'Transaction Failed') {
		if($value[id] == $_SESSION['searchStudent']['sm.status'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
			}
		}
	} ?>
           </select>
           <select class="mR10 studentListingnew graduationStatus" name="ddlGraduationstatus[]" title="Select Graduation Status">
            <option value="" >Select</option>
         <option  value="Y">Graduated</option>
           <option value="N">Non Graduated</option>
           </select>
           <select class="mR10 studentListingnew examResult" name="ddlExamresult[]"  title="Select result">
            <option value="" >Select</option>
          <?php foreach($examresult as $value)
 	{
		if($value[id] == $_SESSION['searchStudent']['sm.status'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
	 
	} ?>
           </select>
           <div class="BetweenDate">
          <div class="fromDate"> <input type="text"  name="txtFromdate[]"  class="w100 datepicker" id="datepicker1" title=""> <span>and</span></div>
            <div class="toDate"><input type="text"  name="txtTodate[]" class="w100 datepicker " id="datepicker2" title="">  </div>
            </div></div>
           
          
        <a  class="deleteSelection"><img src="images/delete-btn.png" alt="" width="20" height="18" /></a></div>
        </div>
       <div class="searchBoxInnerStudent">
        <input name="btnSearch" value="Search" type="submit" class="submitBtn" />
      <span><a class="addFilter">Add Filter</a></span>
     <span><a class="clearAll">Clear All</a></span>
      
        
       
        </div>
        </form>
      </div>
    </div>
      
  </div>
</div>
<?php 
include('adminfooter.php');
}
?>
  

