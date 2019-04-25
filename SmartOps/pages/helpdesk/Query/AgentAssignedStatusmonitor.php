<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Agent Assigned Status monitor
Purpose			: 
Author			: Madushan Wikramaarachchi
Date & Time		: 12:10 PM 18/05/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/010";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agent Assigned Status Monitor</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.min.js"></script>
<script src="jquery/jquery-ui.js"></script>

<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
        parent.location.href = parent.location.href;
    } 
    function isSelectSRReport(){
         var date1 = document.getElementById('empappodate1').value;
        var date2 = document.getElementById('empappodate2').value;
        
       // alert(sel_User);
       if(date1 == ""){
        alert('Missing Entry From (Date)');
       }else if(date2 == ""){
         alert('Missing Entry To (Date)');
       }else{
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    //alert('a');
                    document.getElementById('loadPage').innerHTML = mydata.responseText;           
                }
            }
            mydata.open("GET","AJAXAgentAssignedStatusmonitor.php"+"?getDateFrom="+date1+"&getDateTo="+date2,true);
            mydata.send();
       }
    }      
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
     <tr> 
        <td style="text-align: left;width:200px;"><label class="linetop">Report generated for :</label></td>
     
        <td style="text-align: left;width:115px;"><label class="linetop">From (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
        <td style="text-align:right; width:100px;"><label class="linetop"> To (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
      </tr>
</table>
<br/>
<div style="margin-left: 100px;">
<input type="button" style="width: 100px;" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</div>
<hr />
<br />
<div id="loadPage"></div>
</form>
</body>
</html>

