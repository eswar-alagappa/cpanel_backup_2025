<?php
include("../config/config.inc.php");
include("../config/classes/messagemaster.class.php");
if(isset($_GET['id'])){
$messageMaster  = new messagemaster();
$arrStudent = array('id'=>$_GET['id']);
//print_r($arrStudent);
//$placeofCentre = $messageMaster->getCentre();
$centrename = $messageMaster->getCentrename();
$centredetailonchange = $messageMaster -> getstudent($arrStudent );
/*echo "<pre>";
print_r($centredetailonchange);*/
 ?>

<?php 
echo "<fieldset>
 <legend>Student</legend>";
$centredetailonchange = $messageMaster -> getstudent($arrStudent );
$countCentre = count($centredetailonchange);
if($countCentre){
echo  "<ul class='studentSelectAll'><li><label><input type='checkbox' name='' title='studentchk' class='studentselectall' /><strong>Select All</strong></label></li></ul>";
foreach($centredetailonchange as $centredetailonchangelist)
{
echo "<ul class='student'>";
echo "<li><label><input type='checkbox' name='student[]' class='studentchk' title='studentchk'  value='{$centredetailonchangelist[0]}'/>{$centredetailonchangelist[first_name]}</label></li>";
echo "</ul>";
}
  echo "</fieldset>";
}
 }
?>

 
