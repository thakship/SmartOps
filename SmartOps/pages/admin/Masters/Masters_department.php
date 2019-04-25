<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Department Management
Purpose			: To Create Department
Author			: Madushan Wikramaarachchi
Date & Time		: 2.26 P.M 19/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="M002";
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
<title>Department Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.tbl{
	 	text-align:center;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	#outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
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
		var idValue = document.getElementById("txtDepartmentNumber").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtDepartmentNumber').value = results[0].trim();
				document.getElementById('txtDepartmentName').value = results[1].trim();
				document.getElementById('selBranchNumber').value = results[2].trim();
				document.getElementById('selBranchNumber1').value = results[3].trim();
				//alert(results[2]);
				//document.getElementById('txt').value = results[2];
				document.getElementById('txtDepertmentTP').value = results[4].trim();
				document.getElementById('txtDepartmentAddress').value = results[5].trim();
				document.getElementById('txtDepartmentAddress1').value = results[6].trim();
				document.getElementById('txtDepartmentAddress2').value = results[7].trim();
				document.getElementById('txtDepartmentAddress3').value = results[8].trim();
				document.getElementById('txtDepartmentAddress4').value = results[9].trim();
				document.getElementById('txtEmail').value = results[10].trim();
			}
			//document.getElementById("txtUserName").disabled = true;
			//document.getElementById("txtUserName").readOnly = true;
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
		if(document.getElementById('txtDepertmentTP').value.length!=10){
			alert("Plase only enter 10 numbers");
			document.getElementById('txtDepertmentTP').value ="";
			return false;
		}
		if(!document.getElementById('txtDepertmentTP').value.match(num)){
			alert("Plase only enter only number");
			document.getElementById('txtDepertmentTP').value ="";
			return false;
		}
		return true;
	}
	function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
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
<hr />
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Department Number :</label></td>
    <td>
   		<input type="text" style="width:150px; border: solid 1px #000000;" name="txtDepartmentNumber" id="txtDepartmentNumber" value=""  onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Department Name :</label></td>
    <td>
    	<input type="text" style="width:200px; border: solid 1px #000000;" name="txtDepartmentName" id="txtDepartmentName" value=""  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Branch Name :</label></td>
    <td>
    	
        <div style='display:none;'>
        <input type="text" name="selBranchNumber" id="selBranchNumber" value=""  onKeyPress="return disableEnterKey(event)" readonly required/>
       </div>
        <input type="text" style="width:200px; border: solid 1px #000000;" name="selBranchNumber1" id="selBranchNumber1" value=""  onKeyPress="return disableEnterKey(event)" onclick="popup(1)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required/>
   	  </td>
  </tr>
   <tr>
    <td style="width:150px;"><label class="linetop">Department Telephone :</label></td>
    <td>
    	<input type="text" style="border: solid 1px #000000;" maxlength="10" name="txtDepertmentTP" id="txtDepertmentTP" value=""  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
    </td>
  </tr>
   <tr>
    <td style="width:150px; vertical-align:top;"><label class="linetop">Department Address :</label></td>
    <td>
    	<input type="text" style="width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtDepartmentAddress" id="txtDepartmentAddress" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)"/><br/>
         <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtDepartmentAddress1" id="txtDepartmentAddress1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)"/><br/>
        <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtDepartmentAddress2" id="txtDepartmentAddress2" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)" /><br/>
        <input type="text"  style=" width:200px; margin-bottom:5px; border: solid 1px #000000;" name="txtDepartmentAddress3" id="txtDepartmentAddress3" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"/><br/>
        <input type="text"  style=" width:200px; border: solid 1px #000000;" name="txtDepartmentAddress4" id="txtDepartmentAddress4" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
   <tr>
    <td style="width:150px;"><label class="linetop">Department Email :</label></td>
    <td>
    	<input type="text" style="width:300px; border: solid 1px #000000;" name="txtEmail" id="txtEmail" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
</table><br/>
<input class="buttonManage" type="submit" id="btnDepartmentSave" name="btnDepartmentSave" value="Save"/>
        <?php
			if(isset($_POST['btnDepartmentSave']) && $_POST['btnDepartmentSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtDepartmentNumber'] = trim($_POST['txtDepartmentNumber']);
					$_SESSION['txtDepartmentName'] = trim($_POST['txtDepartmentName']);
					$_SESSION['selBranchNumber'] = trim($_POST['selBranchNumber']);
					$_SESSION['txtDepertmentTP'] = trim($_POST['txtDepertmentTP']);
					$_SESSION['txtDepartmentAddress'] = trim($_POST['txtDepartmentAddress']);
					$_SESSION['txtDepartmentAddress1'] = trim($_POST['txtDepartmentAddress1']);
					$_SESSION['txtDepartmentAddress2'] = trim($_POST['txtDepartmentAddress2']);
					$_SESSION['txtDepartmentAddress3'] = trim($_POST['txtDepartmentAddress3']);
					$_SESSION['txtDepartmentAddress4'] = trim($_POST['txtDepartmentAddress4']);
					$_SESSION['txtEmail'] = trim($_POST['txtEmail']);
					if($_SESSION['txtDepartmentNumber']!="" && $_SESSION['txtDepartmentName']!="" && $_SESSION['selBranchNumber']!=""){
					    date_default_timezone_set('Asia/Colombo');
						$addsq1="INSERT INTO deparment(`deparmentNumber`,`deparmentName`,`branchNumber`,`deparmentTP`,`deparmentAddress`,`deparmentAddress1`,`deparmentAddress2`,`deparmentAddress3`,`deparmentAddress4`,`deparmentEmail`,`enteredBy`,`enteredDateTime`,`authoriedBy`,`authoriedDateTime`) 			
								VALUES('$_SESSION[txtDepartmentNumber]','$_SESSION[txtDepartmentName]','$_SESSION[selBranchNumber]','$_SESSION[txtDepertmentTP]','$_SESSION[txtDepartmentAddress]','$_SESSION[txtDepartmentAddress1]','$_SESSION[txtDepartmentAddress2]','$_SESSION[txtDepartmentAddress3]','$_SESSION[txtDepartmentAddress4]','$_SESSION[txtEmail]','".$_SESSION['user']."',now(),'".$_SESSION['user']."',now())";
						$query1 = mysqli_query($conn,$addsq1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query1){
							echo "<script> alert('Record Saved!'); </script>";
							$_SESSION['txtDepartmentNumber'] = "";
							$_SESSION['txtDepartmentName'] = "";
							$_SESSION['selBranchNumber'] = "";
							$_SESSION['txtDepertmentTP'] = "";
							$_SESSION['txtDepartmentAddress'] = "";
							$_SESSION['txtDepartmentAddress1'] = "";
							$_SESSION['txtDepartmentAddress2'] = "";
							$_SESSION['txtDepartmentAddress3'] = "";
							$_SESSION['txtDepartmentAddress4'] = "";
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
<input class="buttonManage" type="submit" name="btnDepartmentUpdate" id="btnDepartmentUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnDepartmentUpdate']) && $_POST['btnDepartmentUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtDepartmentNumber'] = trim($_POST['txtDepartmentNumber']);
					$_SESSION['txtDepartmentName'] = trim($_POST['txtDepartmentName']);
					$_SESSION['selBranchNumber'] = trim($_POST['selBranchNumber']);
					$_SESSION['txtDepertmentTP'] = trim($_POST['txtDepertmentTP']);
					$_SESSION['txtDepartmentAddress'] = trim($_POST['txtDepartmentAddress']);
					$_SESSION['txtDepartmentAddress1'] = trim($_POST['txtDepartmentAddress1']);
					$_SESSION['txtDepartmentAddress2'] = trim($_POST['txtDepartmentAddress2']);
					$_SESSION['txtDepartmentAddress3'] = trim($_POST['txtDepartmentAddress3']);
					$_SESSION['txtDepartmentAddress4'] = trim($_POST['txtDepartmentAddress4']);
					$_SESSION['txtEmail'] = trim($_POST['txtEmail']);
$newContac ="$_SESSION[txtDepartmentNumber]|$_SESSION[txtDepartmentName]|$_SESSION[selBranchNumber]|$_SESSION[txtDepertmentTP]|$_SESSION[txtDepartmentAddress]|$_SESSION[txtDepartmentAddress1]|$_SESSION[txtDepartmentAddress2]|$_SESSION[txtDepartmentAddress3]|$_SESSION[txtDepartmentAddress4]|$_SESSION[txtEmail]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `deparmentNumber`,`deparmentName`,`branchNumber`,`deparmentTP`,`deparmentAddress`,`deparmentAddress1`,`deparmentAddress2`,`deparmentAddress3`,`deparmentAddress4`,`deparmentEmail` FROM `deparment` WHERE deparmentNumber = '$_SESSION[txtDepartmentNumber]'";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]|$rec1[2]|$rec1[3]|$rec1[4]|$rec1[5]|$rec1[6]|$rec1[7]|$rec1[8]|$rec1[9]";
			 		}
					if($_SESSION['txtDepartmentNumber']!="" && $_SESSION['txtDepartmentName']!="" && $_SESSION['selBranchNumber']!="" && $_SESSION['txtDepertmentTP']!="" && $_SESSION['txtDepartmentAddress']!="" && $_SESSION['txtEmail']!=""){
							date_default_timezone_set('Asia/Colombo');
                        $addsql2="UPDATE deparment SET deparmentTP = '$_SESSION[txtDepertmentTP]', 
										               deparmentAddress = '$_SESSION[txtDepartmentAddress]', 
													   deparmentAddress1 = '$_SESSION[txtDepartmentAddress1]',
													   deparmentAddress2 = '$_SESSION[txtDepartmentAddress2]',
													   deparmentAddress3 = '$_SESSION[txtDepartmentAddress3]',
													   deparmentAddress4 = '$_SESSION[txtDepartmentAddress4]',    
													   deparmentEmail = '$_SESSION[txtEmail]',
                                                       modifiedBy='".$_SESSION['user']."',
                                                       modifiedDateTime =now(),
                                                       authoriedBy='".$_SESSION['user']."',
                                                       authoriedDateTime =now()
								  WHERE deparmentNumber = '$_SESSION[txtDepartmentNumber]'";
						$quary2 = mysqli_query($conn,$addsql2) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if(!$quary2){
							echo "<script> alert('Updated not success!');</script>";
							$_SESSION['txtDepartmentNumber'] = "";
							$_SESSION['txtDepartmentName'] = "";
							$_SESSION['selBranchNumber'] = "";
							$_SESSION['txtDepertmentTP'] = "";
							$_SESSION['txtDepartmentAddress'] = "";
							$_SESSION['txtDepartmentAddress1'] = "";
							$_SESSION['txtDepartmentAddress2'] = "";
							$_SESSION['txtDepartmentAddress3'] = "";
							$_SESSION['txtDepartmentAddress4'] = "";
							$_SESSION['txtEmail'] = "";
						}else{
							$table = "deparment";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtDepartmentNumber'] = "";
							$_SESSION['txtDepartmentName'] = "";
							$_SESSION['selBranchNumber'] = "";
							$_SESSION['txtDepertmentTP'] = "";
							$_SESSION['txtDepartmentAddress'] = "";
							$_SESSION['txtDepartmentAddress1'] = "";
							$_SESSION['txtDepartmentAddress2'] = "";
							$_SESSION['txtDepartmentAddress3'] = "";
							$_SESSION['txtDepartmentAddress4'] = "";
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
<input class="buttonManage" type="submit" name="btnDepartmentDelete" id="btnDepartmentDelete" value="Delete"/>
        <?php
			if(isset($_POST['btnDepartmentDelete']) && $_POST['btnDepartmentDelete']=='Delete'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtDepartmentNumber'] = trim($_POST['txtDepartmentNumber']);
					if($_SESSION['txtDepartmentNumber']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`deparment` WHERE `deparment`.`deparmentNumber` = '$_SESSION[txtDepartmentNumber]'";
						$quary13 = mysqli_query($conn,$addsql3) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));;
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtDepartmentNumber']="";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtDepartmentNumber']="";
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

 <div id="outer">
		
</div>
<div id="conten">
 <p class="topline">Search branch</p>
  
   <?php
   	$sql =  "SELECT `branchNumber`,`branchName` FROM `branch`";
	//echo $sql."<br/>"; 
	
	$sql_grid= mysqli_query($conn,$sql) or die(mysqli_error($conn));
    echo "<table class='tblsub' border='1'><tr>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Code</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Description</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td> </tr>";
					
	$a = 1 ;					
	while ($recs = mysqli_fetch_array($sql_grid)){
		if ($a==1){
			echo "<script>
					function branch(obj,title){
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						if(obj == 'btnselect'){ 
							var id1 = document.getElementById(m1).value;
							var id2 = document.getElementById(n1).value;
							document.getElementById('selBranchNumber').value = id1;
							document.getElementById('selBranchNumber1').value = id2;
						}else{
							alert('else my code');
						}
					} 
				</script>";
		}
			/*document.getElementById('".$OutputCode."').value = id1;*/
			/*echo "<script>alert(document.getElementById('".$OutputCode."').value);</script>";*/
     	
        echo "<tr style='background-color:#FFFFFF;'>";
        echo "<td style='width:200px;'><div style='display:none;'><input class='txt' type='text' name='txt".$a."' id='txt".$a."' value='".$recs[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txt".$a."' id='txt".$a."' value='".$recs[0]."' disabled='disabled'/></td>";
        echo "<td style='width:200px;'> <div style='display:none;'><input class='txt' type='text' name='txta".$a."' id='txta".$a."' value='".$recs[1]."'/></div>
                              <input style='width:200px;' type='text' name='txta".$a."' id='txta".$a."' value='".$recs[1]."' disabled='disabled'/></td>";
        echo "<td style='width:100px;'>";
        echo "<input type='button' style='font-size: 12px; margin-left:10px;'  id='btnselect' name='btnselect' title='txt".$a."|txta".$a."' value='Select' onclick='branch(this.id,title);popup(0);'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
   ?>
</div>
</form>
</body>
</html>