<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Masters Document
Purpose			: To Create Courier Masters Document
Author			: Madushan Wikramaarachchi
Date & Time		: 09.58 A.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/002";
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
<title>Courier Masters Document</title>
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
		function ajaxFunction(e){
		var http;  // The variable that makes Ajax possible! 
		var e=e || window.event;
		var keycode=e.which || e.keyCode;
		if(keycode!==13 || (e.target||e.srcElement).value=='') return false;
		try{ 
			// Opera 8.0+, Firefox, Safari 
			http = new XMLHttpRequest(); 
		}catch(ex){ 
			// Internet Explorer Browsers 
			try{ 
				http = new ActiveXObject("Msxml2.XMLHTTP"); 
			}catch(ex){ 
				try{ 
					http = new ActiveXObject("Microsoft.XMLHTTP"); 
				}catch(ex){ 
					// Something went wrong 
					alert("Your browser broke!"); 
					return false; 
				}
			}
		}
		var url = "getagentids.php?param1=";
		var idValue = document.getElementById("txtMDNumber").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtMDNumber').value = results[0].trim();
				document.getElementById('txtMDName').value = results[1].trim();
			}
		} 
	}
</script> 
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Document Number :</label></td>
    <td>
   <input class="box_decaretion" type="text" style=" width:150px;" name="txtMDNumber" id="txtMDNumber" value=""  onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Document Name :</label></td>
    <td>
    	<input class="box_decaretion" type="text" style="width:200px;" name="txtMDName" id="txtMDName" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
    </td>
  </tr>
</table><br/>
<input class="buttonManage" type="submit" id="btnMDSave" name="btnMDSave" value="Save"/>
        <?php
			if(isset($_POST['btnMDSave']) && $_POST['btnMDSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtMDNumber'] = trim($_POST['txtMDNumber']);
					$_SESSION['txtMDName'] = trim($_POST['txtMDName']);
					if($_SESSION['txtMDNumber']!="" && $_SESSION['txtMDName']!=""){
						$addsq1="INSERT INTO courier_masters_document(`documentNumber`,`documentName`) VALUES('$_SESSION[txtMDNumber]','$_SESSION[txtMDName]')";
						$query1 = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						$txtMDNumber = trim($_POST['txtMDNumber']);
						date_default_timezone_set('Asia/Colombo');
						$sqlUpInfo="UPDATE courier_masters_document SET	enteredBy='".$_SESSION['user']."', enteredDateTime = now(), authoriedBy='".$_SESSION['user']."', authoriedDateTime = now() where documentNumber = '$txtMDNumber'";
						$result= mysqli_query($conn,$sqlUpInfo) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query1){
							echo "<script> alert('Record Saved!'); </script>";
							$_SESSION['txtMDNumber'] = "";
							$_SESSION['txtMDName'] = "";
                            echo "<script>pageClose();</script>";
						}else{
							echo "<script> alert('Record not Saved!');</script>";
							$_SESSION['txtMDNumber'] = "";
							$_SESSION['txtMDName'] = "";
						}
					}else{
						echo "<script> alert('Please enter complete details!');</script>";
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
<input class="buttonManage" type="submit" name="btnMDUpdate" id="btnMDUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnMDUpdate']) && $_POST['btnMDUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtMDNumber'] = trim($_POST['txtMDNumber']);
					$_SESSION['txtMDName'] = trim($_POST['txtMDName']);
					$newContac = "$_SESSION[txtMDNumber]|$_SESSION[txtMDName]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `documentNumber`,`documentName` FROM `courier_masters_document` WHERE documentNumber = '$_SESSION[txtMDNumber]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]";
			 		}
					if($_SESSION['txtMDNumber']!="" && $_SESSION['txtMDName']!=""){
						$addsql2="UPDATE courier_masters_document SET documentName = '$_SESSION[txtMDName]' WHERE documentNumber = '$_SESSION[txtMDNumber]'";
						$quary2 = mysqli_query($conn,$addsql2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary2){
							echo "<script> alert('Updated not success!');</script>";
							$_SESSION['txtMDNumber'] = "";
							$_SESSION['txtMDName'] = "";
						}else{
							$txtMDNumber = trim($_POST['txtMDNumber']);
							date_default_timezone_set('Asia/Colombo');
							$sqlUpInfo2="UPDATE courier_masters_document SET modifiedBy='".$_SESSION['user']."', modifiedDateTime =now(), authoriedBy='".$_SESSION['user']."', authoriedDateTime = now() where documentNumber = '$txtMDNumber'";
							$result2= mysqli_query($conn,$sqlUpInfo2)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							$table = "courier_masters_document";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtMDNumber'] = "";
							$_SESSION['txtMDName'] = "";
                            echo "<script>pageClose();</script>";
						}
					}else{
						echo "<script> alert('Please enter complete details!'); </script>";
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
<input class="buttonManage" type="submit" name="btnMDDelete" id="btnMDDelete" value="Delete"/>
        <?php
			if(isset($_POST['btnMDDelete']) && $_POST['btnMDDelete']=='Delete'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtMDNumber'] = trim($_POST['txtMDNumber']);
					if($_SESSION['txtMDNumber']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`courier_masters_document` WHERE `courier_masters_document`.`documentNumber` = '$_SESSION[txtMDNumber]'";
						$quary13 = mysqli_query($conn,$addsql3) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtMDNumber']="";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtMDNumber']="";
                            echo "<script>pageClose();</script>";
						}
					}else{
						echo "<script> alert('Enter User Name!');</script>";
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