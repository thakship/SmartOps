<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier System Management
Purpose			: To controling Courier System Management
Author			: Madushan Wikramaarachchi
Date & Time		: 02.26 P.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/007";
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
<title>Courier System Management</title>
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
		var url = "getagentids.php?param3=";
		var idValue = document.getElementById("txtAdminID1").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param3=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
				document.getElementById('txtAdminID1').value = results[0].trim();
				document.getElementById('txtAdminID').value = results[1].trim();
				document.getElementById('txtCourierVersion').value = results[2].trim();
				document.getElementById('txtSMTPServer').value = results[3].trim();
				document.getElementById('txtPort').value = results[4].trim();
				document.getElementById('txtSMSGate').value = results[5].trim();
			}
		} 
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
	function chak(){
		var num = /^([0-9])+$/;
		if(!document.getElementById('txtPort').value.match(num)){
			alert("Plase only enter only number");
			document.getElementById('txtPort').value ="";
			return false;
		}
		return true;
	}
</script> 
<style type="text/css">
	.tblsub{
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
    <td style="width:150px;"><label class="linetop">Admin ID :</label></td>
    <td>
  <div style='display:none;'>
   <input type="text" style=" width:200px;" name="txtAdminID" id="txtAdminID" value=""  onKeyPress="return disableEnterKey(event)"  required/>
   </div>
   <input class="box_decaretion" type="text" style=" width:200px;" name="txtAdminID1" id="txtAdminID1" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyUp="ajaxFunction(event)" onclick="popup(1)" required/>
   </td>
  </tr>
  <tr>
    <td style="width:150px;"><label class="linetop">Courier Version :</label></td>
    <td>
    	<input class="box_decaretion" type="text" style=" width:250px;" name="txtCourierVersion" id="txtCourierVersion" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onKeyPress="return disableEnterKey(event)"/>
    </td>
  </tr>
</table>
<table>
	<tr>
    	 <td style="width:150px;"><label class="linetop">SMTP Server :</label></td>
    <td>
   			<input class="box_decaretion" type="text" style="width:200px;" name="txtSMTPServer" id="txtSMTPServer" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"   onKeyPress="return disableEnterKey(event)"/>
   </td>
    <td style="width:75px;"><label class="linetop" style="margin-left:20px;">Port :</label></td>
    <td>
   <input class="box_decaretion" type="text" style="width:150px;" name="txtPort" id="txtPort" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
   </td>
    </tr>
</table>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">SMS Gate :</label></td>
    <td>
    	 <input class="box_decaretion" type="text" style=" width:200px;" name="txtSMSGate" id="txtSMSGate" value=""  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
    </td>
  </tr>
</table>
<br/>
<input class="buttonManage" type="submit" name="btnDGUpdate" id="btnDGUpdate" value="Update"/>
        <?php
			if(isset($_POST['btnDGUpdate']) && $_POST['btnDGUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtAdminID'] = trim($_POST['txtAdminID']);
					$_SESSION['txtCourierVersion'] = trim($_POST['txtCourierVersion']);
					$_SESSION['txtSMTPServer'] = trim($_POST['txtSMTPServer']);
					$_SESSION['txtPort'] = trim($_POST['txtPort']);
					$_SESSION['txtSMSGate'] = trim($_POST['txtSMSGate']);
					$newContac = "$_SESSION[txtAdminID]|$_SESSION[txtCourierVersion]|$_SESSION[txtSMTPServer]|$_SESSION[txtPort]|$_SESSION[txtSMSGate]";
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					date_default_timezone_set('Asia/Colombo');
					$selec = "SELECT `adminID`,`sysVersion`,`SMTP`,`port`,`smsGate` FROM `courier_systemadmin`";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
						$concat = "$rec1[0]|$rec1[1]|$rec1[2]|$rec1[3]|$rec1[4]";
			 		}
					if($_SESSION['txtAdminID']!=""){
						date_default_timezone_set('Asia/Colombo');
						$sqlUpdate = "UPDATE `courier_systemadmin` SET  `adminID`= '$_SESSION[txtAdminID]',`sysVersion`='$_SESSION[txtCourierVersion]',`SMTP`='$_SESSION[txtSMTPServer]',`port`='$_SESSION[txtPort]',`smsGate`='$_SESSION[txtSMSGate]',`modifiedBy`='$_SESSION[user]',`modifiedDateTime`= now(),`authoriedBy`='$_SESSION[user]',`authoriedDateTime`= now() WHERE `index`='1'";
						$quaryUpdate = mysqli_query($conn,$sqlUpdate) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						
						if(!$quaryUpdate){
							echo "<script> alert('Updated not success!');</script>";
							$_SESSION['txtAdminID'] = "";
							$_SESSION['txtCourierVersion'] = "";
							$_SESSION['txtSMTPServer'] = "";
							$_SESSION['txtPort'] = "";
							$_SESSION['txtSMSGate'] = "";
						}else{
							$table = "courier_systemadmin";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
							echo "<script> alert('Updated success!');</script>";
							$_SESSION['txtAdminID'] = "";
							$_SESSION['txtCourierVersion'] = "";
							$_SESSION['txtSMTPServer'] = "";
							$_SESSION['txtPort'] = "";
							$_SESSION['txtSMSGate'] = "";
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
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div id="outer">
		
</div>
<div id="conten">
 <p class="topline">Search User</p>
   <?php
   	$sql =  "SELECT `userName`,`userID` FROM `user`";
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
							document.getElementById('txtAdminID1').value = id1;
							document.getElementById('txtAdminID').value = id2;
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
        echo "<input class='buttonManage' type='button' id='btnselect' name='btnselect' title='txt".$a."|txta".$a."' value='Select' onclick='branch(this.id,title);popup(0);'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
   ?>
</div>
</form>
</body>
</html>