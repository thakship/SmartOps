<?php
$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
function auditupdate($conn,$auditrow,$table,$concat,$newContac){
		date_default_timezone_set('Asia/Colombo');
		$addsqlAud="INSERT INTO audittable(`auditNumber`,`auditDateTime`,`auditBy`,`tableName`,`authoriedBy`,`authoriedDateTime`,`oldData`,`newData`,`moduleCode`) VALUES('$auditrow',now(),'System' ,'$table', 'System', now(),'$concat','$newContac', 'Admin')";
		$quaryadu = mysqli_query($conn,$addsqlAud) or die(mysqli_error($conn));
		return;
}
// Set autocommit to off
mysqli_autocommit($conn,FALSE);
    try{
		$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
		$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
		$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
		date_default_timezone_set('Asia/Colombo');
		$selec = "SELECT `previousDate`,`currentDate` FROM `systemdate` WHERE `index`='1'";
		$select1 = mysqli_query($conn,$selec);
		while ($rec1 = mysqli_fetch_array($select1)){
            $id = $rec1[1] ;
			$concat = "$rec1[0]|$rec1[1]";  
		}
        $date1 = str_replace('-', '/', $id);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
	    echo $tomorrow;
        $newContac = "$id|$tomorrow";
		$addsq1="UPDATE `systemdate` SET `previousDate`='$id',`currentDate`='$tomorrow',`modifiedBy`='System',`modifiedDateTime`=now(),`authoriedby`='System',`authoriedDateTime`=now() WHERE `index`='1'";
		$query = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
		if(!$query){
			echo "<script> alert('Record not Updated!');</script>";
		}else{
			$table = "systemdate";
			auditupdate($conn,$auditrow,$table,$concat,$newContac);
			$files = glob('C:/uploadsCMSExcel/*'); // get all file names
			foreach($files as $file){ // iterate files
 				if(is_file($file))
    				unlink($file); // delete file
			}
			$files1 = glob('C:/wamp/www/CDB/temp/*'); // get all file names
			foreach($files1 as $file1){ // iterate files
 				if(is_file($file1))
    			unlink($file1); // delete file
			}
		}
	// Commit transaction
	mysqli_commit($conn);
}catch(Exception $e){
	// Rollback transaction
	mysqli_rollback($conn);
	echo 'Message: ' .$e->getMessage();
}
?>