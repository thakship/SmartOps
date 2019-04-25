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

$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(REPLACE(ACCOUNT_NAME,',',' '),'\',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE STAT = '0'");
//$stid = oci_parse($dbConn, "SELECT ACCOUNT_NO,REPLACE(ACCOUNT_NAME,',',' ') AS ACCOUNT_NAME,PRODUCT_NAME,NVL(ACTYPES_NAME,' ') AS ACTYPES_NAME,NVL(SCHEME_NAME,' ') AS SCHEME_NAME,TP,STAT,TO_CHAR(SYNC_DATE,'YYYY-MM-DD') AS SYNC_DATE,INTERNAL_NO,CONTNO  FROM cdbproddb.CDBERP_Docline_FILES WHERE ACCOUNT_NO = '005500304288100401'");
oci_execute($stid);
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
	echo $row[0];
	//&& isset($row[1]) && isset($row[2]) && isset($row[3]) && isset($row[4])  && isset($row[5]) && isset($row[7]) && isset($row[8]) && isset($row[9])
	if (isset($row[4])){
		$i++;
		echo "\r\n".$i."  Record(s) reading................<br/>";
		//Insert Records to mySQl data table
		echo "\r\n".$i."  Inserting................<br/>";	
        $sql_s = "SELECT COUNT(*) FROM doc_line_doc_mast AS a WHERE a.doc_number = '".$row[0]."'";
        $query_s = mysqli_query($conn,$sql_s) or die(mysqli_error($conn));
        while($rec_s = mysqli_fetch_array($query_s)){
            if($rec_s[0] == 0){
                $v_sql_mysql_insert = "INSERT INTO `doc_line_doc_mast`(`doc_number`, `doc_name`, `prod_name`, `acc_type`, `scheme`, `TP`, `STAT`, `SYNC_DATE`, `INTERNAL_NO`, `CONTNO`) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]',1,'$row[7]',$row[8],$row[9])";
        		echo  $v_sql_mysql_insert;
        		$query1 = mysqli_query($conn,$v_sql_mysql_insert) or die(mysqli_error($conn));
        		echo "\r\n".$i."  Inserted................<br/>";
        		//Update the Oracle table as read
        		echo "\r\n".$i."  updating................";
        		$v_sql = oci_parse($dbConn, "UPDATE cdbproddb.CDBERP_Docline_FILES CCD SET CCD.STAT = '1' WHERE CCD.INTERNAL_NO = '".$row[8]."' AND CCD.CONTNO = '".$row[9]."' AND CCD.STAT = '0'");
                echo "UPDATE cdbproddb.CDBERP_Docline_FILES CCD SET CCD.STAT = '1' WHERE CCD.INTERNAL_NO = '".$row[8]."' AND CCD.CONTNO = '".$row[9]."' AND CCD.STAT = '0'";
        		oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
        		echo "\r\n".$i."  updated................<br/>";
            }
        }
		
	} 
}
echo "\r\n".$i." Record(s) syncronized.............................<br/>";

//-----------------------------   Start Instant Card  data update  --------------------------------------------------------------------------

$sql_inc_card = "SELECT i.V_INDEX AS V_INDEX , 
                        i.ACCOUNT_NO_1 AS ACCOUNT_NO_1 ,
                        i.cif AS CIF
                   FROM card_header_ins AS i
                  WHERE i.read_status = 0;";
$query_inc_card = mysqli_query($conn, $sql_inc_card) or die(mysqli_error($conn));
while($resalt_inc_card = mysqli_fetch_array($query_inc_card)){
    //0038 00202231 000501   
    //echo $resalt_inc_card[0]."|".(int)substr($resalt_inc_card[1],4,8)."<br/>";
   // echo $resalt_inc_card[2]."<br/>";
    if($resalt_inc_card[2] != 0){
        $q = 1;
         $oracle_sql_inc_card = oci_parse($dbConn, "select * from table(CDBPRODDB.CDB_ERP_GETCUSTINFO.FN_GETCUST_INFO(".(int)$resalt_inc_card[2]."))");     
        // echo "1 ".$resalt_inc_card[2]." - select * from table(CDBPRODDB.CDB_ERP_GETCUSTINFO.FN_GETCUST_INFO(".(int)$resalt_inc_card[2]."))"."<br/>";
        
    }else{
         $oracle_sql_inc_card = oci_parse($dbConn, "select * from table(CDBPRODDB.CDB_ERP_GETCUSTINFO.FN_GETCUST_INFO(".(int)substr($resalt_inc_card[1],4,8)."))");
        // echo "2 ".$resalt_inc_card[2]." - select * from table(CDBPRODDB.CDB_ERP_GETCUSTINFO.FN_GETCUST_INFO(".(int)substr($resalt_inc_card[1],4,8)."))"."<br/>";
         
         $q = 2;
    }
   // echo $q."<br/>" ;
   // echo "select * from table(CDBPRODDB.CDB_ERP_GETCUSTINFO.FN_GETCUST_INFO(".(int)substr($resalt_inc_card[1],4,8)."))<br/>";
    /*
    0 CLIENT_TITLE	     Mr.
    1 CLIENT_NAME	     Mr.A.K.M.RIZVI
    2 NIC	             800371651V
    3 ADDRESS_1	         8A-71
    4 ADDRESS_2	         JAYAWADANAGAMA
    5 ADDRESS_3	         BATTARAMULLA
    6 ADDRESS_4	          
    7 ADDRESS_5	          
    8 CITY	             BATTARAMULLA
    9 DOB	             06-FEB-1980
   10 GSM	             0772906143

    */
    
    oci_execute($oracle_sql_inc_card);
    //echo "A";
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
    
    while (($row_inc = oci_fetch_array($oracle_sql_inc_card, OCI_BOTH)) != false) {	//Read Oracle Source table
    	 //echo $row_inc[0];
        $sql_update = "UPDATE card_header_ins AS u
                            SET u.CLIENT_TITLE = '".$row_inc[0]."',
                                u.CLIENT_NAME = '".$row_inc[1]."',
                                u.NIC = '".$row_inc[2]."',
                                u.ADDRESS_1 = '".$row_inc[3]."',
                                u.ADDRESS_2 = '".$row_inc[4]."',
                                u.ADDRESS_3 = '".$row_inc[5]."',
                                u.ADDRESS_4 = '".$row_inc[6]."',
                                u.ADDRESS_5 = '".$row_inc[7]."',
                                u.CITY = '".$row_inc[8]."',
                                u.DOB = '".$row_inc[9]."',
                                u.GSM = '".$row_inc[10]."',
                                u.read_status = 1
                            WHERE u.V_INDEX = ".$resalt_inc_card[0]." AND u.ACCOUNT_NO_1 = '".$resalt_inc_card[1]."';";
       // echo $sql_update."<br/>";
        $query_update = mysqli_query($conn,$sql_update) or die(mysqli_errno($conn));
        if($query_update){
           echo "V_INDEX : ".$resalt_inc_card[0]." AND ACCOUNT_NO_1 : ".$resalt_inc_card[1]." - OK<br/>"; 
        }else{
           echo "V_INDEX : ".$resalt_inc_card[0]." AND ACCOUNT_NO_1 : ".$resalt_inc_card[1]." - ERROR<br/>";  
        }
        
    }
    
    
}


?>