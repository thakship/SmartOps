<?php
	$sDate1 = $_REQUEST['date1'];//frist Date
	$sDate2 = $_REQUEST['date2'];//second Date
	
	//echo $sDate1."<br/>";
	//echo $sDate2."<br/>";
	
	include('../../../php_con/includes/db.ini.php');
	$sqlQur = "SELECT @rownum := @rownum + 1 AS rank, temp1.`receiveBranchNumber` AS brn1,temp1.Num_of_Files AS nof1 FROM (SELECT `receiveBranchNumber`,COUNT(`fileNumber`) AS Num_of_Files FROM `courier_files` WHERE (`stats`='FDR' OR `stats`='PDR') AND DATE(`receiveDateTime`) BETWEEN '$sDate1' AND '$sDate2' group by `receiveBranchNumber`)temp1 ,(SELECT @rownum := 0) r ORDER BY nof1 DESC LIMIT 100";
	$Add_sqlQur = mysqli_query($conn,$sqlQur); 
?>
<table class="tbl1"  border="1" cellpadding="0" cellspacing="0">
      <tr>
      	<td style="text-align:left; padding-left:5px; width:50px;">#</td>
        <td style="text-align:left;padding-left:5px; width:300px;">Receive Branch</td>
       <!-- <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">Receive Branch</td>-->
        <td style="text-align:left; padding-left:5px; width:100px;">Num of Files</td>
      </tr>
<?php
	$a = 1;
	while($rec1 = mysqli_fetch_array($Add_sqlQur)){
		$brn = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$rec1[1]."'";
		//$brn1 = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$rec1[2]."'";
		$sql_Brn = mysqli_query($conn,$brn);
		//$sql_Brn1 = mysqli_query($conn,$brn1);
		
		while($rec2 = mysqli_fetch_array($sql_Brn)){
			//while($rec3 = mysqli_fetch_array($sql_Brn1)){
				echo "<tr style='background-color:#FFFFFF;'>";
				echo "<td style='width:50px;text-align:left; padding-left:5px;'>".$rec1[0]."</td>";
				echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$rec2[0]."</td>";
				/*echo "<td style='width:200px;'>
					  <input style='width:200px;' type='text' name='txtc".$a."' id='txtc".$a."' value='".$rec3[0]."' disabled='disabled'/></td>";*/
				echo "<td style='width:100px;text-align:left; padding-left:5px;'>".$rec1[2]."</td>";
				echo "</tr>";
				$a++;
			//}
		}
	}
?>
</table>