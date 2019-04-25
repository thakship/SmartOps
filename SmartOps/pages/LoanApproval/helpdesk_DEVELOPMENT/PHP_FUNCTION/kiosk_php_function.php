<?php
   // include('../../../../php_con/includes/Common.php');
   //.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
    if(isset($_POST['get_ksrl_helpid']) && isset($_POST['get_chk_1']) && isset($_POST['get_chk_2']) && isset($_POST['get_chk_3']) && isset($_POST['get_chk_4']) && isset($_POST['get_chk_5']) && isset($_POST['get_chk_6']) && isset($_POST['get_ksrl_user']) && isset($_POST['get_ksrl_pn']) && isset($_POST['get_title']) ){
        //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6'];
        if($_POST['get_title'] == 1 ){
            is_update_reject_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 2 ){
            //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6']." -- ".$_POST['get_title'];
            is_update_Recommend_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 3 ){
            //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6']." -- ".$_POST['get_title'];
            is_update_Approve_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        if($_POST['get_title'] == 4 ){
            //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6']." -- ".$_POST['get_title'];
            is_update_pending_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        
        if($_POST['get_title'] == 5 ){
            //echo $_POST['get_ksrl_helpid']."--".$_POST['get_chk_1']."--".$_POST['get_chk_2']."--".$_POST['get_chk_3']."--".$_POST['get_chk_4']."--".$_POST['get_chk_5']."--".$_POST['get_chk_6']." -- ".$_POST['get_title'];
            is_update_Comment_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
        }
        //is_update_ok_function($_POST['get_ksrl_helpid'],$_POST['get_chk_1'],$_POST['get_chk_2'],$_POST['get_chk_3'],$_POST['get_chk_4'],$_POST['get_chk_5'],$_POST['get_chk_6'],$_POST['get_ksrl_user'],$_POST['get_ksrl_pn']);
    }
    
    if(isset($_POST['get_appNUmber']) && isset($_POST['get_app_ksrl_helpid']) && isset($_POST['get_app_ksrl_user'])){
       // echo $_POST['get_appNUmber']."--".$_POST['get_app_ksrl_helpid']."--".$_POST['get_app_ksrl_user']."OK";
        is_upadate_applicetion($_POST['get_appNUmber'],$_POST['get_app_ksrl_helpid'],$_POST['get_app_ksrl_user']);
    }
    if(isset($_POST['get_assuser']) && isset($_POST['get_aass_ksrl_helpid']) && isset($_POST['get_aass_ksrl_pn']) && isset($_POST['get_aass_ksrl_user'])){
        is_update_assing_user(trim($_POST['get_assuser']),trim($_POST['get_aass_ksrl_helpid']),trim($_POST['get_aass_ksrl_pn']),trim($_POST['get_aass_ksrl_user'])); 
    }
    
    if(isset($_POST['get_reInitate_helpid']) && isset($_POST['get_reInitate_user']) && isset($_POST['get_reInitate_pn'])){
        is_upadate_reInitate($_POST['get_reInitate_helpid'],$_POST['get_reInitate_user'],$_POST['get_reInitate_pn']);
    }
    
    if(isset($_POST['get_submit_helpid']) && isset($_POST['get_submit_user']) && isset($_POST['get_submit_pn']) && isset($_POST['get_status']) && isset($_POST['get_app_number'])){
        is_upadate_completfile_submit($_POST['get_submit_helpid'],$_POST['get_submit_user'],$_POST['get_submit_pn'],$_POST['get_status'],$_POST['get_app_number']);
         
    }
    
    if(isset($_POST['get_Legal_Approve_helpid']) && isset($_POST['get_Legal_Approve_user']) && isset($_POST['get_Legal_Approve_pn']) && isset($_POST['get_Legal_Approve_stat'])){
       //echo   $_POST['get_Legal_Approve_helpid']."--".$_POST['get_Legal_Approve_user']."--".$_POST['get_Legal_Approve_pn']."-----l".$_POST['get_Legal_Approve_stat'];
       
       is_Legal_Approve($_POST['get_Legal_Approve_helpid'],$_POST['get_Legal_Approve_user'],$_POST['get_Legal_Approve_pn'],$_POST['get_Legal_Approve_stat']);
         
    }
    
    if(isset($_POST['get_Credit_Approve_helpid']) && isset($_POST['get_Credit_Approve_user']) && isset($_POST['get_Credit_Approve_pn']) && isset($_POST['get_Credit_Approve_stat'])){
         //echo   $_POST['get_Credit_Approve_helpid']."--".$_POST['get_Credit_Approve_user']."--".$_POST['get_Credit_Approve_pn']."-----l".$_POST['get_Credit_Approve_stat'];
        is_Credit_Approve($_POST['get_Credit_Approve_helpid'],$_POST['get_Credit_Approve_user'],$_POST['get_Credit_Approve_pn'],$_POST['get_Credit_Approve_stat']);
    }
    
    //............................................................................................................................
function sendMailLoanApproval($conn,$USERID,$title,$MailBody){
    //echo $USERID;
    //echo $title;
    //echo $MailBody;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
    
    $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$USERID."';";
    $que_email = mysqli_query($conn,$sql_email);
    if(mysqli_num_rows($que_email) > 0){
        while($RES_email = mysqli_fetch_assoc($que_email)){
            $to = $RES_email['email'];
        }
   	
       $subject = $title;
	   //$message = $mail;
	   mail($to,$subject,$MailBody,$headers);
	   /*echo "<script> alert('Mail Sent!');</script>";*/
    }
}
    function is_update_reject_function($get_ksrl_helpid,$get_chk_1,$get_chk_2,$get_chk_3,$get_chk_4,$get_chk_5,$get_chk_6,$get_ksrl_user,$get_ksrl_pn){
        $conn = DatabaseConnection();
       // echo $get_ksrl_helpid." -- ".$get_chk_1." -- ".$get_chk_2." -- ".$get_chk_3." -- ".$get_chk_4." -- ".$get_chk_5." -- ".$get_chk_6;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Reject by ".$get_ksrl_user."' ,
                                chd.cmb_code = '5005' , 
                                chd.caloser_by = '".$get_ksrl_user."' ,
                                chd.caloser_dateTime = NOW()
                            WHERE chd.helpid = '".$get_ksrl_helpid."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $sql_insert = "UPDATE loan_cdb_ssb 
                            SET applicant_info = '".$get_chk_1."' ,
                                clear_valuation = '".$get_chk_2."' ,
                                guarantor_1 = '".$get_chk_3."' ,
                                guarantor_2 = '".$get_chk_4."' ,
                                cr_copy_and_invoce = '".$get_chk_5."' ,
                                supplar_info = '".$get_chk_6."' ,
                                pending_notification = '".$get_ksrl_pn."'
                             WHERE helpid = '".$get_ksrl_helpid."';";
           //echo "1";
            $sql_insert_his = "INSERT INTO `loan_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."');";
            $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid."';";
            //echo "2";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            //echo "3";
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            //echo "4";
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            //echo "5";
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                VALUES ('".$get_ksrl_helpid."','".$cou."',CONCAT('File Reject by ".$get_ksrl_user." on ', now(), '- ".$get_ksrl_pn."'),'".$get_ksrl_user."',now());";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";                    //
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                if ( substr($res_cou_cycal[1],0,2) =='07'){
                    
                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                VALUES ('".$res_cou_cycal[1]."',CONCAT('File Reject by ".$get_ksrl_user." to process..".chr(10).$get_ksrl_pn.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                    $query_sms =  mysqli_query($conn,$sql_sms) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));                                                    
                }
            } 

            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            
            
           
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                   sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN APPROVAL : APPLICATION Reject - [".$get_ksrl_helpid."]","File Reject by ".$get_ksrl_user." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes'))." - ".$get_ksrl_pn);
                }
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
    
    function is_update_Recommend_function($get_ksrl_helpid,$get_chk_1,$get_chk_2,$get_chk_3,$get_chk_4,$get_chk_5,$get_chk_6,$get_ksrl_user,$get_ksrl_pn){
        /* ------------------------------------------------------------------------------------------------
        This Function will be called by serviceRequsetList.php (Recommend button)
        
        Business Case   : This will be used to recommendation the loan file
        SMS             : To Marketing Officer - For the moment will not enable this
        e-Mail          : Co-ordinator
        ------------------------------------------------------------------------------------------------*/
        
        $conn = DatabaseConnection();
       // echo $get_ksrl_helpid." -- ".$get_chk_1." -- ".$get_chk_2." -- ".$get_chk_3." -- ".$get_chk_4." -- ".$get_chk_5." -- ".$get_chk_6;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Recommend by ".$get_ksrl_user."' ,
                                chd.recommend_note = '".$get_ksrl_pn."' ,
                                chd.recommend_datetime = NOW()
                            WHERE chd.helpid = '".$get_ksrl_helpid."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $sql_insert = "UPDATE loan_cdb_ssb 
                            SET applicant_info = '".$get_chk_1."' ,
                                clear_valuation = '".$get_chk_2."' ,
                                guarantor_1 = '".$get_chk_3."' ,
                                guarantor_2 = '".$get_chk_4."' ,
                                cr_copy_and_invoce = '".$get_chk_5."' ,
                                supplar_info = '".$get_chk_6."' ,
                                pending_notification = '".$get_ksrl_pn."'
                             WHERE helpid = '".$get_ksrl_helpid."';";
            //echo "1";
            $sql_insert_his = "INSERT INTO `loan_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."');";
            $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid."';";
            ///echo "2";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            //echo "3";
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            //echo "4";
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            //echo "5";
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                VALUES ('".$get_ksrl_helpid."','".$cou."',CONCAT('File Recommend by ".$get_ksrl_user." on ', now() ,' ".$get_ksrl_pn."'),'".$get_ksrl_user."',now());";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            /*$sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";                    //
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                if ( substr($res_cou_cycal[1],0,2) =='07'){
                    
                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                VALUES ('".$res_cou_cycal[1]."',CONCAT('File Recommend by ".$get_ksrl_user." to process..".chr(10).$get_ksrl_pn.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                    $query_sms =  mysqli_query($conn,$sql_sms) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));                                                    
                }
            } */

            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            
            
           
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                   sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Recommended - [".$get_ksrl_helpid."]","File Recommend by ".$get_ksrl_user." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')));
                }
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
    
    function is_update_Approve_function($get_ksrl_helpid,$get_chk_1,$get_chk_2,$get_chk_3,$get_chk_4,$get_chk_5,$get_chk_6,$get_ksrl_user,$get_ksrl_pn){
        /* ------------------------------------------------------------------------------------------------
        This Function will be called by serviceRequsetList.php (Approve button)
        
        Business Case   : This will be used to Approve the loan file
        SMS             : To Marketing Officer 
        e-Mail          : Co-ordinator
        ------------------------------------------------------------------------------------------------*/
        
        $conn = DatabaseConnection();
       // echo $get_ksrl_helpid." -- ".$get_chk_1." -- ".$get_chk_2." -- ".$get_chk_3." -- ".$get_chk_4." -- ".$get_chk_5." -- ".$get_chk_6;
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                            SET chd.ssb_type = 'File Approved by ".$get_ksrl_user."' ,
                                chd.approve_note = '".$get_ksrl_pn."' ,
                                chd.caloser_by = '".$get_ksrl_user."' ,
                                chd.caloser_dateTime = NOW() ,
                                chd.cmb_code = '5002'
                            WHERE chd.helpid = '".$get_ksrl_helpid."';";
            //echo $sql_update." -- ";
            $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
            $sql_insert = "UPDATE loan_cdb_ssb 
                            SET applicant_info = '".$get_chk_1."' ,
                                clear_valuation = '".$get_chk_2."' ,
                                guarantor_1 = '".$get_chk_3."' ,
                                guarantor_2 = '".$get_chk_4."' ,
                                cr_copy_and_invoce = '".$get_chk_5."' ,
                                supplar_info = '".$get_chk_6."' ,
                                pending_notification = '".$get_ksrl_pn."'
                             WHERE helpid = '".$get_ksrl_helpid."';";
            //echo "1";
            $sql_insert_his = "INSERT INTO `loan_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`) 
                            VALUES ('".$get_ksrl_helpid."','".$get_chk_1."','".$get_chk_2."','".$get_chk_3."','".$get_chk_4."','".$get_chk_5."','".$get_chk_6."','".$get_ksrl_pn."');";
            $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid."';";
            //echo "2";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            //echo "3";
            $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
            //echo "4";
            $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
            //echo "5";
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                VALUES ('".$get_ksrl_helpid."','".$cou."',CONCAT('File Approved by ".$get_ksrl_user." on ', now() ,' - ".$get_ksrl_pn."'),'".$get_ksrl_user."',now());";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;"; 
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                if ( substr($res_cou_cycal[1],0,2) =='07'){
                    
                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."File Approved by ".$get_ksrl_user." to process..".chr(10).$get_ksrl_pn.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                    $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                }
            }

            //echo $sql_insert." -- ";
            //echo $sql_insert_his;
            
            
           
            if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                   sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Approved - [".$get_ksrl_helpid."]","File Approved by ".$get_ksrl_user." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')));
                }
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
        /*
        0) update loan_cdb_helpdesk , loan_cdb_ssb and insert record to loan_cdb_ssb_his
        1) Note to be created
        2) SMS record to be inserted - Mkt Officer
        3) email to  Co-ordinator
        */
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen."OK";
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount`, GetUserName(`enterBy`) , getBranchName(`entry_branch`) , `issue` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                 $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                SET chd.ssb_type = 'Pending Notified - ".$r." - ".$get_ksrl_pn_pen."' , 
                                    chd.ssb_cycle = '".$r."'
                                WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";
                 //echo $sql_update." -- ";
                    
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                 $sql_insert = "UPDATE loan_cdb_ssb 
                            SET applicant_info = '".$get_chk_1_pen."',
                                clear_valuation = '".$get_chk_2_pen."',
                                guarantor_1 = '".$get_chk_3_pen."',
                                guarantor_2 = '".$get_chk_4_pen."',
                                cr_copy_and_invoce = '".$get_chk_5_pen."',
                                supplar_info = '".$get_chk_6_pen."',
                                pending_notification = '".$get_ksrl_pn_pen."'
                             WHERE helpid = '".$get_ksrl_helpid_pen."';";
                     
                    $sql_insert_his = "INSERT INTO `loan_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."');";
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    $query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
                    $query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
                    
                    
                    // Start:: Sending SMS to Marketing Officer
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                 VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."Pending Notified - ".$r." on ' , now() ,' - "."Ref : ".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen."'),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }
                    // End:: Sending SMS to Marketing Officer                    
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        /*$sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Pending Notified - ".$r." on ', now()),'".$get_ksrl_user_pen."',now());";*/
                        $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Pending Notified - ".$r." on ' , now() ,' - ".$get_ksrl_pn_pen."'),'".$get_ksrl_user_pen."',now());";
                        //echo $sql_note_update;
                        
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($sql_update && $query_inset && $query_inset_his && $query_note_update){
                        $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                        $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                        while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                            $branchName = $res_cou_cycal[5];
                            $LoanAmount = $res_cou_cycal[3];
                            $CustomerName = $res_cou_cycal[6];
                            $LoanofficerName = $res_cou_cycal[4];
                            $gsm_number = $res_cou_cycal[1];
                            $msg = "<html>
                                    <body>
                                      <table>
                                        <tr>
                                          <td>File Pending Notified by </td><td> : ".$get_ksrl_user_pen."</td>
                                        </tr>
                                        <tr>
                                          <td> On </td><td> : ".date('Y-m-d h:i:sa', strtotime('+30 minutes'))."</td>
                                        </tr>
                                        <tr>
                                           <td></td><td>".$get_ksrl_pn_pen."</td>
                                        </tr>
                                        <tr>
                                           <td>Branch Name </td><td> : ".$branchName."</td>
                                        </tr>
                                        <tr>
                                           <td>Loan Amount </td><td> : ".$LoanAmount."</td>
                                        </tr>
                                        <tr>
                                           <td>Customer Name </td><td> : ".$CustomerName."</td>
                                        </tr>
                                        <tr>
                                           <td>Loan officer Name ( Phone No) </td><td>: ".$LoanofficerName." - ".$gsm_number."</td>
                                        </tr>
                                      </table>
                                    </body>
                                   </html>";
                            sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Pending Notified - [".$get_ksrl_helpid_pen."]",$msg);

                            //sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Pending Notified - [".$get_ksrl_helpid_pen."]","File Pending Notified by ".$get_ksrl_user_pen." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')).chr(10).$get_ksrl_pn_pen);
                        }
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
    
    //------ Madushan 2018-09-27 --- Function  for Gen Comments ----------------------
     function is_update_Comment_function($get_ksrl_helpid_pen,$get_chk_1_pen,$get_chk_2_pen,$get_chk_3_pen,$get_chk_4_pen,$get_chk_5_pen,$get_chk_6_pen,$get_ksrl_user_pen,$get_ksrl_pn_pen){
        /*
        0) update loan_cdb_helpdesk , loan_cdb_ssb and insert record to loan_cdb_ssb_his
        1) Note to be created
        2) SMS record to be inserted - Mkt Officer
        3) email to  Co-ordinator
        */
        $conn = DatabaseConnection();
        //echo $get_ksrl_helpid_pen."--".$get_chk_1_pen."--".$get_chk_2_pen."--".$get_chk_3_pen."--".$get_chk_4_pen."--".$get_chk_5_pen."--".$get_chk_6_pen."--".$get_ksrl_user_pen."--".$get_ksrl_pn_pen."OK";
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount`, GetUserName(`enterBy`) , getBranchName(`entry_branch`) , `issue` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_ksrl_helpid_pen."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                /* $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                SET chd.ssb_type = 'Pending Notified - ".$r." - ".$get_ksrl_pn_pen."' , 
                                    chd.ssb_cycle = '".$r."'
                                WHERE chd.helpid = '".$get_ksrl_helpid_pen."';";*/
                 //echo $sql_update." -- ";
                    
                // $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                /* $sql_insert = "UPDATE loan_cdb_ssb 
                            SET applicant_info = '".$get_chk_1_pen."',
                                clear_valuation = '".$get_chk_2_pen."',
                                guarantor_1 = '".$get_chk_3_pen."',
                                guarantor_2 = '".$get_chk_4_pen."',
                                cr_copy_and_invoce = '".$get_chk_5_pen."',
                                supplar_info = '".$get_chk_6_pen."',
                                pending_notification = '".$get_ksrl_pn_pen."'
                             WHERE helpid = '".$get_ksrl_helpid_pen."';";*/
                     
                   /* $sql_insert_his = "INSERT INTO `loan_cdb_ssb_his`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`,`pending_notification`) 
                                    VALUES ('".$get_ksrl_helpid_pen."','".$get_chk_1_pen."','".$get_chk_2_pen."','".$get_chk_3_pen."','".$get_chk_4_pen."','".$get_chk_5_pen."','".$get_chk_6_pen."','".$get_ksrl_pn_pen."');";*/
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_ksrl_helpid_pen."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    //$query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
                    //$query_inset_his =  mysqli_query($conn,$sql_insert_his) or die(mysqli_error($conn));
                    
                    
                    // Start:: Sending SMS to Marketing Officer
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                 VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."Comment Notified - ".$r." on ' , now() ,' - "."Ref : ".$get_ksrl_helpid_pen.chr(10).$get_ksrl_pn_pen."'),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }
                    // End:: Sending SMS to Marketing Officer                    
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        /*$sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Pending Notified - ".$r." on ', now()),'".$get_ksrl_user_pen."',now());";*/
                        $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Comment Notified - on ' , now() ,' - ".$get_ksrl_pn_pen."'),'".$get_ksrl_user_pen."',now());";
                        //echo $sql_note_update;
                        
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($query_note_update){
                        $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                        $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                        while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                            $branchName = $res_cou_cycal[5];
                            $LoanAmount = $res_cou_cycal[3];
                            $CustomerName = $res_cou_cycal[6];
                            $LoanofficerName = $res_cou_cycal[4];
                            $gsm_number = $res_cou_cycal[1];
                            $msg = "<html>
                                    <body>
                                      <table>
                                        <tr>
                                          <td>File Pending Notified by </td><td> : ".$get_ksrl_user_pen."</td>
                                        </tr>
                                        <tr>
                                          <td> On </td><td> : ".date('Y-m-d h:i:sa', strtotime('+30 minutes'))."</td>
                                        </tr>
                                        <tr>
                                           <td></td><td>".$get_ksrl_pn_pen."</td>
                                        </tr>
                                        <tr>
                                           <td>Branch Name </td><td> : ".$branchName."</td>
                                        </tr>
                                        <tr>
                                           <td>Loan Amount </td><td> : ".$LoanAmount."</td>
                                        </tr>
                                        <tr>
                                           <td>Customer Name </td><td> : ".$CustomerName."</td>
                                        </tr>
                                        <tr>
                                           <td>Loan officer Name ( Phone No) </td><td>: ".$LoanofficerName." - ".$gsm_number."</td>
                                        </tr>
                                      </table>
                                    </body>
                                   </html>";
                            sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Comment Notified - [".$get_ksrl_helpid_pen."]",$msg);

                            //sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION Pending Notified - [".$get_ksrl_helpid_pen."]","File Pending Notified by ".$get_ksrl_user_pen." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')).chr(10).$get_ksrl_pn_pen);
                        }
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
                    $sql_update_app = "UPDATE `cdb_helpdesk` SET `ssb_app_number`= '".$get_appNUmber."' , `ssb_app_entry` = '".$get_app_ksrl_user."', `ssb_type` = 'Application Created' WHERE  `helpid` = '".$get_app_ksrl_helpid."';";
                    //echo $sql_update_app;
                    $que_update_app = mysqli_query($conn , $sql_update_app) or die(mysqli_error($conn));
                    $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress` , `ssb_type`, `ssb_cycle`, `ssb_facility_amount`, `ssb_app_number`, `ssb_app_entry` FROM `cdb_helpdesk` WHERE `helpid` = '".$get_app_ksrl_helpid."';";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                    $que_his = mysqli_query($conn,$sql_his) or die(mysqli_error($conn));        
                    while($RES_his = mysqli_fetch_assoc($que_his)){
                         $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress`,`ssb_type`,`ssb_cycle`,`ssb_facility_amount`,`ssb_app_number`,`ssb_app_entry`)
                                            VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".$RES_his['issue']."', '".$RES_his['help_discr']."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".$RES_his['resulution']."', '".$RES_his['solution']."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."','".$RES_his['ipAddress']."','".$RES_his['ssb_type']."','".$RES_his['ssb_cycle']."','".$RES_his['ssb_facility_amount']."','".$RES_his['ssb_app_number']."','".$RES_his['ssb_app_entry']."');";
                         //echo $v_getSQL_insert_2;
                        $que_getSQL_insert_2 = mysqli_query($conn,$v_getSQL_insert_2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                        $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `cdb_helpdesk` ,`user` WHERE `cdb_helpdesk`.`helpid` = '".$get_app_ksrl_helpid."' AND `user`.`userName` = `cdb_helpdesk`.`enterBy`;";
            
                        $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
                        $r = 1;
                         while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                            if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                                    $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                    VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."Application Created".chr(10)."Applicetion : ".$get_appNUmber.chr(10)."File : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','PENDINGNOTE',0);";
                                    $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                            }
                         }
                    }
                    
                                        
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$get_app_ksrl_helpid."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES (".$get_app_ksrl_helpid.",'".$cou."',CONCAT('Application Created - ".$get_appNUmber." on ', now()),'".$get_app_ksrl_user."',now());";
                        //echo $sql_note_update;
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    if($que_update_app && $que_getSQL_insert_2){
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
    
    function is_update_assing_user($get_assuser,$get_aass_ksrl_helpid,$get_aass_ksrl_pn,$get_aass_ksrl_user){
        /* ------------------------------------------------------------------------------------------------
        This Function will be called by serviceRequsetList.php (Forward button)
        
        Business Case   : This will be used to re-assigned hte approval/recommendation to next person
        SMS             : Not Required
        e-Mail          : mail to be sent to newly assigned officer ++ Co-ordinator
        ------------------------------------------------------------------------------------------------*/
        //echo $get_assuser."--".$get_aass_ksrl_helpid."--".$get_aass_ksrl_pn."OK".$get_aass_ksrl_user;
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            $sql_update_asing = "UPDATE `loan_cdb_helpdesk` SET `asing_by`= '".$get_assuser."' WHERE `helpid` = '".$get_aass_ksrl_helpid."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(mysqli_error($conn));
            $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_aass_ksrl_helpid."';";
            //echo "2";
            $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
            $cou = 1;
            while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                $cou = $rec_select_note_count[0] + 1;
                $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                VALUES ('".$get_aass_ksrl_helpid."','".$cou."',CONCAT('File forwarded by ".$get_aass_ksrl_user." to ".$get_assuser."  on ', now() ,' ".$get_aass_ksrl_pn."'),'".$get_aass_ksrl_user."',now());";
                $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
            }
            if($que_update_asing){
                $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 5 AND `para_status` = 'A';";
                $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                   sendMailLoanApproval($conn,$rec_mail_user[0],"ERP LOAN MODULE : APPLICATION FORWARD - [".$get_aass_ksrl_helpid."]","File forwarded by ".$get_aass_ksrl_user." to ".$get_assuser." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes'))); 
                   sendMailLoanApproval($conn,$get_assuser,"ERP LOAN MODULE : APPLICATION FORWARD - [".$get_aass_ksrl_helpid."]","File forwarded by ".$get_aass_ksrl_user." to ".$get_assuser." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')));
                }
                
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
    
    
    function is_upadate_reInitate($get_reInitate_helpid,$get_reInitate_user,$get_reInitate_pn){
       // echo $get_reInitate_helpid." - ".$get_reInitate_user;
        $conn = DatabaseConnection();
       mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_reInitate_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                 $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                SET chd.ssb_type = CONCAT('File Re-Initiate by ".$get_reInitate_user."  on ', now()) , 
                                    chd.re_init_on = now(),
                                    chd.re_init_by = '".$get_reInitate_user."',
                                    chd.status = 'REINIT' 
                                WHERE chd.helpid = '".$get_reInitate_helpid."';";
                 //echo $sql_update." -- ";
                    
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_reInitate_helpid."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    
                    
                    // Start:: Sending SMS to Marketing Officer
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                 VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."File Re-Initiate by ".$get_reInitate_user.", ".chr(10)."Ref : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','Re-Initiate',0);";
                                                                                 
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }
                    // End:: Sending SMS to Marketing Officer                    
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        /*$sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Pending Notified - ".$r." on ', now()),'".$get_ksrl_user_pen."',now());";*/
                        $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_reInitate_helpid."','".$cou."',CONCAT('File Re-Initiate  by ".$get_reInitate_user."  on ', now() ,'".$get_reInitate_pn."'),'".$get_reInitate_user."',now());";
                        //echo $sql_note_update;
                        
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($query_update && $query_note_update){
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
    
    function is_upadate_completfile_submit($get_submit_helpid,$get_submit_user,$get_submit_pn , $get_status , $get_app_number){
         // echo $get_reInitate_helpid." - ".$get_reInitate_user;
       $conn = DatabaseConnection();
       mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_submit_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            
            
            $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
            $r = 1;
            $file_final_stat = "";
            $appnumber = "";
            $appUser = "";
            $msg_stat = "File Forward to credit and legal ";
            while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                 
            if($get_status == "YES"){
                $file_final_stat = "";
                $msg_stat = "File Forwarded to credit and legal ";
                $appnumber = $get_app_number;
                $appUser = $get_submit_user;
            }else if($get_status == "NO"){
                $file_final_stat = "Rejectd";
                $msg_stat = "File Rejectded by credit Evaluation ";
                $appnumber = "";
               // $get_submit_user = "";
            }else{
                $file_final_stat = "";
                $msg_stat = "File Forwarded to credit and legal ";
                $appnumber = "";
                $get_submit_user = "";
            }
                 $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                SET chd.ssb_type = CONCAT('".$msg_stat." by ".$get_submit_user."  on ', now()) , 
                                    chd.submit_on = now(),
                                    chd.submit_by = '".$get_submit_user."',
                                    chd.status = 'LGLCRO',
                                    chd.ssb_app_number = '".$appnumber."' , 
                                    chd.ssb_app_entry = '".$appUser."' ,
                                    chd.file_final_stat = '".$file_final_stat."'
                                WHERE chd.helpid = '".$get_submit_helpid."';";
                 //echo $sql_update." -- ";
                    
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                    $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_submit_helpid."';";
                    $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                    //echo $sql_insert;
                    //echo $sql_insert_his;
                    
                    
                    // Start:: Sending SMS to Marketing Officer
                    if ( substr($res_cou_cycal[1],0,2) =='07'){
                        
                        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                 VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)." ".$msg_stat." - ".$get_submit_user.". , ".chr(10)."Ref : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','FORWARDCROLEG',0);";
                                                                                
                        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                    }
                    // End:: Sending SMS to Marketing Officer                    
                    
                    $cou = 1;
                    while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                        $cou = $rec_select_note_count[0] + 1;
                        /*$sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_ksrl_helpid_pen."','".$cou."',CONCAT('Pending Notified - ".$r." on ', now()),'".$get_ksrl_user_pen."',now());";*/
                        $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                        VALUES ('".$get_submit_helpid."','".$cou."',CONCAT('".$msg_stat." - ".$get_submit_user."  on ', now(),' ".$get_submit_pn."'),'".$get_submit_user."',now());";
                        //echo $sql_note_update;
                        
                        $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                    }
                    
                    //echo $sql_insert." -- ";
                    //echo $sql_insert_his;
                    
                    
                   
                   if($query_update && $query_note_update){
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
   
    function is_Legal_Approve($get_Legal_Approve_helpid,$get_Legal_Approve_user,$get_Legal_Approve_pn,$get_Legal_Approve_stat){
        //echo $get_Legal_Approve_helpid . " - ".$get_Legal_Approve_user. " - " .$get_Legal_Approve_pn . " - " .$get_Legal_Approve_stat;
        $conn = DatabaseConnection();
       mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
             $sta = "ERROR";
             $file_final_stat = "";
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_Legal_Approve_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            if($get_Legal_Approve_stat == "YES"){
                $sta = "Approved";
                $file_final_stat = "";
            }else if($get_Legal_Approve_stat == "NO"){
                 $sta = "Rejectd";
                 $file_final_stat = "Rejectd";
                 
            }else{
                 $sta = "ERROR";
            }
            if($sta != "ERROR"){
                $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
                $r = 1;
                while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                     $r = $res_cou_cycal[0] + 1;
                     $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                    SET chd.ssb_type = CONCAT('File ".$sta." to legal Department by ".$get_Legal_Approve_user."  on ', now()) , 
                                        chd.lgl_chk_on = now(),
                                        chd.lgl_chk_by = '".$get_Legal_Approve_user."',
                                        chd.lgl_chk_type = '".$get_Legal_Approve_stat."' ,
                                        chd.file_final_stat = '".$file_final_stat."'
                                    WHERE chd.helpid = '".$get_Legal_Approve_helpid."';";
                     //echo $sql_update." -- ";
                        
                     $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                        $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_Legal_Approve_helpid."';";
                        $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                        //echo $sql_insert;
                        //echo $sql_insert_his;
                        
                        
                        // Start:: Sending SMS to Marketing Officer
                        if ( substr($res_cou_cycal[1],0,2) =='07'){
                            
                            $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                     VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."File ".$sta." - legal Department by ".$get_Legal_Approve_user.". , ".chr(10)."Ref : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','LEGALAPPROVE',0);";
                                                                                    
                            $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                        }
                        // End:: Sending SMS to Marketing Officer                    
                        
                        $cou = 1;
                        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                            $cou = $rec_select_note_count[0] + 1;
                            $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                            VALUES ('".$get_Legal_Approve_helpid."','".$cou."',CONCAT('File ".$sta." - legal Department by ".$get_Legal_Approve_user."  on ', now(),' ".$get_Legal_Approve_pn."'),'".$get_Legal_Approve_user."',now());";
                            //echo $sql_note_update;
                            
                            $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                        }
                        
                        //echo $sql_insert." -- ";
                        //echo $sql_insert_his;
                        
                        
                       
                       if($query_update && $query_note_update){
                            mysqli_commit($conn);
                            echo "OK";
                        }else{
                            echo "NOT";
                        }
                }
            }else{
                echo "NOT";
            }
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
        
    }
    
   function is_Credit_Approve($get_Credit_Approve_helpid,$get_Credit_Approve_user,$get_Credit_Approve_pn,$get_Credit_Approve_stat){
       $conn = DatabaseConnection();
       mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
             $sta = "ERROR";
             $file_final_stat = "";
            // '$sql_cou_cycal = "SELECT ssb_cycle ,  FROM loan_cdb_helpdesk WHERE helpid = '".$get_ksrl_helpid_pen."';";
            $sql_cou_cycal = "SELECT `ssb_cycle`,`GSMNO`,`issue`,`ssb_facility_amount` FROM `loan_cdb_helpdesk` ,`user` WHERE `loan_cdb_helpdesk`.`helpid` = '".$get_Credit_Approve_helpid."' AND `user`.`userName` = `loan_cdb_helpdesk`.`enterBy`;";
            if($get_Credit_Approve_stat == "YES"){
                $sta = "Approved";
                $file_final_stat = "Approved";
            }else if($get_Credit_Approve_stat == "NO"){
                 $sta = "Rejectd";
                  $file_final_stat = "Rejectd";
            }else{
                 $sta = "ERROR";
            }
            if($sta != "ERROR"){
                $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
                $r = 1;
                while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                     $r = $res_cou_cycal[0] + 1;
                     $sql_update = "UPDATE loan_cdb_helpdesk AS chd
                                    SET chd.ssb_type = CONCAT('File ".$sta." - Credit Department by ".$get_Credit_Approve_user."  on ', now()) , 
                                        chd.cro_chk_on = now(),
                                        chd.cro_chk_by = '".$get_Credit_Approve_user."',
                                        chd.cro_des_type = '".$get_Credit_Approve_pn."' ,
                                        chd.file_final_stat = '".$file_final_stat."'
                                    WHERE chd.helpid = '".$get_Credit_Approve_helpid."';";
                     //echo $sql_update." -- ";
                        
                     $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                        $sql_select_note_count =  "SELECT COUNT(*) FROM `loan_cdb_help_note` WHERE `helpid` = '".$get_Credit_Approve_helpid."';";
                        $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                        //echo $sql_insert;
                        //echo $sql_insert_his;
                        
                        
                        // Start:: Sending SMS to Marketing Officer
                        if ( substr($res_cou_cycal[1],0,2) =='07'){
                            
                            $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                                                     VALUES ('".$res_cou_cycal[1]."',CONCAT('Loan Approval alert!".chr(10)."File  ".$sta." - Credit Department by ".$get_Credit_Approve_user.". , ".chr(10)."Ref : ".$res_cou_cycal[2].chr(10)."Amount : ".$res_cou_cycal[3].chr(10)."', now()),now(),'LOAN APPROVAL','CREDITAPPROVE',0);";
                                                                                    
                            $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));                                                    
                        }
                        // End:: Sending SMS to Marketing Officer                    
                        
                        $cou = 1;
                        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                            $cou = $rec_select_note_count[0] + 1;
                            $sql_note_update = "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) 
                                            VALUES ('".$get_Credit_Approve_helpid."','".$cou."',CONCAT('File ".$sta." - Credit Department by ".$get_Credit_Approve_user."  on ', now(),' ".$get_Credit_Approve_pn."'),'".$get_Credit_Approve_user."',now());";
                            //echo $sql_note_update;
                            
                            $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                        }
                        
                        //echo $sql_insert." -- ";
                        //echo $sql_insert_his;
                        
                        
                       
                       if($query_update && $query_note_update){
                            mysqli_commit($conn);
                            echo "OK";
                        }else{
                            echo "NOT";
                        }
                }
            }else{
                echo "NOT";
            }
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
   }
?>