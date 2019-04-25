 <?php
	if(isset($_POST['btnDone']) && $_POST['btnDone']=='Login'){	
		$user = trim($_POST['txtusername']);
		$pass = trim($_POST['txtpassword']);
		
		$sql="select `user`.`password`,`user`.`userStat`,`user`.`accountStat`, `user`.`usergroupNumber`,`user`.`userID`,`user`.`branchNumber`,`user`.`deparmentNumber` ,`user`.`email` ,`branch`.`branchName`,`user`.`helpdeskadmin` ,`user`.`helpdesk_close` , `user`.`GSMNO` from user,branch where `user`.`branchNumber` = `branch`.`branchNumber` AND userName='$user'";
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
							$IP=$_SERVER["REMOTE_ADDR"];
                            $_SESSION['userIP'] = $_SERVER["REMOTE_ADDR"];
							$sqlUpInfo="UPDATE user SET ip='".$IP."', lastlog =now() where userName='".$user."'";
							$result= mysqli_query($conn,$sqlUpInfo) or die(mysqli_error($conn));
							//mysql_query("UPDATE user SET login_count = 0 WHERE username = '$user'");
							header('Location:pages/homesub.php');
						}else if($row['accountStat']=="L"){
							echo "<script> alert('Account stat is Locked!'); </script>";
						}else{
							header('Location:resetPasswordIndexsub.php?uName='.$user);
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
					$_SESSION['userprivias'] = $user;	
					include('function_loging.php');
					cakeuser();
					//echo cakeuser();
	 				$_SESSION['lockattamp'] =  $_SESSION['lockattamp'] + 1;
	     			//echo $_SESSION['lockattamp'];
   					//echo $row['userID'];
					//$_SESSION['userprivias'] = $user;
						//mysql_query("UPDATE user SET login_count = login_count + 1 WHERE userName = '".$user."'"); 
						//echo $user;
                    if($row['accountStat']=="L"){
						echo "<script> alert('Account stat is Locked!'); </script>";
					}else{
					   echo "<script> alert('Incorrect Password!'); </script>";
						// Fetch login count... 
						//$resultlog = mysql_query("SELECT login_count FROM user WHERE userName = '$user'");
						//$resultUserID = mysql_query("SELECT userID FROM user WHERE userName = '$user'");
						//$aa = mysql_fetch_array($resultUserID);
						//$login_count = mysql_result($resultlog, 0); 
    					if($_SESSION['lockattamp'] >= 3){ 
    						  // Sleep, die, redirect, or whatever here...
    						echo "<script> alert('Account lock!'); </script>";
    						mysqli_query($conn,"UPDATE user SET accountStat = 'L' WHERE username = '".$user."'");
    						  //while ($row = mysql_fetch_array($resultUserID)) {
    						mysqli_query($conn,"INSERT INTO `user_active`(`userName`,`userID`, `accountStat`) VALUES ('".$user."','".$row['userID']."','L')");
    						 // }
    						$IP=$_SERVER["REMOTE_ADDR"];
    						$sqlUpInfo="UPDATE user_active SET ip='".$IP."', blockTimeDate = now() where userName='".$user."'";
    						$result= mysqli_query($conn,$sqlUpInfo) or die(mysqli_error($conn));
    						$_SESSION['lockattamp'] = 0;
    					}
					}
				
				}
			}
		}else{
			echo "<script> alert('Invalid User Name!'); </script>";
		}	
   }
   
?>