<?php		
	$boxNumber = $_REQUEST['txt1'];	
	$user = $_REQUEST['txt2'];	
	include('../../../php_con/includes/db.ini.php');
	date_default_timezone_set('Asia/Colombo');	
	$addsq1="INSERT INTO `dl_printlog`(`BoxNo`, `PrintedOn`, `PrintedBy`) VALUES ('".$boxNumber."',now(),'".$user."')";
	$query1 = mysqli_query($conn,$addsq1) or die(mysql_error($conn));
	if($query1){
		echo "OK";
	}else{
		echo "NULL";
	}
						
?>