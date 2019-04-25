<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Document Request Report
Purpose			: To get Document Request Report
Author			: Madushan Wikramaarachchi
Date & Time		: 8:52 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/r/005";
	$_SESSION['Module'] = "Doc Line System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
     include('../DLS_DEVELOPMENT/PHP_FUNCTION/doc_php_ajax.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document Request Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
    
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
    
    function isGetGriedViwe(){
        var fromDate = document.getElementById('empappodate1').value;
        var toDate = document.getElementById('empappodate2').value;
        var userBranch = document.getElementById('txtBranch').value;
        var userDepartmnet = document.getElementById('txtDepartment').value;
        var mydataLoad;
        mydataLoad= new XMLHttpRequest();
        mydataLoad.onreadystatechange=function(){
            if(mydataLoad.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydataLoad.responseText;
            }
        }
        mydataLoad.open("GET","../DLS_DEVELOPMENT/PHP_FUNCTION/doc_php_ajax.php"+"?srdFDate="+fromDate+"&srdTDate="+toDate+"&srdUserBranch="+userBranch+"&srdUserDepartment="+userDepartmnet,true);
        mydataLoad.send();
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
        <td style="text-align:left;width:150px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" placeholder="From Date"/>
        </td>
        <td style="text-align:left; width:150px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"  placeholder="To Date"/>      
        </td>
        <td style="text-align:left; width:150px;">
        	<input type="button" style="width: 100px; font-size:12px;" class='buttonManage' name="btnSelect" id="btnSelect" value="Select" onclick="isGetGriedViwe();"/>
        </td>
      </tr>
</table>
<br />
<table>
        
     <tr>
        <td style="text-align: right; width:150px;"></td>
        <td style="text-align:left;">
            <input type="button" style="width: 100px; font-size:12px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
            <input type="button" style="width: 100px; font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<br />
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 20px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Box Number</span></td>
            <td style="width:200px;text-align: right;"><span style="margin-right: 5px;">Document Number</span></td>
            <td style="width:400px;text-align: left;"><span style="margin-left: 5px;">Document Name</span></td>
             <td style='width:50px;text-align: left;'><span style="margin-left: 5px;">Doc Type</span></td>
        </tr>
</table>
</span>
<div style='display:none;'>
    <input type="text" name="txtBranch" id="txtBranch" value="<?php echo $_SESSION['userBranch']; ?>"/>
    <input type="text" name="txtDepartment" id="txtDepartment" value="<?php echo $_SESSION['userDepartment']; ?>"/>
</div>
</form>
</body>
</html>

