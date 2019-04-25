<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk completed Report With scat 2
Purpose			:  for completed kiosk - given period
Author			: Madushan Wikramaarachchi
Date & Time		: 12:29 PM 24/08/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/r/011";
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
<title>kiosk completed Report</title>
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
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted.php?DispName=Kiosk%20Completed%20Report','conectpage');
}
function pageRef(){
  // http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted.php?DispName=Kiosk%20Completed%20Report','conectpage');
}
function getGriedViwe(){
        var getFromDate = document.getElementById('empappodate1').value;
        var getToDate = document.getElementById('empappodate2').value;
        var sel_scat02 = document.getElementById('sel_scat02').value;
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
            
            mydata.open("GET","ajax_kioskCompletedReoptScat2.php"+"?getKISCompteFromDateHou="+getFromDate+"&getKISCompteToDateHou="+getToDate+"&getScat02Hou="+sel_scat02,true);
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
      <tr>
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">File Type :</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
        	 <select class="box_decaretion"  style="width: 150px;" name="sel_scat02" id="sel_scat02" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getAdditionalBox()">
               
                    <?php
                        //<option value="">--Select States --</option>
                        $v_sql_cat_2 = "SELECT `scat_code_2` , `scat_discr_2` FROM `scat_02` WHERE `cat_code` = '1014' AND `scat_code_1` = '101401';";
                        
                        //echo $v_sql_cat_2;
                        $quecat_2 = mysqli_query($conn,$v_sql_cat_2);
                        while($RES_getcat_2 = mysqli_fetch_array($quecat_2)){
                            echo "<option value=".$RES_getcat_2[0].">".$RES_getcat_2[1]."</option>";
                        }
                    ?>
                </select>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
            
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
<table border="1" cellpadding="0" cellspacing="0" id="myTable1"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;">
       <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Completed SR</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">1 Hrs</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">1 1/2 Hrs</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">2 Hrs</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">2 1/2 Hrs</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">3 Hrs</span></td>
            <td style="width:50px;text-align: right;"><span style="margin-right: 5px;">4 Hrs</span></td>
        </tr>
</table>
</span>
</form>
</body>
</html>
