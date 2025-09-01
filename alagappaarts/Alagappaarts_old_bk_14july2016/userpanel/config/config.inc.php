<?PHP
ob_start( );
session_start( );
header("Cache-Control: cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require( "settings.php" );
include_once( "classes/pagination.class.php" );
include_once("classes/filters.class.php");
//ini_set( "post_max_size", "64M" );
ini_set( "upload_max_filesize", "". "MAX_FILEUPLOAD_SIZE". "" );
//ini_set('max_execution_time', 10000);
//ini_set('memory_limit', '50000M');

if( IS_SITE_UNDER_MAINTAINENCE ){
	echo "<br><br><br><center><h3><font color=red>Under Maintainence..</h3></center>";
	exit;
}

# Displaying/Disabling Errors;

if( PHP_ENGINE_ERRORS ){

	error_reporting( E_ALL );
	ini_set( "display_errors", "ON" );

}else{

	error_reporting( E_ERROR );
	ini_set( "display_errors", "OFF" );

}

include( PATH_LIB. DS. "adodb/adodb.inc.php" );

$DB = &ADONewConnection( DB_TYPENAME );        # create a connection

$DB -> PConnect( DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
global  $mysqli; 

$mysqli = new mysqli( DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


/*
$queryPlaces = "select placeid,placename from place where placemasterid = (select GetCodeByCodeDescAndType('place','airport')) and isactive = 1
 order by placename";
$rsPlaces = $DB -> getArray( $queryPlaces );

foreach( $rsPlaces as $key => $value ){
		echo $value[ placeid ]. "==". $value[ placename ]. "<br/>";
}

$queryPlaces = "select placeid,placename from place where placemasterid = (select GetCodeByCodeDescAndType('place','airport')) and isactive = 1
 order by placename";
$rsPlaces = $DB -> execute( $queryPlaces );

echo "<br/>After EXECUTION: <br/>";

echo "<select name='places'>";
while( ! $rsPlaces -> EOF ){
	//echo $rsPlaces -> fields[ placeid ]. "==". $rsPlaces -> fields[ placename ]. "<br/>";
	echo "<option value='{$rsPlaces -> fields[ placeid ]}'>{$rsPlaces -> fields[ placename ]}</option>";//	
	$rsPlaces -> MoveNext( );
}
echo "</select>";

*/

//print "<pre>";
//print_r( $rsPlaces );

##### Custom Functions ##############

function Is_Logged_In( ){

global $SERVER; 

if(isset($SERVER -> SESSION[ uname ])){

	$user = $SERVER -> SESSION[ uname ];

	$CompanyId = $SERVER -> SESSION[ companyID ];

	$companyname = $SERVER -> SESSION[ CompanyName ];

	$SERVER -> SMARTY -> assign("companyname", $companyname);

	$SERVER -> SMARTY -> assign("user", $user);

	return true;
}

else{

	header ("Location: login.php");

	return false;
}

}

function arrayToJS4($array, $baseName) {
   //Write out the initial array definition
   echo ($baseName . " = new Array(); \r\n ");    

   //Reset the array loop pointer
   reset ($array);

   //Use list() and each() to loop over each key/value
   //pair of the array
   while (list($key, $value) = each($array)) {
      if (is_numeric($key)) {
         //A numeric key, so output as usual 
         $outKey = "[" . $key . "]";
      } else {
         //A string key, so output as a string
         $outKey = "['" . $key . "']";
      }
      
      if (is_array($value)) {
         //The value is another array, so simply call
         //another instance of this function to handle it
         arrayToJS4($value, $baseName . $outKey);
      } else { 

         //Output the key declaration
         echo ($baseName . $outKey . " = ");      

         //Now output the value
         if (is_string($value)) {
            //Output as a string, as we did before       
            echo ("'" . $value . "'; \r\n ");
         } else if ($value === false) {
            //Explicitly output false
            echo ("false; \r\n");
         } else if ($value === NULL) {
            //Explicitly output null
            echo ("null; \r\n");
         } else if ($value === true) {
            //Explicitly output true 
            echo ("true; \r\n");
         } else {
            //Output the value directly otherwise
            echo ($value . "; \r\n");
         }
      }
   }
} 
function login()
{
	echo "inside login function";
}



?>
