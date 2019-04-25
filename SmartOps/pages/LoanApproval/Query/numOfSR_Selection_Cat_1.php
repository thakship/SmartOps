<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Requestcount of Departmnet 
Purpose			: To get Select number of Service Request in open State in departmnet
Author			: Madushan Wikramaarachchi
Date & Time		: 09.02 A.M 17/02/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/q/004";
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
<title>Service Request Report Selection</title>
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
    
    $sql_CountOFSr = "SELECT ch.`cat_code` AS Cat_Code, (SELECT `cat_discr` FROM `cat_states` WHERE `cat_code` = ch.`cat_code` and `car_state` = 1) AS Category, IFNULL(`asing_by`, '-') AS User_ID, IFNULL((SELECT `userID` FROM `user` WHERE `userName` = `asing_by`),'Un Assigned') as User_Name, count(*) AS Num_Issues
                        FROM `cdb_helpdesk` ch
                        WHERE ch.`cmb_code` = '5001' 
                          /* and 			 DATEDIFF(date('2015-04-06') , date(ch.`enterDateTime`)) > 5 */ AND
 ch.`cat_code` in (SELECT `cat_code` FROM `cdb_help_user_oth` WHERE `user_group` = '" . $_SESSION['usergroupNumber'] . "') group by ch.`cat_code`,ch.`asing_by` order by ch.`cat_code`";
    $qer_CountOFSr = mysqli_query($conn,$sql_CountOFSr);
?>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 10px;'>
    <tr style='background-color: #BEBABA;'>
        <td style='width:100px;'>Category ID</td>
        <td style='width:150px;'>Category Name</td>
        <td style='width:80px; text-align: left;'>User ID</td>
        <td style='width:350px;'>User Name</td>
        <td style='width:100px;'>Num of Issuse</td>
    </tr>
    <?php
    $isNewRow = true;
    $oldValue = "";
    $count = 0;
        while($RES_CountOFSr = mysqli_fetch_array($qer_CountOFSr)){
            if(!$isNewRow){
                $isNewRow = $oldValue != $RES_CountOFSr[1];
            } 
                
            $count += $RES_CountOFSr[4];
            if ($isNewRow){
                echo "<tr>";
                echo "<td  colspan='5' style='width:150px;text-align: left; font-weight: bold;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";         
                echo "</tr>";    
                
                echo "<tr>";
                echo "<td style='width:100px;text-align: right; font-weight: bold;''><span style='margin-right: 5px;'>".$RES_CountOFSr[0]."</span></td>";
                echo "<td style='width:150px;text-align: left; font-weight: bold;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";         
                echo "<td style='width:80px;text-align: left; font-weight: bold;''><span style='margin-right: 5px;'>".$RES_CountOFSr[2]."</span></td>";
                echo "<td style='width:350px;text-align: left; font-weight: bold;''><span style='margin-left: 5px;'>".$RES_CountOFSr[3]."</span></td>";
                echo "<td style='width:100px;text-align: right; font-weight: bold;''><span style='margin-right: 5px;'>".$RES_CountOFSr[4]."</span></td>";
                echo "</tr>";    
                $isNewRow = false;
            }else{
                echo "<tr>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_CountOFSr[0]."</span></td>";
                echo "<td style='width:150px;text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[1]."</span></td>";         
                echo "<td style='width:80px;text-align: left;'><span style='margin-right: 5px;'>".$RES_CountOFSr[2]."</span></td>";
                echo "<td style='width:350px;text-align: left;'><span style='margin-left: 5px;'>".$RES_CountOFSr[3]."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$RES_CountOFSr[4]."</span></td>";
                echo "</tr>";    
                
            }
            $oldValue = $RES_CountOFSr[1];
        }
    ?>
</table>
<h3>Total record(s) : <?php echo $count; ?></h3>
</span>
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>

