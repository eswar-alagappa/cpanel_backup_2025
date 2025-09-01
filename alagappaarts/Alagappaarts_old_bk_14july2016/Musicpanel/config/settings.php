<?PHP

# Environment;
define( "DEBUG_MODE", 0 );
define( "PHP_ENGINE_ERRORS", 0 );
define( "SERVER_NAME", "localhost" );
define( "SERVER_IP", "127.0.0.1" );
define( "DS", "/" );
define( "IS_SITE_UNDER_MAINTAINENCE", 0 );

# Database;
include( "database.php" );
define( "DB_TYPENAME", "mysql" );
define( "DSN", DB_TYPENAME. "://". DB_USERNAME. "@". DB_HOSTNAME. "/". DB_DATABASE );

# Path Definitions;
//define( "PATH_ROOT", DS. "opt". DS. "lampp". DS. "htdocs". DS. "acstimsdev" );
//define( "PATH_ROOT", DS. "opt". DS. "lampp". DS. "htdocs". DS. "acstelcoupdated". DS. "acstims" );
$pathApplication = dirname( dirname( __FILE__ ) );
define( "PATH_ROOT", $pathApplication );
define( "PATH_CONFIG", PATH_ROOT. DS. "config" );
define( "PATH_LIB", PATH_CONFIG. DS. "libs" );
define( "PATH_CLASS", PATH_CONFIG. DS. "classes" );
define( "PATH_UPLOAD", PATH_ROOT. DS. "uploads" );
define( "ADODB_CACHE_DIR", PATH_CONFIG. DS. "adodb_cache" );

define( "DATE_SEPARATOR", "/" );
define( "DATE_FORMAT", "mm". DATE_SEPARATOR. "dd". DATE_SEPARATOR. "yyyy" );
define( "DB_DATE_FORMAT", "yyyy-mm-dd" );

define( "MAX_NO_OF_ROWS_CAN_BE_DISPLAYED", 501 );
define( "SHOW_TOTAL_COST_IN_REPORTS", 0 );

define( "NOTIFY_URL", 'http://alagappaarts.com/music/student/student_paymentconfirmation.php' );
define( "RETURN_URL", 'http://alagappaarts.com/music/student/student_paymentconfirmation.php' );
define( "CANCEL_URL", 'http://alagappaarts.com/music/student/student_paymentconfirmation.php' );

//define(ADMIN_EMAIL,'customersupport@alagappaarts.com');
define("ADMIN_EMAIL",'deepi19788@gmail.com');
define("STUDENT_LOGIN_URL",'http://alagappaarts.com/music/student/');
define("SAMPLE_EXAMKEY",'APAA-SDF123SDG1X');
define( "GLOBAL_PASSWORD", 'Apaavairavan@2012' );
define( "MAX_FILEUPLOAD_SIZE", '500MB' );
$ADODB_CACHE_DIR = ADODB_CACHE_DIR;

$paginationArray["numRowsPerPage" ] = 5;
$paginationArray[ "isPaginationEnabled" ] = 1;

$ajaxResponseTextSeparator = "~*~";

$decimal = 2;

global $tablesArray, $filesArray, $errorMessages, $paginationArray ,$decimal;

?>