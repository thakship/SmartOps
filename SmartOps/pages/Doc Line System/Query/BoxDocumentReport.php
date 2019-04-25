<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Box Selecter
Purpose			: serching  Documnet with Box Number
Author			: Madushan Wikramaarachchi
Date & Time		: 11.52 A.M 2014/06/02
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/q/001";
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
<title>Documnet Report</title>
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
			alert("Combination of metaKey + " + keychar);
			metaChar = false;
		}else{
			//alert("Key pressed " + key);
		}
	}else{
		//alert("aaaasss " + key);  
		var V_boxNum = document.getElementById('txtBoxNumber').value;
		var mydataLoad;
		mydataLoad= new XMLHttpRequest();
		mydataLoad.onreadystatechange=function(){
			if(mydataLoad.readyState==4){
				document.getElementById('loadGrid').innerHTML=mydataLoad.responseText;
			}
		}
		mydataLoad.open("GET","ajax_BoxDocumentReport_01.php"+"?txtBoxNum="+V_boxNum,true);
		mydataLoad.send()
		
	}
}
//end Enter Key Function..............................................

function getprintCopy(){
		var prtContent = document.getElementById("loadGrid");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
  <tr>
    <td style="width:150px; text-align:right;"><p class="linetop">Box Number :</p></td>
    <td><input type="text" style="width:100px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtBoxNumber" name="txtBoxNumber" maxlength="9" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
</table>
<table>
    <td style="width: 50px;"><input type="submit" style="background-image: url(../../../img/pdf.png);background-repeat: no-repeat; width:30px; height:30px; border: #000000 solid 1px;" value="" name="getPDF" id="getPDF"/></td>
    <td><input class="buttonManage" type="button" style="width:100px;" value="PRINT" name="getprient" id="getprient" onclick="getprintCopy();"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<hr/>
<div id="loadGrid">
<table border="1" id="myTable"  style="width:725px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px;">Index</td>
        <td style="width:150px;">Document Number</td>
        <td style="width:300px;">Document Name</td>
        <td style="width:150px;">Documnet Type</td>
        <td style="width:75px;">Action Stat</td>
    </tr>
</table>
</div>
<?php
if(isset($_POST['getPDF'])){
	$title = "Box Report";//report name
	$d1 = "Box Number                : ".trim($_POST['txtBoxNumber']);//Other information
	$tableget = "rank,15,Rank|doc_number,50,Document Number|doc_name,80,Document Name|doc_stat,50,Document Type|acaunt_Stat,50,Current Status";//must want to table
	$sql = "SELECT @rownum := @rownum %PLUS% 1 AS rank, `doc_line_file_stack`.`doc_number`, `doc_line_doc_mast`.`doc_name`, if( `doc_line_file_stack`.`doc_type`='RD','Reference Only','Security Only' ) AS doc_stat, if(`doc_line_file_stack`.`action_stat`='LD','Loaded',if(`doc_line_file_stack`.`action_stat`='ST','Dispatched',if(`doc_line_file_stack`.`action_stat`='RQ','Requested',if(`doc_line_file_stack`.`action_stat`='RC','Received',if(`doc_line_file_stack`.`action_stat`='RF','Forward','None'))))) AS acaunt_Stat FROM `doc_line_file_stack`,`doc_line_doc_mast` ,(SELECT @rownum := 0) r WHERE `box_number`='".trim($_POST['txtBoxNumber'])."' AND `doc_line_file_stack`.`doc_number` = `doc_line_doc_mast`.`doc_number`";
	
	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}
?>

</form>
</body>
</html>