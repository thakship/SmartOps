<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param=$_GET['param']; 
if (strlen($param) > 0) {
	$result = mysqli_query($conn,"SELECT `usergroupNumber`, `usergroupName` FROM usergroup WHERE `usergroupNumber` ='$param'");
    if (mysqli_num_rows($result) == 1) {
        while ($myrow = mysqli_fetch_array($result)) {
            $usergroupNumber = $myrow["usergroupNumber"];
            $usergroupName = $myrow["usergroupName"];
            $textout .= $usergroupNumber . ", " . $usergroupName;
        }
    } else {
        $textout = " , , ," . $param;
    }
}
echo $textout;

$param2=$_GET['param2']; 
if (strlen($param2) > 0){
	$result2 = mysqli_query($conn,"SELECT `moduleCode`, `moduleName`,`IconName` FROM module WHERE `moduleCode` ='$param2'");
    if (mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)) {
            $moduleCode = $myrow2["moduleCode"];
            $moduleName = $myrow2["moduleName"];
            $IconName = $myrow2["IconName"];
            $textout2 .= $moduleCode. ", " .$moduleName. ", ".$IconName;
        }
    } else {
        $textout2 = " , , , ," . $param2;
    }
}
echo $textout2;

$param3=$_GET['param3']; 
if (strlen($param3) > 0) {
	$result3 = mysqli_query($conn,"SELECT `pageCode`, `pageName`,`pagePath`,`pageType`,`moduleCode` FROM pages WHERE `pageCode` ='$param3'");
    if (mysqli_num_rows($result3) == 1) {
        while ($myrow3 = mysqli_fetch_array($result3)) {
            $pageCode = $myrow3["pageCode"];
            $pageName = $myrow3["pageName"];
			$pagePath = $myrow3["pagePath"];
			$pageType = $myrow3["pageType"];
			$moduleCode = $myrow3["moduleCode"];
            $textout3 .= $pageCode. ", " .$pageName.",".$pagePath.",".$pageType.",".$moduleCode;
        }
    } else {
        $textout3 = " , , , , ," . $param3;
    }
}
echo $textout3;

$param4=$_GET['param4']; 
if (strlen($param4) > 0) {
	$result4 = mysqli_query($conn,"SELECT `user`.`userName`, `user`.`userID`,`user`.`password`,`user`.`NIC`,`user`.`EPF`,`user`.`HRIS`,`user`.`email`,`user`.`usergroupNumber`,`user`.`branchNumber`, `branch`.`branchName`,`user`.`deparmentNumber`,`deparment`.`deparmentName`,`user`.`CDB_SAVINGS_ACCOUNT`,`user`.`GSMNO` , `user`.`userStat`
FROM `user`,`branch`,`deparment` 
WHERE `user`.`branchNumber`= `branch`.`branchNumber` AND `user`.`deparmentNumber` = `deparment`.`deparmentNumber`  AND `branch`.`branchNumber` = `deparment`.`branchNumber` AND `userName`='$param4'");
    if (mysqli_num_rows($result4) == 1) {
        while ($myrow4 = mysqli_fetch_array($result4)) {
            $userName = $myrow4["userName"];
            $userID = $myrow4["userID"];
			$password = $myrow4["password"];
			$NIC = $myrow4["NIC"];
			$EPF = $myrow4["EPF"];
			$HRIS = $myrow4["HRIS"];
			$email = $myrow4["email"];
			$usergroupNumber = $myrow4["usergroupNumber"];
			$branchNumber = $myrow4["branchNumber"];
			$branchName = $myrow4["branchName"];
			$deparmentNumber = $myrow4["deparmentNumber"];
			$deparmentName = $myrow4["deparmentName"];
            $CDB_SAVINGS_ACCOUNT = $myrow4["CDB_SAVINGS_ACCOUNT"];
            $GSMNO = $myrow4["GSMNO"];
            $userStat = $myrow4["userStat"];
            $textout4 .= $userName. ", " .$userID.",".$password.",".$NIC.",".$EPF.",".$HRIS.",".$email.",".$usergroupNumber.",".$branchNumber.",".$branchName.",".$deparmentNumber.",".$deparmentName.",".$CDB_SAVINGS_ACCOUNT.",".$GSMNO.",".$userStat;
        }
    } else {
        $textout4 = " , , , , , , , , , , , , , , , , , , ," . $param4;
    }
}
echo $textout4;

$param5=$_GET['param5']; 
if (strlen($param5) > 0) {
	$result5 = mysqli_query($conn,"SELECT `userName`,`userID`,`accountStat`,`userStat` FROM user WHERE `userName` ='$param5'");
    if (mysqli_num_rows($result5) == 1) {
        while ($myrow5 = mysqli_fetch_array($result5)) {
            $userName = $myrow5["userName"];
            $userID = $myrow5["userID"];
			$accountStat = $myrow5["accountStat"];
			$userStat = $myrow5["userStat"];
            $textout5 .= $userName. ", " .$userID.",".$accountStat.",".$userStat;
        }
    } else {
        $textout5 = " , , , , , , , " . $param5;
    }
}
echo $textout5;

$param6=$_GET['param6']; 
if (strlen($param6) > 0) {
	$result6 = mysqli_query($conn,"SELECT `userName`,`password`,`userID` FROM user WHERE `userName` ='$param6'");
    if (mysqli_num_rows($result6) == 1) {
        while ($myrow6 = mysqli_fetch_array($result6)) {
            $userName = $myrow6["userName"];
            $password = $myrow6["password"];
            $userID = $myrow6["userID"];
            $textout6 .= $userName. ", " .$password. ", ".$userID;
        }
    } else {
        $textout6 = " , , , , , , , " . $param6;
    }
}
echo $textout6;


?>