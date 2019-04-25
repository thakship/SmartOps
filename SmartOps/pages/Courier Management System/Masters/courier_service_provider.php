<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Service Provider
Purpose			: To Create Courier Service Providers
Author			: Madushan Wikramaarachchi
Date & Time		: 09.13 A.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/001";
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
<title>Courier Service Provider</title><br />
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
		var url = "getagentids.php?param=";
		var idValue = document.getElementById("txtSPNumber").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtSPNumber').value = results[0].trim();
				document.getElementById('txtSPName').value = results[1].trim();
				document.getElementById('txtSPAddress').value = results[2].trim();
				document.getElementById('txtSPAddress1').value = results[3].trim();
				document.getElementById('txtSPAddress2').value = results[4].trim();
				document.getElementById('txtSPAddress3').value = results[5].trim();
				document.getElementById('txtSPAddress4').value = results[6].trim();
				document.getElementById('txtSPTelephone').value = results[7].trim();
				document.getElementById('txtSPEmail').value = results[8].trim();
				document.getElementById('txtSPOffice').value = results[9].trim();
			}
		} 
	}
	
	function chak(){
		var em = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var num = /^([0-9])+$/;
		if(!document.getElementById('txtSPEmail').value.match(em)){
			alert("Plase only enter yyyyyyy@ghj.com");
			document.getElementById('txtSPEmail').value ="";
			return false;
		}
		if(document.getElementById('txtSPTelephone').value.length!=10){
			alert("Plase only enter 10 numbers !");
			document.getElementById('txtSPTelephone').value ="";
			return false;
		}
		if(!document.getElementById('txtSPTelephone').value.match(num)){
			alert("Plase only enter only number");
			document.getElementById('txtSPTelephone').value ="";
			return false;
		}
		return true;
	}	
</script> 
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" onsubmit="return chak()">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width:170px;"><label class="linetop">Service Provider Number :</label></td>
    <td>
  		<input class="box_decaretion" type="text"  style=" width:150px;" name="txtSPNumber" id="txtSPNumber" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:170px;"><label class="linetop">Service Provider Name :</label></td>
    <td>
    	<input class="box_decaretion" type="text" style=" width:200px;" name="txtSPName" id="txtSPName" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
    </td>
  </tr>
  <tr>
    <td style="width:170px; vertical-align:top"><label class="linetop">Service Provider Address :</label></td>
    <td>
    	<input class="box_decaretion" type="text"  style=" width:200px; margin-bottom:5px;" name="txtSPAddress" id="txtSPAddress" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input class="box_decaretion" type="text"  style=" width:200px; margin-bottom:5px;" name="txtSPAddress1" id="txtSPAddress1" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input class="box_decaretion" type="text"  style=" width:200px; margin-bottom:5px;" name="txtSPAddress2" id="txtSPAddress2" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" /><br/>
        <input class="box_decaretion" type="text"  style=" width:200px; margin-bottom:5px;" name="txtSPAddress3" id="txtSPAddress3" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input class="box_decaretion" type="text"  style=" width:200px;" name="txtSPAddress4" id="txtSPAddress4" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:170px;"><label class="linetop">Service Provider Telephone :</label></td>
    <td>
    	<input class="box_decaretion" type="text" maxlength="10" name="txtSPTelephone" id="txtSPTelephone" value=""  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
    </td>
  </tr>
   <tr>
    <td style="width:170px;"><label class="linetop">Service Provider E-Mail :</label></td>
    <td>
    	<input class="box_decaretion" type="text"  style=" width:300px;" name="txtSPEmail" id="txtSPEmail" value=""  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
    </td>
  </tr>
   <tr>
    <td style="width:170px;"><label class="linetop">Service Provider Officer :</label> </td>
    <td>
    	<input class="box_decaretion" type="text" style=" width:200px;" name="txtSPOffice" id="txtSPOffice" value=""  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
    </td>
  </tr>
</table>
<br/>
<input class="buttonManage" type="submit" id="btnSPSave" name="btnSPSave" value="Save"/>
        <?php
			if(isset($_POST['btnSPSave']) && $_POST['btnSPSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtSPNumber'] = trim($_POST['txtSPNumber']);
					$_SESSION['txtSPName'] = trim($_POST['txtSPName']);
					$_SESSION['txtSPAddress'] = trim($_POST['txtSPAddress']);
					$_SESSION['txtSPAddress1'] = trim($_POST['txtSPAddress1']);
					$_SESSION['txtSPAddress2'] = trim($_POST['txtSPAddress2']);
					$_SESSION['txtSPAddress3'] = trim($_POST['txtSPAddress3']);
					$_SESSION['txtSPAddress4'] = trim($_POST['txtSPAddress4']);
					$_SESSION['txtSPTelephone'] = trim($_POST['txtSPTelephone']);
					$_SESSION['txtSPEmail'] = trim($_POST['txtSPEmail']);
					$_SESSION['txtSPOffice'] = trim($_POST['txtSPOffice']);
					if($_SESSION['txtSPNumber']!="" && $_SESSION['txtSPName']!=""){
						$addsq1="INSERT INTO courier_service_provider(`serviceProviderNumber`,`serviceProviderName`,`serviceProviderAddress`,`serviceProviderAddress1`,`serviceProviderAddress2`,`serviceProviderAddress3`,`serviceProviderAddress4`,`serviceProviderTP`,`serviceProviderEmail`,`serviceProviderOfficer`) VALUES ('$_SESSION[txtSPNumber]', '$_SESSION[txtSPName]', '$_SESSION[txtSPAddress]', '$_SESSION[txtSPAddress1]', '$_SESSION[txtSPAddress2]', '$_SESSION[txtSPAddress3]', '$_SESSION[txtSPAddress4]', '$_SESSION[txtSPTelephone]', '$_SESSION[txtSPEmail]', '$_SESSION[txtSPOffice]')";
						$query1 = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						$txtSPNumber = $_POST['txtSPNumber'];
						date_default_timezone_set('Asia/Colombo');
						$sqlUpInfo="UPDATE courier_service_provider SET	enteredBy='".$_SESSION['user']."',enteredDateTime = now() where serviceProviderNumber = '$txtSPNumber'";
						$result= mysqli_query($conn,$sqlUpInfo) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						$sqlUpInfo1="UPDATE courier_service_provider SET authoriedBy='".$_SESSION['user']."', authoriedDateTime =now() where serviceProviderNumber = '$txtSPNumber'";
						$result1= mysqli_query($conn,$sqlUpInfo1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query1){
							echo "<script> alert('Record Saved!'); </script>";
							$_SESSION['txtSPNumber'] = "";
							$_SESSION['txtSPName'] = "";
							$_SESSION['txtSPAddress'] = "";
							$_SESSION['txtSPAddress1'] = "";
							$_SESSION['txtSPAddress2'] = "";
							$_SESSION['txtSPAddress3'] = "";
							$_SESSION['txtSPAddress4'] = "";
							$_SESSION['txtSPTelephone'] = "";
							$_SESSION['txtSPEmail'] = "";
							$_SESSION['txtSPOffice'] = "";
                            echo "<script>pageClose();</script>";
						}else{
							echo "<script> alert('Record not Saved!');</script>";
							$_SESSION['txtSPNumber'] = "";
							$_SESSION['txtSPName'] = "";
							$_SESSION['txtSPAddress'] = "";
							$_SESSION['txtSPAddress1'] = "";
							$_SESSION['txtSPAddress2'] = "";
							$_SESSION['txtSPAddress3'] = "";
							$_SESSION['txtSPAddress4'] = "";
							$_SESSION['txtSPTelephone'] = "";
							$_SESSION['txtSPEmail'] = "";
							$_SESSION['txtSPOffice'] = "";
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
<input class="buttonManage" type="submit" name="btnSPUpdate" id="btnSPUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnSPUpdate']) && $_POST['btnSPUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtSPNumber'] = trim($_POST['txtSPNumber']);
					$_SESSION['txtSPName'] = trim($_POST['txtSPName']);
					$_SESSION['txtSPAddress'] = trim($_POST['txtSPAddress']);
					$_SESSION['txtSPAddress1'] = trim($_POST['txtSPAddress1']);
					$_SESSION['txtSPAddress2'] = trim($_POST['txtSPAddress2']);
					$_SESSION['txtSPAddress3'] = trim($_POST['txtSPAddress3']);
					$_SESSION['txtSPAddress4'] = trim($_POST['txtSPAddress4']);
					$_SESSION['txtSPTelephone'] = trim($_POST['txtSPTelephone']);
					$_SESSION['txtSPEmail'] = trim($_POST['txtSPEmail']);
					$_SESSION['txtSPOffice'] = trim($_POST['txtSPOffice']);
				    $newContac = "$_SESSION[txtSPNumber]|$_SESSION[txtSPName]|$_SESSION[txtSPAddress]|$_SESSION[txtSPAddress1]|$_SESSION[txtSPAddress2]|$_SESSION[txtSPAddress3]|$_SESSION[txtSPAddress4]|$_SESSION[txtSPTelephone]|$_SESSION[txtSPEmail]|$_SESSION[txtSPOffice]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `serviceProviderNumber`,`serviceProviderName`,`serviceProviderAddress`,`serviceProviderAddress1`,`serviceProviderAddress2`,`serviceProviderAddress3`,`serviceProviderAddress4`,`serviceProviderTP`,`serviceProviderEmail`,`serviceProviderOfficer` FROM `courier_service_provider` WHERE serviceProviderNumber = '$_SESSION[txtSPNumber]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]|$rec1[2]|$rec1[3]|$rec1[4]|$rec1[5]|$rec1[6]|$rec1[7]|$rec1[8]|$rec1[9]";
			 		}
					if($_SESSION['txtSPNumber']!="" && $_SESSION['txtSPName']!="" && $_SESSION['txtSPAddress']!="" && $_SESSION['txtSPTelephone']!="" && $_SESSION['txtSPEmail']!="" && $_SESSION['txtSPOffice']!=""){
						$addsql2="UPDATE courier_service_provider SET serviceProviderName = '$_SESSION[txtSPName]' , serviceProviderAddress = '$_SESSION[txtSPAddress]' , serviceProviderAddress1 = '$_SESSION[txtSPAddress1]' , serviceProviderAddress2 = '$_SESSION[txtSPAddress2]' , serviceProviderAddress3 = '$_SESSION[txtSPAddress3]' , serviceProviderAddress4 = '$_SESSION[txtSPAddress4]' , serviceProviderTP = '$_SESSION[txtSPTelephone]' , serviceProviderEmail = '$_SESSION[txtSPEmail]', serviceProviderOfficer = '$_SESSION[txtSPOffice]' WHERE serviceProviderNumber = '$_SESSION[txtSPNumber]'";
						$quary2 = mysqli_query($conn,$addsql2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary2){
							echo "<script> alert('Updated not success!');</script>";
							$_SESSION['txtSPNumber'] = "";
							$_SESSION['txtSPName'] = "";
							$_SESSION['txtSPAddress'] = "";
							$_SESSION['txtSPAddress1'] = "";
							$_SESSION['txtSPAddress2'] = "";
							$_SESSION['txtSPAddress3'] = "";
							$_SESSION['txtSPAddress4'] = "";
							$_SESSION['txtSPTelephone'] = "";
							$_SESSION['txtSPEmail'] = "";
							$_SESSION['txtSPOffice'] = "";
						}else{
							$txtSPNumber = trim($_POST['txtSPNumber']);
							date_default_timezone_set('Asia/Colombo');
							$sqlUpInfo2="UPDATE courier_service_provider SET modifiedBy='".$_SESSION['user']."', modifiedDateTime =now() , authoriedBy='".$_SESSION['user']."', authoriedDateTime =now() where serviceProviderNumber = '$txtSPNumber'";
							$result2= mysqli_query($conn,$sqlUpInfo2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							$table = "courier_service_provider";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtSPNumber'] = "";
							$_SESSION['txtSPName'] = "";
							$_SESSION['txtSPAddress'] = "";
							$_SESSION['txtSPAddress1'] = "";
							$_SESSION['txtSPAddress2'] = "";
							$_SESSION['txtSPAddress3'] = "";
							$_SESSION['txtSPAddress4'] = "";
							$_SESSION['txtSPTelephone'] = "";
							$_SESSION['txtSPEmail'] = "";
							$_SESSION['txtSPOffice'] = "";
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
<input class="buttonManage" type="submit" name="btnSPDelete" id="btnSPDelete" value="Delete"/>
        <?php
			if(isset($_POST['btnSPDelete']) && $_POST['btnSPDelete']=='Delete'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtSPNumber'] = trim($_POST['txtSPNumber']);
					if($_SESSION['txtSPNumber']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`courier_service_provider` WHERE `courier_service_provider`.`serviceProviderNumber` = '$_SESSION[txtSPNumber]'";
						$quary13 = mysqli_query($conn,$addsql3);
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtSPNumber']="";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtSPNumber']="";
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