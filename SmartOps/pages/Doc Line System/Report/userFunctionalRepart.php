<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: User Function Report
Purpose			: get Report for User Function 
Author			: Madushan Wikramaarachchi
Date & Time		: 1.05 AM 01/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/r/003";
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
            document.getElementById('functionUsers').innerHTML=mydata.responseText;
        }
    }
    var type1=document.getElementById('empappodate1').value;
    var type2=document.getElementById('empappodate2').value;
		//var type3=document.getElementById('empappodate').value;
    mydata.open("GET","ajax_userFunctionalRepart1.php"+"?date1="+type1+"&date2="+type2,true);
    mydata.send();
    
}

</script>
<style type="text/css">

</style>

</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p> <hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
        <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">From (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
      </tr>
</table>
<br />
<input class="buttonManage" type="button" style="width:100px;" id="btnSelect" name="btnSelect" value="Select" onclick="TypeSelect();"/>
<input class="buttonManage" type="submit" style="width:100px;" value="PDF" name="getPDF" id="getPDF"/>
<input type="button" class="buttonManage" style="width: 100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php
if(isset($_POST['getPDF']) && $_POST['getPDF']=='PDF'){
	$title = "Users Functional Rep0rt";//report name
	$psD1 = $_POST['empappodate1'];
	$psD2 = $_POST['empappodate2'];
ini_set('max_execution_time', 36000); //300 seconds = 5 minutes
	$d1 = "Date Range                : ".$psD1." to ".$psD2;//Other information
	$tableget = "rank,15,Rank|user,30,User ID|LOADED,30,LOADED|DISPATCHED,30,DISPATCHED|REQUESTED,30,REQUESTED|RECEIVED,30,RECEIVED|FORWORD,30,FORWORD";//must want to table

	$sql = "select @rownum := @rownum %PLUS% 1 AS rank, temp.act as user,temp.LD_COUNT as LOADED,temp.ST_COUNT as DISPATCHED,temp.RQ_COUNT as REQUESTED,temp.RC_COUNT as RECEIVED,temp.RF_COUNT as FORWORD from(select sh.action_user as act,(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$psD1' and '$psD2' and dlsh.action_stat = 'LD' and  dlsh.action_user = sh.action_user ) AS LD_COUNT,(select count(*) from doc_line_stat_history dlsh where dlsh.action_date_time between '$psD1' and '$psD2' and dlsh.action_stat = 'ST' and  dlsh.action_user = sh.action_user ) AS ST_COUNT,(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$psD1' and '$psD2' and dlsh.action_stat = 'RQ' and  dlsh.action_user = sh.action_user ) AS RQ_COUNT,(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$psD1' and '$psD2' and dlsh.action_stat = 'RC' and  dlsh.action_user = sh.action_user ) AS RC_COUNT,(select count(*)  from doc_line_stat_history dlsh where dlsh.action_date_time between '$psD1' and '$psD2' and dlsh.action_stat = 'RF' and  dlsh.action_user = sh.action_user ) AS RF_COUNT from doc_line_stat_history sh group by sh.action_user)temp,(SELECT @rownum := 0) r";
	
	
	header('location:../../../php_con/PHP_PDF_R2/PDFGenaret.php?'."ptable=".$tableget."&pD1=".$d1."&pSQL=".$sql."&ptit=".$title);
}
?>
<hr />
<div id="functionUsers">

</div>
</form>
</body>
</html>
