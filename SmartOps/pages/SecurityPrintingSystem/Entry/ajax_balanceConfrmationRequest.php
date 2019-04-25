<?php

//.........................................Databse Connection .......................................................
function sqlDatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
}

function oracleDatabaseConnection(){
        $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
                    (CONNECT_DATA =
                      (SERVER = DEDICATED)
                      (SERVICE_NAME = cdbprod)))";
      $dbConn = oci_connect('cdberp','cdberp',$dbstr1);
      return $dbConn;
}

if(isset($_POST['settxtClientCode']) && isset($_POST['setEnrtyUser']) && isset($_POST['setJointPartyDetails']) && isset($_POST['setCashBackedLoanOutstanding']) && isset($_POST['setRedemptionCapability']) && isset($_POST['setchkNomineeDetails']) && isset($_POST['setsel_Embassy']) && isset($_POST['getCusName']) && isset($_POST['gettxtCustom_Address1']) && isset($_POST['gettxtCustom_Address2']) && isset($_POST['gettxtCustom_Address3']) && isset($_POST['gettxtCustom_Address4']) && isset($_POST['getgetList'])){
    //echo "Note IS ";
    //echo mysql_real_escape_string($_POST[getgetList]);
    //echo $_POST['settxtClientCode']."-".$_POST['setEnrtyUser']."-".$_POST['setJointPartyDetails']."-".$_POST['setCashBackedLoanOutstanding']."-".$_POST['setRedemptionCapability']."-".$_POST['setchkNomineeDetails']."-".$_POST['setsel_Embassy'];     : CusName ,  : txtCustom_Address1 ,  : txtCustom_Address2 ,  : txtCustom_Address3 ,  : txtCustom_Address4
    requestBalanceConfrmationRequest(trim($_POST['settxtClientCode']),trim($_POST['setEnrtyUser']),trim($_POST['setJointPartyDetails']),trim($_POST['setCashBackedLoanOutstanding']),trim($_POST['setRedemptionCapability']),trim($_POST['setchkNomineeDetails']),trim($_POST['setsel_Embassy']) , trim($_POST['getCusName']) , trim($_POST['gettxtCustom_Address1']) , trim($_POST['gettxtCustom_Address2']) , trim($_POST['gettxtCustom_Address3']) , trim($_POST['gettxtCustom_Address4']) , $_POST['getgetList']);
}

function requestBalanceConfrmationRequest($ClientCode,$EnrtyUser,$JointPartyDetails,$CashBackedLoanOutstanding,$RedemptionCapability,$chkNomineeDetails,$Embassy,$CusName,$Custom_Address1,$gettxtCustom_Address2,$Custom_Address3,$Custom_Address4,$getList){
    $sqlConn = sqlDatabaseConnection();
    $oracleConn = oracleDatabaseConnection();
    date_default_timezone_set("Asia/Calcutta");
    if(!$oracleConn){
    	//$err = OCIError();
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else {
    	//print "Connected to Oracle!";
    	//echo "Successfully connected to Oracle.<br/>";
    }
    $dateNew = "";
    $sql_date = "SELECT s.currentDate FROM systemdate AS s;";
    $query_date = mysqli_query($sqlConn , $sql_date) or die(mysqli_error($sqlConn));
    
    while($rec_date = mysqli_fetch_array($query_date)){
        //echo $rec_date[0]; 
       // $datef = date_create($rec_date[0]);
        //echo $datef;
        //$datef = "2018-05-28";
        $datef = date_create("2017-02-03");
        $dateNew = date_format($datef,"d-M-Y");
    }
    
    //$datef=date_create("2013-03-15");
   // echo $dateNew;
    //$b = 11;
    //$a = "31-MAR-2016";
    if($getList == 2){
        $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_emblet.get_balconf_data(".$ClientCode.",'".$dateNew."'))");
    }else{
        $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_emblet.get_emblet_data(".$ClientCode.",'".$dateNew."'))");
    }
    
    //select pkg_mycdb_emblet.get_balconf_data(11,sysdate) from dual

    //echo $OracleSelect;
    oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
   
    //echo "A";
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
      // echo "0 ".$rowSelect [0]."<br/>";
       //echo "1 ".$rowSelect [1]."<br/>";
       // echo "2 ".$rowSelect [2]."<br/>";
        //echo "3 ".$rowSelect [3]."<br/>";
        //echo "4 ".$rowSelect [4]."<br/>";
        //echo "5 ".$rowSelect [5]."<br/>";
       //$V_DEPTBL = $rowSelect [6]->load()."<br/>";
        //$V_SVTBL = $rowSelect [7]->load()."<br/>";
        //echo $rowSelect [8]->load()."<br/>";
        //echo "9 ".$rowSelect [9]."<br/>";
        //echo "10 ".$rowSelect [10]."<br/>";
        //echo "11 ".$rowSelect [11]."<br/>";
        //echo "14 ".$rowSelect [14]."<br/>";
        
       // echo "16 ".$rowSelect [16]."<br/>";
       if (!isset($rowSelect[10])) {
            $rowSelect[10] = "";
        }
        if(!isset($rowSelect[11])) {
            $rowSelect[11] = "";
        }
        if (!isset($rowSelect[12])) {
            $rowSelect[12] = "";
        }
       // echo "12 ".$rowSelect [12]."<br/>";
        if (!isset($rowSelect[13])) {
            $rowSelect[13] = "";
        }
        //echo "13 ".$rowSelect [13]."<br/>";
        if($rowSelect[15] == 0){
            $rowSelect [15] = 0.000;
        }
        //echo "15 ".$rowSelect [15]."<br/>";
        if (!isset($rowSelect[16])) {
            $rowSelect[16] = "0000-00-00";
        }
        
        if(!isset($rowSelect [17])){
            $rowSelect [17] = "";
        }
        //echo "16 ".$rowSelect [16]."<br/>";
    if($rowSelect [0] != "" || $rowSelect[4] != NULL){
        //$date = date_create($rowSelect[4]);
        //$V_JDATE =  date_format($date,"Y-m-d");
        $V_JDATE = $rowSelect[4];
        
        //echo $V_SVTBL;
        //$V_SVTBL = '';
        //$V_LIENSTAT = '';
        
        /*$sqlInset = "INSERT INTO `sps_balance_confirmation`(`CLIENT_CODE`, `V_NAME`, `V_ADD`, `V_NIC`, `V_NAME_INIT`, `V_JDATE`, `V_BALSUM`, `V_DEPTBL`, `V_SVTBL`, `V_LIENSTAT`, `print_stats`,`AUTH_1_BY`, `AUTH_1_DATE` ,`AUTH_2_BY`, `AUTH_2_DATE`,  `embassy_id`, `jointPartyDetails`, `cashBackedLoanOutstanding`, `redemptionCapability`, `nomineeDetails` , `cdb` ,`requestUser`, `V_NUMOFDEPS`, `V_JNAMESLIST`, `V_JNICLIST`, `V_NOMLIST`, `V_NOMNICLIST`, `V_DEPLINKCOUNT`, `V_CBOUTSUM`, `V_BASEDATE`, `V_DEPLINKS`) 
                                                    VALUES ('".$ClientCode."', '".$rowSelect [0]."', '".$rowSelect [1]."', '".$rowSelect [2]."', '".$rowSelect [3]."', '".$V_JDATE."', '".$rowSelect [5]."', '".$rowSelect [6]->load()."', '".$rowSelect [7]->load()."', '".$rowSelect [8]->load()."', 0,'', '0000-00-00 00:00:00' ,'', '0000-00-00 00:00:00', '".$Embassy."', '".$JointPartyDetails."', '".$CashBackedLoanOutstanding."', '".$RedemptionCapability."', '".$chkNomineeDetails."',NOW(),'".$EnrtyUser."', ".$rowSelect [9].", '".$rowSelect [10]."', '".$rowSelect [11]."', '".$rowSelect [12]."', '".$rowSelect [13]."', ".$rowSelect [14].", '".$rowSelect [15]."', '".$rowSelect [16]."' , '".$rowSelect [17]."');";
        */
        $sqlInset = "INSERT INTO `sps_balance_confirmation`(`CLIENT_CODE`, `V_NAME`, `V_ADD`, `V_NIC`, `V_NAME_INIT`, `V_JDATE`, `V_BALSUM`, `V_DEPTBL`, `V_SVTBL`, `V_LIENSTAT`, `print_stats`,`AUTH_1_BY`, `AUTH_1_DATE` ,`AUTH_2_BY`, `AUTH_2_DATE`,  `embassy_id`, `jointPartyDetails`, `cashBackedLoanOutstanding`, `redemptionCapability`, `nomineeDetails` , `cdb` ,`requestUser`, `V_NUMOFDEPS`, `V_JNAMESLIST`, `V_JNICLIST`, `V_NOMLIST`, `V_NOMNICLIST`, `V_DEPLINKCOUNT`, `V_CBOUTSUM`, `V_BASEDATE`, `V_DEPLINKS`,`CusName`,`Custom_Address1`,`Custom_Address2`,`Custom_Address3`,`Custom_Address4`,`docType`) 
                                                    VALUES ('".$ClientCode."', '".$rowSelect [0]."', '".$rowSelect [1]."', '".$rowSelect [2]."', '".$rowSelect [3]."', '".$V_JDATE."', '".$rowSelect [5]."', '".$rowSelect [6]->load()."', '".$rowSelect [7]->load()."', '".$rowSelect [8]->load()."', 0,'SYSTEM', NOW() ,'', '0000-00-00 00:00:00', '".$Embassy."', '".$JointPartyDetails."', '".$CashBackedLoanOutstanding."', '".$RedemptionCapability."', '".$chkNomineeDetails."',NOW(),'".$EnrtyUser."', ".$rowSelect [9].", '".$rowSelect [10]."', '".$rowSelect [11]."', '".$rowSelect [12]."', '".$rowSelect [13]."', ".$rowSelect [14].", '".$rowSelect [15]."', '".$rowSelect [16]."' , '".$rowSelect [17]."' ,'".$CusName."','".$Custom_Address1."','".$gettxtCustom_Address2."','".$Custom_Address3."','".$Custom_Address4."',".$getList.");";      
       // echo $sqlInset;
        $queryInsert = mysqli_query($sqlConn,$sqlInset) or die(mysqli_error($sqlConn));
        if($queryInsert){
            echo "Update Success.";
        }else{
            echo "Update Not Success.";
        }
    }else{
        echo "No Data.";
    }
        
    }

}




?>