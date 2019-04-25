<?php
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
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
//........................................ Function Calling..........................................................

    //************************************ Function For Define Letter Types ***********************************************************************************
    if(isset($_POST['get_LetterTypeCode']) && isset($_POST['get_Description']) && isset($_POST['get_val_txtNumOfSig']) && isset($_POST['val_Num_sql']) && isset($_POST['get_User'])){
        //echo $_POST['get_LetterTypeCode']."--".$_POST['get_Description']."--".$_POST['get_val_txtNumOfSig']."--".$_POST['val_Num_sql']."--".$_POST['get_User'];
        if($_POST['val_Num_sql'] == 1){
            isInsertDefineLetterTypes(trim($_POST['get_LetterTypeCode']),trim($_POST['get_Description']),trim($_POST['get_val_txtNumOfSig']),trim($_POST['get_User']));
        }else if($_POST['val_Num_sql'] == 2){
            isUpdateDefineLetterTypes(trim($_POST['get_LetterTypeCode']),trim($_POST['get_Description']),trim($_POST['get_val_txtNumOfSig']),trim($_POST['get_User']));
        }else if($_POST['val_Num_sql'] == 3){
             isDeleteDefineLetterTypes(trim($_POST['get_LetterTypeCode']),trim($_POST['get_Description']),trim($_POST['get_val_txtNumOfSig']),trim($_POST['get_User']));
        }
    }
    
    //************************************ Function For Define Signatory Groups ***********************************************************************************
    if(isset($_POST['dsg_sel_sps_let_types']) && isset($_POST['dsg_txtGroupCode']) && isset($_POST['dsg_txtGroupName']) && isset($_POST['dsg_Num_sql']) && isset($_POST['dsg_User'])){
        //echo $_POST['dsg_sel_sps_let_types']."--".$_POST['dsg_txtGroupCode']."--".$_POST['dsg_txtGroupName']."--".$_POST['dsg_Num_sql']."--".$_POST['dsg_User'];
        if($_POST['dsg_Num_sql'] == 1){
            isInsertDefineSignatoryGroups(trim($_POST['dsg_sel_sps_let_types']),trim($_POST['dsg_txtGroupCode']),trim($_POST['dsg_txtGroupName']),trim($_POST['dsg_User']));
        }else if($_POST['dsg_Num_sql'] == 2){
            //echo "Update";
            isUpdateDefineSignatoryGroups(trim($_POST['dsg_sel_sps_let_types']),trim($_POST['dsg_txtGroupCode']),trim($_POST['dsg_txtGroupName']),trim($_POST['dsg_User']));
        }else if($_POST['dsg_Num_sql'] == 3){
           // echo "Delete";
            isDeleteDefineSignatoryGroups(trim($_POST['dsg_sel_sps_let_types']),trim($_POST['dsg_txtGroupCode']),trim($_POST['dsg_txtGroupName']),trim($_POST['dsg_User']));
        }
    }
    
    //************************************** Function For Define Signatory Groups Users *********************************************************************************************
    if(isset($_POST['dsgu_sel_sps_let_types']) && isset($_POST['dsgu_sel_sug_Signatory_Group']) && isset($_POST['dsgu_val_sel_txtUserName']) && isset($_POST['dsgu_Num_sql']) && isset($_POST['dsgu_User'])){
        //echo $_POST['dsgu_sel_sps_let_types']."--".$_POST['dsgu_sel_sug_Signatory_Group']."--".$_POST['dsgu_val_sel_txtUserName']."--".$_POST['dsgu_Num_sql']."--".$_POST['dsgu_User'];
        if($_POST['dsgu_Num_sql'] == 1){
            //echo "Insert";
            isInsert_Define_Signatory_Groups_Users(trim($_POST['dsgu_sel_sps_let_types']),trim($_POST['dsgu_sel_sug_Signatory_Group']),trim($_POST['dsgu_val_sel_txtUserName']),trim($_POST['dsgu_User']));
        }else if($_POST['dsgu_Num_sql'] == 2){
            //echo "Update";
            isUpdate_Define_Signatory_Groups_Users(trim($_POST['dsgu_sel_sps_let_types']),trim($_POST['dsgu_sel_sug_Signatory_Group']),trim($_POST['dsgu_val_sel_txtUserName']),trim($_POST['dsgu_User']));
        }else if($_POST['dsgu_Num_sql'] == 3){
            isDelete_Define_Signatory_Groups_Users(trim($_POST['dsgu_sel_sps_let_types']),trim($_POST['dsgu_sel_sug_Signatory_Group']),trim($_POST['dsgu_val_sel_txtUserName']),trim($_POST['dsgu_User']));
        }
    }
    
    //**************************************** Function calling for Assign Signatory Groups ******************************************************************************************
    if(isset($_POST['asg_sel_sps_let_types']) && isset($_POST['asg_sel_asg_Signatory_Group']) && isset($_POST['asg_txtAmount_From']) && isset($_POST['asg_txtAmount_To']) && isset($_POST['asg_Num_sql']) && isset($_POST['asg_User'])){
        if($_POST['asg_Num_sql'] == 1){ // finction Calling for Insert data for Assign Signatory Groups
            //echo "Insert";
            isInsert_Assign_Signatory_Groups(trim( $_POST['asg_sel_sps_let_types']),trim($_POST['asg_sel_asg_Signatory_Group']),trim($_POST['asg_txtAmount_From']),trim($_POST['asg_txtAmount_To']),trim($_POST['asg_User']));
        }
        if($_POST['asg_Num_sql'] == 2 && isset($_POST['asg_txtsqe'])){ // finction Calling for Insert data for Assign Signatory Groups
            //echo $_POST['asg_txtsqe'];
            isUpdate_Assign_Signatory_Groups(trim( $_POST['asg_sel_sps_let_types']),trim($_POST['asg_sel_asg_Signatory_Group']),trim($_POST['asg_txtAmount_From']),trim($_POST['asg_txtAmount_To']),trim($_POST['asg_User']),trim($_POST['asg_txtsqe']));
        }
        
        if($_POST['asg_Num_sql'] == 3 && isset($_POST['asg_txtsqe'])){ // finction Calling for Insert data for Assign Signatory Groups
            //echo "Delete";
            isDelete_Assign_Signatory_Groups(trim( $_POST['asg_sel_sps_let_types']),trim($_POST['asg_sel_asg_Signatory_Group']),trim($_POST['asg_txtAmount_From']),trim($_POST['asg_txtAmount_To']),trim($_POST['asg_User']),trim($_POST['asg_txtsqe']));
        }
    }
    
    if(isset($_POST['get_spa_Letter_Type']) && isset($_POST['get_spa_Batch_Number']) && isset($_POST['get_spa_Amount_Slab_001']) && isset($_POST['val_spa_Amount_Slab_002']) && isset($_POST['get_spa_user'])){
        //echo $_POST['get_spa_Letter_Type']."--".$_POST['get_spa_Batch_Number']."--".$_POST['get_spa_Amount_Slab_001']."--".$_POST['val_spa_Amount_Slab_002']."--".$_POST['get_spa_user'];
        is_Security_Printing_Authorization(trim($_POST['get_spa_Letter_Type']),trim($_POST['get_spa_Batch_Number']),trim($_POST['get_spa_Amount_Slab_001']),trim($_POST['val_spa_Amount_Slab_002']),trim($_POST['get_spa_user']));
    }
    
     if(isset($_POST['get_spa_CBD_PO']) && isset($_POST['get_spa_Amount_Slab_001_PO']) && isset($_POST['val_spa_Amount_Slab_002_PO']) && isset($_POST['var_user_PO_auth']) && isset($_POST['var_PO_type'])){
         //echo $_POST['get_spa_CBD_PO']."--".$_POST['get_spa_Amount_Slab_001_PO']."--".$_POST['val_spa_Amount_Slab_002_PO']."--".$_POST['var_user_PO_auth']."OK";
          is_Security_Printing_Authorization_PO(trim($_POST['get_spa_CBD_PO']),trim($_POST['get_spa_Amount_Slab_001_PO']),trim($_POST['val_spa_Amount_Slab_002_PO']),trim($_POST['var_user_PO_auth']),trim($_POST['var_PO_type']));
         
     }
    
    if(isset($_POST['get_spa_CBD_new_PO']) && isset($_POST['get_spa_Amount_Slab_001_new_PO']) && isset($_POST['val_spa_Amount_Slab_002_new_PO']) && isset($_POST['var_user_PO_new_auth']) && isset($_POST['var_PO_new_type']) && isset($_POST['var_facNo'])){
         //echo $_POST['get_spa_CBD_new_PO']."--".$_POST['get_spa_Amount_Slab_001_new_PO']."--".$_POST['val_spa_Amount_Slab_002_new_PO']."--".$_POST['var_user_PO_new_auth']."--".$_POST['var_PO_new_type']."--".$_POST['var_facNo'];
         is_Security_Printing_Authorization_New_PO(trim($_POST['get_spa_CBD_new_PO']),trim($_POST['get_spa_Amount_Slab_001_new_PO']),trim($_POST['val_spa_Amount_Slab_002_new_PO']),trim($_POST['var_user_PO_new_auth']),trim($_POST['var_PO_new_type']),trim($_POST['var_facNo']));
         
     }
     
     if(isset($_POST['var_user_BC_new_auth']) && isset($_POST['var_BC_txtV_INDEX'])){
         //echo $_POST['var_user_BC_new_auth']."--".$_POST['var_BC_txtV_INDEX'];
         is_Security_Printing_Authorization_New_BC(trim($_POST['var_user_BC_new_auth']),trim($_POST['var_BC_txtV_INDEX']));
         
     }
     
     if(isset($_POST['get_spa_Batch_Numbercbl05']) && isset($_POST['get_spa_usercbl05'])){
       //  echo $_POST['get_spa_Batch_Numbercbl05']."--".$_POST['get_spa_usercbl05'];
         is_Security_Printing_CBL05(trim($_POST['get_spa_Batch_Numbercbl05']),trim($_POST['get_spa_usercbl05']));
         
     }
     
     
     
     //------------ 2018-01-24 Madushan (comen Auth)
     //var_user_authby : var_auth ,  var_INDEX_comen : txtV_INDEX , com_typeCode : arrayres[1] 
     if(isset($_POST['var_user_authby']) && isset($_POST['var_INDEX_comen']) && isset($_POST['com_typeCode']) ){
         //echo $_POST['var_user_BC_new_auth']."--".$_POST['var_BC_txtV_INDEX'];
         if($_POST['com_typeCode'] == "COND"){
            is_Security_P_A_NomineeConfametion(trim($_POST['var_user_authby']),trim($_POST['var_INDEX_comen']));
         }elseif($_POST['com_typeCode'] == "COND2"){
            is_Security_P_A_NomineeConfametion_bulk(trim($_POST['var_user_authby']),trim($_POST['var_INDEX_comen']));
         }
         
         else{
            echo "Un-difiend Letter Type";
         }
         
         
     }
     
    if(isset($_POST['getFacilityNumberRequest']) && isset($_POST['getEnrtyUser'])){
        //echo trim($_POST['getFacilityNumberRequest']);
        isRequestRegenerateLetter(trim($_POST['getFacilityNumberRequest']),trim($_POST['getEnrtyUser']));
    }
    
    if(isset($_REQUEST['getFacilityNumberMIP']) && isset($_REQUEST['getEnrtyUserMIP'])){
        //echo trim($_POST['getFacilityNumberRequest']);
        isRequestMemoOfAdvicingForIntroducerPayment(trim($_REQUEST['getFacilityNumberMIP']),trim($_REQUEST['getEnrtyUserMIP']));
    }
    
     if(isset($_REQUEST['getFacilityNumberMDP']) && isset($_REQUEST['getEnrtyUserMDP'])){
        //echo trim($_POST['getFacilityNumberRequest']);
        isRequestMemoOfAdvicingForDealerPayment(trim($_REQUEST['getFacilityNumberMDP']),trim($_REQUEST['getEnrtyUserMDP']));
    }
    
    if(isset($_REQUEST['getFacilityNumberREGENMIP']) && isset($_REQUEST['getEnrtyUserREGENMIP'])){
        //echo trim($_POST['getFacilityNumberRequest']);
        isRequestMemoOfAdvicingForIntroducerPaymentREGEN(trim($_REQUEST['getFacilityNumberREGENMIP']),trim($_REQUEST['getEnrtyUserREGENMIP']));
    }
    
    if(isset($_POST['get_approve_reprint_facNumber']) && isset($_POST['get_reprint_ath_aprove'])){
        isApproveRegenerateLetter(trim($_POST['get_approve_reprint_facNumber']),trim($_POST['get_reprint_ath_aprove']));
    }
    
    if(isset($_POST['get_reject_reprint_facNumber']) && isset($_POST['get_reprint_ath_reject'])){
        //echo trim($_POST['getFacilityNumberRequest']);
        isRejectRegenerateLetter(trim($_POST['get_reject_reprint_facNumber']),trim($_POST['get_reprint_ath_reject']));
    }
    //************************************** Function for Define Signatures **************************************************************************************
    if(isset($_POST['get_Define_Signatures_User_ID'])){
        $conn = DatabaseConnection();
        echo isSelectUser(trim($_POST['get_Define_Signatures_User_ID']));
    }     
//....................................... Function Selecting  Data..............................................................
    function isEmptyletterTypeCode($get_LetterTypeCode){
        $conn = DatabaseConnection();
        $getCount = "SELECT COUNT(*) FROM `sps_let_types` WHERE `TYPE_CODE` = '".$get_LetterTypeCode."';";
        $queryCount = mysqli_query($conn, $getCount) or die(mysqli_error());
        while($RES_sql = mysqli_fetch_array($queryCount)){
           return   $RES_sql[0];
        }
    }
    
    function isRequestRegenerateLetter($getFacilityNumberRequest , $getEnrtyUser){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
                $sql_Inserte = "INSERT INTO `sps_regenerate`(`fac_no`, `requestBy`, `requestOn`) VALUES ('".$getFacilityNumberRequest."','".$getEnrtyUser."',NOW());";
                $que_Inserte = mysqli_query($conn,$sql_Inserte) or die(mysqli_error());
                if(!$que_Inserte){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Saved Success.";
                } 
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
function isRequestMemoOfAdvicingForIntroducerPayment($fac_number,$getUser){
        //echo $fac_number;
        $oracleConn = oracleDatabaseConnection();
        date_default_timezone_set("Asia/Calcutta");
        
       $conn = DatabaseConnection();
        
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
        $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_intropay.get_intropay_data('".$fac_number."'))");
       oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
   
    //echo "A";
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
    
           
       
       if($rowSelect[0]->load() == "<table></table>"){
         echo "NO";
       }else{
          $serial = 0;
          $select_sql = "SELECT COUNT(a.fcano)  FROM sps_introducer_payment AS a WHERE a.fcano = '".$fac_number."';";
           $query_select = mysqli_query($conn,$select_sql)  or die(mysqli_error($conn));
           while($resect_Inset = mysqli_fetch_array($query_select)){
                $serial = $resect_Inset[0];
           }
           if($serial == 0){
              $serial++;  
            $insert_sql = "INSERT INTO sps_introducer_payment (fcano , printby,inc_type) VALUES ('".$fac_number."','".$getUser."','".$rowSelect[3]."');";
           $query = mysqli_query($conn,$insert_sql) or die(mysqli_error($conn));
          
           
        $startTime = date("Y-m-d H:i:s");
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($startTime)));
        // ($rowSelect[3]=="I"?"Finance":"Credit Operations")
        echo "<div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
<br /><br />
<label style='font-family: sans;'>Copy of Finance Division</label><br /><br />
<div style='width: 100%; text-align: right;'>
<label style='font-family: sans;font-size: 14px;'>PRINTED USER HRIS : ".$getUser."</label> <br />
<label style='font-family: sans;font-size: 14px;'>PRINT DATE &amp; TIME : ".$cenvertedTime."</label> <br />
<label style='font-family: sans;font-size: 14px;'>".($rowSelect[3]=="I"?"INTRODUCER PAYMENT":"DEALER INCENTIVE") ." SERIAL NUMBER: ".$serial."</label> <br />
</div>
<br />
<div style='float: left;'>
<label style='font-family: sans;font-size: 20px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</label><br />
<label style='font-family: sans;font-size: 14px;font-weight: bold;'>MEMO OF ADVISING FOR ".($rowSelect[3]=="I"?"INTRODUCER PAYMENT":"DEALER INCENTIVE") ."</label>
</div>
<div style='text-align: right;'>
<img src='log_new_img.png' />
</div>

<br /><br />
<label style='font-family: sans;font-size: 16px;font-weight: bold;'>To: The Manager-Finance Division</label> <br /><br />
<label style='font-family: sans;font-size: 14px;'>Facility Details are as follows,</label> <br /><br />";
echo $rowSelect[0]->load();
echo "<br /><br />";
echo $rowSelect[1]->load();

echo "<br /><br />";
echo $rowSelect[2]->load();
if($rowSelect[3] == "I"){
echo "<br/><span style='font-family: sans;font-size: 14px;'> Account Number : .....................................................</span><br /><br />
<span style='font-family: sans;font-size: 14px;'> Bank 	&amp; Branch 	&nbsp;	&nbsp;: .....................................................</span><br />
<br/><br/>";
}
echo "<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Recommended by</span><br /><br /><br /><br /><br />
<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Approved by </span><br />


</div>";
    // 2nd Copy tp be printed
    //if($rowSelect[3] == "I"){
    echo "<div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
    <br /><br />
    <label style='font-family: sans;'>Copy of Credit Operations Division</label><br /><br />
    <div style='width: 100%; text-align: right;'>
    <label style='font-family: sans;font-size: 14px;'>PRINTED USER HRIS : ".$getUser."</label> <br />
    <label style='font-family: sans;font-size: 14px;'>PRINT DATE &amp; TIME : ".$cenvertedTime."</label> <br />
    <label style='font-family: sans;font-size: 14px;'>".($rowSelect[3]=="I"?"INTRODUCER PAYMENT":"DEALER INCENTIVE") ." SERIAL NUMBER: ".$serial."</label> <br />
    </div>
    <br />
    <div style='float: left;'>
    <label style='font-family: sans;font-size: 20px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</label><br />
    <label style='font-family: sans;font-size: 14px;font-weight: bold;'>MEMO OF ADVISING FOR ".($rowSelect[3]=="I"?"INTRODUCER PAYMENT":"DEALER INCENTIVE") ."</label>
    </div>
    <div style='text-align: right;'>
    <img src='log_new_img.png' />
    </div>
    
    <br /><br />
    <label style='font-family: sans;font-size: 16px;font-weight: bold;'>To: The Manager-Finance Division</label> <br /><br />
    <label style='font-family: sans;font-size: 14px;'>Facility Details are as follows,</label> <br /><br />";
    echo $rowSelect[0]->load();
    echo "<br /><br />";
    echo $rowSelect[1]->load();
    
    echo "<br /><br />";
    echo $rowSelect[2]->load();
    if($rowSelect[3] == "I"){
        echo "<br/><span style='font-family: sans;font-size: 14px;'> Account Number : .....................................................</span><br /><br />
        <span style='font-family: sans;font-size: 14px;'> Bank 	&amp; Branch 	&nbsp;	&nbsp;: .....................................................</span><br />
        <br/><br/>";
    }
    echo "
    <span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
    <span style='font-family: sans;font-size: 14px;font-weight: bold;'> Recommended by</span><br /><br /><br /><br /><br />
    <span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
    <span style='font-family: sans;font-size: 14px;font-weight: bold;'> Approved by </span><br />
    </div>";
    //}
             }else{
                echo "COPY";
             }

        }
        
    }
}
    
    function isRequestMemoOfAdvicingForDealerPayment($fac_num,$get_user){
                
        $oracleConn = oracleDatabaseConnection();
        date_default_timezone_set("Asia/Calcutta");
        
       $conn = DatabaseConnection();
        
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
        $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_intropay.get_intropay_data('".$fac_num."'))");
       oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
   
    //echo "A";
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
    
       
       
       if($rowSelect[0]->load() == "<table></table>"){
         echo "NO";
       }else{
          $serial = 0;
          $select_sql = "select count(a.facno) from sps_dealer_incentive as a where a.facno = '".$fac_num."';";
           $query_select = mysqli_query($conn,$select_sql)  or die(mysqli_error($conn));
           while($resect_Inset = mysqli_fetch_array($query_select)){
                $serial = $resect_Inset[0];
           }
           if($serial == 0){
              $serial++;  
            $insert_sql = "INSERT INTO sps_dealer_incentive (facno , printby) VALUES ('".$fac_num."','".$get_user."');";
           $query = mysqli_query($conn,$insert_sql) or die(mysqli_error($conn));
          
           
        $startTime = date("Y-m-d H:i:s");
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($startTime)));
        echo "<div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
<br /><br />
<label style='font-family: sans;'>Copy of Credit Operation Division</label><br /><br />
<div style='width: 100%; text-align: right;'>
<label style='font-family: sans;font-size: 14px;'>PRINTED USER HRIS : ".$get_user."</label> <br />
<label style='font-family: sans;font-size: 14px;'>PRINT DATE &amp; TIME : ".$cenvertedTime."</label> <br />
<label style='font-family: sans;font-size: 14px;'>DEALER INCENTIVE SERIAL NUMBER: ".$serial."</label> <br />
</div>
<br />
<div style='float: left;'>
<label style='font-family: sans;font-size: 20px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</label><br />
<label style='font-family: sans;font-size: 14px;font-weight: bold;'>MEMO OF ADVISING FOR DEALER INCENTIVE</label>
</div>
<div style='text-align: right;'>
<img src='log_new_img.png' />
</div>

<br /><br />
<label style='font-family: sans;font-size: 16px;font-weight: bold;'>To: The Manager-Finance Division</label> <br /><br />
<label style='font-family: sans;font-size: 14px;'>Facility Details are as follows,</label> <br /><br />";
echo $rowSelect[0]->load();
echo "<br /><br />";
echo $rowSelect[1]->load();

echo "<br /><br />";
echo $rowSelect[2]->load();
echo " <br/>
<span style='font-family: sans;font-size: 14px;'> Account Number : .....................................................</span><br /><br />
<span style='font-family: sans;font-size: 14px;'> Bank 	&amp; Branch 	&nbsp;	&nbsp;: .....................................................</span><br />
<br /><br/>

<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Recommended by</span><br /><br /><br /><br /><br />
<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Approved by </span><br />


</div>";


        }
        
        }
    }
        
    }
    
    
    function isRequestMemoOfAdvicingForIntroducerPaymentREGEN($fac_number,$getUser){
        //echo $fac_number;
        $oracleConn = oracleDatabaseConnection();
        date_default_timezone_set("Asia/Calcutta");
        
       $conn = DatabaseConnection();
        
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
        $OracleSelect = oci_parse($oracleConn,"select * from table(cdbproddb.pkg_mycdb_intropay.get_intropay_data('".$fac_number."'))");
       oci_execute($OracleSelect);
    $i = 0;
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
   
    //echo "A";
    while (($rowSelect = oci_fetch_array($OracleSelect, OCI_BOTH)) != false) {	//Read Oracle Source table
    
       
       
       if($rowSelect[0]->load() == "<table></table>"){
         echo "NO";
       }else{
          $serial = 0;
          $select_sql = "SELECT COUNT(a.fcano)  FROM sps_introducer_payment AS a WHERE a.fcano = '".$fac_number."';";
           $query_select = mysqli_query($conn,$select_sql)  or die(mysqli_error($conn));
           while($resect_Inset = mysqli_fetch_array($query_select)){
                $serial = $resect_Inset[0];
           }
              $serial++;  
            $insert_sql = "INSERT INTO sps_introducer_payment (fcano , printby) VALUES ('".$fac_number."','".$getUser."');";
           $query = mysqli_query($conn,$insert_sql) or die(mysqli_error($conn));
          
           
        $startTime = date("Y-m-d H:i:s");
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($startTime)));
        echo "<div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
<br /><br />
<label style='font-family: sans;'>Copy of Finance Division</label><br /><br />
<div style='width: 100%; text-align: right;'>
<label style='font-family: sans;font-size: 14px;'>PRINTED USER HRIS : ".$getUser."</label> <br />
<label style='font-family: sans;font-size: 14px;'>PRINT DATE &amp; TIME : ".$cenvertedTime."</label> <br />
<label style='font-family: sans;font-size: 14px;'>INTRODUCER PAYMENT SERIAL NUMBER : ".$serial." - Duplicate</label> <br />
</div>
<br />
<div style='float: left;'>
<label style='font-family: sans;font-size: 20px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</label><br />
<label style='font-family: sans;font-size: 14px;font-weight: bold;'>MEMO OF ADVISING FOR INTRODUCER PAYMENT</label>
</div>
<div style='text-align: right;'>
<img src='log_new_img.png' />
</div>

<br /><br />
<label style='font-family: sans;font-size: 16px;font-weight: bold;'>To: The Manager-Finance Division</label> <br /><br />
<label style='font-family: sans;font-size: 14px;'>Facility Details are as follows,</label> <br /><br />";
echo $rowSelect[0]->load();
echo "<br /><br />";
echo $rowSelect[1]->load();

echo "<br /><br />";
echo $rowSelect[2]->load();
echo "
<span style='font-family: sans;font-size: 14px;'><br/> Account Number : .....................................................</span><br /><br />
<span style='font-family: sans;font-size: 14px;'> Bank 	&amp; Branch 	&nbsp;	&nbsp;: .....................................................</span><br />
<br /><br/>

<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Recommended by</span><br /><br /><br /><br /><br />
<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Approved by </span><br />


</div>";
echo "<div style='page-break-after: always;font-family: sans; font-size: 14px;' id='cover'>
<br /><br />
<label style='font-family: sans;'>Copy of Credit Operations Division</label><br /><br />
<div style='width: 100%; text-align: right;'>
<label style='font-family: sans;font-size: 14px;'>PRINTED USER HRIS : ".$getUser."</label> <br />
<label style='font-family: sans;font-size: 14px;'>PRINT DATE &amp; TIME : ".$cenvertedTime."</label> <br />
<label style='font-family: sans;font-size: 14px;'>INTRODUCER PAYMENT SERIAL NUMBER: ".$serial." - Duplicate</label> <br />
</div>
<br />
<div style='float: left;'>
<label style='font-family: sans;font-size: 20px;font-weight: bold;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC</label><br />
<label style='font-family: sans;font-size: 14px;font-weight: bold;'>MEMO OF ADVISING FOR INTRODUCER PAYMENT</label>
</div>
<div style='text-align: right;'>
<img src='log_new_img.png' />
</div>

<br /><br />
<label style='font-family: sans;font-size: 16px;font-weight: bold;'>To: The Manager-Finance Division</label> <br /><br />
<label style='font-family: sans;font-size: 14px;'>Facility Details are as follows,</label> <br /><br />";
echo $rowSelect[0]->load();
echo "<br /><br />";
echo $rowSelect[1]->load();

echo "<br /><br />";
echo $rowSelect[2]->load();
echo "
<span style='font-family: sans;font-size: 14px;'> Account Number : .....................................................</span><br />
<span style='font-family: sans;font-size: 14px;'> Bank 	&amp; Branch 	&nbsp;	&nbsp;: .....................................................</span><br />
<br /><br/>

<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Recommended by</span><br /><br /><br /><br /><br />
<span style='font-family: sans;font-size: 14px;'>.....................................................</span><br />
<span style='font-family: sans;font-size: 14px;font-weight: bold;'> Approved by </span><br />


</div>";
           

        }
        
        }
    }
    
    function isApproveRegenerateLetter($get_approve_reprint_facNumber,$get_reprint_ath_aprove){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
                $sql_Update_regenerate = "UPDATE `sps_regenerate` 
                                    SET `authBy`='".$get_reprint_ath_aprove."',
                                        `authOn`=NOW(),
                                        `status`= 'Approve' 
                                    WHERE `fac_no` = '".$get_approve_reprint_facNumber."' AND  `authOn` = '0000-00-00 00:00:00' AND `authBy` = '';";
                $que_Update_regenerate = mysqli_query($conn,$sql_Update_regenerate) or die(mysqli_error());
                
                 $sql_Update_sps_po_gen = "UPDATE  `sps_po_gen` SET  `print_stats` =  1 WHERE  `fac_no` =  '".$get_approve_reprint_facNumber."';";
                $que_Update_sps_po_gen = mysqli_query($conn,$sql_Update_sps_po_gen) or die(mysqli_error());
                
                if(!$que_Update_regenerate && !$que_Update_sps_po_gen){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Request is Approved Success.";
                } 
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
        
    }
    
    function isRejectRegenerateLetter($get_reject_reprint_facNumber,$get_reprint_ath_reject){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
                $sql_Update_regenerate = "UPDATE `sps_regenerate` 
                                    SET `authBy`='".$get_reprint_ath_reject."',
                                        `authOn`=NOW(),
                                        `status`= 'Reject' 
                                    WHERE `fac_no` = '".$get_reject_reprint_facNumber."' AND  `authOn` = '0000-00-00 00:00:00' AND `authBy` = '';";
                $que_Update_regenerate = mysqli_query($conn,$sql_Update_regenerate) or die(mysqli_error());
                if(!$que_Update_regenerate){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Request is Requested Success.";
                } 
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
//...................................... Function For do the Button..............................................................
    function isInsertDefineLetterTypes($get_LetterTypeCode,$get_Description,$get_val_txtNumOfSig,$user){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = isEmptyletterTypeCode($get_LetterTypeCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal == 0){
                $sql_Inserte = "INSERT INTO `sps_let_types`(`TYPE_CODE`, `TYPE_DESC`, `NUM_OF_SIG`, `ENTERED_BY`, `ENTERED_DATE`) 
                                VALUES ('".$get_LetterTypeCode."','".$get_Description."','".$get_val_txtNumOfSig."','".$user."', now());";
                $que_Inserte = mysqli_query($conn,$sql_Inserte) or die(mysqli_error());
                if(!$que_Inserte){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Saved Success.";
                }
            }else{
                echo $get_LetterTypeCode." is Duplicate Record.";
            }
            
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    function isUpdateDefineLetterTypes($get_LetterTypeCode,$get_Description,$get_val_txtNumOfSig,$user){
         // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = isEmptyletterTypeCode($get_LetterTypeCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                $sql_Update = "UPDATE `sps_let_types` 
                                SET `TYPE_DESC`='".$get_Description."',`NUM_OF_SIG`='".$get_val_txtNumOfSig."',`ENTERED_BY`='".$user."',`ENTERED_DATE`= now() 
                                WHERE `TYPE_CODE` = '".$get_LetterTypeCode."';";
                $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                if(!$que_Update){
                    echo "Record not Update.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Update Success.";
                }
            }else{
                echo $get_LetterTypeCode." is Null Record. < There for Not Updated. >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }

    function isDeleteDefineLetterTypes($get_LetterTypeCode,$get_Description,$get_val_txtNumOfSig,$user){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = isEmptyletterTypeCode($get_LetterTypeCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                $sql_Delete = "DELETE FROM `sps_let_types` WHERE `TYPE_CODE` = '".$get_LetterTypeCode."';";
                $que_Delete = mysqli_query($conn,$sql_Delete) or die(mysqli_error());
                if(!$que_Delete){
                    echo "Record not Deleted.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Delete Success.";
                }
            }else{
                echo $get_LetterTypeCode." is Null Record. < There for can not do Delet recoed >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }

    function selectDataUserGroup($sps_let_types,$GroupCode){
        $conn = DatabaseConnection();
        $getCount = "SELECT COUNT(*) FROM `sps_sig_groups` WHERE `TYPE_CODE` = '".$sps_let_types."' AND `SIG_GRPCODE` = '".$GroupCode."';";
        $queryCount = mysqli_query($conn, $getCount) or die(mysqli_error());
        while($RES_sql = mysqli_fetch_array($queryCount)){
           return   $RES_sql[0];
        }
    }
    
    function isInsertDefineSignatoryGroups($sps_let_types,$GroupCode,$GroupName,$User){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectDataUserGroup($sps_let_types,$GroupCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal == 0){
                $sql_Inserte = "INSERT INTO `sps_sig_groups`(`TYPE_CODE`, `SIG_GRPCODE`, `SIG_GRPNAME`, `ENTERED_BY`, `ENTERED_DATE`) 
                                VALUES ('".$sps_let_types."','".$GroupCode."','".$GroupName."','".$User."',now());";
                $que_Inserte = mysqli_query($conn,$sql_Inserte) or die(mysqli_error());
                if(!$que_Inserte){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Saved Success.";
                }
            }else{
                echo $sps_let_types." and ". $GroupCode . " are Duplicate Record.";
            }
            
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }    
    }
    
    function isUpdateDefineSignatoryGroups ($sps_let_types,$GroupCode,$GroupName,$User){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectDataUserGroup($sps_let_types,$GroupCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                $sql_Update = "UPDATE `sps_sig_groups` 
                                    SET `SIG_GRPNAME`='".$GroupName."', `ENTERED_BY`='".$User."', `ENTERED_DATE`= now() 
                                    WHERE `TYPE_CODE` = '".$sps_let_types."' AND `SIG_GRPCODE` = '".$GroupCode."';";
                $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                if(!$que_Update){
                    echo "Record not Update.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Update Success.";
                }
            }else{
                echo $sps_let_types." and ". $GroupCode ." are Null Record. < There for Not Updated. >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    function isDeleteDefineSignatoryGroups($sps_let_types,$GroupCode,$GroupName,$User){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectDataUserGroup($sps_let_types,$GroupCode);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                $sql_Delete = "DELETE FROM `sps_sig_groups` WHERE `TYPE_CODE` = '".$sps_let_types."' AND `SIG_GRPCODE` = '".$GroupCode."';";
                $que_Delete = mysqli_query($conn,$sql_Delete) or die(mysqli_error());
                if(!$que_Delete){
                    echo "Record not Deleted.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Delete Success.";
                }
            }else{
                echo $sps_let_types." and ". $GroupCode . " are Null Records. < There for can not do Delet recoed >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    function selectsps_sig_groups_users($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group,$dsgu_val_sel_txtUserName){
         $conn = DatabaseConnection();
        $getCount = "SELECT COUNT(*) FROM `sps_sig_groups_users` WHERE `TYPE_CODE` = '".$dsgu_sel_sps_let_types."' AND `SIG_GRPCODE` = '".$dsgu_sel_sug_Signatory_Group."' AND `USER_ID` = '".$dsgu_val_sel_txtUserName."';";
        $queryCount = mysqli_query($conn, $getCount) or die(mysqli_error());
        while($RES_sql = mysqli_fetch_array($queryCount)){
           return   $RES_sql[0];
        }
    }
    
    function selectsps_sig_groups_users_up($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group){
        $conn = DatabaseConnection();
        $getCount = "SELECT COUNT(*) FROM `sps_sig_groups_users` WHERE `TYPE_CODE` = '".$dsgu_sel_sps_let_types."' AND `SIG_GRPCODE` = '".$dsgu_sel_sug_Signatory_Group."';";
        $queryCount = mysqli_query($conn, $getCount) or die(mysqli_error());
        while($RES_sql = mysqli_fetch_array($queryCount)){
           return   $RES_sql[0];
        } 
    }
    
    function isInsert_Define_Signatory_Groups_Users($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group,$dsgu_val_sel_txtUserName,$dsgu_User){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectsps_sig_groups_users($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group,$dsgu_val_sel_txtUserName);
            $couUserNaN = isSelectUserNull($dsgu_val_sel_txtUserName);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal == 0){
                if($couUserNaN != 0){
                    $sql_Inserte = "INSERT INTO `sps_sig_groups_users`(`TYPE_CODE`, `SIG_GRPCODE`, `USER_ID`, `ENTERED_BY`, `ENTERED_DATE`) 
                                    VALUES ('".$dsgu_sel_sps_let_types."','".$dsgu_sel_sug_Signatory_Group."','".$dsgu_val_sel_txtUserName."','".$dsgu_User."',now());";
                    $que_Inserte = mysqli_query($conn,$sql_Inserte) or die(mysqli_error());
                    if(!$que_Inserte){
                        echo "Record not Saved.";
                    }else{
                        mysqli_commit($conn);
                        echo "Record Saved Success.";
                    }
                }else{
                    echo "Undefind  Assign User.";
                }
            }else{
                echo $dsgu_sel_sps_let_types.", ". $dsgu_sel_sug_Signatory_Group . " and ".$dsgu_val_sel_txtUserName." are Duplicate Record.";
            }
            
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }    
    }
    
    function isUpdate_Define_Signatory_Groups_Users($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group,$dsgu_val_sel_txtUserName,$dsgu_User){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectsps_sig_groups_users_up($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group);
            $couUserNaN = isSelectUserNull($dsgu_val_sel_txtUserName);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                if($couUserNaN != 0){
                    $sql_Update = "UPDATE `sps_sig_groups_users` 
                                    SET `USER_ID`='".$dsgu_val_sel_txtUserName."',`ENTERED_BY`='".$dsgu_User."',`ENTERED_DATE`= now() 
                                    WHERE `TYPE_CODE` = '".$dsgu_sel_sps_let_types."' AND `SIG_GRPCODE` = '".$dsgu_sel_sug_Signatory_Group."';";
                    $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                    if(!$que_Update){
                        echo "Record not Update.";
                    }else{
                        mysqli_commit($conn);
                        echo "Record Update Success.";
                    }
                }else{
                    echo "Undefind  Assign User.";
                }
            }else{
                echo $dsgu_sel_sps_let_types.", ". $dsgu_sel_sug_Signatory_Group . " and ".$dsgu_val_sel_txtUserName." are Null Record. < There for Not Updated. >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
    function isDelete_Define_Signatory_Groups_Users($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group,$dsgu_val_sel_txtUserName,$dsgu_User){
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            $countNullVal = selectsps_sig_groups_users_up($dsgu_sel_sps_let_types,$dsgu_sel_sug_Signatory_Group);
            $couUserNaN = isSelectUserNull($dsgu_val_sel_txtUserName);
            date_default_timezone_set('Asia/Colombo');
            if($countNullVal != 0){
                if($couUserNaN != 0){
                    $sql_Delete = "DELETE FROM `sps_sig_groups_users` 
                                    WHERE `TYPE_CODE` = '".$dsgu_sel_sps_let_types."' AND  `SIG_GRPCODE` = '".$dsgu_sel_sug_Signatory_Group."' AND  `USER_ID` = '".$dsgu_val_sel_txtUserName."';";
                    $que_Delete = mysqli_query($conn,$sql_Delete) or die(mysqli_error());
                    if(!$que_Delete){
                        echo "Record not Deleted.";
                    }else{
                        mysqli_commit($conn);
                        echo "Record Delete Success.";
                    }
                    }else{
                        echo "Undefind  Assign User.";
                    }
            }else{
                echo $dsgu_sel_sps_let_types.", ". $dsgu_sel_sug_Signatory_Group . " and ".$dsgu_val_sel_txtUserName." are Null Record. < There for Not Updated. >"; 
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }
    }
    
//.......................... Function For Insert Assign Signatory Groups Frome .........................................................................................
    function isInsert_Assign_Signatory_Groups($asg_sel_sps_let_types,$asg_sel_asg_Signatory_Group,$asg_txtAmount_From,$asg_txtAmount_To,$asg_User){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            $sql_count_slabs = "SELECT COUNT(*) FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."';";
            $que_count_slabs = mysqli_query($conn,$sql_count_slabs) or die(mysqli_error());
            while($res_count_slabs = mysqli_fetch_array($que_count_slabs)){
                $count_slabs = $res_count_slabs[0] + 1; 
            }
            $sql_check_Amount_FROM = "SELECT COUNT(*)
                                        FROM `sps_let_amt_slabs` 
                                        WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."' AND
                                              `AMT_FROM` <= '".$asg_txtAmount_From."' AND `AMT_TO` >= '".$asg_txtAmount_From."';";
            $que_check_Amount_FROM  = mysqli_query($conn,$sql_check_Amount_FROM) or die(mysqli_error());
            while($res_check_Amount_FROM = mysqli_fetch_array($que_check_Amount_FROM)){
              $get_amt_from = $res_check_Amount_FROM[0];
            }
            $sql_check_Amount_TO = "SELECT COUNT(*)
                                        FROM `sps_let_amt_slabs` 
                                        WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."' AND
                                              `AMT_FROM` <= '".$asg_txtAmount_To."' AND `AMT_TO` >= '".$asg_txtAmount_To."';";
            $que_check_Amount_TO  = mysqli_query($conn,$sql_check_Amount_TO) or die(mysqli_error());
            while($res_check_Amount_TO = mysqli_fetch_array($que_check_Amount_TO)){
              $get_amt_TO = $res_check_Amount_TO[0];
            }
            if($get_amt_from == 0 && $get_amt_TO == 0){
                $sql_Inserte = "INSERT INTO `sps_let_amt_slabs`(`TYPE_CODE`, `SLAB_SER`, `AMT_FROM`, `AMT_TO`, `SIG_GRPCODE`, `ENTERED_BY`, `ENTERED_DATE`) 
                                VALUES ('".$asg_sel_sps_let_types."','".$count_slabs."','".$asg_txtAmount_From."','".$asg_txtAmount_To."','".$asg_sel_asg_Signatory_Group."','".$asg_User."',now());";
               // echo $sql_Inserte;
                $que_Inserte = mysqli_query($conn,$sql_Inserte) or die(mysqli_error());
                if(!$que_Inserte){
                    echo "Record not Saved.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Saved Success.";
                }
            }else{
                echo "invalid values for slabe.";
            }
            
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }    
    }
    
    
    function isUpdate_Assign_Signatory_Groups($asg_sel_sps_let_types,$asg_sel_asg_Signatory_Group,$asg_txtAmount_From,$asg_txtAmount_To,$asg_User,$asg_txtsqe){
        // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $sql_count_slabs = "SELECT COUNT(*) FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."' AND `SLAB_SER` = '".$asg_txtsqe."';";
            $que_count_slabs = mysqli_query($conn,$sql_count_slabs) or die(mysqli_error());
            while($res_count_slabs = mysqli_fetch_array($que_count_slabs)){
                $count_slabs = $res_count_slabs[0]; 
            }
            //echo $count_slabs;
            if($count_slabs != 0){
                $sql_Update = "UPDATE `sps_let_amt_slabs` 
                                SET `SIG_GRPCODE` = '".$asg_sel_asg_Signatory_Group."', `ENTERED_BY`= '".$asg_User."' ,`ENTERED_DATE`=now() , `AMT_FROM` = '".$asg_txtAmount_From."' , `AMT_TO` = '".$asg_txtAmount_To."'
                                WHERE `TYPE_CODE`= '".$asg_sel_sps_let_types."' AND `SLAB_SER` = '".$asg_txtsqe."';";
                $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                if(!$que_Update){
                    echo "Record not Update.";
                }else{
                    mysqli_commit($conn);
                    echo "Record Update Success.";
                }
                
            }else{
                echo "Record not Updated. <<Null value>>";
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }    
    }
    
    function isDelete_Assign_Signatory_Groups($asg_sel_sps_let_types,$asg_sel_asg_Signatory_Group,$asg_txtAmount_From,$asg_txtAmount_To,$asg_User,$asg_txtsqe){
         // Set autocommit to off
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $sql_count_slabs = "SELECT COUNT(*) FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."' AND `SLAB_SER` = '".$asg_txtsqe."';";
            $que_count_slabs = mysqli_query($conn,$sql_count_slabs) or die(mysqli_error());
            while($res_count_slabs = mysqli_fetch_array($que_count_slabs)){
                $count_slabs = $res_count_slabs[0]; 
            }
            //echo $count_slabs;
            if($count_slabs != 0){
                $sql_Update = "DELETE FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."' AND  `SLAB_SER` = '".$asg_txtsqe."';";
                $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                if(!$que_Update){
                    echo "Record not Update.";
                }else{
                    $sql_getCount ="SELECT `TYPE_CODE` ,`SIG_GRPCODE`,`AMT_FROM`,`AMT_TO` FROM `sps_let_amt_slabs` WHERE `TYPE_CODE` = '".$asg_sel_sps_let_types."';";
                    $que_getCount = mysqli_query($conn,$sql_getCount) or die(mysqli_error());
                    
                    $x = 0;
                    while($res_getCount = mysqli_fetch_array($que_getCount)){
                        $x++;
                        $sql_Update = "UPDATE `sps_let_amt_slabs` 
                                        SET `SLAB_SER` = '".$x."'
                                        WHERE `TYPE_CODE`= '".$res_getCount[0]."' AND `AMT_FROM` = '".$res_getCount[2]."' AND `AMT_TO` = '".$res_getCount[3]."' AND  `SIG_GRPCODE` = '".$res_getCount[1]."';";
                        
                        //echo $sql_Update;
                        $que_Update = mysqli_query($conn,$sql_Update) or die(mysqli_error());
                    }
                    mysqli_commit($conn);
                    echo "Record Delete Success.";
                }
                
            }else{
                echo "Record not Updated. <<Null value>>";
            }
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }    
    }

//*********************************************************function for Security Printing Authorization***************************************************************************
function is_Security_Printing_Authorization($get_spa_Letter_Type,$get_spa_Batch_Number,$get_spa_Amount_Slab_001,$val_spa_Amount_Slab_002,$get_spa_user){
    //echo $get_spa_Letter_Type."--".$get_spa_Batch_Number."--".$get_spa_Amount_Slab_001."--".$val_spa_Amount_Slab_002."--".$get_spa_user;
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
           $sql_update_1 = "UPDATE `sps_let_gen` 
                            SET `AUTH_1_BY` = '".$get_spa_user."', `AUTH_1_DATE` = now()
                            WHERE `AUTH_1_BY` = '' AND 
                                  `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                  `AUTH_2_BY` = '' AND 
                                  `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                  `BATCH_NUM` = '".$get_spa_Batch_Number."' AND 
                                  (`dep_amt` BETWEEN '".$get_spa_Amount_Slab_001."' AND '".$val_spa_Amount_Slab_002."');";
           //echo $sql_update_1."<br/>";
           $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
           $sql_update_2 = "UPDATE `sps_let_gen` 
                            SET `AUTH_2_BY` = '".$get_spa_user."',`AUTH_2_DATE` = now()
                            WHERE `AUTH_1_BY` != '".$get_spa_user."' AND 
                                  `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                  `AUTH_2_BY` = '' AND 
                                  `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                  `BATCH_NUM` = '".$get_spa_Batch_Number."' AND 
                                  (`dep_amt` BETWEEN '".$get_spa_Amount_Slab_001."' AND '".$val_spa_Amount_Slab_002."');";
          // echo $sql_update_2."<br/>";
           $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
           
           $sql_select_ath = "SELECT COUNT(*) 
                              FROM `sps_let_gen` 
                              WHERE `AUTH_2_BY` = '' AND
                                    `AUTH_2_DATE` = '0000-00-00 00:00:00' AND `BATCH_NUM` = '".$get_spa_Batch_Number."';"; 
           $que_select_ath = mysqli_query($conn, $sql_select_ath) or die(mysqli_error());
           while($RES_select_ath = mysqli_fetch_array($que_select_ath)){
                if($RES_select_ath[0] == 0){
                    mysqli_query($conn,"UPDATE `sps_let_batch` SET `BATCH_STAT`= 'A' WHERE `BATCH_NUM` = '".$get_spa_Batch_Number."';") or die(mysqli_error());
                }
           } 
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }  
}

function is_Security_Printing_Authorization_PO($get_spa_CBD_PO,$get_spa_Amount_Slab_001_PO,$val_spa_Amount_Slab_002_PO,$var_user_PO_auth,$var_PO_type){
    //echo $get_spa_CBD_PO."--".$get_spa_Amount_Slab_001_PO."--".$val_spa_Amount_Slab_002_PO."--".$var_user_PO_auth."--".$var_PO_type." - Get Function";
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
           $sql_update_1 = "UPDATE `sps_po_gen` 
                                SET `AUTH_1_BY`='".$var_user_PO_auth."',
                                    `AUTH_1_DATE`= NOW()
                                WHERE `AUTH_1_BY` = '' AND 
                                      `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                      `AUTH_2_BY` = '' AND 
                                      `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                      `cbd` = '".$get_spa_CBD_PO."' AND
                                      `TYPE_CODE` = '".$var_PO_type."' AND
                                      `AUTH_1_BY` != '".$var_user_PO_auth."' AND
                                      (`asset_price` BETWEEN '".$get_spa_Amount_Slab_001_PO."' AND '".$val_spa_Amount_Slab_002_PO."');";
           //echo $sql_update_1."<br/>";
           $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
           $sql_update_2 = "UPDATE `sps_po_gen` 
                                SET `AUTH_2_BY`='".$var_user_PO_auth."',
                                    `AUTH_2_DATE`= NOW(),
                                    `print_stats` = '1'
                                WHERE `AUTH_1_BY` != '".$var_user_PO_auth."' AND 
                                      `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                      `AUTH_2_BY` = '' AND 
                                      `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                      `cbd` = '".$get_spa_CBD_PO."' AND
                                      `TYPE_CODE` = '".$var_PO_type."' AND
                                      `AUTH_2_BY` != '".$var_user_PO_auth."' AND
                                      (`asset_price` BETWEEN '".$get_spa_Amount_Slab_001_PO."' AND '".$val_spa_Amount_Slab_002_PO."');";
          // echo $sql_update_2."<br/>";
           $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        }  
}


//-----------------------------CBL05 Authorization ------------------------------
//function is_Security_Printing_CBL05($var_user_BC_new_auth,$var_BC_txtV_INDEX)
function is_Security_Printing_CBL05($get_spa_Batch_Numbercbl05,$get_spa_usercbl05){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            
                    $sql_update_1 = "UPDATE `sps_cbl05_gen` 
                                        SET `AUTH_2_BY`='".$get_spa_usercbl05."',
                                            `AUTH_2_DATE`= NOW() ,
                                            `print_stats` = 1
                                        WHERE `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `BATCH_NUM` = '".$get_spa_Batch_Numbercbl05."';";
                  // echo $sql_update_2."<br/>";
                   $que_update_2 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
                   //isSendCoureHelpdesk($conn,$array_facNumber[$x]); // function for Couriar..............................................
                 $sql_update_cbl05 = "UPDATE sps_cbl05_let_batch As s
                                        SET s.BATCH_STAT = 'A'
                                        WHERE s.BATCH_NUM = '".$get_spa_Batch_Numbercbl05."';" ;
                    $que_update_cbl05 = mysqli_query($conn,$sql_update_cbl05) or die(mysqli_error());
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        } 
}


//----------------------------------end of cbl05 Authorization--------------------
function is_Security_Printing_Authorization_New_BC($var_user_BC_new_auth,$var_BC_txtV_INDEX){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $array_facNumber = explode("|",$var_BC_txtV_INDEX);
            
            for($x = 0; $x < sizeof($array_facNumber) ; $x++){
                if($array_facNumber[$x] != ""){
                   // echo $array_facNumber[$x]."<br/>";
                    $sql_update_1 = "UPDATE `sps_balance_confirmation` 
                                        SET `AUTH_1_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_1_DATE`= NOW()
                                        WHERE `AUTH_1_BY` = '' AND 
                                              `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                   //echo $sql_update_1."<br/>";
                   $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
                   $sql_update_2 = "UPDATE `sps_balance_confirmation` 
                                        SET `AUTH_2_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_2_DATE`= NOW(),
                                            `print_stats` = '1'
                                        WHERE `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND 
                                              `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                  // echo $sql_update_2."<br/>";
                   $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
                   //isSendCoureHelpdesk($conn,$array_facNumber[$x]); // function for Couriar..............................................
                }
                //echo $array_facNumber[$x];
            }
            
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        } 

}

//---------------- 2018-01-24 Madushan (Authrizetion for nominee confermetion)

function is_Security_P_A_NomineeConfametion($var_user_BC_new_auth,$var_BC_txtV_INDEX){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $array_facNumber = explode("|",$var_BC_txtV_INDEX);
            
            for($x = 0; $x < sizeof($array_facNumber) ; $x++){
                if($array_facNumber[$x] != ""){
                   // echo $array_facNumber[$x]."<br/>";
                    $sql_update_1 = "UPDATE `sps_conf_nominee_dtl` 
                                        SET `AUTH_1_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_1_DATE`= NOW()
                                        WHERE `AUTH_1_BY` = '' AND 
                                              `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                   //echo $sql_update_1."<br/>";
                   $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
                   
                   $sql_update_2 = "UPDATE `sps_conf_nominee_dtl` 
                                        SET `AUTH_2_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_2_DATE`= NOW(),
                                            `PRINT_STATUS` = 'A'
                                        WHERE `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND 
                                              `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                  // echo $sql_update_2."<br/>";
                  //echo $sql_update_2;
                   $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
                   //isSendCoureHelpdesk($conn,$array_facNumber[$x]); // function for Couriar..............................................
                }
                //echo $array_facNumber[$x];
            }
            
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        } 
} 

//----------------------------------------Confermation of nominee Bulk -------------------------

function is_Security_P_A_NomineeConfametion_bulk($var_user_BC_new_auth,$var_BC_txtV_INDEX){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $array_facNumber = explode("|",$var_BC_txtV_INDEX);
            
            for($x = 0; $x < sizeof($array_facNumber) ; $x++){
                if($array_facNumber[$x] != ""){
                   // echo $array_facNumber[$x]."<br/>";
                    $sql_update_1 = "UPDATE `sps_conf_nominee_dtl_bulk` 
                                        SET `AUTH_1_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_1_DATE`= NOW()
                                        WHERE `AUTH_1_BY` = '' AND 
                                              `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                   //echo $sql_update_1."<br/>";
                   $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
                   
                   $sql_update_2 = "UPDATE `sps_conf_nominee_dtl_bulk` 
                                        SET `AUTH_2_BY`='".$var_user_BC_new_auth."',
                                            `AUTH_2_DATE`= NOW(),
                                            `PRINT_STATUS` = 'A'
                                        WHERE `AUTH_1_BY` != '".$var_user_BC_new_auth."' AND 
                                              `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` != '".$var_user_BC_new_auth."' AND
                                              `V_INDEX` = '".$array_facNumber[$x]."';";
                  // echo $sql_update_2."<br/>";
                  //echo $sql_update_2;
                   $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
                   //isSendCoureHelpdesk($conn,$array_facNumber[$x]); // function for Couriar..............................................
                }
                //echo $array_facNumber[$x];
            }
            
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        } 
} 



function is_Security_Printing_Authorization_New_PO($get_spa_CBD_new_PO,$get_spa_Amount_Slab_001_new_PO,$val_spa_Amount_Slab_002_new_PO,$var_user_PO_new_auth,$var_PO_new_type,$var_facNo){
       $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            date_default_timezone_set('Asia/Colombo');
            
            $array_facNumber = explode("|",$var_facNo);
            
            for($x = 0; $x < sizeof($array_facNumber) ; $x++){
                if($array_facNumber[$x] != ""){
                   // echo $array_facNumber[$x]."<br/>";
                    if($var_PO_new_type == "UCLEPO"){
                        $sql_update_1 = "UPDATE `ucl_sps_po_gen` ";
                    }else{
                        $sql_update_1 = "UPDATE `sps_po_gen` ";
                    }
                    
                    
                    $sql_update_1 .= "SET `AUTH_1_BY`='".$var_user_PO_new_auth."',
                                    `AUTH_1_DATE`= NOW()
                                WHERE `AUTH_1_BY` = '' AND 
                                      `AUTH_1_DATE` = '0000-00-00 00:00:00' AND 
                                      `AUTH_2_BY` = '' AND 
                                      `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                      `cbd` = '".$get_spa_CBD_new_PO."' AND
                                      `TYPE_CODE` = '".$var_PO_new_type."' AND
                                      `AUTH_1_BY` != '".$var_user_PO_new_auth."' AND
                                      `fac_no` = '".$array_facNumber[$x]."' AND
                                      (`asset_price` BETWEEN '".$get_spa_Amount_Slab_001_new_PO."' AND '".$val_spa_Amount_Slab_002_new_PO."');";
                   //echo $sql_update_1."<br/>";
                   $que_update_1 = mysqli_query($conn,$sql_update_1) or die(mysqli_error());
                   
                    if($var_PO_new_type == "UCLEPO"){
                        $sql_update_2 = "UPDATE `ucl_sps_po_gen` ";
                    }else{
                        $sql_update_2 = "UPDATE `sps_po_gen` ";
                    }
               
                                     $sql_update_2 .=  "SET `AUTH_2_BY`='".$var_user_PO_new_auth."',
                                            `AUTH_2_DATE`= NOW(),
                                            `print_stats` = '1'
                                        WHERE `AUTH_1_BY` != '".$var_user_PO_new_auth."' AND 
                                              `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                                              `AUTH_2_BY` = '' AND 
                                              `AUTH_2_DATE` = '0000-00-00 00:00:00' AND 
                                              `cbd` = '".$get_spa_CBD_new_PO."' AND
                                              `TYPE_CODE` = '".$var_PO_new_type."' AND
                                              `AUTH_2_BY` != '".$var_user_PO_new_auth."' AND
                                              `fac_no` = '".$array_facNumber[$x]."' AND
                                              (`asset_price` BETWEEN '".$get_spa_Amount_Slab_001_new_PO."' AND '".$val_spa_Amount_Slab_002_new_PO."');";
                  // echo $sql_update_2."<br/>";
                   $que_update_2 = mysqli_query($conn,$sql_update_2) or die(mysqli_error());
                   isSendCoureHelpdesk($conn,$array_facNumber[$x]); // function for Couriar..............................................
                }
                //echo $array_facNumber[$x];
            }
            
           mysqli_commit($conn);
           echo "Record Authorization Success.";
        }catch(Exception $e){
            // Rollback transaction
            mysqli_rollback($conn);
            echo 'Message: ' .$e->getMessage();
        } 
}

//-----------------------------------------------------------------------------------------------------------
function isSendCoureHelpdesk($conn,$fac_no){
    $sql_load_data_print = "SELECT `fac_no`
                         FROM `sps_po_gen`
                         WHERE `AUTH_1_BY` != '' AND 
                              `AUTH_1_DATE` != '0000-00-00 00:00:00' AND 
                              `AUTH_2_BY` != '' AND 
                              `AUTH_2_DATE` != '0000-00-00 00:00:00' AND 
                              `fac_no` = '".$fac_no."';";
    $que_load_data_print = mysqli_query($conn,$sql_load_data_print) or die(mysqli_error());
    $q = 1;
    $helpid = "";
    while($rec_load_data_print = mysqli_fetch_array($que_load_data_print)){
        //$sendBranch = substr($rec_load_data_print[0],0,4);
        $fac_no = $rec_load_data_print[0];
        $sql_department = "SELECT `helpid`,`enterBy`,`entry_branch`,`entry_department`,`scat_code_2` FROM `cdb_helpdesk` WHERE `facno` = '".$rec_load_data_print[0]."';";
        $query_department = mysqli_query($conn,$sql_department) or die(mysqli_error($conn));
        while($rec_department = mysqli_fetch_array($query_department)){
            $helpid = $rec_department[0];
            $enterBy = $rec_department[1];
            $sendBranch = $rec_department[2];
            $sendDepartment = $rec_department[3];
            $scat_code_2 = $rec_department[4];
        }
        
    }
    if($helpid != ""){
        $sql_cou_status = "SELECT sc2.IsCourierStatus , sc2.docList , sc2.couriertype FROM scat_02 AS sc2 WHERE sc2.scat_code_2 = '".$scat_code_2."' AND sc2.IsCourierStatus = 1;";
        $quer_cou_status = mysqli_query($conn,$sql_cou_status) or die(mysqli_error($conn));
        while($rec_cou_status = mysqli_fetch_array($quer_cou_status)){
            if($rec_cou_status[0] == 1){
                $array_document = explode("|",$rec_cou_status[1]);
                $numOfDoc = sizeof($array_document);
                
                $statCount1 ="SELECT `count` ,`year` FROM `filesnumbergenaret` where `branch`='".$sendBranch."' AND `serial`='file' AND`department`='".$sendDepartment."' AND `year` = year(now())";
                $sql_statCount1=mysqli_query($conn,$statCount1);
                while($add_statCount1=mysqli_fetch_array($sql_statCount1)){
            		if($add_statCount1[0]==0){
            		 	$fileNumber = $sendBranch.$sendDepartment.$add_statCount1[1]."000001";
            			$cou = $add_statCount1[0] + 1;
            		}else{
            		 	$fileNumber = $sendBranch.$sendDepartment.$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT);
            			$cou = $add_statCount1[0] + 1;
            		}
                }   
                                            
                $file_name = $sendBranch." ".$sendDepartment." ".$fac_no." (".$helpid.")";
                $remark = $fac_no." (".$helpid.")";
                $currentowner = $enterBy; 
                
                $statUpdate ="SELECT `serial` FROM filesNumberGenaret  where `branch`='".$sendBranch."' AND `department`='".$sendDepartment."' AND `year` = year(now())";
        		$sql_statUpdate=mysqli_query($conn,$statUpdate);                      
        		while($add_statUpdate=mysqli_fetch_array($sql_statUpdate)){
        			$fileCount ="UPDATE `filesnumbergenaret`  SET `count`= '".$cou."'  WHERE `branch`= '".$sendBranch."' AND `department`='".$sendDepartment."' AND `year` = year(now()) AND `serial`='".$add_statUpdate[0]."'";
        			$updateFileCount = mysqli_query($conn,$fileCount) or die(mysqli_error($conn));
        		}
                
                if($fileNumber != ""){
                    $addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) 
                                                VALUES('".$fileNumber."','".$file_name."','".$currentowner."' ,'','9519',  '0001' ,'JC','".$numOfDoc."','".$rec_cou_status[2]."','".$sendBranch."','".$sendDepartment."','".$remark."','".$currentowner."',now(),'','NO')";
                    $query1 = mysqli_query($conn,$addsq1) or die(mysqli_error($conn));
                    
                    $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',now(),'File Created','".$currentowner."')";
                    $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
                    //echo $fileNumber;
                    for($r = 0 ; $r<$numOfDoc; $r++){
                        //echo "<script> alert('".$r."');</script>";  
                        //echo "<script> alert('".$array_document[$r]."');</script>";
                        $DocName = "SELECT `documentName` FROM `courier_masters_document` WHERE `documentNumber` = '".$array_document[$r]."';";
                        $sql_DocName= mysqli_query($conn,$DocName) or die(mysqli_error($conn));
                        while($rec_DocName = mysqli_fetch_array($sql_DocName)){
                              $addsq2= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
                                     VALUES('".$array_document[$r]."','".$rec_DocName[0]."','".$fileNumber."',now(),'YES','YES')";
                              $result2= mysqli_query($conn,$addsq2)  or die(mysqli_error($conn));
                        }
                      	
                    }                             
                }else{
                    echo "Error in file number generation. ERP-ERROR";
                }		
            }
                    
        }
    }
}

//***************************** Select User*************************************************
function isSelectUser($userID){
    $conn = DatabaseConnection();
    $sqli_select_User = "SELECT `userID` FROM `user` WHERE `userName` = '".$userID."';";
    $q_select_User =  mysqli_query($conn, $sqli_select_User) or die(mysqli_error());
    while($res_select_User  = mysqli_fetch_assoc($q_select_User)){
        return $res_select_User['userID'];
    }
}
function isSelectUserNull($userID){
    $conn = DatabaseConnection();
    $sqli_select_User = "SELECT count(`userName`) FROM `user` WHERE `userName` = '".$userID."';";
    $q_select_User =  mysqli_query($conn, $sqli_select_User) or die(mysqli_error());
    while($res_select_User  = mysqli_fetch_array($q_select_User)){
        return $res_select_User[0];
    }
}
?>
