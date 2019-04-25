<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: 
Purpose			: 
Author			: Madushan Wikramaarachchi
Date & Time		: 12.14 P.M 04/03/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/009";
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
<title>Kiosk  Respond Time </title>
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
<script src=" jquery/jquery-1.9.1.min.js"></script>
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
</script>
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
        parent.location.href = parent.location.href;
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


<?php
    $sql_CountOFSr = "select ch.helpid AS HELP_ID,
					         ch.issue  AS FILE_DESCR,
							 ch.ssb_facility_amount AS FACILITY_AMT,
							 (select cdbzone.zone_descr from cdbzone where cdbzone.zone_code = br.CDBZONE)  AS ZONE,
							 ch.entry_branch AS BRANCH_CODE, 
							 getBranchName(ch.entry_branch) AS BRANCH_NAME,
							 ch.enterDateTime as FILE_RECEIVED_ON,
						     (select ssbh.P_V from cdb_ssb_his ssbh where ssbh.helpid = ch.helpid  and ssbh.P_V in ('P','V') and ssbh.histdate = (select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid  and cdb_ssb_his.P_V in ('P','V')) limit 1) AS RESPONSE_TYPE,
					         (select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('P','V')) AS RESPOND_ON,
						     ROUND(time_to_sec((TIMEDIFF((select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('P','V')) , ch.enterDateTime))) / 60)  AS MINUTES_TO_RESPOND,
							 (case when (select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('P','V')) is null then (ROUND(time_to_sec((TIMEDIFF(NOW(), ch.enterDateTime))) / 60))    else 0 end) NOT_RESPONDED_FOR,
							 ROUND(time_to_sec((TIMEDIFF(IFNULL((select min(cdb_ssb_his.histdate) from cdb_ssb_his where cdb_ssb_his.helpid = ch.helpid and cdb_ssb_his.P_V in ('P','V')),now()), (if(HOUR(ch.enterDateTime) >= 17, STR_TO_DATE(concat( IF(DAYNAME(date(ch.enterDateTime))='Friday',DATE_ADD(date(ch.enterDateTime) ,INTERVAL 3 DAY),DATE_ADD(date(ch.enterDateTime) ,INTERVAL 1 DAY))  ,' 08:30:00'), '%Y-%m-%d %H:%i:%s') , ch.enterDateTime))))) / 60) AS NEWD
					FROM `cdb_helpdesk` ch,branch br
					where ch.`cat_code` = '1014'
					and ch.enterDateTime BETWEEN STR_TO_DATE(concat(DATE_SUB(date(now()),INTERVAL 1 DAY),'17:00:01'), '%Y-%m-%d %H:%i:%s')  AND date(now())
					and ch.cmb_code <> 5003
					and br.branchNumber = ch.entry_branch
					order by 8 , 12 desc";
    $qer_CountOFSr = mysqli_query($conn,$sql_CountOFSr);
?> 

<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Report Generated for : </label></td>
        <td> <?php echo date("Y-m-d"); ?> </td> </tr><tr>
		<td style="width: 150px; text-align: right;"><label class="linetop">Number of Record(s) : </label></td>
        <td> <?php echo mysqli_num_rows($qer_CountOFSr); ?> </td>	
    </tr>
</table>

<input type="button" style="width: 100px;margin-left: 10px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<br /><br />
<span style='margin-left: 10px;'>After 5pm submission will be treated as next day 8:30am submission</span>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 10px;'>
    <tr style='background-color: #BEBABA;'>
        <td style='width:100px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">HELP_ID</span></td>
       <!-- <td style='width:200px; text-align: left;'><span style="margin-left: 5px;">FILE_DESCR</span></td> -->
        <td style='width:150px; text-align: right;word-wrap:break-word;'><span style="margin-right: 5px;">FACILITY_AMT</span></td>
        <td style='width:150px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">ZONE</span></td>
        <td style='width:150px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">BRANCH CODE</span></td>
        <td style='width:150px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">BRANCH NAME</span></td>
        <td style='width:200px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">FILE_RECEIVED ON</span></td>
        <td style='width:100px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">RESPONSE TYPE</span></td>
        <td style='width:250px; text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">RESPOND ON</span></td>
        <!-- <td style='width:80px;  text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">MINUTES TO RESPOND</span></td>
        <td style='width:80px;  text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">NOT RESPONDED FOR</span></td>-->
		<td style='width:80px;  text-align: left;word-wrap:break-word;'><span style="margin-left: 5px;">RESPOND/IDLE MINUTES</span></td>
    </tr>
    <?php
   
        while($RES_CountOFSr = mysqli_fetch_array($qer_CountOFSr)){
            echo "<tr>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[0]."</span></td>";
            //echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";
            echo "<td style='width:150px; text-align: right;'><span style='margin-left: 5px;'>".$RES_CountOFSr[2]."</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[3]."</span></td>";
             echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[4]."</span></td>";
            echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[5]."</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[6]."</span></td>";
            echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[7]."</span></td>";
            echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[8]."</span></td>";
            //echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[9]."</span></td>";
            //echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[10]."</span></td>";
			echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[11]."</span></td>";
            echo "<tr/>";
        }
    ?>
</table>
</span>
</form>
</body>
</html>

