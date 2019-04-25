<?php
//define constant variables for server settings
//define("user","root");
//define("pass","");
//define("host","localhost");
//define("db","cdberptest");
//connect to DataBase
//$conn=mysql_connect(host,user,pass) or die (mysql_error());
//select DB
//mysql_select_db(db) or die (mysql_error());

$conn = mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>