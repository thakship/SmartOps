<?php
function dbConnection(){
   $conn = mysqli_connect("localhost","root","1234","cdberp");
    // Check connection
    if (mysqli_connect_errno($conn)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
        return $conn;
    }
 
}

if(isset($_POST['gettxtUserID']) && isset($_POST['gettxtGSM']) && isset($_POST['gettxtNIC'])){
   //echo  $_POST['gettxtUserID']." -- ".$_POST['gettxtGSM']." -- ".$_POST['gettxtNIC'];
   passwordReset(trim($_POST['gettxtUserID']),trim($_POST['gettxtGSM']),trim($_POST['gettxtNIC']));
}

function passwordReset($gettxtUserID,$gettxtGSM,$gettxtNIC){
    $conn =  dbConnection();
    date_default_timezone_set('Asia/Colombo');
   	mysqli_autocommit($conn,FALSE);
	try{
	   $sql_select = "SELECT `NIC`,`GSMNO`,`userName`,`userID` 
                        FROM `user` 
                       WHERE `userName`='".$gettxtUserID."' AND `userStat` = 'A' AND `accountStat` = 'L';";
       //echo $sql_select;
       $query_select = mysqli_query($conn,$sql_select) or die(mysqli_error($conn));
        $rowcount = mysqli_num_rows($query_select);
        if($rowcount != 0){
            while($rec_select = mysqli_fetch_array($query_select)){
                if($gettxtGSM != $rec_select[1]){
                    echo "Your Telephone Number is Invalid.";
                }else if($gettxtNIC != $rec_select[0]){
                    echo "Your NIC is Invalid.";
                }else{
                     $number = rand();
                     $str = "Your Password : ".$number;
                     
               	     $addL="UPDATE user_active SET accountStat = 'A', unblockBy='".$gettxtUserID."', unblockDateTime = now() WHERE userName = '".$gettxtUserID."' AND accountStat = 'L';";
                	 $resultL= mysqli_query($conn,$addL) or die(mysqli_error($conn));
                	 $addsqlL="UPDATE user SET accountStat = 'A' , login_count = '0' WHERE userName = '".$gettxtUserID."';";
              		 $quaryL = mysqli_query($conn,$addsqlL) or die(mysqli_error($conn));
                     
                     
                     $addsql2="INSERT INTO `user_password_handling`(`userName`,`userID`,`restBy`,`restDateTime`,`password`,`chanel`)VALUES ('".$rec_select[2]."','".$rec_select[3]."','".$gettxtUserID. "',now(),MD5('".$number."'),'WEB')";
	                 $query2 = mysqli_query($conn,$addsql2);
                               
                     $addsql1="UPDATE user SET password = MD5('".$number."') , `accountStat` = 'N' WHERE userName = '".$gettxtUserID."'";
                      $query1 = mysqli_query($conn,$addsql1) or die (mysqli_error($conn));
                      
                     $SQL_IN = "INSERT INTO `cdb_sms_inbox`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) VALUES ('".$gettxtGSM."','".$str."',now(),'admin','PASSWORDRESET',0);";
                     $queryhuihi = mysqli_query($conn,$SQL_IN) or die (mysqli_error($conn));
                     mysqli_commit($conn);
                     echo "Password will be sent to registered phone nmumber.";
                     //header('Location:index.php');
                }
            }
        }else{
            echo "Invalid User ID or Account is Not Lock.";
        }
       
	  
	}catch(Exception $e){
		// Rollback transaction
		mysqli_rollback($conn);
		echo 'Message: ' .$e->getMessage();
	}
}
?>