<?php
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
//****************************************************************
 if(isset($_POST['get_fname']) && isset($_POST['get_selFileType']) && isset($_POST['get_selBranchNumber']) && isset($_POST['get_selDepartmentNumber']) && isset($_POST['get_txtResiveOfficer']) && isset($_POST['get_txtareSN']) && isset($_POST['get_txtPreFNum']) && isset($_POST['get_txtrow']) && isset($_POST['get_txtUser']) && isset($_POST['get_txtubranch']) && isset($_POST['get_txtuDepartment']) && isset($_POST['get_txtb1_doc']) && isset($_POST['get_txtc1_doc'])){
        //echo $_POST['get_fname']."--".$_POST['get_selFileType']."--".$_POST['get_selBranchNumber']."--".$_POST['get_selDepartmentNumber']."--".$_POST['get_txtResiveOfficer']."--".$_POST['get_txtareSN']."--".$_POST['get_txtPreFNum']."--".$_POST['get_txtrow']."--".$_POST['get_txtUser']."--".$_POST['get_txtubranch']."--".$_POST['get_txtuDepartment']."--".$_POST['get_txtc1_doc'];
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
			try{
               $file_name = $_POST['get_fname'];
               //echo $_POST['selBranchNumber']."--".$_POST['selDepartmentNumber']."--".$_POST['selFileType'];
			   date_default_timezone_set('Asia/Colombo');
			   $statCount1 ="SELECT `count` ,`year` FROM `filesnumbergenaret` where `branch`='".$_POST['get_txtubranch']."' AND `serial`='file' AND`department`='".$_POST['get_txtuDepartment']."' AND `year` = year(now())";
					$sql_statCount1=mysqli_query($conn,$statCount1);
					while($add_statCount1=mysqli_fetch_array($sql_statCount1)){
						if($add_statCount1[0]==0){
						 	$fileNumber = $_POST['get_txtubranch'].$_POST['get_txtuDepartment'].$add_statCount1[1]."000001";
							$cou = $add_statCount1[0] + 1;
						}else{
						 	$fileNumber = $_POST['get_txtubranch'].$_POST['get_txtuDepartment'].$add_statCount1[1].str_pad(($add_statCount1[0]+1),6,0,STR_PAD_LEFT);
							$cou = $add_statCount1[0] + 1;
						}
					}
                    if($fileNumber != ""){
                        $addsq1="INSERT INTO courier_files(`fileNumber`,`fileName`,`currentowner`,`receiveOfficer`, `receiveDepartmentNumber`,`receiveBranchNumber`,`stats`, `numberOfDocument`, `fileType`,`branchNumber`,`departmentNumber`,`remarks`,`createBy`,`createDateTime`,`preFileNumber`, `subdoc`) 
                                                    VALUES('".$fileNumber."','".$file_name."','".$_POST['get_txtUser']."' ,'".$_POST['get_txtResiveOfficer']."','".$_POST['get_selDepartmentNumber']."',  '".$_POST['get_selBranchNumber']."' ,'JC','".$_POST['get_txtrow']."','".$_POST['get_selFileType']."','".$_POST['get_txtubranch']."','".$_POST['get_txtuDepartment']."','".$_POST['get_txtareSN']."','".$_POST['get_txtUser']."',now(),'".$_POST['get_txtPreFNum']."','YES')";
                        //echo $addsq1."<br/>";
                        $query1 = mysqli_query($conn,$addsq1) or die(mysqli_error());
                        $addsq2= "INSERT INTO courier_document(`documentNumber`,`documentName`,`fileNumber`,`createDateTime`,`isAvailable`,`receiveAvailable`)
                                                            VALUES('".$_POST['get_txtb1_doc']."','".$_POST['get_txtc1_doc']."','".$fileNumber."',now(),'YES','YES')";
                        //echo $addsq2."<br/>";
                        $result2= mysqli_query($conn,$addsq2)  or die(mysqli_error());
                       	$statUpdate ="SELECT `serial` FROM filesNumberGenaret  where `branch`='".$_POST['get_txtubranch']."' AND `department`='".$_POST['get_txtuDepartment']."' AND `year` = year(now())";
    					$sql_statUpdate=mysqli_query($conn,$statUpdate);
                        
    					while($add_statUpdate=mysqli_fetch_array($sql_statUpdate)){
    						$fileCount ="UPDATE `filesnumbergenaret`  SET `count`= '".$cou."'  WHERE `branch`= '".$_POST['get_txtubranch']."' AND `department`='".$_POST['get_txtuDepartment']."' AND `year` = year(now()) AND `serial`='".$add_statUpdate[0]."'";
    						$updateFileCount = mysqli_query($conn,$fileCount) or die(mysqli_error());
    					}
	                    $fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$fileNumber."',now(),'File Created','".$_POST['get_txtUser']."')";
                        $sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
                        echo $fileNumber;
                    }else{
                        echo "<script> alert('Missing file Number!');</script>";
                    }					
				// Commit transaction
               mysqli_commit($conn);
			}catch(Exception $e){
				// Rollback transaction
				mysqli_rollback($conn);
				echo 'Message: ' .$e->getMessage();
			}
 }
 

if(isset($_REQUEST['get_fnumber']) && isset($_REQUEST['get_txtb']) && isset($_REQUEST['get_txtc']) && isset($_REQUEST['get_txtb1_sub_doc'])){
    //echo   $_REQUEST['get_fnumber'].$_REQUEST['get_txtb'].$_REQUEST['get_txtc'].$_REQUEST['get_txtb1_sub_doc'];
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
	try{
	 date_default_timezone_set('Asia/Colombo');
       	$addsq3= "INSERT INTO `courier_document_sub`(`subDocumentNumber`, `subDocumentName`, `documentNumber`, `fileNumber`, `createDateTime`, `isAvailable`, `receiveAvailable`) 
                                            VALUES ('".trim($_REQUEST['get_txtb'])."','".trim($_REQUEST['get_txtc'])."','".trim($_REQUEST['get_txtb1_sub_doc'])."','".$_REQUEST['get_fnumber']."',now(),'YES','YES')";
		$result3= mysqli_query($conn,$addsq3) or die(mysqli_error($conn));	
        echo $addsq3;	
		// Commit transaction
       mysqli_commit($conn);
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}

?>