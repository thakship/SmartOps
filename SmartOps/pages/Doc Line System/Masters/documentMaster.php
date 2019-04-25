<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Document Master 
Purpose			: To Create and manage Documen Master	
Author			: Madushan Wikramaarachchi
Date & Time		: 9:06 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/m/002";
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
<title>Document Master</title>
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
			var url = "getagentids.php?param2=";
            var idValue = document.getElementById("txtDocMaster").value;
				var myRandom = parseInt(Math.random()*99999999);  // cache buster
				http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&rand=" + myRandom, true);
				http.onreadystatechange = handleHttpResponse;
				http.send(null);
				function handleHttpResponse(){
					if (http.readyState == 4){
						results = http.responseText.split(",");
						document.getElementById('txtDocMaster').value = results[0].trim();
						document.getElementById('txtDocName').value = results[1].trim();
						if(results[0].trim()==""){
							document.getElementById('txtDocMaster').value = idValue;	
						}
					}
				}
		}
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script> 
</head>
<body oncontextmenu="return false">
<form action="" method="post">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];	
?>
<hr />
<table>
  <tr>
    <td style="width:150px;"><p class="linetop">Document Number :</p></td>
    <td>
    	<input type="text" class="box_decaretion" style="width:150px;" maxlength="20" name="txtDocMaster" id="txtDocMaster" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Document Name :</p></td>
    <td>
    	<input type="text" class="box_decaretion" style=" width:300px;" maxlength="100" name="txtDocName" id="txtDocName" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width:150px;"><p class="linetop">Prodact Name :</p></td>
    <td>
    	<select class="box_decaretion" name="selProdactName" id="selProdactName" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" required="required">
            <option value="Deposit Box File">Deposit Box File</option>
            <option value="Savings Box File">Savings Box File</option>
            <option value="Card Centre Box File">Card Centre Box File</option>
            <option value="IT Box File">IT Box File</option>
        </select>
    </td>
  </tr>
</table>
<br />
<input type="submit" name="btnDocMasterSave" id="btnDocMasterSave" value="Save"/>
        <?php
			if(isset($_POST['btnDocMasterSave']) && $_POST['btnDocMasterSave']=='Save'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
					if($_POST['txtDocMaster']!="" && $_POST['txtDocName']!=""){
						date_default_timezone_set('Asia/Colombo');
						$addsq1="INSERT INTO `doc_line_doc_mast`(`doc_number`, `doc_name`, `prod_name`, `acc_type`, `scheme`, `TP`, `STAT`, `SYNC_DATE`, `INTERNAL_NO`, `CONTNO`) VALUES ('".trim($_POST['txtDocMaster'])."','".trim($_POST['txtDocName'])."','".trim($_POST['selProdactName'])."','','','','',now(),'','')";
						$query1= mysqli_query($conn,$addsq1)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						if($query1){
							echo "<script> alert('Record Saved!');</script>";
                            echo "<script> pageClose();</script>";
                           
						}else{
							echo "<script> alert('<Document Number> already exists. Record not saved!');</script>";
							echo "<script>
								var elem = document.getElementById('txtDocMaster');
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
 <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>