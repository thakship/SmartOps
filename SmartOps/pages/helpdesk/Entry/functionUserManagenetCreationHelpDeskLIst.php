<?php

$HekpDeskId = $_REQUEST['getval_retnHelp_ID'];
$Resulution = $_REQUEST['getResulution'];
$Solution = $_REQUEST['getSolution'];
$user = $_REQUEST['getuser'];
$fileName = $_REQUEST['fileName'];
$pathDir = $_REQUEST['pathDir'];
//echo "OK - ".$HekpDeskId;

require('PHPMailer/class.phpmailer.php');

//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

$conn = DatabaseConnection();
mysqli_autocommit($conn,FALSE);
    try{
        // Validation rule engine
            if(trim($HekpDeskId) != "" && trim($Resulution) != "" && trim($Solution) != ""){
                //$getmail = 0;
            $sql_usergen = "SELECT COUNT(*) FROM `user` WHERE `userName` = '".$Resulution."';";
            $que_usergen = mysqli_query($conn,$sql_usergen) or die(mysqli_error($conn));
            while($rec_usergen = mysqli_fetch_array($que_usergen)){
                if($rec_usergen[0] == 1){
                         date_default_timezone_set('Asia/Colombo');
                $v_update_sql = "UPDATE `cdb_helpdesk` SET `cmb_code`='5002', `caloser_by`= '".$user."', `caloser_dateTime`= now(), `resulution`='".$Resulution."', `solution`='".$Solution."', `solved_by`= '".$user."',`solved_on`= now() WHERE `helpid` = '".$HekpDeskId."';";
                $que_getSQL_Update = mysqli_query($conn,$v_update_sql) or die(mysqli_error($conn));
                
                $sql_his = "SELECT `helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`, `solved_by`, `solved_on`, `s_type`, `scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress` ,  `defPassword` FROM `cdb_helpdesk` WHERE `helpid` = '".$HekpDeskId."';";
                $que_his = mysqli_query($conn,$sql_his);
                while($RES_his = mysqli_fetch_assoc($que_his)){
                     $enterBy = $RES_his['enterBy'];
                     $REShelpid = $RES_his['helpid'];
                     $RESissue = $RES_his['issue'];
                     $protectPassword = substr($RES_his['defPassword'],5,8); //Ecca#3532
                     $v_getSQL_insert_2 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`, `attachment_name`, `caloser_by`, `caloser_dateTime`, `resulution`, `solution`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`, `entry_branch`, `entry_department`,`solved_by`,`solved_on`,`s_type`,`scat_code_3`,`asing_by`,`act_by`,`act_on`,`reOpen`,`ipAddress`)
                                        VALUES ('".$RES_his['helpid']."', '".$RES_his['cat_code']."', '".$RES_his['scat_code_1']."', '".$RES_his['scat_code_2']."', '".$RES_his['cmb_code']."', '".$RES_his['ur_code']."', '".$RES_his['pr_code']."', '".$RES_his['issue']."', '".$RES_his['help_discr']."', '".$RES_his['enterBy']."', '".$RES_his['enterDateTime']."', '".$RES_his['attachment_name']."', '".$RES_his['caloser_by']."', '".$RES_his['caloser_dateTime']."', '".$RES_his['resulution']."', '".$RES_his['solution']."', '".$RES_his['inner_brCode']."', '".$RES_his['inner_dept']."','".$RES_his['inner_user']."', '".$RES_his['inner_remark']."', '".$RES_his['inner_get']."', '".$RES_his['entry_branch']."', '".$RES_his['entry_department']."', '".$RES_his['solved_by']."', '".$RES_his['solved_on']."', '".$RES_his['s_type']."','".$RES_his['scat_code_3']."','".$RES_his['asing_by']."','".$RES_his['act_by']."','".$RES_his['act_on']."','".$RES_his['reOpen']."','".$RES_his['ipAddress']."');";
                     $que_getSQL_insert_2 = mysqli_query($conn,$v_getSQL_insert_2) or die(mysqli_error($conn));
                    
                     // --------------------------------------------- SMS -----------------------------------------------------
                       
                       /*$sql_GSM = "SELECT u.GSMNO , b.branchEmail
                                    FROM user AS u , branch AS b
                                    WHERE u.branchNumber = b.branchNumber AND
                                          u.userName =  '".trim($Resulution)."';";*/
                       
                       $sql_GSM = "SELECT u.GSMNO , d.deparmentEmail, u.userName , u.userID , u.branchNumber
                                    FROM user AS u , deparment AS d
                                    WHERE u.deparmentNumber = d.deparmentNumber AND
                                          u.userName ='".trim($Resulution)."';";
                       //echo "<br/>".$sql_GSM;
                       $query_GSM = mysqli_query($conn,$sql_GSM) or die(mysqli_error($conn));
                       
                       while($rec_GSM = mysqli_fetch_array($query_GSM)){
                        //echo "<br/>".$rec_GSM[0];
                        $email_to = "";
                        $smsSTA = "Branch Cashier";
                        if($rec_GSM[1] != ""){
                            $email_to = $rec_GSM[1];
                        }
                        if($rec_GSM[2] != ""){
                            $userID  = $rec_GSM[2];
                        }
                        if($rec_GSM[3] != ""){
                            $userName =  $rec_GSM[3];
                        }
                        if($rec_GSM[4] == "0001"){
                            $smsSTA =  "HOD";
                        }
                        
                            if($rec_GSM[0] != "" ){
                                
                                $sql_sms   = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`)  VALUES ('".$rec_GSM[0]."',CONCAT('Dear User,".chr(10).chr(10)."Requested user account has been created. Please use below password to open the credential document (sent to ".$smsSTA."). ".chr(10)."Ref id : ".$HekpDeskId.chr(10)."Password : ".$protectPassword.chr(10)."', now()),now(),'HELPDESK','USERCREATION',0);";
                                   //echo $sql_sms;              
                                $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));  
                                   
                                $sql_sendsmsquae = "INSERT INTO `sendsmsquae`(`helpid`, `sendon`) VALUES ('".$HekpDeskId."',NOW());";
                                $que_sendsmsquae = mysqli_query($conn,$sql_sendsmsquae) or die(mysqli_error($conn)); 
                                   /*if($query_sms){
                                    echo "SMS OK";
                                   }else{
                                    echo "SMS NOT OK";
                                   }*/
                            }
                       }
                       
                       
                       
                       
                       
                       //--------------------------------------------------------------------------------------------------------------      
                       echo "Issue  solved";	
                       mysqli_commit($conn);
                }
                
                
                $sql_email = "SELECT `email`,`userID` FROM `user` WHERE `userName` = '".trim($enterBy)."';";
                $que_email = mysqli_query($conn,$sql_email);
                 $getUser = $user;
                if(mysqli_num_rows($que_email) > 0){
					while($RES_email = mysqli_fetch_assoc($que_email)){
                    	$getmail = $RES_email['email'];
                        //$getUser = $RES_email['userID'];
                	}
                    $title = "CDB Help Desk : Solved Issue";
                    //$mail = "Your service request << ".trim($_POST['get_help_ID'])." >> - <<".trim($_POST['get_help_Iss']).">> States changed to solved. Please check and confirm to close the job. \nCDB SmartOps --> Help Desk -- >Service Request Acknowledge";
                    //sendMail($getmail,$title,$mail);
                    $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$REShelpid."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$RESissue."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Caused by</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$Resulution."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Solution</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$Solution."</td>
    </tr>";
    $mail .= "<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Solve by</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUser."--".date('Y-m-d h:i:s')."</td>
    </tr>
 </table><br/>
 States changed to solved. Please check and confirm to close the job.<br/>
 CDB SmartOps --> Help Desk -- >Service Request Acknowledge
 
</body>
</html>";




if($getmail != ""){
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
	// More headers
    $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
    //sendMail($getmail,$title,$mail,$headers);    
    mail($getmail,$title,$mail,$headers); 
      //echo "<script> alert('no ATTACHMENT.');</script>";	           
                
}
      //echo "<script> alert('Have ATTACHMENT.');</script>";    
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         
    
     
    $email_from = 'cdberp@cdbnet.lk'; // required
    //$email_to = "wimukthi.madushan@cdb.lk"; // required
    $addr = explode(';',$email_to);
    //$telephone = $_POST['telephone']; // not required
    $comments = ''; // required
    $mailTitle= "System Credential for Requested New user <".$userID." – ".$userName.">";
 // if(($selected_key==0))
   // echo "<script> alert('Please enter your title')</script>";
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     $email_message = "";
    /*$email_message .="Title: ".$selected_val."\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";*/
    $email_message .= $mail;

    $allowedExts = array("doc", "docx", "xls", "xlsx", "pdf");
$temp = explode(".", $fileName);
$extension = end($temp);
/*if($_FILES["file"]["type"] != ""){
    if ((($_FILES["file"]["type"] == "application/pdf")
    || ($_FILES["file"]["type"] == "application/msword")
    || ($_FILES["file"]["type"] == "application/excel")
    || ($_FILES["file"]["type"] == "application/vnd.ms-excel")
    || ($_FILES["file"]["type"] == "application/x-excel")
    || ($_FILES["file"]["type"] == "application/x-msexcel")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
    
    ) //&& in_array($extension, $allowedExts)
      {
      if ($_FILES["file"]["error"] > 0){
        echo "<script>alert('Error: " . $_FILES["file"]["error"] ."')</script>";
      }else{*/
            //$d='upload/';
            //$de=$d . basename($_FILES['file']['name']);
        //move_uploaded_file($_FILES["file"]["tmp_name"], $de);
        //$fileName = $_FILES['file']['name'];
        //$filePath = $_FILES['file']['tmp_name'];
        $filePath = $pathDir;
         //add only if the file is an upload
       /*  }
      }
    else
      {
        //echo "<script>alert('Invalid file')</script>";
      }
}*/


// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
//$mail->IsSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 1;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host       = 'mail.cdbnet.lk';//"hidden";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port       = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth   = false;
//Username to use for SMTP authentication
$mail->Username   = 'cdberp@cdbnet.lk';//"hidden";
//Password to use for SMTP authentication
$mail->Password   = 'CDB@erp1234';//"hidden";
//Set who the message is to be sent from
$mail->SetFrom($email_from, 'CDB SmartOps');
//Set an alternative reply-to address
//$mail->AddReplyTo('replyto@example.com','First Last');
//Set who the message is to be sent to
foreach ($addr as $ad) {
    if($ad != ""){
         $mail->AddAddress($ad,$ad); 
         
         $sql_sendmail = "INSERT INTO `useriddelivery`(`helpid`,`email`, `sendon`) VALUES ('".$HekpDeskId."','".$ad."' ,NOW());";
         $que_sendmail = mysqli_query($conn,$sql_sendmail) or die(mysqli_error($conn)); 
              
         /*$sql_email_CC = "SELECT `email`,`userID` FROM `user` WHERE `userName` = '".trim($_POST['txt_USERMY'])."';";
         $que_email_CC = mysqli_query($conn,$sql_email_CC);
         while($RES_email_CC = mysqli_fetch_assoc($que_email_CC)){
              //$getmail = $RES_email['email'];
              if($RES_email_CC['email']){
                  $mail->addCC($RES_email_CC['email'],$RES_email_CC['email']);
              }
                        //$getUser = $RES_email['userID'];
 	     } */
        
    }
   
}
//Set the subject line
$mail->Subject =  $mailTitle; //'Request for Profile Check up';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$email_message = "<html>
<head>
<title>HTML email</title>
</head>
<body>
Dear Sir/Madam,<br/><br/>
Please share this document with <".$userID." – ".$userName.">.<br/><br/>
Help desk ID : ".$REShelpid." <br/><br/>
BR,<br/>
CDB - IT
</body>
</html>";
$mail->MsgHTML($email_message);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->AddAttachment($file);

if($pathDir.$fileName != ""){
    $mail->AddAttachment($pathDir.$fileName, $fileName);
}

$pathDirSub = "genSecPDF/examples/";
$ackDoc = "UserAck.pdf";

if($pathDirSub.$ackDoc != ""){
    $mail->AddAttachment($pathDirSub.$ackDoc, $ackDoc);
}
//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo " - Your Solution has been submitted.";
  //Header('Location: test1.php');
}     
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////     

                }
                /*if($getStateList == 1){
                    echo "Issue  solved";	
                    mysqli_commit($conn);
                }else{
                    echo "Some Values Not Update.";  
                }*/
                    }else{
                        echo "Please type ERP User login for Caused By.";
                    }
                }
               
            }else{
                echo "Some Values are missing";  
            }
            
            
            
            
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }


?>