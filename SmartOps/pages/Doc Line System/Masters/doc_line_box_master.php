<?php
	session_start();
	$_SESSION['page']="doc/m/001";
	$_SESSION['Module'] = "Doc Line System";
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
<title>Box Type Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.disebleBox{ 
		background-color: #EBEBEB;
		font-family:Arial, Helvetica, sans-serif; 
		border: 1px solid #000000;
	}
	
</style>
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
			var url = "getagentids.php?param1=";
            var idValue = document.getElementById("txtBoxMaster").value;
				var myRandom = parseInt(Math.random()*99999999);  // cache buster
				http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&rand=" + myRandom, true);
				http.onreadystatechange = handleHttpResponse;
				http.send(null);
				function handleHttpResponse(){
					if (http.readyState == 4){
						results = http.responseText.split(",");
						document.getElementById('txtBoxMaster').value = results[0].trim();
						document.getElementById('txtBoxOpenedDate').value = results[1].trim();
						document.getElementById('txtBoxOpenedBy').value = results[2].trim();
						document.getElementById('txtBoxClosedDate').value = results[3].trim();
						document.getElementById('txtBoxClosedBy').value = results[4].trim();
						document.getElementById('txtBoxDispatchedDate').value = results[5].trim();
						document.getElementById('txtBoxDispatchedBy').value = results[6].trim();
						if(results[0].trim()==""){
							document.getElementById('txtBoxMaster').value = idValue;	
						}
					}
				}
		}
		function codeID1(setID){
			var num = /^([0-9])+$/;
			if(!document.getElementById(setID).value.match(num)){
				alert("Only numbers are allowed !");
				document.getElementById(setID).value ="";
				return false;
			}
			return true;
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		var metaChar = false;
		var exampleKey = 13;

		function keyEvent(event) {
			  var key = event.keyCode || event.which;
			  var keychar = String.fromCharCode(key);
			  if (key == exampleKey) {
				metaChar = true;
			  }
			  if (key != exampleKey) {
					if (metaChar) {
					  alert("Combination of metaKey + " + keychar);
					  metaChar = false;
					} else {
					  //alert("Key pressed " + key);
					}
			  }else{
					 var getVal = document.getElementById("txtBoxMaster").value;
					 //alert("aaaaa"+getVal);
					 if(getVal == ""){
					 	document.getElementById('txtBoxMaster').value = "";
						document.getElementById('txtBoxOpenedDate').value = "";
						document.getElementById('txtBoxOpenedBy').value ="";
						document.getElementById('txtBoxClosedDate').value = "";
						document.getElementById('txtBoxClosedBy').value = "";
						document.getElementById('txtBoxDispatchedDate').value = "";
						document.getElementById('txtBoxDispatchedBy').value = "";					 
					 }
			  }
		 }
		 function metaKeyUp (event) {
		  var key = event.keyCode || event.which;
		  if (key == exampleKey) {
			metaChar = false;
		  }
		}
</script> 
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" title="txtBoxMaster" onsubmit="return codeID1(title);" >
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];	
?><hr />
</p>
<table>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Number :</p></td>
    <td>
    	<input type="text" style=" width:80px;font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" maxlength="9" name="txtBoxMaster" id="txtBoxMaster" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Opened Date :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:80px;" name="txtBoxOpenedDate" id="txtBoxOpenedDate" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled"/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Opened By :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:150px;" name="txtBoxOpenedBy" id="txtBoxOpenedBy" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled"/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Closed Date :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:80px;" name="txtBoxClosedDate" id="txtBoxClosedDate" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled"/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Closed By :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:150px;" name="txtBoxClosedBy" id="txtBoxClosedBy" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled"/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Dispatched Date :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:80px;" name="txtBoxDispatchedDate" id="txtBoxDispatchedDate" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled"/>
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Box Dispatched By :</p></td>
    <td>
    	<input type="text" class="disebleBox" style=" width:150px;" name="txtBoxDispatchedBy" id="txtBoxDispatchedBy" value="" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" disabled="disabled" />
    </td>
  </tr>
</table><br />
    	<input type="submit" name="btnBoxMasterSave" id="btnBoxMasterSave" value="Save"/>
        <?php
			if(isset($_POST['btnBoxMasterSave']) && $_POST['btnBoxMasterSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBoxMaster'] = trim($_POST['txtBoxMaster']);
					if($_SESSION['txtBoxMaster']!=""){
						date_default_timezone_set('Asia/Colombo');
						$addsq1="INSERT INTO `doc_line_box_mast`(`box_number`, `box_opn_date`, `box_opn_by`, `branch` , `department`) VALUES ('$_SESSION[txtBoxMaster]',now(),'$_SESSION[user]' ,'$_SESSION[userBranch]','$_SESSION[userDepartment]')";
						$query1 = mysqli_query($conn,$addsq1);
						if($query1){
							echo "<script> alert('Record Saved!');</script>";
							$_SESSION['txtBoxMaster'] = "";
                            echo "<script> pageClose();</script>";
                           
						}else{
							echo "<script> alert('<Box Number> already exists. Record not saved!');</script>";
							echo "<script>
								var elem = document.getElementById('txtBoxMaster');
								if(elem != null) {
									if(elem.createTextRange) {
										var range = elem.createTextRange();
										range.move('character', caretPos);
										range.select();
									}
									else {
										if(elem.selectionStart) {
											elem.focus();
											elem.setSelectionRange(caretPos, caretPos);
										}
										else
											elem.focus();
									}
								}
							</script>";
						}
					}else{
						echo "<script> alert('Please enter complete details!');</script>";
						
					}
					// Commit transaction
					mysqli_commit($conn);
  				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
				    echo 'Message: '.$e->getMessage();
 				}
			}
		?>
        <input type="submit" name="btnModuleDelete" id="btnModuleDeletee" value="Delete"/>
        <?php
			 if(isset($_POST['btnModuleDelete']) && $_POST['btnModuleDelete']=="Delete" ){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					$_SESSION['txtBoxMaster'] = trim($_POST['txtBoxMaster']);
					if($_SESSION['txtBoxMaster']!=""){
						$addsql3 = "DELETE FROM `cdberp`.`doc_line_box_mast` WHERE `doc_line_box_mast`.`box_number` = '$_SESSION[txtBoxMaster]'";
						$quary13 = mysqli_query($conn,$addsql3);
						if(!$quary13){
							echo "<script> alert('Deleted not success!');</script>";
							$_SESSION['txtBoxMaster'] = "";
						}else{
							echo "<script> alert('Deleted success!');</script>";	
							$_SESSION['txtBoxMaster'] = "";
                            echo "<script> pageClose();</script>";
						}
					}else{
						echo "<script> alert('Enter Box Master !');	</script>";
					}
					// Commit transaction
					mysqli_commit($conn);
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: '.$e->getMessage();
				}
			 }	
		?>
        <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        
</form>
</body>
</html>