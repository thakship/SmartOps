<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk completed Report - new 1 h
Purpose			:  for completed kiosk - given period - new 1h
Author			: Madushan Wikramaarachchi
Date & Time		: 02.30 P.M 22/08/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/r/009";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
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
<title>kiosk completed Report - new</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
 
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
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted_HR_Full.php?DispName=Kiosk%20Completed%20Report%20-%20Hourly%20New','conectpage');
}
function pageRef(){
  // http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted_HR_Full.php?DispName=Kiosk%20Completed%20Report%20-%20Hourly%20New','conectpage');
}
function getGriedViwe(){
        var getFromDate = document.getElementById('empappodate1').value;
        var getToDate = document.getElementById('empappodate2').value;
        if(getFromDate == ""){
            alert('Select From Date.');
        }else if(getToDate == ''){
            alert('Select To Date.');
        }else{
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;           
                }
            }
            
            mydata.open("GET","ajax_report_helpdesk.php"+"?getKISCompteFromDate_1Full="+getFromDate+"&getKISCompteToDate_1Full="+getToDate,true);
            mydata.send();
        }
        
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
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Date Period :</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" placeholder="From Date"/>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"  placeholder="To Date"/>      
        </td>
      </tr>
</table>
<br />
<table>
     <tr>
         <td style="text-align: right; width:150px;"></td>
         <td>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnSelect" name="btnSelect" value="Select" onclick="getGriedViwe()"/>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<br/>
<span id="maneSpan">
<label style="font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 42px; font-weight: bold;">Completed Requests Status - </label><br />
<span style='margin-left: 40px;'>After 4pm submission will be treated as next day 8:30am submission</span>
<table border="1" cellpadding="0" cellspacing="0" id="myTable1"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;">
       <tr style="background-color: #BEBABA;">
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>User ID</span></td>
            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>User Name</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Completed SR</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1 Hrs </span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 1  1/2 Hrs </span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2 Hrs </span></td>
			<!--<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 2  1/2 Hrs </span></td>-->
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 3 Hrs</span></td>
            <td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 4 Hrs</span></td>
			<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'> 5 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Within 24 Hrs</span></td>
			<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'> Above 24 Hrs </span></td>
        </tr>
</table>
</span>
</form>
</body>
</html>
