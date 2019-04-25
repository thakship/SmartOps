<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Print Packing List
Purpose			: Printing Packing List in BOX
Author			: Madushan Wikramaara
Date & Time		: 8:52 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/r/001";
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
<title>Box Dispatch</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>

<!-- Starts CDB User defined function here -->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
function getLoadDiv(){
			//alert(title);
			var mydata;
			mydata= new XMLHttpRequest();
			mydata.onreadystatechange=function(){
				if(mydata.readyState==4){
					document.getElementById('loadDiv').innerHTML=mydata.responseText;
				}
			}
			var no=document.getElementById('empappodate1').value;
            var noB=document.getElementById('userBranch').value;
            var noD=document.getElementById('userDepartment').value;
			mydata.open("GET","ajax_printPackingList1.php"+"?txt="+no+"&txtB="+noB+"&txtD="+noD,true);
			mydata.send();	
}
function loadGrid(title){
			//alert(title);
			var no=document.getElementById(title).value;
			var no1=document.getElementById('user').value;
			var mydataLoad1;
			mydataLoad1= new XMLHttpRequest();
			mydataLoad1.onreadystatechange=function(){
				if(mydataLoad1.readyState==4){
					document.getElementById('getNewView1').innerHTML=mydataLoad1.responseText;
				}
			}
			mydataLoad1.open("GET","ajax_printPackingList2.php"+"?txt1="+no+"&txt2="+no1,true);
			mydataLoad1.send();
			
			var mydataLoad;
			mydataLoad= new XMLHttpRequest();
			mydataLoad.onreadystatechange=function(){
				if(mydataLoad.readyState==4){
					document.getElementById('getNewView').innerHTML=mydataLoad.responseText;
                    var prtContent = document.getElementById("getNewView");
        			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
        			WinPrint.document.write(prtContent.innerHTML);
        			WinPrint.document.close();
        			WinPrint.focus();
        			WinPrint.print();
        			WinPrint.close();
				}
			}
			
			mydataLoad.open("GET","ajax_printPackingList.php"+"?txt1="+no+"&txt2="+no1,true);
			mydataLoad.send();
			
			
			
}
function getprintCopy(){
		var prtContent = document.getElementById("getNewView");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
}
</script>
<style type="text/css">
.cell1{
	border:#000000 solid 1px; 
	width:15px; 
	text-align:center;
}
#getNewView{
	background:#FFFFFF;
	float:left;
}

</style>

</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p>
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
     <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">From (Date)</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">
        	<input type="button" style="width:100px;" value="Refresh" name="btnRefresh" id="btnRefresh" onclick="getLoadDiv()"/>
        </td>
      </tr>  
</table>
<hr/>
<div id="loadDiv" style="height:520px;overflow-y: scroll; width:820px; height:200px;">

 <!-- End of Screen design will be started from here -->
</div>

<hr/>
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div style="display:none;">
	<input  name="user" type="text"  id="user" onKeyPress="return disableEnterKey(event)" value="<?php echo $_SESSION['user']; ?>"/>
    <input  name="userBranch" type="text"  id="userBranch" onKeyPress="return disableEnterKey(event)" value="<?php echo $_SESSION['userBranch']; ?>"/>
    <input  name="userDepartment" type="text"  id="userDepartment" onKeyPress="return disableEnterKey(event)" value="<?php echo $_SESSION['userDepartment']; ?>"/>
</div>	
<br/><br/>
<div id="getNewView" style="display:none;">

</div>
<div id="getNewView1" style="display:none;">

</div>
	<br />
	
</form>
</body>
</html>
