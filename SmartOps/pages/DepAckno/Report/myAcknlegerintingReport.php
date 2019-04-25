<!DOCTYPE HTML>
<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Dep Ack
Page Name		: My Acknowledgement
Purpose			: get report for My Acknowledgement
Author			: Madushan Wikramaarachchi
Date & Time		: 9.35 PM 26/03/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="depac/r/003";
	$_SESSION['Module'] = "Dep Ack";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../DepAckno_DEVELOPMENT/PHP_FUNCTION/DepAckno_php_function.php');
?>

<html> 
<head>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DepAckno_DEVELOPMENT/CSS/DepAckno_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../DepAckno_DEVELOPMENT/JAVASCRIPT_FUNCTION/DepAckno_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<!-- Starts function here -->
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
	   parent.location.href = parent.location.href;
        //window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
    }
    
    function getGriedViwe(){
        var fromDate = document.getElementById('empappodate1').value;
        var toDate = document.getElementById('empappodate2').value;
        var selBranch = document.getElementById('txtuserBranch').value;
        var seluSER = document.getElementById('txtuserName').value;
        var sqlSelect = 2;
        
        if(fromDate == ""){
            alert('Select From Date.');
        }else if(toDate == ""){
            alert('Select To Date.');
        }else if(fromDate > toDate){
             alert('dates are mis matchig.');     
        }else{
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata.responseText;           
                }
            }
            
            mydata.open("GET","../DepAckno_DEVELOPMENT/PHP_FUNCTION/DepAckno_php_Ajax.php"+"?FromBranchackDate="+fromDate+"&ToBranchackDate="+toDate+"&getBranchsel="+selBranch+"&sqlSel="+sqlSelect+"&getuserName="+seluSER,true);
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
<!-- Ends  function here -->
</head>
<body>
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p>
<hr/>
<!--<form action="dep_data.php" method="post">-->
<form action="" method="post">
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
<div style="display: none;">
     <input type="text" name="txtuserBranch" id="txtuserBranch" value="<?php echo $_SESSION['userBranch']; ?>" />
     <input type="text" name="txtuserName" id="txtuserName" value="<?php echo $_SESSION['user']; ?>" />
</div>
<br />
<table>
     <tr>
         <td style="text-align: right; width:150px;"></td>
         <td>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnSelect" name="btnSelect" value="Select" onclick="getGriedViwe();"/>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose();"/>
        </td>
     </tr>
</table>
<br/>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;">
        <tr style='background-color: #BEBABA;'>
            <td style='width:40px;text-align: right;'><span style='margin-right: 5px;'>#</span></td>
            <td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>Deposit Num</span></td>
            <td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
            <td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>Print Serial</span></td>
            <td style='width:100px;text-align: left;'><span style='margin-left: 5px;'>Branch</span></td>
            <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Print By</span></td>
            <td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>Print On</span></td>
            <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Print Text</span></td>
            <td style='width:200px;text-align: left;'><span style='margin-left: 5px;'>Remark</span></td>
        </tr>
</table>
</span>
</form>

</body>
</html>