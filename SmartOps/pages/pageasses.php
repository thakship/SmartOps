<?php
if (!isset($_SESSION['usergroupNumber'])){
  $_SESSION['usergroupNumber'] = "";
}
/*if (isset($_REQUEST['user'])){
  $_SESSION['user'] = $_REQUEST['user'];
}*/
$as = $_SESSION['usergroupNumber'];
function cakepageaccess()
{
$conn = mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn))
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	$add="SELECT count(*) AS num FROM `usergroup_module_page` 
			WHERE `usergroupNumber`='$_SESSION[usergroupNumber]' AND 
			`pageCode`='$_SESSION[page]';";
	$quary = mysqli_query($conn,$add);
	$row = mysqli_fetch_assoc($quary);
	$numUsers = $row['num'];
	//echo $_SESSION[usergroupNumber];
	return $numUsers;
	//return 1;
}
?>