<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Booking Detels Reporting 
Purpose			: To Booking Management
Author			: Madushan Wikramaarachchi
Date & Time		: 12:25 PM 12/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/r/001";
	$_SESSION['Module'] = "Leisure";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Leisure_DEVELOPMENT/PHP_FUNCTION/leisure_system_php_function.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Detels Reporting</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:970px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
        font-family: Calibri;
        font-size: 12px;
	}
 .textline_01{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
    width:100px;
    height: 12px;
}
.textline_02{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
     height: 12px;
}
.buttonManage{
    font-size: 12px; 
    font-family: sans-serif;
    width: 80px;
}
.linetop{
    color: #FFFFFF;
    font-family: sans-serif;
    font-size: 12px;
}
</style>
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
    $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    $(function() {
        $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    
    function getdetails(){
        var V_FromDate = document.getElementById('empappodate1').value;
        var V_ToDate = document.getElementById('empappodate2').value;
        var V_userId = document.getElementById('txtUserID').value;
        
       	var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('divGetDetels').innerHTML=mydata.responseText;
			}
		}
		mydata.open("GET","ajaxbookingDetelsReporting.php"+"?fromDate="+V_FromDate+"&toDate="+V_ToDate+"&userID="+V_userId,true);
		mydata.send();
    }
</script>
<!-- Ends  function here -->

</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table border="0" cellpadding='0' cellspacing='0'>
    <tr>
        <td class="textline_01"><p class="linetop">User ID :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width:150px;"  name="txtUserID" type="text"  id="txtUserID" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">From (Date) :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        <label class="linetop"> - &nbsp;</label>
            <input class="box_decaretion" style="width: 100px;"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"></td>
        <td class="textline_02">
           <input type="button" class="buttonManage" id="btnSelect" name="btnSelect" value="Select" onclick="getdetails()" />
           <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
    </tr>
</table>
<hr />
<div id="divGetDetels">

</div>
</form>
</body>
</html>
