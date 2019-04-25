<?php
/*if(!empty($_FILES)) {
                if(is_uploaded_file($_FILES['fileAttachment']['tmp_name'])) {
                    $sourcePath = $_FILES['fileAttachment']['tmp_name'];
                    $targetPath = "images/".$_FILES['fileAttachment']['name'];
                    if(move_uploaded_file($sourcePath,$targetPath)) {
                        echo "ok";
                    }
                }
            }*/
session_start();
$conn = mysqli_connect("localhost","root","1234","cdberp");
include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            date_default_timezone_set('Asia/Colombo');
            if(trim($_POST['txt_help_ID']) != ""){
                $getUploadStates = is_upload_file($conn,trim($_POST['txt_help_ID']));
                $getUploadStates1 = $_POST['fileAttachment1'];
                if($getUploadStates == 1){
                    echo "maximum file size. < 10MB >";
                }else{
                    if($getUploadStates == 2){
                        echo "already exists. File Error.";   
                    }else{
                        if($getUploadStates == 3){
                            echo "already exists. Path.";
                        }else{
                            $hetCheck = 0;
                            
                            if(trim($_POST['txt_Branch']) != ''){
                                 $hetCheck = 1;
                            }
                            if($getUploadStates != 4){
                                $getUploadStates1 = $getUploadStates;
                                //echo $getUploadStates1."-- NOT 4 - Upload 1";
                            }else{
                                if(trim($_POST['fileAttachment1']) == ""){
                                    $getUploadStates1 = "";
                                    //echo $getUploadStates1 ." -- NOT 4 -- Empty File fileAttachment1";
                                }else if(trim($_POST['fileAttachment1']) != "0" && trim($_POST['fileAttachment1']) != ""){
                                    $getUploadStates1 = trim($_POST['fileAttachment1']);
                                    //echo $getUploadStates1 ." -- NOT 4 -- NOT 0 File fileAttachment1";
                                }else if(trim($_POST['fileAttachment1']) == "0" && trim($_POST['fileAttachment1']) != ""){
                                    $getUploadStates1 = "";
                                    //echo $getUploadStates1 ." -- NOT 4 -- 0 File fileAttachment1";
                                }else{
                                   // echo "Else";
                                }
                            }
                            
                            $getUploadStatessub = is_upload_filesub($conn,trim($_POST['txt_help_ID']));
                            $getUploadStates1sub = trim($_POST['fileAttachment2']);
                            if($getUploadStatessub == 1){
                                echo "maximum file size. < 10MB >";
                            }else{
                                if($getUploadStatessub == 2){
                                    echo "already exists. File Error.";   
                                }else{
                                    if($getUploadStatessub == 3){
                                        echo "already exists. Path.";
                                    }else{
                                        if($getUploadStatessub != 4 && $getUploadStatessub != ""){
                                            $getUploadStates1sub = $getUploadStatessub;
                                            //echo $getUploadStates1sub ."NOT 4 - Upload 2.";
                                        }else if($getUploadStatessub != 4 && $getUploadStatessub == ""){
                                            //echo "Else New";
                                        }else{
                                            if(trim($_POST['fileAttachment2']) == ""){
                                                $getUploadStates1sub = "";
                                              //  echo $getUploadStates1sub ." -- NOT 4 -- Empty File fileAttachment2";
                                            }else if(trim($_POST['fileAttachment2']) != "0" && trim($_POST['fileAttachment2']) != ""){
                                                $getUploadStates1sub = trim($_POST['fileAttachment2']);
                                                //echo $getUploadStates1sub ." -- NOT 4 -- NOT 0 File fileAttachment1";
                                            }else if(trim($_POST['fileAttachment2']) == "0" && trim($_POST['fileAttachment2']) != ""){
                                                $getUploadStates1sub = "";
                                                //echo $getUploadStates1sub ." -- NOT 4 -- 0 File fileAttachment1";
                                            }else{
                                                //echo "Else";
                                            }   
                                        }
                                    
                                        
                                            $v_getSQL_insert = "UPDATE `loan_cdb_helpdesk` 
                                                SET `ur_code`='".trim($_POST['sel_Urgency'])."', `pr_code`='".trim($_POST['sel_Priority'])."', `issue`='".trim($_POST['txt_issue'])."', `help_discr`='".trim($_POST['txt_Description'])."', `enterBy`='".$_SESSION['user']."', `enterDateTime`= now(), `attachment_name`='".$getUploadStates1."', `entry_branch`='".$_SESSION['userBranch']."', `entry_department`='".$_SESSION['userDepartment']."', `s_type`='".trim($_POST['sel_Source'])."', `inner_brCode`= '".trim($_POST['txt_Branch'])."', `inner_dept`= '".trim($_POST['txt_Department'])."', `inner_user`= '".trim($_POST['txt_inner_User1'])."', `inner_remark`= '".trim($_POST['inner_Remark'])."', `inner_get`= '".$hetCheck."', `ssb_type` = 'File re-submitted' , `ssb_facility_amount` = '".trim($_POST['txt_facility_amount'])."' , `attachment_namesub` = '".$getUploadStates1sub."'  
                                                WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                            //echo $getUploadStates1sub."--".$v_getSQL_insert;
                                            $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                                            isHelpDeskHistory(trim($_POST['txt_help_ID']));// helpdesk Hisroty.......
                                            $v_delete_note = "DELETE FROM `loan_cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                            $que_delete_note = mysqli_query($conn,$v_delete_note) or die(mysqli_error($conn));
                                            for($y = 1 ; $y < trim($_POST['row_COUNT']) ; $y++){
                                                if(trim($_POST['txtb'.$y])!= ""){
                                                    $v_getSQL_Note =  "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now());";
                                                    $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
                                                 }
                                            }
                                            
                                                $v_getSQL_Note =  "INSERT INTO `loan_cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."',CONCAT('File re-submitted on ', now()),'".$_SESSION['user']."',now());";
                                                $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
                                            
                                            //1014
                                            $sql_email_loan = "SELECT COUNT(*) 
                                                                FROM loan_cdb_helpdesk AS l
                                                                WHERE l.helpid = '".trim($_POST['txt_help_ID'])."' AND
                                                                      l.cmb_code = '5002' AND 
                                                                      l.re_init_on != '0000-00-00 00:00:00' AND
                                                                      l.cro_chk_on = '0000-00-00 00:00:00';";
                                            $que_email_loan = mysqli_query($conn , $sql_email_loan) or die(mysqli_error($conn));
                                            while($rec_email_loan = mysqli_fetch_array($que_email_loan)){
                                                if($rec_email_loan[0] != 0){
                                                    $sql_mail_user = "SELECT `para_value` FROM `erp_sys_param` WHERE `para_code` = 9 AND `para_status` = 'A';";
                                                    $query_mail_user = mysqli_query($conn , $sql_mail_user) or die(mysqli_error($conn));
                                                    while($rec_mail_user = mysqli_fetch_array($query_mail_user)){
                                                       sendMailLoanApproval($rec_mail_user[0],"ERP LOAN APPROVAL : APPLICATION RE SUBMIT - [".$_POST['txt_help_ID']."]","File RE SUBMIT by ".$_SESSION['user']." on ".date('Y-m-d h:i:sa', strtotime('+30 minutes')));
                                                    }
                                                }
                                            }
                                            
                                            $stringMessage = "Service request Update. \\n\\nYour SR Number : ".trim($_POST['txt_help_ID']);
                                        
                                            echo $stringMessage;
                                            $_SESSION['fileAttachment'] = "";
                                            mysqli_commit($conn); 
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                /*if($getUploadStates == 0){
                    echo "<script> alert('already exists".$getUploadStates."');</script>";
                }else{
                        
                }*/ 
            }else{
                
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
        
function sendMailLoanApproval($to,$title,$MailBody){
    //echo $USERID;
    //echo $title;
    //echo $MailBody;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
   	
   $subject = $title;
   //$message = $mail;
   mail($to,$subject,$MailBody,$headers);
   /*echo "<script> alert('Mail Sent!');</script>";*/
}
?>