<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Usage
Purpose			: serching Branchers Sending and receive banch
Author			: Madushan Wikramaarachchi
Date & Time		: 02.00 P.M 2014/06/05
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/r/008";
	$_SESSION['Module'] = "Courier Management System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Courier Usage</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
#tblGen{
	height:300px;
	border: #000000 solid 1px;
	overflow-y: scroll;
	width:620px;
}
</style>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<?php
	//$sql_Select="SELECT  MIS.BRANCH_CODE, MIS.BRANCH_NAME, DATE(MIS.LAST_SEND_DATE), DATE(MIS.LAST_RCVD_DATE), DATEDIFF(DATE(now()), DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE FROM (SELECT `branchNumber` AS BRANCH_CODE,`branchName` AS BRANCH_NAME,(SELECT MAX(`sendDateTime`) FROM `courier_branch` WHERE `courier_branch`.`branchNumber` =`branch`.`branchNumber`) AS LAST_SEND_DATE, (SELECT MAX(`courier_files`.`receiveDateTime`) FROM `courier_files` WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND `courier_files`.`receiveDateTime` <> '0000-00-00 00:00:00') AS LAST_RCVD_DATE FROM `branch`) MIS";
/*	$sql_Select = "SELECT 
			MIS.BRANCH_CODE, 
			MIS.BRANCH_NAME, 
			DATE(MIS.LAST_SEND_DATE) AS STDATE, 
			DATE(MIS.LAST_RCVD_DATE) AS RSDATE, 
			DATEDIFF(DATE(now()),
			DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE 
FROM (SELECT `branchNumber` AS BRANCH_CODE,
							`branchName` AS BRANCH_NAME,
							(SELECT MAX(`sendDateTime`) 
								FROM `courier_files` 
								WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber`) AS LAST_SEND_DATE,
							(SELECT MAX(`courier_files`.`receiveDateTime`) 
							FROM `courier_files` 
							WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND 
										`courier_files`.`receiveDateTime` <> '0000-00-00 00:00:00') AS LAST_RCVD_DATE 
				FROM `branch`,(SELECT @rownum := 0) r)  MIS;";*/
    $sql_Select = "SELECT 
			MIS.BRANCH_CODE, 
			MIS.BRANCH_NAME, 
			DATE(MIS.LAST_SEND_DATE) AS STDATE, 
			DATE(MIS.LAST_RCVD_DATE) AS RSDATE, 
			DATEDIFF(DATE(now()),
			DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE 
            FROM (SELECT `branchNumber` AS BRANCH_CODE,
            							`branchName` AS BRANCH_NAME,
            							(SELECT MAX(`sendDateTime`) 
            								FROM `courier_files` 
            								WHERE `courier_files`.`branchNumber` = `branch`.`branchNumber` AND
                                                  `courier_files`.`sendDateTime` <> '0000-00-00 00:00:00') AS LAST_SEND_DATE,
            							(SELECT MAX(`courier_files`.`receiveDateTime`) 
            							FROM `courier_files` 
            							WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND
            							      (`courier_files`.stats = 'PDR' OR `courier_files`.stats = 'FDR')) AS LAST_RCVD_DATE 
            FROM `branch`,(SELECT @rownum := 0) r)  MIS;";
    $quary_Select = mysqli_query($conn,$sql_Select);
?>
<input type="submit" style="background-image: url(../../../img/pdf.png);background-repeat: no-repeat; width:30px; height:30px; border: #000000 solid 1px;" value="" name="getPDF" id="getPDF"/>
<hr/>
<div id="tblGen">
<table border="1" id="myTable"  style="width:600px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px;">Index</td>
        <td style="width:100px;">Branch Number</td>
        <td style="width:150px;">Branch Name</td>
        <td style="width:100px;">Last Send Date</td>
        <td style="width:100px;">Last Receive Date</td>
        <td style="width:100px;">Action Num of Date</td>
    </tr>
<?php
	$index = 1;
	while ($rec_Select = mysqli_fetch_array($quary_Select)){
		if($index%2 == 0){
			$col = "#FFFFFF";
		}else{
			$col = "#F0F0F0";
		} 
?>
	<tr class="tbl1">
        <td style="width:50px; background-color:<?php echo $col;?>; text-align:right; padding-right:5px;"><?php echo $index; ?></td>
        <td style="width:100px; background-color:<?php echo $col;?>; text-align:right;padding-right:5px;"><?php echo $rec_Select[0]; ?></td>
        <td style="width:150px; background-color:<?php echo $col;?>; text-align:left; padding-left:5px;"><?php echo $rec_Select[1]; ?></td>
        <td style="width:100px; background-color:<?php echo $col;?>;"><?php echo $rec_Select[2]; ?></td>
        <td style="width:100px; background-color:<?php echo $col;?>;"><?php echo $rec_Select[3]; ?></td>
        <td style="width:100px; background-color:<?php echo $col;?>; text-align:right;padding-right:5px;"><?php echo $rec_Select[4]; ?></td>
    </tr>	
<?php
		$index++; 
	}
?>
</table>
</div>
<br/>

<?php
if(isset($_POST['getPDF'])){
	$title = "Courier Usage";//report name
	$d1 = "  ";//Other information
	$tableget = "rank,15,Rank|BRANCH_CODE,30,Branch Number|BRANCH_NAME,60,Branch Name|STDATE,40,Last Send Date|RSDATE,40,Last Receive Date|MAXDATE,50,Action Num of Date";//must want to table

	//$sql = "SELECT @rownum := @rownum %PLUS% 1 AS rank, MIS.BRANCH_CODE, MIS.BRANCH_NAME, DATE(MIS.LAST_SEND_DATE) AS STDATE, DATE(MIS.LAST_RCVD_DATE) AS RSDATE, DATEDIFF(DATE(now()),DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE FROM (SELECT `branchNumber` AS BRANCH_CODE,`branchName` AS BRANCH_NAME,(SELECT MAX(`sendDateTime`) FROM `courier_branch` WHERE `courier_branch`.`branchNumber` =`branch`.`branchNumber`) AS LAST_SEND_DATE,(SELECT MAX(`courier_files`.`receiveDateTime`) FROM `courier_files` WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND `courier_files`.`receiveDateTime` <> '0000-00-00 00:00:00') AS LAST_RCVD_DATE FROM `branch`,(SELECT @rownum := 0) r)  MIS";
    //$sql= "SELECT @rownum := @rownum %PLUS% 1 AS rank,MIS.BRANCH_CODE, MIS.BRANCH_NAME, DATE(MIS.LAST_SEND_DATE) AS STDATE, DATE(MIS.LAST_RCVD_DATE) AS RSDATE, DATEDIFF(DATE(now()),DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE FROM (SELECT `branchNumber` AS BRANCH_CODE,`branchName` AS BRANCH_NAME,(SELECT MAX(`sendDateTime`) FROM `courier_files` WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber`) AS LAST_SEND_DATE,(SELECT MAX(`courier_files`.`receiveDateTime`) FROM `courier_files` WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND `courier_files`.`receiveDateTime` <> '0000-00-00 00:00:00') AS LAST_RCVD_DATE FROM `branch`,(SELECT @rownum := 0) r)  MIS";
    $sql= "SELECT @rownum := @rownum %PLUS% 1 AS rank,MIS.BRANCH_CODE, MIS.BRANCH_NAME, DATE(MIS.LAST_SEND_DATE) AS STDATE, DATE(MIS.LAST_RCVD_DATE) AS RSDATE, DATEDIFF(DATE(now()),DATE(GREATEST(MIS.LAST_SEND_DATE,MIS.LAST_RCVD_DATE))) AS MAXDATE FROM (SELECT `branchNumber` AS BRANCH_CODE,`branchName` AS BRANCH_NAME,(SELECT MAX(`sendDateTime`) FROM `courier_files` WHERE `courier_files`.`branchNumber` = `branch`.`branchNumber` AND `courier_files`.`sendDateTime` <> '0000-00-00 00:00:00') AS LAST_SEND_DATE,(SELECT MAX(`courier_files`.`receiveDateTime`) FROM `courier_files` WHERE `courier_files`.`receiveBranchNumber` = `branch`.`branchNumber` AND (`courier_files`.stats = 'PDR' OR `courier_files`.stats = 'FDR')) AS LAST_RCVD_DATE FROM `branch`,(SELECT @rownum := 0) r)  MIS;";
	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}
?>
</form>
</body>
</html>