<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Branch Management
Purpose			: To Create Branch
Author			: Madushan Wikramaarachchi
Date & Time		: 12.02 P.M 19/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="M001";
	$_SESSION['Module'] = "Admin";
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
<title>Branch Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<script language="javascript" type="text/javascript">
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
		var idValue = document.getElementById("txtBranchNumber").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtBranchNumber').value = results[0].trim();
				document.getElementById('txtBranchName').value = results[1].trim();
				document.getElementById('txtBranchTP').value = results[2].trim();
				document.getElementById('txtBranchAddress').value = results[3].trim();
				document.getElementById('txtBranchAddress1').value = results[4].trim();
				document.getElementById('txtBranchAddress2').value = results[5].trim();
				document.getElementById('txtBranchAddress3').value = results[6].trim();
				document.getElementById('txtBranchAddress4').value = results[7].trim();
				document.getElementById('txtEmail').value = results[8].trim();
			}
		} 
	}
	function chak(){
		var em = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var num = /^([0-9])+$/;
		if(!document.getElementById('txtEmail').value.match(em)){
			alert("Plase only enter yyyyyyy@ghj.com");
			document.getElementById('txtEmail').value ="";
			return false;
		}
		if(document.getElementById('txtBranchTP').value.length!=10 ){
			alert("Plase only enter 10 numbers !");
			document.getElementById('txtBranchTP').value ="";
			return false;
		}
		if(!document.getElementById('txtBranchTP').value.match(num)){
			alert("Plase only enter only number");
			document.getElementById('txtBranchTP').value ="";
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
</p>
<hr/>
<table>
  <tr>
    <td style="width:150px;"> <label class="linetop">Branch Number :</label></td>
    <td>
   		<input type="text" style="width:150px; border: solid 1px #000000; " name="txtBranchNumber" id="txtBranchNumber" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Branch Name :</label></td>
    <td>
    	<input type="text" style="width:200px; border: solid 1px #000000;" name="txtBranchName" id="txtBranchName" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Branch Telephone : </label></td>
    <td>
    	<input type="text" style="border: solid 1px #000000;" maxlength="10" name="txtBranchTP" id="txtBranchTP" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr> 
   <tr>
    <td style="width:150px; vertical-align:top;"><label class="linetop">Branch Addresss :</label></td>
    <td>
    	<input type="text" style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtBranchAddress" id="txtBranchAddress" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtBranchAddress1" id="txtBranchAddress1" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtBranchAddress2" id="txtBranchAddress2" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" /><br/>
        <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtBranchAddress3" id="txtBranchAddress3" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input type="text"  style=" width:200px; border: solid 1px #000000;" name="txtBranchAddress4" id="txtBranchAddress4" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:150px;"><label class="linetop">Branch E-mail :</label></td>
    <td>
    	<input type="text" style=" width:300px;border: solid 1px #000000;" name="txtEmail" id="txtEmail" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
  </table>
  <br/>
<input class="buttonManage" type="submit" id="btnBranchSave" name="btnBranchSave" value="Save"/>
        <?php
			if(isset($_POST['btnBranchSave']) && $_POST['btnBranchSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBranchNumber'] = trim($_POST['txtBranchNumber']);
					$_SESSION['txtBranchName'] = trim($_POST['txtBranchName']);
					$_SESSION['txtBranchTP'] = trim($_POST['txtBranchTP']);
					$_SESSION['txtBranchAddress'] = trim($_POST['txtBranchAddress']);
					$_SESSION['txtBranchAddress1'] = trim($_POST['txtBranchAddress1']);
					$_SESSION['txtBranchAddress2'] = trim($_POST['txtBranchAddress2']);
					$_SESSION['txtBranchAddress3'] = trim($_POST['txtBranchAddress3']);
					$_SESSION['txtBranchAddress4'] = trim($_POST['txtBranchAddress4']);
					$_SESSION['txtEmail'] = trim($_POST['txtEmail']);
					if($_SESSION['txtBranchNumber']!="" && $_SESSION['txtBranchName']!=""){
					    date_default_timezone_set('Asia/Colombo');
						$addsq1="INSERT INTO branch(`branchNumber`,`branchName`,`branchTP`,`branchAddress`,`branchAddress1`,`branchAddress2`,`branchAddress3`,`branchAddress4`,`branchEmail`,`enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`) 			
						VALUES('$_SESSION[txtBranchNumber]','$_SESSION[txtBranchName]','$_SESSION[txtBranchTP]','$_SESSION[txtBranchAddress]','$_SESSION[txtBranchAddress1]','$_SESSION[txtBranchAddress2]','$_SESSION[txtBranchAddress3]','$_SESSION[txtBranchAddress4]','$_SESSION[txtEmail]','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now())";
						$query1 = mysqli_query($conn,$addsq1)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query1){
							echo "<script> alert('Record Saved!'); </script>";
							$_SESSION['txtBranchNumber'] = "";
							$_SESSION['txtBranchName'] = "";
							$_SESSION['txtBranchTP'] = "";
							$_SESSION['txtBranchAddress'] = "";
							$_SESSION['txtBranchAddress1'] = "";
							$_SESSION['txtBranchAddress2'] = "";
							$_SESSION['txtBranchAddress3'] = "";
							$_SESSION['txtBranchAddress4'] = "";
							$_SESSION['txtEmail'] = "";
                            echo "<script>pageClose();</script>";
						}else{
							echo "<script> alert('Record not Saved!');</script>";
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
<input class="buttonManage" type="submit" name="btnBranchUpdate" id="btnBranchUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnBranchUpdate']) && $_POST['btnBranchUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBranchNumber'] = trim($_POST['txtBranchNumber']);
					$_SESSION['txtBranchName'] = trim($_POST['txtBranchName']);
					$_SESSION['txtBranchTP'] = trim($_POST['txtBranchTP']);
					$_SESSION['txtBranchAddress'] = trim($_POST['txtBranchAddress']);
					$_SESSION['txtBranchAddress1'] = trim($_POST['txtBranchAddress1']);
					$_SESSION['txtBranchAddress2'] = trim($_POST['txtBranchAddress2']);
					$_SESSION['txtBranchAddress3'] = trim($_POST['txtBranchAddress3']);
					$_SESSION['txtBranchAddress4'] = trim($_POST['txtBranchAddress4']);
					$_SESSION['txtEmail'] = trim($_POST['txtEmail']);
					$newContac = "$_SESSION[txtBranchNumber]|$_SESSION[txtBranchName]|$_SESSION[txtBranchTP]|$_SESSION[txtBranchAddress]|$_SESSION[txtBranchAddress1]|$_SESSION[txtBranchAddress2]|$_SESSION[txtBranchAddress3]|$_SESSION[txtBranchAddress4]|$_SESSION[txtEmail]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					date_default_timezone_set('Asia/Colombo');
					$selec = "SELECT `branchNumber`,`branchName`,`branchTP`,`branchAddress`,`branchAddress1`,`branchAddress2`,`branchAddress3`,`branchAddress4`,`branchEmail` FROM `branch` WHERE branchNumber = '$_SESSION[txtBranchNumber]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]|$rec1[2]|$rec1[3]|$rec1[4]|$rec1[5]|$rec1[6]|$rec1[7]|$rec1[8]";
			 		}
					if($_SESSION['txtBranchNumber']!="" && $_SESSION['txtBranchName']!="" && $_SESSION['txtBranchTP']!="" && $_SESSION['txtBranchAddress']!="" && $_SESSION['txtEmail']!=""){
						$addsql2="UPDATE branch SET branchName = '$_SESSION[txtBranchName]' ,
													branchTP = '$_SESSION[txtBranchTP]' , 
													branchAddress = '$_SESSION[txtBranchAddress]' ,
													branchAddress1 = '$_SESSION[txtBranchAddress1]' ,
													branchAddress2 = '$_SESSION[txtBranchAddress2]' ,
													branchAddress3 = '$_SESSION[txtBranchAddress3]' ,
													branchAddress4 = '$_SESSION[txtBranchAddress4]' ,
													branchEmail = '$_SESSION[txtEmail]' ,
                                                    modifiedBy = '".$_SESSION['user']."',
                                                    modifiedDateTime = now(),
                                                    authoriedBy = '".$_SESSION['user']."',
                                                    authoriedDateTime =now()
								  WHERE branchNumber = '$_SESSION[txtBranchNumber]'";
						$quary2 = mysqli_query($conn,$addsql2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						
						if(!$quary2 ){
							echo "<script> alert('Updated not success!');</script>";
							$_SESSION['txtBranchNumber'] = "";
							$_SESSION['txtBranchName'] = "";
							$_SESSION['txtBranchTP'] = "";
							$_SESSION['txtBranchAddress'] = "";
							$_SESSION['txtBranchAddress1'] = "";
							$_SESSION['txtBranchAddress2'] = "";
							$_SESSION['txtBranchAddress3'] = "";
							$_SESSION['txtBranchAddress4'] = "";
							$_SESSION['txtEmail'] = "";
						}else{
							$table = "branch";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtBranchNumber'] = "";
							$_SESSION['txtBranchName'] = "";
							$_SESSION['txtBranchTP'] = "";
							$_SESSION['txtBranchAddress'] = "";
							$_SESSION['txtBranchAddress1'] = "";
							$_SESSION['txtBranchAddress2'] = "";
							$_SESSION['txtBranchAddress3'] = "";
							$_SESSION['txtBranchAddress4'] = "";
							$_SESSION['txtEmail'] = "";
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
<input class="buttonManage" type="submit" name="btnBranchDelete" id="btnBranchDelete" value="Delete"/>
        <?php
			if(isset($_POST['btnBranchDelete']) && $_POST['btnBranchDelete']=='Delete'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBranchNumber'] = trim($_POST['txtBranchNumber']);
					if($_SESSION['txtBranchNumber']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`branch` WHERE `branch`.`branchNumber` = '$_SESSION[txtBranchNumber]'";
						$quary13 = mysqli_query($conn,$addsql3) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtBranchNumber']="";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtBranchNumber']="";
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