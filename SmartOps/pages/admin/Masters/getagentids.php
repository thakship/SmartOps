<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param=$_GET['param']; 
if (strlen($param) > 0) {
	$result = mysqli_query($conn,"SELECT `branchNumber`, `branchName`,`branchTP`,`branchAddress`,`branchAddress1`,`branchAddress2`,`branchAddress3`,`branchAddress4`,`branchEmail` FROM branch WHERE `branchNumber` ='$param'");
    if (mysqli_num_rows($result) == 1) {
        while ($myrow = mysqli_fetch_array($result)) {
            $branchNumber = $myrow["branchNumber"];
            $branchName = $myrow["branchName"];
			$branchTP = $myrow["branchTP"];
            $branchAddress = $myrow["branchAddress"];
			$branchAddress1 = $myrow["branchAddress1"];
			$branchAddress2 = $myrow["branchAddress2"];
			$branchAddress3 = $myrow["branchAddress3"];
			$branchAddress4 = $myrow["branchAddress4"];
			$branchEmail = $myrow["branchEmail"];
            
            $textout .= $branchNumber.", ".$branchName.", ".$branchTP.", ".$branchAddress.", ".$branchAddress1.", ".$branchAddress2.", ".$branchAddress3.", ".$branchAddress4.", ".$branchEmail;
        }
    } else {
        $textout = " , , , , , , , , , , , , , , , , , , , , , , " . $param;
    }
}
echo $textout;

$param2 =$_GET['param2']; 
if (strlen($param2) > 0) {
	$result2 = mysqli_query($conn,"SELECT `deparment`.`deparmentNumber`, `deparment`.`deparmentName`, `deparment`.`branchNumber`,`branch`.`branchName`,`deparment`.`deparmentTP`,`deparment`.`deparmentAddress`,`deparment`.`deparmentAddress1`,`deparment`.`deparmentAddress2`,`deparment`.`deparmentAddress3`,`deparment`.`deparmentAddress4`,`deparment`.`deparmentEmail` 
FROM `deparment`,`branch` 
WHERE `deparment`.`branchNumber`=`branch`.`branchNumber` AND `deparment`.`deparmentNumber` ='$param2'");
    if (mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)) {
            $deparmentNumber = $myrow2["deparmentNumber"];
            $deparmentName = $myrow2["deparmentName"];
			$branchNumber = $myrow2["branchNumber"];
			$branchName = $myrow2["branchName"];
			//$usergroupNumber = $myrow4["usergroupNumber"];
            $deparmentTP = $myrow2["deparmentTP"];
			$deparmentAddress = $myrow2["deparmentAddress"];
			$deparmentAddress1 = $myrow2["deparmentAddress1"];
			$deparmentAddress2 = $myrow2["deparmentAddress2"];
			$deparmentAddress3 = $myrow2["deparmentAddress3"];
			$deparmentAddress4 = $myrow2["deparmentAddress4"];
			$deparmentEmail = $myrow2["deparmentEmail"];
            
            $textout2 .= $deparmentNumber.", ".$deparmentName.", ".$branchNumber.", ".$branchName.", ".$deparmentTP.", ".$deparmentAddress.", ".$deparmentAddress1.", ".$deparmentAddress2.", ".$deparmentAddress3.", ".$deparmentAddress4.", ".$deparmentEmail;
        }
    } else {
        $textout2 = " , , , , , , , , , , , , , , , , , , , " . $param2;
    }
}
echo $textout2;

?>