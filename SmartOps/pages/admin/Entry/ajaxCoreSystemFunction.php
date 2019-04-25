<?php
include('../../../php_con/includes/ordbcon.php');  // Oracle Database Conection .........................

//------ Get Data-----------------------------
if(isset($_POST['getaccnum']) ){
   // echo $_POST['getaccnum'];
    getRequestAccNum($dbConn,$_POST['getaccnum']);
}

if(isset($_POST['isOpen']) ){
    if ($_POST['isOpen'] == true){
        getDayAccountOpen($dbConn);
    }
    
}




function getRequestAccNum($dbConn , $AccountNo){
    
    $sql_oci_select_db = oci_parse($dbConn, "SELECT cdbproddb.pkg_mycdb_it.fn_account_closure(".$AccountNo.")  FROM DUAL");
    
    oci_execute($sql_oci_select_db);
    $i = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
        echo $row[0]."[ ". $AccountNo." ]";
    }
 
}

function getDayAccountOpen($dbConn){
      $sql_oci_select_db = oci_parse($dbConn, "SELECT cdbproddb.pkg_mycdb_it.fn_account_reopen FROM DUAL");
    
    oci_execute($sql_oci_select_db);
    $i = 1;
    ini_set('max_execution_time', 72000); //300 seconds = 5 minutes
    while (($row = oci_fetch_array($sql_oci_select_db, OCI_BOTH)) != false) {	//Read Oracle Source table
        echo $row[0];
    }
}





?>