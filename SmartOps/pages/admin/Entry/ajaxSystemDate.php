<?php
	$id= $_POST['id'];
	$un= $_POST['un'];
	$_SESSION['user'] = $un;
	$_SESSION['Module'] = "Admin";
	//echo $id;
	//echo $un;
		include('../../../php_con/includes/db.ini.php');
        include('../../../php_con/includes/Common.php');
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					//$_SESSION['txtCD'] = $id;
					$date1 = str_replace('-', '/', $id);
					$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
					//echo $_SESSION['txtCD'];
					//echo $tomorrow;
						$newContac = "$id|$tomorrow";
						$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
						$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
						$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
						date_default_timezone_set('Asia/Colombo');
						$selec = "SELECT `previousDate`,`currentDate` FROM `systemdate` WHERE `index`='1'";
						$select1 = mysqli_query($conn,$selec);
						while ($rec1 = mysqli_fetch_array($select1)){
							$concat = "$rec1[0]|$rec1[1]";
						}
						$addsq1="UPDATE `systemdate` SET `previousDate`='$id',`currentDate`='$tomorrow',`modifiedBy`='$un',`modifiedDateTime`=now(),`authoriedby`='$un',`authoriedDateTime`=now() WHERE `index`='1'";
						$query = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$query){
							echo "<script> alert('Record not Updated!');</script>";
						}else{
							$table = "systemdate";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
						}
					// Commit transaction
					mysqli_commit($conn);
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
?>