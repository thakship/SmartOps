<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Assign Courier SP
Purpose			: To Assign Courier SP
Author			: Madushan Wikramaarachchi
Date & Time		: 11.25 A.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/005";
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
<title>Masters Courier Group Document Type</title>
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
		var url = "getagentids.php?param2=";
		var idValue = document.getElementById("txtGDN").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtGDN').value = results[0].trim();
				document.getElementById('txtGDD').value = results[1].trim();
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
    <td style="width:150px;"><label class="linetop">Group Doc Number :</label></p></td>
    <td>
   <input class="box_decaretion" type="text" style=" width:150px;" name="txtGDN" id="txtGDN" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyUp="ajaxFunction(event)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Group Doc Description :</label></td>
    <td>
    	<input class="box_decaretion" type="text" style=" width:300px;" name="txtGDD" id="txtGDD" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)" required/>
    </td>
  </tr>
</table>
<br/>
<input class="buttonManage" type="submit" id="btnGTSave" name="btnGTSave" value="Save"/>
        <?php
			if(isset($_POST['btnGTSave']) && $_POST['btnGTSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtGDN'] = $_POST['txtGDN'];
					$_SESSION['txtGDD'] = $_POST['txtGDD'];
					if($_SESSION['txtGDN']!="" && $_SESSION['txtGDD']!=""){
						date_default_timezone_set('Asia/Colombo');
						$sql_groupDT = "INSERT INTO `courier_groupdoctype`(`groupCodeDoc`, `groupDetels`, `enteredBy`, `enteredDateTime`,`authoriedBy`, `authoriedDateTime`) VALUES ('$_SESSION[txtGDN]','$_SESSION[txtGDD]','$_SESSION[user]',now(),'$_SESSION[user]',now())";
						$query_groupDT = mysqli_query($conn,$sql_groupDT) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query_groupDT){
							echo "<script> alert('Record Saved!');</script>";
							$_SESSION['txtGDN'] = "";
							$_SESSION['txtGDD'] = "";
                            echo "<script>pageClose();</script>";
						}else{
							echo "<script> alert('Record not saved!');</script>";
							$_SESSION['txtGDN'] = "";
							$_SESSION['txtGDD'] = "";
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
<input class="buttonManage" type="submit" name="btnDGUpdate" id="btnDGUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnDGUpdate']) && $_POST['btnDGUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtGDN'] = $_POST['txtGDN'];
					$_SESSION['txtGDD'] = $_POST['txtGDD'];
					date_default_timezone_set('Asia/Colombo');
					$newContac = "$_SESSION[txtGDN]|$_SESSION[txtGDD]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `groupCodeDoc`,`groupDetels` FROM `courier_groupdoctype` WHERE `groupCodeDoc` = '$_SESSION[txtGDN]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]";
			 		}
					if($_SESSION['txtGDN']!="" && $_SESSION['txtGDD']!=""){
						$update_DG	= "UPDATE `courier_groupdoctype` SET `groupDetels`='$_SESSION[txtGDD]',`modifiedBy`='$_SESSION[user]',`modifiedDateTime`= now(),`authoriedBy`= '$_SESSION[user]',`authoriedDateTime`= now() WHERE `groupCodeDoc`='$_SESSION[txtGDN]'";
						$quary_update_DG = mysqli_query($conn,$update_DG) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));			   
						if(!$quary_update_DG){
							echo "<script> alert('updated not success!');</script>";
						}else{
							$table = "courier_groupdoctype";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtModuleCode'] = "";
							$_SESSION['txtModuleName'] = "";	
                            echo "<script>pageClose();</script>";
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
        <input type="submit" name="btnMDDelete" id="btnMDDelete" value="Delete"/>
        <?php
			if(isset($_POST['btnMDDelete']) && $_POST['btnMDDelete']=='Delete'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtGDN'] = $_POST['txtGDN'];
					$_SESSION['txtGDD'] = $_POST['txtGDD'];
					if($_SESSION['txtGDN']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`courier_groupdoctype` WHERE `courier_groupdoctype`.`groupDetels`='$_SESSION[txtGDD]'";
						$quary13 = mysqli_query($conn,$addsql3) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtModuleCode']="";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtModuleCode']="";
                            echo "<script>pageClose();</script>";
						}
					}else{
						echo "<script> alert('Enter Group Doc Number!');	</script>";
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