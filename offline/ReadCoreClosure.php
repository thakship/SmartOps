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

$stid = oci_parse($dbConn, "SELECT C.DOCUMENTNUMBER AS SYNC_DOC_NO,TO_CHAR(C.CLOSURE_DATE,'YYYY-MM-DD') AS SYNC_DATE,STAT FROM cdbproddb.CDBERP_core_acnt_closure C WHERE C.STAT = '0'");
oci_execute($stid);
$i = 0;
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	if (isset($row[0])){
		$i++;
		echo "\r\n".$i."  Record(s) reading................";
		//Insert Records to mySQl data table
	
		$v_sql_mysql_insert = "INSERT INTO `cdberp`.`core_acnt_closure` (`documentNumber`, `Closure_date`, `syncheddttime`) VALUES ('$row[0]','$row[1]',now())";
		$query1 = mysqli_query($conn,$v_sql_mysql_insert);
		
		//Update the Oracle table as read
		$v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDBERP_core_acnt_closure CCD SET CCD.STAT = '1' WHERE CCD.DOCUMENTNUMBER = '$row[0]' AND CCD.STAT = '0'");
		oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	} 
}
echo "\r\n".$i." Record(s) syncronized.............................";

?>