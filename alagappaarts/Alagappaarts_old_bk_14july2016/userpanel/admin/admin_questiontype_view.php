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
include("../config/classes/questiontypemaster.class.php");
include('adminheader.php');
$questiontypeid = $_GET[ questiontypeid ];
$questiontypemaster  = new questiontypemaster();
$questiontypedetail = $questiontypemaster -> getquestiontypedetail($questiontypeid);

?>

<div class="content">
    <div class="topNav">
      <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
        <li class="first">Online Exam </li>
            <li><a href="question_types_listing.html">Question Types</a></li>
        <li class="last"> &nbsp; View Question Type</a></li>
      </ul>
    </div>
    <div class="studentViewContent">
      <h2>View Question Type </h2>
      <div class="addProgramForm editquestion">
      <ul class="w90p">
     <li>
        <label>Name : </label>
		<span><?php echo  $questiontypedetail->fields[name]; ?></span> </li>
      <li>
        <label>Description : </label>
        <span><?php echo  $questiontypedetail->fields[description]; ?> </span>  </li> 
        <!--<fieldset>
          <legend>Course Details</legend>
          
         <table class="questionDetails" width="100%" border="0">
            <tr>
              <th width="21%" align="left" scope="col">
                Certificate      <label for="checkbox"></label></th>
              <th width="18%" align="left" scope="col"><label for="checkbox">Associate degree</label></th>
              <th width="17%" align="left" scope="col"><label for="checkbox">Diploma</label></th>
              <th width="24%" align="left" scope="col"><label for="checkbox">Bachelor degree</label></th>
              </tr>
            <tr> <td>
              <label>
              CEB 01 &amp; CEB P1</label>
              <br /><br />
              </p></td> <td><label>
                ADB 02 &amp; ADB P2</label>
                <br />
                <label>
                ADB P3</label><br />
                </p></td> <td>
                  <label>
                DIB 01 &amp; DIB P1</label>
                  <br />
                  <label>
                DIB 02 &amp; DIB P2</label>
                  <br /></td>
              <td><label>
                BSB A1</label>
                <br />
                <label>
                BSB 02 &amp; BSB P2</label>
                <br />
                BSB A2<br />
                </p></td> 
              </tr>
            
  </table>
          
          
          
        </fieldset>-->
      </ul>
      <ul class="addquestion">
      <li>
          <label>Marks Per Question : </label>
        <span> <?php echo  $questiontypedetail->fields[marks_per_question]; ?></span></li>
        <li>
        <label>Status : </label>
         <span> <?php if( $questiontypedetail->fields[status] == 'Y' ) echo 'Active'; else   echo 'Inactive';?></span>
		</li>
        <li class="btn"><a href="admin_questiontype_listing.php" class="saveBtn">Back</a>
        <!--<li class="btn"><a href="question_types_listing.html"><input name="" value="Back" type="submit" class="saveBtn" /></a></li>-->
      
      </ul>
      </div>
    </div>
  </div>
<?php 
include('adminfooter.php');
}
?>