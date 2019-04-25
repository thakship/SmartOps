<?php
require('PHPMailer/class.phpmailer.php');

$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
date_default_timezone_set('Asia/Colombo');
$sql_mail_dtl = "SELECT `emailjobID`, `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc` FROM `mail_queue` WHERE `sendDateTime` = '0000-00-00 00:00:00';";
$que_mail_dtl = mysqli_query($conn , $sql_mail_dtl) or die(mysqli_error($conn));
while($rec_mail_dtl = mysqli_fetch_assoc($que_mail_dtl)){
    
    echo $rec_mail_dtl['emailjobID']." -- ".$rec_mail_dtl['jobIndateTime']." -- ".$rec_mail_dtl['sender']." -- ".$rec_mail_dtl['receivers_to']." -- ".$rec_mail_dtl['subject']." -- ".$rec_mail_dtl['body']." -- ".$rec_mail_dtl['receivers_cc']."<br/>";
    
    $email_from = 'cdberp@cdbnet.lk'; // required
    $email_to = $rec_mail_dtl['receivers_to']; // required
    $addr = explode(';',$email_to);
    
    $comments = $rec_mail_dtl['body']; // required
    $mailTitle= $rec_mail_dtl['subject'];
 // if(($selected_key==0))
   // echo "<script> alert('Please enter your title')</script>";
    /*function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }*/
     $email_message = "";
    /*$email_message .="Title: ".$selected_val."\n";
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";*/
    $email_message .= $rec_mail_dtl['body'];

    /*$allowedExts = array("doc", "docx", "xls", "xlsx", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if($_FILES["file"]["type"] != ""){
    if ((($_FILES["file"]["type"] == "application/pdf")
    || ($_FILES["file"]["type"] == "application/msword")
    || ($_FILES["file"]["type"] == "application/excel")
    || ($_FILES["file"]["type"] == "application/vnd.ms-excel")
    || ($_FILES["file"]["type"] == "application/x-excel")
    || ($_FILES["file"]["type"] == "application/x-msexcel")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
    
    && in_array($extension, $allowedExts))
      {
      if ($_FILES["file"]["error"] > 0)
        {
        echo "<script>alert('Error: " . $_FILES["file"]["error"] ."')</script>";
        }
      else
        {
            //$d='upload/';
            //$de=$d . basename($_FILES['file']['name']);
        //move_uploaded_file($_FILES["file"]["tmp_name"], $de);
        $fileName = $_FILES['file']['name'];
        $filePath = $_FILES['file']['tmp_name'];
         //add only if the file is an upload
         }
      }
    else
      {
        echo "<script>alert('Invalid file')</script>";
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
$mail->SetFrom($email_from, 'CDB ERP');
//Set an alternative reply-to address
$mail->AddReplyTo('cdberp@cdbnet.lk','Do Not Reply'); //This was commented until 12-jan-2018 and i(Rizvi) have opened to reduce the spam rate
//Set who the message is to be sent to
$ad = "";
foreach ($addr as $ad) {
    if($ad != ""){
         $mail->AddAddress($ad,$ad);       
    } 
}


if ($rec_mail_dtl['receivers_cc'] == ""){
   // $email_cc = "cdbSmartOps@cdb.lk";
   $email_cc = "";
    //$email_cc = $rec_mail_dtl['receivers_to'];
}else{
    $email_cc = $rec_mail_dtl['receivers_cc'];
}

//echo "email_cc = ".$email_cc." :END";

if($email_cc != ""){
    $cc = explode(';',$email_cc);
    foreach ($cc as $adcc) {
        if($adcc != ""){
             $mail->AddCC($adcc,$adcc);     
             //$mail->AddCC('person2@domain.com', 'Person Two');  
        } 
    }
}


//$mail->AddCC    =($email_1);
//$mail->AddAddress($email_from, $email_from);
//Set the subject line
$mail->Subject =  $mailTitle; //'Request for Profile Check up';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML($email_message);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->AddAttachment($file);
/*if($_FILES['file']['tmp_name'] != ""){
    $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
}
*/
//Send the message, check for errors
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  $sql_update_sendOn = "UPDATE `mail_queue` SET `sendDateTime`= NOW() WHERE `emailjobID` = '".$rec_mail_dtl['emailjobID']."';";
  $que_update_sendOn = mysqli_query($conn,$sql_update_sendOn) or die(mysqli_error($conn));
  
  echo "Your request has been submitted";
  if($que_update_sendOn){
        $sql_p = "UPDATE  smartops_automation_monitor AS sam 
                     SET sam.statas = '1',
                         sam.lastrunon = NOW()
                   WHERE sam.whatid = 1 ;";
        $que_p = mysqli_query($conn,$sql_p) or die(mysqli_error($conn));
  }else{
        $sql_p = "UPDATE  smartops_automation_monitor AS sam 
                     SET sam.statas = '0'
                   WHERE sam.whatid = 1 ;";
        $que_p = mysqli_query($conn,$sql_p) or die(mysqli_error($conn));
  }
  //Header('Location: test1.php');
}



/************************************************************************************************************************************/
}

?>