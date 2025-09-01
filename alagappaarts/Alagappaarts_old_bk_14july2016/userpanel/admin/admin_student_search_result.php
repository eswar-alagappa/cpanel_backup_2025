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
include("../config/classes/centremaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/keywordmaster.class.php");
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('adminheader.php');
global $DB;
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getkeyword('studentstatus');
$studentpaymentstatus = $keywordmaster->getkeyword('paymentstatus');
$pagename='student_report';
if(isset($_REQUEST['btnSearch'])){
/*echo  "<pre>";
print_r($_REQUEST);*/

$_SESSION['StudentWiseReport']=  $_REQUEST; 
$arrStudentreport =  $_REQUEST;
}
else {
	$arrStudentreport  = $_SESSION['StudentWiseReport'];
	}
/*if($_REQUEST['btnStudentsearch']){
$arrStudent =array('sm.first_name'=>$_REQUEST['txtName'],'sm.status'=>$_REQUEST['ddlStatus'],'se.program_id'=>$_REQUEST['ddlProgram'],'se.centre_id'=>$_REQUEST['ddlCenter']);
$_SESSION['searchStudent'] = $arrStudent;
	header('location:admin_student_listing.php');
}else if($_REQUEST['letter']){
	unset($_SESSION['searchStudent']);
	
	if(  $_REQUEST['letter'] != "ALL")
	$arrStudent =array('sm.first_nameonalpha'=>$_REQUEST['letter']);
}else{
		$arrStudent = array('sm.first_name'=>$_SESSION['searchStudent']['sm.first_name'],'sm.status'=>$_SESSION['searchStudent']['sm.status'],
	'se.program_id'=>$_SESSION['searchStudent']['se.program_id'],'se.centre_id'=>$_SESSION['searchStudent']['se.centre_id']);
}*/
$studentmaster  = new studentmaster();

$getStudents = $studentmaster -> getStudentsonrpoet($arrStudentreport  ).$filterObj->applyFilter($arrStudentreport,$pagename);

//echo  $getStudents;
$rsStudents = $DB -> execute( $paginationObj->getQuery($getStudents ." order by se.student_id  desc"));

$countofStudents = count($rsStudents -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getStudents);
//print_r($forcount[blobSize]);
//echo $forcount->fields[EnrollmentID];
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}
if( isset ($_POST['btnDownload'])){
error_reporting(E_ALL);
include_once ('Classes/PHPExcel.php');
include_once ('Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=Studentlist.xlsx"); 
header("Content-Transfer-Encoding: binary ");


// Set properties
//echo date('H:i:s') . " Set properties\n";

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
	
						 
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);



$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12)->setBold(true) ->getColor()->setRGB('121212');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:N1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:AL1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(12)->setBold(true) ->getColor()->setRGB('F0FFFF');
$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->applyFromArray(
array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '45a1d2')
        )
    )
);	


$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueExplicit('A1', 'Student list');
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueExplicit('A2', 'S.No');	
$objPHPExcel->setActiveSheetIndex(0)
   			->setCellValueExplicit('B2', 'Student ID');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C2', 'Student name');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D2', 'Student Email ID');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E2', 'Status');
																										
	
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

$col = 0;
$row = 3;
$sno=1;


	
while(!$rsStudents->EOF)
{
$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
		
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $sno);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $rsStudents->fields[EnrollmentID]);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $rsStudents->fields[FirstName]." ".$rsStudents->fields[LastName]);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $rsStudents->fields[EmailID]);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $rsStudents->fields[Status]);
		
$row++;
	$sno++;		
 $rsStudents-> MoveNext();

}

 $objPHPExcel->getActiveSheet()->getStyle('A2:E'.($row-1))->applyFromArray(array(
            'borders' => array(
                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,
                               )
            )
        ));




$objPHPExcel->getActiveSheet()->setTitle('Student List');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
	
    $objWriter->save('php://output');
	
    $objPHPExcel->disconnectWorksheets();
    unset($objPHPExcel);
	
}
if( isset ($_POST['btnDownloadword'])){
include_once('../config/libs/adodb/toexport.inc.php');
include_once('../config/libs/adodb/adodb.inc.php');
$path = "../downloads/report.doc";
$forcount->MoveFirst();
$fp = fopen($path, "w");
if ($fp) { 
 rs2csvfile($forcount, $fp); # write to file (there is also an rs2tabfile function)
 fclose($fp);
}
header('location:../downloads/report.doc');
}

?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<div class="content">
<div class="topNav">
     <ul>
        <li><a  href="masters_dashboard.html">dashboard</a></li>
         <li class="first">Masters</li>
        <li class="last"> &nbsp; students</li>
        
      </ul>
    
    </div>
    <div class="studentViewContent">
     <h2><span>Student Reports</span>
      <?php if($countofStudents)
		{ ?>
        <div class="downloadbtn">
        <span>
         <form id="form" method="post">
		<input name="btnDownload" class="exceldownloadBtn"  value="" type="submit" ></form>  </span>
         <!--<span> <form id="form" method="post">
		<input name="btnDownloadword" class="worddownloadBtn"  value="" type="submit" ></form> </span>-->
      </div>
<!--<span class="downloadWordOuter"><a class="submitBtn" href="students_report.doc.docx">Download as Word File</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span>     
<span class="downloadExcelOuter"><a class="submitBtn" href="students_report.xls">Download as Excel File</a><img src="../web/images/add-right-bg.png" width="7" height="24" /></span> -->
<?php }?>
</h2>


  
  
    <div class="viewby">
    
    <fieldset>
        <legend>Search Result For </legend>
<?php 
echo "<ul>";
foreach ($arrStudentreport['searchContion']  as $key  => $value ){
	echo "<li>";
	echo "<label > {$value }</label>";
	
	switch($value)
	{
			case 'First Name':
 					echo  "<label >".$arrStudentreport[txtFirstname][$key]."</label >";
 					break;
			case 'Last Name':
 					echo  "<label >".$arrStudentreport[txLasttname][$key]."</label >";
 					break;
			case 'Program':
					 $excuteProgramname = $programmaster->getProgramname($arrStudentreport[ddlProgram][$key]);
					 echo "<label >".$excuteProgramname->fields[name]."</label >";
					break;
			case 'Centre':
					 $excuteCentrename = $centremaster->getcentredetails($arrStudentreport[ddlCenter][$key]);
					 echo "<label >".$excuteCentrename->fields[academy_name]."</label >";
					break;
			case 'Graduation Status':
						 
						 if($arrStudentreport[ddlGraduationstatus][$key] = Y)
					 echo "<label > Graduated </label >";
					 else  echo "<label > Non Graduated</label >";
					break;		
			case 'Payment Status':
				 foreach($studentpaymentstatus as $value)
					{
						
						if($value[id] == $arrStudentreport['ddlPaymentstatus'][$key])
						 echo "<label >".$value [value]."</label >";
					 
					}
				break;
			case 'Date of Joining':
				$fromDate =date('Y-m-d', strtotime($arrStudentreport[txtFromdate][$key]));
				$toDate = date('Y-m-d', strtotime($arrStudentreport[txtTodate][$key]));	
				switch($arrStudentreport[ddlDateofjoining][$key])
				{
					case 'Between':
					 echo "<label >Between </label > <label>{$fromDate} and {$toDate}</label>";
						break;
					case 'After':
						echo "<label >After </label >  {$toDate}</label>";
						break;
					case 'Before':
						echo "<label >Before </label >  {$toDate}</label>";
						break;
					}
					break;	
			default : 
				break;	
		}
		echo "</li>";
  }
  echo "<li> <a href='admin_student_wise_report.php' class ='newSearch'><img src='../web/images/new-search.png' /></a> </li>";
  echo "</ul>";

?>
  
</fieldset>

</div>
      <div class="studentList">
        
       
        <?php if($countofStudents)
		{ ?>
   	
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Student Id </th>
                <th> Student Name</th>
                <th> Student Email ID</th>
                 <!--<th> Program Enrolled</th>-->
                <th> Status</th>
                 <th > Actions</th>
              
              </tr>
               <?php  
			  $i =0;
			  while(!$rsStudents->EOF)
 				{
			if($i % 2) 	$classname="altRows";
					else $classname="";
			echo "
				  <tr class='{$classname}'>
				   <td>{$rsStudents->fields[EnrollmentID]}</td>
             <td> {$rsStudents->fields[FirstName]} {$rsStudents->fields[LastName]}  </td>
              <td>{$rsStudents->fields[EmailID]} </td>";
			//$excuteProgramname = $programmaster->getProgramname($rsStudents[ddlProgram][$key]);
					// echo "<label >".$excuteProgramname->fields[name]."</label >";
			//echo "<td>{$rsStudents->fields[programname]}";
			echo "<td>{$rsStudents->fields[Status]}";
			echo "</td>";
			echo "<td><a href='admin_student_report_view.php?studentid={$rsStudents->fields[student_id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a></td>";
			echo  "</tr>";
				   $rsStudents-> MoveNext();
				   $i++;
 				 }?>
            </tbody>
          </table>
        </div>
         <?php  
	 ?>
        
 
 
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getStudents ); ?></ul></div>
      </div>
        <?php  } else echo "<div class='adminError'>No Results Found</div>"; ?>
      
           </div>
    </div>
    
   </div>
<?php 
include('adminfooter.php');
}
?>