<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request count of Our departmnet 
Purpose			: To get Select number of Service Request in open Send my State in departmnet
Author			: Madushan Wikramaarachchi
Date & Time		: 12.14 P.M 04/03/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/006";
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
<title>SR Send Report Selection</title>
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
    $sql_CountOFSr = "SELECT  (SELECT `branchName` FROM `branch` WHERE `branchNumber` = ch.`entry_branch`) AS BRANCH_NAME, 
        (SELECT `deparmentName` FROM `deparment` WHERE `branchNumber` = ch.`entry_branch` AND `deparmentNumber` = ch.`entry_department`) AS DEPARTMENT,
	ch.`cat_code` AS CATEGORY_CODE,
        (SELECT cs.`cat_discr` FROM `cat_states` cs WHERE cs.`cat_code` =  ch.`cat_code`)  AS CATEGORY_DESC,
        count(*) AS PENDING
FROM `cdb_helpdesk` ch 
WHERE ch.`entry_branch` = '".$_SESSION['userBranch']."' 
  AND ch.`entry_department` = '".$_SESSION['userDepartment']."'
  AND ch.`enterBy` = '".$_SESSION['user']."'
  AND ch.`cmb_code` = '5001'
group by ch.`entry_branch`, ch.`entry_department`, ch.`cat_code`
order by ch.`entry_branch`, ch.`entry_department`";
    $qer_CountOFSr = mysqli_query($conn,$sql_CountOFSr);
?>
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<br /><br />
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 10px;'>
    <tr style='background-color: #BEBABA;'>
        <td style='width:200px; text-align: left;'><span style="margin-left: 5px;">Branch Name</span></td>
        <td style='width:200px; text-align: left;'><span style="margin-left: 5px;">Department Name</span></td>
        <td style='width:80px; text-align: right;'><span style="margin-right: 5px;">Category Code</span></td>
        <td style='width:200px; text-align: left;'><span style="margin-left: 5px;">Category Name</span></td>
        <td style='width:50px; text-align: left;'><span style="margin-left: 5px;">Pending</span></td>
    </tr>
    <?php
    $isNewRow = true;
    $oldValue = "";
        while($RES_CountOFSr = mysqli_fetch_array($qer_CountOFSr)){
    
            $isNewRow = $oldValue != ($RES_CountOFSr[0] . $RES_CountOFSr[1]);
            
            if($isNewRow){
                echo "<tr>";
                echo "<td style='width:200px; text-align: left; font-weight: bold;'><span style='margin-left: 5px;'>".$RES_CountOFSr[0]."</span></td>";
                echo "<td colspan='4' style='width:200px;text-align: left; font-weight: bold;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";
                echo "</tr>";    
                $isNewRow = false;
            }
            echo "<tr>";
            echo "<td style='width:200px;text-align: left; font-weight: bold;''><span style='margin-left: 5px;'>&nbsp</span></td>";
            echo "<td style='width:200px;text-align: left; font-weight: bold;'><span style='margin-left: 5px;'>&nbsp</span></td>";         
            echo "<td style='width:80px;text-align: right; font-weight: bold;''><span style='margin-right: 5px;'>".$RES_CountOFSr[2]."</span></td>";
            echo "<td style='width:200px;text-align: left; font-weight: bold;''><span style='margin-left: 5px;'>".$RES_CountOFSr[3]."</span></td>";
            echo "<td style='width:50px;text-align: left; font-weight: bold;''><span style='margin-left: 5px;'>".$RES_CountOFSr[4]."</span></td>";
            echo "</tr>";    
                
            $oldValue = ($RES_CountOFSr[0] . $RES_CountOFSr[1]);

        }
    ?>
</table>
</span>
</form>
</body>
</html>

