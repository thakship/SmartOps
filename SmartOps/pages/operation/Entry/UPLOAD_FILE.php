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
        if(trim($_SESSION['user'])!=""){
            if(trim($_POST['sel_catagory']) != "" && trim($_POST['sel_scat01']) != "" && trim($_POST['sel_scat02']) != "" && trim($_POST['txt_issue']) != "" && trim($_POST['txt_Description']) != "" && trim($_POST['sel_States']) != "" && trim($_POST['sel_Urgency']) != "" && trim($_POST['sel_Priority'])!= ""){
                if(is_numeric($_POST['txt_facility_amount'])&& (int)$_POST['txt_facility_amount'] > 0 ){ //&& (int)$_POST['txt_facility_amount'] > 0  Validation added by Rizvi on 02-Jan-2017
                    $TableID = "";
					$hetCheck = 0;
					$_SESSION['fileAttachment'] = "";
					$_SESSION['fileAttachmentsub'] = "";
					$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
					$add = mysqli_query($conn,$sql);
					while ($rec = mysqli_fetch_array($add)){
						$_SESSION['CURRENT_DATE'] = $rec[0];
					}
					$Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
					$sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
					$quary_Function = mysqli_query($conn,$sqlFunction);
					
					while ($rec_Function = mysqli_fetch_array($quary_Function)){
						$batch_num = $rec_Function[0]; 
					}
					$TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
                
					// Attachemt Uploaded..............................................................................
					$getUploadStates = is_upload_file($conn,$TableID);
					if($getUploadStates == 1){
						echo "maximum file size. < 10MB >";
					}else{
						if($getUploadStates == 2){
							echo "already exists. File Error.";   
						}else{
							if($getUploadStates == 3){
								echo "already exists. Path.";
							}else{
								if($getUploadStates == 4){
									$getUploadStates = "";
								}
								$getUploadStatessub = is_upload_filesub($conn,$TableID);
								if($getUploadStatessub == 1){
									echo "maximum file size. < 10MB >";
								}else{
									if($getUploadStatessub == 2){
										echo "already exists. File Error.";   
									}else{
										if($getUploadStatessub == 3){
											echo "already exists. Path.";
										}else{
											if($getUploadStatessub == 4){
												$getUploadStatessub = "";
											}
											if(isset($_POST['chk_innnr'])){
												$hetCheck = 1;
											}
											$v_get_Def_User = "SELECT `DefuserID` FROM `scat_02` 
                                                WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND
                                                        `scat_code_1` = '".trim($_POST['sel_scat01'])."' AND 
                                                        `scat_code_2` = '".trim($_POST['sel_scat02'])."';";
											$que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(mysqli_error($conn));
											while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
												$usrDf = $RES_get_User['DefuserID'];
											}
											$v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_type`,`ssb_cycle`,`ssb_facility_amount`,`attachment_namesub`,`lastactivityon`) 
                                                VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".trim($_POST['txt_issue'])."', '".trim($_POST['txt_Description'])."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','Initial Submission',0,'".trim($_POST['txt_facility_amount'])."','".$getUploadStatessub."',now());";
                            
											//echo $v_getSQL_insert;
											$que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
											$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_type`,`ssb_cycle`,`ssb_facility_amount`,`attachment_namesub`,`lastactivityon`)
                                                 VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".trim($_POST['txt_issue'])."', '".trim($_POST['txt_Description'])."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','Initial Submission',0,'".trim($_POST['txt_facility_amount'])."','".$getUploadStatessub."',now());";
                            
											//echo $v_getSQL_insert_1;
											$que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
											$sql_insert = "INSERT INTO `cdb_ssb`(`helpid`, `applicant_info`, `clear_valuation`, `guarantor_1`, `guarantor_2`, `cr_copy_and_invoce`, `supplar_info`) 
                                                VALUES ('".$TableID."','0','0','0','0','0','0');"; 
											$query_inset =  mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
											for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
												if(trim($_POST['txtb'.$y])!= ""){
													$v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES ('".$TableID."','".$y."',CONCAT('".trim($_POST['txtb'.$y])." on ', now()),'".$_SESSION['user']."',now(),'UPLOAD_FILE.PHP');";
													$que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
												}
											}
                            
											$sql_edfu = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code`='".trim($_POST['sel_catagory'])."' AND `scat_code_1`='".trim($_POST['sel_scat01'])."' AND `scat_code_2` = '".trim($_POST['sel_scat02'])."';";
											$que_edrf = mysqli_query($conn,$sql_edfu);
											while($RES_edrf = mysqli_fetch_assoc($que_edrf)){
												$sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
												$que_email = mysqli_query($conn,$sql_email);
												if(mysqli_num_rows($que_email) > 0){
													while($RES_email = mysqli_fetch_assoc($que_email)){
													//$getmail = $RES_email['email'];
													$getmail = 'wimukthi.madushan@cdb.lk';
												}
												$sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$_SESSION['user']."';";
												$que_uName = mysqli_query($conn,$sql_uName);
												while($RES_uName = mysqli_fetch_assoc($que_uName)){
													$getUName = $RES_uName['userID'];
													$getTP = $RES_uName['GSMNO'];
												}
												$sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$_SESSION['userDepartment']."' AND `branchNumber` = '".$_SESSION['userBranch']."';";
												$que_uDepa = mysqli_query($conn,$sql_uDepart);
												while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
													$getUBranch = $RES_udep['deparmentName'];
												} 
												$title = "CDB Help Desk : New service request";
												/*$mail = "New Service Request : ".$TableID."---<".trim($_POST['txt_issue']).">\n\n From : ".$_SESSION['user']."--".$getUName."\n\n";
												$mail .= "Branch :".$_SESSION['userBranchName']."\\n\\n";
												$mail .= "Department :".$getUBranch;*/
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
														<td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_issue'])."</td>
													</tr>
													 <tr>
														<td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
														<td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['user']."</td>
													</tr>
													<tr>
														<td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
														<td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
													</tr>
													<tr>
														<td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
														<td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['userBranchName']."</td>
													</tr>
													<tr>
														<td style='width:200px; text-align:left; padding-left:5px'>Department</td>
														<td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
													</tr>
													<tr>
														<td style='width:200px; text-align:left; padding-left:5px'>User IP</td>
														<td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['userIP']."</td>
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
												sendMailNuw($getmail,$title,$mail,$headers);
											}
										}
										mysqli_commit($conn); 
										$stringMessage = "Service request submitted. \\n\\nYour SR Number : ".$TableID;
										echo $stringMessage;
										$_SESSION['fileAttachment'] = "";
										$_SESSION['fileAttachmentsub'] = ""; 
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
					echo "Facility amount is Invalid.";  
				}       
				   
			}else{
				echo "Some Values are missing.";  
			}
		}else{
			echo "Undefind User. Please re login.";  
		}
	}catch(Exception $e){
		mysqli_rollback($conn);
		echo 'Message: '.$e->getMessage();
	}
?>