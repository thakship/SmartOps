<?php
	$couBranch =  $_REQUEST['txt1'];// Select from Branch 
	$couType = $_REQUEST['txt2'];//Select couriar type
	$couDate =  $_REQUEST['txt3'];//Select couriar Date
	include('../../../php_con/includes/db.ini.php');
	$selectFileName = "SELECT @rownum := @rownum + 1 AS rank,`fileNumber`,`fileName`,`receiveBranchNumber`,`numberOfDocument`,`receiveDateTime` FROM `courier_files`,(SELECT @rownum := 0) r where `branchNumber`='$couBranch' AND `fileType`='$couType' AND DATE(`createDateTime`) like '$couDate'";
	//echo $selectFileName;					   
	$sql_selectFileName = mysqli_query($conn,$selectFileName);
	
	
?>
<table class="tbl1" border="1" cellpadding="0" cellspacing="0">
      <tr>
      	<td style="text-align:left; padding-top:5px; padding-left:5px; width:50px;">#</td>
        <td style="text-align:left; padding-top:5px; padding-left:5px; width:150px;">File Number</td>
        <td style="text-align:left; padding-top:5px; padding-left:5px;width:250px;">File Name</td>
        <td style="text-align:left; padding-top:5px; padding-left:5px;width:100px;">Receive Branch</td>
        <td style="text-align:left; padding-top:5px; padding-left:5px;width:50px;">num. Doc</td>
        <td style="text-align:left; padding-top:5px; padding-left:5px;width:200px;">Receive Date and Time</td>
      </tr>
<?php
	$a = 1;
	while($rec1 = mysqli_fetch_array($sql_selectFileName)){
		$brn = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$rec1[3]."'";
		$sql_Brn = mysqli_query($conn,$brn);
		while($rec2 = mysqli_fetch_array($sql_Brn)){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:50px;text-align:left; padding-left:5px;'>".$rec1[0]."</td>";
			echo "<td style='width:150px;text-align:left;padding-left:5px;'>".$rec1[1]."</td>";
			echo "<td style='width:250px;text-align:left;padding-left:5px;'>".$rec1[2]."</td>";
			echo "<td style='width:100px;text-align:left;padding-left:5px;'>".$rec2[0]."</td>";
			echo "<td style='width:50px;text-align:left;padding-left:5px;'>".$rec1[4]."</td>";
			echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[5]."</td>";
			echo "</tr>";
			$a++;
		}
	}
?>
</table>