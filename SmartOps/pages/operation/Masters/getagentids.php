<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param1=$_GET['param1']; 
if (strlen($param1) > 0) {
	$result1 = mysqli_query($conn,"SELECT `cat_code`, `cat_discr`, `car_state` FROM `cat_states` WHERE `cat_code` ='$param1'");
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow = mysqli_fetch_array($result1)) {
            $cat_code = $myrow["cat_code"];
            $cat_discr = $myrow["cat_discr"];
            $textout1 .= $cat_code . ", " . $cat_discr;
        }
    } else {
        $textout1 = " , , ," . $param1;
    }
}
echo $textout1;
?>