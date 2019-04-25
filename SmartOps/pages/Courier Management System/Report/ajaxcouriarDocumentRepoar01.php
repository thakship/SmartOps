<?php
	$dateget=$_REQUEST['date1'];//Select Date
	$sendBranchget=$_REQUEST['bran'];//Select Send Branch
	$sendDepartmentget=$_REQUEST['depar'];//Select Send Department
	
	//echo $dateget." ".$sendBranchget." ".$sendDepartmentget;
	
include('../../../php_con/includes/db.ini.php');
	//$selectFileName = "SELECT @rownum := @rownum + 1 AS Line,`courier_files`.`fileNumber`, `courier_files`.`fileName`, `courier_files`.`remarks` FROM `courier_files`,(SELECT @rownum := 0) r WHERE `courier_files`.`branchNumber`='$sendBranchget' AND  `courier_files`.`departmentNumber`='$sendDepartmentget' AND DATE(`createDateTime`)= '$dateget'";
	
    $selectFileName = "SELECT @rownum := @rownum + 1 AS Line,`courier_files`.`fileNumber`, `courier_files`.`fileName`,`branch`.branchName ,`courier_files`.`remarks` 
                        FROM `courier_files`,`branch`,(SELECT @rownum := 0) r 
                        WHERE `courier_files`.receiveBranchNumber =  `branch`.branchNumber AND
                              `courier_files`.`branchNumber`='".$sendBranchget."' AND  
                        			`courier_files`.`departmentNumber`='".$sendDepartmentget."' AND 
                        			 DATE(`createDateTime`)= '".$dateget."';";
	
    //echo $selectFileName;	
	//				   
	$sql_selectFileName = mysqli_query($conn,$selectFileName);
?>
<table class="tbl1" border="1" cellpadding="0"  cellspacing="0" id="myTable">
      <tr>
      	<td style="text-align:left; padding-left:5px; width:50px;">Rank</td>
        <td style="text-align:left; padding-left:5px; width:150px;">File Number</td>
        <td style="text-align:left; padding-left:5px;width:200px;">File Name</td>
        <td style="text-align:left; padding-left:5px;width:150px;">Branch</td>
        <td style="text-align:left; padding-left:5px;width:300px;">Remark</td>
        <td style="text-align:left; padding-left:5px;width:80px;">View</td>
      </tr>
<?php
	$a = 1;
	while ($rec1 = mysqli_fetch_array($sql_selectFileName)){
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:50px;padding-left:5px;text-align:left;'>".$rec1[0]."</td>";
		echo "<td style='width:150px;padding-left:5px;text-align:left;'>
			  <div style='display:none;'>
			  <input class='txt' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec1[1]."'/></div> 
			  ".$rec1[1]."</td>";
		echo "<td style='width:200px;padding-left:5px;text-align:left;'>".$rec1[2]."</td>";
		echo "<td style='width:150px;padding-left:5px;text-align:left;'>".$rec1[3]."</td>";
        echo "<td style='width:300px;padding-left:5px;text-align:left;'>".$rec1[4]."</td>";
		echo "<td style='width:80px;'>";
		echo "<input type='button' id='btnView' name='btnView' value='View' title='txtb".$a."' onclick='filemovement(this.id,title)'/>";
		echo "</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>