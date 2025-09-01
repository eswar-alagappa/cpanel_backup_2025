<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
if(!$student)
{
	header('location:index.php?msg=Enter username password');
}
else{
include('studentheader.php');
include("../config/classes/studentmaster.class.php");
include("../config/classes/exammaster.class.php");
$exammaster = new exammaster();

include('adminheader.php');
global $DB;

$rsExamResult = $exammaster -> getExamResult($userid);
$studentExternal = $exammaster -> getExternalresult($userid);
?>
  
    <div class="headerBottom">
      <div class="admiTitle">Welcome <?php echo $_SESSION[studentinfo][first_name]; ?></div>
      <div class="menuBottom">
       <ul>
        <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class="dashboardIconinacive"><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="student_profile_students.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Log out</a></li>
        </ul>
      </div>
      
    </div>
<div class=" wrapper">
  <div class="content">
    <div class="topNav">
      <ul>
      <li><a  href="dashboard.php">dashboard</a></li>
        <li class="last"> &nbsp; Exam Results </li>
        
       
      </ul>
    </div>
    <div class="contentOuter">
      <h2>Exam Results</h2>
    
      <div class="contentInner">
 
       <?php if($rsExamResult )
		{ ?> 
      <table class="w700" cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Course </th>
                 <th>Regulation </th>
                <th>Exam Date </th>
                <th> Mark Obtained</th>
                <th> Result</th>
                <th> Grade</th>
              </tr>
               <?php 
   $i =0;
  foreach ($rsExamResult  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
                <td>{$result[code]}</td><td>{$result[regulation]}</td>
              <td>{$result[examdate]}</td>
				 <td> {$result[total_mark]}  </td>
				   <td> {$result[result]}  </td>
                <td>{$result[grade]} </td></tr>";
	 $i++; } ?>
       <?php 
   $i =0;
  foreach ($studentExternal  as $result){
	 if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				  
                <td>{$result[code]}</td>
              <td>{$result[regulation]}</td>
			  <td>{$result[examdate]}</td>
				 <td> {$result[mark]}</td>
				   <td> {$result[result]}</td>
                <td>{$result[grade]} </td></tr>";
	 $i++; } ?>
            </tbody>
          </table>
     
  
      
        <?php  }
		else{
			echo "<div class='information'>Exam not taken / Result not published. </span></div>";}?>
             </div>
            
         
    </div>
  </div>

</div>

<?php 
include('studentfooter.php');
}
?>