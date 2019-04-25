<?php
if(isset($_POST['hid'])){
    $id= $_POST['hid'];
	echo $id;
    $gs = isServiceRequstDelete($id);
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
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
//.........................................File Upload for Issur............................................................................................. 
    function is_upload_file($conn,$TableID){
        $_SESSION['fileAttachment'] = "";
        if($_FILES["fileAttachment"]["name"] != ""){ 
            $temp = explode(".", $_FILES["fileAttachment"]["name"]);
            $extension = end($temp);
            if(($_FILES["fileAttachment"]["size"] < 2000000)){
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
                        //echo "<script> alert('already exists');</script>";
                        return 3;
                        $_SESSION['fileAttachment']="";
					
  				   }else{
                        move_uploaded_file($_FILES["fileAttachment"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment']);
                        //echo "<script> alert('Uploaded file');</script>";
                        return $_SESSION['fileAttachment'];
                        
                    }
                }
            }else{
               return 1;  
            }
        }else{
            
        }
    }
 
//........................................................ Upload Service Requset List ................................................................
    function isServiceRequsetListInsert($getHID,$getResulution,$getDolution,$user){
        $conn = DatabaseConnection();
        date_default_timezone_set('Asia/Colombo');
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
    function isServiceRequstDelete($helpid){
        $conn = DatabaseConnection();
        $v_Delete_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5003' WHERE `helpid` = '".$helpid."';";
        $que_getSQL_Delete = mysqli_query($conn,$v_Delete_sql) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
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
            //$mke = "C:/www64/CDB/uploadHelpdesk/20150003EOD Error 27112014.png";
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
        $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen` FROM `cdb_helpdesk` WHERE `helpid` = '".$helpID."';";
        $que_his = mysqli_query($conn,$sql_his);
        while($RES_his = mysqli_fetch_assoc($que_his)){
             $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`)
                                VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".$RES_his['issue']."', '".$RES_his['help_discr']."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".$RES_his['resulution']."', '".$RES_his['solution']."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."');";
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
?>