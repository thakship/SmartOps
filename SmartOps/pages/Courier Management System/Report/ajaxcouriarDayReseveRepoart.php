<?php
	$sDate1 = $_REQUEST['date1'];//From Date
	$sBranch = $_REQUEST['bran'];//User Barnch
	$sDepartment = $_REQUEST['depar'];//User Department
	$sDate2 = $_REQUEST['date2'];//To Date
	include('../../../php_con/includes/db.ini.php');
	$sqlFile = "SELECT `courier_files`.`fileName`, 
                        `branch`.`branchName`, 
                        `deparment`.`deparmentName`, 
                        `courier_files`.`remarks`,
                        `courier_files`.`receiveOfficer`,
                        `courier_files`.`numberOfDocument`,
                        `courier_files`.`sendDateTime` 
                FROM `courier_files`,`branch`,`deparment` 
                WHERE `courier_files`.`receiveBranchNumber`='".$sBranch."' AND  
                      `courier_files`.`receiveDepartmentNumber`='".$sDepartment."' AND 
                      `courier_files`.`branchNumber`=`branch`.`branchNumber` AND 
                      `courier_files`.`departmentNumber`=`deparment`.`deparmentNumber` AND  
                      `courier_files`.`stats` IN ('AB','OB','BR','DR','FDR','PDR') AND
                      DATE(`sendDateTime`) BETWEEN '".$sDate1."' AND '".$sDate2."'";
                      
                      // `courier_files`.`stats` IN ('AB','OB','BR','DR','FDR','PDR') Mofifiy by madushan 2016-09-12
	$query_File = mysqli_query($conn,$sqlFile);	
    // `courier_files`.`fileNumber` IN (SELECT `fileNumber` FROM `filemovement` WHERE `action` = 'sent to branch') AND
?>	
	<table border="1" id="myTable" class="tbl1" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-left:5px; width:50px;">Index</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">File Name</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">Send Brnach</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Send Department</td>
         <td style="text-align:left; padding-left:5px; width:200px;">Send Date time</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Remarks</td>
         <td style="text-align:left; padding-left:5px; width:150px;">Receive Officer</td>
         <td style="text-align:left; padding-left:5px; padding-bottom:5;width:100px;">Num OF Doc</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while ($rec1= mysqli_fetch_array($query_File)){
		
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left;padding-left:5px;'>".$a."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[0]."</td>";
		echo "<td style='width:150px;text-align:left;padding-left:5px;'>".$rec1[1]."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[2]."</td>";
 	      echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[6]."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[3]."</td>";
		echo "<td style='width:150px;text-align:left;padding-left:5px;'>".$rec1[4]."</td>";
		echo "<td style='width:100px;text-align:left;padding-left:5px;'>".$rec1[5]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>