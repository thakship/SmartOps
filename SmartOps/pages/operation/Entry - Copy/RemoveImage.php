<?php
	$id= $_POST['id'];
	//echo $id;
    $conn=mysqli_connect("localhost","root","1234","cdberp");
    // Check connection
    if (mysqli_connect_errno($conn))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
	// Set autocommit to off
	mysqli_autocommit($conn,FALSE);
	try{
		//$txtUserName= $_SESSION['userName'.$a];
		date_default_timezone_set('Asia/Colombo');
		$sqlUpInfo="UPDATE `pending_upload_file` SET `flag` = 5,`removedon` = now() WHERE `up_index` = ".$id;
		$result1= mysqli_query($conn,$sqlUpInfo) or die(mysqli_error($conn));
	    if(!$result1){
			echo "Error";
		}else{
			echo "Image removed";	
		}
		// Commit transaction
		mysqli_commit($conn);
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}	
   
?>