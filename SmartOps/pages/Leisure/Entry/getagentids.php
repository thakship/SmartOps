<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param1=$_GET['param1'];
if(strlen($param1) > 0){
    $sql_date = "SELECT `systemdate`.`currentDate` FROM `systemdate`";
    $q_date = mysqli_query($conn,$sql_date);
    while ($r_date = mysqli_fetch_array($q_date)) {
        $dateGet = $r_date[0];
    }
	$result1 = mysqli_query($conn,"select bookingId,userName,fromDate,toDate,numOfRooms,numOfAduls,numOfChildren from leisure_header where state ='A' AND fromDate > '$dateGet' AND bookingId ='$param1'");
    
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow1 = mysqli_fetch_array($result1)) {
            $bookingId = $myrow1["bookingId"];
            $userName = $myrow1["userName"];
			$fromDate = $myrow1["fromDate"];
			$toDate = $myrow1["toDate"];
			$numOfRooms = $myrow1["numOfRooms"];
			$numOfAduls = $myrow1["numOfAduls"];
			$numOfChildren = $myrow1["numOfChildren"];
          $textout1 .= $bookingId. ", ".$userName.", ".$fromDate.", ".$toDate.", ".$numOfRooms.", ".$numOfAduls.", ".$numOfChildren;
        }
    } else {
        $textout1 = " , , , , , , , , , , " . $param1;
    }
}
echo $textout1;

$param2=$_GET['param2'];
$param3=$_GET['param3'];
if(strlen($param2) > 0 && strlen($param3) > 0){
    $sql_date = "SELECT `systemdate`.`currentDate` FROM `systemdate`";
    $q_date = mysqli_query($conn,$sql_date);
    while ($r_date = mysqli_fetch_array($q_date)) {
        $dateGet = $r_date[0];
    }
	$result2 = mysqli_query($conn,"select bookingId,userName,fromDate,toDate,numOfRooms,numOfAduls,numOfChildren from leisure_header where state ='A' AND fromDate > '$dateGet' AND bookingId ='$param2' AND `userName` = '$param3'");
    
    if (mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)) {
            $bookingId = $myrow2["bookingId"];
            $userName = $myrow2["userName"];
			$fromDate = $myrow2["fromDate"];
			$toDate = $myrow2["toDate"];
			$numOfRooms = $myrow2["numOfRooms"];
			$numOfAduls = $myrow2["numOfAduls"];
			$numOfChildren = $myrow2["numOfChildren"];
          $textout2 .= $bookingId. ", ".$userName.", ".$fromDate.", ".$toDate.", ".$numOfRooms.", ".$numOfAduls.", ".$numOfChildren;
        }
    } else {
        $textout2 = " , , , , , , , , , , " . $param2;
    }
}
echo $textout2;

?>
