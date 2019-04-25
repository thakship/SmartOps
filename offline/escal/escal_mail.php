<?php

// ini_set('sendmail_path','C:\wamp\sendmail\sendmail.exe -t');
// ini_set('smtp_port',25);

//include('../../CDB/php_con/includes/Common.php');


$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql_diif = "SELECT chk.cat_code AS Department,
                     us.email as Inform_to_eMail,
                     CONCAT(count(*), ' Issues Pending for your review: Escallation - I')  as Message_Subject
                FROM cdb_helpdesk AS chk,scat_02 sc,user us
               WHERE chk.cmb_code = '5001'
                 AND chk.cat_code = sc.cat_code
              	 AND chk.scat_code_1 = sc.scat_code_1
               	 AND chk.scat_code_2 = sc.scat_code_2
                 AND us.userName = sc.ESCAL_1_USER_ID
                 AND sc.ESCAL_1 < DATEDIFF(NOW(),DATE(chk.enterDateTime)) 
                 AND sc.SLA_TYPE = 'DAY'
               group by chk.cat_code,us.email;";
$que_diff = mysqli_query($conn , $sql_diif) or die(mysqli_error($conn));

while($res_diff = mysqli_fetch_array($que_diff)){  
    $mail_add = $res_diff[1];
    $tit = $res_diff[2];
    $mail_body = "SELECT chk.helpid AS Help_ID,
			 cs.cat_discr AS Department,
			 sca_1.scat_discr_1 AS SubCatagory_1,
			 sca_2.scat_discr_2 AS SubCatagory_2,
			 chk.issue AS Issue,
			 chk.help_discr AS Issue_Description,
			 DATEDIFF(NOW(),DATE(chk.enterDateTime)) AS Issue_Age_Days,
       chk.asing_by AS asing_By
 FROM cdb_helpdesk AS chk,scat_02 AS sc,user AS us , cat_states AS cs , scat_01 AS sca_1 , scat_02 AS sca_2
WHERE chk.cat_code = cs.cat_code  
	AND chk.scat_code_1 = sca_1.scat_code_1
	AND chk.scat_code_2 = sca_2.scat_code_2
	AND chk.cmb_code = '5001'
  AND chk.cat_code = sc.cat_code
	AND chk.scat_code_1 = sc.scat_code_1
	AND chk.scat_code_2 = sc.scat_code_2
  AND us.userName = sc.ESCAL_1_USER_ID
  AND sc.ESCAL_1 < DATEDIFF(NOW(),DATE(chk.enterDateTime)) 
  AND sc.SLA_TYPE = 'DAY'
	AND chk.cat_code = '".$res_diff[0]."'
order by 7 desc;";
                
                echo $mail_add." -- ".$tit;
    $msg = "<table border='1' cellpadding='0' cellspacing='0'>
                <tr style='background-color: #BEBABA;'>
                  <td>#</td>
                  <td>Help ID</td>
                  <td>Department</td>
                  <td>Main Catagory</td>
                  <td>Sub Catagory</td>
                  <td>Issue</td>
                  <td>Issue Description</td>
                  <td>Issue Age Days</td>
                  <td>Assigned User</td>
                </tr>";
    $que_mail_body = mysqli_query($conn , $mail_body) or die(mysqli_error($conn));
    $x = 1;
    while($res_mail_body = mysqli_fetch_assoc($que_mail_body)){
        $msg .= "<tr style='vertical-align: top;'>
                  <td>".$x."</td>
                  <td>".$res_mail_body['Help_ID']."</td>
                  <td>".$res_mail_body['Department']."</td>
                  <td>".$res_mail_body['SubCatagory_1']."</td>
                  <td>".$res_mail_body['SubCatagory_2']."</td>
                  <td>".$res_mail_body['Issue']."</td>
                  <td>".$res_mail_body['Issue_Description']."</td>
                  <td>".$res_mail_body['Issue_Age_Days']."</td>
                  <td>".$res_mail_body['asing_By']."</td>
                </tr>";
                $x++;
        
        
    }
    
    $msg .= "</table><hr/>";
    echo $msg;
    // gen_mail($mail_add,$tit,$msg);
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:<cdberp@cdbnet.lk>' . "\r\n";

    //sendMailNuw($mail_add,$tit,$msg,$headers); 
    mail($mail_add,$tit,$msg,$headers);
}

function gen_mail($mail_add,$tit,$msg){
    $to = $mail_add;
    $subject = $tit; // subject
    $message = $msg; // message

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    // Additional headers
    $headers .= 'From:<cdberp@cdbnet.lk>' . "\r\n";
    // Mail it
    mail($to, $subject, $message, $headers);
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