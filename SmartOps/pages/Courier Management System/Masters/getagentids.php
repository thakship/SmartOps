<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param=$_GET['param']; 
if(strlen($param) > 0){
	$result = mysqli_query($conn,"SELECT `serviceProviderNumber`, `serviceProviderName`,`serviceProviderAddress`,`serviceProviderAddress1`,`serviceProviderAddress2`,`serviceProviderAddress3`,`serviceProviderAddress4`,`serviceProviderTP`,`serviceProviderEmail`,`serviceProviderOfficer` FROM courier_service_provider WHERE `serviceProviderNumber` ='$param'");
    if (mysqli_num_rows($result) == 1) {
        while ($myrow = mysqli_fetch_array($result)) {
            $serviceProviderNumber = $myrow["serviceProviderNumber"];
            $serviceProviderName = $myrow["serviceProviderName"];
			$serviceProviderAddress = $myrow["serviceProviderAddress"];
			$serviceProviderAddress1 = $myrow["serviceProviderAddress1"];
			$serviceProviderAddress2 = $myrow["serviceProviderAddress2"];
			$serviceProviderAddress3 = $myrow["serviceProviderAddress3"];
			$serviceProviderAddress4 = $myrow["serviceProviderAddress4"];
            $serviceProviderTP = $myrow["serviceProviderTP"];
			$serviceProviderEmail = $myrow["serviceProviderEmail"];
			$serviceProviderOfficer = $myrow["serviceProviderOfficer"];
          $textout .= $serviceProviderNumber. ", ".$serviceProviderName.", ".$serviceProviderAddress.", ".$serviceProviderAddress1.", ".$serviceProviderAddress2.", ".$serviceProviderAddress3.", ".$serviceProviderAddress4.", ".$serviceProviderTP.", ".$serviceProviderEmail.",".$serviceProviderOfficer;
        }
    } else {
        $textout = " , , , , , , , , , , , , , , , , , , , , " . $param;
    }
}
echo $textout;


$param1=$_GET['param1']; 
if (strlen($param1) > 0) {
	$result1 = mysqli_query($conn,"SELECT `documentNumber`,`documentName` FROM courier_masters_document WHERE `documentNumber` ='$param1'");
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow1 = mysqli_fetch_array($result1)) {
            $documentNumber = $myrow1["documentNumber"];
            $documentName = $myrow1["documentName"];
          $textout1 .= $documentNumber. ", ".$documentName;
        }
    } else {
        $textout1 = " , , , , , , , , , , , , , " . $param1;
    }
}
echo $textout1;

$param2=$_GET['param2']; 
if (strlen($param2) > 0) {
	$result2 = mysqli_query($conn,"SELECT `groupCodeDoc`, `groupDetels` FROM `courier_groupdoctype` WHERE `groupCodeDoc` ='$param2'");
    if (mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)){
            $groupCodeDoc = $myrow2["groupCodeDoc"];
            $groupDetels = $myrow2["groupDetels"];
          $textout2 .= $groupCodeDoc. ", ".$groupDetels;
        }
    } else {
        $textout2 = " , , , , , , , , , , , , , " . $param2;
    }
}
echo $textout2;

$param3=$_GET['param3']; 
if (strlen($param3) > 0) {
	$result3 = mysqli_query($conn,"SELECT `user`.`userName`,`courier_systemadmin`.`adminID`,`courier_systemadmin`.`sysVersion`,`courier_systemadmin`.`SMTP`,`courier_systemadmin`.`port`,`courier_systemadmin`.`smsGate` 
FROM `courier_systemadmin`,`user` 
WHERE  `courier_systemadmin`.`adminID` = `user`.`userID` AND
`user`.`userName` ='$param3'");
    if (mysqli_num_rows($result3) == 1) {
        while ($myrow3 = mysqli_fetch_array($result3)){
			$userName = $myrow3["userName"];
            $adminID = $myrow3["adminID"];
            $gsysVersion = $myrow3["sysVersion"];
			$SMTP = $myrow3["SMTP"];
			$port = $myrow3["port"];
			$smsGate = $myrow3["smsGate"];
          $textout3 .= $userName. ", ".$adminID. ", ".$gsysVersion. ", ".$SMTP. ", ".$port. ", ".$smsGate;
        }
    } else {
        $textout3 = " , , , , , , , , , , , , , " . $param3;
    }
}
echo $textout3;

?>