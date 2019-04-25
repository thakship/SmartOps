<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Receive Sub Bag
Purpose			: To Receive courierdepartment vise
Author			: Madushan Wikramaarachchi
Date & Time		: 03.05 P.M 21/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/006";
	$_SESSION['Module'] = "Courier Management System";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
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
<title>Receive Sub Bag</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<script type="text/javascript">
    function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_receive_department.php?DispName=Receive%20Sub%20Bag','conectpage');
    }
</script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:700px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
</style>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" novalidate>
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr />
<?php
	$selFile="SELECT distinct `branchNumber`,`departmentNumber`,`fileType`,`stats` FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND `receiveDepartmentNumber`='$_SESSION[userDepartment]' AND `stats`='BR' ";			  
	$sql_selFile = mysqli_query($conn,$selFile);
?>
<table class="tbl1" border="1">
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Send Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Send Department Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Courier Type</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
      </tr>
<?php
	$_SESSION['rowFile'] = mysqli_num_rows($sql_selFile);
	$b = 1 ;
	while ($add_selFile = mysqli_fetch_array($sql_selFile)) {
		$branchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$add_selFile[0]."'";
		$sqlbranchSel = mysqli_query($conn,$branchSel);
		$rdepartment = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$add_selFile[1]."'";
		$sqlrdepartment = mysqli_query($conn,$rdepartment);
		while($add_branchSel = mysqli_fetch_array($sqlbranchSel)){
			while($add_rdepartment  = mysqli_fetch_array($sqlrdepartment)){
				 echo "<tr style='background-color:#FFFFFF;'>";
				 echo "<td style='width:200px;'>
					   <div id='diva".$b."' style='display:none;'>
					   <input type='text' name='sela".$b."' id='sela".$b."' value='".$add_selFile[0]."' required/></div>
					   <input style='width:200px;' type='text' name='selaa".$b."' id='selaa".$b."' value='".$add_branchSel[0]."' disabled='disabled'/></td>";
				 echo "<td style='width:200px;'>
					   <div id='divb".$b."' style='display:none;'>
					   <input type='text' name='selb".$b."' id='selb".$b."' value='".$add_selFile[1]."' required/></div>
					   <input style='width:200px;' type='text' name='selbb".$b."' id='selbb".$b."' value='".$add_rdepartment[0]."'  disabled='disabled'/></td>";
				 echo "<td style='width:200px;'>
					   <div id='divb".$b."' style='display:none;'>
					   <input type='text' name='selc".$b."' id='selc".$b."' value='".$add_selFile[2]."' required/></div>
					   <input style='width:200px;' type='text' name='selcc".$b."' id='selcc".$b."' value='".$add_selFile[2]."'  disabled='disabled'/></td>";
				 echo "<td style='width:100px;'>";
					if($add_selFile[3] == "BR"){
						echo "<input type='checkbox' name='chka".$b."' id='chka".$b."' checked='checked'/>";
					}else{
						echo "<input type='checkbox' name='chka".$b."' id='chka".$b."'/>";
					}
				echo "</td>";
				echo "</tr>";
				$b++;
			 }
		 }
	}
?>
</table>
<br/>
<input class="buttonManage" type="submit" id="btnSave" name="btnSave" value="Save"/>
<?php
	if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
		// Set autocommit to off
		mysqli_autocommit($conn,FALSE);
		try{
			for ($i = 1; $_SESSION['rowFile']>= $i; $i++){ 
				if(isset($_POST['chka'.$i])){
					date_default_timezone_set('Asia/Colombo');
					$sqlMove = "SELECT `fileNumber` FROM `courier_files` WHERE `receiveBranchNumber`='$_SESSION[userBranch]' AND `receiveDepartmentNumber`='$_SESSION[userDepartment]' AND `stats`='BR' AND `branchNumber`='".trim($_POST['sela'.$i])."' AND `departmentNumber` = '".trim($_POST['selb'.$i])."' AND `fileType`='".trim($_POST['selc'.$i])."'";
					$sqlfileGet = mysqli_query($conn,$sqlMove);
					$fielRow = mysqli_num_rows($sqlfileGet);
					for($a = 1; $a <= $fielRow; $a++){
						while ($add_fileGet = mysqli_fetch_array($sqlfileGet)){
							//FileMovementLogger($conn,$add_fileGet[0],'department received');
                            FileMovementLogger_USER($conn,$add_fileGet[0],'department received',$_SESSION['user']);
						}
					}
					$updateFile="UPDATE courier_files SET stats='DR' WHERE `branchNumber` = '".trim($_POST['sela'.$i])."' AND `departmentNumber` = '".trim($_POST['selb'.$i])."' AND `fileType` = '".trim($_POST['selc'.$i])."' AND `receiveBranchNumber`='$_SESSION[userBranch]' AND `receiveDepartmentNumber`='$_SESSION[userDepartment]' AND `stats` = 'BR'";
					$sql_updateFile= mysqli_query($conn,$updateFile)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));		
				}else{
					
				}
			}
			if($_SESSION['rowFile']!=0){
				echo "<script> alert('Record Update!'); </script>";
                echo "<script>pageRef();</script>";
			}else{
				/*echo "<script> alert('aaaaaa!'); </script>";*/
			}
			
			// Commit transaction
			mysqli_commit($conn);
		}catch(Exception $e){
			// Rollback transaction
			mysqli_rollback($conn);
			echo 'Message: ' .$e->getMessage();
		}
	}
?>
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>