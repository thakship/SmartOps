<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_POST['id']) && isset($_POST['value'])){
    //echo $_POST['id']."--".$_POST['value'];
    user_unblock(trim($_POST['id']),trim($_POST['value']));
}

function user_unblock($id,$value){
    $conn = DatabaseConnection();
    // Set autocommit to off
	mysqli_autocommit($conn,FALSE);
	try{
		date_default_timezone_set('Asia/Colombo');
		$add1="UPDATE user_active SET accountStat = 'A', unblockBy='".$value."', unblockDateTime = now() WHERE userName = '".$id."' AND accountStat = 'L';";
		$result= mysqli_query($conn,$add1) or die(mysqli_error($conn));
		$addsql1="UPDATE user SET accountStat = 'A' , login_count = '0' WHERE userName = '".$id."';";
		$quary1 = mysqli_query($conn,$addsql1) or die(mysqli_error($conn));
		if(!$quary1){
          mysqli_rollback($conn); 
		  echo "NOT";
		}else{
		  // Commit transaction
		  mysqli_commit($conn);
		  echo "YES";
		}
		
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
    
}
?>