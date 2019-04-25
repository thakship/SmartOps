<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Help Desk Category Management
Purpose			: To create user Category for Help Desk
Author			: Madushan Wikramaarachchi
Date & Time		: 01.12 P.M 02/02/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/m/002";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Courier Day Receive  Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
  
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}
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
    var idValue = document.getElementById("txtCategoryCode").value;
    var myRandom = parseInt(Math.random()*99999999);  // cache buster
    http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&rand=" + myRandom, true);
    http.onreadystatechange = handleHttpResponse;
    http.send(null);
 	function handleHttpResponse(){
    	if (http.readyState == 4){
        	results = http.responseText.split(",");
            document.getElementById('txtCategoryCode').value = results[0].trim();
            document.getElementById('txtCategoryName').value = results[1].trim();
        }
    } 
}
</script>
<style type="text/css">
    #getDivDEF{
        width: 800px;
        height: 300px;
        overflow-y: scroll;
    }
</style>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>

<table>
  <tr>
    <td style="width: 120px;"><label class="linetop">Category Code :</label></td>
    <td>
    	<input type="text" class="box_decaretion" style="width:100px;" name="txtCategoryCode" id="txtCategoryCode" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" onKeyUp="ajaxFunction(event)" onKeyUp="ajaxFunction(event)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 120px;"><label class="linetop">Category Name :</label></td>
    <td>
    	<input type="text" class="box_decaretion" style="width:200px; " name="txtCategoryName" id="txtCategoryName" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required="required"/>
    </td>
  </tr>
</table>
<br />
<table>
   <tr>
    <td style="width: 120px;"></td>
    <td>
        <input class="buttonManage" style="width: 100px;" type="submit" name="btnCategorySave" id="btnCategoryModuleSave" value="Save"/>
        <input class="buttonManage" style="width: 100px;" type="submit" name="btnCategoryUpdate" id="btnCategoryUpdate" value="Update"/>
        <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
  </td>
  </tr>
</table>
<hr/>
<div id="getDivDEF">
<?php
        $getsql = "SELECT `cat_code`, `cat_discr` FROM `cat_states`";
     commenTable($conn,$getsql);
?>
</div>
 <?php
 
	if(isset($_POST['btnCategorySave']) && $_POST['btnCategorySave']=='Save'){
		// Set autocommit to off
		mysqli_autocommit($conn,FALSE);
		try{
			if(trim($_POST['txtCategoryCode'])!="" && trim($_POST['txtCategoryName'])!=""){
				$sql_insert="INSERT INTO `cat_states`(`cat_code`, `cat_discr`, `car_state`) VALUES ('".trim($_POST['txtCategoryCode'])."','".trim($_POST['txtCategoryName'])."',1);";
				$query_Insert = mysqli_query($conn,$sql_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));;
				if($query_Insert){
					echo "<script> alert('Record Saved!');</script>";
                    echo "<script>pageClose();</script>";
				}else{
					echo "<script> alert('Record not saved!');</script>";
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
    
    if(isset($_POST['btnCategoryUpdate']) && $_POST['btnCategoryUpdate']=='Update'){
		// Set autocommit to off
		mysqli_autocommit($conn,FALSE);
		try{
			if(trim($_POST['txtCategoryCode'])!="" && trim($_POST['txtCategoryName'])!=""){
				$sql_Update="UPDATE `cat_states` SET `cat_discr`='".trim($_POST['txtCategoryName'])."' WHERE `cat_code`='".trim($_POST['txtCategoryCode'])."';";
				$query_Update = mysqli_query($conn,$sql_Update) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));;
				if($query_Update){
					echo "<script> alert('Record Update!');</script>";
                    echo "<script>pageClose();</script>";
				}else{
					echo "<script> alert('Record not Update!');</script>";
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
</form>
</body>
</html>