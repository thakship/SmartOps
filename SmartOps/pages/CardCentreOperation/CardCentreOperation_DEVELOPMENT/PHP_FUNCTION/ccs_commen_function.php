<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

$conn = DatabaseConnection();

if(isset($_POST['getSolutionType']) && isset($_POST['getRequestId']) && isset($_POST['getComment']) && isset($_POST['getEntryUserId'])){
       
       $isComment = mysqli_real_escape_string($conn , $_POST['getComment']); // unvanted distroie caractors.
       
       if(trim($_POST['getSolutionType']) == "P"){
            isRequestAuthPending($conn,trim($_POST['getRequestId']),trim($isComment),trim($_POST['getEntryUserId']));
       }else if(trim($_POST['getSolutionType']) == "A"){
            isRequestAuthApprove($conn,trim($_POST['getRequestId']),trim($isComment),trim($_POST['getEntryUserId']));
       }else if(trim($_POST['getSolutionType']) == "R"){
            isRequestAuthReject($conn,trim($_POST['getRequestId']),trim($isComment),trim($_POST['getEntryUserId']));
       }else if(trim($_POST['getSolutionType']) == "I"){
            isRequestCardIssue($conn,trim($_POST['getRequestId']),trim($isComment),trim($_POST['getEntryUserId']));
       }else if(trim($_POST['getSolutionType']) == "B"){
            isRequestBageBack($conn,trim($_POST['getRequestId']),trim($isComment),trim($_POST['getEntryUserId']));
       }else{
            echo "Solution Type is Invaled.";
       } 
}

if(isset($_POST['getBatchCreationString']) && isset($_POST['getentryUser'])){
     isBatchCreation($conn,trim($_POST['getBatchCreationString']),trim($_POST['getentryUser']));
}

if(isset($_POST['getDebitBatch']) && isset($_POST['getDebitBatchEntryUser'])){
     isSendToDebit($conn,trim($_POST['getDebitBatch']),trim($_POST['getDebitBatchEntryUser']));
}

if(isset($_POST['getComBatch']) && isset($_POST['getComEntryUser'])){
     isSendToComBank($conn,trim($_POST['getComBatch']),trim($_POST['getComEntryUser']));
}

if(isset($_POST['getReceiveHeaderID']) && isset($_POST['getDebitCardNumber']) && isset($_POST['getReceiveEntryUser'])){
     isReceiveCard($conn,trim($_POST['getReceiveHeaderID']),trim($_POST['getDebitCardNumber']),trim($_POST['getReceiveEntryUser']));
}

if(isset($_POST['getSendBranchString']) && isset($_POST['sendBranch']) && isset($_POST['getSendBranchentryUser'])){
     isSendToBranch($conn,trim($_POST['getSendBranchString']),trim($_POST['sendBranch']),trim($_POST['getSendBranchentryUser']));
}

if(isset($_POST['isEntryUser']) && isset($_POST['isAcc_01']) && isset($_POST['isAcc_02']) && isset($_POST['isAcc_03']) && isset($_POST['isAcc_04']) && isset($_POST['isApp_Received_date']) && isset($_POST['isAcc_Opening_Date']) && isset($_POST['isClint_title']) && isset($_POST['isClint_Name']) && isset($_POST['isEmbossing_Name']) && isset($_POST['isCollecting_Branch']) && isset($_POST['isHome_Branch']) && isset($_POST['isCIF']) && isset($_POST['isNIC']) && isset($_POST['isDOB']) && isset($_POST['isMother_Maiden_Name']) && isset($_POST['isMobile_Number']) && isset($_POST['isHome_TP']) && isset($_POST['isSal_Plus_Category']) && isset($_POST['isPrevious_Card_No']) && isset($_POST['isIntroducerCode']) && isset($_POST['isIntroducerBranchCode']) && isset($_POST['isWithdrawal_Limit']) && isset($_POST['isPurchasingLimit']) && isset($_POST['isadd1']) && isset($_POST['isadd2']) && isset($_POST['isadd3']) && isset($_POST['isadd4']) && isset($_POST['isadd5']) && isset($_POST['iscity']) && isset($_POST['isentryBranch']) && isset($_POST['isentryDepartment'])){ //  : entryBranch ,  : entryDepartment
    isDebitCardRequest($conn,trim($_POST['isEntryUser']),trim($_POST['isAcc_01']) ,trim($_POST['isAcc_02']) ,trim($_POST['isAcc_03']) ,trim($_POST['isAcc_04']) ,trim($_POST['isApp_Received_date']) ,trim($_POST['isAcc_Opening_Date']) ,trim($_POST['isClint_title']) ,trim($_POST['isClint_Name']) ,trim($_POST['isEmbossing_Name']) ,trim($_POST['isCollecting_Branch']) ,trim($_POST['isHome_Branch']) ,trim($_POST['isCIF']) ,trim($_POST['isNIC']) ,trim($_POST['isDOB']) ,trim($_POST['isMother_Maiden_Name']) ,trim($_POST['isMobile_Number']) ,trim($_POST['isHome_TP']) ,trim($_POST['isSal_Plus_Category']) ,trim($_POST['isPrevious_Card_No']) ,trim($_POST['isIntroducerCode']) ,trim($_POST['isIntroducerBranchCode']) ,trim($_POST['isWithdrawal_Limit']) ,trim($_POST['isPurchasingLimit']) ,trim($_POST['isadd1']) ,trim($_POST['isadd2']) ,trim($_POST['isadd3']) ,trim($_POST['isadd4']) ,trim($_POST['isadd5']) ,trim($_POST['iscity']), trim($_POST['isentryBranch']), trim($_POST['isentryDepartment']));
}

if(isset($_POST['isgetHeadIDE']) && isset($_POST['isEntryUserE']) && isset($_POST['isAcc_01E']) && isset($_POST['isAcc_02E']) && isset($_POST['isAcc_03E']) && isset($_POST['isAcc_04E']) && isset($_POST['isApp_Received_dateE']) && isset($_POST['isAcc_Opening_DateE']) && isset($_POST['isClint_titleE']) && isset($_POST['isClint_NameE']) && isset($_POST['isEmbossing_NameE']) && isset($_POST['isCollecting_BranchE']) && isset($_POST['isHome_BranchE']) && isset($_POST['isCIFE']) && isset($_POST['isNICE']) && isset($_POST['isDOBE']) && isset($_POST['isMother_Maiden_NameE']) && isset($_POST['isMobile_NumberE']) && isset($_POST['isHome_TPE']) && isset($_POST['isSal_Plus_CategoryE']) && isset($_POST['isPrevious_Card_NoE']) && isset($_POST['isIntroducerCodeE']) && isset($_POST['isIntroducerBranchCodeE']) && isset($_POST['isWithdrawal_LimitE']) && isset($_POST['isPurchasingLimitE']) && isset($_POST['isadd1E']) && isset($_POST['isadd2E']) && isset($_POST['isadd3E']) && isset($_POST['isadd4E']) && isset($_POST['isadd5E']) && isset($_POST['iscityE'])){
    isDebitCardEidt($conn,trim($_POST['isgetHeadIDE']),trim($_POST['isEntryUserE']),trim($_POST['isAcc_01E']) ,trim($_POST['isAcc_02E']) ,trim($_POST['isAcc_03E']) ,trim($_POST['isAcc_04E']) ,trim($_POST['isApp_Received_dateE']) ,trim($_POST['isAcc_Opening_DateE']) ,trim($_POST['isClint_titleE']) ,trim($_POST['isClint_NameE']) ,trim($_POST['isEmbossing_NameE']) ,trim($_POST['isCollecting_BranchE']) ,trim($_POST['isHome_BranchE']) ,trim($_POST['isCIFE']) ,trim($_POST['isNICE']) ,trim($_POST['isDOBE']) ,trim($_POST['isMother_Maiden_NameE']) ,trim($_POST['isMobile_NumberE']) ,trim($_POST['isHome_TPE']) ,trim($_POST['isSal_Plus_CategoryE']) ,trim($_POST['isPrevious_Card_NoE']) ,trim($_POST['isIntroducerCodeE']) ,trim($_POST['isIntroducerBranchCodeE']) ,trim($_POST['isWithdrawal_LimitE']) ,trim($_POST['isPurchasingLimitE']) ,trim($_POST['isadd1E']) ,trim($_POST['isadd2E']) ,trim($_POST['isadd3E']) ,trim($_POST['isadd4E']) ,trim($_POST['isadd5E']) ,trim($_POST['iscityE']));
}

// ----------------------- End Comment Insert Function   -----------------------------------
function dbRowInsert($conn, $table_name, $form_data){
    date_default_timezone_set('Asia/Colombo');
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);
    // build the query
    
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES(";
    
    $qq = "DESCRIBE ".$table_name.";";
    $q = mysqli_query($conn,$qq);
    $arrCount = 0;
    $sets = array();
    while($row = mysqli_fetch_array($q)) {
        $DataType = explode("(",$row[1]);
        $column = $row[0];
        if($DataType[0] == "tinyint" || $DataType[0] == "smallint" || $DataType[0] == "mediumint" || $DataType[0] == "int" || $DataType[0] == "bigint" || $DataType[0] == "bit" || $DataType[0] == "float" || $DataType[0] == "double" || $DataType[0] == "decimal"){
                 if(isset($form_data[$column])){
                    $sets[] = $form_data[$column];
                 }
                 
        }else{
             if(isset($form_data[$column])){
                $sets[] = "'".$form_data[$column]."'";
             }
        }
        $arrCount++;
        
    }
    $sql .= implode(', ', $sets);
    $sql .= ");";
    //echo $sql;
    /*$sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";*/
    // run and return the query result resource
    //echo $sql;
    $query_run = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    if($query_run){
        return 1;
    }else{
        return 0;
    }
}
// ----------------------- End Comment Insert Function   -----------------------------------
// ----------------------- Start Comment Update Function   -----------------------------------
function dbRowUpdate($conn,$table_name, $set_data, $where_clause){
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        }else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    
    
    $qq = "DESCRIBE ".$table_name.";";
    $q = mysqli_query($conn,$qq);
    $arrCount = 0;
    $sets = array();
    while($row = mysqli_fetch_array($q)) {
        $DataType = explode("(",$row[1]);
        $column = $row[0];
        if($DataType[0] == "tinyint" || $DataType[0] == "smallint" || $DataType[0] == "mediumint" || $DataType[0] == "int" || $DataType[0] == "bigint" || $DataType[0] == "bit" || $DataType[0] == "float" || $DataType[0] == "double" || $DataType[0] == "decimal"){
                 if(isset($set_data[$column])){
                    //$sets[] = $set_data[$column];
                     $sets[] = "`".$column."` = ".$set_data[$column];
                 }
                 
        }else{
             if(isset($set_data[$column])){
                $sets[] =  "`".$column."` = '".$set_data[$column]."'";
             }
        }
        $arrCount++;
        
    }
    
    
    
    
    // loop and build the column /
    /*$sets = array();
    foreach($set_data as $column => $value){
         $sets[] = "`".$column."` = '".$value."'";
    }*/
    $sql .= implode(', ', $sets);
    // append the where statement
    $sql .= $whereSQL;
    // run and return the query result
    
    //echo $sql;
    $query_run = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    if($query_run){
        return 1;
    }else{
        return 0;
    }
}
// ----------------------- End Comment Update Function   -----------------------------------
// ----------------------- Start Comment Note table Update Function   -----------------------------------
function CreateNote($ConnERP , $HEADER_ID, $NOTE,$USER){
    date_default_timezone_set('Asia/Colombo');
    /*Get the Max count of Note*/
    $table_name = "card_note";
    $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
    $form_data = array(
        'HEADER_ID' => $HEADER_ID,
        'DESCRIPTION' => $NOTE,
        'ENTRY_BY' => $USER,
        'ENTRY_ON' => $newTime,
    );
    return dbRowInsert($ConnERP, $table_name, $form_data);
}  
// ----------------------- End Comment Note table Update Function   -----------------------------------
// ----------------------- Start Comment CC Histry tbl Update Function   -----------------------------------
function updateHistryTbl($ConnERP , $HEADER_ID){
    date_default_timezone_set('Asia/Colombo');
    /*Get the Max count of Note*/
    
    $sql_header = "SELECT * FROM card_header AS ch WHERE ch.HEADER_ID = '".$HEADER_ID."';";
    $query_header = mysqli_query($ConnERP,$sql_header) or die(mysqli_error($ConnERP));
    $rowcount = mysqli_num_rows($query_header);
    if($rowcount == 1){
        while($resalt_header = mysqli_fetch_assoc($query_header)){
            $table_name = "card_header_hist";
            $form_data = array(
                'HEADER_ID' => $resalt_header['HEADER_ID'],
                'APP_RECEIVED_DATE' => $resalt_header['APP_RECEIVED_DATE'],
                'ACC_OPENING_DATE' => $resalt_header['ACC_OPENING_DATE'],
                'CLIENT_TITLE' => $resalt_header['CLIENT_TITLE'],
                'CLIENT_NAME' => $resalt_header['CLIENT_NAME'],
                'COLLECTING_BRANCH' => $resalt_header['COLLECTING_BRANCH'],
                'HOME_BRANCH' => $resalt_header['HOME_BRANCH'],
                'CIF' => $resalt_header['CIF'],
                'NIC' => $resalt_header['NIC'],
                'ADDRESS_1' => $resalt_header['ADDRESS_1'],
                'ADDRESS_2' => $resalt_header['ADDRESS_2'],
                'ADDRESS_3' => $resalt_header['ADDRESS_3'],
                'ADDRESS_4' => $resalt_header['ADDRESS_4'],
                'ADDRESS_5' => $resalt_header['ADDRESS_5'],
                'CITY' => $resalt_header['CITY'],
                'ACCOUNT_NO_1' => $resalt_header['ACCOUNT_NO_1'],
                'ACCOUNT_NO_2' => $resalt_header['ACCOUNT_NO_2'],
                'ACCOUNT_NO_3' => $resalt_header['ACCOUNT_NO_3'],
                'ACCOUNT_NO_4' => $resalt_header['ACCOUNT_NO_4'],
                'DOB' => $resalt_header['DOB'],
                'MOTHER_MAIDEN_NAME' => $resalt_header['MOTHER_MAIDEN_NAME'],
                'GSM' => $resalt_header['GSM'],
                'HOME_GSM' => $resalt_header['HOME_GSM'],
                'SAL_PLUS_CATEGORY_ID' => $resalt_header['SAL_PLUS_CATEGORY_ID'],
                'PREVIOUS_CARD_NUMBER' => $resalt_header['PREVIOUS_CARD_NUMBER'],
                'INTRODUCER_BRANCH' => $resalt_header['INTRODUCER_BRANCH'],
                'INTRODUCER' => $resalt_header['INTRODUCER'],
                'CARD_STATE' => $resalt_header['CARD_STATE'],
                'ENTRY_BY' => $resalt_header['ENTRY_BY'],
                'ENTRY_ON' => $resalt_header['ENTRY_ON'],
                'MOD_BY' => $resalt_header['MOD_BY'],
                'MOD_ON' => $resalt_header['MOD_ON'],
                'WITHDRAWAL_LIMIT' => $resalt_header['WITHDRAWAL_LIMIT'],
                'PURCHASING_LIMIT' => $resalt_header['PURCHASING_LIMIT'],
                'EMBOSSING_NAME' => $resalt_header['EMBOSSING_NAME'],
                'AUTH_STATUS' => $resalt_header['AUTH_STATUS'],
                'AUTH_BY' => $resalt_header['AUTH_BY'],
                'AUTH_ON' => $resalt_header['AUTH_ON'],
                'BATCH_NO' => $resalt_header['BATCH_NO'],
                'FIN_STATS' => $resalt_header['FIN_STATS'],
                'COM_SENT_BY' => $resalt_header['COM_SENT_BY'],
                'COM_SENT_ON' => $resalt_header['COM_SENT_ON'],
                'DEBIT_CARD_NUMBER' => $resalt_header['DEBIT_CARD_NUMBER'],
                'PREVIOUS_ACCOUNT_NO' => $resalt_header['PREVIOUS_ACCOUNT_NO'],
                'EXPIARY_DATE' => $resalt_header['EXPIARY_DATE'],
                'COM_DISPATCH_BY' => $resalt_header['COM_DISPATCH_BY'],
                'COM_DISPATCH_ON' => $resalt_header['COM_DISPATCH_ON'],
                'BRANCH_SENT_BY' => $resalt_header['BRANCH_SENT_BY'],
                'BRANCH_SENT_ON' => $resalt_header['BRANCH_SENT_ON'],
                'BRANCH_RECEIVE_BY' => $resalt_header['BRANCH_RECEIVE_BY'],
                'BRANCH_RECEIVE_ON' => $resalt_header['BRANCH_RECEIVE_ON'],
                'CLIENT_ISS_BY' => $resalt_header['CLIENT_ISS_BY'],
                'CLIENT_ISS_ON' => $resalt_header['CLIENT_ISS_ON'],
                'ACC_FREES' => $resalt_header['ACC_FREES'],
                'ACC_INOPERATIVE' => $resalt_header['ACC_INOPERATIVE'],
                'ACC_AVLBLE' => $resalt_header['ACC_AVLBLE'],
                'isCharge' => $resalt_header['isCharge'],
                'ENTRY_BRANCH' => $resalt_header['ENTRY_BRANCH'],
                'ENTRY_DEPARTMENT' => $resalt_header['ENTRY_DEPARTMENT'],
            );
            dbRowInsert($ConnERP, $table_name, $form_data);
        }
    }else{
        return 0;
    }
}  
// ----------------------- End Comment CC Histry tbl Update Function   -----------------------------------
// ----------------------- Start Request Authorization - Pending Notified function -----------------------------------

function isRequestAuthPending($conn,$isRequestId,$isComment,$isEntryUserId){
   // echo "P - ". $isRequestId." - ".$isComment." - ".$isEntryUserId;
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         updateHistryTbl($conn , $isRequestId);
         
         $table_name = "card_header";
         // Update Date values and fils
         $set_data = array(
            'CARD_STATE' => "Application - Pending",
            'AUTH_STATUS' => 3,
         );
         $where_clause = "WHERE `HEADER_ID` = ".$isRequestId.";"; // Update Where Clause.
         
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         $returnInsete = CreateNote($conn , $isRequestId, "Application - Pending. ".$isComment, $isEntryUserId);
         //echo " H - ".$returnUpdate."<br/>";
         //echo " N - ".$returnInsete."<br/>";
         $SQL_SELECT_BAG = "SELECT ch.ENTRY_BY ,ch.ACCOUNT_NO_1 , ch.CLIENT_NAME , ch.NIC , ch.CIF
                              FROM card_header AS ch 
                             WHERE ch.HEADER_ID = '".$isRequestId."';";
         $QURERY_SELECT_BAG = mysqli_query($conn,$SQL_SELECT_BAG) or die(mysqli_error($conn));
         while($REC_SELECT_BAG = mysqli_fetch_array($QURERY_SELECT_BAG)){
            $ENTRY_BY = $REC_SELECT_BAG[0];
            $ACCOUNT_NO_1 = $REC_SELECT_BAG[1];
            $CLIENT_NAME = $REC_SELECT_BAG[2];
            $NIC = $REC_SELECT_BAG[3];
            $CIF = $REC_SELECT_BAG[4];
             $sql_get_userdtl = "SELECT u.email FROM user AS u WHERE u.userName = '".$ENTRY_BY."'";
             $query_get_userdtl = mysqli_query($conn,$sql_get_userdtl) or die(mysqli_error($conn));
             while($rec_get_userdtl = mysqli_fetch_array($query_get_userdtl)){
                if($rec_get_userdtl[0] != ""){
                    $MailBody  ="Client Name    : ".$CLIENT_NAME." <br/>".
                                "NIC Number     : ".$NIC."<br/>".
                                "Client Code    : ".$CIF."<br/>". 
                                "Account Number : ".$ACCOUNT_NO_1."<br/><br/>". 
                                $isComment."<br/>";
                    sendingMail($rec_get_userdtl[0],"Debit Card Application - Pending",$MailBody); 
                }
             }
         }
         
         
         if($returnUpdate == 1 && $returnInsete == 1){
            mysqli_commit($conn);
            echo "Pending is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Pending is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
    
}
// ----------------------- End Request Authorization - Pending Notified function -----------------------------------
// ----------------------- Start Request Authorization - Approve function -----------------------------------
function isRequestAuthApprove($conn,$isRequestId,$isComment,$isEntryUserId){
    //echo "A - ". $isRequestId." - ".$isComment." - ".$isEntryUserId;
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         updateHistryTbl($conn , $isRequestId);
         
         $table_name = "card_header";
         
         // Update Date values and fils
         $set_data = array(
            'CARD_STATE' => "Application - Approve",
            'AUTH_STATUS' => 1,
            'AUTH_BY' => $isEntryUserId,
            'AUTH_ON' => $newTime,
         );
         
         $where_clause = "WHERE `HEADER_ID` = ".$isRequestId." AND `ACC_FREES` = 0 AND `ACC_INOPERATIVE` = 0;"; // Update Where Clause.
         
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         $returnInsete = CreateNote($conn , $isRequestId, "Application - Approve ".$isComment, $isEntryUserId);
         if($returnUpdate == 1 && $returnInsete == 1){
            mysqli_commit($conn);
            echo "Approve is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Approve is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}
// ----------------------- End Request Authorization - Approve function -----------------------------------



function isRequestBageBack($conn,$isRequestId,$isComment,$isEntryUserId){
    //echo "A - ". $isRequestId." - ".$isComment." - ".$isEntryUserId;
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         updateHistryTbl($conn , $isRequestId);
         $SQL_SELECT_BAG = "SELECT ch.BATCH_NO 
                              FROM card_header AS ch 
                             WHERE ch.HEADER_ID = '".$isRequestId."';";
         $QURERY_SELECT_BAG = mysqli_query($conn,$SQL_SELECT_BAG) or die(mysqli_error($conn));
         while($REC_SELECT_BAG = mysqli_fetch_array($QURERY_SELECT_BAG)){
            $bage_number = $REC_SELECT_BAG[0];
         }
         $table_name = "card_header";
         
         // Update Date values and fils
         $set_data = array(
            'CARD_STATE' => "Application - Back to Authorization Level",
            'AUTH_STATUS' => 0,
            'AUTH_BY' => "",
            'AUTH_ON' => "0000-00-00 00:00:00",
            'BATCH_NO' => 0,
            'FIN_STATS' => 0,
         );
         
         $where_clause = "WHERE `HEADER_ID` = ".$isRequestId.";"; // Update Where Clause.
         
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
         $sql_number_of_b = "SELECT bh.NUM_ACCS
                            FROM card_batch_header AS bh
                            WHERE bh.BATCH_ID = ".$bage_number.";";
         $query_number_of_b = mysqli_query($conn,$sql_number_of_b) or die(mysqli_error($conn));
         while($rec_number_of_b = mysqli_fetch_array($query_number_of_b)){
            $num_of_acc = $rec_number_of_b[0]-1;
             $table_name = "card_batch_header";
             // Update Date values and fils
             $set_data = array(
                'NUM_ACCS' => $num_of_acc,
             );
             
             $where_clause = "WHERE `BATCH_ID` = ".$bage_number.";"; // Update Where Clause.
             $returnUpdate11 = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         }
        
         $returnInsete = CreateNote($conn , $isRequestId, "Application - Back to Authorization Level - ".$isComment, $isEntryUserId);
         if($returnUpdate == 1 && $returnInsete == 1){
            mysqli_commit($conn);
            echo "Back to Authorization Level is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Back to Authorization Level is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

// ----------------------- Start Request Authorization - Reject function -----------------------------------
function isRequestAuthReject($conn,$isRequestId,$isComment,$isEntryUserId){
    // echo "R - ". $isRequestId." - ".$isComment." - ".$isEntryUserId;
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         updateHistryTbl($conn , $isRequestId);
         $SQL_SELECT_BAG = "SELECT ch.BATCH_NO , ch.ENTRY_BY ,ch.ACCOUNT_NO_1 , ch.CLIENT_NAME , ch.NIC , ch.CIF
                              FROM card_header AS ch 
                             WHERE ch.HEADER_ID = '".$isRequestId."';";
         $QURERY_SELECT_BAG = mysqli_query($conn,$SQL_SELECT_BAG) or die(mysqli_error($conn));
         while($REC_SELECT_BAG = mysqli_fetch_array($QURERY_SELECT_BAG)){
            $bage_number = $REC_SELECT_BAG[0];
            $ENTRY_BY = $REC_SELECT_BAG[1];
            $ACCOUNT_NO_1 = $REC_SELECT_BAG[2];
            $CLIENT_NAME = $REC_SELECT_BAG[3];
            $NIC = $REC_SELECT_BAG[4];
            $CIF = $REC_SELECT_BAG[5];
         }
         
         $table_name = "card_header";
         // Update Date values and fils
         $set_data = array(
            'CARD_STATE' => "Application - Reject",
            'AUTH_STATUS' => 2,
            'FIN_STATS' => 0,
            'BATCH_NO' => 0,
         );
         $where_clause = "WHERE `HEADER_ID` = '".$isRequestId."';"; // Update Where Clause.
         
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         $returnInsete = CreateNote($conn , $isRequestId, "Application - Reject. ".$isComment, $isEntryUserId);
         // Bage Redius..........................
         if($bage_number != 0){
            $sql_number_of_b = "SELECT bh.NUM_ACCS
                            FROM card_batch_header AS bh
                            WHERE bh.BATCH_ID = ".$bage_number.";";
             $query_number_of_b = mysqli_query($conn,$sql_number_of_b) or die(mysqli_error($conn));
             while($rec_number_of_b = mysqli_fetch_array($query_number_of_b)){
                $num_of_acc = $rec_number_of_b[0]-1;
                 $table_name = "card_batch_header";
                 // Update Date values and fils
                 $set_data = array(
                    'NUM_ACCS' => $num_of_acc,
                 );
                 
                 $where_clause = "WHERE `BATCH_ID` = ".$bage_number.";"; // Update Where Clause.
                 $returnUpdate11 = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
             }
         }
         
         $sql_get_userdtl = "SELECT u.email FROM user AS u WHERE u.userName = '".$ENTRY_BY."'";
         $query_get_userdtl = mysqli_query($conn,$sql_get_userdtl) or die(mysqli_error($conn));
         while($rec_get_userdtl = mysqli_fetch_array($query_get_userdtl)){
            if($rec_get_userdtl[0] != ""){
                $MailBody  ="Client Name    : ".$CLIENT_NAME." <br/>".
                            "NIC Number     : ".$NIC."<br/>".
                            "Client Code    : ".$CIF."<br/>". 
                            "Account Number : ".$ACCOUNT_NO_1."<br/><br/>". 
                            $isComment."<br/>";
                sendingMail($rec_get_userdtl[0],"Debit Card Application - Reject",$MailBody); 
            }
         }
         
         if($returnUpdate == 1 && $returnInsete == 1){
            mysqli_commit($conn);
            echo "Reject is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Reject is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}
// ----------------------- End Request Authorization - Reject function -----------------------------------
// ----------------------- Start Batch Creation - Confirmation function -----------------------------------
function isBatchCreation($conn,$batchCreationString,$entryUser){
  //  echo $batchCreationString." - ".$entryUser;
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));

         $arrayHeaderID = explode("|",$batchCreationString);
         //echo sizeof($arrayHeaderID);
         $NUM_ACCS = sizeof($arrayHeaderID)-1;
        // echo $NUM_ACCS;
         
        $sqlFunction ="SELECT GetNextSerial('m16','CC') FROM DUAL";    //Create the Unique Bokking Reference 
        $quary_Function = mysqli_query($conn,$sqlFunction);
        while ($rec_Function = mysqli_fetch_array($quary_Function)){
            $batch_num = $rec_Function[0]; 
        }
        if($batch_num != 0 && $batch_num != ""){
            
             $sql_Insert = "INSERT INTO card_batch_header (BATCH_ID , NUM_ACCS, BATCH_STATS, ENTRY_BY, ENTRY_ON)
                                                    VALUES(".$batch_num.", ".$NUM_ACCS.", 1, '".$entryUser."', NOW());";
             //echo $sql_Insert;
             $query_Insert = mysqli_query($conn,$sql_Insert) or die(mysqli_error($conn));
             
             for($x = 0 ; $x < (sizeof($arrayHeaderID)-1) ; $x++){
                
                 $sql_UpDate = "UPDATE card_header SET `CARD_STATE` = 'Batch Created', `BATCH_NO` = ".$batch_num."   WHERE `HEADER_ID` = ".$arrayHeaderID[$x].";";
                // echo $sql_UpDate;
                 $query_UpDate = mysqli_query($conn,$sql_UpDate) or die(mysqli_error($conn));
             }
    
             mysqli_commit($conn);
             echo "Batch Creation is Success.";   
        }
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}
// ----------------------- End Batch Creation - Confirmation function -----------------------------------
// ----------------------- Start Send to Debit Load  -----------------------------------
function isSendToDebit($conn,$debitBatch,$entryUser){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
        
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         
         // ------- Update card header Table ----------------------------------------
         $table_name = "card_header";
         $set_data = array(
            'CARD_STATE' => "Send to Debit",
            'FIN_STATS' => 1,
         );
         $where_clause = "WHERE `BATCH_NO` = ".$debitBatch.";"; // Update Where Clause.
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         
          // ------- Update batch header Table ----------------------------------------
         $table_name2 = "card_batch_header";
         $set_data2 = array(
            'BATCH_STATS' => 2,
            'DEBIT_REQUEST_BY' => $entryUser,
            'DEBIT_REQUEST_ON' => $newTime,
         );
         $where_clause2 = "WHERE `BATCH_ID` = ".$debitBatch.";"; // Update Where Clause.
         $returnUpdate2 = dbRowUpdate($conn,$table_name2, $set_data2, $where_clause2);
         
         if($returnUpdate == 1 && $returnUpdate2 == 1){
            mysqli_commit($conn);
         }else{
            mysqli_rollback($conn);
            echo "Sent debit request is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	} 
}
// ----------------------- End Send to Debit Load  -----------------------------------
// ----------------------- Start Send to Com Bank Function  -----------------------------------

function isSendToComBank($conn,$Batch,$entryUser){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
        
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         
         // ------- Update card header Table ----------------------------------------
         $table_name = "card_header";
         $set_data = array(
            'CARD_STATE' => "Send to Com Bank",
            'COM_SENT_BY' => $entryUser,
            'COM_SENT_ON' => $newTime,
         );
         $where_clause = "WHERE `BATCH_NO` = ".$Batch.";"; // Update Where Clause.
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         
          // ------- Update batch header Table ----------------------------------------
         $table_name2 = "card_batch_header";
         $set_data2 = array(
            'BATCH_STATS' => 3,
         );
         $where_clause2 = "WHERE `BATCH_ID` = ".$Batch.";"; // Update Where Clause.
         $returnUpdate2 = dbRowUpdate($conn,$table_name2, $set_data2, $where_clause2);
         
         if($returnUpdate == 1 && $returnUpdate2 == 1){
            mysqli_commit($conn);
            echo "Combank Gen is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Combank Gen is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	} 
}
// ----------------------- End Send to Com Bank Function  -----------------------------------
// ----------------------- Start Receive Debit Card Function  -----------------------------------
function isReceiveCard($conn,$headerID,$debitCardNumber,$entryUser){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
        
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         
         $arryHeaderID = explode("|",$headerID);
         $arryDebitCardNumber = explode("|",$debitCardNumber);
         
        // echo sizeof($arryHeaderID)-1;
         $Expare_value = 5;
         $sql_sys_para = "select e.para_value from erp_sys_param AS e WHERE e.para_code = 13;";
         $query_sys_para = mysqli_query($conn,$sql_sys_para) or die(mysqli_error($conn));
         while($resatl_sys_para = mysqli_fetch_array($query_sys_para)){
            $Expare_value = $resatl_sys_para[0];
         }
         $table_name = "card_header";
         
         for($x = 0 ; $x <= (sizeof($arryHeaderID)-1) ; $x++){
            if($arryHeaderID[$x] != ""){
                $his = updateHistryTbl($conn , $arryHeaderID[$x]);
                 $set_data = array(
                    'CARD_STATE' => "Receive Card - COMBANK",
                    'DEBIT_CARD_NUMBER' => $arryDebitCardNumber[$x],
                    'EXPIARY_DATE' => date("Y-m-d",strtotime(date("Y-m-d")." +".$Expare_value." years")),
                    'COM_DISPATCH_BY' => $entryUser,
                    'COM_DISPATCH_ON' => $newTime,
                 );
                 $where_clause = "WHERE `HEADER_ID` = ".$arryHeaderID[$x].";"; // Update Where Clause.
                 $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
                 $returnInsete1 = CreateNote($conn , $arryHeaderID[$x], "Receive Card - COMBANK. ".$arryDebitCardNumber[$x], $entryUser);
            }
            
            
         }
            echo "Receive Card Update is Success.";
            mysqli_commit($conn);
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	} 
}
// ----------------------- End Receive Debit Card Function  -----------------------------------

function isSendToBranch($conn,$isSendBranchString,$sendBranch,$entryUser){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
        
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         $arryHeaderID = explode("|",$isSendBranchString);
         
         $sql_selectReciveBranch = "SELECT d.deparmentNumber FROM deparment AS d WHERE d.branchNumber = '".$sendBranch."';";
         $query_selectReciveBranch = mysqli_query($conn,$sql_selectReciveBranch) or die(mysqli_error($conn));
         $departmentCount = mysqli_num_rows($query_selectReciveBranch);
         while($resalt_selectReciveBranch = mysqli_fetch_array($query_selectReciveBranch)){
            $sendDepartment = $resalt_selectReciveBranch[0];
         }
         
         if(sizeof($arryHeaderID)-1 == 0){
            echo "Missing Debit card";
         }else{
            
         
             $fileNumber = "";
             $fileSubName = "Debit Card";
             if($departmentCount == 1){
                $fileNumber = genCourier_files($conn,$entryUser,$fileSubName, $sendBranch , $sendDepartment , sizeof($arryHeaderID)-1);
                if($fileNumber != ""){
                    $docC = genCourier_document($conn,$fileNumber,"CM0242");    
                }
                   
             }
             
              
             $table_name = "card_header";
             for($x = 0 ; $x < (sizeof($arryHeaderID)-1) ; $x++){
                 $his = updateHistryTbl($conn , $arryHeaderID[$x]);
                 // ------- Update card header Table ----------------------------------------
                 $set_data = array(
                    'CARD_STATE' => "Send Card - Branch",
                    'BRANCH_SENT_BY' => $entryUser,
                    'BRANCH_SENT_ON' => $newTime,
                 );
                 
                 $where_clause = "WHERE `HEADER_ID` = ".$arryHeaderID[$x].";"; // Update Where Clause.
                 
                 $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
                 $returnInsete1 = CreateNote($conn , $arryHeaderID[$x], "Send Card - Branch. ", $entryUser);   
                 if($fileNumber != ""){
                    $sql_headerdtl = "SELECT ch.EMBOSSING_NAME , ch.ACCOUNT_NO_1 FROM card_header AS ch WHERE ch.HEADER_ID = ".$arryHeaderID[$x].";";
                    //echo $sql_headerdtl;
                    $query_headerdtl = mysqli_query($conn,$sql_headerdtl) or die(mysqli_error($conn));
                    $subDocumentName = "";
                    $subDocumentNumber = "";
                    $rowH = mysqli_num_rows($query_headerdtl);
                    if($rowH == 1 ){
                        while($res_headerdtl = mysqli_fetch_array($query_headerdtl)){
                            $subDocumentName = $res_headerdtl[0];
                            $subDocumentNumber = $res_headerdtl[1];
                        }
                        
                        if($fileNumber != "" && $subDocumentNumber != "" && $subDocumentName != ""){
                            genCourier_Subdocument($conn,$fileNumber,"CM0242",$subDocumentNumber,$subDocumentName);
                        }   
                    }
                 }
                 
             }
        
             
                echo "Send Card - Branch Update is Success.";
                mysqli_commit($conn);
        }
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	} 
}

//--------------------------- Start Coustomer Card Issuer Function -------------------------------------
function isRequestCardIssue($conn,$RequestId,$Comment,$EntryUserId){
    echo $RequestId. " - " .$Comment. " - ". $EntryUserId;
     date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         updateHistryTbl($conn , $RequestId);
         
         $table_name = "card_header";
         
         // Update Date values and fils
         $set_data = array(
            'CARD_STATE' => "Issue Debit Card - Customer",
            'CLIENT_ISS_BY' => $EntryUserId,
            'CLIENT_ISS_ON' => $newTime,
         );
         $where_clause = "WHERE `HEADER_ID` = ".$RequestId.";"; // Update Where Clause.
         
         $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause);
         $returnInsete = CreateNote($conn , $RequestId, "Issue Debit Card - Customer - ".$Comment, $EntryUserId);
         if($returnUpdate == 1 && $returnInsete == 1){
            mysqli_commit($conn);
            echo "Issue Debit Card is Success.";
         }else{
            mysqli_rollback($conn);
            echo "Issue Debit Card is Un-Success.";
         }
         
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
    
    
}
//--------------------------- End Coustomer Card Issuer Function -------------------------------------
//--------------------------- Strat Courier Function -------------------------------------
function genCourier_files($conn,$entryBy,$fileSubName, $resiveBranch , $resiveDepartment , $numOfDoc){
    date_default_timezone_set('Asia/Colombo');
    $sql_userdtl = "select u.branchNumber , u.deparmentNumber from user AS u WHERE u.userName = '".$entryBy."';";
    $query_userdtl = mysqli_query($conn,$sql_userdtl) or die(mysqli_errno($conn));
    while($resalt_userdtl = mysqli_fetch_array($query_userdtl)){
        $userBranch = $resalt_userdtl[0];
        $userDepartment = $resalt_userdtl[1];
    }
    $statCount1 ="SELECT `count` ,`year` FROM `filesnumbergenaret` where `branch`='".$userBranch."' AND `serial`='file' AND`department`='".$userDepartment."' AND `year` = year(now())";
	$sql_statCount1 = mysqli_query($conn,$statCount1);
	while($add_statCount1 = mysqli_fetch_array($sql_statCount1)){
		if($add_statCount1[0] == 0){
		 	$fileNumber = $userBranch.$userDepartment.$add_statCount1[1]."000001"; // Courier File Number
			$cou = $add_statCount1[0] + 1;
		}else{
		 	$fileNumber = $userBranch.$userDepartment.$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT); // Courier File Number
			$cou = $add_statCount1[0] + 1;
		}
	}
    
    $file_name = $userBranch." ".$userDepartment." ".$fileSubName; // Courier File Name
                                         
    $statUpdate = "SELECT `serial` FROM filesNumberGenaret  where `branch`='".$userBranch."' AND `department`='".$userDepartment."' AND `year` = year(now())";
	$sql_statUpdate = mysqli_query($conn,$statUpdate) or die(mysqli_errno($conn));;
	while($add_statUpdate = mysqli_fetch_array($sql_statUpdate)){
	   
		$fileCount ="UPDATE `filesnumbergenaret`  
                        SET `count`= '".$cou."'  
                      WHERE `branch`= '".$userBranch."' AND 
                            `department`='".$userDepartment."' AND 
                            `year` = year(now()) AND 
                            `serial`='".$add_statUpdate[0]."'";
		$updateFileCount = mysqli_query($conn,$fileCount) or die(mysqli_error($conn));
	}
    
    if($fileNumber != ""){
        $addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) 
                                    VALUES('".$fileNumber."','".$file_name."','".$entryBy."' ,'BOIC','".$resiveDepartment."',  '".$resiveBranch."' ,'JC',".$numOfDoc.",'Normal','".$userBranch."','".$userDepartment."','".$fileSubName."','".$entryBy."',now(),'','YES')";
        //echo "<br/>".$addsq1."<br/>";
        $query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
          	
        $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',now(),'File Created','".$entryBy."')";
        //echo $fileMove;
        
        $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
        return $fileNumber;
   }else{
        echo "Error in file number generation. ERP-ERROR";
   }
    
}

function genCourier_document($conn,$fileNumber,$documentNumber){
    date_default_timezone_set('Asia/Colombo');
    $DocName = "SELECT `documentName` 
                  FROM `courier_masters_document` 
                 WHERE `documentNumber` = '".$documentNumber."';";
    $sql_DocName= mysqli_query($conn,$DocName) or die(mysqli_error($conn));
    while($rec_DocName = mysqli_fetch_array($sql_DocName)){
          $addsq2= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
                                          VALUES('".$documentNumber."','".$rec_DocName[0]."','".$fileNumber."',now(),'YES','YES')";
          //echo $addsq2."<br/>";
          $result2= mysqli_query($conn,$addsq2)  or die(mysqli_error($conn));
    }
}

function genCourier_Subdocument($conn,$fileNumber,$documentNumber,$subDocumentNumber,$subDocumentName){
    //echo $subDocumentNumber;
    date_default_timezone_set('Asia/Colombo');
    $addsq3 = "INSERT INTO `courier_document_sub`(`subDocumentNumber`, `subDocumentName`, `documentNumber`, `fileNumber`, `createDateTime`, `isAvailable`, `receiveAvailable`) 
                                          VALUES ('".$subDocumentNumber."','".$subDocumentName."','".$documentNumber."','".$fileNumber."',now(),'YES','YES')";
    //echo $addsq3."<br/>";
    $result3= mysqli_query($conn,$addsq3) or die(mysqli_error($conn));	
}

//--------------------------- End Courier Function -------------------------------------
//--------------------------- Start Debit Card Request Function -------------------------------------
function isDebitCardRequest($conn, $entryUser, $acc_01, $acc_02, $acc_03, $acc_04, $app_Received_date, $acc_Opening_Date, $clint_title, $clint_Name, $embossing_Name, $collecting_Branch, $home_Branch, $CIF, $NIC, $DOB, $mother_Maiden_Name, $mobile_Number, $home_TP, $sal_Plus_Category, $previous_Card_No, $introducerCode, $introducerBranchCode, $withdrawal_Limit, $purchasingLimit, $add1, $add2, $add3, $add4, $add5, $city, $entryBranch, $entryDepartment){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
     
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         
        // 003800479544000301
         $isCode = substr($acc_01,-4);
         $isCharge = 1;
         if($isCode == "0301" || $isCode == "0302" || $isCode == "0901" || $isCode == "1301"){
            $isCharge = 0;
         }
         
         
         $table_name = "card_header";
         $arrywl = explode("|",$withdrawal_Limit);
         $form_data = array(
                'APP_RECEIVED_DATE' => $app_Received_date,
                'ACC_OPENING_DATE' => $acc_Opening_Date,
                'CLIENT_TITLE' => $clint_title,
                'CLIENT_NAME' => $clint_Name,
                'COLLECTING_BRANCH' => $collecting_Branch,
                'HOME_BRANCH' => $home_Branch,
                'CIF' => $CIF,
                'NIC' => $NIC,
                'ADDRESS_1' => $add1,
                'ADDRESS_2' => $add2,
                'ADDRESS_3' => $add3,
                'ADDRESS_4' => $add4,
                'ADDRESS_5' => $add5,
                'CITY' => $city,
                'ACCOUNT_NO_1' => $acc_01,
                'ACCOUNT_NO_2' => $acc_02,
                'ACCOUNT_NO_3' => $acc_03,
                'ACCOUNT_NO_4' => $acc_04,
                'DOB' => $DOB,
                'MOTHER_MAIDEN_NAME' => $mother_Maiden_Name,
                'GSM' => $mobile_Number,
                'HOME_GSM' => $home_TP,
                'SAL_PLUS_CATEGORY_ID' => $sal_Plus_Category,
                'PREVIOUS_CARD_NUMBER' => $previous_Card_No,
                'INTRODUCER_BRANCH' => $introducerBranchCode,
                'INTRODUCER' => $introducerCode,
                'CARD_STATE' => "Request to Debit Card",
                'ENTRY_BY' => $entryUser,
                'ENTRY_ON' => $newTime,
                'MOD_BY' => "",
                'MOD_ON' => "0000-00-00 00:00:00",
                'WITHDRAWAL_LIMIT' => $arrywl[2],
                'PURCHASING_LIMIT' => $purchasingLimit,
                'EMBOSSING_NAME' => $embossing_Name,
                'AUTH_STATUS' => 0,
                'AUTH_BY' => "",
                'AUTH_ON' => "0000-00-00 00:00:00",
                'BATCH_NO' => 0,
                'FIN_STATS' => 0,
                'COM_SENT_BY' => "",
                'COM_SENT_ON' => "0000-00-00 00:00:00",
                'DEBIT_CARD_NUMBER' => "",
                'PREVIOUS_ACCOUNT_NO' => "",
                'EXPIARY_DATE' => "0000-00-00",
                'COM_DISPATCH_BY' => "",
                'COM_DISPATCH_ON' => "0000-00-00 00:00:00",
                'BRANCH_SENT_BY' => "",
                'BRANCH_SENT_ON' => "0000-00-00 00:00:00",
                'BRANCH_RECEIVE_BY' => "",
                'BRANCH_RECEIVE_ON' => "0000-00-00 00:00:00",
                'CLIENT_ISS_BY' => "",
                'CLIENT_ISS_ON' => "0000-00-00 00:00:00",
                'ACC_FREES' => 2,
                'ACC_INOPERATIVE' => 2,
                'ACC_AVLBLE' => 0.000,
                'isCharge' => $isCharge,
                'ENTRY_BRANCH' => $entryBranch,
                'ENTRY_DEPARTMENT' => $entryDepartment,
            );
            
            $acc1_cou = 0;
            if($acc_01 != ""){
                $sqlCountACC1 = "SELECT COUNT(*) FROM card_header as ch 
                                    WHERE ch.AUTH_STATUS != 2 AND 
                                         (ch.ACCOUNT_NO_1 = '".$acc_01."' OR 
                                          ch.ACCOUNT_NO_2 = '".$acc_01."' OR
                                          ch.ACCOUNT_NO_3 = '".$acc_01."' OR
                                          ch.ACCOUNT_NO_4 = '".$acc_01."') ;";
                $queryCountACC1 = mysqli_query($conn,$sqlCountACC1) or die (mysqli_error($conn));
                //echo $sqlCountACC1;
                while($resalt_CountACC1 = mysqli_fetch_array($queryCountACC1)){
                    $acc1_cou = $resalt_CountACC1[0];
                   // echo $acc1_cou;
                }
            }
            
            $acc2_cou = 0;
            if($acc_02 != ""){
                $sqlCountACC2 = "SELECT COUNT(*) FROM card_header as ch 
                                    WHERE ch.AUTH_STATUS != 2 AND 
                                          (ch.ACCOUNT_NO_1 = '".$acc_02."' OR 
                                          ch.ACCOUNT_NO_2 = '".$acc_02."' OR
                                          ch.ACCOUNT_NO_3 = '".$acc_02."' OR
                                          ch.ACCOUNT_NO_4 = '".$acc_02."') ;";
                //echo $sqlCountACC2;
                $queryCountACC2 = mysqli_query($conn,$sqlCountACC2) or die (mysqli_error($conn));
                while($resalt_CountACC2 = mysqli_fetch_array($queryCountACC2)){
                    $acc2_cou = $resalt_CountACC2[0];
                   // echo $acc2_cou;
                }
            }
            
            
            $acc3_cou = 0;
            if($acc_03 != ""){
                   $sqlCountACC3 = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND 
                                 (ch.ACCOUNT_NO_1 = '".$acc_03."' OR 
                                  ch.ACCOUNT_NO_2 = '".$acc_03."' OR
                                  ch.ACCOUNT_NO_3 = '".$acc_03."' OR
                                  ch.ACCOUNT_NO_4 = '".$acc_03."') ;";
                   // echo $sqlCountACC3;
                    $queryCountACC3 = mysqli_query($conn,$sqlCountACC3) or die (mysqli_error($conn));
                    while($resalt_CountACC3 = mysqli_fetch_array($queryCountACC3)){
                        $acc3_cou = $resalt_CountACC3[0];
                        //echo $acc3_cou;
                   }
            }
         
            $acc4_cou = 0;
            if($acc_04 != ""){
                $sqlCountACC4 = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND 
                                 (ch.ACCOUNT_NO_1 = '".$acc_04."' OR 
                                  ch.ACCOUNT_NO_2 = '".$acc_04."' OR
                                  ch.ACCOUNT_NO_3 = '".$acc_04."' OR
                                  ch.ACCOUNT_NO_4 = '".$acc_04."') ;";
                //echo $sqlCountACC4;
                $queryCountACC4 = mysqli_query($conn,$sqlCountACC4) or die (mysqli_error($conn));
                while($resalt_CountACC4 = mysqli_fetch_array($queryCountACC4)){
                    $acc4_cou = $resalt_CountACC4[0];
                   // echo $acc4_cou;
                }
            }
            
            
            if($acc1_cou == 0 && $acc2_cou == 0 && $acc3_cou == 0 && $acc4_cou == 0){
                 $inser = dbRowInsert($conn, $table_name, $form_data); 
                if($inser == 1){
                    mysqli_commit($conn);
                    echo "Request is Success."; 
                }else{
                    mysqli_rollback($conn);
                    echo "Request is Un-Success."; 
                }
            }else{
                mysqli_rollback($conn);
                echo "Some Account is link Debit Card.";
            }
           
                     
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
    
}
//--------------------------- End Debit Card Request Function -------------------------------------

function isDebitCardEidt($conn, $heardID ,$entryUser, $acc_01, $acc_02, $acc_03, $acc_04, $app_Received_date, $acc_Opening_Date, $clint_title, $clint_Name, $embossing_Name, $collecting_Branch, $home_Branch, $CIF, $NIC, $DOB, $mother_Maiden_Name, $mobile_Number, $home_TP, $sal_Plus_Category, $previous_Card_No, $introducerCode, $introducerBranchCode, $withdrawal_Limit, $purchasingLimit, $add1, $add2, $add3, $add4, $add5, $city){
    date_default_timezone_set('Asia/Colombo');
    mysqli_autocommit($conn,FALSE);
    try{
     
         $newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
         $table_name = "card_header";
         $arrywl = explode("|",$withdrawal_Limit);
         
         $set_data = array(
               // 'APP_RECEIVED_DATE' => $app_Received_date,
               // 'ACC_OPENING_DATE' => $acc_Opening_Date,
               // 'CLIENT_TITLE' => $clint_title,
               // 'CLIENT_NAME' => $clint_Name,
                'COLLECTING_BRANCH' => $collecting_Branch,
                'HOME_BRANCH' => $home_Branch,
               // 'CIF' => $CIF,
               // 'NIC' => $NIC,
               // 'ADDRESS_1' => $add1,
               // 'ADDRESS_2' => $add2,
               // 'ADDRESS_3' => $add3,
               // 'ADDRESS_4' => $add4,
               // 'ADDRESS_5' => $add5,
               // 'CITY' => $city,
                //'ACCOUNT_NO_1' => $acc_01,
                'ACCOUNT_NO_2' => $acc_02,
                'ACCOUNT_NO_3' => $acc_03,
                'ACCOUNT_NO_4' => $acc_04,
               // 'DOB' => $DOB,
                'MOTHER_MAIDEN_NAME' => $mother_Maiden_Name,
                'GSM' => $mobile_Number,
                'HOME_GSM' => $home_TP,
                'SAL_PLUS_CATEGORY_ID' => $sal_Plus_Category,
                'PREVIOUS_CARD_NUMBER' => $previous_Card_No,
                // 'INTRODUCER_BRANCH' => $introducerBranchCode,
                // 'INTRODUCER' => $introducerCode,
                'CARD_STATE' => "Request to Debit Card",
               // 'ENTRY_BY' => $entryUser,
               // 'ENTRY_ON' => $newTime,
               // 'MOD_BY' => "",
               // 'MOD_ON' => "0000-00-00 00:00:00",
                'WITHDRAWAL_LIMIT' => $arrywl[2],
                'PURCHASING_LIMIT' => $purchasingLimit,
                'EMBOSSING_NAME' => $embossing_Name,
               // 'AUTH_STATUS' => 0,
               // 'AUTH_BY' => "",
               // 'AUTH_ON' => "0000-00-00 00:00:00",
              //  'BATCH_NO' => 0,
               // 'FIN_STATS' => 0,
               // 'COM_SENT_BY' => "",
               // 'COM_SENT_ON' => "0000-00-00 00:00:00",
               // 'DEBIT_CARD_NUMBER' => "",
               // 'PREVIOUS_ACCOUNT_NO' => "",
               // 'EXPIARY_DATE' => "0000-00-00",
              //  'COM_DISPATCH_BY' => "",
               // 'COM_DISPATCH_ON' => "0000-00-00 00:00:00",
               // 'BRANCH_SENT_BY' => "",
               // 'BRANCH_SENT_ON' => "0000-00-00 00:00:00",
               // 'BRANCH_RECEIVE_BY' => "",
               // 'BRANCH_RECEIVE_ON' => "0000-00-00 00:00:00",
               // 'CLIENT_ISS_BY' => "",
               // 'CLIENT_ISS_ON' => "0000-00-00 00:00:00",
            );
            //echo $arrywl[1];
             $where_clause = "WHERE `HEADER_ID` = ".$heardID.";"; // Update Where Clause.
            
            $acc2_cou = 0;
            if($acc_02 != ""){
                $sqlCountACC2 = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND 
                                  (ch.ACCOUNT_NO_1 = '".$acc_02."' OR 
                                  ch.ACCOUNT_NO_2 = '".$acc_02."' OR
                                  ch.ACCOUNT_NO_3 = '".$acc_02."' OR
                                  ch.ACCOUNT_NO_4 = '".$acc_02."') ;";
                //echo $sqlCountACC2;
                $queryCountACC2 = mysqli_query($conn,$sqlCountACC2) or die (mysqli_error($conn));
                while($resalt_CountACC2 = mysqli_fetch_array($queryCountACC2)){
                    $acc2_cou = $resalt_CountACC2[0];
                   // echo $acc2_cou;
                }
            }
            
            
            $acc3_cou = 0;
            if($acc_03 != ""){
                   $sqlCountACC3 = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND 
                                 (ch.ACCOUNT_NO_1 = '".$acc_03."' OR 
                                  ch.ACCOUNT_NO_2 = '".$acc_03."' OR
                                  ch.ACCOUNT_NO_3 = '".$acc_03."' OR
                                  ch.ACCOUNT_NO_4 = '".$acc_03."') ;";
                   // echo $sqlCountACC3;
                    $queryCountACC3 = mysqli_query($conn,$sqlCountACC3) or die (mysqli_error($conn));
                    while($resalt_CountACC3 = mysqli_fetch_array($queryCountACC3)){
                        $acc3_cou = $resalt_CountACC3[0];
                        //echo $acc3_cou;
                   }
            }
         
            $acc4_cou = 0;
            if($acc_04 != ""){
                $sqlCountACC4 = "SELECT COUNT(*) FROM card_header as ch 
                            WHERE ch.AUTH_STATUS != 2 AND 
                                 (ch.ACCOUNT_NO_1 = '".$acc_04."' OR 
                                  ch.ACCOUNT_NO_2 = '".$acc_04."' OR
                                  ch.ACCOUNT_NO_3 = '".$acc_04."' OR
                                  ch.ACCOUNT_NO_4 = '".$acc_04."') ;";
                //echo $sqlCountACC4;
                $queryCountACC4 = mysqli_query($conn,$sqlCountACC4) or die (mysqli_error($conn));
                while($resalt_CountACC4 = mysqli_fetch_array($queryCountACC4)){
                    $acc4_cou = $resalt_CountACC4[0];
                   // echo $acc4_cou;
                }
            }
            
            
            if($acc2_cou == 0 && $acc3_cou == 0 && $acc4_cou == 0){
                 $returnUpdate = dbRowUpdate($conn,$table_name, $set_data, $where_clause); 
                if($returnUpdate == 1){
                    mysqli_commit($conn);
                    echo "Update is Success."; 
                }else{
                    mysqli_rollback($conn);
                    echo "Update is Un-Success."; 
                }
            }else{
                mysqli_rollback($conn);
                echo "Some Account is link Debit Card.";
            }
           
                     
    }catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}


//--------------------------------------------- Send Mail Function -------------------------------------------------------------------------------
function sendingMail($getmailAddress,$title,$mail){
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
    $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
    
    $mailBody = "<html>
                    <head>
                        <title>HTML email</title>
                    </head>
                    <body>
                    ".$mail."
                    </body>
                    </html>";
    //sendMail($getmail,$title,$mail,$headers);    
    mail($getmailAddress,$title,$mailBody,$headers);
}
?>