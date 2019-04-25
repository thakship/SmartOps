<?php
    $V_book_id= $_POST['B_id'];
	echo $V_book_id;
	$V_userID = $_POST['u_id'];
	echo $V_userID;
    $V_userA = $_POST['a_id'];
	echo $V_userA;
    include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
    mysqli_autocommit($conn,FALSE);
	try{
        date_default_timezone_set('Asia/Colombo');
        $sql_select_header = "select leisure_header.bookingId,leisure_header.userName,leisure_header.fromDate, leisure_header.toDate,leisure_header.numOfRooms,leisure_header.numOfAduls,leisure_header.numOfChildren 
                                 from leisure_header 
                                 where leisure_header.state ='P' and leisure_header.bookingId = '$V_book_id'";
        $quary_select_header = mysqli_query($conn,$sql_select_header );
         while ($rec_select_header = mysqli_fetch_array($quary_select_header)){
            $sql_histrory = "INSERT INTO `leisure_history`(`bookingId`, `userName`, `fromDate`, `toDate`, `numOfRooms`, `numOfaduls`, `numOfChildren`, `state`, `enteredBy`, `enteredDataTime`, `authoriedBy`, `authoriedDateTime`) 
                         VALUES ('".$rec_select_header[0]."','".$rec_select_header[1]."','".$rec_select_header[2]."','".$rec_select_header[3]."','".$rec_select_header[4]."','".$rec_select_header[5]."','".$rec_select_header[6]."','A','','','".$V_userA."',now())";
            $quary_histrory  = mysqli_query($conn,$sql_histrory) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            $sql_approed = "UPDATE `leisure_header` SET `state`='A',`authoriedBy`='$V_userA',`authoriedDateTime`=now() WHERE `bookingId` = '$V_book_id'";
            $quary_approed  = mysqli_query($conn,$sql_approed) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
        }
        // Commit transaction
        mysqli_commit($conn);
        //Send e>>mail
           
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
                                 

?>