<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Report
Purpose			: To get Service Request Report
Author			: Madushan Wikramaarachchi
Date & Time		: 04.03 P.M 22/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/001";
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
<title>Courier Day Receive  Report</title>
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
        parent.location.href = parent.location.href;
    }       
    
    function isSelectSRReport(){
        var date1 = document.getElementById('empappodate1').value;
        var date2 = document.getElementById('empappodate2').value;
        var ugro = document.getElementById('txtuserG').value;
         var getD = document.getElementById('txtuserD').value;
         var r = 1;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        //mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getSRUGroup="+ugro,true);
         mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getSRUGroup="+ugro+"&opt="+r+"&getDe="+getD,true);
        mydata.send();
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
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">From (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
      </tr>  
      <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">To (Date) :</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
            
        </td>
      </tr>
      <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;"></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:600px;">
            <span>
        	   <input type="button" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
                <input type="button" class="buttonManage" style="width: 100px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
                <input type="submit" id="btn2" style="width:100px;" name="btn2" value="EXCEL"/>     
            </span>
            <span id="excelNow" style="visibility:hidden;background-color: #FAFAFA; margin-left:5px; border: #000000 solid 1px; text-align:center;font-size:15px; font-family:Arial, Helvetica, sans-serif;">
            </span>
        </td>
      </tr>
</table>
<br/>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">Issue</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Department</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">States</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Assign By</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved By</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Solved On</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. By</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Ackn. On</span></td>
            
        </tr>
</table>
</span>
<div style="display: none;">
<input type="text" name="txtuserG" id="txtuserG" value="<?php echo $_SESSION['usergroupNumber']; ?>"  onKeyPress="return disableEnterKey(event)"/>
<input type="text" name="txtuserD" id="txtuserD" value="<?php echo $_SESSION['userDepartment']; ?>"  onKeyPress="return disableEnterKey(event)"/>
</div>
<?php		
if(isset($_POST['btn2']) && $_POST['btn2']=="EXCEL" ){
	$psD1 = $_POST['empappodate1'];
	$psD2 = $_POST['empappodate2'];
	$sqldate = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
	$add = mysqli_query($conn,$sqldate);
	while ($rec = mysqli_fetch_array($add)){
		$dateNow = $rec[0];
	}
	$ran = rand();
	$fName = $dateNow.$_SESSION['user'].rand(10,1000)."fileSRREOPRT.xls";
	echo "<div style='display:none;'><input type='text' name='txtexcel' id='txtexcel' value='$fName'/></div>";
	$sql = "(SELECT 'Rank','Help_Id','Enter_Date','Issue','Branch_Name','Deparment_Name','Ente_By','Urgency_States','Priority_States','Cmb_States','Assign_By','Solved By','Solved_On','Acknowledge_By','Acknowledge_On')
                UNION (SELECT @rownum := @rownum + 1 AS rank,`cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` ,`cmb_states`.`cmb_discr`, `cdb_helpdesk`.`asing_by`, `cdb_helpdesk`.`solved_by`, if(DATE(`cdb_helpdesk`.`solved_on`)!='0000-00-00',DATE(`cdb_helpdesk`.`solved_on`),''),  `cdb_helpdesk`.`act_by`, if(DATE(`cdb_helpdesk`.`act_on`)!='0000-00-00',DATE(`cdb_helpdesk`.`act_on`),'') 
                                     FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`,(SELECT @rownum := 0) r
                                     WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` 
                                       AND `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` 
                                       AND `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` 
                                       AND `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                       AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                       AND  DATE(`cdb_helpdesk`.`enterDateTime`) BETWEEN '".$psD1."' AND '".$psD2."'
                                       AND  `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
                                    ORDER BY `cdb_helpdesk`.`helpid` INTO OUTFILE 'C:/wamp64/www/CDB/temp/$fName' FIELDS ENCLOSED BY '\"' LINES TERMINATED BY '\n')";
	$query1 = mysqli_query($conn,$sql);
	
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
				mydata99.open('GET','../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php'+'?linkExcel='+type1,true);
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

