<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Document Status Selecter
Purpose			: serching  Documnet in It is history
Author			: Madushan Wikramaarachchi
Date & Time		: 08.42 A.M 2014/06/03
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/q/002";
	$_SESSION['Module'] = "Doc Line System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
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
<title>Document Status Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>

<!-- Starts CDB User defined function here -->
<script type="text/javascript">
//Check Selection Function in Document number(s) or Box number(s)
//function Select Box number Using Enter key..........................................
var metaChar = false;
var exampleKey = 13;

function keyEvent(event) {
	var key = event.keyCode || event.which;
	var keychar = String.fromCharCode(key);
	if(key == exampleKey){
		metaChar = true;
	}
	if(key != exampleKey){
		if(metaChar){
			metaChar = false;
		}else{
			//alert("Key pressed " + key);
		}
	}else{
		//alert("aaaasss " + key);  
		var V_docNum = document.getElementById('txtDocNumber').value;
		var V_docType = document.getElementById('selDocType').value;
		var mydataLoad;
		mydataLoad= new XMLHttpRequest();
		mydataLoad.onreadystatechange=function(){
			if(mydataLoad.readyState==4){
				document.getElementById('loadGrid').innerHTML=mydataLoad.responseText;
			}
		}
		mydataLoad.open("GET","ajax_DocumentHistroty_01.php"+"?txtdocNum="+V_docNum+"&txtDocStat="+V_docType,true);
		mydataLoad.send();
		
	}
}
//end Enter Key Function..............................................
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p>
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
  <tr>
    <td style="width:150px; text-align:right;"><p class="linetop">Document Number :</p></td>
    <td><input type="text" style="width:180px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtDocNumber" name="txtDocNumber" maxlength="23" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/></td>
    <td style="width:150px; text-align:right;"><p class="linetop">Document Selection :</p></td>
    <td><select name="selDocType" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selDocType" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="BO">Both</option>
            <option value="RD">Reference Only</option>
            <option value="SD">Security Only</option>
         </select>
    </td>
  </tr>
  <tr>
    <td><input type="submit" style="background-image: url(../../../img/pdf.png);background-repeat: no-repeat; width:30px; height:30px; border: #000000 solid 1px;" value="" name="getPDF" id="getPDF"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>
<hr/>
<div id="loadGrid">
<table border="1" id="myTable"  style="width:1125px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px;">Index</td>
        <td style="width:100px;">Box Number</td>
        <td style="width:150px;">Document Number</td>
        <td style="width:300px;">Document Name</td>
        <td style="width:150px;">Documnet Type</td>
        <td style="width:100px;">Action Date & Time</td>
        <td style="width:75px;">Action Stat</td>
        <td style="width:100px;">Action User</td>
        <td style="width:100px;">Purpose</td>
    </tr>
</table>
<div style='display:none;'>
	<input type="text" name="txtDocname" id="txtDocname" value="0"/>
</div>
</div>
<?php
if(isset($_POST['getPDF'])){
	$title = "Document Histroy Report";//report name
	$d1 = "Document                   : ".trim($_POST['txtDocNumber'])." - ".trim($_POST['txtDocname']);//Other information
	$tableget = "rank,15,Rank|box_number,50,Box Number|doc_stat,50,Document Type|action_date_time,30,Action Date|acaunt_Stat,50,Action Status|action_user,30,Action User|PPNAME,50,Perpas";//must want to table
	if(trim($_POST['selDocType'])!="NULL")
		$sql ="SELECT @rownum := @rownum %PLUS% 1 AS rank,`doc_line_stat_history`.`box_number`,`doc_line_stat_history`.`doc_number`, if( `doc_line_stat_history`.`doc_type`='RD','Reference Only','Security Only' ) AS doc_stat, DATE(`doc_line_stat_history`.`action_date_time`) as action_date_time, if(`doc_line_stat_history`.`action_stat`='LD','Loaded',if(`doc_line_stat_history`.`action_stat`='ST','Dispatched',if(`doc_line_stat_history`.`action_stat`='RQ','Requested',if(`doc_line_stat_history`.`action_stat`='RC','Received',if(`doc_line_stat_history`.`action_stat`='RF','Forward','None'))))) AS acaunt_Stat, `doc_line_stat_history`.`action_user`,(SELECT `doc_line_perpase_requst`.`parpas_value` FROM `doc_line_perpase_requst` WHERE `doc_line_perpase_requst`.`perpas_code` = `doc_line_stat_history`.`perpas_code`) AS PPNAME FROM `doc_line_stat_history`,(SELECT @rownum := 0) r WHERE `doc_line_stat_history`.`doc_number` = '".trim($_POST['txtDocNumber'])."' AND `doc_line_stat_history`.`doc_type`".  (trim($_POST['selDocType'])=="BO" ?  " like '%'" :  " ='".trim($_POST['selDocType'])."'" )." ORDER BY `doc_line_stat_history`.`action_date_time`";
	else
		echo "<script> alert('Required information missing!'); </script>";

	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}
?>

</form>
</body>
</html>