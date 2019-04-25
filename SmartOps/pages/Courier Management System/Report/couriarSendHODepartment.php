<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Send Headoffice Department
Purpose			: To Send Headoffice Department
Author			: Madushan Wikramaarachchi
Date & Time		: 10.18 A.M 26/08/2014 (Modified)
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
<title>Send Headoffice Department</title>
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
		width:650px;
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
    $( "#empappodate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
	function TypeSelect(){
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('cueType1').innerHTML=mydata.responseText;
			}
		}
		var type3=document.getElementById('empappodate').value;
		mydata.open("GET","ajaxSendHODepartment.php"+"?txt3="+type3,true);
		mydata.send();
	}
	function Typeprint(){
		var prtContent = document.getElementById("cueType1");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
    function getprintCopy(){
		var prtContent = document.getElementById("cueType1");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
    }
	
    function getFiledtl(title){
        //alert(title);
        var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('cueType1').innerHTML=mydata.responseText;
			}
		}
		var type3=document.getElementById('empappodate').value;
		mydata.open("GET","ajaxSendHODepartment_sub.php"+"?dateR="+type3+"&dep_id="+title,true);
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Create date :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate" type="text"  id="empappodate" />
            
        </td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">
        </td>
      </tr>
</table>
<br />
<input class="buttonManage" type="button" style="width:100px;" id="btnCourierType" name="btnCourierType" value="Select" onclick="TypeSelect();"/>
<input class="buttonManage" type="button" style="width:100px;" value="Print" name="getprient" id="getprient" onclick="Typeprint();"/>
<input type="button" class="buttonManage" style="width:100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>

<hr/>
<div id="cueType1">
    <table border="1" cellpadding="0" cellspacing="0">
      <tr style="background-color: silver;">
      	<td style="text-align:left; padding-left:5px; width:50px;">#</td>
        <td style="text-align:left; padding-left:5px; width:100px;">Send Dep Num</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Send Department</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Last Send Date Time</td>
      </tr>
      <tr style="background-color: #FFFFFF;">
      	<td style="text-align:left; padding-left:5px; width:50px;">&nbsp;</td>
        <td style="text-align:left; padding-left:5px; width:100px;">&nbsp;</td>
        <td style="text-align:left; padding-left:5px; width:300px;">&nbsp;</td>
        <td style="text-align:left; padding-left:5px; width:300px;">&nbsp;</td>
      </tr>
    </table>
</div>
</form>
</body>
</html>