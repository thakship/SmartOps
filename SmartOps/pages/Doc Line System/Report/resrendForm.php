<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Resend Form
Purpose			: get document for Resent Document
Author			: Madushan Wikramaara
Date & Time		: 9.20 AM 15/07/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/r/002";
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
<title>Resend Form</title>
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
function getLoadDiv(){
			//alert(title);
			var mydata;
			mydata= new XMLHttpRequest();
			mydata.onreadystatechange=function(){
				if(mydata.readyState==4){
					document.getElementById('loadDiv').innerHTML=mydata.responseText;
				}
			}
			var no=document.getElementById('empappodate1').value;
			mydata.open("GET","ajax_resendForm.php"+"?txt="+no,true);
			mydata.send();	
}
function loadGrid(title){
			//alert(title);
			var mydataLoad;
			mydataLoad= new XMLHttpRequest();
			mydataLoad.onreadystatechange=function(){
				if(mydataLoad.readyState==4){
					document.getElementById('getNewView').innerHTML=mydataLoad.responseText;
				}
			}
			var no=document.getElementById('txta'+title).value;
			mydataLoad.open("GET","ajax_resendForm.php"+"?txt1="+no,true);
			mydataLoad.send();
			var mydataLoad1;
			mydataLoad1= new XMLHttpRequest();
			mydataLoad1.onreadystatechange=function(){
				if(mydataLoad1.readyState==4){
					document.getElementById('getNewView1').innerHTML=mydataLoad1.responseText;
				}
			}
			var no1=document.getElementById('txta'+title).value;
			mydataLoad1.open("GET","ajax_resendForm1.php"+"?txt2="+no1,true);
			mydataLoad1.send();
			
			var prtContent = document.getElementById("getNewView");
			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
			WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();
			WinPrint.close();
}
function getprintCopy(){
		var prtContent = document.getElementById("getNewView");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
}
</script>
<style type="text/css">
.cell1{
	border:#000000 solid 1px; 
	width:15px; 
	text-align:center;
}
</style>

</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p>
<!-- Screen design will be started from here -->
<form action="" method="post">


<div  style="height:300px;overflow-y: scroll; width:520px;">
<?php 
	$sql_selectdash = "SELECT `serial_number`,`numberoffiles` FROM `batchlog` WHERE `catchStat`='0'";
	$quary_selectdash = mysqli_query($conn,$sql_selectdash);
?>
	<table border="1" id="myTable"  style="width:500px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:200px; text-align: center; padding-left:5px;">Batch Number</td>
        <td style="width:200px; text-align: center; padding-left:5px;">Number of Files</td>
        <td style="width:100px;">&nbsp;</td>
     </tr>
<?php
	$index = 0;
	while ($rec_selectdash = mysqli_fetch_array($quary_selectdash)){
	$index++;
?>
	<tr class="tbl1" style="background:#FFFFFF;">
        <td style="width:200px; text-align: right; margin-left:10px;"><?php echo $rec_selectdash[0]; ?><div style="display:none;"><input type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $rec_selectdash[0]; ?>"  onKeyPress="return disableEnterKey(event)"/></div></td>
        <td style="width:200px; text-align: right; margin-left:10px;"><?php echo $rec_selectdash[1]; ?><div style="display:none;"><input type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_selectdash[1]; ?>"  onKeyPress="return disableEnterKey(event)"/></div></td>
        <td style="width:100px;"><img src="../../../img/print.png" title="<?php echo $index; ?>" onclick="loadGrid(title)"/></td>
     </tr>	
<?php
	}
?>
</table>
</div>
<hr/>
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div id="getNewView" style="display:none;">

</div>
<div id="getNewView1" style="display:none;">

</div>
<div style="display:none;">
	<input  name="user" type="text"  id="user" onKeyPress="return disableEnterKey(event)" value="<?php echo $_SESSION['user']; ?>"/>
</div>	
</form>
</body>
</html>
