<?php
	$sendDate=$_REQUEST['date1'];//Select Date
	//echo $sendDate;
include('../../../php_con/includes/db.ini.php');
	$filefull = "SELECT @rownum := @rownum + 1 AS Line,tmp.brn_num, tmp.brn_name, tmp.sen_Date FROM (SELECT DISTINCT`courier_files`.`branchNumber` brn_num, `branch`.`branchName` brn_name,`courier_files`.`sendDateTime` sen_Date FROM `courier_files`,`branch` WHERE `courier_files`.`branchNumber` = `branch`.`branchNumber` AND DATE(`courier_files`.`sendDateTime`)='$sendDate' ORDER BY `courier_files`.`branchNumber` )tmp,(SELECT @rownum := 0) r ";
   // echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
?>
<table border="1" class="tbl1" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
         <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">&nbsp;&nbsp;&nbsp;&nbsp;Branch Num</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Branch Name</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:300px;">&nbsp;&nbsp;&nbsp;&nbsp;Send Date and Time</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while ($rec2 = mysqli_fetch_array($sql_filefull)){
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left;'>".$rec2[0]."</td>";
		echo "<td style='width:150px;text-align:left;'>".$rec2[1]."</td>";
		echo "<td style='width:200px;text-align:left;'>".$rec2[2]."</td>";
		echo "<td style='width:300px;text-align:left;'>".$rec2[3]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>