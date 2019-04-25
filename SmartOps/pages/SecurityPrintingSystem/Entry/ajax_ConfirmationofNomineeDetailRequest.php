<?php
//------ DB Connection ------------
include('../../../php_con/includes/db.ini.php');
include('../../../php_con/includes/ordbcon.php');

//------ Get Data-----------------------------
if(isset($_POST['getAccountNo']) && isset($_POST['getContracNo']) && isset($_POST['getEnrtyUser'])){
    getRequest($conn,$dbConn,$_POST['getAccountNo'],$_POST['getContracNo'],$_POST['getEnrtyUser']);
}


//----- Function ----------------
function getRequest($sqlConn, $oracleConn, $AccountNo, $ContracNo, $EnrtyUser){
    //echo $AccountNo . " - " .$ContracNo . " - " .  $EnrtyUser;
    date_default_timezone_set("Asia/Calcutta"); // Date Zone
    
    if(!$oracleConn){
    	//$err = OCIError();
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else{
    	//print "Connected to Oracle!";
    	//echo "Successfully connected to Oracle.<br/>";
    }
    
    $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_emblet.getConfirOfNomidtl('".$AccountNo."',".$ContracNo."))");
    oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
   
    //echo "A";
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
        /*--------------------------------
         V_INDEX		    INT(12) Autonumber
       $rowSelect[0]  ACC_NO 		    Varchar 22
       $rowSelect[1]  CONT_NO 		    int 4
       $rowSelect[2]   DEP_AMOUNT     	Decimal (10,3) 
       $rowSelect[3]  NOMINEE_NAME   	varchar 100
       $rowSelect[4] OWN_PERCENT 		Decimal (4,4)
       $rowSelect[5]  NOMINEE_NIC 		Varchar 15
       $rowSelect[6]  NOMINEE_DOB 		Varchar 50
       $rowSelect[7]  NOMINEE_ADD1 		Varchar 100
       $rowSelect[8]  NOMINEE_ADD2 		Varchar 100
       $rowSelect[9]  NOMINEE_ADD3   	Varchar 100
       $rowSelect[10]  NOMINEE_ADD4   	Varchar 100
       $rowSelect[11]  NOMINEE_ADD5   	Varchar 100
       $rowSelect[12]  CLIENT_NAME    	Varchar 100
       $rowSelect[13]  CLIENT_ADD1    	Varchar 100
       $rowSelect[14]  CLIENT_ADD2    	Varchar 100
       $rowSelect[15]  CLIENT_ADD3    	Varchar 100
       $rowSelect[16]  CLIENT_ADD4    	Varchar 100
       $rowSelect[17]  CLIENT_ADD5    	Varchar 100
       $rowSelect[18]   CLIENT_LOCATION 	Varchar 100
         REQUEST_BY		    Varchar 10
         REQUEST_ON		    DATE AND TIME
         PRINT_STATUS		char 1
         AUTH_1_BY 		    Varchar 10
         AUTH_1_DATE		DATE AND TIME
         AUTH_2_BY		    Varchar 10
         AUTH_2_DATE		DATE AND TIME
         PRINT_BY		    Varchar 10
         PRINT_ON 		    DATE AND TIME
         --------------------------------------------------------*/
        //$NOMINEE_DOB = date_format($rowSelect[6],"Y-m-d");
        
        $sqlInset = "INSERT INTO sps_conf_nominee_dtl(ACC_NO,CONT_NO,DEP_AMOUNT,NOMINEE_NAME,OWN_PERCENT,NOMINEE_NIC,NOMINEE_DOB,NOMINEE_ADD1,NOMINEE_ADD2,NOMINEE_ADD3,NOMINEE_ADD4,NOMINEE_ADD5,CLIENT_NAME,CLIENT_ADD1,CLIENT_ADD2, CLIENT_ADD3,CLIENT_ADD4,CLIENT_ADD5,CLIENT_LOCATION,REQUEST_BY, REQUEST_ON,PRINT_STATUS,AUTH_1_BY, AUTH_1_DATE, AUTH_2_BY, AUTH_2_DATE, PRINT_BY, PRINT_ON) 
                          VALUES ('".$rowSelect[0]."',".$rowSelect[1].",'".$rowSelect[2]."','".$rowSelect[3]."','".$rowSelect[4]."','".$rowSelect[5]."','".$rowSelect[6]."','".$rowSelect[7]."','".$rowSelect[8]."','".$rowSelect[9]."','".$rowSelect[10]."','".$rowSelect[11]."','".$rowSelect[12]."','".$rowSelect[13]."','".$rowSelect[14]."', '".$rowSelect[15]."','".$rowSelect[16]."','".$rowSelect[17]."','".$rowSelect[18]."','".$EnrtyUser."', NOW(),'N','SYSTEM', NOW(), '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');";      
        //echo $sqlInset;
        $queryInsert = mysqli_query($sqlConn,$sqlInset) or die(mysqli_error($sqlConn));        
    }
    
    echo "Update Success.";
}

?>