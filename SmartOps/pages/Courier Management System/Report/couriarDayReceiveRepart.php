<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Day Receive Report
Purpose			: To Genarate Courier Day Receive Report
Author			: Madushan Wikramaarachchi
Date & Time		: 09.26 A.M 21/11/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/r/009";
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
<title>Courier Day Receive  Report</title>
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
		width:1050px;
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
	function TypeSelect(){
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('cueTopBrnch').innerHTML=mydata.responseText;
			}
		}
		var type1=document.getElementById('empappodate1').value;
		var type2=document.getElementById('txtBranch').value;
		var type3=document.getElementById('txtdep').value;
		var type4=document.getElementById('empappodate2').value;
		mydata.open("GET","ajaxcouriarDayReseveRepoart.php"+"?date1="+type1+"&bran="+type2+"&depar="+type3+"&date2="+type4,true);
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Receive Branch :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<?php
				$sqlBranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$_SESSION['userBranch']."'";
				$query_Branch = mysqli_query($conn,$sqlBranch);
				while ($recBranch = mysqli_fetch_array($query_Branch)){
			?>
        	<input class="box_decaretion" type="text" name="txtB" id="txtB" style="width:200px;"  value="<?php echo $recBranch[0]; ?>" readonly="readonly"/>  
            <?php
				}
			?>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Receive Department :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<?php
				$sqlDepartment = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$_SESSION['userDepartment']."'";
				$query_Department = mysqli_query($conn,$sqlDepartment);
				while ($recDepartment = mysqli_fetch_array($query_Department)){
			?>
        	<input class="box_decaretion" type="text" name="txtD" style="width:300px;" id="txtD" value="<?php echo $recDepartment[0]; ?>" readonly="readonly"/>
            <?php
				}
			?>
        </td>
      </tr>
</table>
<table>
     <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;" title="Branch Admin bag sent date to other branch">Branch Sent (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" />
        </td>
      </tr>  
      <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" />
            
        </td>
      </tr>
</table><br/>
<div style='display:none;'>
			<input type="text" name="txtBranch" id="txtBranch" value="<?php echo $_SESSION['userBranch']; ?>"/>
            <input type="text" name="txtdep" id="txtdep" value="<?php echo $_SESSION['userDepartment']; ?>"/>
</div>
<input class="buttonManage" type="button" style="width:100px;" id="btnCourierTopBranch" name="btnCourierTopBranch" value="Select" onclick="TypeSelect()"/>
<input class="buttonManage" type="button" style="width:100px;" value="Print" name="getprient" id="getprient" onclick="Typeprint();"/>
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<input type="button" class="buttonManage" style="width:100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<hr/>
<br/><br/><br/>
<div id="cueTopBrnch" >
    <table border="1" id="myTable" class="tbl1" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-left:5px; width:50px;">Index</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">File Name</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">Send Brnach</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Send Department</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Remarks</td>
         <td style="text-align:left; padding-left:5px; width:150px;">Receive Officer</td>
         <td style="text-align:left; padding-left:5px; width:100px;">Num OF Doc</td>
      </tr>
      <tr style="background-color: #FFFFFF;">
      	 <td style="text-align:left; padding-left:5px; width:50px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px; width:150px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px; width:100px;">&nbsp;</td>
      </tr>
      
</div>


</form>
</body>
</html>

