
<?php
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
    
     
    if(isset($_POST['select_userID']) && isset($_POST['select_text']) && isset($_POST['select_helpID']) && isset($_POST['selsetRaisedUserID'])){
        //echo $_POST['select_userID']." - ".$_POST['select_text'];
        UnlockCoreBankUser(trim($_POST['select_helpID']),trim($_POST['select_text']),trim($_POST['select_userID']) ,trim($_POST['selsetRaisedUserID']));
    }
    

    function UnlockCoreBankUser($ErpHelpID , $ToBeUnlockedID , $UnlockedBy, $RequestedByID){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_helpdeskDtl = "SELECT chk.cat_code FROM cdb_helpdesk AS chk WHERE chk.helpid = '".$ErpHelpID."';";
            //echo $sql_helpdeskDtl;
            $query_helpdeskDtl = mysqli_query($conn,$sql_helpdeskDtl);
            while($rec_helpdeskDtl = mysqli_fetch_array($query_helpdeskDtl)){
                $helpdeskDtl = $rec_helpdeskDtl[0];
            }
            if($helpdeskDtl != 1001){
                //echo "Unauthorized Function.";
            }else{
                //if($RequestedByID != $ToBeUnlockedID) 
                    $RequestStatus = fn_UnlockCoreBankUser($ToBeUnlockedID,$UnlockedBy);
                //else{
                   // $RequestStatus = "XXX";
                //}
                
                //if ($RequestStatus=="S" || $RequestStatus = "XXX"){
                    
                 if ($RequestStatus=="S"){
                    // ERP Closure - $ErpHelpID
                    //if($RequestStatus=="S")
                        isServiceRequsetListInsert($ErpHelpID,"User Locked and Reqested to unlock","Usr Unlocked by ERP AI",$UnlockedBy);
                    //else
                       // isServiceRequsetListInsert($ErpHelpID,"User Locked and Reqested to unlock","User Unlock Failed due to access denied. ERP AI",$UnlockedBy);
                       // eMail Queue - Requested Core bank unlock was processed. Now you can login to system
                    
                    //if($RequestStatus=="S")
                        $MailBody = "Employee ID  : ".$ToBeUnlockedID."<br/>". 
                                "Help ID  : ".$ErpHelpID."<br/>".
                                "Date & Time      : ".date("Y-m-d h:i:sa");
                    //else
                      /*  $MailBody = "Request Rejected. Requesting officer and Locked user should me same."."<br/>". 
                                    "Employee ID  : ".$ToBeUnlockedID."<br/>". 
                                    "Help ID  : ".$ErpHelpID."<br/>".
                                    "Date & Time      : ".date("Y-m-d h:i:sa");*/
                    $sql_getUserDtl = "SELECT u.email  FROM cdb_helpdesk AS chk , user AS u WHERE chk.enterBy = u.userName AND chk.helpid = '".$ErpHelpID."';";
                    $query_getUserDtl = mysqli_query($conn,$sql_getUserDtl);
                    while($rec_getUserDtl = mysqli_fetch_array($query_getUserDtl)){
                        $toMailAddress = $rec_getUserDtl[0];
                    }
                    if($toMailAddress != ""){
                        if($RequestStatus=="S")
                            sendingMail($toMailAddress,"CDB SmartOps - Issue Closure on Corebank Unlock request",$MailBody);
                        else  
                            sendingMail($toMailAddress,"CDB SmartOps - Issue Closure - Corebank Unlock request was rejected",$MailBody);
                    }
                    mysqli_commit($conn);
                    echo "Success Updated.";
                }else{
                    echo "Error";
                }
            }
            
    	}catch(Exception $e){  // Rollback transaction
    		mysqli_rollback($conn);
    		echo 'Message: ' .$e->getMessage();
    	} 
    }  
        
    
function fn_UnlockCoreBankUser($ToBeUnlockedID,$UnlockedBy){
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 'Off');
    $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = cdbprod)))"; // Connect to an Oracle SERVER .
    
    $dbConn = oci_connect('cdberp','cdberp',$dbstr1);   // Connect to an Oracle database.
    date_default_timezone_set("Asia/Colombo");          // get the time Zone.
    
    if(!$dbConn){
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else { }
    
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    if (mysqli_connect_errno($conn)){ // Check connection
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $ReturnValueofProc = "S";
    $stid = oci_parse($dbConn, $sql);
    $sql = "begin cdbproddb.pkg_cdb_erp_lib.SP_CORE_USER_UNLOCK('".$ToBeUnlockedID."','".$UnlockedBy."',:p_error); end;";
    //echo $sql;
    $stid = oci_parse($dbConn, $sql);
    oci_bind_by_name($stid, ':p_error', $ReturnValueofProc , 2000);
    $r = oci_execute($stid);
    oci_free_statement($stid);
    return $ReturnValueofProc;
}
?>