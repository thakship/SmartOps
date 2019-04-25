<?php 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'Off');

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
          (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = cdbprod)))";
$dbConn = oci_connect('cdberp','cdberp',$dbstr1); 

date_default_timezone_set("Asia/Calcutta");
echo date("Y/m/d H:i:s");
echo "\n";
if(!$dbConn){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	exit;
}else {
	//print "Connected to Oracle!";
	echo "Successfully connected to Oracle.<br/>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* -------------------------------------------------------------------------------------------------------------------------------------------------
                                                           
-------------------------------------------------------------------------------------------------------------------------------------------------*/ 
$stid = oci_parse($dbConn, "select QTYPE_QREF,
                                   QTYPE_QMODE, 
                                   QTYPE_CAT_CODE, 
                                   QTYPE_SCAT_CODE_1,
                                   QTYPE_SCAT_CODE_2,
                                   QTYPE_SCAT_CODE_3, 
                                   QTYPE_CMB_CODE, 
                                   QTYPE_UR_CODE, 
                                   QTYPE_PR_CODE, 
                                   QTYPE_ISSUE,
                                   QTYPE_HELP_DESCR, 
                                   QTYPE_ENTERBY, 
                                   QTYPE_ENTERDATETIME, 
                                   QTYPE_ENTRY_BRANCH,
                                   QTYPE_ENTRY_DEPARTMENT, 
                                   QTYPE_HELPID, 
                                   QTYPE_UPDATE 
                                   FROM CDBPRODDB.CDB_SMARTOPSQ S 
                                   WHERE S.QTYPE_HELPID IS NULL");
                                   
oci_execute($stid);
$helpID = "";
$i = 0;
echo "Starting to echo".chr(10);
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {	//Read Oracle Source table
    $i++;
    //---- Madushan  4:22 PM 11/07/2018
    if(!isset($row[13])){
        $row[13] = "";
    }
    echo $i."  Record(s) reading................<br/>";
    //Generate HELP ID
    $helpID = "";    

    //INSERT HELP_DESK
    $Current_Year = date("Y");
    $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
    $quary_Function = mysqli_query($conn,$sqlFunction);
    while ($rec_Function = mysqli_fetch_array($quary_Function)){
        $batch_num = $rec_Function[0]; 
    }
    $TableID = $Current_Year.str_pad($batch_num, 6, '0', STR_PAD_LEFT); //This will return 2014000001 as first number for 2014 and 20150001 in 2015
    
    
    /* ------------------------------ Start Inserting HelpDesk ------------------------------ */    
    $validateCount = 0;
    /*
    row[2]	2	QTYPE_CAT_CODE ok
    row[3]	3	QTYPE_SCAT_CODE_1 ok 
    row[4]	4	QTYPE_SCAT_CODE_2 ok 
    row[5]	5	QTYPE_SCAT_CODE_3
    row[6]	6	QTYPE_CMB_CODE ok
    row[7]	7	QTYPE_UR_CODE ok
    row[8]	8	QTYPE_PR_CODE
    row[9]	9	QTYPE_ISSUE
    row[10]	10	QTYPE_HELP_DESCR
    row[11]	11	QTYPE_ENTERBY
    row[12]	12	QTYPE_ENTERDATETIME
    row[13]	13	QTYPE_ENTRY_BRANCH
    row[14]	14	QTYPE_ENTRY_DEPARTMENT
    */
    
    //Default User
    $usrDf = "";
    $v_get_Def_User = "SELECT `DefuserID` , `scat_discr_2` FROM `scat_02` 
                        WHERE `cat_code` = '".trim($row[2])."' AND
                              `scat_code_1` = '".trim($row[3])."' AND 
                              `scat_code_2` = '".trim($row[4])."';";
    $que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(mysqli_error($conn));
    while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
        $usrDf = $RES_get_User['DefuserID'];
        $scat_discr_2 =  $RES_get_User['scat_discr_2'];
    }
   
    $hetCheck = 0;
    $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                VALUES ('".$TableID."', '".trim($row[2])."', '".trim($row[3])."', '".trim($row[4])."', '".trim($row[6])."', '".trim($row[7])."', '".trim($row[8])."', '".$row[9]."', '".$row[10]."', '".$row[11]."', now(),'','', '', '','','".$hetCheck."','".trim($row[13])."','".trim($row[14])."','8001','".trim($row[5])."','".$usrDf."','','','0');";
    echo $v_getSQL_insert;
    echo "---------------------------------------------------------<BR/>";
    $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
    
    $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                 VALUES ('".$TableID."', '".trim($row[2])."', '".trim($row[3])."', '".trim($row[4])."', '".trim($row[6])."', '".trim($row[7])."', '".trim($row[8])."', '".$row[9]."', '".$row[10]."', '".$row[11]."', now(),'','', '', '','','".$hetCheck."','".trim($row[13])."','".trim($row[14])."','8001','".trim($row[5])."','".$usrDf."','','0');";
    echo $v_getSQL_insert."<br/>";                 
    $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
    /* ------------------------------ End Inserting HelpDesk ------------------------------ */
    
    /*---------- Update Working Queue*/
    $O_Update = "UPDATE CDBPRODDB.CDB_SMARTOPSQ S 
                    SET S.QTYPE_HELPID= '".$TableID."', 
                        S.QTYPE_UPDATE = SYSDATE 
                  WHERE S.QTYPE_QREF = ".$row[0];
    $v_sql = oci_parse($dbConn, $O_Update);
    echo $O_Update."<br/>";
	//oci_execute($v_sql,OCI_COMMIT_ON_SUCCESS);
    
    
 if ($v_sql) {
   if (oci_execute($v_sql, OCI_COMMIT_ON_SUCCESS)) {
      if (oci_num_rows($v_sql) === 0) {
        /* No rows affected */
        //echo "A";
      }
   } else {
     echo "A Error";
      /*Handle error through oci_error*/
      $e = oci_error($v_sql);  // For oci_parse errors pass the connection handle
      echo $e['message'];
   }
 } else {
    echo "B Error";
   /* Handle parse error */
 }
 
 
 
 
	echo $i."  Inserted................<br/><br/>";
  /*--- 4:24 PM 26/02/2019
 //---------------------- Start Mail Send ----------------------
    $sql_edfu = "SELECT `DefuserID` 
                   FROM `scat_02` 
                  WHERE `cat_code`='".trim(trim($row[2]))."' 
                    AND `scat_code_1`='".trim($row[3])."' 
                    AND `scat_code_2` = '".trim($row[4])."';";
    $que_edrf = mysqli_query($conn,$sql_edfu);
    while($RES_edrf = mysqli_fetch_assoc($que_edrf)){

        if ($RES_edrf['DefuserID'] =='01BRANCH'){
			$sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
        }else {
            $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
        }
        $que_email = mysqli_query($conn,$sql_email);
                                if(mysqli_num_rows($que_email) > 0){
               					    while($RES_email = mysqli_fetch_assoc($que_email)){
                       	                $getmail = $RES_email['email'];
                       	            }
                                    $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$row[11]."';";
                                    $que_uName = mysqli_query($conn,$sql_uName);
                                    while($RES_uName = mysqli_fetch_assoc($que_uName)){
                                        $getUName = $RES_uName['userID'];
                                        $getTP = $RES_uName['GSMNO'];
                                    }
                                    $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$row[14]."' AND `branchNumber` = '".$row[13]."';";
                                    $que_uDepa = mysqli_query($conn,$sql_uDepart);
                                    while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                                        $getUBranch = $RES_udep['deparmentName'];
                                    } 
                                    $title = "CDB Help Desk : New service request";
                                    
$mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$TableID."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($row[9])."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$row[11]."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User Telephone</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getTP."</td>
    </tr>
 </table>
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
$headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                //sendMail($getmail,$title,$mail,$headers);    

    echo $getmail;
    sendMailNuw($getmail,$title,$mail,$headers); 


		}
	} 4:24 PM 26/02/2019 */
//-------------------------------------------------------------------------------------------------
}
echo "\r\n".$i." Record(s) syncronized.............................<br/>";
function sendMailNuw($toMail,$title,$mail,$fromMail){
	$to = $toMail;
	$subject = $title;
	$message = $mail;
	$headers = $fromMail;
	mail($to,$subject,$message,$headers);
	/*echo "<script> alert('Mail Sent!');</script>";*/
}
