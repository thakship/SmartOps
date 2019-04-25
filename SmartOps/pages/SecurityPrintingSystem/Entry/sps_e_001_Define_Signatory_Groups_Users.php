<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Define Signatory Groups Users
Purpose			: This process will update SIG_GROUPS_USERS table.
Author			: Madushan Wikramaarachchi
Date & Time		: 08.52 A.M 21/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/001";
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
<title>Define Signatory Groups Users</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
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
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    function isChangeSig_Group(){
        var sel_drop = document.getElementById('sel_sgu_let_types').value;
        if(sel_drop != ""){
            var mydataSub;
			mydataSub= new XMLHttpRequest();
			mydataSub.onreadystatechange=function(){
				if(mydataSub.readyState==4){
					document.getElementById('spn_ajax_signatory_Group').innerHTML=mydataSub.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?spe_e_aj_let_type1="+sel_drop,true);
			mydataSub.send();
        }
    }
    
    function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
    
   	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			document.getElementById('txtUserName').value = id1;
			document.getElementById('span_userName').innerHTML = id2;
	}
    function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
    }
    
    function getGriedTable(){
        var val_sel_sps_let_types = document.getElementById('sel_sgu_let_types').value;
        var val_sel_sug_Signatory_Group = document.getElementById('sel_sug_Signatory_Group').value;
        if(val_sel_sps_let_types !=  "" && val_sel_sug_Signatory_Group != ""){
            var mydataSub1;
			mydataSub1 = new XMLHttpRequest();
			mydataSub1.onreadystatechange=function(){
				if(mydataSub1.readyState==4){
					document.getElementById('aaaa').innerHTML=mydataSub1.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub1.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?sps_e_let_types_01="+val_sel_sps_let_types+"&sqs_e_Signatory_Group_02="+val_sel_sug_Signatory_Group,true);
			mydataSub1.send();
        }
    }
    
    function isGetRecordGried(title){
        var abc = document.getElementById('txta'+title).value;
        var def = document.getElementById('txtb'+title).value;
        document.getElementById('txtUserName').value = abc;
        document.getElementById('span_userName').innerHTML = def;
    }
	 function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
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
            <select class="box_decaretion" name="sel_sgu_let_types" id="sel_sgu_let_types" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeSig_Group();">
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
        <td style="width: 150px; text-align: right;"><label class="linetop">Signatory Group :</label></td>
        <td>
            <span id="spn_ajax_signatory_Group">
                <select class="box_decaretion" name="sel_sug_Signatory_Group" id="sel_sug_Signatory_Group" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getGriedTable();">
                    <option value="">--Select Signatory Group--</option>
                </select>
            </span>
        </td>
    </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">User ID :</label></td>
    <td>
    	<input type="text" maxlength="8" class="box_decaretion" style=" width:100px;" name="txtUserName" id="txtUserName" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1);"  required="required" />
        <input type="button" class="buttonManage" style="width:50px;" id="btnPopUp" name="btnPopUp" value="..." onclick="popup(1);"/>
        <span id="span_userName" style="color: #AE0000;"></span>
    </td>
  </tr>
</table>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<div style="margin-left: 100px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnSave" id="btnSave" value="Save" title="1" onclick="isCheckFromDefineSignatoryGroupsUsers(title);"/>
<!--<input class="buttonManage" style="width: 100px;" type="button" name="btnModify" id="btnModify" value="Modify" title="2" onclick="isCheckFromDefineSignatoryGroupsUsers(title);"/> -->
<input class="buttonManage" style="width: 100px;" type="button" name="btnDelete" id="btnDelete" value="Delete" title="3" onclick="isCheckFromDefineSignatoryGroupsUsers(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="aaaa">
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>User ID</span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
        </tr>
        <tr id="tr1" title="1" onclick="isGetRecordGried(title);" onmouseover="isChangeRowColoerOver(title);" onmouseout="isChangeRowColoerDown(title);">
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txta1" id="txta1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
            <td style='width:500px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txtb1" id="txtb1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        </tr>
    </table>
</div>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>

