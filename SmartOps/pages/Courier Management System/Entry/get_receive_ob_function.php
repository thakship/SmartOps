<?php
echo "OK";
echo $_POST['selBranchNumber'];
include('../../../php_con/includes/db.ini.php');
	mysqli_autocommit($conn,FALSE);
		try{
		  if(isset($_POST['txta'])){
		      echo $_POST['txta'];
			//echo "<br/>";
			if(!empty($_POST['cheRoot'])) {
				echo $_POST['cheRoot'];
				if($_POST['selBranchNumber'] != "" && $_POST['selDepartmentNumber'] != "" && $_POST['txtResiveOfficer'] != "" && $_POST['txtareSN'] !=""){
					if(isset($_POST['chka'])){
						for ($i = 1; $i<=$_POST['txta']; $i++){ 
							//echo trim($_POST['txtref'.$i]);
							//echo "<br/>"; 
							date_default_timezone_set('Asia/Colombo');
							$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE `stats` = 'AB' AND `fileNumber` = '".trim($_POST['txtref'.$i])."'";
							//echo $fileGet;
							//echo "<br/>";
							$sqlfileGet = mysqli_query($conn,$fileGet);
							$fielRow = mysqli_num_rows($sqlfileGet);
                            echo $fielRow."a";
							//echo $fielRowl;
							for($a = 1; $a <= $fielRow; $a++){
								while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
									FileMovementLogger($conn,$add_fileGet[0],'receive branch');
								}
							}
							$updateFile="UPDATE `courier_files` SET `stats` = 'BR', `receiveBranchNumber`='".$_POST['selBranchNumber']."', `receiveDepartmentNumber`='".$_SESSION['selectdepertment']."', `receiveOfficer`='".$_POST['txtResiveOfficer']."' WHERE `fileNumber` = '".trim($_POST['txtref'.$i])."' AND `stats` = 'AB'";
							//echo $updateFile;
							$sql_updateFile= mysqli_query($conn,$updateFile) or die(mysqli_error($conn));
							$rootper = "SELECT `branchNumber`,`departmentNumber`,`receiveBranchNumber`,`receiveDepartmentNumber` FROM `courier_files` WHERE `fileNumber`='".trim($_POST['txtref'.$i])."'";
							$sql_rootper = mysqli_query($conn,$rootper);
							while ($add_rootper = mysqli_fetch_array($sql_rootper)){
								$preRootGet = $add_rootper[0]."|".$add_rootper[1]."|".$add_rootper[2]."|".$add_rootper[3];
								$noeRootGet = $add_rootper[0]."|".$add_rootper[1]."|".$_POST['selBranchNumber']."|".$_POST['selDepartmentNumber'];
								date_default_timezone_set('Asia/Colombo');
								$inRoot = "INSERT INTO `courier_branch_root_chenge`(`fileNumber`, `preRoot`, `nowRoot`,`remark`,`modifedBy`, `modifedDateTime`) VALUES ('".trim($_POST['txtref'.$i])."','".$preRootGet."','".$noeRootGet."','".$_POST['txtareSN']."','".$_SESSION['user']."',now())";
								$sql_inroot= mysqli_query($conn,$inRoot) or die(mysqli_error($conn));
							}
						}
					}else{
						
					}
					echo "<script> alert('Record Update!'); </script>";
                    echo "<script>pageRef();</script>";
				}else{
					echo "<script> alert('Fill Required root chenges!'); </script>";
				}
			}else{
				if(isset($_POST['chka'])){
					for ($i = 1; $i<=$_POST['txta']; $i++){ 
						//echo trim($_POST['txtref'.$i]);
						//echo "<br/>"; 
						date_default_timezone_set('Asia/Colombo');
						$fileGet = "SELECT `fileNumber` FROM `courier_files` WHERE `stats` = 'AB' AND `fileNumber` = '".trim($_POST['txtref'.$i])."'";
						//echo $fileGet;
						//echo "<br/>";
						$sqlfileGet = mysqli_query($conn,$fileGet);
						$fielRow = mysqli_num_rows($sqlfileGet);
						echo $fielRow;
						for($a = 1; $a <= $fielRow; $a++){
							while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
								FileMovementLogger($conn,$add_fileGet[0],'Admin re-assign other branch file');
							}
						}
						$updateFile="UPDATE `courier_files` SET `stats` = 'OB' WHERE `fileNumber` = '".trim($_POST['txtref'.$i])."' AND `stats` = 'AB'";
						//echo $updateFile;
						$sql_updateFile= mysqli_query($conn,$updateFile) or die(mysqli_error($conn));
					}
				}else{
					
				}
				echo "<script> alert('Record Update!'); </script>";
                echo "<script>pageRef();</script>";
			}
			// Commit transaction
			mysqli_commit($conn);
		  }else{
		      echo "Error";
		  }
			
		}catch(Exception $e){
			// Rollback transaction
			mysqli_rollback($conn);
			echo 'Message: ' .$e->getMessage();
		}


?>