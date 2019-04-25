<?php
if(isset($_POST['hid']) && isset($_POST['huser'])){
    $id = $_POST['hid'];
    $ent_User = $_POST['huser'];
	//echo $id."--".$ent_User;
    
    $gs = isServiceRequstDelete($id,$ent_User);
    return $gs;
}



if(isset($_POST['atchid']) && isset($_POST['atcgetrmk']) && isset($_POST['atcUsre']) && isset($_POST['actSco'])){
    $getaid = $_POST['atchid'];
    $getamkr = $_POST['atcgetrmk'];
    $user = $_POST['atcUsre'];
    $isScor = $_POST['actSco'];
	echo $getaid;
    echo $getamkr;
    echo $user;
    echo $isScor;
    $gatc = isServiceRequstAcknowledge($getaid,$getamkr,$user,$isScor);
    return $gatc;
}
if(isset($_POST['atchid1']) && isset($_POST['atcgetrmk1']) && isset($_POST['atcUsre1']) && isset($_POST['actSco1'])){
    $getaid1 = $_POST['atchid1'];
    $getamkr1 = $_POST['atcgetrmk1'];
    $user1 = $_POST['atcUsre1'];
    $isScor1 = $_POST['actSco1'];
    isServiceRequstReOpen($getaid1,$getamkr1,$user1,$isScor1);
}

if(isset($_POST['getAttach'])){
    $getAttach = $_POST['getAttach'];
    echo $getAttach;
    $getAttachState = isRemoveAttachment($getAttach);
    echo "<script> alert(".$getAttachState.");</script>";  
}

if(isset($_POST['getAttachsub'])){
    $getAttachsub = $_POST['getAttachsub'];
    echo $getAttachsub;
    $getAttachState = isRemoveAttachmentsub($getAttachsub);
    echo "<script> alert(".$getAttachState.");</script>";  
}

if(isset($_POST['get_User_ID']) && isset($_POST['get_Requested_User']) && isset($_POST['get_dateT']) && isset($_POST['get_From_Branch']) && isset($_POST['get_To_Branch']) && isset($_POST['get_Transfer_Type']) && isset($_POST['get_Reason']) && isset($_POST['get_lbl_user']) && isset($_POST['get_lbl_from_branch']) && isset($_POST['get_toBranch'])){
   //echo trim($_POST['get_User_ID'])."-".trim($_POST['get_Requested_User'])."-".trim($_POST['get_dateT'])."-".trim($_POST['get_From_Branch'])."-".trim($_POST['get_To_Branch'])."-".trim($_POST['get_Transfer_Type'])."-".trim($_POST['get_Reason']);
    insert_user_transfer(trim($_POST['get_User_ID']),trim($_POST['get_Requested_User']),trim($_POST['get_dateT']),trim($_POST['get_From_Branch']),trim($_POST['get_To_Branch']),trim($_POST['get_Transfer_Type']),trim($_POST['get_Reason']),trim($_POST['get_lbl_user']),trim($_POST['get_lbl_from_branch']),trim($_POST['get_toBranch']));
}


if(isset($_POST['get_tran_user_aprove']) && isset($_POST['get_tran_ath_aprove'])){
   //echo trim($_POST['get_tran_user_aprove'])."-".trim($_POST['get_tran_user_aprove']);
   isTransfer_Approve(trim($_POST['get_tran_user_aprove']),trim($_POST['get_tran_ath_aprove']));
}

if(isset($_POST['get_tran_user_reject']) && isset($_POST['get_tran_ath_reject'])){
   //echo trim($_POST['get_tran_user_aprove'])."-".trim($_POST['get_tran_user_aprove']);
   isTransfer_reject(trim($_POST['get_tran_user_reject']),trim($_POST['get_tran_ath_reject']));
}

if(isset($_POST['get_User_ID_AR']) && isset($_POST['get_Requested_User_AR']) && isset($_POST['get_Currant_User_Role_AR']) && isset($_POST['getDataTime_form_AR']) && isset($_POST['getDataTime_to_AR']) && isset($_POST['get_Request_User_Role_AR']) && isset($_POST['get_Reason_AR']) && isset($_POST['get_current_role']) && isset($_POST['get_Currant_User_Role_dis']) && isset($_POST['get_txt_Currant_br'])  && isset($_POST['get_lbl_user_ar'])){
   //echo trim($_POST['get_User_ID_AR'])."--".trim($_POST['get_Requested_User_AR'])."--".trim($_POST['get_Currant_User_Role_AR'])."--".trim($_POST['getDataTime_form_AR'])."--".trim($_POST['getDataTime_to_AR'])."--".trim($_POST['get_Request_User_Role_AR'])."--".trim($_POST['get_Reason_AR'])."--".trim($_POST['get_current_role']);      
   isActing_User_Role(trim($_POST['get_User_ID_AR']),trim($_POST['get_Requested_User_AR']),trim($_POST['get_Currant_User_Role_AR']),trim($_POST['getDataTime_form_AR']),trim($_POST['getDataTime_to_AR']),trim($_POST['get_Request_User_Role_AR']),trim($_POST['get_Reason_AR']),trim($_POST['get_current_role']),trim($_POST['get_Currant_User_Role_dis']) ,trim($_POST['get_txt_Currant_br']) ,trim($_POST['get_lbl_user_ar']));
}

if(isset($_POST['get_AR_user_reject']) && isset($_POST['get_AR_ath_reject'])){
   //echo trim($_POST['get_AR_user_reject'])."-".trim($_POST['get_AR_ath_reject']);
   isActingRole_reject(trim($_POST['get_AR_user_reject']),trim($_POST['get_AR_ath_reject']));
}

if(isset($_POST['get_AR_user_aprove']) && isset($_POST['get_AR_ath_aprove'])){
   //echo trim($_POST['get_AR_user_aprove'])."-".trim($_POST['get_AR_ath_aprove']);
   isActingRole_Approve(trim($_POST['get_AR_user_aprove']),trim($_POST['get_AR_ath_aprove']));
}

if(isset($_POST['gettentHelpID']) && isset($_POST['getentativeon']) && isset($_POST['getTUser'])){
    isTentativeFunction($_POST['gettentHelpID'],$_POST['getentativeon'],$_POST['getTUser']); 
}


//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

//-----------------------------------------------------------------------




function isTentativeFunction($HelpID,$getentativeon,$getTUser){
    $conn = DatabaseConnection();
    date_default_timezone_set('Asia/Colombo');
    $v_update_sql = "UPDATE `cdb_helpdesk` SET `tentativeon`='".$getentativeon."' WHERE `helpid` = '".$HelpID."';";
    $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(mysqli_error($conn));
//    isHelpDeskHistory($getHID); // Helpdesk ID.......
    $NOTE = "Agreed to proceed - ".$getentativeon;
    CreateNote($conn,$HelpID,$NOTE,$getTUser);
    if($que_getSQL_Update){
        return 1;
    }else{
        return 0;
    }
}

function CreateNote($ConnERP,$HELP_ID,$NOTE,$USER){
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
//.........................................File Upload for Issur............................................................................................. 
    function is_upload_file($conn,$TableID){
        $_SESSION['fileAttachment'] = "";
        if($_FILES["fileAttachment"]["name"] != ""){ 
            $temp = explode(".", $_FILES["fileAttachment"]["name"]);
            $extension = end($temp);
            if(($_FILES["fileAttachment"]["size"] < 12000000)){
                if($_FILES["fileAttachment"]["error"] > 0){
				    return 2;
                }else{
				   $_SESSION['fileAttachment'] = $TableID.$_FILES["fileAttachment"]["name"];
				   $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				   $add = mysqli_query($conn,$sql);
				   while ($rec = mysqli_fetch_array($add)){
					  $dateNow = $rec[0];
			       }  
                    if(file_exists("C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment'])){
                        //echo "<script> alert('already exists');script>";
                        return 3;
                        $_SESSION['fileAttachment']="";
					
  				   }else{
                        move_uploaded_file($_FILES["fileAttachment"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment']);
                        //echo "<script> alert('Uploaded file');script>";
                        return $_SESSION['fileAttachment'];
                        
                    }
                }
            }else{
               return 1;  
            }
        }else{
            return 4;
        }
    }
     function is_upload_filesub($conn,$TableID){
        $_SESSION['fileAttachmentsub'] = "";
        if(isset($_FILES["fileAttachmentsub"]["name"])){
            if($_FILES["fileAttachmentsub"]["name"] != ""){ 
                $temp = explode(".", $_FILES["fileAttachmentsub"]["name"]);
                $extension = end($temp);
                if(($_FILES["fileAttachmentsub"]["size"] < 12000000)){
                    if($_FILES["fileAttachmentsub"]["error"] > 0){
				        return 2;
                    }else{
				        $_SESSION['fileAttachmentsub'] = $TableID."11".$_FILES["fileAttachmentsub"]["name"];
				        $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				        $add = mysqli_query($conn,$sql);
				        while ($rec = mysqli_fetch_array($add)){
					       $dateNow = $rec[0];
                        }  
                        if(file_exists("C:/wamp64/www/bkperp/cdberptest/uploadHelpdesk/" .$_SESSION['fileAttachmentsub'])){
                            //echo "<script> alert('already exists');script>";
                            return 3;
                            $_SESSION['fileAttachmentsub']="";
					
                        }else{
                            move_uploaded_file($_FILES["fileAttachmentsub"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachmentsub']);
                            //echo "<script> alert('Uploaded file');script>";
                            return $_SESSION['fileAttachmentsub'];
                        
                        }
                    }
                }else{
                    return 1;  
                }
            }else{
                return 4;
            }
        }
        
    }
//........................................................ Upload Service Requset List ................................................................
    function isServiceRequsetListInsert($getHID,$getResulution,$getDolution,$user){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
        $getResulution = mysqli_real_escape_string($conn,$getResulution);
        $getDolution = mysqli_real_escape_string($conn,$getDolution);
        
        $v_update_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5002', `caloser_by`= '".$user."', `caloser_dateTime`= now(), `resulution`='".$getResulution."', `solution`='".$getDolution."', `solved_by`= '".$user."',`solved_on`= now() WHERE `helpid` = '".$getHID."';";
        $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        isHelpDeskHistory($getHID); // Helpdesk ID.......
        if($que_getSQL_Update){
            return 1;
        }else{
            return 0;
        }
    } 

//.........................................................Service Request Delete..................................................................................
    function isServiceRequstDelete($helpid,$Entry_User){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
        // $v_Delete_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5003', `caloser_by`= '".$Entry_User."', `caloser_dateTime`= now(), `resulution`='Cancelled by the user',`ssb_type`='Cancelled by the user', `solution`='Cancelled by the user' WHERE `helpid` = '".$helpid."';";
        $v_Delete_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5003', `caloser_by`= '".$Entry_User."', `caloser_dateTime`= now(), `resulution`='Cancelled by the user',`ssb_type`='Cancelled by the user', `solution`='Cancelled by the user',`solved_by`= '".$Entry_User."',`solved_on`= now() WHERE `helpid` = '".$helpid."';";
        $que_getSQL_Delete = mysqli_query($conn,$v_Delete_sql) or die(mysqli_error($conn));
        isHelpDeskHistory($helpid); // Helpdesk History....
        if($que_getSQL_Delete){
            return 1;
        }else{
            return 0;
        }
        
    }

//........................................................ Help Desk Athontication Inser ......................................................................................
    function isInsertUserGroupAth($userGroup,$catID,$user){
          $conn = DatabaseConnection();
          date_default_timezone_set('Asia/Colombo');
          $sql_insert_ath = "INSERT INTO `cdb_help_user_oth`(`user_group`, `cat_code`, `ath_by`, `ath_on`) VALUES ('".$userGroup."','".$catID."','".$user."', now())";  
          $que_insert_ath = mysqli_query($conn,$sql_insert_ath) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
    }
//.........................................................Help Desk User Group Delete...................................................................................
    function  isDeleteUserGroupAth($getuserGroup,$usre){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
        $sql_setect_ath = "SELECT `user_group`, `cat_code`, `ath_by`, `ath_on` FROM `cdb_help_user_oth` WHERE `user_group` = '".$getuserGroup."';";
        $que_select_ath = mysqli_query($conn,$sql_setect_ath);
        while($RES_setect_ath = mysqli_fetch_assoc($que_select_ath)){
            $sql_Inser_ath_his = "INSERT INTO `cdb_help_user_oth_his`(`user_group`, `cat_code`, `ath_by`, `ath_on`) VALUES ('".$RES_setect_ath['user_group']."','".$RES_setect_ath['cat_code']."', '".$RES_setect_ath['ath_by']."', '".$RES_setect_ath['ath_on']."');";
            $que_Inser_ath_his = mysqli_query($conn,$sql_Inser_ath_his) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        }
        $sql_Delete_ath = "DELETE FROM `cdb_help_user_oth` WHERE  `user_group` = '".$getuserGroup."';";
        $que_Delete_ath = mysqli_query($conn,$sql_Delete_ath) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
    }
//......................................................iHelp Desk tAcknowledge...............................................................................
    function isServiceRequstAcknowledge($getaid,$getamkr,$user,$isScor){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
        $sql_Acknowledge = "INSERT INTO `cdb_helpdesk_acknowledge`(`helpid`, `hRemark`, `actSco`,`act_by`, `act_on`) VALUES ('".$getaid."','".$getamkr."','".$isScor."','".$user."',now());";
        $que_Acknowledge = mysqli_query($conn,$sql_Acknowledge) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        $v_Acknowledge_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5004',`act_by`='".$user."',`act_on`= now()  WHERE `helpid` = '".$getaid."';";
        $que_getSQL_Acknowledge = mysqli_query($conn,$v_Acknowledge_sql) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        isHelpDeskHistory($getaid);// helpdesk Hisroty.......
    }

//................................................. Remove Attachment.....................................................................................
    function isRemoveAttachment($getAttach){
        $conn = DatabaseConnection();
        $sql_att = "SELECT `attachment_name` FROM `cdb_helpdesk` WHERE `helpid` = '".$getAttach."';";
        $que_att = mysqli_query($conn,$sql_att);
        while($RES_att = mysqli_fetch_assoc($que_att)){
            $files = $_SERVER['DOCUMENT_ROOT'] . "CDB/uploadHelpdesk/".$RES_att['attachment_name'];
            //$mke = "C:/www/CDB/uploadHelpdesk/20150003EOD Error 27112014.png";
            //$files = glob($mke); // get all file names
      		if(file_exists($files)){
            	unlink($files); // delete file
                $V_update_att = "UPDATE `cdb_helpdesk` SET `attachment_name`='' WHERE `helpid` = '".$getAttach."'";
                $que_update_att = mysqli_query($conn,$V_update_att) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        	}else{
        	   /*$file = 'people.txt';
               $current = file_get_contents($file); // Open the file to get existing content
               $current .= $mke ;          // Append a new person to the file
               //file_put_contents($file, $current);  // Write the contents back to the file
               file_put_contents($file, $current);  // Write the contents back to the file
               //file_put_contents($file, file_exists($files));  // Write the contents back to the file*/
               
        	}
         }   
    }
    
    function isRemoveAttachmentsub($getAttach){
        $conn = DatabaseConnection();
        $sql_att = "SELECT `attachment_namesub` FROM `cdb_helpdesk` WHERE `helpid` = '".$getAttach."';";
        $que_att = mysqli_query($conn,$sql_att);
        while($RES_att = mysqli_fetch_assoc($que_att)){
            //$files = $_SERVER['DOCUMENT_ROOT'] . "CDB/uploadHelpdesk/".$RES_att['attachment_namesub'];bkperp\cdberptest
            $files = $_SERVER['DOCUMENT_ROOT'] . "CDB/uploadHelpdesk/".$RES_att['attachment_namesub'];
            //$mke = "C:/www/CDB/uploadHelpdesk/20150003EOD Error 27112014.png";
            //$files = glob($mke); // get all file names
      		if(file_exists($files)){
            	unlink($files); // delete file
                $V_update_att = "UPDATE `cdb_helpdesk` SET `attachment_namesub`='' WHERE `helpid` = '".$getAttach."'";
                $que_update_att = mysqli_query($conn,$V_update_att) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        	}else{
        	   /*$file = 'people.txt';
               $current = file_get_contents($file); // Open the file to get existing content
               $current .= $mke ;          // Append a new person to the file
               //file_put_contents($file, $current);  // Write the contents back to the file
               file_put_contents($file, $current);  // Write the contents back to the file
               //file_put_contents($file, file_exists($files));  // Write the contents back to the file*/
               
        	}
         }   
    }
// ....................................................Re - Open isServiceRequst ............................................................................
    function isServiceRequstReOpen($getaid1,$getamkr1,$user1,$isScor1){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
      //  $sql_Acknowledge = "INSERT INTO `cdb_helpdesk_acknowledge`(`helpid`, `hRemark`, `actSco`,`act_by`, `act_on`) VALUES ('".$getaid1."','".$getamkr1."','".$isScor1."','".$user1."',now());";
      //  $que_Acknowledge = mysqli_query($conn,$sql_Acknowledge) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        $sql_repen = "SELECT `reOpen`,`solved_by` FROM `cdb_helpdesk` WHERE `helpid`='".$getaid1."';";
        $que_Ackno = mysqli_query($conn,$sql_repen);
        while($c_Count = mysqli_fetch_array($que_Ackno)){
            $count =   $c_Count[0] + 1;
            $sqli_mail = "SELECT `email` FROM `user` WHERE `userName`='".$c_Count[1]."';";
            $que_mail = mysqli_query($conn,$sqli_mail);
            $row_c = mysqli_num_rows($que_mail);
            if($row_c != 0){
                while($r_mail = mysqli_fetch_array($que_mail)){
               	    $getmail =  $r_mail[0];
                    $title = "Re-open Service Request - ".$getaid1;
                    $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Service Request Re-Open</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getaid1."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Remark</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getamkr1."</td>
    </tr>
 </table>
</body>
</html>";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
                        $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                        //sendMail($getmail,$title,$mail,$headers);    
                        mail($getmail,$title,$mail,$headers);
                }
            }
             
        }
        $v_Acknowledge_sql = "UPDATE `cdb_helpdesk` 
                                SET `cmb_code`='5001', `reOpen`='".$count."', `enterBy` = '".$user1."', `enterDateTime` = now(), `caloser_by` = NULL , `caloser_dateTime`='0000-00-00 00:00:00', `solved_by` = NULL , `solved_on` = '0000-00-00 00:00:00'  WHERE `helpid` = '".$getaid1."';";
        $que_getSQL_Acknowledge = mysqli_query($conn,$v_Acknowledge_sql) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
       isHelpDeskHistory($getaid1);// helpdesk Hisroty.......
    }
    

    
//..........................................................Helpdesk ID.....................................................................................

    function isHelpDeskHistory($helpID){
        $conn = DatabaseConnection();
        $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress` FROM `cdb_helpdesk` WHERE `helpid` = '".$helpID."';";
        $que_his = mysqli_query($conn,$sql_his);
        while($RES_his = mysqli_fetch_assoc($que_his)){
             $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress`)
                                VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".mysqli_real_escape_string($conn,$RES_his['issue'])."', '".mysqli_real_escape_string($conn,$RES_his['help_discr'])."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".mysqli_real_escape_string($conn,$RES_his['resulution'])."', '".mysqli_real_escape_string($conn,$RES_his['solution'])."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."','".$RES_his['ipAddress']."');";
             $que_getSQL_insert_2 = mysqli_query($conn,$v_getSQL_insert_2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        }
    }
    
//..............................................................Usre Name........................................................
function getUserNameGenaral($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0];
    }
}

function getUserNameGenaral_Mob_Eml($userID,$conn){
    $v_sql_getUsreNAme = "SELECT `userID`,`email`,`GSMNO` FROM `user` WHERE `userName` =  '".$userID."';";
    $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
    while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
        return $RES_getUsreNAme[0]."&#013;".$RES_getUsreNAme[1]."&#013;".$RES_getUsreNAme[2];
    }
}

function insert_user_transfer($get_User_ID,$get_Requested_User,$get_dateT,$get_From_Branch,$get_To_Branch,$get_Transfer_Type,$get_Reason ,$get_lbl_user,$get_lbl_from_branch,$get_toBranch){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_tran_user = "SELECT COUNT(*) FROM `cdb_user_transfer` WHERE `user_id` = '".$get_User_ID."' AND `status` = 0 AND `auth_by` = '';";
        //echo $sql_tran_user;
        $quer_tran_user = mysqli_query($conn,$sql_tran_user) or die(mysqli_error($conn));
        //$cou_trann_user = mysqli_num_rows($quer_tran_user);
        while($cou_trann_user = mysqli_fetch_array($quer_tran_user)){
            if($cou_trann_user[0] == 1){
                echo "Already This user was requested transfer.";
            }else if($cou_trann_user[0] > 1){
                echo "System Error. Contact ERP Administrator.";
            }else{
                $sql_insert = "INSERT INTO `cdb_user_transfer`(`user_id`, `transfer_type`, `from_branch`, `to_branch`, `dateTime`, `reason`, `done_by`, `done_on`) VALUES ('".$get_User_ID."', '".$get_Transfer_Type."', '".$get_From_Branch."', '".$get_To_Branch."', '".$get_dateT."', '".$get_Reason."', '".$get_Requested_User."', now());";
                $uue_insert = mysqli_query($conn , $sql_insert) or die(mysqli_error($conn));
                
                if($uue_insert){
                    mysqli_commit($conn);
                     $toMailAddress = getMailAddressSysPara($conn,7);
                     //echo $getmail;
                     if($toMailAddress != "NOT"){
                        //echo "get Mail ADD";
                        $MailBody = "Employee ID      : ".$get_lbl_user." - [".$get_User_ID."]<br/>".
                                    "Current Branch   : ".$get_lbl_from_branch." - [".$get_From_Branch."]<br/>".
                                    "Requested Branch : ".$get_To_Branch." - ".$get_toBranch."<br/>".
                                    "Date & Time      : ".$get_dateT;
                        sendingMail($toMailAddress,"CDB SmartOps - Authorization request for Employee Branch Transfer",$MailBody);    
                            
                     }else{
                        //echo "NO";
                     }
                    echo "Data Updated.";
                }else{
                    echo "Data not Updated.";
                }
            }
        }
        
      
       
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

function isTransfer_Approve($IP_INDEX,$get_tran_ath_aprove){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_udate_appro = "UPDATE cdb_user_transfer AS cut 
                            SET cut.status = 1,
                                cut.auth_by = '".$get_tran_ath_aprove."',
                                cut.auth_on = NOW(),
                                cut.auth_type = 'Approved' 
                            WHERE cut.index_id = ".$IP_INDEX." AND cut.status = 0;";
        $udate_appro = mysqli_query($conn , $sql_udate_appro) or die(mysqli_error($conn));
        if($udate_appro){
            $RequestStatus = TransferBranchTranToOracle($IP_INDEX,$get_tran_ath_aprove);
            //echo "RequestStatus = " . $RequestStatus;
            if($RequestStatus == "S"){
                mysqli_commit($conn);
                echo "Request is Approved.";
            } else{
                mysqli_rollback($conn);
                echo "Request is not Approved. ExceptioTransferBranchTranToOracle : (" . $RequestStatus . ")";
            }
        }else{
            echo "Request is not Approved.";
        }
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

function isTransfer_reject($IP_INDEX,$get_tran_ath_reject){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_udate_appro = "UPDATE cdb_user_transfer AS cut 
                            SET cut.status = 2,
                                cut.auth_by = '".$get_tran_ath_reject."',
                                cut.auth_on = NOW(),
                                cut.auth_type = 'Rejected ' 
                            WHERE cut.index_id = ".$IP_INDEX." AND cut.status = 0;";
        $udate_appro = mysqli_query($conn , $sql_udate_appro) or die(mysqli_error($conn));
        if($udate_appro){
            echo "Request is Rejected.";
        }else{
            echo "Request is not Rejected .";
        }
      
       mysqli_commit($conn);
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

function isActingRole_reject($IP_INDEX,$get_AR_ath_reject){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_udate_appro = "UPDATE cdb_acting_user_role AS cu
                                SET cu.status = 2 ,
                                    cu.auth_by = '".$get_AR_ath_reject."' ,
                                    cu.auth_on = NOW() ,
                                    cu.auth_type = 'Rejected'
                                WHERE cu.status = 0 AND
                                      cu.index_id = '".$IP_INDEX."';";
        $udate_appro = mysqli_query($conn , $sql_udate_appro) or die(mysqli_error($conn));
        if($udate_appro){
            echo "Request is Rejected.";
        }else{
            echo "Request is not Rejected .";
        }
      
       mysqli_commit($conn);
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

function isActingRole_Approve($IP_INDEX,$get_tran_ath_aprove){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_udate_appro = "UPDATE cdb_acting_user_role AS cut 
                            SET cut.status = 1,
                                cut.auth_by = '".$get_tran_ath_aprove."',
                                cut.auth_on = NOW(),
                                cut.auth_type = 'Approved' 
                            WHERE cut.index_id = ".$IP_INDEX." AND cut.status = 0;";
        $udate_appro = mysqli_query($conn , $sql_udate_appro) or die(mysqli_error($conn));
        if($udate_appro){
            $RequestStatus = ActingRoleTranToOracle($IP_INDEX,$get_tran_ath_aprove);
            //echo "RequestStatus = " . $RequestStatus;
            if($RequestStatus == "S"){
                mysqli_commit($conn);
                echo "Request is Approved.";
            } else{
                mysqli_rollback($conn);
                echo "Request is not Approved. ExceptioActingRoleTranToOracle : (" . $RequestStatus . ")";
            }
        }else{
            echo "Request is not Approved.";
        }
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

function TransferBranchTranToOracle($IP_INDEX,$ip_authuser){
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 'Off');
    
    // *********************************  Oracle DB Connection For PHP file    *************************************************************************
    
    // ---------------------- Start for Oracle DB Connection Function -----------------------------------
    
    $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = cdbprod)))"; // Connect to an Oracle SERVER .
    
    $dbConn = oci_connect('cdberp','cdberp',$dbstr1);  // Connect to an Oracle database.
    
    date_default_timezone_set("Asia/Calcutta"); // get the time Zone.
    
    // echo date("Y/m/d H:i:s"); // Print Date and time
    
    // echo "\n"; 
    
    if(!$dbConn){
    	//$err = OCIError();
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else {
    	// print "Connected to Oracle!";
    	// echo "Successfully connected to Oracle.\n";
    }
    
    // ---------------------- End for Oracle DB Connection Function -----------------------------------
    
    // *************************************** MYSQL DB Connection For PHP File   *****************************************************************************
    
    // ---------------------- Start for MYSQL DB Connection Function -------------------------------------- 
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    // Check connection
    if (mysqli_connect_errno($conn)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // ----------------------- End for MYSQL DB Connection Function  --------------------------------------
    
    
    // ********************************************** Start PHP Script ********************************************************************************************
    // DATE_FORMAT(ct.auth_on,'%Y/%m/%d %H:%m:%s')  AS auth_on,
    $sql_get_user_tran_mysql = "SELECT ct.index_id , 
                                       ct.user_id , 
                                       ct.transfer_type , 
                                       ct.from_branch , 
                                       ct.to_branch , 
                                       DATE_FORMAT(ct.dateTime,'%Y/%m/%d %T') as dateTime , 
                                       ct.reason , 
                                       ct.status , 
                                       ct.done_by , 
                                       DATE_FORMAT(ct.done_on,'%Y/%m/%d %T') AS done_on , 
                                       ct.auth_by 
                                       FROM cdb_user_transfer AS ct WHERE ct.index_id = " . $IP_INDEX.";";
    $que_get_user_tran_mysql = mysqli_query($conn , $sql_get_user_tran_mysql) or die(mysqli_error());
    $i = 0;
    $ReturnValueofProc = "S";
    //$sql = "begin  cdbproddb.pkg_cdb_erp_lib.sp_branch_transfer(:p_index_id,:p_user_id,:p_transfer_type,:p_from_branch,:p_to_branch, to_date(:p_datetime, 'yyyy/mm/dd hh24:mi:ss'),:p_reason,:p_status,:p_done_by,to_date(:p_done_on, 'yyyy/mm/dd hh24:mi:ss'),:p_auth_by, to_date(':p_auth_on', 'yyyy/mm/dd hh24:mi:ss'),:p_error); end;";
    
    
    $stid = oci_parse($dbConn, $sql);
    while($rec_get_user_tran_mysql = mysqli_fetch_array($que_get_user_tran_mysql)){
        $sql = "begin  cdbproddb.pkg_cdb_erp_lib.sp_branch_transfer(".$rec_get_user_tran_mysql[0].",'".$rec_get_user_tran_mysql[1]."','".$rec_get_user_tran_mysql[2]."',".$rec_get_user_tran_mysql[3].",".$rec_get_user_tran_mysql[4].",
        to_date('".$rec_get_user_tran_mysql[5]."', 'yyyy/mm/dd hh24:mi:ss'),'".$rec_get_user_tran_mysql[6]."',1,'".$rec_get_user_tran_mysql[8]."',
        to_date('".$rec_get_user_tran_mysql[9]."', 'yyyy/mm/dd hh24:mi:ss'),'".$ip_authuser."', to_date('".date("Y/m/d H:i:s", strtotime("+30 minutes"))."', 'yyyy/mm/dd hh24:mi:ss'),:p_error); end;";
        //echo $sql;
        $stid = oci_parse($dbConn, $sql);
        oci_bind_by_name($stid, ':p_error', $ReturnValueofProc , 2000);
    }
    $r = oci_execute($stid);
    oci_free_statement($stid);
    return $ReturnValueofProc;
}

function ActingRoleTranToOracle($IP_INDEX,$ip_authuser){
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 'Off');
    
    // *********************************  Oracle DB Connection For PHP file    *************************************************************************
    
    // ---------------------- Start for Oracle DB Connection Function -----------------------------------
    
    $dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = cdbprod)))"; // Connect to an Oracle SERVER .
    
    $dbConn = oci_connect('cdberp','cdberp',$dbstr1);  // Connect to an Oracle database.
    
    date_default_timezone_set("Asia/Calcutta"); // get the time Zone.
    
    // echo date("Y/m/d H:i:s"); // Print Date and time
    
    // echo "\n"; 
    
    if(!$dbConn){
    	//$err = OCIError();
    	$err = ocierror();
    	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
     	echo "Connection failed.".$err['message'];
    	exit;
    }else {
    	// print "Connected to Oracle!";
    	// echo "Successfully connected to Oracle.\n";
    }
    
    // ---------------------- End for Oracle DB Connection Function -----------------------------------
    
    // *************************************** MYSQL DB Connection For PHP File   *****************************************************************************
    
    // ---------------------- Start for MYSQL DB Connection Function -------------------------------------- 
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    // Check connection
    if (mysqli_connect_errno($conn)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // ----------------------- End for MYSQL DB Connection Function  --------------------------------------
    
    
    // ********************************************** Start PHP Script %H:%m:%s ********************************************************************************************
    // DATE_FORMAT(ct.auth_on,'%Y/%m/%d %H:%m:%s')  AS auth_on,
    $sql_get_user_tran_mysql = "SELECT ct.index_id ,
                                       ct.user_id ,
                                       DATE_FORMAT(ct.fromDateTime,'%Y/%m/%d %T') as fromDateTime ,
                                       DATE_FORMAT(ct.toDateTime,'%Y/%m/%d %T') as toDateTime ,
                                       1 as sl,
                                       ct.req_user_role , 
                                       ct.reason ,
                                       ct.status ,
                                       ct.done_by ,
                                       ct.done_on ,
                                       ct.currant_role_status     
                                FROM cdb_acting_user_role AS ct
                                WHERE ct.index_id = ".$IP_INDEX.";";
    //echo $sql_get_user_tran_mysql;
    $que_get_user_tran_mysql = mysqli_query($conn , $sql_get_user_tran_mysql) or die(mysqli_error());
    $i = 0;
    $ReturnValueofProc = "S";
    //$sql = "begin  cdbproddb.pkg_cdb_erp_lib.sp_branch_transfer(:p_index_id,:p_user_id,:p_transfer_type,:p_from_branch,:p_to_branch, to_date(:p_datetime, 'yyyy/mm/dd hh24:mi:ss'),:p_reason,:p_status,:p_done_by,to_date(:p_done_on, 'yyyy/mm/dd hh24:mi:ss'),:p_auth_by, to_date(':p_auth_on', 'yyyy/mm/dd hh24:mi:ss'),:p_error); end;";
    $stid = oci_parse($dbConn, $sql);
    while($rec_get_user_tran_mysql = mysqli_fetch_array($que_get_user_tran_mysql)){
        $sql = "begin cdbproddb.pkg_cdb_erp_lib.sp_grant_actingrole(".$rec_get_user_tran_mysql[0].",'".$rec_get_user_tran_mysql[1]."',to_date('".$rec_get_user_tran_mysql[2]."', 'yyyy/mm/dd hh24:mi:ss'),to_date('".$rec_get_user_tran_mysql[3]."', 'yyyy/mm/dd hh24:mi:ss'),".$rec_get_user_tran_mysql[4].",'".$rec_get_user_tran_mysql[5]."',
                                                                   '".$rec_get_user_tran_mysql[6]."',".$rec_get_user_tran_mysql[7].",'".$rec_get_user_tran_mysql[8]."',to_date('".$rec_get_user_tran_mysql[9]."', 'yyyy/mm/dd hh24:mi:ss'),'".$ip_authuser."',to_date('".date("Y/m/d H:i:s", strtotime("+30 minutes"))."', 'yyyy/mm/dd hh24:mi:ss'),".$rec_get_user_tran_mysql[10].",:p_error); end;";
        
        //echo $rec_get_user_tran_mysql[0];
       // echo $rec_get_user_tran_mysql[1];
       // echo $rec_get_user_tran_mysql[2];
        //echo $sql;
        $stid = oci_parse($dbConn, $sql);
        oci_bind_by_name($stid, ':p_error', $ReturnValueofProc , 2000);
    }
    $r = oci_execute($stid);
    oci_free_statement($stid);
    return $ReturnValueofProc;
}
function isActing_User_Role($get_User_ID_AR,$get_Requested_User_AR,$get_Currant_User_Role_AR,$getDataTime_form_AR,$getDataTime_to_AR,$get_Request_User_Role_AR,$get_Reason_AR,$get_current_role,$get_Currant_User_Role_dis,$get_txt_Currant_br , $get_lbl_user_ar){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
        date_default_timezone_set('Asia/Colombo');
        $sql_insert = "INSERT INTO `cdb_acting_user_role`(`user_id`, `currant_user_role`, `fromDateTime`, `toDateTime`, `req_user_role`, `currant_role_status`, `reason`, `done_by`, `done_on` , `currant_user_role_dis`,`br_code`) 
                                                  VALUES ('".$get_User_ID_AR."','".$get_Currant_User_Role_AR."','".$getDataTime_form_AR."','".$getDataTime_to_AR."','".$get_Request_User_Role_AR."','".$get_current_role."','".$get_Reason_AR."','".$get_Requested_User_AR."',NOW(),'".$get_Currant_User_Role_dis."','".$get_txt_Currant_br."');";
        //echo $sql_insert;
        $uue_insert = mysqli_query($conn , $sql_insert) or die(mysqli_error($conn));
        if($uue_insert){
            if($get_Request_User_Role_AR == "PWO"){
                 $toMailAddress = getMailAddressSysPara($conn,8);
            }else{
                 $toMailAddress = getMailAddressSysPara($conn,7);
            }
           
                     //echo $getmail;
             if($toMailAddress != "NOT"){
                //echo "get Mail ADD";
                
                $MailBody = "Employee ID       : ".$get_lbl_user_ar." - [".$get_User_ID_AR."]<br/>".
                            "Current Branch    : ".getBranch_usingBRCode($conn,$get_txt_Currant_br)." - ".$get_txt_Currant_br."<br/>".
                            "Current User Role : ".$get_Currant_User_Role_dis." - ".$get_Currant_User_Role_AR."<br/>". 
                            "Request User Role : ".getUserRole($conn,$get_Request_User_Role_AR)." - ".$get_Request_User_Role_AR."<br/>". 
                            "From Date & Time  : ".$getDataTime_form_AR."<br/>".
                            "To Date & Time    : ".$getDataTime_to_AR."<br/>";
                sendingMail($toMailAddress,"CDB SmartOps - Acting Role request for Employee User Role",$MailBody);    
                    
             }else{
                //echo "NO";
             }
            echo "Request Updated.";
       }else{
            echo "Request not Updated.";
        }
       mysqli_commit($conn);
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

function getMailAddressSysPara($DBconn,$paracode){
    
    $sql_get_address = "SELECT esp.para_value FROM erp_sys_param AS esp WHERE esp.para_code = ".$paracode.";";
    $query_get_address = mysqli_query($DBconn,$sql_get_address) or die(mysqli_error($DBconn));
    $row_c = mysqli_num_rows($query_get_address);
    if($row_c == 0){
        return "NOT";
    }else{
        while($res_get_addtess = mysqli_fetch_array($query_get_address)){
            return $res_get_addtess[0];
        }
    }
    
}

function getBranch_usingBRCode($conn,$brCode){
      $sql_br = "SELECT b.branchName FROM branch b WHERE b.br_code = ".$brCode." AND b.branchNumber <> '1212' AND  b.branchNumber <> '9522';";
      $que_br = mysqli_query($conn,$sql_br);
      $cou_br = mysqli_num_rows($que_br);
      if($cou_br == 1){
        while($rec_br = mysqli_fetch_array($que_br)){
            return $rec_br[0];
        }
      }else{
          $sql_de = "SELECT d.deparmentName FROM deparment d WHERE d.br_code = ".$brCode." AND d.deparmentName <> 'GENARAL' AND d.deparmentNumber <> '01003' AND d.deparmentNumber <> '40301';";
          $que_de = mysqli_query($conn,$sql_de);
          $cou_de = mysqli_num_rows($que_de);
          if($cou_de == 1){
            while($rec_de = mysqli_fetch_array($que_de)){
                return $rec_de[0];
            }
          }
      }
}

function getUserRole($conn,$roleID){
    $sql_get_role = "SELECT `role_dis` FROM `cdb_acting_roles` WHERE `role_id` = '".$roleID."';";
    $query_get_role = mysqli_query($conn,$sql_get_role) or die(mysqli_error($conn));
    $row_c = mysqli_num_rows($query_get_role);
    while($res_get_role = mysqli_fetch_array($query_get_role)){
        return $res_get_role[0];
    }
}
?>


