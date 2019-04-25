<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier count of Departmnet 
Purpose			: To get Select number of coiriers in asaind in departmnet
Author			: Madushan Wikramaarachchi
Date & Time		: 08.50 A.M 21/06/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/q/004";
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
<title>Service Request Report Selection</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->

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
    
    $sql_CountOFSr = "SELECT IFNULL(cf.receiveOfficer, 'Un Assigned') AS User_ID,
        count(*) AS Num_Courier
FROM courier_files AS cf
WHERE cf.receiveBranchNumber = '".$_SESSION['userBranch']."' AND
      cf.receiveDepartmentNumber = '".$_SESSION['userDepartment']."' AND
      (cf.stats = 'DR' OR cf.stats = 'BR') 
GROUP BY cf.receiveOfficer";
    $qer_CountOFSr = mysqli_query($conn,$sql_CountOFSr) or die(mysqli_error($conn));
    $cou_r = mysqli_num_rows($qer_CountOFSr);
?>
<span id="maneSpan">
<table border="1" cellpadding="0" cellspacing="0" id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
    <tr style='background-color: #BEBABA;'>
        <td style='width:50px;'>#</td>
        <td style='width:350px;'>User Name</td>
        <td style='width:100px;'>Num of Courier</td>
    </tr>
    <?php
         $i = 0;
         $cou = 0;
        if($cou_r == 0){
            echo "<tr>";      
            echo "<td style='width:50px;text-align: left;'><span style='margin-right: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:350px;text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>";
            echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>&nbsp;</span></td>";
            echo "</tr>";   
        }else{
           
            while($rec_CountOFSr = mysqli_fetch_array($qer_CountOFSr)){
                $i++;
                $cou = $cou + $rec_CountOFSr[1];
                echo "<tr>";      
                echo "<td style='width:50px;text-align: left;'><span style='margin-left: 10px;'>".$i."</span></td>";
                echo "<td style='width:350px;text-align: left;'><span style='margin-left: 10px;'>".$rec_CountOFSr[0]."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 10px;'>".$rec_CountOFSr[1]."</span></td>";
                echo "</tr>";  
            }
        }
        
                 
    ?>
</table>
<h3>Total record(s) : <?php echo $cou; ?></h3>
</span>
<!-- <input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/> -->
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>

