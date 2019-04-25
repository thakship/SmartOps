<?php
//**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 //*************************** End Mysql Database Connection **************************************************************************

if(isset($_POST['get_userID']) && isset($_POST['get_oldPassword']) && isset($_POST['get_newPassword']) && isset($_POST['get_confirmPasssword']) && $_POST['get_userID'] != "" && $_POST['get_oldPassword'] != "" && $_POST['get_newPassword'] != "" && $_POST['get_confirmPasssword'] != ""){
      // echo $_POST['get_userID']."--".$_POST['get_oldPassword']."--".$_POST['get_newPassword']."--".$_POST['get_confirmPasssword'];
       // echo $_POST['txt_u_defiend']."--".$_POST['U_type'];
        is_Update_Password(trim($_POST['get_userID']),trim($_POST['get_oldPassword']),trim($_POST['get_newPassword']),trim($_POST['get_confirmPasssword']));
}else{
    echo "Missing some data.";
}

function is_Update_Password($get_userID,$get_oldPassword,$get_newPassword,$get_confirmPasssword){
    //echo "ok";
    $conn = DatabaseConnection();
    mysqli_autocommit($conn,FALSE);
    try{
         date_default_timezone_set('Asia/Colombo');
        $user_password = "SELECT `password` FROM `user` WHERE `userName` = '".$get_userID."';";
        $q_user_password = mysqli_query($conn,$user_password) or die (mysqli_error($conn));
        while($r_user_password = mysqli_fetch_array($q_user_password)){
            if(md5($get_newPassword) == $r_user_password[0]){
                 echo "2|Password is same.";
            }else if(md5($get_oldPassword) == $r_user_password[0]){
                $addsql1="UPDATE user SET password = MD5('".$get_newPassword."') WHERE userName = '".$get_userID."'";
                $query1 = mysqli_query($conn,$addsql1) or die (mysqli_error($conn));
                echo "1|Updated Success.";
            }else{
                echo "0|User password incorrect.";
            }
        }
        
        // Commit transaction
        mysqli_commit($conn);
    }catch(Exception $e){
        // Rollback transaction
        mysqli_rollback($conn);
        echo 'Message: ' .$e->getMessage();
    }
}
?>