<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Archived Total Report
Purpose			: get Archived Total Report 
Author			: Madushan Wikramaarachchi
Date & Time		: 1.51 AM 02/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/r/004";
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
<title>Courier top Reseive Branch</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
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
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p>
<table>
        <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">From (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
      </tr>
</table>
<br/>
<div style="float:left;">
</div>
<div style="float:left;">
<div style="float:left;">
<input type="button" class="buttonManage" style="width: 100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<input type="submit" id="btn2" style="width:100px;" name="btn2" value="EXCEL"/>
</div>
<div id="excelNow" style="visibility:hidden;float:left;background-color: #FAFAFA; margin-left:5px; margin-right:5px; border: #000000 solid 1px; text-align:center;font-size:15px; font-family:Arial, Helvetica, sans-serif;">
</div>
</div>
<?php		
if(isset($_POST['btn2']) && $_POST['btn2']=="EXCEL" ){
	$psD1 = $_POST['empappodate1'];
	$psD2 = $_POST['empappodate2'];
	//echo $psD1." -- ".$psD2;
	$sqldate = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
	$add = mysqli_query($conn,$sqldate);
	while ($rec = mysqli_fetch_array($add)){
		$dateNow = $rec[0];
	}
	$ran = rand();
	$fName = $dateNow.$_SESSION['user'].rand(10,1000)."file1.xls";
	echo "<div style='display:none;'><input type='text' name='txtexcel' id='txtexcel' value='$fName'/></div>";
	$sql = "(SELECT 'Rank','BOX_NUMBER','PRODUCT_NAME','DOCUMENT_NUMBER','DOC_TYPE','CLIENT_NAME','ACC_CLOSE','DATE_CLOSED','DISPATCHED_DATE','DISPATCHED_USER','CURRENT_ACTION')
UNION (select @rownum := @rownum + 1 AS rank,
doc_line_file_stack.box_number, doc_line_doc_mast.prod_name ,CONCAT(char(39),doc_line_file_stack.doc_number), 
doc_line_file_stack.doc_type , doc_line_doc_mast.doc_name, 
(select 'C' FROM `core_acnt_closure` where `core_acnt_closure`.`documentNumber` = doc_line_doc_mast.doc_number) AS CLOSURE_STAT,
(select `core_acnt_closure`.`Closure_date` FROM `core_acnt_closure` where `core_acnt_closure`.`documentNumber` = doc_line_doc_mast.doc_number) AS CLOSUED_DATE,
doc_line_box_mast.box_disp_date, doc_line_box_mast.box_disp_by,
(select if(ddh.action_stat='LD','Loaded',if(ddh.action_stat='ST','Dispatched',if(ddh.action_stat='RQ','Requested',if(ddh.action_stat='RC','Received',if(ddh.action_stat='RF','Forword','None'))))) from doc_line_stat_history ddh where ddh.action_seq = (select max(dh.action_seq) from doc_line_stat_history dh where dh.doc_number = doc_line_file_stack.doc_number and dh.doc_type = doc_line_file_stack.doc_type)) AS LATEST_ACTION
from doc_line_doc_mast,doc_line_file_stack, doc_line_box_mast ,(SELECT @rownum := 0) r
where doc_line_file_stack.doc_number = doc_line_doc_mast.doc_number
AND doc_line_box_mast.box_number = doc_line_file_stack.box_number
AND doc_line_box_mast.box_disp_date between '$psD1' AND '$psD2' INTO OUTFILE 'C:/wamp64/www/CDB/uploadHelpdesk/$fName' FIELDS ENCLOSED BY '\"' LINES TERMINATED BY '\n')";
	echo $sql;
    $query1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	if($query1){
		echo "<script>
				document.getElementById('excelNow').style.visibility = 'visible';
				</script>";
		echo "<script>
				var mydata99;
				mydata99= new XMLHttpRequest();
				mydata99.onreadystatechange=function(){
					if(mydata99.readyState==4){
						document.getElementById('excelNow').innerHTML=mydata99.responseText;
					}
				}
				var type1='".$fName."';
				mydata99.open('GET','ajaxExcelLink.php'+'?date1='+type1,true);
				mydata99.send();
				</script>";
		echo "<script> alert('Record Saved!');</script>";	
		
	}else{
		echo "<script> alert('Record not saved!');</script>";
	}
}

?>

</form>
</body>
</html>