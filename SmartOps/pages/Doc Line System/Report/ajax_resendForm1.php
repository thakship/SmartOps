<?php
	$valNum = $_REQUEST['txt2'];
	include('../../../php_con/includes/db.ini.php');
	$sql_upadate = "UPDATE `batchlog` SET `catchStat`='1' WHERE `serial_number`='$valNum'";
	$query_upadate= mysqli_query($conn,$sql_upadate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
	if($query_upadate){
	 	echo "OK";
	}else{
		echo "NULL";
	}
?>