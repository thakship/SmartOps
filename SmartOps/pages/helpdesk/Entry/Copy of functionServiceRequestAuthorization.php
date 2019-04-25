<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_POST['hidA']) && isset($_POST['huserA'])){
	echo "isApprove>>>>";
    isApprove(trim($_POST['hidA']),trim($_POST['huserA']));
}

if(isset($_POST['hidR']) && isset($_POST['huserR'])){
    echo $_POST['hidR']."-".$_POST['huserR'];
    isReject(trim($_POST['hidR']),trim($_POST['huserR']));
}

if(isset($_POST['hidp']) && isset($_POST['huserp']) && isset($_POST['commentp'])){
    isPending(trim($_POST['hidp']),trim($_POST['huserp']), trim($_POST['commentp']));
}

function isApprove($hid,$huser){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
       date_default_timezone_set('Asia/Colombo');
       
       
//---------------------------------------------------- Send Mail --------------------------------------------------
       
       if (strpos($hid, 'loan_') == 0) {
		   $sql_select_iss = "SELECT 9999 as cat_code,
						  `scat_code_1`,
						 `scat_code_2`, 
						 `scat_code_3` ,
						 `entry_branch` , 
						 `entry_department` , 
						 `enterBy` , 
						 `issue` ,
						 `ssb_facility_amount`
				FROM `loan_cdb_helpdesk` WHERE `helpid` = '".$hid."';";

	   }else{
		   $sql_select_iss = "SELECT `cat_code`,
									  `scat_code_1`,
									 `scat_code_2`, 
									 `scat_code_3` ,
									 `entry_branch` , 
									 `entry_department` , 
									 `enterBy` , 
									 `issue` ,
									 `ssb_facility_amount`
							FROM `cdb_helpdesk` WHERE `helpid` = '".$hid."';";
		}
		echo "<script language='javascript'>alert(".$sql_select_iss."); </script>";
       $query_select_iss = mysqli_query($conn , $sql_select_iss) or die(mysqli_error($conn));
       //------------------- 1 st While Start 
       while($rec_select_iss = mysqli_fetch_assoc($query_select_iss)){
           if($rec_select_iss['cat_code'] == '1038'){
                 /*$sql_Approve = "UPDATE cdb_helpdesk AS hel
                            SET hel.cmb_code = '5050',
                                hel.enterDateTime = NOW(),
                                hel.branch_auth_by = '".$huser."',
                                hel.branch_auth_on = NOW()
                            WHERE hel.helpid = '".$hid."';";*/
               $sql_Approve = "UPDATE cdb_helpdesk AS hel 
                            SET hel.cmb_code = '5049',
                                hel.enterDateTime = NOW(),
                                hel.branch_auth_by = '".$huser."',
                                hel.branch_auth_on = NOW()
                            WHERE hel.helpid = '".$hid."';";
            }else{
				 if($rec_select_iss['cat_code'] == 9999){
					 $sql_Approve = "UPDATE loan_cdb_helpdesk AS hel 
								SET hel.cmb_code = '5001',
									hel.enterDateTime = NOW(),
									hel.branch_auth_by = '".$huser."',
									hel.branch_auth_on = NOW()
								WHERE hel.helpid = '".$hid."';";
				 }else{
					 $sql_Approve = "UPDATE cdb_helpdesk AS hel 
								SET hel.cmb_code = '5001',
									hel.enterDateTime = NOW(),
									hel.branch_auth_by = '".$huser."',
									hel.branch_auth_on = NOW()
								WHERE hel.helpid = '".$hid."';";
				}
            }
              
                    //echo $sqlApprove;
       
		   $query_Approve = mysqli_query($conn,$sql_Approve) or die(mysqli_error($conn));
		   $NOTE = "File Approved by Branch";
		   $CreateNote = "FILE_APPROVED";
		   if($rec_select_iss['cat_code'] != 9999)
		      CreateNote($conn , $hid,$NOTE,$huser,$CreateNote);
		  //-------------------------------------
		  if($rec_select_iss['cat_code'] == 1014){
			  $sql_dtl = "SELECT u.GSMNO FROM user AS u WHERE u.userName = '".$rec_select_iss['enterBy']."';";
			  $query_dtl = mysqli_query($conn,$sql_dtl)  or die(mysqli_error($conn));
			  while($rec_dtl = mysqli_fetch_array($query_dtl)){
				  if($rec_dtl[0] != ""){
					  //echo $rec_dtl[0];
					  $MOBILE_NO = $rec_dtl[0];
					  $MESSAGE = "File ( Ref : ".$hid.") Submitted by Branch. - Client Information : " . $rec_select_iss['issue'];
					  $GENERATED_SOURCE = "BRANCH_QC_KIOSK";
					  SMSSender($conn , $MOBILE_NO, $MESSAGE,$GENERATED_SOURCE);
				  }
				  
			  }
			  
		  }
          
		  
		  if($rec_select_iss['cat_code'] != 9999){
			$sql_edfu = "SELECT `DefuserID` , `scat_discr_2` FROM `scat_02` WHERE `cat_code`='".$rec_select_iss['cat_code']."' AND `scat_code_1`='".$rec_select_iss['scat_code_1']."' AND `scat_code_2` = '".$rec_select_iss['scat_code_2']."';";
			$que_edrf = mysqli_query($conn,$sql_edfu) or die(mysqli_error($conn));
			//------------------------ 2 - While Start 
            while($RES_edrf = mysqli_fetch_assoc($que_edrf)){
                $usrDf = $RES_edrf['DefuserID'];
                $scat_discr_2 =  $RES_edrf['scat_discr_2'];
                
                 
                 
                 if ($usrDf =='01BRANCH'){
        			$SQL_BRWISE_USER = "select DefuserID from defuserforbranchreq df  where branchNumber = '".$rec_select_iss['entry_branch']."' and scat_code_2 = ".$rec_select_iss['scat_code_2'].";";
        			$RS_GetBrWiseDefaultUser = mysqli_query($conn,$SQL_BRWISE_USER) or die(mysqli_error($conn));
        			while($t_RS_GetBrWiseDefaultUser = mysqli_fetch_assoc($RS_GetBrWiseDefaultUser)){
        				$usrDf = $t_RS_GetBrWiseDefaultUser['DefuserID'];
        			}
        		 }
                
                //-----------------------------------
                if ($RES_edrf['DefuserID'] =='01BRANCH'){
					$sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
				}else if($rec_select_iss['scat_code_2']=="10140128" || $rec_select_iss['scat_code_2']=="10140134"){
                    //ssb_facility_amount
                    if($rec_select_iss['scat_code_2']=="10140128" && $rec_select_iss['ssb_facility_amount'] >= 5000000.00){
                        $sql_email = "SELECT concat (z.HO_50_priority_file , e.para_value)
                                            FROM cdbzone AS z , branch AS b , erp_sys_param AS e
                                            WHERE z.zone_code = b.CDBZONE
                                              AND b.branchNumber = '".$rec_select_iss['entry_branch']."'
                                              AND e.para_code = 16;";
                    }else if($rec_select_iss['scat_code_2']=="10140128" && $rec_select_iss['ssb_facility_amount'] < 5000000.00){
                        $sql_email = "SELECT z.HO_50_priority_file FROM cdbzone AS z , branch AS b WHERE z.zone_code = b.CDBZONE AND b.branchNumber = '".$rec_select_iss['entry_branch']."'";
                    }else if($rec_select_iss['scat_code_2']=="10140134" && $rec_select_iss['ssb_facility_amount'] >= 5000000.00){
                          $sql_email = "SELECT concat (z.HO_50_70_exposure_files , e.para_value)
                                            FROM cdbzone AS z , branch AS b , erp_sys_param AS e
                                            WHERE z.zone_code = b.CDBZONE
                                              AND b.branchNumber = '".$rec_select_iss['entry_branch']."'
                                              AND e.para_code = 16;";
                    }else if($rec_select_iss['scat_code_2']=="10140134" && $rec_select_iss['ssb_facility_amount'] < 5000000.00){
                        $sql_email = "SELECT z.HO_50_70_exposure_files FROM cdbzone AS z , branch AS b WHERE z.zone_code = b.CDBZONE AND b.branchNumber = '".$rec_select_iss['entry_branch']."'";
                    }else{
                        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
                    }
                }else {
				    if($rec_select_iss['scat_code_3']=="20011502" || $rec_select_iss['scat_code_3']=="20011504"){
				        $usrDf = "01002136"; //Marketing officer creation goes to Maneesha
				        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
				    }else{
				        $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";    
				    } 
                    
					
				}
                //-------------------------------------
                $que_email = mysqli_query($conn,$sql_email) or die(mysqli_error($conn));
                if(mysqli_num_rows($que_email) > 0){
                    while($RES_email = mysqli_fetch_array($que_email)){
       	                $getmail = $RES_email[0];
       	            }
                    $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$rec_select_iss['enterBy']."';"; 
                    $que_uName = mysqli_query($conn,$sql_uName) or die(mysqli_error($conn));
                    while($RES_uName = mysqli_fetch_assoc($que_uName)){
                        $getUName = $RES_uName['userID'];
                        $getTP = $RES_uName['GSMNO'];
                    }
                    $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$rec_select_iss['entry_department']."' AND `branchNumber` = '".$rec_select_iss['entry_branch']."';";
                    $que_uDepa = mysqli_query($conn,$sql_uDepart) or die(mysqli_error($conn));
                    while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                        $getUBranch = $RES_udep['deparmentName'];
                    } 
                    $S2cat ="";
                     $sql_s2cat = "SELECT `scat_discr_2` FROM `scat_02` WHERE `scat_code_2`='".$rec_select_iss['scat_code_2']."';";
                    $que_s2cat = mysqli_query($conn,$sql_s2cat) or die(mysqli_error($conn));
                    while($RES_s2cat = mysqli_fetch_assoc($que_s2cat)){
                        $S2cat = $RES_s2cat['scat_discr_2'];
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
							<td style='width:400px; text-align:left; padding-left:5px'>".$hid."</td>
						</tr>
						<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>Category </td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$S2cat."</td>
						</tr>
						<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$rec_select_iss['issue']."</td>
						</tr>";
						if($rec_select_iss['ssb_facility_amount'] > 0.00){
							 $mail .= "<tr>
											<td style='width:200px; text-align:left; padding-left:5px'>Facility Amount</td>
											<td style='width:400px; text-align:left; padding-left:5px'>".$rec_select_iss['ssb_facility_amount']."</td>
										</tr>";
						}
					   $mail .= "<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$rec_select_iss['enterBy']."</td>
						</tr>
						<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
						</tr>
						<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$rec_select_iss['entry_branch']."</td>
						</tr>
						<tr>
							<td style='width:200px; text-align:left; padding-left:5px'>Department</td>
							<td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
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
					echo $getmail;
       
					sendMailNuw($getmail,$title,$mail,$headers); 
                }
            } //------------------------ 2 - While End 
		  }
       } //------------------- 1 st While End 
       
//---------------------------------------------------- Send Mail END --------------------------------------------------       
       
       if($query_Approve){
         mysqli_commit($conn);  
         //echo "Approve Success.";
       }else{
         //echo "Approve Unsuccess.";
       }
    }catch(Exception $e){
		mysqli_rollback($conn);
		echo 'Message: '.$e->getMessage();
	}
    
}

function isReject($hid,$huser){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
       date_default_timezone_set('Asia/Colombo');
       $sql_Reject = "UPDATE cdb_helpdesk AS hel 
                            SET hel.cmb_code = '5005',
                                hel.caloser_by = '".$huser."', 
                                hel.caloser_dateTime = now(), 
                                hel.resulution = 'Reject by the Branch',
                                hel.ssb_type ='Reject by the Branch', 
                                hel.solution ='Reject by the Branch',
                                hel.solved_by = '".$huser."',
                                hel.solved_on = now()
                            WHERE hel.helpid = '".$hid."';";
       //echo $sqlReject;
       
       $query_Reject = mysqli_query($conn,$sql_Reject) or die(mysqli_error($conn));
       $NOTE = "File Reject by Branch";
       $CreateNote = "FILE_Reject";
       CreateNote($conn , $hid,$NOTE,$huser,$CreateNote);
       
       if($query_Reject){
         mysqli_commit($conn);  
         //echo "Reject Success.";
       }else{
         //echo "Reject Unsuccess.";
       }
    }catch(Exception $e){
		mysqli_rollback($conn);
		echo 'Message: '.$e->getMessage();
	}
}

function  isPending($hid,$huser,$commentp){
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
       date_default_timezone_set('Asia/Colombo');
       $sql_cou_cycal = "SELECT `ssb_cycle` FROM `cdb_helpdesk`  WHERE `cdb_helpdesk`.`helpid` = '".$hid."';";     
       $query_cou_cycal = mysqli_query($conn,$sql_cou_cycal);
       $r = 1;
       
       while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
                 $r = $res_cou_cycal[0] + 1;
                 $sql_update = "UPDATE cdb_helpdesk AS chd
                            SET chd.ssb_type = 'Branch - Pending Notified' , chd.ssb_cycle = '".$r."'
                            WHERE chd.helpid = '".$hid."';";
                 //echo $sql_update." -- ";
                    
                 $query_update =  mysqli_query($conn,$sql_update) or die(mysqli_error($conn));
                 $NOTE = "Branch Pending notified - ".$commentp;
               $CreateNote = "FILE_Pending";
               CreateNote($conn , $hid,$NOTE,$huser,$CreateNote);
                if($query_update){
                     mysqli_commit($conn);  
                     //echo "Reject Success.";
               }else{
                 //echo "Reject Unsuccess.";
               }
                 
       }
       
    }catch(Exception $e){
		mysqli_rollback($conn);
		echo 'Message: '.$e->getMessage();
	}
    
}

function CreateNote($ConnERP , $HELP_ID,$NOTE,$USER,$CreateNote){
        date_default_timezone_set('Asia/Colombo');
        $SERIAL = 1;
    
        /*Get the Max count of Note*/
        $sql_select_note_count =  "SELECT COUNT(*) FROM `cdb_help_note` WHERE `helpid` = '".$HELP_ID."';";
        $query_select_note_count = mysqli_query($ConnERP , $sql_select_note_count) or die(mysqli_error($ConnERP));
        while($rec_select_note_count = mysqli_fetch_array($query_select_note_count)){
            $SERIAL = $rec_select_note_count[0] + 1;    
        }
        
        $sql_note_update = "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES (".$HELP_ID.",'".$SERIAL."','".$NOTE."','".$USER."',now(),'".$CreateNote."');";
        $query_note_update = mysqli_query($ConnERP,$sql_note_update) or die(mysqli_error($ConnERP));
} 

function sendMailNuw($toMail,$title,$mail,$fromMail){
	/*$to = $toMail;
	$subject = $title;
	$message = $mail;
	$headers = $fromMail;*/
//	mail($to,$subject,$message,$headers);
	/*echo "<script> alert('Mail Sent!');</script>";*/
    
    
    
    $conn = DatabaseConnection();
	$to = $toMail;
	$subject = $title;
	$message = mysqli_real_escape_string($conn, $mail); ;
	$headers = $fromMail;
	//mail($to,$subject,$message,$headers);
	/*echo "<script> alert('Mail Sent!');</script>";*/
    $sender = "SYSTEM";
    $to_cc = $toMail;
    $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) 
                VALUES (NOW(), '".$sender."', '".$to."', '".$subject."', '".$message."', '".$to_cc."', '0000-00-00 00:00:00');";
        //echo $inseet_mailBox;
    $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));  
}

function SMSSender($ConnERP , $MOBILE_NO, $MESSAGE,$GENERATED_SOURCE){
        date_default_timezone_set('Asia/Colombo');
        $SERIAL = 1;
        if ( substr($MOBILE_NO,0,2) =='07'){
            $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) VALUES ('".$MOBILE_NO."','".$MESSAGE."',now(),'HELPDESK','".$GENERATED_SOURCE."',0);";
            //echo $sql_sms;
            $query_sms =  mysqli_query($ConnERP,$sql_sms) or die(mysqli_error($ConnERP));                                                    
        }
}
?>