<?php
	$s=$_REQUEST['a1']; //Send Brnsch
	$p=$_REQUEST['a2']; //receive Resive
	$t=$_REQUEST['a3']; //file Type
	include('../../../php_con/includes/db.ini.php');
	$selectFile = "SELECT `fileName`,`createDateTime`,`branchNumber`,`departmentNumber`,`receiveDepartmentNumber`,`receiveBranchNumber`,`numberOfDocument`,`fileNumber` FROM `courier_files` WHERE `branchNumber`='$s' AND `receiveBranchNumber`='$p' AND (`stats`='AB' OR `stats`='OB') AND `fileType` = '$t'";
	$sqlselectFile = mysqli_query($conn,$selectFile);
	
?>
<br/>
<table class="tbl3" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">File Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Create Date &amp; Time</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Send Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Send Department Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Receive Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Receive Department Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:50px;">Num of Doc</td>
      </tr>

<?php
	$f = 1;
	while($rec = mysqli_fetch_array($sqlselectFile)){
		$senddepartment = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$rec[3]."'";
		$sqlsenddepartment = mysqli_query($conn,$senddepartment);
		$rdepartment = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$rec[4]."'";
		$sqlrdepartment = mysqli_query($conn,$rdepartment);
		$sendbranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$rec[2]."'";
		$sqlsendbranch = mysqli_query($conn,$sendbranch);
		$rbranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$rec[5]."'";
		$sqlrbranch = mysqli_query($conn,$rbranch);
		while($rec1 = mysqli_fetch_array($sqlsenddepartment)){
			while($rec2 = mysqli_fetch_array($sqlrdepartment)){
				while($rec3 = mysqli_fetch_array($sqlsendbranch)){
					while($rec4 = mysqli_fetch_array($sqlrbranch)){
						echo "<tr style='background-color:#FFFFFF;'>";
						echo "<td style='width:200px;'>
							<div style='display:none;'>
							 <input style='width:200px;' type='text' name='txtFnum".$f."' id='txtFnum".$f."' value='".$rec[7]."'/>
							 </div>
							  <input style='width:200px;' type='text' name='txt' id='txt' value='".$rec[0]."' disabled='disabled'/></td>";
						echo "<td style='width:150px;'>
							  <input style='width:150px;' type='text' name='txt' id='txt' value='".$rec[1]."' disabled='disabled'/></td>";
						echo "<td style='width:150px;'>
							  <input style='width:150px;' type='text' name='txt' id='txt' value='".$rec3[0]."' disabled='disabled'/></td>";
						echo "<td style='width:150px;'>
							  <input style='width:150px;' type='text' name='txt' id='txt' value='".$rec1[0]."' disabled='disabled'/></td>";
						echo "<td style='width:150px;'>
							  <input style='width:150px;' type='text' name='txt' id='txt' value='".$rec4[0]."' disabled='disabled'/></td>";
						echo "<td style='width:150px;'>
							  <input style='width:150px;' type='text' name='txt' id='txt' value='".$rec2[0]."' disabled='disabled'/></td>";
						echo "<td style='width:=50px;'>
							 <input style='font-size: 12px;' type='button' id='btnViewFile' name='btnViewFile' value='View' title='txtFnum".$f."' onclick='viewGet(this.id,title)'/></td>";
						echo "</tr>";
						$f++;
					}
				}
			}
		}
	}
	
?>
</table>