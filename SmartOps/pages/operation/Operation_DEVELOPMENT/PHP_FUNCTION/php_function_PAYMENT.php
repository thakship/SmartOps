<?php
    function SMSSender($ConnERP , $MOBILE_NO, $MESSAGE,$GENERATED_SOURCE){
        date_default_timezone_set('Asia/Colombo');
        $SERIAL = 1;
        if ( substr($MOBILE_NO,0,2) =='07'){
            $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) VALUES ('".$MOBILE_NO."','".$MESSAGE."',now(),'HELPDESK','".$GENERATED_SOURCE."',0);";
            $query_sms =  mysqli_query($ConnERP,$sql_sms) or die(mysqli_error($ConnERP));                                                    
        }
    }
        
    function CreateNote($ConnERP , $HELP_ID,$NOTE,$USER){
        date_default_timezone_set('Asia/Colombo');
        $SERIAL = 1;
    
        /*Get the Max count of Note*/
        $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$HELP_ID."';";
        $query_select_note_count = mysqli_query($ConnERP , $sql_select_note_count) or die(mysqli_error($ConnERP));
        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
            $SERIAL = $rec_select_note_count[0] + 1;    
        }
        
        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES (".$HELP_ID.",'".$SERIAL."','".$NOTE."','".$USER."',now(),'CreateNote');";
        $query_note_update = mysqli_query($ConnERP,$sql_note_update) or die(mysqli_error($ConnERP));
    }    


    if(isset($_POST['get_ksrl_helpid']) && isset($_POST['get_chk_1']) && isset($_POST['get_chk_2']) && isset($_POST['get_chk_3']) && isset($_POST['get_chk_4']) && isset($_POST['get_chk_5']) && isset($_POST['get_chk_6']) && isset($_POST['get_ksrl_user']) && isset($_POST['get_ksrl_pn']) && isset($_POST['get_title']) ){
        //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6'];
        if($_POST['get_title'] == 1 ){
            is_update_ok_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 2 ){
           // is_update_pending_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
            is_update_pending_function_COD($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 3 ){
            //echo $_POST['get_ksrl_helpid']."OK";
            is_update_Doc_verifity($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'R' ){
            KioskRecommendation($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'C' ){
            KioslUclRejection($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }


        
        
        //is_update_ok_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
    }
    
    if(isset($_POST['get_qc_code']) && isset($_POST['get_ksrl_helpidINS']) && isset($_POST['get_chk_1']) && isset($_POST['get_chk_2']) && isset($_POST['get_chk_3']) && isset($_POST['get_chk_4']) && isset($_POST['get_chk_5']) && isset($_POST['get_chk_6']) && isset($_POST['get_ksrl_user']) && isset($_POST['get_ksrl_pn']) && isset($_POST['get_title']) ){
        //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6'];
        //echo $_POST['get_qc_code'];
        if($_POST['get_title'] == 1 ){
            is_update_ok_function($_POST['get_ksrl_helpidINS'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 2 ){
           // is_update_pending_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
            is_update_pending_function_INS($_POST['get_qc_code'],$_POST['get_ksrl_helpidINS'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'R' ){
            KioskRecommendation($_POST['get_ksrl_helpidINS'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'C' ){
            KioslUclRejection($_POST['get_ksrl_helpidINS'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        
        
        //is_update_ok_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
    }
    
    
    if(isset($_POST['get_UCL_appNUmber']) && isset($_POST['get_UCL_app_ksrl_helpid']) && isset($_POST['get_UCL_app_ksrl_user'])){
        //echo $_POST['get_UCL_appNUmber']."--".$_POST['get_UCL_app_ksrl_helpid']."--".$_POST['get_UCL_app_ksrl_user']." OK";
        KioslUclGenFecNumber($_POST['get_UCL_appNUmber'],$_POST['get_UCL_app_ksrl_helpid'],$_POST['get_UCL_app_ksrl_user']);
    }
    
    
    if(isset($_POST['get_appNUmber']) && isset($_POST['get_app_ksrl_helpid']) && isset($_POST['get_app_ksrl_user'])){
       // echo $_POST['get_appNUmber']."--".$_POST['get_app_ksrl_helpid']."--".$_POST['get_app_ksrl_user']."OK";
        is_upadate_applicetion($_POST['get_appNUmber'],$_POST['get_app_ksrl_helpid'],$_POST['get_app_ksrl_user']);
    }
    
    if(isset($_POST['get_assuser'])){
        //is_update_assing_user(trim($_POST['get_assuser']),trim($_POST['get_aass_ksrl_helpid']));
        is_update_REleseedPayment_PROCUSER(trim($_POST['get_assuser']),trim($_POST['get_aass_ksrl_helpid'])); // 2017-01-30 (Madushan)is_update_COD_FILE_PROCUSER
   
    }
    
    if(isset($_POST['get_backtocodassuser']) && isset($_POST['get_backtocod_helpid']) && isset($_POST['getbacktocod_dis'])){
       
        is_update_backToCOD(trim($_POST['get_backtocodassuser']),trim($_POST['get_backtocod_helpid']),trim($_POST['getbacktocod_dis'])); // 2019-03-29 (Madushan)back to COD
   
    }
    
    if(isset($_POST['get_assuserrmv']) && isset($_POST['get_aass_ksrl_helpidrmv']) && isset($_POST['pagerefrmv'])){
   
        is_update_rmv_assign_user(trim($_POST['get_assuserrmv']),trim($_POST['get_aass_ksrl_helpidrmv']) , trim($_POST['pagerefrmv'])); // 2019-03-27 (Madushan)
   
    }
    
    
    
    if(isset($_REQUEST['get_HI_Scan']) && isset($_REQUEST['get_user_Scan'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        is_update_Scan($_POST['get_HI_Scan'],$_POST['get_user_Scan']);
        
    }
    
 //   if(isset($_POST['getCDPUQCUserrmvlodge']) && isset($_POST['getCDPUQCHelpIDrmvlodge']) && isset($_POST['getPageTitle']) && isset($_POST['getrmv_officer'])){
    //    echo $_POST['getCDPUQCUserrmvlodge']."--".$_POST['getCDPUQCHelpIDrmvlodge']."OK";
   //    is_update_rmv_updated($_POST['getCDPUQCUserrmvlodge'],$_POST['getCDPUQCHelpIDrmvlodge'],$_POST['getPageTitle'],$_POST['getrmv_officer']);
        
    
   if(isset($_POST['getCDPUQCUserrmvlodge']) && isset($_POST['getCDPUQCHelpIDrmvlodge']) && isset($_POST['getPageTitle']) && isset($_POST['getrmv_officer']) && isset($_POST['getrmv_vehicle']) && isset($_POST['getrmv_Cr_Stat_name']) && isset($_POST['getrmv_Cr_Stat_code']) ){
               is_update_rmv_updated($_POST['getCDPUQCUserrmvlodge'],$_POST['getCDPUQCHelpIDrmvlodge'],$_POST['getPageTitle'],$_POST['getrmv_officer'], $_POST['getrmv_vehicle'] , $_POST['getrmv_Cr_Stat_name'] , $_POST['getrmv_Cr_Stat_code']);
            
        
    }
    if(isset($_POST['getCDPUQCUser']) && isset($_POST['getCDPUQCHelpID'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        is_update_CDPUUser($_POST['getCDPUQCUser'],$_POST['getCDPUQCHelpID']);
       
        
    }
    if(isset($_POST['getSecurityDOCQCUser']) && isset($_POST['getSecurityDOCQCHelpID'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        is_update_SecurityDOCQC($_POST['getSecurityDOCQCUser'],$_POST['getSecurityDOCQCHelpID']);
        
    }
     if(isset($_POST['getInsuranceDOCQCUser']) && isset($_POST['getInsuranceDOCQCHelpID'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        is_update_InsuranceDOCQC($_POST['getInsuranceDOCQCUser'],$_POST['getInsuranceDOCQCHelpID']);
        
    }
    
    if(isset($_POST['getPendingHelpid']) && isset($_POST['getPendingEnrtyBy']) && isset($_POST['getPendingComent'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        isPendingNotified($_POST['getPendingHelpid'],$_POST['getPendingEnrtyBy'],$_POST['getPendingComent']);
        
    }
    
     if(isset($_POST['getPermentReleaseHelpID']) && isset($_POST['getPermentReleaseEntryBy'])){
        isPermentRelease($_POST['getPermentReleaseHelpID'],$_POST['getPermentReleaseEntryBy']);
        
    }
    
    if(isset($_POST['getPaymentCompletedHelpID']) && isset($_POST['getPaymentCompletedEntryBy']) && isset($_POST['getpaymentMode'])){
        isPaymentCompleted($_POST['getPaymentCompletedHelpID'],$_POST['getPaymentCompletedEntryBy'],$_POST['getpaymentMode']);  
    }
    
    
    //.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
    //............................................................................................................................
    
    function is_update_CDPUUser($getCDPUQCUser,$getCDPUQCHelpID){
         $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
           //echo $getCDPUQCUser. "  -  ".$getCDPUQCHelpID;
           $sql_update = "UPDATE `cdb_helpdesk` SET `QC_CDPU_BY`='".$getCDPUQCUser."',`QC_CDPU_ON`=NOW() WHERE `helpid` = '".$getCDPUQCHelpID."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $his = helpdeskHisInsert($conn,$getCDPUQCHelpID);
            
            if($query_update && $his){
                mysqli_commit($conn);
                echo "OK";
                
            }else{
                echo "NOT";
            }
           
           
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
        
    }
    
    
    function is_update_rmv_updated($getCDPUQCUserrmvlodge,$getCDPUQCHelpIDrmvlodge,$page_title, $rmv_officer , $rmv_vehicle , $rmv_Cr_Stat_name,$rmv_Cr_Stat_code){
         $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            
             if($page_title == 'RMVLodge'){
                 //echo $getCDPUQCUserrmvlodge. "  -  ".$getCDPUQCHelpIDrmvlodge;
                   $sql_update = "UPDATE `rmv_header` 
                                     SET `RmvLogBy`='".$getCDPUQCUserrmvlodge."',
                                          `RmvLogDate`=NOW() ,
                                          `RMV_OFFICER`= '".$rmv_officer."'
                                   WHERE `helpid` = '".$getCDPUQCHelpIDrmvlodge."';";
                    //echo $sql_update." -- ";
                    $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
             }
            if ($page_title == 'RMVConfirmation'){
    				$sql_update   = "update `rmv_header` 
                                        set `rmv_header`.`RmvConfirmedBy` = '".$getCDPUQCUserrmvlodge."' ,
                                             `rmv_header`.`RmvConfirmedOn` = now(),
                                             `rmv_header`.RmvConfStatus = 1
                                      WHERE `rmv_header`.`helpid` = '".$getCDPUQCHelpIDrmvlodge."';";
                    //echo $sql_update;
    				$query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                  
            }
               if ($page_title == 'RMVToBeReceived'){
    				$sql_update   = "update `rmv_header` 
                                        set `rmv_header`.`CR_ReceivedBy` = '".$getCDPUQCUserrmvlodge."' ,
                                             `rmv_header`.`CR_ReceivedOn` = now(),
                                             `rmv_header`.`CR_VehicleNo` = '".$rmv_vehicle."',
                                             `rmv_header`.`CR_Place` = '".$rmv_Cr_Stat_code."',
                                             `rmv_header`.`CR_Status` = '".$rmv_Cr_Stat_name."'
                                      WHERE `rmv_header`.`helpid` = '".$getCDPUQCHelpIDrmvlodge."';";
                    //echo $sql_update;
    				$query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                  
            }
            
            
          
         
            if($query_update){
                mysqli_commit($conn);
                echo "OK";
                
            }else{
                echo "NOT";
            }
           
           
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
        
    }
    
    function is_update_SecurityDOCQC($getSecurityDOCQCUser,$getSecurityDOCQCHelpID){
         $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
           //echo $getCDPUQCUser. "  -  ".$getCDPUQCHelpID;
           $sql_update = "UPDATE `cdb_helpdesk` SET `QC_SECDOCS_BY`='".$getSecurityDOCQCUser."',`QC_SECDOCS_ON`=NOW() WHERE `helpid` = '".$getSecurityDOCQCHelpID."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
             $his = helpdeskHisInsert($conn,$getSecurityDOCQCHelpID);
            if($query_update && $his){
                mysqli_commit($conn);
                echo "OK";
                
            }else{
                echo "NOT";
            }
           
           
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    function is_update_InsuranceDOCQC($getInsuranceDOCQCUser,$getInsuranceDOCQCHelpID){
         $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
           //echo $getCDPUQCUser. "  -  ".$getCDPUQCHelpID;
           $sql_update = "UPDATE `cdb_helpdesk` SET `QC_INS_BY`='".$getInsuranceDOCQCUser."',`QC_INS_ON`=NOW() WHERE `helpid` = '".$getInsuranceDOCQCHelpID."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            
            $his = helpdeskHisInsert($conn,$getInsuranceDOCQCHelpID);
            
            if($query_update && $his){
                mysqli_commit($conn);
                echo "OK";
                
            }else{
                echo "NOT";
            }
           
           
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    function helpdeskHisInsert($conn,$helpId){
        $sqlSelect = "SELECT helpid, cat_code, scat_code_1, scat_code_2, cmb_code, ur_code, pr_code, issue, help_discr, enterBy, enterDateTime, attachment_name, caloser_by, caloser_dateTime, resulution, solution, inner_brCode, inner_dept, inner_user, inner_remark, inner_get, entry_branch, entry_department, solved_by, solved_on, s_type, scat_code_3, asing_by, act_by, act_on, reOpen, ipAddress, ssb_type, ssb_cycle, ssb_facility_amount, ssb_app_number, ssb_app_entry, IsAppValid, facno, curr_stage, assign_to, taken_by, attachment_namesub, isdisbursed, disbdate, isScanned, ScannedDate, scannedBy, cif, lastactivityon, appcrdate, decision_discription, defPassword, facno_stats, attachmentlbl, COD_START_DATE, COD_STATUS, COD_LAST_EVENT, COD_LAST_EVENT_DT, COD_FILE_VERIFIED_BY, COD_FILE_VERIFIED_ON, COD_CHG_REC_BY, COD_CHG_REC_ON, COD_DO_PRINT_BY, COD_DO_PRINT_ON, COD_FILE_PROCUSER, COD_CHKLIST_BY, COD_CHKLIST_ON, AUX_01, AUX_02, COD_DISB_BY, Linked_helpid, QC_CDPU_BY, QC_CDPU_ON, QC_CDPU_DATA, QC_SECDOCS_BY, QC_SECDOCS_ON, QC_SECDOCS_DATA, QC_INS_BY, QC_INS_ON, QC_INS_ON_DATA 
                        FROM cdb_helpdesk
                        WHERE helpid = '".$helpId."';";
        $querySelect = mysqli_query($conn,$sqlSelect) or die(mysqli_error($conn));
        while($resaltSelect = mysqli_fetch_assoc($querySelect)){
            $sqlInsete = "INSERT INTO cdberp.cdb_helpdesk_his(
   helpid
  ,cat_code
  ,scat_code_1
  ,scat_code_2
  ,cmb_code
  ,ur_code
  ,pr_code
  ,issue
  ,help_discr
  ,enterBy
  ,enterDateTime
  ,attachment_name
  ,caloser_by
  ,caloser_dateTime
  ,resulution
  ,solution
  ,inner_brCode
  ,inner_dept
  ,inner_user
  ,inner_remark
  ,inner_get
  ,entry_branch
  ,entry_department
  ,solved_by
  ,solved_on
  ,s_type
  ,scat_code_3
  ,asing_by
  ,act_by
  ,act_on
  ,reOpen
  ,ipAddress
  ,ssb_type
  ,ssb_cycle
  ,ssb_facility_amount
  ,ssb_app_number
  ,ssb_app_entry
  ,IsAppValid
  ,facno
  ,curr_stage
  ,assign_to
  ,taken_by
  ,attachment_namesub
  ,isdisbursed
  ,disbdate
  ,isScanned
  ,ScannedDate
  ,scannedBy
  ,cif
  ,lastactivityon
  ,appcrdate
  ,decision_discription
  ,defPassword
  ,facno_stats
  ,attachmentlbl
  ,COD_START_DATE
  ,COD_STATUS
  ,COD_LAST_EVENT
  ,COD_LAST_EVENT_DT
  ,COD_FILE_VERIFIED_BY
  ,COD_FILE_VERIFIED_ON
  ,COD_CHG_REC_BY
  ,COD_CHG_REC_ON
  ,COD_DO_PRINT_BY
  ,COD_DO_PRINT_ON
  ,COD_FILE_PROCUSER
  ,COD_CHKLIST_BY
  ,COD_CHKLIST_ON
  ,AUX_01
  ,AUX_02
  ,COD_DISB_BY
  ,Linked_helpid
  ,QC_CDPU_BY
  ,QC_CDPU_ON
  ,QC_CDPU_DATA
  ,QC_SECDOCS_BY
  ,QC_SECDOCS_ON
  ,QC_SECDOCS_DATA
  ,QC_INS_BY
  ,QC_INS_ON
  ,QC_INS_ON_DATA
) VALUES ('".$resaltSelect['helpid']."','".$resaltSelect['cat_code']."','".$resaltSelect['scat_code_1']."','".$resaltSelect['scat_code_2']."','".$resaltSelect['cmb_code']."','".$resaltSelect['ur_code']."','".$resaltSelect['pr_code']."','".$resaltSelect['issue']."','".$resaltSelect['help_discr']."','".$resaltSelect['enterBy']."','".$resaltSelect['enterDateTime']."','".$resaltSelect['attachment_name']."','".$resaltSelect['caloser_by']."','".$resaltSelect['caloser_dateTime']."','".$resaltSelect['resulution']."','".$resaltSelect['solution']."','".$resaltSelect['inner_brCode']."','".$resaltSelect['inner_dept']."','".$resaltSelect['inner_user']."','".$resaltSelect['inner_remark']."','".$resaltSelect['inner_get']."','".$resaltSelect['entry_branch']."','".$resaltSelect['entry_department']."','".$resaltSelect['solved_by']."','".$resaltSelect['solved_on']."','".$resaltSelect['s_type']."','".$resaltSelect['scat_code_3']."','".$resaltSelect['asing_by']."','".$resaltSelect['act_by']."','".$resaltSelect['act_on']."','".$resaltSelect['reOpen']."','".$resaltSelect['ipAddress']."','".$resaltSelect['ssb_type']."','".$resaltSelect['ssb_cycle']."','".$resaltSelect['ssb_facility_amount']."','".$resaltSelect['ssb_app_number']."','".$resaltSelect['ssb_app_entry']."','".$resaltSelect['IsAppValid']."','".$resaltSelect['facno']."','".$resaltSelect['curr_stage']."','".$resaltSelect['assign_to']."','".$resaltSelect['taken_by']."','".$resaltSelect['attachment_namesub']."','".$resaltSelect['isdisbursed']."','".$resaltSelect['disbdate']."','".$resaltSelect['isScanned']."','".$resaltSelect['ScannedDate']."','".$resaltSelect['scannedBy']."','".$resaltSelect['cif']."','".$resaltSelect['lastactivityon']."','".$resaltSelect['appcrdate']."','".$resaltSelect['decision_discription']."','".$resaltSelect['defPassword']."','".$resaltSelect['facno_stats']."','".$resaltSelect['attachmentlbl']."','".$resaltSelect['COD_START_DATE']."','".$resaltSelect['COD_STATUS']."','".$resaltSelect['COD_LAST_EVENT']."','".$resaltSelect['COD_LAST_EVENT_DT']."','".$resaltSelect['COD_FILE_VERIFIED_BY']."','".$resaltSelect['COD_FILE_VERIFIED_ON']."','".$resaltSelect['COD_CHG_REC_BY']."','".$resaltSelect['COD_CHG_REC_ON']."','".$resaltSelect['COD_DO_PRINT_BY']."','".$resaltSelect['COD_DO_PRINT_ON']."','".$resaltSelect['COD_FILE_PROCUSER']."','".$resaltSelect['COD_CHKLIST_BY']."','".$resaltSelect['COD_CHKLIST_ON']."','".$resaltSelect['AUX_01']."','".$resaltSelect['AUX_02']."','".$resaltSelect['COD_DISB_BY']."','".$resaltSelect['Linked_helpid']."','".$resaltSelect['QC_CDPU_BY']."','".$resaltSelect['QC_CDPU_ON']."','".$resaltSelect['QC_CDPU_DATA']."','".$resaltSelect['QC_SECDOCS_BY']."','".$resaltSelect['QC_SECDOCS_ON']."','".$resaltSelect['QC_SECDOCS_DATA']."','".$resaltSelect['QC_INS_BY']."','".$resaltSelect['QC_INS_ON']."','".$resaltSelect['QC_INS_ON_DATA']."');";
        
$queryInser = mysqli_query($conn,$sqlInsete) or die(mysqli_error($conn));
return $queryInser;
      
        }
    }
    
    function is_update_ok_function($get_ksrl_helpid,$get_chk_1,$get_chk_2,$get_chk_3,$get_chk_4,$get_chk_5,$get_chk_6,$get_ksrl_user,$get_ksrl_pn){
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid." -- ".$get_chk_1." -- ".$get_chk_2." -- ".$get_chk_3." -- ".$get_chk_4." -- ".$get_chk_5." -- ".$get_chk_6;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.COD_FILE_VERIFIED_BY = '".$get_ksrl_user."' , chd.COD_FILE_VERIFIED_ON = now() 
                            WHERE chd.helpid = '".$get_ksrl_helpid."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            
            $sql_insert = "UPDATE cod_cdb_ssb 
                            SET applicant_info = '".$get_chk_1."' ,
                                clear_valuation = '".$get_chk_2."' ,
                                guarantor_1 = '".$get_chk_3."' ,
                                guarantor_2 = '".$get_chk_4."' ,
                                cr_copy_and_invoce = '".$get_chk_5."' ,
                                supplar_info = '".$get_chk_6."' ,
                                pending_notification = '".$get_ksrl_pn."'
                             WHERE helpid = '".$get_ksrl_helpid."';";
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            
            /*$sql_insert = "INSERT INTO `cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info` , `pending_notification`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."');";*/
            $sql_insert_his = "INSERT INTO `cod_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."',now(),'".$get_ksrl_user."','V');";
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            
            $sql_select_note_count   = "call SP_CreateNote('".$get_ksrl_helpid."','File Verified by COD','".$get_ksrl_user."','FILE_VERIFIED')";  
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            

            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount`, `entry_branch` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
$query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn));
$r = 1;
while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
    //$r = $res_cou_cycal[0] + 1;
    $entry_branch = $res_cou_cycal[4];

    $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".$entry_branch."'";
    $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
    $to = "";
    $to_cc = "";
    $subject = "COD File Verified alert!";
    $messageBodyIn = "
<h4>File Verified alert!</h4>
<label>Ref :".$get_ksrl_helpid."</label><br /><br />
<label>File Verified by COD','".$get_ksrl_user."</label><br />
<label>File : ".$res_cou_cycal[2]."</label><br />
<label>Amount : ".$res_cou_cycal[3]."</label><br />";
            
    $sender = $get_ksrl_user;
    while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
        if($rec_getbranchdtl[0] != ""){
            $to = getUserEmail($conn,$rec_getbranchdtl[0]);
        }
                
        if($rec_getbranchdtl[1] != ""){
            $to_cc = getUserEmail($conn,$rec_getbranchdtl[1]);
        }
    }
            //echo $to;
    if($to != ""){
        mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
    }
}
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
           
            if($sql_update && $query_inset && $query_inset_his){
                mysqli_commit($conn);
                echo "OK";
            }else{
                echo "NOT";
            }
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
   /* function is_update_pending_function($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                 $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'Pending Notified - ".$r."' , chd.ssb_cycle = '".$r."', chd.lastactivityon = now()
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
                 //echo $sql_update." -- ";
                    
                 $query_update =  mysqli_query($conn,$sql_update) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                 $sql_insert = "UPDATE cdb_ssb 
                            SET applicant_info = '".$get_chk_1_pen."',
                                clear_valuation = '".$get_chk_2_pen."',
                                guarantor_1 = '".$get_chk_3_pen."',
                                guarantor_2 = '".$get_chk_4_pen."',
                                cr_copy_and_invoce = '".$get_chk_5_pen."',
                                supplar_info = '".$get_chk_6_pen."',
                                pending_notification = '".$get_ksrl_pn_pen."'
                             WHERE helpid = '".$get_ksrl_helpid_pen."';";
                        $sql_insert_his = "INSERT INTO `cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."',now(),'".$get_ksrl_user_pen."','P');";
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    $query_inset =  mysqli_query($conn,$sql_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Pending info alert!".chr(10)."Ref :".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));                                                    
                    }
                                        
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                        VALUES (".$get_ksrl_helpid_pen.",'".$cou."',CONCAT('Pending Notified - ".$r." - ".$get_ksrl_pn_pen." on ', now()),'".$get_ksrl_user_pen."',now(),'PENDING_NOTIFIED');";
                        //echo $sql_note_update;
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                        mysqli_commit($conn);
                        echo "OK";
                    }else{
                        echo "NOT";
                    }
            }
           
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }*/

//-------------------------------- 2018-12-21 (Madushan) --------- function for is_update_Doc_verifity

function is_update_Doc_verifity($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
   // echo "Function OK ".$get_ksrl_helpid_pen . " - ".$get_ksrl_user_pen;
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        // Validation rule engine
        date_default_timezone_set('Asia/Colombo');
        $sql_update = "UPDATE cdb_helpdesk AS chd 
                          SET chd.doc_verifity = 1 , 
                              chd.doc_verifity_by = '".$get_ksrl_user_pen."' ,
                              chd.doc_verifity_on = now()
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
        //echo $sql_update." -- ";
        $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));

        $cou = 1;
        $sql_select_note_count =  "SELECT max(CAST(`note_code` AS SIGNED)) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
        //echo $sql_select_note_count;
        $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
            $cou = $rec_select_note_count[0] + 1;
            $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                                    VALUES (".$get_ksrl_helpid_pen.",'".$cou."',CONCAT('COD Document verifity  on ', now()),'".$get_ksrl_user_pen."',now(),'COD_OPERATION');";
            //echo $sql_note_update;
            $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
        }

        if($query_update && $query_note_update){
            mysqli_commit($conn);
            echo "OK";
        }else{
            echo "NOT";
        }

    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }

}
    
//-----------------------   2017-01-30 (Madushan ) ---- function for send pending notificetion for COD --------------------------------------------------------------------------------------------------------------------------------------------------------------------

function is_update_pending_function_COD($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
    $conn = DatabaseConnection();
    //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen;
    mysqli_autocommit($conn,FALSE);
    try{
        // Validation rule engine
        date_default_timezone_set('Asia/Colombo');
        // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
        $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount`, `entry_branch` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn));
        $r = 1;
        while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
            //$r = $res_cou_cycal[0] + 1;
            $entry_branch = $res_cou_cycal[4];
            $sql_update = "UPDATE cdb_helpdesk AS chd SET chd.COD_LAST_EVENT = 'Pending Notified.' , chd.COD_LAST_EVENT_DT = now()
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $sql_COUNT_CODssb = "SELECT COUNT(*) FROM `cod_cdb_ssb` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
            $query_COUNT_CODssb = mysqli_query($conn,$sql_COUNT_CODssb) or die(mysqli_error($conn));
            while($rec_COUNT_CODssb = mysqli_fetch_array($query_COUNT_CODssb)){
                if($rec_COUNT_CODssb[0] != 0){
                    $sql_insert = "UPDATE cod_cdb_ssb SET applicant_info = '".$get_chk_1_pen."',
                                                          clear_valuation = '".$get_chk_2_pen."',
                                                          guarantor_1 = '".$get_chk_3_pen."',
                                                          guarantor_2 = '".$get_chk_4_pen."',
                                                          cr_copy_and_invoce = '".$get_chk_5_pen."',
                                                          supplar_info = '".$get_chk_6_pen."',
                                                          pending_notification = '".$get_ksrl_pn_pen."'
                                                          WHERE helpid = '".$get_ksrl_helpid_pen."';";
                }else{
                    $sql_insert = "INSERT INTO `cod_cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`, `pending_notification`) 
                                                     VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."');";
                        
                }
            }
                 
            $sql_insert_his = "INSERT INTO `cod_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                                                     VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."',now(),'".$get_ksrl_user_pen."','P');";
                    
            //echo $sql_insert;
            //echo $sql_insert_his;
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            // 
            if ( substr($res_cou_cycal[1],0,2) =='07'){
                /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Pending info alert!".chr(10)."Ref :".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));           */  
                        
                
                                               
            }
                                        
            $cou = 1;
            $sql_select_note_count =  "SELECT max(CAST(`note_code` AS SIGNED)) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
            //echo $sql_select_note_count;
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES (".$get_ksrl_helpid_pen.",'".$cou."',CONCAT('COD Pending Notified - ".$get_ksrl_pn_pen." on ', now()),'".$get_ksrl_user_pen."',now(),'COD_OPERATION');";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            //$entry_branch
            $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".$entry_branch."'";
            $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
            $to = "";
            $to_cc = "";
            $subject = "COD Pending info alert!";
            $messageBodyIn = "
<h4>Pending info alert!</h4>
<label>Ref :".$get_ksrl_helpid_pen."</label><br /><br />
<label>".$get_ksrl_pn_pen."</label><br />
<label>File : ".$res_cou_cycal[2]."</label><br />
<label>Amount : ".$res_cou_cycal[3]."</label><br />
<label>COD Officer : ".$get_ksrl_user_pen."</label><br />";
            $sender = $get_ksrl_user_pen;
            while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                if($rec_getbranchdtl[0] != ""){
                    $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                }
                
                if($rec_getbranchdtl[1] != ""){
                    $to_cc = getUserEmail($conn,$rec_getbranchdtl[1]);
                }
            }
            //echo $to;
            if($to != ""){
                 mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
            }
           
            
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                mysqli_commit($conn);
                echo "OK";
            }else{
                echo "NOT";
            }
        }
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}
    
function is_update_pending_function_INS($INS,$get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
    $conn = DatabaseConnection();
    //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen;
    mysqli_autocommit($conn,FALSE);
    try{
        // Validation rule engine
        date_default_timezone_set('Asia/Colombo');
        // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
        $V_Str = $INS." Pending Notified.";
        $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount`, `entry_branch` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn));
        $r = 1;
        while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
            //$r = $res_cou_cycal[0] + 1;
            $entry_branch = $res_cou_cycal[4];
            $sql_update = "UPDATE cdb_helpdesk AS chd SET chd.COD_LAST_EVENT = '".$V_Str."' , chd.COD_LAST_EVENT_DT = now()
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $sql_COUNT_CODssb = "SELECT COUNT(*) FROM `cod_cdb_ssb` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
            $query_COUNT_CODssb = mysqli_query($conn,$sql_COUNT_CODssb) or die(mysqli_error($conn));
            while($rec_COUNT_CODssb = mysqli_fetch_array($query_COUNT_CODssb)){
                if($rec_COUNT_CODssb[0] != 0){
                    $sql_insert = "UPDATE cod_cdb_ssb SET applicant_info = '".$get_chk_1_pen."',
                                                          clear_valuation = '".$get_chk_2_pen."',
                                                          guarantor_1 = '".$get_chk_3_pen."',
                                                          guarantor_2 = '".$get_chk_4_pen."',
                                                          cr_copy_and_invoce = '".$get_chk_5_pen."',
                                                          supplar_info = '".$get_chk_6_pen."',
                                                          pending_notification = '".$get_ksrl_pn_pen."'
                                                          WHERE helpid = '".$get_ksrl_helpid_pen."';";
                }else{
                    $sql_insert = "INSERT INTO `cod_cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`, `pending_notification`) 
                                                     VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."');";
                        
                }
            }
                 
            $sql_insert_his = "INSERT INTO `cod_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                                                     VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."',now(),'".$get_ksrl_user_pen."','P');";
                    
            //echo $sql_insert;
            //echo $sql_insert_his;
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            // 
            if ( substr($res_cou_cycal[1],0,2) =='07'){
                /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Pending info alert!".chr(10)."Ref :".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));           */  
                        
                
                                               
            }
                                        
            $cou = 1;
            $sql_select_note_count =  "SELECT max(CAST(`note_code` AS SIGNED)) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
            //echo $sql_select_note_count;
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES (".$get_ksrl_helpid_pen.",'".$cou."',CONCAT('".$V_Str." - ".$get_ksrl_pn_pen." on ', now()),'".$get_ksrl_user_pen."',now(),'COD_OPERATION');";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            //$entry_branch
            $sql_getBrandtl = "SELECT b.BOH AS  BOH , b.BOIC AS BOIC FROM branch AS b WHERE b.branchNumber = '".$entry_branch."'";
            $query_getBrandtl = mysqli_query($conn,$sql_getBrandtl) or die(mysqli_error($conn));
            $to = "";
            $to_cc = "";
            $subject = "COD Pending info alert!";
            $messageBodyIn = "
<h4>Pending info alert!</h4>
<label>Ref :".$get_ksrl_helpid_pen."</label><br /><br />
<label>".$get_ksrl_pn_pen."</label><br />
<label>File : ".$res_cou_cycal[2]."</label><br />
<label>Amount : ".$res_cou_cycal[3]."</label><br />
<label>COD Officer : ".$get_ksrl_user_pen."</label><br />";
            $sender = $get_ksrl_user_pen;
            while($rec_getbranchdtl = mysqli_fetch_array($query_getBrandtl)){
                if($rec_getbranchdtl[0] != ""){
                    $to = getUserEmail($conn,$rec_getbranchdtl[0]);
                }
                
                if($rec_getbranchdtl[1] != ""){
                    $to_cc = getUserEmail($conn,$rec_getbranchdtl[1]);
                }
            }
            //echo $to;
            if($to != ""){
                 mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
            }
           
            
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                mysqli_commit($conn);
                echo "OK";
            }else{
                echo "NOT";
            }
        }
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}

    
    function is_upadate_applicetion($get_appNUmber,$get_app_ksrl_helpid,$get_app_ksrl_user){
        //echo $get_appNUmber."--".$get_app_ksrl_helpid."--".$get_app_ksrl_user."function";
         $conn = DatabaseConnection();
        //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_select_cou_help = "SELECT COUNT(*) FROM cdb_helpdesk AS chl WHERE chl.helpid = '".$get_app_ksrl_helpid."';";
            $query_select_cou_help = mysqli_query($conn , $sql_select_cou_help) or die(mysqli_error($conn));
            while($rec_select_cou_help = mysqli_fetch_array($query_select_cou_help)){
                if($rec_select_cou_help[0] == 1 ){
                    $sql_update_app = "UPDATE `cdb_helpdesk` SET `appcrdate` = now(), `ssb_app_number`= '".$get_appNUmber."' , `ssb_app_entry` = '".$get_app_ksrl_user."', `ssb_type` = 'Application Created',`lastactivityon` = now() WHERE  `helpid` = '".$get_app_ksrl_helpid."';";
                    //echo $sql_update_app;
                    $que_update_app = mysqli_query($conn , $sql_update_app) or die(mysqli_error($conn));
                    $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress` , `ssb_type`, `ssb_cycle`, `ssb_facility_amount`, `ssb_app_number`, `ssb_app_entry` FROM `cdb_helpdesk` WHERE `helpid` = '".$get_app_ksrl_helpid."';";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                    $que_his = mysqli_query($conn,$sql_his) or die(mysqli_error($conn));        
                    while($RES_his = mysqli_fetch_assoc($que_his)){
                        $iss_mail = $RES_his['issue'];
                        $fac_amount_mail = $RES_his['ssb_facility_amount'];
                        
                         $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress`,`ssb_type`,`ssb_cycle`,`ssb_facility_amount`,`ssb_app_number`,`ssb_app_entry`,`lastactivityon`)
                                            VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".$RES_his['issue']."', '".$RES_his['help_discr']."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".$RES_his['resulution']."', '".$RES_his['solution']."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."','".$RES_his['ipAddress']."','".$RES_his['ssb_type']."','".$RES_his['ssb_cycle']."','".$RES_his['ssb_facility_amount']."','".$RES_his['ssb_app_number']."','".$RES_his['ssb_app_entry']."',now());";
                         //echo $v_getSQL_insert_2;
                        $que_getSQL_insert_2 = mysqli_query($conn,$v_getSQL_insert_2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                        $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_app_ksrl_helpid."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
            
                        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
                        $r = 1;
                         while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                            if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('CDPU alert!".chr(10)."Application Created".chr(10)."Ref : ".$get_app_ksrl_helpid.chr(10)."Applicetion : ".$get_appNUmber.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                                    $query_sms =  mysqli_query($conn,$sql_sms) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));                                                    
                            }
                         }
                    }
                    
                                        
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_app_ksrl_helpid."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                        VALUES (".$get_app_ksrl_helpid.",'".$cou."',CONCAT('Application Created - ".$get_appNUmber." on ', now()),'".$get_app_ksrl_user."',now(),'APP_CREATED');";
                        //echo $sql_note_update;
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    if($que_update_app && $que_getSQL_insert_2){
                        if(strlen($get_appNUmber) == 10){
                            $get_mail_ucl = "";
                            $sql_get_mail_add = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = '6' AND `para_status` = 'A';";
                            $que_get_mail_add = mysqli_query($conn,$sql_get_mail_add) or die(mysqli_error($conn));
                            while($rec_get_mail_add = mysqli_fetch_array($que_get_mail_add)){
                                $get_mail_ucl = $rec_get_mail_add[0];
                            }
                            if($get_mail_ucl != ""){
                            $to = $get_mail_ucl;
                            $subject = "CDB Help Desk : UCL Application Acknowledgement!";
                                
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Service Request ID</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$get_app_ksrl_helpid."</td>
    </tr>
    	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue :</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$iss_mail."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Facility Amount</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$fac_amount_mail."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Applicetion Number</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$get_appNUmber."</td>
    </tr>
 </table>
</body>
</html>";
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                		
                                						// More headers
                                $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                mail($to,$subject,$message,$headers);
                            }
                            
                        }
                        echo "OK";
                    }else{
                        echo "NOT";
                    }
                }else if($rec_select_cou_help[0] > 1 ){
                    echo "HelpI ID is duplicate.";
                }else{
                    echo "Help ID is Invalied.";
                    
                }
            }
            
        
             mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
     /* function is_update_assing_user($get_assuser,$get_aass_ksrl_helpid){
        //echo $get_assuser."--".$get_aass_ksrl_helpid."OK";
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            $sql_update_asing = "UPDATE `cdb_helpdesk` SET `asing_by`= '".$get_assuser."' WHERE `helpid` = '".$get_aass_ksrl_helpid."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(mysqli_error($conn));
            if($que_update_asing){
                echo "OK";
            }else{
                echo "NOT";
            }
            mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }   
    */
    
    // -------------------------------- 2017-01-30 (Madushan) - Function For assing user in COD_FILE_PROCUSER
    function is_update_REleseedPayment_PROCUSER($get_assuser,$get_aass_ksrl_helpid){
        //echo $get_assuser."--".$get_aass_ksrl_helpid."OK";
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            $sql_update_asing = "UPDATE cdb_helpdesk_operation_payment 
                                    SET released_payments_assignBy = '".$get_assuser."',
                                        released_payments_assignOn = NOW()
                                   WHERE helpid = '".$get_aass_ksrl_helpid."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(mysqli_error($conn));
            if($que_update_asing){
                echo "OK";
            }else{
                echo "NOT";
            }
            mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }   
    
    // ------------------------------------ 2019-03-29 (madushan) - function for update back To COD
    
    function is_update_backToCOD($user , $helpID , $comment){
         $conn = DatabaseConnection();
        // echo $user. " - ".$helpID." - ".$comment;
         mysqli_autocommit($conn,FALSE);
         try{
        // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            
            $paymentQC_dtl = "SELECT c.PAYMENT_RELEASE_BY , i.email , c.issue
                                FROM cdb_helpdesk AS c , user AS i
                                where  c.helpid = '".$helpID."'
                                and c.PAYMENT_RELEASE_BY = i.userName;";
             $query_paymentQC_dtl = mysqli_query($conn,$paymentQC_dtl) or die(mysqli_error($conn));
             while($rec_paymentQC_dtl = mysqli_fetch_array($query_paymentQC_dtl)){
               $V_PAYMENT_RELEASE_BY = $rec_paymentQC_dtl[0];
               $V_email = $rec_paymentQC_dtl[1];
               $V_issue = $rec_paymentQC_dtl[2];
             }
            
            
            
            $sql_update_helpdesk = "UPDATE cdb_helpdesk AS ch
                                        SET ch.PAYMENT_RELEASE_BY = NULL,
                                            ch.PAYMENT_RELEASE_ON = '0000-00-00 00:00:00'
                                        WHERE ch.helpid = '".$helpID."';";
            $query_update_helpdesk = mysqli_query($conn,$sql_update_helpdesk) or die(mysqli_error($conn));
            
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$helpID."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                        
                    
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                         VALUES (".$helpID.",'".$cou."',CONCAT('Payment Release Back to COD on ', now() , '".$comment."'),'".$user."',now(),'OPERATION');";
                //echo $sql_note_update;
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
           
            }
            
                     
          if($query_update_helpdesk && $query_note_update){
            if($V_email != ""){
                $to = $V_email;
                $to_cc = "";
                $subject = "Payment Release Back to COD!";
                $messageBodyIn = "
                        <h4>Payment Release Back to COD!</h4>
                        <label>Ref :".$helpID."</label><br /><br />
                        <label>File Back to COD by ','".$user."</label><br />
                        <label>File : ".$V_issue."</label><br />
                        <label>Back to comment : ".$comment."</label><br />";
                            
                $sender = $user;
                     //echo $to;
                    if($to != ""){
                        mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);
                    }
            }
            
            
            mysqli_commit($conn);
            
            
             echo "OK";
             
          }else{
            mysqli_rollback($conn);
            echo "NOT";
            
          }
         
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    // -------------------------------- 2019-03-27 (Madushan) - Function For assing user in RMV Header
     function is_update_rmv_assign_user($get_assuser,$get_aass_ksrl_helpid,$page_title){
        
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            if($page_title == 'RMVLodge'){
                $sql_update   = "update `rmv_header` 
                                        set `rmv_header`.`RmvLogAssignBy` = '".$get_assuser."' ,
                                             `rmv_header`.`RmvLogAssignOn` = now()
                                      WHERE `rmv_header`.`helpid` = '".$get_aass_ksrl_helpid."';";
                    //echo $sql_update;
    				$query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                    
                      
            }
            if ($page_title == 'RMVConfirmation'){
    				$sql_update   = "update `rmv_header` 
                                        set `rmv_header`.`RmvConfirmedAssignBy` = '".$get_assuser."' ,
                                             `rmv_header`.`RmvConfirmedAssignOn` = now()
                                      WHERE `rmv_header`.`helpid` = '".$get_aass_ksrl_helpid."';";
                    //echo $sql_update;
    				$query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            }
            if($query_update){
                echo "OK";
            }else{
                echo "NOT";
            }
            mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }   
    
    
    
    function  is_update_Scan($get_HI_Scan,$get_user_Scan){
       $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update_asing = "update `cdb_helpdesk`
                                    set `cdb_helpdesk`.`isScanned` = 1,
                                          `cdb_helpdesk`.`ScannedDate` = now(),
                                          `cdb_helpdesk`.`scannedBy` = '".$get_user_Scan."'
                                    where `cdb_helpdesk`.`helpid` = '".$get_HI_Scan."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(mysqli_error($conn));
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_HI_Scan."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                VALUES (".$get_HI_Scan.",'".$cou."',CONCAT('File Scanned - on ', now()),'".$get_user_Scan."',now(),'FILE_SCANNED');";
                //echo $sql_note_update;
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            if($que_update_asing){
                echo "OK";
            }else{
                echo "NOT";
            }
            mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        } 
    }
    
function KioslUclRejection($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
/* --------------------------------------------------------------------------------------------------- 
This function is to reject the UCL file with Notification SMS to Marketing Officer and Note creatoion
Developed by Rizvi Kareem on 1:17 PM 25/03/2016
--------------------------------------------------------------------------------------------------- */
    date_default_timezone_set('Asia/Colombo');
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{      
        $HelpDeskSql = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` , `ssb_app_number` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
        $Q_HelpDesk =  mysqli_query($conn,$HelpDeskSql) or die(mysqli_error($conn));
        while($res_cou_cycal = mysqli_fetch_array($Q_HelpDesk)){
            $sql_HelpDesk_update = "UPDATE cdb_helpdesk AS chd SET chd.ssb_type = 'File Rejected',chd.cmb_code='5002',chd.caloser_dateTime= now(),chd.caloser_by = '".$get_ksrl_user_pen."',chd.solved_by = '".$get_ksrl_user_pen."',chd.solved_on = now() WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
            $query_update =  mysqli_query($conn,$sql_HelpDesk_update) or die(mysqli_error($conn));
                        
            CreateNote($conn , $get_ksrl_helpid_pen,"File Rejected : " . $get_ksrl_pn_pen,$get_ksrl_user_pen);
            
            SMSSender($conn , $res_cou_cycal[1], "File Rejected : " . $get_ksrl_pn_pen . " App No : " . $res_cou_cycal[4] ,"UCL_REJECT");
            if($query_update){
                echo "OK";
            }else{
                echo "NOT";
            }
            
            mysqli_commit($conn);
        }
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo 'Message: '.$e->getMessage();
    }
}



/*------------------------------------------ START OF KioskRecommendation --------------------------------------------------------------------*/    
    function KioskRecommendation($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` , `ssb_app_number` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                $iss_mail = $res_cou_cycal[2];
                $fac_amount_mail = $res_cou_cycal[3];
                $get_appNUmber =  $res_cou_cycal[4];
                
                 $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Recommended by CR Evaluation'  ,
                                chd.facno_stats = 1
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
                            /*$sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Recommended by CR Evaluation' ,
                                chd.cmb_code='5002',
                                chd.caloser_dateTime= now(),
                                chd.caloser_by = '".$get_ksrl_user_pen."',
                                chd.solved_by = '".$get_ksrl_user_pen."',
                                chd.solved_on = now() 
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";*/
                            
                 //echo $sql_update." -- ";
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                 
                 
                 $sql_insert = "UPDATE cdb_ssb 
                            SET applicant_info = '".$get_chk_1_pen."',
                                clear_valuation = '".$get_chk_2_pen."',
                                guarantor_1 = '".$get_chk_3_pen."',
                                guarantor_2 = '".$get_chk_4_pen."',
                                cr_copy_and_invoce = '".$get_chk_5_pen."',
                                supplar_info = '".$get_chk_6_pen."',
                                pending_notification = '".$get_ksrl_pn_pen."'
                             WHERE helpid = '".$get_ksrl_helpid_pen."';";
                    $sql_insert_his = "INSERT INTO `cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."',now(),'".$get_ksrl_user_pen."','R');";
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
                    $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
                    
                    // UCL EMAIL 12:10 PM 13/05/2016 - Done by madushan
                    //operations@unisons.lk;asanka.madubashini@cdbnet.lk;    
                    
                    //--------------------------------------------------------------------------------------------
                    
                    // 
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Recommendation acknowledgement!".chr(10)."Ref :".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }
                                        
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                        VALUES (".$get_ksrl_helpid_pen.",'".$cou."',CONCAT('Recommendation acknowledged on ', now()),'".$get_ksrl_user_pen."',now(),'RECCMD_ACK');";
                        //echo $sql_note_update;
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                        mysqli_commit($conn);
                            $get_mail_ucl = "";
                            $sql_get_mail_add = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = '6' AND `para_status` = 'A';";
                            $que_get_mail_add = mysqli_query($conn,$sql_get_mail_add) or die(mysqli_error($conn));
                            while($rec_get_mail_add = mysqli_fetch_array($que_get_mail_add)){
                                $get_mail_ucl = $rec_get_mail_add[0];
                            }
                            if($get_mail_ucl != ""){
                            $to = $get_mail_ucl;
                            $subject = "CDB Help Desk : UCL Application Recommended!";
                                
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Service Request ID</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$get_ksrl_helpid_pen."</td>
    </tr>
    	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue :</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$iss_mail."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Facility Amount</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$fac_amount_mail."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Applicetion Number</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$get_appNUmber."</td>
    </tr>
 </table>
</body>
</html>";
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                		
                                						// More headers
                                $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                mail($to,$subject,$message,$headers);
                            }
                            

                        echo "OK";
                    }else{
                        echo "NOT";
                    }
            }
           
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
/*------------------------------------------ END OF --------------------------------------------------------------------*/

function KioslUclGenFecNumber($get_UCL_appNUmber,$get_UCL_app_ksrl_helpid,$get_UCL_app_ksrl_user){
    $conn = DatabaseConnection();
        //echo $get_UCL_appNUmber." - ".$get_UCL_app_ksrl_helpid." - ".$get_UCL_app_ksrl_user." - Function OK";
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` , `ssb_app_number` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_UCL_app_ksrl_helpid."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                $iss_mail = $res_cou_cycal[2];
                $fac_amount_mail = $res_cou_cycal[3];
                $get_appNUmber =  $res_cou_cycal[4];
                
                $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress` , `ssb_type`, `ssb_cycle`, `ssb_facility_amount`, `ssb_app_number`, `ssb_app_entry`, `facno_stats` FROM `cdb_helpdesk` WHERE `helpid` = '".$get_UCL_app_ksrl_helpid."';";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                $que_his = mysqli_query($conn,$sql_his) or die(mysqli_error($conn));        
                while($RES_his = mysqli_fetch_assoc($que_his)){
        
                     $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress`,`ssb_type`,`ssb_cycle`,`ssb_facility_amount`,`ssb_app_number`,`ssb_app_entry`, `facno_stats`)
                                        VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".$RES_his['issue']."', '".$RES_his['help_discr']."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".$RES_his['resulution']."', '".$RES_his['solution']."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."','".$RES_his['ipAddress']."','".$RES_his['ssb_type']."','".$RES_his['ssb_cycle']."','".$RES_his['ssb_facility_amount']."','".$RES_his['ssb_app_number']."','".$RES_his['ssb_app_entry']."','".$RES_his['facno_stats']."');";
                     //echo $v_getSQL_insert_2;
                    $que_getSQL_insert_2 = mysqli_query($conn,$v_getSQL_insert_2) or die(mysqli_error($conn));
                }
                 /*$sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Recommended by CR Evaluation'  
                            WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";*/
                            $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'Facility Number Updated By ".$get_UCL_app_ksrl_user." Fac : ".$get_UCL_appNUmber."' ,
                                chd.facno = '".$get_UCL_appNUmber."' ,
                                chd.facno_stats = 2 ,
                                chd.cmb_code='5002',
                                chd.caloser_dateTime= now(),
                                chd.caloser_by = '".$get_UCL_app_ksrl_user."',
                                chd.solved_by = '".$get_UCL_app_ksrl_user."',
                                chd.solved_on = now() 
                            WHERE chd.helpid = '".$get_UCL_app_ksrl_helpid."';";
                            
                 //echo $sql_update." -- ";
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                 
                 
                 
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_UCL_app_ksrl_helpid."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                 
                    /*if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Facility Number Updated!".chr(10)."Facility Number :".$get_UCL_appNUmber.chr(10). "Gen BY : ".$get_UCL_app_ksrl_user."', now()),now(),'HELPDESK','FACNUMNOTE',0);";
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }*/
                                        
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                        VALUES (".$get_UCL_app_ksrl_helpid.",'".$cou."',CONCAT('Facility Number Updated on ', now()),'".$get_UCL_app_ksrl_user."',now(),'FACNO_UPDATED');";
                        //echo $sql_note_update;
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                   
                   if($sql_update && $query_note_update){
                        mysqli_commit($conn);

                        echo "OK";
                    }else{
                        echo "NOT";
                    }
            }
           
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
}



//------------------------------------------------------- 2017-08-03 Pending Notied ------------
function isPendingNotified($Helpid, $EnrtyBy, $PendingComent){
    //echo $Helpid." - ".$EnrtyBy;
     $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$Helpid."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                        
                    
            $cou = 1;
            $PendingComent1 = "Operation Notify Pending : ".$PendingComent;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                         VALUES (".$Helpid.",'".$cou."','".$PendingComent1."','".$EnrtyBy."',now(),'OPERATION');";
                //echo $sql_note_update;
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                
                $getdtlHelp = "SELECT ch.helpid , ch.entry_branch , br.branchName , br.BOH ,br.BOIC 
                                FROM cdb_helpdesk AS ch , branch AS br 
                                WHERE ch.entry_branch = br.branchNumber AND
                                		ch.helpid = '".$Helpid."';";
                $q_getdtlHelp = mysqli_query($conn,$getdtlHelp) or die(mysqli_error($conn));
                while($r_getdtlHelp = mysqli_fetch_array($q_getdtlHelp)){
                     $to = getUserEmail($conn,$r_getdtlHelp[4]);
                     $to_cc = getUserEmail($conn,$r_getdtlHelp[3]);
                     $subject = "Operation Notify Pending";
                     $messageBodyIn = $PendingComent;
                     $sender = "SYSTEM";
                     if($to != ""){
                        mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender);   
                     } 
                }
               
            }
            echo "OK";
             mysqli_commit($conn);
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
       
    
}
function isPermentRelease($getPermentReleaseHelpID, $EntryBy){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
        // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update_helpdesk = "UPDATE cdb_helpdesk AS ch
                                        SET ch.PAYMENT_RELEASE_BY = '".$EntryBy."',
                                            ch.PAYMENT_RELEASE_ON = NOW()
                                        WHERE ch.helpid = '".$getPermentReleaseHelpID."';";
            $query_update_helpdesk = mysqli_query($conn,$sql_update_helpdesk) or die(mysqli_error($conn));
            
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$getPermentReleaseHelpID."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                        
                    
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                         VALUES (".$getPermentReleaseHelpID.",'".$cou."',CONCAT('Payment Released on ', now()),'".$EntryBy."',now(),'OPERATION');";
                //echo $sql_note_update;
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
           
            }
            
             //-------------------------- 2017-10-13 --- Madushan Wickramaarachchi ------- Genarete New SR ----------------------------
             $sql_select_user = "SELECT u.branchNumber , u.deparmentNumber
                                    FROM user AS u
                                    WHERE u.userName = '".$EntryBy."';";
            $query_select_user = mysqli_query($conn,$sql_select_user) or die(mysqli_error($conn));
            while($rec_select_user = mysqli_fetch_array($query_select_user)){
                $userBranch = $rec_select_user[0];
                $userDepartment = $rec_select_user[1];
                genHelpdeskNewIssue($conn,$getPermentReleaseHelpID,$EntryBy,$userBranch,$userDepartment);
            }
            //---------------------------------------------------------------------------------------------------------------------- 
         
          if($query_update_helpdesk && $query_note_update){
            mysqli_commit($conn);
             echo "OK";
             
          }else{
            mysqli_rollback($conn);
            echo "NOT";
            
          }
         
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
}

function isPaymentCompleted($getPermentReleaseHelpID, $EntryBy, $paymentMode){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
        // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update_helpdesk = "UPDATE cdb_helpdesk AS ch
                                        SET ch.PAYMENT_COMPLETED_BY = '".$EntryBy."',
                                            ch.PAYMENT_COMPLETED_ON = NOW(),
                                            ch.PAYMENT_MODE = '".$paymentMode."'
                                        WHERE ch.helpid = '".$getPermentReleaseHelpID."';";
            $query_update_helpdesk = mysqli_query($conn,$sql_update_helpdesk) or die(mysqli_error($conn));
            
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$getPermentReleaseHelpID."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                        
                    
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                         VALUES (".$getPermentReleaseHelpID.",'".$cou."',CONCAT('Perment Completed on ', now()),'".$EntryBy."',now(),'OPERATION');";
                //echo $sql_note_update;
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                
                // couriar funtion ........ NOT 
            }
         //-------------------------- 2017-10-13 --- Madushan Wickramaarachchi ------- Genarete New SR ----------------------------
         /*    $sql_select_user = "SELECT u.branchNumber , u.deparmentNumber
                                    FROM user AS u
                                    WHERE u.userName = '".$EntryBy."';";
            $query_select_user = mysqli_query($conn,$sql_select_user) or die(mysqli_error($conn));
            while($rec_select_user = mysqli_fetch_array($query_select_user)){
                $userBranch = $rec_select_user[0];
                $userDepartment = $rec_select_user[1];
               genHelpdeskNewIssue($conn,$getPermentReleaseHelpID,$EntryBy,$userBranch,$userDepartment);
            }*/
            //---------------------------------------------------------------------------------------------------------------------- 
          if($query_update_helpdesk && $query_note_update){
             mysqli_commit($conn);
             echo "OK";
            
          }else{
            mysqli_rollback($conn);
            echo "NOT";
            
          }
         
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function genHelpdeskNewIssue($conn,$helpdeskId,$userEnrty,$userBranch,$userDepartment){
            $isUniquc = 0;
            $isValidator = 0;
            
            $cat_code = "1028";
            $scat_code_1 = "102801";
            $scat_code_2 = "10280118";
            $scat_code_3 = "";
            //$sql_issue_cat = "select ci.cat_code , ci.scat_code_1, ci.scat_code_2, ci.scat_code_3 from cdb_cat_issue_gen AS ci WHERE ci.c_scat_code_2 = '".$scat02."' AND ci.run_statas = 1;";
            //$query_issue_cat = mysqli_query($conn,$sql_issue_cat) or die(mysqli_error($conn));
            //while($resalt_issue_cat = mysqli_fetch_array($query_issue_cat)){
                // $cat_code = $resalt_issue_cat[0];
                //$scat_code_1 = $resalt_issue_cat[1];
                // $scat_code_2 = $resalt_issue_cat[2];
                //$scat_code_3 = $resalt_issue_cat[3]; 
            //}
            
            $sql_select_helpdesk_issure = "select * from cdb_helpdesk AS chi WHERE chi.helpid = '".$helpdeskId."';";
            $query_select_helpdesk_issure = mysqli_query($conn,$sql_select_helpdesk_issure) or die(mysqli_error($conn));
            //--------------------------- Start of CDB HELP DESK Table -----------------------------------------
            while($resalt_select_helpdesk_issure = mysqli_fetch_assoc($query_select_helpdesk_issure)){
                //-------- Start Helpdesk ID gen --------------------------------------
                $TableID = "";
                $hetCheck = 0;
                $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				$add = mysqli_query($conn,$sql);
				while ($rec = mysqli_fetch_array($add)){
					$_SESSION['CURRENT_DATE'] = $rec[0];
				}
                $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
                $quary_Function = mysqli_query($conn,$sqlFunction);
                while ($rec_Function = mysqli_fetch_array($quary_Function)){
                    $batch_num = $rec_Function[0]; 
                }
                $TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
                //---------- End Helpdesk ID gen --------------------------------------------
                
                //----------- Start Randam Password Generate ---------------------------------
                $DefaultPassword = "";
                function randomPassword1() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    
                    $Signs = '@#$%*()+=[{]}\|/?';
                    $passS = array(); //remember to declare $pass as an array
                    $alphaLength = 1; //put the length -1 in cache
                    for ($i = 0; $i < 1; $i++) {
                        $n = rand(0, $alphaLength);
                        $passS[] = $Signs[$n];
                    }
                                        
                    $digits = '1234567890';
                    $passD = array(); //remember to declare $pass as an array
                    $alphaLength = 4; //put the length -1 in cache
                    for ($i = 0; $i < 4; $i++) {
                        $n = rand(0, $alphaLength);
                        $passD[] = $digits[$n];
                    }
                    
                    return ucwords(implode($pass)).implode($passS).implode($passD); //turn the array into a string
                }
                if($scat_code_2 == "200115") {
                    $DefaultPassword = randomPassword1();
                }       
                //----------- END Randam Password Generate ---------------------------------
                
                //----------- Start clone Issure Insert ---------------------------------
                $v_get_Def_User = "SELECT `DefuserID` , `scat_discr_2` 
                                     FROM `scat_02` 
                                    WHERE `cat_code` = '".$cat_code."' AND
                                          `scat_code_1` = '".$scat_code_1."' AND 
                                          `scat_code_2` = '".$scat_code_2."';";
                $que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(mysqli_error($conn));
                while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
                    $usrDf = $RES_get_User['DefuserID'];
                    $scat_discr_2 =  $RES_get_User['scat_discr_2'];
                }
                
                if($scat_code_3 == "20011502" || $scat_code_3 == "20011504") $usrDf = "01002136"; //Marketing officer creation goes to Maneesha
							
			
				if($usrDf =='01BRANCH'){
					$SQL_BRWISE_USER = "select DefuserID from defuserforbranchreq df  where branchNumber = '".$userBranch."' and scat_code_2 = ".$scat_code_2.";";
					$RS_GetBrWiseDefaultUser = mysqli_query($conn,$SQL_BRWISE_USER) or die(mysqli_error($conn));
					while($t_RS_GetBrWiseDefaultUser = mysqli_fetch_assoc($RS_GetBrWiseDefaultUser)){
						$usrDf = $t_RS_GetBrWiseDefaultUser['DefuserID'];
					}
				}
                
                $validateCount = 0;
                $query_Auth_Very = mysqli_query($conn ,"SELECT `auth_verified` FROM `scat_02` WHERE `cat_code` = '".$cat_code."' AND  `scat_code_1` = '".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';") or die(mysqli_error($conn));
                while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
                    if($rec_Auth_Very[0] == 1){
                        $validateCount = 1;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`,`Linked_helpid`) 
                                                               VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$resalt_select_helpdesk_issure['init_enrty_by']."','".$resalt_select_helpdesk_issure['init_enrty_on']."','','0000-00-00 00:00:00','".$helpdeskId."');";
                        	//echo $v_getSQL_insert;
						$que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
						$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`branch_auth_by`,`branch_auth_on`)
                                                VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5000', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','','0000-00-00 00:00:00');";
						//echo $v_getSQL_insert_1;
						$que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                        

                    }else{
                        $validateCount = 0;
                        $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`Linked_helpid`) 
                                    VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','". $DefaultPassword ."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."','".$helpdeskId."');";
                        $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                        $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                     VALUES ('".$TableID."', '".$cat_code."', '".$scat_code_1."', '".$scat_code_2."', '5001', '".$resalt_select_helpdesk_issure['ur_code']."', '".$resalt_select_helpdesk_issure['pr_code']."', '".$resalt_select_helpdesk_issure['issue']."', '".$resalt_select_helpdesk_issure['help_discr']."', '".$userEnrty."', now(),'".$resalt_select_helpdesk_issure['attachment_name']."','".$resalt_select_helpdesk_issure['inner_brCode']."', '".$resalt_select_helpdesk_issure['inner_dept']."', '".$resalt_select_helpdesk_issure['inner_user']."','".$resalt_select_helpdesk_issure['inner_Remark']."','".$resalt_select_helpdesk_issure['inner_get']."','".$userBranch."','".$userDepartment."','".$resalt_select_helpdesk_issure['s_type']."','".$scat_code_3."','".$usrDf."','".$resalt_select_helpdesk_issure['ipAddress']."','".$resalt_select_helpdesk_issure['ssb_facility_amount']."');";
                        $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
                    
                    }
                }
                
                //---------------- Additional Img copy new table-------------
                $sql_add_img = "SELECT * FROM `pending_upload_file` WHERE `help_id` = '".$helpdeskId."';";
                $query_add_img = mysqli_query($conn,$sql_add_img) or die(mysqli_error($conn));
                while($rec_add_img = mysqli_fetch_assoc($query_add_img)){
                     $v_getSQL_inserta = "INSERT INTO `pending_upload_file`(`file_type` , `help_id` , `ai_serial_number` , `file_name` ,`file_path` ,`ai_file_name` ,`done_by` ,`done_on` ,`flag` ,`removedon` ,`remark` ,`DocPurpose` ,`scat02` ,`PaymentHandling`) 
                                                                   VALUES ('".$rec_add_img['file_type']."' , '".$TableID."' , '".$rec_add_img['ai_serial_number']."' , '".$rec_add_img['file_name']."' , '".$rec_add_img['file_path']."' ,'".$rec_add_img['ai_file_name']."' ,'".$rec_add_img['done_by']."' ,'".$rec_add_img['done_on']."' ,'".$rec_add_img['flag']."' ,'".$rec_add_img['removedon']."' ,'".$rec_add_img['remark']."' ,'".$rec_add_img['DocPurpose']."' ,'".$rec_add_img['scat02']."' ,'".$rec_add_img['PaymentHandling']."');";
                     $que_getSQL_inserta = mysqli_query($conn,$v_getSQL_inserta) or die(mysqli_error($conn));
                        
                }
                
                
                //----------- END clone Issure Insert ---------------------------------
                 // -------------Strat send Mail - ------------------------------------------
                
                $sql_edfu = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code`='".$cat_code."' AND `scat_code_1`='".$scat_code_1."' AND `scat_code_2` = '".$scat_code_2."';";
                $que_edrf = mysqli_query($conn,$sql_edfu) or die(mysqli_error($conn));
                while($RES_edrf = mysqli_fetch_assoc($que_edrf)){
                    if ($RES_edrf['DefuserID'] =='01BRANCH'){
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
                    }else{
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
                    }
                    $que_email = mysqli_query($conn,$sql_email) or die(mysqli_error($conn));
                   	if(mysqli_num_rows($que_email) > 0){
                   	    while($RES_email = mysqli_fetch_assoc($que_email)){
           	                $getmail = $RES_email['email'];
           	            }
                        $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$userEnrty."';";
                        $que_uName = mysqli_query($conn,$sql_uName);
                        while($RES_uName = mysqli_fetch_assoc($que_uName)){
                            $getUName = $RES_uName['userID'];
                            $getTP = $RES_uName['GSMNO'];
                        }
                        $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$userDepartment."' AND `branchNumber` = '".$userBranch."';";
                        $que_uDepa = mysqli_query($conn,$sql_uDepart);
                        while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                            $getUBranch = $RES_udep['deparmentName'];
                        } 
                        $title = "CDB Help Desk : New service request";
                        $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$TableID."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['issue']."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$userEnrty."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$userBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Department</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User IP</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$resalt_select_helpdesk_issure['ipAddress']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User Telephone</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getTP."</td>
    </tr>
 </table>
</body>
</html>";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        		
                        						// More headers
                        $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                        //sendMail($getmail,$title,$mail,$headers);    
                        if($validateCount == 0){
                            sendMailNuw($getmail,$title,$mail,$headers); 
                        }
                         // -------------END send Mail - ------------------------------------------
                         // ------------- Start Pat pat lease send sms - ------------------------------------------
                        $sql_cou_cycal = "SELECT s3.DefuserID , u.GSMNO , s3.scat_discr_3
                                            FROM scat_03 AS s3 , user AS u 
                                            WHERE s3.DefuserID = u.userName 
                                            	and s3.cat_code = '1024'
                                                and s3.scat_code_2 = '".$scat_code_2."'
                                                and s3.scat_code_3 = '".$scat_code_3."';";
                        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn)) ;
                        while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                            if ( substr($res_cou_cycal[1],0,2) =='07'){                  
                                $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".$res_cou_cycal[1]."',CONCAT('PATPAT.LK Alert!".chr(10)."Ref :".$TableID.chr(10)."Client Contact Number :".$resalt_select_helpdesk_issure['issue'].chr(10)."".$resalt_select_helpdesk_issure['help_discr'].chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
                                                                                   
                            }
                            $sql_updatedef = "UPDATE `cdb_helpdesk` SET `asing_by` = '".$res_cou_cycal[0]."' WHERE `helpid` = '".$TableID."';";
                            $query_updatedef =  mysqli_query($conn,$sql_updatedef) or die(mysqli_error($conn)); 
                            
                            $msgCus1 = $scat_discr_2." patpat.lk officer ".$res_cou_cycal[2]." (".$res_cou_cycal[1].") will contact you shortly."; 
                            //$msgCus1 = "For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999" ;
                            
                            if ( substr($resalt_select_helpdesk_issure['issue'],0,2) =='07' && strlen($resalt_select_helpdesk_issure['issue']) == 10){                  
                                /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                            VALUES ('".trim($_POST['txt_issue'])."',CONCAT('PATPAT.LK Alert!".chr(10).$msgCus1.chr(10)."For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999".chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));        */                                            
                            }
                        }
                    
                         // ------------- END Pat pat lease send sms - ------------------------------------------
                    }
                                                 
                }
                
                
                
            }
            //--------------------------- End of select CDB HELP DESK Table ------------------------------------

                    
                    
}                 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mailGenerate($conn,$to,$to_cc,$subject,$messageBodyIn,$sender){
     $message = "<html>
                    <head>
                      <title>OPERATION</title>
                    </head>
                    <body>";
     $message .= $messageBodyIn;               
    $message .="</body>
                </html>";
    $message_body = mysqli_real_escape_string($conn,$message);
    $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), '".$sender."', '".$to."', '".$subject."', '".$message_body."', '".$to_cc."', '0000-00-00 00:00:00');";
        //echo $inseet_mailBox;
    $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));   
}

function getUserEmail($conn,$userID){
    $sql_get_email = "SELECT `email` FROM `user` WHERE `userName` = '".$userID."';";
    $query_get_email = mysqli_query($conn,$sql_get_email) or die(mysqli_error($conn));
    while($resat_get_email = mysqli_fetch_array($query_get_email)){
        return $resat_get_email[0];
    }
}


function sendMailNuw($toMail,$title,$mail,$fromMail){
	$to = $toMail;
	$subject = $title;
	$message = $mail;
	$headers = $fromMail;
	mail($to,$subject,$message,$headers);
	/*echo "<script> alert('Mail Sent!');</script>";*/
}
         
?>