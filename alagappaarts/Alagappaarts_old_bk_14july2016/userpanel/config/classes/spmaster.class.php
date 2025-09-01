<?php

class spmaster {

static function Execute($spquery)

{

global $mysqli;

$mysqli ->multi_query($spquery);

$j=0;

do {

if($j==0)

{

$result = $mysqli->store_result() ;

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $result ;

}

static function GetArray($spquery)
{
//echo $spquery;
global $mysqli;
$mysqli ->multi_query($spquery);

$j=0;

do {

if($j==0)

{

$resultset = $mysqli->store_result() ;

$results = array();
//print_r($resultset);exit;
while($result = $resultset->fetch_array())

{

$results[] = $result;

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $results ;

}

static function ExecuteList($spquery)

{

	//echo $spquery;

global $mysqli;

$mysqli ->multi_query($spquery);

$results =array () ;

$j=0;

do {

$resultset = $mysqli->store_result() ;

if($j==0)

{

while($result = $resultset->fetch_array())

{

$results[0] =$result['countid'];

}

}

else if($j==1) {

$results[1] =array () ;

while($result = $resultset->fetch_array())

{

$results[1][] = $result;

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $results ;

}

static function InsertSQL($spquery)

{

global $mysqli;

$mysqli ->multi_query($spquery);

return true;

}

static function ArrayInsertSQL($spquery,$arr)

{

global $mysqli;

$val = "";

foreach ($arr as $key => $value){

/*if($val == "" ) $val = $value ;

else $val .= ",". "'".$value."'" ;*/

if($val == "" ) $val = "'".$value."'";

else $val .= ",". "'".$value."'" ;

}

$spquery=str_replace('@PARAM',$val,$spquery);

$mysqli ->multi_query($spquery);

return true;

}

static function ReturnSQL($spquery)

{

global $mysqli;

$result = $mysqli ->multi_query($spquery);

$j=0;

do {

if($j==0)

{

$resultset= $mysqli->store_result() ;

while ($row = $resultset->fetch_array()) {

$result = $row[0];

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $result ;

}

static function ArrayReturnSQL($spquery,$arr)

{

global $mysqli;

$val = "";

foreach ($arr as $key => $value){

if($val == "" ) $val = $value ;

else $val .= ",". "'".$value."'" ;

}

$spquery=str_replace('@PARAM',$val,$spquery);

$result = $mysqli ->multi_query($spquery);

do {

if($j==0)

{

$resultset= $mysqli->store_result() ;

while ($row = $resultset->fetch_array()) {

$result = $row[0];

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $result ;

}

static function ReturnSQLArray($spquery)

{

	/*echo "$spquery";

	exit;*/

global $mysqli;

$result = $mysqli ->multi_query($spquery);

do { //echo "dmkkk3251456";

if($j==0)

{

$resultset = $mysqli->store_result() ;

while ($row = $resultset->fetch_assoc()) {

$result = $row ;

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $result ;

}

static function ArrayReturnSQLArray($spquery,$arr)

{

//echo $spquery;

global $mysqli;

$val = "";

foreach ($arr as $key => $value){

if($val == "" ) $val = $value ;

else $val .= ",". "'".$value."'" ;

}

$spquery=str_replace('@PARAM',$val,$spquery);

$result = $mysqli ->multi_query($spquery);

do {

if($j==0)

{

$resultset = $mysqli->store_result() ;

while ($row = $resultset->fetch_assoc()) {

$result = $row ;

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $result ;

}

static function GetArrayAssociate($spquery)
{
	

//echo $spquery;



global $mysqli;

$mysqli ->multi_query($spquery);



$j=0;

do {

if($j==0)

{

$resultset = $mysqli->store_result() ;

$results = array();

while($result = $resultset->fetch_array(MYSQLI_ASSOC))

{

$results[] = $result;

}

}

$j++;

} while($mysqli->more_results() && $mysqli->next_result());

return $results ;

}

}?>