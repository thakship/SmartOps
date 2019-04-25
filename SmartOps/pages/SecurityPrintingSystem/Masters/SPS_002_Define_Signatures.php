<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Define Signatures
Purpose			: This process allows to link scanned signature images with system users.
Author			: Madushan Wikramaarachchi
Date & Time		: 10.10 A.M 09/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/m/002";
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
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Define Signatures</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    function previewFile(){ // Function for PreviwImge in div
        var preview = document.querySelector('img'); //selects the query named img
        var file    = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader  = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if(file){
            reader.readAsDataURL(file); //reads the data as a URL
        }else{
            preview.src = "";
        }
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
        var val_UserID = document.getElementById('txtUserID').value;
        $.ajax({ 
			type:'POST', 
			data: {get_Define_Signatures_User_ID : val_UserID}, 
			url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
			success: function(val_retn) { 
                document.getElementById('lblUserName').innerHTML = val_retn;
			}
		});
            
    }

</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">User ID :</label></td>
    <td>
    	<input type="text" maxlength="8" class="box_decaretion" style=" width:80px;" name="txtUserID" id="txtUserID" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)"  required="required" />
        <label id="lblUserName" style="color: #970000;"></label>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">User Name:</label></td>
    <td>
    	<input type="text" maxlength="100" class="box_decaretion" style="width:300px;" name="txtUserName" id="txtUserName" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">User Designation:</label></td>
    <td>
    	<input type="text" maxlength="80" class="box_decaretion" style="width:200px;" name="txtUserDesignation" id="txtUserDesignation" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Signature :</label></td>
    <td>
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
        <input type="file" name="fileSignature" id="fileSignature" value="Browse.." onchange="previewFile()" />
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop"></label></td>
    <td>
        <div id="divSignature" style="width: 300px; height: 150px; border: #000000 solid 1px; background-color: #E6E6E6;">
            <img src="" style="width: 300px; height: 150px;" alt="Image preview..." />
        </div>
    </td>
  </tr>
</table>
<br />
<div style="margin-left: 100px;">
    <input class="buttonManage" style="width: 100px;" type="submit" name="btnAdd" id="btnAdd" value="Save"/>
    <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<?php
    if(isset($_POST['btnAdd']) && $_POST['btnAdd']=='Save'){
        // Set autocommit to off
        mysqli_autocommit($conn,FALSE);
        try{
            if($_FILES["fileSignature"]["name"] == ""){
                echo "<script> alert('Please select a file.');</script>";
            }else if($_POST['txtUserID'] == ""){
                echo "<script> alert('Missing User ID.');</script>";
            }else if($_POST['txtUserDesignation'] == ""){
                echo "<script> alert('Missing User Designation.');</script>";
            }else if($_POST['txtUserName'] == ""){
                echo "<script> alert('Missing User name for print.');</script>";
            }else{
                $sqli_User = "SELECT COUNT(*) FROM `user` WHERE `userName` = '".$_POST['txtUserID']."';";
                $q_User =  mysqli_query($conn, $sqli_User) or die(mysqli_error());
                while($res_User  = mysqli_fetch_array($q_User)){
                    $u_na = $res_User[0];
                }
                if($u_na != 0){
                    date_default_timezone_set('Asia/Colombo');
                    $tmpName = $_FILES['fileSignature']['tmp_name'];
                    // Read the file
                    $fp = fopen($tmpName, 'r');
                    $data = fread($fp, filesize($tmpName));
                    $data = addslashes($data);
                    fclose($fp);
                    
                    $sql_count = "SELECT count(*) FROM `sps_sig_mast` WHERE `USER_ID` = '".$_POST['txtUserID']."';";
                    $query_count = mysqli_query($conn, $sql_count);
                    $x = 1;
                    while($res_count = mysqli_fetch_array($query_count)){
                        if($res_count[0] != 0){
                             $sql_update = "UPDATE `sps_sig_mast` 
                                            SET `EXP_DATE`= now(),`EXP_DATE_TIME`= now() 
                                            WHERE `USER_ID` = '".$_POST['txtUserID']."' AND `EXP_DATE` = '0000-00-00' AND `EXP_DATE_TIME` = '0000-00-00 00:00:00';";
                             $q_Update = mysqli_query($conn,$sql_update) or die(mysqli_error());
                        }
                        $x += $res_count[0];
                        $sql_Insert = "INSERT INTO `sps_sig_mast`(`USER_ID`, `EFF_DATE`, `DAY_SEQ`, `EXP_DATE`, `SIG_IMG`, `EFF_DATE_TIME`, `EXP_DATE_TIME`, `ENTERED_BY`, `ENTERED_DATE` , `designation`, `sig_name`) 
                                    VALUES ('".$_POST['txtUserID']."',now(),'".$x."','','".$data."',now(),'','".$_SESSION['user']."',now() , '".$_POST['txtUserDesignation']."', '".$_POST['txtUserName']."');";
                        $q_Insert = mysqli_query($conn, $sql_Insert) or die(mysqli_error());
                        
                        if(!$q_Insert){
                           echo "<script> alert('Record Not Saved.');</script>"; 
                        }else{
                           echo "<script> alert('Record Saved Success.');</script>"; 
                        }
                        
                    }
                }else{
                    echo "<script> alert('User ID is not in Database.');</script>";
                }
                
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
</form>
</body>
</html>

