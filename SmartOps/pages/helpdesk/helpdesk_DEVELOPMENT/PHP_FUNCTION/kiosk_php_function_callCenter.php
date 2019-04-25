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

  
  
  if(isset($_POST['get_helpID_pro_update']) && isset($_POST['get_user_pro_update'])){
    //echo $_POST['get_helpID_pro_update']." - ".$_POST['get_user_pro_update'];
    isCallPriorityRecAcc($_POST['get_helpID_pro_update'],$_POST['get_user_pro_update']);
  }
  
  if(isset($_POST['get_helpID_pro_disq']) && isset($_POST['get_user_pro_disq']) && isset($_POST['get_txtComment']) ){
    //echo $_POST['get_helpID_pro_disq']." - ".$_POST['get_user_pro_disq'] ." - ". $_POST['get_txtComment'];
     isCallDiscrapanceyUpdate($_POST['get_helpID_pro_disq'],$_POST['get_user_pro_disq'],$_POST['get_txtComment']);
  }

    if(isset($_POST['get_ksrl_helpid']) && isset($_POST['get_chk_1']) && isset($_POST['get_chk_2']) && isset($_POST['get_chk_3']) && isset($_POST['get_chk_4']) && isset($_POST['get_chk_5']) && isset($_POST['get_chk_6']) && isset($_POST['get_ksrl_user']) && isset($_POST['get_ksrl_pn']) && isset($_POST['get_title']) ){
        //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6'];
        if($_POST['get_title'] == 1 ){
            is_update_ok_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 2 ){
            is_update_pending_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'R' ){
            KioskRecommendation($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }

        if($_POST['get_title'] == 'C' ){
            KioslUclRejection($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
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
        is_update_assing_user(trim($_POST['get_assuser']),trim($_POST['get_aass_ksrl_helpid']));
   
    }
    
    if(isset($_REQUEST['get_HI_Scan']) && isset($_REQUEST['get_user_Scan'])){
       // echo $_POST['get_HI_Scan']."--".$_POST['get_user_Scan']."OK";
        is_update_Scan($_POST['get_HI_Scan'],$_POST['get_user_Scan']);
        
    }
    
    if(isset($_POST['get_Cliendtl_helpid']) && isset($_POST['get_Cliendtl_user']) && isset($_POST['get_txt_dtl']) && isset($_POST['get_title'])){
         //echo $_POST['get_Cliendtl_helpid']."-".$_POST['get_Cliendtl_user']."-".$_POST['get_txt_dtl']."-".$_POST['get_title'];
        updateClientDtlSSB(trim($_POST['get_Cliendtl_helpid']),trim($_POST['get_Cliendtl_user']),trim($_POST['get_txt_dtl']),trim($_POST['get_title']));
    }
    //.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
    
    
    
    
  function isCallPriorityRecAcc($get_helpID_pro_update, $get_user_pro_update){
    $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
               
                $sql_INSET_his = "INSERT INTO `callPriorityBranch`(`helpid`, `priorCallRecOn` , `entryBy` )
                                       VALUES ( ".$get_helpID_pro_update.", NOW() , '".$get_user_pro_update."' );";
                $query_Inset_his = mysqli_query($conn , $sql_INSET_his) or die(mysqli_error($conn));
           
                 $sql_UPDATE = "UPDATE cdb_helpdesk AS ch
                                        SET ch.priorCallRecOn = NOW()
                                        WHERE ch.helpid = ".$get_helpID_pro_update.";";
                $query_UPDATE = mysqli_query($conn , $sql_UPDATE) or die(mysqli_error($conn));
                
               
                
                if($query_Inset_his && $query_UPDATE){
                    echo "OK";
                    mysqli_commit($conn);
                }else{
                    echo "NOT";
                
                
                }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
  }
    
  function isCallDiscrapanceyUpdate($inqID, $user, $Comment){
       $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
               //echo $helpID;
               $sql_UPDATE = "UPDATE callcenterinquiry AS ch
                                        SET ch.brn_reply_on = NOW(),
                                            ch.brn_reply_by = '".$user."',
                                            ch.brn_reply_remark = '".$Comment."'
                                        WHERE ch.inquiry_id = ".$inqID.";";
                $query_UPDATE = mysqli_query($conn , $sql_UPDATE) or die(mysqli_error($conn));
                
               
                
                if($query_UPDATE){
                    echo "OK";
                    mysqli_commit($conn);
                }else{
                    echo "NOT";
                
                
                }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
  }
    
    //..........................................................................................................................................................
    
    function updateClientDtlSSB($get_Cliendtl_helpid,$get_Cliendtl_user,$get_txt_dtl,$get_title){
        //echo $get_txt_dtl;
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            if($get_title == 1){
                $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `clcode` = '".$get_txt_dtl."', 
                                    `clcode_on` = NOW(), 
                                    `clcode_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 2){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `supcode` = '".$get_txt_dtl."', 
                                    `supcode_on` = NOW(), 
                                    `supcode_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 3){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `sec_no` = '".$get_txt_dtl."', 
                                    `sec_no_on` = NOW(), 
                                    `sec_no_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 4){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `gar_code_1` = '".$get_txt_dtl."', 
                                    `gar_code_1_on` = NOW(), 
                                    `gar_code_1_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 5){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `gar_code_2` = '".$get_txt_dtl."', 
                                    `gar_code_2_on` = NOW(), 
                                    `gar_code_2_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 6){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `gar_code_3` = '".$get_txt_dtl."', 
                                    `gar_code_3_on` = NOW(), 
                                    `gar_code_3_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else if ($get_title == 7){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `supacc` = '".$get_txt_dtl."', 
                                    `supacc_on` = NOW(), 
                                    `supacc_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            
            }else if ($get_title == 8){
                 $sql_UPDATE = "UPDATE `cdb_ssb` 
                                SET `recacc` = '".$get_txt_dtl."', 
                                    `recacc_on` = NOW(), 
                                    `recacc_by` = '".$get_Cliendtl_user."'
                                WHERE `helpid` = '".$get_Cliendtl_helpid."';";
            }else{
                $sql_UPDATE = "";
            }
            
            if($sql_UPDATE != ""){
                $query_UPDATE = mysqli_query($conn , $sql_UPDATE) or die(mysqli_error($conn));
                
                
                $sql_INSET_his = "INSERT INTO `cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`, `pending_notification`, `clcode`, `clcode_on`, `clcode_by`, `clcode_val`, `supcode`, `supcode_on`, `supcode_by`, `supcode_val`, `gar_code_1`, `gar_code_1_on`, `gar_code_1_by`, `gar_code_1_val`, `gar_code_2`, `gar_code_2_on`, `gar_code_2_by`, `gar_code_2_val`, `gar_code_3`, `gar_code_3_on`, `gar_code_3_by`, `gar_code_3_val`, `sec_no`, `sec_no_on`, `sec_no_by`, `sec_no_val` ,`supacc` , `supacc_on` , `supacc_by` , `supacc_val` , `recacc` , `recacc_on` , `recacc_by` , `recacc_val` )
                                                      SELECT `helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`, `pending_notification`, `clcode`, `clcode_on`, `clcode_by`, `clcode_val`, `supcode`, `supcode_on`, `supcode_by`, `supcode_val`, `gar_code_1`, `gar_code_1_on`, `gar_code_1_by`, `gar_code_1_val`, `gar_code_2`, `gar_code_2_on`, `gar_code_2_by`, `gar_code_2_val`, `gar_code_3`, `gar_code_3_on`, `gar_code_3_by`, `gar_code_3_val`, `sec_no`, `sec_no_on`, `sec_no_by`, `sec_no_val` , `supacc` , `supacc_on` , `supacc_by` , `supacc_val` , `recacc` , `recacc_on` , `recacc_by` , `recacc_val` 
                                   FROM `cdb_ssb` WHERE `helpid` = '".$get_Cliendtl_helpid."';";
                $query_Inset_his = mysqli_query($conn , $sql_INSET_his) or die(mysqli_error($conn));
                
                if($query_UPDATE && $query_Inset_his){
                    echo "OK";
                    mysqli_commit($conn);
                }else{
                    echo "NOT";
                }
                
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    //............................................................................................................................
    function is_update_ok_function($get_ksrl_helpid,$get_chk_1,$get_chk_2,$get_chk_3,$get_chk_4,$get_chk_5,$get_chk_6,$get_ksrl_user,$get_ksrl_pn){
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid." -- ".$get_chk_1." -- ".$get_chk_2." -- ".$get_chk_3." -- ".$get_chk_4." -- ".$get_chk_5." -- ".$get_chk_6;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Verified by CDPU', chd.lastactivityon = now() 
                            WHERE chd.helpid = '".$get_ksrl_helpid."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            $sql_insert = "UPDATE cdb_ssb 
                            SET applicant_info = '".$get_chk_1."' ,
                                clear_valuation = '".$get_chk_2."' ,
                                guarantor_1 = '".$get_chk_3."' ,
                                guarantor_2 = '".$get_chk_4."' ,
                                cr_copy_and_invoce = '".$get_chk_5."' ,
                                supplar_info = '".$get_chk_6."' ,
                                pending_notification = '".$get_ksrl_pn."'
                             WHERE helpid = '".$get_ksrl_helpid."';";
            /*$sql_insert = "INSERT INTO `cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info` , `pending_notification`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."');";*/
            $sql_insert_his = "INSERT INTO `cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."',now(),'".$get_ksrl_user."','V');";
            $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid."';";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            $query_inset =  mysqli_query($conn,$sql_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                VALUES (".$get_ksrl_helpid.",'".$cou."',CONCAT('File Verified by CDPU on ', now()),'".$get_ksrl_user."',now(),'FILE_VERIFIED');";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";                    //
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                if ( substr($res_cou_cycal[1],0,2) =='07'){
                    
                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                VALUES ('".$res_cou_cycal[1]."',CONCAT('File verified by CDPU to process..".chr(10)."Ref :".$get_ksrl_helpid." ".chr(10).$get_ksrl_pn.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);";
                    $query_sms =  mysqli_query($conn,$sql_sms) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));                                                    
                }
            } 

            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            
            
           
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
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
    
    function is_update_pending_function($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
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
                       /* $sql_insert = "INSERT INTO `cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."');";*/
                    $sql_insert_his = "INSERT INTO `cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`,`histdate`,`enuser`,`P_V`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."',now(),'".$get_ksrl_user_pen."','P');";
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    $query_inset =  mysqli_query($conn,$sql_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    
                    
                    // 
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Pending info alert!".chr(10)."Ref :".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)." From (User): ".$get_ksrl_user_pen.chr(10)."', now()),now(),'HELPDESK','PENDINGNOTE',0);"; //$get_ksrl_user_pen
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
                    $sql_update_app = "UPDATE `cdb_helpdesk` 
                                          SET `appcrdate` = now(), 
                                              `ssb_app_number`= '".$get_appNUmber."' , 
                                              `ssb_app_entry` = '".$get_app_ksrl_user."', 
                                              `ssb_type` = 'Application Created',
                                              `lastactivityon` = now() 
                                        WHERE  `helpid` = '".$get_app_ksrl_helpid."';";
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
      function is_update_assing_user($get_assuser,$get_aass_ksrl_helpid){
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
         
?>