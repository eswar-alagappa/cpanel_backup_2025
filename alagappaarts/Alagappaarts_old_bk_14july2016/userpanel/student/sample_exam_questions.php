<?php 
include("../config/config.inc.php");
include("../config/classes/loginmaster.class.php");
include("../config/classes/onlineexam.class.php");
include("../config/classes/keywordmaster.class.php");
include("../config/classes/questiontypemaster.class.php");

$roleid = $_SESSION[studentinfo][role_id];
$userid = $_SESSION[studentinfo][user_id];
$username = $_SESSION[studentinfo][first_name];
$arrlogin = array('role_id'=> $roleid ,'user_id'=>$userid);
$loginmaster = new loginmaster();
$student  = $loginmaster->isstudent($arrlogin);
$arrInput = $_SESSION['sampleuserexaminfo'];
$onlineexam = new onlineexam();
$questiontypemaster = new questiontypemaster();
if(!$student && !isset($arrInput))
{
	header('location:index.php?msg=Enter username password');
}
else {
	$questiontypes = $_SESSION['sampleuserexaminfo']['questiontypeid'];
	$questioncount = $_SESSION['sampleuserexaminfo']['questioncount'];
	if(SAMPLE_EXAMKEY)
	{

		$courseid = $arrInput['course_id'];
		$getSampleTestdetail = $onlineexam -> sample_retrieveQuestionNew(SAMPLE_EXAMKEY,$courseid);
		
		$getSampleTestdetail = $getSampleTestdetail[0];
		
			
			if(isset($getSampleTestdetail))
			{
					$arrayfinal = explode( ",", $getSampleTestdetail['questions_assigned'] );
					$arrayposition = explode( ",", $getSampleTestdetail['position'] );
					$totalQuestion = count($arrayfinal);
					$_SESSION[ 'uniqueSampleTestKey' ] = $getSampleTestdetail[ 'examkey' ];
					
					for($i = 0; $i < $totalQuestion ; $i++)
					{
						$arrayQuestions[$i] = $onlineexam -> getQuestion($arrayfinal[$i],$arrayposition[$i]);
					}
					
					for($i = 0; $i < $totalQuestion ; $i++)
					{
						$arrayfin[$i] = $arrayQuestions[$i][0];
					}
					
						$_SESSION['samplequestionarray'] = $arrayfin;	
						$_SESSION['sampleusertest'] = $getSampleTestdetail['id'];
							
						//array_search( $getSampleTestdetail[ 'currentquestion' ], $arrayfin ); exit;
						$questCount = array_search( $getSampleTestdetail[ 'currentquestion' ], $arrayfinal );
						$_SESSION['samplequestCount'] = $questCount-1;
															
						//if($_SESSION['questionarray'] != null)
						//{
						header("location:sample_exam.php");
						//}
					
						exit;
			}
			 else
			{
				
			   header("location:sample_exam_instruction.php");
			}	

}


	


}

?>