<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'Off');

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('cdberp','cdberp',$dbstr1); 

date_default_timezone_set("Asia/Calcutta");
echo date("Y/m/d H:i:s");
echo "\n";
if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	echo "Successfully connected to Oracle.\n";
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$stid = oci_parse($dbConn, "select users.user_id, users.user_branch_code from users");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	echo $row[0];
}



?>