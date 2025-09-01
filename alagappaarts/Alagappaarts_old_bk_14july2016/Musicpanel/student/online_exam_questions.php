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
$arrInput = $_SESSION['userexaminfo'];
//print_r($arrInput);
$onlineexam = new onlineexam();
$questiontypemaster = new questiontypemaster();
if(!$student && !isset($arrInput))
{
	header('location:index.php?msg=Enter username password');
}
else {
	$questiontypes = $_SESSION['userexaminfo']['questiontypeid'];
	$questioncount = $_SESSION['userexaminfo']['questioncount'];
	 if(!$_SESSION['userexaminfo']['examtaken'])
	{
		$_SESSION[ 'uniqueTestKeyShown' ] = 'NO';
		$i=0;
		$j =0 ;
		foreach($questiontypes as $questiontype)
		{
			$controlname = $questiontypemaster->getquestiontype_controller($questiontype);
			$arrQuestionInput['id'] =  $questiontype;
			$arrQuestionInput['no_of_questions'] = $questioncount[$i];
                        $arrQuestionInput['courseid'] = $arrInput['course_id'];
			if($controlname[0]['controller'] == 'subjective'){
			$arrQuestions[$controlname[0]['controller'].$j]= $onlineexam->generateQuestion($arrQuestionInput);
			$j++;
			}
			else $arrQuestions[$controlname[0]['controller']]= $onlineexam->generateQuestion($arrQuestionInput);
			//$arrQuestions[$controlname[0]['controller']]= $onlineexam->generateQuestion($arrQuestionInput);
			$i++;
		}
		
		foreach($arrQuestions as $questionGroup)
		{  
			foreach($questionGroup as $questions)
			{
				$arrNew[] = $questions;
			}
		}
		//print "<pre>";
		//print_r($arrNew);
		//exit;
		$totalQuestion = count($arrNew);
		for($j=0;$j<$totalQuestion;$j++)
		{
			$arrayfinal[$j] = $arrNew[$j][0]['questionid'];
			$arrpostion[$j] = $arrNew[$j][0]['postion'];
		}
		
		$arrayInsert = implode(",",$arrayfinal);
		$arrayInsertPos = implode(",",$arrpostion);
		
		for($i = 0; $i < $totalQuestion ; $i++)
		{
			//$arrayQuestions[$i] =
			 $onlineexam->getQuestiontoAttend($arrayfinal[$i],$arrNew[$i][0]['postion'],$arrInput['assignedid']);
			 
			//$arrInput['assignedid'];
		/*}
	 	
		for($i = 0; $i < $totalQuestion ; $i++)
		{*/
			//$arrayfin[$i] = $arrayQuestions[$i][0];
		}
	 	$_SESSION[ 'noofquestioninexam' ] =  $i;
		/*echo $i;
		print "<pre>";
		print_r($arrayfin);
		exit;*/
		
		$randomkey = $onlineexam -> getNewUniqueRef( );//rand(0,999999999);
		$_SESSION[ 'uniqueTestKey' ] = $randomkey;
		
		$updateExamBegin = $onlineexam->updateExamBegin($arrInput['assignedid'],$randomkey,$arrayInsert,$arrayInsertPos);
		if($updateExamBegin->fields['id'] != 0)
		{
			//echo "<pre>";
			//print_r($arrayfin); exit;
			//$_SESSION['questionarray'] = $arrayfin;
			
			$_SESSION['usertest'] = $updateExamBegin->fields['id'];
			
			/*if($_SESSION['questionarray'] != null)
			{*/
				$_SESSION['questCount'] = -1;
				header("location:online_exam.php");
			/*}*/
		}
		
	}
	else  if($_SESSION['userexaminfo']['examtaken'])
	{
	

			$userid = $arrInput['student_id'];
			$courseid = $arrInput['course_id'];
		$getTestdetail = $onlineexam -> retrieveQuestionNew( $userid, '',$courseid);
		
			$getTestdetail = $getTestdetail[0];
		
			
			if(isset($getTestdetail))
			{
					//echo $arrInput['student_id'];;
			//echo $arrInput['course_id'];;
				 $arrayfinal = explode( ",", $getTestdetail['questions_assigned'] );
					//$arrayposition = explode( ",", $getTestdetail['position'] );
					$totalQuestion = count($arrayfinal);
						$_SESSION[ 'noofquestioninexam' ] = $totalQuestion ;
					$_SESSION[ 'uniqueTestKey' ] = $getTestdetail[ 'examkey' ];
				/*	
					for($i = 0; $i < $totalQuestion ; $i++)
					{
						$arrayQuestions[$i] = $onlineexam -> getQuestion($arrayfinal[$i],$arrayposition[$i]);
					}
					
					for($i = 0; $i < $totalQuestion ; $i++)
					{
						$arrayfin[$i] = $arrayQuestions[$i][0];
					}
					*/
						//$_SESSION['questionarray'] = $arrayfin;	
						$_SESSION['usertest'] = $getTestdetail['id'];
							
						//array_search( $getTestdetail[ 'currentquestion' ], $arrayfin ); exit;
						//$questCount = array_search( $getTestdetail[ 'currentquestion' ], $arrayfinal );
						$questCount = $onlineexam -> getCurrentpos( $getTestdetail['currentquestion'],$getTestdetail['id']);
					//	echo $questCount; exit;
						 
						$_SESSION['questCount'] = $questCount-1 ;
					
						$_SESSION[ 'uniqueTestKeyShown' ] = "YES";
					
						//if($_SESSION['questionarray'] != null)
						//{
						header("location:online_exam.php");
						//}
					
						exit;
			}
			 
	}
	else if( $_SESSION[ 'uniqueTestKey' ] )
	{
			       
					header("location:online_exam.php");
					exit;
	}



}

?>