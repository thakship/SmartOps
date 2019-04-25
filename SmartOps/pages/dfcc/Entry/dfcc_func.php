<?php 

function dbConnection() {
    $con = mysqli_connect('localhost','root','1234','cdberp') or die('Could not connect to MySQL: ' . mysqli_error());
    return $con ;
}

?>