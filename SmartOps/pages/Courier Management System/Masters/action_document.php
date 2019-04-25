<?php

    $conn = mysqli_connect("localhost","root","1234","cdberp"); // DB Connection......................................
    
    if(isset($_REQUEST['getCodeDoc']) && isset($_REQUEST['get_txtb']) && isset($_REQUEST['get_txtc']) && isset($_REQUEST['get_con'])){
        echo $_REQUEST['getCodeDoc']."--".$_REQUEST['get_txtb']."--".$_REQUEST['get_txtc']."--".$_REQUEST['get_con'];
        $sql = "INSERT INTO `courier_groupdoc`(`groupCodeDoc`, `documentNumber`, `createDateTime`,`sOrder`)
                VALUES ('".$_REQUEST['getCodeDoc']."','".$_REQUEST['get_txtb']."',now(),'".$_REQUEST['get_con']."');";
       // echo $sql;
        $quary = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        
    }
  

?>