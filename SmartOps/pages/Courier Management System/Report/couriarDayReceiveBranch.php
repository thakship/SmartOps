<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier System Management
Purpose			: To controling Courier System Management
Author			: Madushan Wikramaarachchi
Date & Time		: 09.53 A.M 26/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/r/007";
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
<title></title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:700px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
	function TypeSelect(){
		document.getElementById("getPDF").disabled=false;	
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('dvGet').innerHTML=mydata.responseText;
			}
		}
		var type1=document.getElementById('empappodate1').value;
		mydata.open("GET","ajaxcouriar_Receive_Branch.php"+"?date1="+type1,true);
		mydata.send();
	}
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
     <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Date :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
      </tr>  
</table><br/>
<input class="buttonManage" type="button" style="width:100px;" id="btnCourierTopBranch" name="btnCourierTopBranch" value="Select" onclick="TypeSelect()"/>
<input class="buttonManage" type="submit" style="width:100px;" value="PDF" name="getPDF" id="getPDF" disabled="disabled"/>
<hr/>
<div id='dvGet'>

</div>
</form>
<?php
if(isset($_POST['getPDF']) && $_POST['getPDF']=='PDF'){
	$title = "Courier Day Send Branch Report";//report name
	$psD1 = $_POST['empappodate1'];
	$d1 = "Send Date                  : ".$psD1;//Other information
	$tableget = "Line,15,Rank|brn_num,45,Branch Num|brn_name,60,Branch Name|sen_Date,85,Send Date Time";//must want to table %PLUS%

$sql = "SELECT @rownum := @rownum %PLUS% 1 AS Line, tmp.brn_num, tmp.brn_name, tmp.sen_Date FROM ( SELECT DISTINCT `courier_files`.`branchNumber` brn_num, `branch`.`branchName` brn_name, `courier_files`.`sendDateTime` sen_Date FROM `courier_files`, `branch` WHERE `courier_files`.`branchNumber` = `branch`.`branchNumber` AND DATE(`courier_files`.`sendDateTime`) = '$psD1' ORDER BY `courier_files`.`branchNumber` )tmp,(SELECT @rownum := 0) r ";
	
	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}
?>
</body>
</html>

