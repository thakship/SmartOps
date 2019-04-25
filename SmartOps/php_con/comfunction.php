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
if(isset($_POST['getdonotshowid'])){
   // echo $_POST['getdonotshowid'];
    donotNews($_POST['getdonotshowid']);
}

function donotNews($getdonotshowid){
    $conn = dbConnection();
    $sql = "UPDATE `cdb_news` SET `newsStast` = 1 WHERE `newsId` = '".$getdonotshowid."';";
    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if($query){
        echo "OK";
    }else{
        echo "NOT";
    }
}


?>