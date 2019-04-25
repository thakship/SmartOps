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
	echo "Successfully connected to Oracle.<br/>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating Leasing 3ws
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
AND PR.PRODUCT_LEASING = '1' AND PR.PRODUCT_CODE IN (501,502,508)");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
    //---- Madushan  2017-07-07
    if(!isset($row[13])){
        $row[13] = "";
    }
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','LEPO3W','".$row[35]."','".$row[36]."','".$row[37]."')";                                             
    //echo  $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - LEPO3W"."<br/>";
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................<br/>";
/*------------------------------------------------------- End of Creating Leasing 3ws ---------------------------------------------------------*/
/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating Leasing non 3ws
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
AND PR.PRODUCT_LEASING = '1' AND PR.PRODUCT_CODE NOT IN (501,502,508)");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','LEPOGE','".$row[35]."','".$row[36]."','".$row[37]."')";                                                 
        $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - LEPOGE"."<br/>";
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";
/*------------------------------------------------------- End of Creating Leasing non 3ws ---------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating HP 3ws
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
 AND PR.PRODUCT_HIREPURCH = '1' AND PR.PRODUCT_CODE IN (1001) AND ESP.ASSET_TYPE = '002'");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','HPPO3W','".$row[35]."','".$row[36]."','".$row[37]."')";                                             
    //echo  $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - HPPO3W"."<br/>";
   mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
   $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";
/*------------------------------------------------------- End of Creating HP 3ws ---------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating HP non 3ws - 1
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
AND PR.PRODUCT_HIREPURCH = '1' AND PR.PRODUCT_CODE IN (1001) AND ESP.ASSET_TYPE <> '002'");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','HPPOGE','".$row[35]."','".$row[36]."','".$row[37]."')";                                              
    //echo  $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - HPPOGE - 1"."<br/>";
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";
/*------------------------------------------------------- End of Creating HP non 3ws - 1 ---------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating HP non 3ws - 2
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
AND PR.PRODUCT_HIREPURCH = '1' AND PR.PRODUCT_CODE NOT IN (1001,1007)");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','HPPOGE','".$row[35]."','".$row[36]."','".$row[37]."')";                                        
    //echo  $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - HPPOGE - 2"."<br/>";
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";
/*------------------------------------------------------- End of  - 2 ---------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating MORTGAGE
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
echo "\r\n Creating MORTGAGE";

$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT , ESP.INS_COM_NAME , ESP.INT_RATE ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO_MORTGAGE ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
--AND PR.PRODUCT_HIREPURCH = '1'
AND PR.PRODUCT_CODE IN (1003,1004,1006)");

//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo - Mortgage".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
     //---- Madushan  2017-07-07
    if(!isset($row[13])){
        $row[13] = "";
    }
    echo $i."  Record(s) reading................<br/>";
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`INS_COM_NAME`,`INT_RATE`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','MOPOLE','".$row[35]."','".$row[36]."','".$row[37]."','".$row[38]."','".$row[39]."')";                                        
    echo  $v_sql_mysql_insert."<br/>";
    echo  $row[34]." - MOPOLE - 1"."<br/>";
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO_MORTGAGE CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
    echo "UPDATE cdbproddb.CDB_ERP_SECPRN_PO_MORTGAGE CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'";
    
 
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";


/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                            Creating MORTGAGE - MURABAHA
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 

$stid = oci_parse($dbConn, "SELECT TO_CHAR(ESP.CBD,'YYYY-MM-DD') AS CBD , ESP.SYSTEM_NO , ESP.PRODUCT_CODE , TO_CHAR(ESP.SERVER_DATE,'YYYY-MM-DD') AS SERVER_DATE , TO_CHAR(ESP.ACCPUNT_OPEN_DATE,'YYYY-MM-DD') AS ACCPUNT_OPEN_DATE , TO_CHAR(ESP.CHARGES_REC_DATE,'YYYY-MM-DD') AS CHARGES_REC_DATE , ESP.CLIENT_NAME ,
ESP.CLIENT_FULL_NAME , ESP.CC_ADDRESS_01 ,  ESP.CC_ADDRESS_02 ,  ESP.CC_ADDRESS_03 ,  ESP.MAKE_DESC ,  ESP.MODEL_DESC ,  ESP.SERIAL_NUMBER , 
ESP.VEHICLE_NUMBER ,  ESP.ENGINE_NUMBER ,  ESP.CHASSIS_NUMBER ,  ESP.YOM ,  ESP.ASSET_PRICE ,  ESP.LEASE_AMOUNT ,  ESP.VAT ,  ESP.PERIOD ,
ESP.GROSS_RENTAL ,  ESP.MARGIN ,  ESP.CLIENT_NIC ,  ESP.SUPPLIER_CODE ,  ESP.SUPPLIER_NAME ,  ESP.SUPPLIER_ADDRESS_01 , ESP.SUPPLIER_ADDRESS_02 ,
ESP.SUPPLIER_ADDRESS_03 , TO_CHAR(ESP.PO_PRINTED_DATE,'YYYY-MM-DD') AS PO_PRINTED_DATE ,  TO_CHAR(ESP.PO_PRINTED_DATE_TIME,'YYYY-MM-DD hh24:mm:ss ') AS PO_PRINTED_DATE_TIME ,  ESP.PO_AUTH_BY ,  ESP.ERP_READ , ESP.FACNO  
,ESP.ASSET_TYPE,ESP.EQUIP_CAT , ESP.INS_COM_NAME , ESP.INT_RATE ,ESP.RCVBLE
FROM cdbproddb.CDB_ERP_SECPRN_PO_MURABAHA ESP,CDBPRODDB.PRODUCTS PR
WHERE ESP.ERP_READ = 0 
AND PR.PRODUCT_CODE = ESP.PRODUCT_CODE
--AND PR.PRODUCT_HIREPURCH = '1'
AND PR.PRODUCT_CODE IN (1007)");

//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo chr(10)."<br/><br/>Starting to echo - Mortgage - MURABAHA".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	//echo $row[0]."--".$row[1]."--".$row[2]."--".$row[3]."--".$row[4]."--".$row[5]."--".$row[6]."--".$row[7]."--".$row[8]."--".$row[9]."--".$row[10]."--".$row[11]."--".$row[12]."--".$row[13]."--".$row[14]."--".$row[15]."--".$row[16]."--".$row[17]."--".$row[18]."--".$row[19]."--".$row[20]."--".$row[21]."--".$row[22]."--".$row[23]."--".$row[24]."--".$row[25]."--".$row[26]."--".$row[27]."--".$row[28]."--".$row[29]."--".$row[30]."--".$row[31]."--".$row[32]."--".$row[33]."--".$row[34]."<BR/>";
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
    $i++;
     //---- Madushan  2017-07-07
    if(!isset($row[13])){
        $row[13] = "";
    }
    echo $i."  Record(s) reading................ MURABAHA<br/>".chr(10);
    $v_sql_mysql_insert = "INSERT INTO `sps_po_gen`(`fac_no`, `cbd`, `system_no`, `product_code`, `server_date`, `accpunt_open_date`, `charges_rec_date`, `client_name`, `client_full_name`, `cc_address_01`, `cc_address_02`, `cc_address_03`, `make_desc`, `model_desc`, `serial_number`, `vehicle_number`, `engine_number`, `chassis_number`, `yom`, `asset_price`, `lease_amount`, `vat`, `period`, `gross_rental`, `margin`, `client_nic`, `supplier_code`, `supplier_name`, `supplier_address_01`, `supplier_address_02`, `supplier_address_03`, `po_printed_date`, `po_printed_date_time`, `po_auth_by`, `erp_read`, `print_stats`, `TYPE_CODE`,`asset_type`,`EQUIP_CAT`,`INS_COM_NAME`,`INT_RATE`,`RCVBLE`) 
                                            VALUES ('".$row[34]."','".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."','".$row[6]."','".$row[7]."','".$row[8]."','".$row[9]."','".$row[10]."','".$row[11]."','".$row[12]."','".$row[13]."','".$row[14]."','".$row[15]."','".$row[16]."','".$row[17]."','".$row[18]."','".$row[19]."','".$row[20]."','".$row[21]."','".$row[22]."','".$row[23]."','".$row[24]."','".$row[25]."','".$row[26]."','".$row[27]."','".$row[28]."','".$row[29]."','".$row[30]."','".$row[31]."','".$row[32]."','".$row[33]."','0','MPOMB','".$row[35]."','".$row[36]."','".$row[37]."','".$row[38]."','".$row[39]."')";                                        
    echo  $v_sql_mysql_insert.chr(10);
    echo  $row[34]." - MPOMB - 1".chr(10);
    mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error());
    echo "UPDATE cdbproddb.CDB_ERP_SECPRN_PO_MURABAHA CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'";
    
    $v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDB_ERP_SECPRN_PO_MURABAHA CCD SET CCD.ERP_READ = '1' WHERE CCD.FACNO = '".$row[34]."' AND CCD.SYSTEM_NO = ".$row[1]." AND CCD.ERP_READ = '0'");
    
 
	oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
	echo $i."  Inserted................<br/><br/>";
}
echo "\r\n".$i." Record(s) syncronized.............................";


?>