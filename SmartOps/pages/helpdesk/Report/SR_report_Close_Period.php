<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Close Report
Purpose			: To get Service Request Close Report
Author			: Madushan Wikramaarachchi
Date & Time		: 10.42 P.M 10/03/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/r/002";
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
<title>Service Request Close Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
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
    function pageClose(){ //Page Close Function.......
        parent.location.href = parent.location.href;
    }       
    function getGriedViwe(){
        var getFromDate = document.getElementById('empappodate1').value;
        var getToDate = document.getElementById('empappodate2').value;
        var getBra = document.getElementById('txtuserG').value;
        var getDep = document.getElementById('txtuserD').value;
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
            
            mydata.open("GET","ajax_report_helpdesk.php"+"?getSRclosFromDate="+getFromDate+"&getSRclosToDate="+getToDate+"&getBr="+getBra+"&getde="+getDep,true);
            mydata.send();
        }
        
    }
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
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Date Period :</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" placeholder="From Date"/>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
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
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Closed SR</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">1 - 3</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">4 - 5</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;"> &gt;5 </span></td>
        </tr>
</table>
</span>

<div style="display: none;">
<input type="text" name="txtuserG" id="txtuserG" value="<?php echo $_SESSION['userBranch']; ?>"  onKeyPress="return disableEnterKey(event)"/>
<input type="text" name="txtuserD" id="txtuserD" value="<?php echo $_SESSION['userDepartment']; ?>"  onKeyPress="return disableEnterKey(event)"/>

</div>
</form>
</body>
</html>