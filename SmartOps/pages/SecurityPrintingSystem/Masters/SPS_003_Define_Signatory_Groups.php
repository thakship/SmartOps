<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Define Signatory Groups
Purpose			: This process allows to define signatory groups.
Author			: Madushan Wikramaarachchi
Date & Time		: 08.52 A.M 20/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/m/003";
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
<title>Define Signatory Groups</title>
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
    function isChangeDropDown(){
        var val_drop = document.getElementById('sel_sps_let_types').value;
        if(val_drop != ""){
            var mydataSub;
			mydataSub= new XMLHttpRequest();
			mydataSub.onreadystatechange=function(){
				if(mydataSub.readyState==4){
					document.getElementById('aaaa').innerHTML=mydataSub.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?sgp_sps_let_types_01="+val_drop,true);
			mydataSub.send();
        }
    }
    
    function isGetRecordGried(title){
        var abc = document.getElementById('txta'+title).value;
        var def = document.getElementById('txtb'+title).value;
        document.getElementById('txtGroupCode').value = abc;
        document.getElementById('txtGroupName').value = def;
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
    <td style="width: 150px; text-align: right;"><label class="linetop">Letter Type Code :</label></td>
    <td>
    	 <?php
    		$sql_sps_let_types = "SELECT `TYPE_CODE`, `TYPE_DESC` FROM `sps_let_types`;";
            $quary_sps_let_types = mysqli_query($conn,$sql_sps_let_types);
        ?>
        <select class="box_decaretion" name="sel_sps_let_types" id="sel_sps_let_types" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeDropDown()">
        <option value="">--Select Letter Type--</option>
        <?php
            while ($rec_sps_let_types = mysqli_fetch_array($quary_sps_let_types)) {
                echo "<option value='".$rec_sps_let_types[0]."'>".$rec_sps_let_types[1]."</option>";
            }
        ?>
        </select>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Signatory Group Code :</label></td>
    <td>
    	<input type="text" maxlength="3" class="box_decaretion" style=" width:80px;" name="txtGroupCode" id="txtGroupCode" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"  required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Signatory Group Name :</label></td>
    <td>
    	<input type="text" maxlength="30" class="box_decaretion" style=" width:400px;" name="txtGroupName" id="txtGroupName" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
    </td>
  </tr>
</table>
<div style="display: none;">
    <input type="text" id="txtUserID" name="txtUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<div style="margin-left: 100px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnSave" id="btnSave" value="Save" title="1" onclick="isCheckFromDefineSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnModify" id="btnModify" value="Modify" title="2" onclick="isCheckFromDefineSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnDelete" id="btnDelete" value="Delete" title="3" onclick="isCheckFromDefineSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="aaaa">
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Sig. Group Code</span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>Sig. Group Name</span></td>
        </tr>
        <tr style='background-color: #FFFFFF;' title="1" onclick="isGetRecordGried(title);">
            <td style='width:100px; text-align: left;'><input type="text" maxlength="3" style=" width:100px;" name="txta1" id="txta1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></td>
            <td style='width:500px; text-align: left;'><input type="text" maxlength="30" style=" width:500px;" name="txtb1" id="txtb1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></td>
        </tr>
    </table>
</div>
</form>
</body>
</html>

