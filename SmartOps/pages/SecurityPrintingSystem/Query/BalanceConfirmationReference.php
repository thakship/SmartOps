<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Balance Confirmation Reference
Purpose			: printed letter viwe
Author			: Madushan Wikramaarachchi
Date & Time		: 03.17 P.M 25/05/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/q/002";
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
<title>Security Printing Authorization</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    
    function isRequest(title){
        var v_referenceNumber = document.getElementById('txtReferenceNumber').value;
        
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajax_BalanceConfirmationReference.php"+"?get_referenceNumber="+v_referenceNumber,true);
        mydata.send();
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
        <td style="width: 150px; text-align: right;"><label class="linetop">Reference Number:</label></td>
        <td>
            <input type="text" class="box_decaretion" style=" width:250px;" name="txtReferenceNumber" id="txtReferenceNumber" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
    </tr>
</table>
<br />
<div style="margin-left: 50px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isRequest();"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="aaaa">

</div>
</form>
</body>
</html>

