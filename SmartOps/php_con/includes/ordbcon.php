<?php 
/*$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =192.168.4.14)(PORT = 1521))
(CONNECT_DATA =
(SERVER = DEDICATED)
(SERVICE_NAME = cdbuat)
(INSTANCE_NAME = cdbuat)))";
$dbConn = oci_connect('cdbproddb','cdbproddb',$dbstr1); */

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('cdberp','cdberp',$dbstr1); 
//echo "Successfully connected to Oracle.\n";
/*if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
	//trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
 	//echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	echo "Successfully connected to Oracle.\n";
}*/
?>