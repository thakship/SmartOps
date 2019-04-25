<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param1=$_GET['param1']; 
if (strlen($param1) > 0) {
	$result1 = mysqli_query($conn,"SELECT `TYPE_CODE`, `TYPE_DESC`, `NUM_OF_SIG` FROM `sps_let_types` WHERE `TYPE_CODE` ='$param1'");
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow1 = mysqli_fetch_array($result1)) {
            $TYPE_CODE = $myrow1["TYPE_CODE"];
            $TYPE_DESC = $myrow1["TYPE_DESC"];
            $NUM_OF_SIG = $myrow1["NUM_OF_SIG"];
            $textout1 .= $TYPE_CODE . ", " . $TYPE_DESC . ", " . $NUM_OF_SIG;
        }
    } else {
        $textout1 = " , , , , , ," . $param1;
    }
}
echo $textout1;

?>