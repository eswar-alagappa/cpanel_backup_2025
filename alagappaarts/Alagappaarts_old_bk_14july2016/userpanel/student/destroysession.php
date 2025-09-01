<?php
include("../config/config.inc.php");
include("../config/classes/exam.class.php");
$userid = $_SESSION['studentinfo']['user_id'];
$courseid=$_SESSION['userexaminfo']['course_id'];
$key = $_SESSION['uniqueTestKey'];
$queid=$_REQUEST['queid'];
$typeID=$_REQUEST['typeID'];
$seconds=$_REQUEST['seconds'];
$answers=$_REQUEST['answers'];
$udpateallvalues=onlineexamquestions::updateallvalues($userid,$courseid,$key,$typeID,$queid,$seconds,$answers);
unset($_SESSION['usertest']);
unset($_SESSION['questionarray']);
unset($_SESSION['questCount']);
unset($_SESSION['currentQuestion']);
unset($_SESSION['currentQuestiontype']);
unset($_SESSION['MatchCorrectQuestAnswer']);
unset($_SESSION['MatchQuestiontypeid']);
unset($_SESSION[ 'uniqueTestKey' ]);
unset($_SESSION[ 'uniqueTestKeyShown' ]);
unset($_SESSION['userexaminfo']);
?>