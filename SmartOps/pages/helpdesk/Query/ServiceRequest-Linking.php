<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request - Linking 
Purpose			: To viwe Service request Linking
Author			: Madushan Wikramaarachchi
Date & Time		: 09.40 A.M 13/12/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/011";
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
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/contextMenu.js-master/contextMenu.min.js"></script>

<!--END Common fumction Libariries-->
<style type="text/css">
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
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>

function getLinkID(){
    var getHI = document.getElementById('txt_HelpID').value;
    var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('maneSpan').innerHTML=mydata.responseText;           
        }
    }
    
    mydata.open("GET","Ajax_ServiceRequest-Linking.php"+"?getPerantHelpID="+getHI,true);
    mydata.send();
}

function selcect_helpID_delels(title){
    //alert("A");
    //alert(title);
    var getHI = document.getElementById('txt_HelpID').value;
    var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('getDTLGRIED').innerHTML=mydata.responseText;           
        }
    }
    //getHelpIDCloaseREquest
    mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDLooping="+title,true);
    mydata.send();
       
}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
    <tr>
        <td style="width: 100px; text-align: right;"><label class="linetop">Help ID :</label></td>
        <td style="width: 150px;">
            <input class="box_decaretion" type="text" name="txt_HelpID" id="txt_HelpID" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
        </td>
        <td>
           <input type="button" style="width: 100px;" class="buttonManage" value="Select" id="btn_select" name="btn_select" onclick="getLinkID()" />
        </td>
    </tr>
</table>
<hr />

<span id="maneSpan">


</span>
<div style="display: none;">
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
    <input type="text" name="userBranch" id="userBranch" value="<?php echo  $_SESSION['userBranch']; ?>" />
    <input type="text" name="userDepartment" id="userDepartment" value="<?php echo  $_SESSION['userDepartment']; ?>" />
    
</div>


<span id="getGried"></span>
<br />
<hr />
<span id="getDTLGRIED"></span>
</form>
</body>
</html>
