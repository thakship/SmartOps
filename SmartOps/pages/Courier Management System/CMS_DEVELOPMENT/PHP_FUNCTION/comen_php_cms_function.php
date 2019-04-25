<?php
//.........................................Databse Connection .......................................................
    function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }
//****************************************************************
    if(isset($_POST['get_delete_fileNUmber'])){
        echo $_POST['get_delete_fileNUmber'];
        $conn = DatabaseConnection();
        mysqli_autocommit($conn,FALSE);
		try{
		 date_default_timezone_set('Asia/Colombo');
           	$addsq1= "DELETE FROM `courier_document_sub` WHERE `fileNumber` = '".$_POST['get_delete_fileNUmber']."'";
            $result1= mysqli_query($conn,$addsq1)  or die(mysqli_error());	
            $addsq2= "DELETE FROM `courier_document` WHERE `fileNumber` =  '".$_POST['get_delete_fileNUmber']."'";
            $result2= mysqli_query($conn,$addsq2)  or die(mysqli_error());
            $addsq3= "DELETE FROM `filemovement` WHERE `fileNumber` =  '".$_POST['get_delete_fileNUmber']."'";
            $result3= mysqli_query($conn,$addsq3)  or die(mysqli_error());
            $addsq4= "DELETE FROM `courier_files` WHERE `fileNumber` =  '".$_POST['get_delete_fileNUmber']."'";
            $result4= mysqli_query($conn,$addsq4)  or die(mysqli_error());
            echo $_POST['get_delete_fileNUmber']. " was Deteted.";	
			// Commit transaction
           mysqli_commit($conn);
		}catch(Exception $e){
			// Rollback transaction
			mysqli_rollback($conn);
			echo 'Message: ' .$e->getMessage();
		}

    }

?>