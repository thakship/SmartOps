<?php
    $V_book_id= $_POST['B_id'];
	echo $V_book_id;
	$V_userID = $_POST['u_id'];
	echo $V_userID;
    $V_userA = $_POST['a_id'];
	echo $V_userA;
    include('../../../php_con/includes/db.ini.php');
      mysqli_autocommit($conn,FALSE);
	try{
        date_default_timezone_set('Asia/Colombo');
            $sql_approed = "UPDATE `leisure_header` SET `print_by`='$V_userA',`print_on`= now() WHERE `bookingId` = '$V_book_id' AND  `userName`='$V_userID' AND `state` = 'A'";
            $quary_approed  = mysqli_query($conn,$sql_approed) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        // Commit transaction
        mysqli_commit($conn);
        //Send e>>mail
           
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
?>