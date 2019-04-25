<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Top Receive Branch
Purpose			: To get Courier Top Receive Branch
Author			: Madushan Wikramaarachchi
Date & Time		: 01.26 P.M 25/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/r/003";
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
<title>Courier Top Receive Branch</title>
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
		width:450px;
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
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
	function TypeSelect(){
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('cueTopBrnch').innerHTML=mydata.responseText;
			}
		}
		var type1=document.getElementById('empappodate1').value;
		var type2=document.getElementById('empappodate2').value;
		//var type3=document.getElementById('empappodate').value;
		mydata.open("GET","ajaxTopSEND.php"+"?date1="+type1+"&date2="+type2,true);
		mydata.send();
	}
     function Typeprint(){
		var prtContent = document.getElementById("cueTopBrnch");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
    function getprintCopy(){
		var prtContent = document.getElementById("cueTopBrnch");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">From (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
            
        </td>
      </tr>
      <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
            
        </td>
      </tr>
</table><br/>
<input class="buttonManage" type="button" style="width:100px;" id="btnCourierTopBranch" name="btnCourierTopBranch" value="Select" onclick="TypeSelect();"/>
<input class="buttonManage" type="button" style="width:100px;" id="btnCourierTopBranch" name="btnCourierTopBranch" value="Print" onclick="Typeprint();"/>
<!--<input class="buttonManage" type="submit" style="width:100px;" value="PDF" name="getPDF" id="getPDF"/>-->
<input type="button" class="buttonManage" style="width:100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php
/*if(isset($_POST['getPDF']) && $_POST['getPDF']=='PDF'){
	$title = "Courier Top Receive Branches";//report name
	$psD1 = $_POST['empappodate1'];
	$psD2 = $_POST['empappodate2'];
	$d1 = "Date Range                : ".$psD1." to ".$psD2;//Other information
	$tableget = "rank,15,Rank|brn1,75,Receive Branch|nof,30,Num of Files";//must want to table

	$sql = "SELECT @rownum := @rownum %PLUS% 1 AS rank, temp.branch1 AS brn1, temp.Num_of_Files AS nof FROM (SELECT `branch`.`branchName` AS branch1, COUNT(`fileNumber`) AS Num_of_Files FROM `branch`,`courier_files` WHERE `branch`.`branchNumber`=`courier_files`.`receiveBranchNumber` AND (`stats`='FDR' OR `stats`='PDR') AND DATE(`receiveDateTime`) BETWEEN '$psD1' AND '$psD2' group by `courier_files`.`receiveBranchNumber`)temp ,(SELECT @rownum := 0) r ORDER BY temp.Num_of_Files DESC LIMIT 100";
	
	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}*/
?>
<hr/>
<div id="cueTopBrnch">

</div>
</form>
</body>
</html>
