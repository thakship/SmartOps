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
                        `courier_files`.`numberOfDocument` ,
                         `courier_files`.`stats`
               FROM `courier_files`,`branch`,`deparment` 
               WHERE `courier_files`.`branchNumber`='$sBranch' AND  `courier_files`.`departmentNumber`='$sDepartment' AND `courier_files`.`receiveBranchNumber`=`branch`.`branchNumber` AND `courier_files`.`receiveDepartmentNumber`=`deparment`.`deparmentNumber` AND DATE(`createDateTime`) BETWEEN '$sDate1' AND '$sDate2'";
	$query_File = mysqli_query($conn,$sqlFile);	
?>	
	<table border="1" class="tbl1" cellpadding="0" id="myTable" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-left:5px; width:50px;">Index</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">File Name</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">Receive Brnach</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Receive Department</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">Remarks</td>
         <td style="text-align:left; padding-left:5px; width:150px;">Receive Officer</td>
         <td style="text-align:left; padding-left:5px; width:100px;">Num OF Doc</td>
         <td style="text-align:left; padding-left:5px; width:100px;">File Statas</td>
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
        
        $V_statas = "-";
        
        if($rec1[6] == "JC"){
            $V_statas = "File Created"; 
        }else if($rec1[6] == "CC"){
            $V_statas = "User confirmed"; 
        }else if($rec1[6] == "AD"){
            $V_statas = "Added to department bag"; 
        }else if($rec1[6] == "AB"){
            $V_statas = "Sent to branch"; 
        }else if($rec1[6] == "OB"){
            $V_statas = "Sent to Other branch"; 
        }else if($rec1[6] == "BR"){
            $V_statas = "Receive branch"; 
        }else if($rec1[6] == "DR"){
            $V_statas = "Department received"; 
        }else if($rec1[6] == "PDR"){
            $V_statas = "User partially received"; 
            $col = "#ff9999";
        }else if($rec1[6] == "FDR"){
            $V_statas = "User fully received"; 
            $col = "#adebad";
        }else{
            $V_statas = "-";
        }
	
        
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left;padding-left:5px;'>".$a."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[0]."</td>";
		echo "<td style='width:150px;text-align:left;padding-left:5px;'>".$rec1[1]."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[2]."</td>";
		echo "<td style='width:200px;text-align:left;padding-left:5px;'>".$rec1[3]."</td>";
		echo "<td style='width:150px;text-align:left;padding-left:5px;'>".$rec1[4]."</td>";
		echo "<td style='width:100px;text-align:left;'>".$rec1[5]."</td>";
        echo "<td style='width:100px;text-align:left;'>".$V_statas."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>