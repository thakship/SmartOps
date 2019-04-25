 <?php
    //session_start();
	if(isset($_POST['btnLogin']) && $_POST['btnLogin']=='Login'){	
		$user = trim($_POST['txtusername']);
		$pass = trim($_POST['txtpassword']);
		$_SESSION['userIP'] = $_SERVER["REMOTE_ADDR"];
		$sql="select `user`.`password`,`user`.`userStat`,`user`.`accountStat`, `user`.`usergroupNumber`,`user`.`userID`,`user`.`branchNumber`,`user`.`deparmentNumber` ,`user`.`email` ,`branch`.`branchName`,`user`.`helpdeskadmin` ,`user`.`helpdesk_close` , `user`.`GSMNO` , `user`.`login_count` , `deparment`.deparmentName ,`branch`.`CDBZONE`
                 ,IFNULL((select cc.LENDING_WAVG from cdbZonePerformance cc where cc.CDBZONE = branch.CDBZONE),0) AS ZONELENDRATE 
				 ,IFNULL((select s.para_value from erp_sys_param s where s.para_code = 17),0) AS CDBWALR
				 ,IFNULL((select s.para_value from erp_sys_param s where s.para_code = 18),0) AS PSNLLOAN
				 ,IFNULL((select s.para_value from erp_sys_param s where s.para_code = 19),0) AS PATPAT
				 from user,branch , deparment
                 where `user`.`branchNumber` = `branch`.`branchNumber` AND 
                        `user`.deparmentNumber = `deparment`.deparmentNumber  AND 
                        `user`.userName='".$user."'";
		$result = mysqli_query($conn,$sql) or die (mysqli_error($conn));
		if($result){
			$row=mysqli_fetch_assoc($result);
	 		if($row){
				if(md5($pass)==$row['password']){
					if($row['userStat']=="A"){
						if($row['accountStat']=="A"){
						 	//$_SESSION['lockattamp'] = "";
                            
							$_SESSION['user']=$user;
							$_SESSION['usergroupNumber']= $row['usergroupNumber'];
							$_SESSION['userGroupEner']=$row['usergroupNumber'];
							$_SESSION['userID']= $row['userID'];
							$_SESSION['userBranch'] = $row['branchNumber'];
							$_SESSION['userDepartment'] = $row['deparmentNumber'];
							$_SESSION['userBranchName'] = $row['branchName'];
							$_SESSION['userEmail'] = $row['email'];
							$_SESSION['helpdeskadmin'] = $row['helpdeskadmin'];
							$_SESSION['helpdesk_close'] = $row['helpdesk_close'];
                            $_SESSION['GSMNO'] = $row['GSMNO'];
                            $_SESSION['deparmentName'] = $row['deparmentName'];
							$_SESSION['CDBZONE'] = $row['CDBZONE'];
							$_SESSION['ZONELENDRATE'] = $row['ZONELENDRATE'];
							$_SESSION['CDBWALR'] = $row['CDBWALR'];
							$_SESSION['PSNLLOAN'] = $row['PSNLLOAN'];
							$_SESSION['PATPAT'] = $row['PATPAT'];
							$IP = $_SERVER["REMOTE_ADDR"];
							
							if($row['CDBZONE'] == "PSNLLOAN")
								$_SESSION['CDBWALR'] = $row['PSNLLOAN'];
							else{
								if($row['CDBZONE'] == "PATPAT")
									$_SESSION['CDBWALR'] = $row['PATPAT'];									
							}
                            
                            $sql_unit_op = "SELECT `CDB_UNIT_BRANCHNUMBER` FROM `cdb_unit_op` WHERE `CDB_PARENT_BRANCHNUMBER` = '".$_SESSION['userBranch']."';";
                            //echo "<script> alert('".$sql_unit_op."'); </script>";
                            $query_unit_op = mysqli_query($conn,$sql_unit_op);
                            $rowcount = mysqli_num_rows($query_unit_op);
                            if($rowcount>=1){ /*PREV: $rowcount==1 --> $rowcount>=1 by Rizvi on 17-01-2018 to support multiple unit branches*/
                                //echo "<script> alert('A'); </script>";
                                while($resalt_unit_op =  mysqli_fetch_array($query_unit_op)){
                                    header('Location:cdb_unit_opIndex.php?PARENT_BRANCHNUMBER='.$_SESSION['userBranch'].'&UNIT_BRANCHNUMBER='.$resalt_unit_op[0]);
                                }
                            }else{
                               // echo "<script> alert('B'); </script>";
                                mysqli_query($conn,"UPDATE user SET ip='".$IP."', lastlog =now() , login_count = '0' WHERE userName = '".$user."'") or die(mysqli_error($conn));
    							//mysql_query("UPDATE user SET login_count = 0 WHERE username = '$user'");
                                 header('Location:pages/home.php');
                            }
                            
                            
						}else if($row['accountStat']=="L"){
							echo "<script> alert('Account stat is Locked!'); </script>";
						}else{
							header('Location:resetPasswordIndex.php?uName='.$user);
						}
					}else if($row['userStat']=="R"){
						echo "<script> alert('User stat is resain!'); </script>";
					}else if($row['userStat']=="T"){
						echo "<script> alert('User stat is Termineted!'); </script>";
					}else if($row['userStat']=="S"){
						echo "<script> alert('User stat is Saspented!'); </script>";
					}else{
						echo "<script> alert('User stat is not Active!'); </script>";
					}
				}else{
				    $log_c = 0;
					//$_SESSION['userprivias'] = $user;	
					//include('function_loging.php');
					//cakeuser();
					//echo cakeuser();
	 				//$_SESSION['lockattamp'] =  $_SESSION['lockattamp'] + 1;
                    $log_c = $row['login_count'] + 1;
                   // echo $log_c;
                    mysqli_query($conn,"UPDATE user SET login_count = '".$log_c."' WHERE userName = '".$user."'") or die(mysqli_error($conn)); 
                    
	     			//echo $_SESSION['lockattamp'];
   					//echo $row['userID'];
					//$_SESSION['userprivias'] = $user;
						//mysql_query("UPDATE user SET login_count = login_count + 1 WHERE userName = '$user'"); 
						//echo $user;
					echo "<script> alert('Incorrect Password!'); </script>";
						// Fetch login count... 
						//$resultlog = mysql_query("SELECT login_count FROM user WHERE userName = '$user'");
						//$resultUserID = mysql_query("SELECT userID FROM user WHERE userName = '$user'");
						//$aa = mysql_fetch_array($resultUserID);
						//$login_count = mysql_result($resultlog, 0); 
					if($log_c == 3){ 
						  // Sleep, die, redirect, or whatever here...
						echo "<script> alert('Account lock!'); </script>";
						mysqli_query($conn,"UPDATE user SET accountStat = 'L' WHERE username = '".$user."'");
						  //while ($row = mysql_fetch_array($resultUserID)) {
						mysqli_query($conn,"INSERT INTO `user_active`(`userName`,`userID`, `accountStat`) VALUES ('".$user."','".$row['userID']."','L')");
						 // }
						$IP=$_SERVER["REMOTE_ADDR"];
						$sqlUpInfo="UPDATE user_active SET ip='".$IP."', blockTimeDate = now() where userName='".$user."';";
						$result= mysqli_query($conn,$sqlUpInfo) or die(mysqli_error($conn));
						//$_SESSION['lockattamp'] = 0;
					}
				}
			}
		}else{
			echo "<script> alert('Invalid User Name!'); </script>";
		}	
   }
?>