<?php
//------ DB Connection ------------
include('../../../php_con/includes/db.ini.php');
include('../../../php_con/includes/ordbcon.php');

//------ Get Data-----------------------------
if(isset($_POST['getClientCode']) && isset($_POST['getEnrtyUser'])){
    //echo $_POST['getClientCode'] . " - ". $_POST['getEnrtyUser'];
      getRequest($conn,$dbConn,$_POST['getClientCode'],$_POST['getEnrtyUser']);
}


//----- Function ----------------
function getRequest($sqlConn, $oracleConn, $ClientCode, $EnrtyUser){
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
    
    $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_nominee.get_nominee_data(".$ClientCode."))");
    
    oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes

    //echo "A";
    $YEAR =  date("Y");
    $month = date('m');


    $sqlFunction ="SELECT GetNextSerial('NOMINEE_BU',".$YEAR.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
            $quary_Function = mysqli_query($sqlConn,$sqlFunction);
            while ($rec_Function = mysqli_fetch_array($quary_Function)){
                $batch_num = $rec_Function[0];
            }

    
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
        /*--------------------------------
                         V_INDEX		    INT(12) Autonumber
       $rowSelect[0]     REF_ID		        int 4
       $rowSelect[1]     CLIENT_CO   	    Decimal (10,3)
       $rowSelect[2]     V_ADDRESS   	    varchar 100
       $rowSelect[3]     V_BODY		        Decimal (4,4)
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
        $REF_ID = $YEAR."/".$month."/".$batch_num;
      //  echo $REF_ID."<br/>";
      //   echo $rowSelect[0]->load();
        $sqlInset = "INSERT INTO sps_conf_nominee_dtl_bulk(REF_ID,CLIENT_CO,V_ADDRESS,V_BODY,REQUEST_BY, REQUEST_ON,PRINT_STATUS,AUTH_1_BY, AUTH_1_DATE, AUTH_2_BY, AUTH_2_DATE, PRINT_BY, PRINT_ON) 
                          VALUES ('".$REF_ID."',".$ClientCode.",'".$rowSelect[1]->load()."','".$rowSelect[0]->load()."','".$EnrtyUser."', NOW(),'N','SYSTEM', NOW(), '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');";
        //echo $sqlInset;
        $queryInsert = mysqli_query($sqlConn,$sqlInset) or die(mysqli_error($sqlConn));
    }

    echo "Update Success.";
}

?>