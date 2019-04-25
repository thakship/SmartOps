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
                $getUploadStates1 = "";
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
                            if(trim($_POST['fileAttachment1']) == "" && $getUploadStates == 4 ){
                                 $getUploadStates1 = "";
                            }
                            if(trim($_POST['fileAttachment1']) != "" && $getUploadStates != 1 && $getUploadStates != 2 && $getUploadStates !=  3 && $getUploadStates != 4 ){
                                 $getUploadStates1 = $getUploadStates;
                            }
                            if(trim($_POST['fileAttachment1']) == 0 && $getUploadStates != 1 && $getUploadStates != 2 && $getUploadStates !=  3 && $getUploadStates != 4 ){
                                $getUploadStates1 = $getUploadStates;
                            }
                            
                            if(trim($_POST['fileAttachment1']) != 0 && $getUploadStates != 1 && $getUploadStates != 2 && $getUploadStates !=  3 && $getUploadStates == 4 ){
                                $getUploadStates1 = trim($_POST['fileAttachment1']);
                            }
                             if(trim($_POST['fileAttachment1']) == 0 && $getUploadStates != 1 && $getUploadStates != 2 && $getUploadStates !=  3 && $getUploadStates == 4 ){
                                $getUploadStates1 = "";
                            }
                            
                            $getUploadStatessub = is_upload_filesub($conn,trim($_POST['txt_help_ID']));
                            $getUploadStates1sub = "";
                            if($getUploadStatessub == 1){
                                echo "maximum file size. < 10MB >";
                            }else{
                                if($getUploadStatessub == 2){
                                    echo "already exists. File Error.";   
                                }else{
                                    if($getUploadStatessub == 3){
                                        echo "already exists. Path.";
                                    }else{
                                        echo "-- ".$getUploadStatessub."--<br/>";
                                        if(trim($_POST['fileAttachment2']) == "" && $getUploadStatessub == 4 ){
                                         $getUploadStates1sub = "";
                                         echo '1';
                                        }
                                        else if(trim($_POST['fileAttachment2']) != "" && trim($_POST['fileAttachment2']) == 0  && $getUploadStatessub != 1 && $getUploadStatessub != 2 && $getUploadStatessub !=  3 && $getUploadStatessub != 4 ){
                                             $getUploadStates1sub = $getUploadStatessub;
                                             echo '2';
                                        }
                                        else if(trim($_POST['fileAttachment2']) == 0 && $getUploadStatessub != 1 && $getUploadStatessub != 2 && $getUploadStatessub !=  3 && $getUploadStatessub != 4 ){
                                            $getUploadStates1sub = $getUploadStatessub;
                                            echo '3';
                                        }
                                        
                                        else if(trim($_POST['fileAttachment2']) != 0 && $getUploadStatessub != 1 && $getUploadStatessub != 2 && $getUploadStatessub !=  3 && $getUploadStatessub == 4 ){
                                            $getUploadStates1sub = trim($_POST['fileAttachment2']);
                                            echo '4';
                                        }
                                        else if(trim($_POST['fileAttachment2']) == 0 && $getUploadStatessub != 1 && $getUploadStatessub != 2 && $getUploadStatessub !=  3 && $getUploadStatessub == 4 ){
                                            $getUploadStates1sub = "";
                                            echo '5';
                                        }
                                        else{
                                            $getUploadStates1sub = trim($_POST['fileAttachment2']);
                                            echo 'else';
                                        }
                                        
                                            $v_getSQL_insert = "UPDATE `cdb_helpdesk` 
                                                SET `ur_code`='".trim($_POST['sel_Urgency'])."', `pr_code`='".trim($_POST['sel_Priority'])."', `issue`='".trim($_POST['txt_issue'])."', `help_discr`='".trim($_POST['txt_Description'])."', `enterBy`='".$_SESSION['user']."', `attachment_name`='".$getUploadStates1."', `entry_branch`='".$_SESSION['userBranch']."', `entry_department`='".$_SESSION['userDepartment']."', `s_type`='".trim($_POST['sel_Source'])."', `inner_brCode`= '".trim($_POST['txt_Branch'])."', `inner_dept`= '".trim($_POST['txt_Department'])."', `inner_user`= '".trim($_POST['txt_inner_User1'])."', `inner_remark`= '".trim($_POST['inner_Remark'])."', `inner_get`= '".$hetCheck."', `ssb_type` = 'File re-submitted' , `ssb_facility_amount` = '".trim($_POST['txt_facility_amount'])."' , `attachment_namesub` = '".$getUploadStates1sub."'  
                                                WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                            //echo $getUploadStates1sub."--".$v_getSQL_insert;
                                            $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                                            isHelpDeskHistory(trim($_POST['txt_help_ID']));// helpdesk Hisroty.......
                                            
                                            // This is commented by Rizvi On 8:27 AM 11/03/2016 -- Entire Block of deletion and reposting
                                            //$v_delete_note = "DELETE FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                            //$que_delete_note = mysqli_query($conn,$v_delete_note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                                            if($_POST['sel_catagory_1'] != '1014'){
                                                $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                                $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                                $cou = 0;
                                                while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                                                    $cou = $rec_select_note_count[0] + 1;   
                                                    while($cou <= trim($_POST['row_COUNT'])){
                                                        $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES ('".trim($_POST['txt_help_ID'])."','".$cou."','".trim($_POST['txtb'.$cou])."','".$_SESSION['user']."',now(),'FILE_RESUBMIT');";
                                                        $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
                                                        $cou++;
                                                    }
                                                }
                                               /* for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
                                                    if(trim($_POST['txtb'.$y])!= ""){
                                                        $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now());";
                                                        $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                                                    }
                                                }*/
                                            }
                                            
                                            
                                                                
                                            
                                            if($_POST['sel_catagory_1'] == '1014'){
                                                // This is commented by Rizvi On 8:27 AM 11/03/2016 - 2 Lines
                                                // $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".($y-1)."',CONCAT('File re-submitted on ', now()),'".$_SESSION['user']."',now());";
                                                // $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                                                
                                                // Note Creation
                                                $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
                                                $query_select_note_count = mysqli_query($conn , $sql_select_note_count) or die(mysqli_error($conn));
                                                $cou = 1;
                                                while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
                                                    $cou = $rec_select_note_count[0] + 1;
                                                    $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) 
                                                                    VALUES (".trim($_POST['txt_help_ID']).",'".$cou."',CONCAT('File re-submitted on ', now()),'".$_SESSION['user']."',now(),'FILE_RESUBMIT');";
                                                    $query_note_update = mysqli_query($conn,$sql_note_update) or die(mysqli_error($conn));
                                                }            
                                                
                                                
                                            }
                                            //1014
                                            
                                            
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
?>