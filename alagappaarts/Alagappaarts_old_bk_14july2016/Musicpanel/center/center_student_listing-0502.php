<?php
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
$roleid = $_SESSION[centerinfo][role_id];
$userid = $_SESSION[centerinfo][user_id];
$username = $_SESSION[centerinfo][academy_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$iscenter  = $loginmaster->iscenter($arrlogin);

if(!$iscenter)
{
	header('location:index.php?msg=Enter username password');
}
else{
define( MAX_NO_OF_ROWS_PAGINATION,20);
include('centerheader.php');
include("../config/classes/programmaster.class.php");
include("../config/classes/studentmaster.class.php");
include("../config/classes/centremaster.class.php");
include("../config/classes/keywordmaster.class.php");
global $DB;
$programmaster  = new programmaster();
$programname = $programmaster->getProgramname();
$centremaster  = new centremaster();
$centrenames = $centremaster->getcentrenames();
$keywordmaster  = new keywordmaster();
$studentstatus = $keywordmaster->getkeyword('studentstatus');
$pagename='student_listing';
if(isset($_REQUEST['btnViewAll']))
{
	unset($_SESSION['searchStudent']);
}
if($_REQUEST['btnStudentsearch']){
$arrStudent =array('sm.first_name'=>$_REQUEST['txtName'],'sm.status'=>$_REQUEST['ddlStatus'],'se.program_id'=>$_REQUEST['ddlProgram'],'se.centre_id'=>$userid);
$_SESSION['searchStudent'] = $arrStudent;
	header('location:center_student_listing.php');
}else if($_SESSION['searchStudent']){
		$arrStudent = array('sm.first_name'=>$_SESSION['searchStudent']['sm.first_name'],'sm.status'=>$_SESSION['searchStudent']['sm.status'],
	'se.program_id'=>$_SESSION['searchStudent']['se.program_id'],'se.centre_id'=>$userid);
}
else  {
	$arrStudent = array('se.centre_id'=>$userid);
	}
$studentmaster  = new studentmaster();
$getStudents = $studentmaster -> getStudents().$filterObj->applyFilter($arrStudent,$pagename);
//echo $getStudents ." order by student_id  desc";
$rsStudents = $DB -> execute( $paginationObj->getQuery($getStudents ." order by student_id  desc"));
/*echo "<pre>";
print_r($rsStudents);*/

$countofStudents = count($rsStudents -> fields[id]);
static $recordcount=0;
$forcount = $DB->execute($getStudents);
while(!$forcount->EOF)
{
	$recordcount++;
	$forcount -> MoveNext();
}


if( isset ($_POST['btnDownload'])){
	
error_reporting(E_ALL);
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");




global $DB;
$studentdetails = $DB->getArray("select  distinct(sm.id),  se.enrollment_id as EnrollmentID ,sm.first_name as FirstName ,sm.last_name  as LastName
									 ,sm.age as Age ,sm.gender as Gender ,sm.address as Address ,sm.state as State ,
									sm.country as Country  ,sm.zipcode as Zipcode,sm.phone  as PhoneNo,sm.email_id as EmailID ,km.value as Status ,cm.academy_name as Center , cd.director_name 									as Director   ,se.graduation_status as GraduationStatus  ,  DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as   enrollment_date	 ,  cm.centreid ,sm.dob 
									from 
									studentmaster sm   
									join student_education se on se.student_id =    sm.id
									join centremaster cm on  cm.id =  se.centre_id 	
									join centre_director cd on  cm.id =  cd.centre_id
									join keywordmaster km on  km.id =  sm.status where 1=1 and se.centre_id= {$userid}  and 
									   sm.status = (select id from  keywordmaster where code ='studentstatus' and value='Active')   GROUP BY sm.id" );
$sno = 1;
foreach ($studentdetails as  $studentdetail ) {
		$student[$studentdetail[id]][0]=  $sno; 
		$student[$studentdetail[id]][1]=  $studentdetail['enrollment_date']; 
		
		$student[$studentdetail[id]][2]=  $studentdetail['Director']; 
		$student[$studentdetail[id]][3]=  $studentdetail['centreid']; 
		$student[$studentdetail[id]][4]=  $studentdetail['EnrollmentID']; 
		$student[$studentdetail[id]][5]=  $studentdetail['FirstName']; 
		$student[$studentdetail[id]][6]=  $studentdetail['LastName']; 
		$student[$studentdetail[id]][7]=  $studentdetail['Address']; 
		$student[$studentdetail[id]][8]=  $studentdetail['State']; 
		$student[$studentdetail[id]][9]=  $studentdetail['Country']; 
		$student[$studentdetail[id]][10]=  $studentdetail['Zipcode']; 
		
		$student[$studentdetail[id]][11]=  $studentdetail['Gender']; 
		$student[$studentdetail[id]][12]=  $studentdetail['dob']; 
		$student[$studentdetail[id]][13]=  $studentdetail['PhoneNo']; 
		$student[$studentdetail[id]][14]=  $studentdetail['EmailID']; 
	
		$programsdetails = $DB->getArray("select id , total_fee from programmaster where status = 'Y' order by id " );
		$i= 15 ;
		
		foreach ($programsdetails as  $programsdetail ) {
			$programid = $programsdetail['id'];
			$studentid =   $studentdetail['id'];
			$programfee = $programsdetail['total_fee'];
			
			$studenteducation =  $DB->getArray("select se.id,   DATE_FORMAT(se.enrollment_date,'%d-%b-%Y') as enrollment_date  ,se.is_fasttrack , 				            se.graduation_status  , 
			 DATE_FORMAT(se.completion_date,'%d-%b-%Y') as completion_date , DATE_FORMAT(se.scheduled_cc_date,'%d-%b-%Y') as scheduled_cc_date , 
			 k.value as  grade	
			 from 	student_education se
			 left join keywordmaster  k on  k.id = se.grade 
			 where  se.program_id = '$programid' and   se.student_id  = '$studentid' " ); 
			if($studenteducation[0]['id']){
				
			/*	if($studenteducation[0]['id'] ==  'Y'){
						$student[$studentdetail[id]][$i]= "Y";  $i++;
					$student[$studentdetail[id]][$i]= "N";  $i++; }
				else {
					$student[$studentdetail[id]][$i]= "N";$i++;  
					$student[$studentdetail[id]][$i]= "Y"; $i++;
				 }*/
				 if($programid !=  1  ){
				//	 echo "program</br>";
					if( $studenteducation[0]['enrollment_date'])
					 $student[$studentdetail[id]][$i]=$studenteducation[0]['enrollment_date']; 
				 	else  $student[$studentdetail[id]][$i]  = '' ;
				  $i++;}
				 // $student[$studentdetail[id]][$i]= $studenteducation[0]['scheduled_cc_date'];   $i++;
				 if($programid == 1 || $programid == 2 ) {
				  if($studenteducation[0]['is_fasttrack'] ==  'Y') {
					$student[$studentdetail[id]][$i]= "Yes";  $i++;}
				  else {
					$student[$studentdetail[id]][$i]= "No";  $i++;  }
				 }
					
					/*echo "select 
						sp.amount , DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on ,
						(select check_no from payment_check where payment_id=sp.id) as check_no ,
						(select transaction_no  from payment_paypal where payment_id = sp.id) as transaction_no
						
						from student_payment sp 
						 
						where sp.student_id= '$studentid' and sp.program_id = '$programid'" ."<br/>";*/
				 $studentpayments =  $DB->getArray(" select 
						sp.amount , DATE_FORMAT(sp.paid_on,'%d-%b-%Y') as paid_on ,
						(select check_no from payment_check where payment_id=sp.id) as check_no ,
						(select transaction_no  from payment_paypal where payment_id = sp.id) as transaction_no
						
						from student_payment sp 
						 
						where sp.student_id= '$studentid' and sp.program_id = '$programid'"); 
						 $student[$studentdetail[id]][$i] =  " $ ". $programfee; $i++ ; 
						 
						 $totalnoofpayment =  count($studentpayments) ;
						 if($studentpayments ){
						foreach ($studentpayments as  $key =>$studentpayment ) {
							
							 $student[$studentdetail[id]][$i] =  " $ ". $studentpayment['amount'] ;  $i++;
							 $student[$studentdetail[id]][$i] =  $studentpayment['paid_on'] ; $i++;
							 if($key == 0){
							 $student[$studentdetail[id]][$i] =  $studentpayment['check_no'] ; $i++;
							 $student[$studentdetail[id]][$i] =  $studentpayment['transaction_no'] ; $i++;
							 
								$balance =    $programfee - $studentpayment['amount'];
							 $student[$studentdetail[id]][$i] =  " $ ".  $balance ;  $i++; 
							 }
							if ( $totalnoofpayment ==  1){
								 $student[$studentdetail[id]][$i] =  " ";  $i++; 
								  $student[$studentdetail[id]][$i] =  " ";  $i++; 
								}
							
							}
						 }else {
							  $student[$studentdetail[id]][$i] =  " ";  $i++; 
								  $student[$studentdetail[id]][$i] =  " ";  $i++; 
								   $student[$studentdetail[id]][$i] =  " ";  $i++; 
								  $student[$studentdetail[id]][$i] =  " ";  $i++; 
								   $student[$studentdetail[id]][$i] =  " ";  $i++; 
								  $student[$studentdetail[id]][$i] =  " ";  $i++; 
								   $student[$studentdetail[id]][$i] =  " ";  $i++; 
								 
							 }
							
				
	
			}
			else {
				//echo "noprogram</br>";
				 if($programid !=  1  ) $student[$studentdetail[id]][$i]= "";  $i++; 
				
			//	$student[$studentdetail[id]][$i]= "";  $i++; 
			 if($programid == 1 || $programid == 2 ) 	$student[$studentdetail[id]][$i]= "";  $i++;
				$student[$studentdetail[id]][$i] =  " $ ". $programfee; $i++ ; 
				$student[$studentdetail[id]][$i]= "";  $i++;
				$student[$studentdetail[id]][$i] = ''; $i++;
				$student[$studentdetail[id]][$i]= "";  $i++; 
				$student[$studentdetail[id]][$i]= "";  $i++;
				$student[$studentdetail[id]][$i] = ''; $i++;
				$student[$studentdetail[id]][$i]= "";  $i++; 
				$student[$studentdetail[id]][$i]= "";  $i++;
				/*$student[$studentdetail[id]][$i] = ''; $i++;*/
			
			}
			$student[$studentdetail[id]][$i]=  $studenteducation[0]['completion_date']  ; 	  $i++;
			  $student[$studentdetail[id]][$i]=  $studenteducation[0]['grade']  ; 	  $i++;
			 // $student[$studentdetail[id]][$i]=  $studenteducation[0]['completion_date']  ; 	  $i++;
			if($studenteducation[0]['graduation_status'] == 'Y')
			 $student[$studentdetail[id]][$i]= "Graduated";
			 else   $student[$studentdetail[id]][$i]= "-";
			
			  $i++;
			 //  $student[$studentdetail[id]][$i]= ""; 	  $i++;
			  
			
			}
		
		
		
	$sno++ ;
	}
//exit;



$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setAutoSize(true);


$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:T1');
/*First Row*/
/*$objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:BI2')->getFont()->setBold(true);*/
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(40);

$default_border = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb'=>'1006A3')
);



$style_header = array(
    /*'borders' => array(
        'bottom' => $default_border,
        'left' => $default_border,
        'top' => $default_border,
        'right' => $default_border,
    ),*/
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'E1E0F7'),
    ),
    'font' => array(
        'bold' => true,
    )
);
 
$objPHPExcel->getActiveSheet()->getStyle('A1:BL1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:BL2')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('A1:BL1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:BL1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:BL2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:BL2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



//$objPHPExcel->getActiveSheet()->getStyle('A2:BI2')->setHegiht(10);
//$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$centerdetail = $centremaster ->getcentredetails($userid);
$centername = $centerdetail->fields[academy_name];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'LIST OF '. $centername .' STUDENTS ');
/*Second Row*/
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'No');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B2', 'Date Enrolled');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C2', 'Dance Teacher');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D2', 'Center code');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E2', 'Student ID');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F2', 'First Name');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G2', 'Last Name');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H2', 'Address');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I2', 'State');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('J2', 'Country');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K2', 'Zip Code');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('L2', 'Gender');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('M2', 'DOB');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('N2', 'Telephone No');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('O2', 'Email address');
			$k = 15;
	$programsdetails = $DB->getArray("select id ,name from programmaster where status = 'Y' order by id " );
	/*echo "<pre>";
	print_r($programsdetails);
	echo "xgf df";*/
	foreach ($programsdetails as  $key => $programsdetail ) {
	/*	 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);*/
		if($key != 0 ){
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,$programsdetail['name'].'Enroll Date'); $k++;   
		}
		if($key == 0 ||  $key == 1){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Fast Track'); $k++;  
		}
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,$programsdetail['name'].' Fee due'); $k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2, 'Fee paid'); $k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Date Paid');$k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2, 'Check');$k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Paypal'); $k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Balance due'); $k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2, 'Balance Paid');$k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2, 'Balance Date Paid');$k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Date of Exam');  $k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2, 'Grade');$k++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k,2,'Date of Graduation');$k++;
		}
		
		/*exit;*/
	$styleArray = array(
	  'borders' => array(
		'allborders' => array(
		  'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	  )
	);
$objPHPExcel->getActiveSheet()->getStyle('A1:BL1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A2:BL2')->applyFromArray($styleArray);
unset($styleArray);
			
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);

$col = 0;
$row = 3;
//print_r($student);
foreach($student as $rs) {
	$col = 0;
	
    foreach($rs as $key=>$value) { 
	
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
         $col++;
    }
	
	$objPHPExcel->getActiveSheet()->getStyle('A'. $row .':G'. $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('I'. $row .':BN'. $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'. $row .':BN'. $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

$objPHPExcel->getActiveSheet()->getStyle('A'. $row .':BL'. $row)->applyFromArray($styleArray);
unset($styleArray);
   $row++;
}
$objPHPExcel->getActiveSheet()->setTitle('Report');
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('report.xlsx');

header('location:report.xlsx');
}

?>
<script type="text/javascript" src="../web/validation/student.validate.js"></script>
<div class="headerBottom">

      <div class="admiTitle">Welcome  <?php  echo $username; ?></div>
      <div class="menuBottom">
       <ul>
          <li class="homeIcon"><a href="http://alagappaarts.com/">website Home</a></li>
            <li class=""><a href="dashboard.php">dashboard</a></li>
          <li class="profilenav"><a href="center_profile_center.php">Profile</a></li> 
          <li class="logoutIcon "><a class="end" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class=" wrapper">

<div class="content">

    <div class="studentViewContent">
    <?php if(isset($_SESSION['ackmsg']))
	{
		echo '<div class="adminSuccess">'.$_SESSION['ackmsg'].'</div>';
		unset($_SESSION['ackmsg']);
		
	}
	?>
     <h2><span>students </span>
     
<div class="downloadbtn">
        <span>
         <form id="form" method="post">
		<input name="btnDownload" class="exceldownloadBtn"  value="" type="submit" ></form>  </span>
         <!--<span> <form id="form" method="post">
		<input name="btnDownloadword" class="worddownloadBtn"  value="" type="submit" ></form> </span>-->
      </div>
</h2>
<div class="searchBox">
<form method="post" id="frmStudentsearch"  >
<div class="searchBoxInner">


        <label>Search By Name :</label>
        <input type="text"    class="required_group" name="txtName" value="<?php  if($_SESSION['searchStudent']['sm.first_name']) echo  $_SESSION['searchStudent']['sm.first_name']; ?>" />
        <label class="statusTxt">Status :</label>
        <select class="mR10 studentListing required_group" name="ddlStatus">
      <option value="">Select</option>
<?php foreach($studentstatus as $value)
 	{
		if($value[id] == $_SESSION['searchStudent']['sm.status'])
		echo "<option value='{$value[id]}'selected >{$value[value]}</option>";
		else 
	echo "<option value='{$value[id]}' >{$value[value]}</option>";
	 
	} ?>
    </select>
        
       </div>
       <div class="searchBoxInner">

         <label>Program :</label>
       <select class="studentListing required_group" name="ddlProgram">
      <option value="">Select</option>
<?php while(!$programname->EOF)
 	{
		if($_SESSION['searchStudent']['se.program_id'] == $programname->fields[id] )
		echo "<option value='{$programname->fields[id]}' selected>{$programname->fields[name]}</option>";
		else 
	echo "<option value='{$programname->fields[id]}' >{$programname->fields[name]}</option>";
	 $programname-> MoveNext();
	} ?>
    </select>
        
        <input name="btnStudentsearch" value="go" type="submit" class="goBtn" />
         <?php if(isset($_SESSION['searchStudent']))
		{
			echo ' <input name="btnViewAll" value="View All Students" type="submit" class="viewAll" />';
		}
		 ?>
        </div>
        <div class="errorContainer" ></div>
       </form>
        </div> 
     
     
      <div class="studentList">
        
              <?php if($countofStudents)
		{ ?>
   		<div class="searchBox" style="display:none;">
        Search results for Aravind Kumar
      </div>
        <div class="studentListInner">
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <tr>
                <th>Student Id </th>
                <th> Student Name</th>
                <th> Student Email ID</th>
                 <th> Status</th>
                <th width="75"> Actions</th>
              </tr>
               <?php  
			  $i =0;
			  while(!$rsStudents->EOF)
 				{
				
					$studentarray =  array('student_id'=>$rsStudents->fields[id]);
					$rsEnrollmentID= $studentmaster->getEnrollmentID($studentarray);
					$getEnrollmentID=$rsEnrollmentID->fields[enrollment_id];
					
					if($i % 2) 	$classname="altRows";
					else $classname="";
				  echo "
				  <tr class='{$classname}'>
				   <td>{$getEnrollmentID}</td>
           
                <td> {$rsStudents->fields[first_name]} {$rsStudents->fields[last_name]}  </td>
                <td>{$rsStudents->fields[email_id]} </td>";
               echo "<td>{$rsStudents->fields[value]}";
			   echo "</td>";
			 
			   echo "<td><a href='center_student_view.php?studentid={$rsStudents->fields[student_id]}'><img src='../web/images/view-btn.png' width='20' height='18' title='View'/></a>";
			   
				echo "</td></tr>";
				   $rsStudents-> MoveNext();
				   $i++;
 				 }?>
            </tbody>
          </table>
        </div>
         <?php  }
	 ?>
      </div>
         <?php if($countofStudents)
		{ ?>
      <div class="paginationContent">
       
        <div class="paginationLeft">Shows <?php echo  $paginationObj ->rowsperPageFromTo($recordcount); ?> of <?php echo $recordcount ;?> </div>
        <div class="pagination"><ul><?php echo $paginationObj -> getLinks( $getStudents ); ?></ul></div>
      </div>
        <?php  }
		else echo "<div class='centerError'>No Results Found</div>"; ?>
      
    </div>
   </div>
     </div>
<?php 
include('centerfooter.php');
}
?>