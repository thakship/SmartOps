<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Document Movement Details
Purpose			: To Get Document Movement Details
Author			: Madushan Wikramaarachchi
Date & Time		: 11.16 A.M 25/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/q/002";
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
<title>Document Movement Details</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.tbl1{
	 	text-align:center;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	.tbl2{
	 	text-align:center;
		width:650px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	#selectFilName{
		visibility: hidden;
		height:250px;
		overflow-y: scroll;
		margin-right:10px;
	}
	#selectFilName1{
		visibility: hidden;
		height:250px;
		overflow-y: scroll;
		width:670px;
		margin-right:10px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
	function fileSelect(){
		//var no=document.getElementById('txtFilename').value;
		//alert('aa2 - ');
		document.getElementById('selectFilName').style.visibility = "visible";
		var mydata;
        var no=document.getElementById('txtFilename').value;
		var no1=document.getElementById('empappodate1').value;
		var no2=document.getElementById('txtUSI').value;
		var no3=document.getElementById('txtUSA').value;
        if(no1 != ""){
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
				    document.getElementById('selectFilName').innerHTML=mydata.responseText;
                }
            }
            mydata.open("GET","ajaxQuaryFilemoment1.php"+"?txt1="+no+"&txt3="+no1+"&txt9="+no2+"&txt10="+no3,true);
            mydata.send();
        }else{
            alert('Select Entry Date.')
        }
	}
	function filemovement(obj,title){
		if(obj == 'btnView'){ 
			//alert('Do my code');
			document.getElementById('selectFilName1').style.visibility = "visible";
			var mydata1;
			mydata1= new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('selectFilName1').innerHTML=mydata1.responseText;
				}
		}
			var m=document.getElementById(title).value;
			//alert("ajaxQuaryFilemoment1.php"+"?txt2="+m);
			mydata1.open("GET","ajaxQuaryDocumentmomentsub.php"+"?txt2="+m,true);
			mydata1.send();
		}else{
			alert('Do not my code');
		}
		
	}
	 function getPDF() {
            //Get the HTML of div
            var divElements = document.getElementById(idDIV).innerHTML;
            alert(divElements);
		  
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:100px;">Entry Date :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
    </tr>
</table>
<table>
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:100px;"><label>File Name :</label></td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion" type="text" style="width:200px;" id="txtFilename" name="txtFilename" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onkeypress="return disableEnterKey(event)"/>
        </td>
      </tr>
</table><br/>
<input class="buttonManage" type="button" style="width:100px;" id="btnFilemovemetSelect" name="btnFilemovemetSelect" value="Select" onclick="fileSelect();"/>
<input type="button" style="width:100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<div style='display:none;'><input type="text" name="txtUSI" id="txtUSI" value="<?php echo $_SESSION['userBranch']; ?>"  onkeypress="return disableEnterKey(event)" /></div>
<div style='display:none;'><input type="text" name="txtUSA" id="txtUSA" value="<?php echo $_SESSION['userDepartment']; ?>"  onkeypress="return disableEnterKey(event)" /></div>
<hr/>
<div id='selectFilName'>

</div>
<br/>
<div id='selectFilName1'>

</div>
<div style='display:none;'>
    <input class='txt' type='text' name='txtb' id='txtb' value='<?php echo $_SESSION['user']; ?>'/>
</div>
<?php
if(isset($_POST['getPDF']) && $_POST['getPDF']=='PDF'){
	$fnumber = $_POST['txta'];
	$userGET = $_POST['txtb'];
	//echo $fnumber;
	$to = "bbbbbb";
	header('location:PDFGenaret.php?'."fNum=".$fnumber."&to=".$userGET);
}
?>

</form>
</body>
</html>