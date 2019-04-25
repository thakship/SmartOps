<?php

$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
date_default_timezone_set('Asia/Colombo');
$sql_pre_date = "SELECT `previousDate` FROM `systemdate`;";
$que_per_date = mysqli_query($conn,$sql_pre_date) or die(mysqli_error($conn));
while($rec_per_date = mysqli_fetch_array($que_per_date)){
    $per_date = $rec_per_date[0];
}



$sql_dtl_brn = "select cf.receiveDepartmentNumber , dp.deparmentName, Count(*) As Pending_Files , dp.deparmentEmail
from courier_files cf , deparment dp
where cf.receiveBranchNumber = '0001'
and cf.sendDateTime <> '0000-00-00 00:00:00'
and cf.receiveDateTime = '0000-00-00 00:00:00'
and dp.branchNumber = cf.receiveBranchNumber
and dp.deparmentNumber = cf.receiveDepartmentNumber
and cf.stats NOT IN ('AD','PDR','FDR','CC','BR','AB')
and cf.receiveDepartmentNumber != 'UNDEF'
and cf.stats <> 'Archiving'
group by cf.receiveDepartmentNumber
order by 2 , 3 ;";
$que_dtl_brn = mysqli_query($conn , $sql_dtl_brn) or die(mysqli_error($conn));
while($rec_dtl_brn = mysqli_fetch_array($que_dtl_brn)){
    if($rec_dtl_brn[3] == ""){
        echo "have not Mail Address. <br/>";
    }else{
        echo $rec_dtl_brn[3]."<br/>";    
    }
    
    //$to = 'wimukthi.madushan@cdb.lk;';
    $to = $rec_dtl_brn[3];
$subject = "Courier Files to be collected  - ".$per_date." - ".$rec_dtl_brn[0]." (".$rec_dtl_brn[2]." File(s))"; // Subject male
$message = "
<html>
<head>
  <title>Courier Files to be collected</title>
</head>
<body>
  <p>Pending Courier to be collected</p>
  <table border='1' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
    <tr style='background-color: #BEBABA;'>
      <th style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Branch</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Department</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Number of Courier</span></th>
    </tr>
  ";
                 
    $sql_dtl_cou = "select cf.receiveDepartmentNumber ,b.branchName ,d.deparmentName ,Count(*) As Pending_Files
                        from courier_files cf , branch AS b , deparment AS d
                        where cf.receiveBranchNumber = '0001'
                         and cf.sendDateTime <> '0000-00-00 00:00:00'
                         and cf.receiveDateTime = '0000-00-00 00:00:00'
                         and cf.branchNumber = b.branchNumber
                          and cf.departmentNumber = d.deparmentNumber
                          and cf.receiveDepartmentNumber = '".$rec_dtl_brn[0]."'
                          and cf.stats NOT IN ('AD','PDR','FDR','CC','BR','AB')
                          and cf.stats <> 'Archiving'
                        group by  b.branchName
                              order by 2 , 3 ;";
                 
                        
    $que_dtl_cou = mysqli_query($conn, $sql_dtl_cou) or die(mysqli_error($conn));
    while($rec_dtl_cou = mysqli_fetch_array($que_dtl_cou)){
        echo $rec_dtl_cou[0]." -- ".$rec_dtl_cou[1]." -- ".$rec_dtl_cou[2]." -- ". $rec_dtl_cou[3]. "<br/>";
        $message .= "<tr>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_cou[1]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_cou[2]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_cou[3]."</span></th>
                </tr>";
    }
    $message .= "</table>
</body>
</html>";  
//$to_cc = "wimukthi.madushan@cdb.lk;";
$to_cc = "";
if($to != ""){
    $message_body = mysqli_real_escape_string($conn,$message);
    $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), 'SYSTEM', '".$to."', '".$subject."', '".$message_body."', '".$to_cc."', '0000-00-00 00:00:00');";
    //echo $inseet_mailBox;
    $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));
}
 echo "<hr/><br/>";
}
    // To send HTML mail, the Content-type header must be set
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Department Received Courier in the ERP System <cdberp@cdbnet.lk>' . "\r\n";
// Mail it
if($to != ""){
   // mail($to, $subject, $message, $headers);
}*/



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Branch coriar
echo "Branch Mail Courier ------------------------------------------------------------------------------------------------------------------------------<br/>";
$subjectbran = "Courier Files to be collected  - ".$per_date." - Branch(s)"; // Subject male
$megBranch = "
<html>
<head>
  <title>Courier Files to be collected</title>
</head>
<body>
  <p>Pending Courier to be collected - Branch</p>
  <table border='1' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
    <tr style='background-color: #BEBABA;'>
      <th style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Branch</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Branch Name</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Number of Courier</span></th>
    </tr>
  ";
  
$sql_dtl_bran = "select cf.receiveBranchNumber, b.branchName , COUNT(*)
                    from courier_files cf , branch AS b
                    where cf.receiveBranchNumber != '0001'
                    and cf.sendDateTime <> '0000-00-00 00:00:00'
                    and cf.receiveDateTime = '0000-00-00 00:00:00'
                    and cf.receiveBranchNumber = b.branchNumber
                    and cf.stats != 'AD'
                    and cf.stats != 'PDR'
                    and cf.stats != 'FDR'
                    and cf.stats != 'CC'
                    and cf.stats <> 'Archiving'
                    and cf.stats <> 'DOCUMENT A'
                    group by cf.receiveBranchNumber
                    order by 1 ";
                 
                        
    $que_dtl_bran = mysqli_query($conn, $sql_dtl_bran) or die(mysqli_error($conn));
    while($rec_dtl_bran = mysqli_fetch_array($que_dtl_bran)){
        echo $rec_dtl_bran[0]." -- ".$rec_dtl_bran[1]." -- ".$rec_dtl_bran[2]. "<br/>";
        $megBranch .= "<tr>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[0]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[1]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[2]."</span></th>
                </tr>";
    }
    $megBranch .= "</table>
</body>
</html>"; 

$bran_to = "";
$bran_to_cc = "nayanthi@cdb.lk;";
$sql_paramail = "SELECT `para_value` 
                    FROM  `erp_sys_param` 
                    WHERE  `para_code` =  '11';";
$que_paramail = mysqli_query($conn, $sql_paramail) or die(mysqli_error($conn));
while($recparamail = mysqli_fetch_array($que_paramail)){
    $bran_to = $recparamail[0];
}
if($bran_to != ""){
    $messagebran_body = mysqli_real_escape_string($conn,$megBranch);
    $inseet_bran_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), 'SYSTEM', '".$bran_to."', '".$subjectbran."', '".$messagebran_body."', '".$bran_to_cc."', '0000-00-00 00:00:00');";
    //echo $inseet_mailBox;
    $que_mailBoxbran = mysqli_query($conn,$inseet_bran_mailBox) or die(mysqli_error($conn));
}
 echo "<hr/>";



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Department coriar
echo "Deparment Mail Courier ------------------------------------------------------------------------------------------------------------------------------<br/>";
$subjectbran = "Courier Files to be collected  - ".$per_date." - Department(s)"; // Subject male
$megBranch = "
<html>
<head>
  <title>Courier Files to be collected</title>
</head>
<body>
  <p>Pending Courier to be collected - Department</p>
  <table border='1' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
    <tr style='background-color: #BEBABA;'>
      <th style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Branch</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Department</span></th>
      <th style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Number of Courier</span></th>
    </tr>
  ";
  
$sql_dtl_bran = "select cf.receiveBranchNumber, b.branchName ,cf.receiveDepartmentNumber,d.deparmentName , COUNT(*)
		from courier_files cf , branch AS b , deparment AS d
		where cf.receiveBranchNumber = '0001'
		and cf.sendDateTime <> '0000-00-00 00:00:00'
		and cf.receiveDateTime = '0000-00-00 00:00:00'
		and cf.receiveBranchNumber = b.branchNumber
    and cf.receiveDepartmentNumber = d.deparmentNumber
		and cf.stats != 'AD'
		and cf.stats != 'PDR'
		and cf.stats != 'FDR'
		and cf.stats != 'CC'
		and cf.stats <> 'Archiving'
		and cf.stats <> 'DOCUMENT A'
	group by cf.receiveDepartmentNumber
	order by 5 DESC ";
                 
                        
    $que_dtl_bran = mysqli_query($conn, $sql_dtl_bran) or die(mysqli_error($conn));
    while($rec_dtl_bran = mysqli_fetch_array($que_dtl_bran)){
        echo $rec_dtl_bran[0]." -- ".$rec_dtl_bran[1]." -- ".$rec_dtl_bran[2]. "<br/>";
        $megBranch .= "<tr>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[1]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[3]."</span></td>
                  <td style='text-align: left;'><span style='margin-left: 5px;'>".$rec_dtl_bran[4]."</span></th>
                </tr>";
    }
    $megBranch .= "</table>
</body>
</html>"; 

$bran_to = "";
$bran_to_cc = "nayanthi@cdb.lk;";
$sql_paramail = "SELECT `para_value` 
                    FROM  `erp_sys_param` 
                    WHERE  `para_code` =  '12';";
$que_paramail = mysqli_query($conn, $sql_paramail) or die(mysqli_error($conn));
while($recparamail = mysqli_fetch_array($que_paramail)){
    $bran_to = $recparamail[0];
}
if($bran_to != ""){
    $messagebran_body = mysqli_real_escape_string($conn,$megBranch);
    $inseet_bran_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) VALUES (NOW(), 'SYSTEM', '".$bran_to."', '".$subjectbran."', '".$messagebran_body."', '".$bran_to_cc."', '0000-00-00 00:00:00');";
    //echo $inseet_mailBox;
    $que_mailBoxbran = mysqli_query($conn,$inseet_bran_mailBox) or die(mysqli_error($conn));
}
 echo "<hr/>";

    

?>