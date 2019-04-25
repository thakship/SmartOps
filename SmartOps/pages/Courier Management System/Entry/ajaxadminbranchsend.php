<?php
	$x=$_REQUEST['txt1']; //Receive branch number
	$y=$_REQUEST['txt2']; //fileType
	$z=$_REQUEST['txt3']; //User branch
	//echo $z;
	include('../../../php_con/includes/db.ini.php');
	$selectBranch = "SELECT DISTINCT(`receiveDepartmentNumber`),`stats` FROM `courier_files` WHERE `receiveBranchNumber`='".$x."' AND `stats`='AD' AND `fileType`='".$y."' AND `branchNumber` = '".$z."'";
	$sql_selectBranch = mysqli_query($conn,$selectBranch);
?>
	
	<table class="tbl2" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Department Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Number of File</td>
      </tr>
<?php
	$a = 1 ;
	while ($rec = mysqli_fetch_array($sql_selectBranch)){
		$departmentSel = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$rec[0]."'";
		$sqldepartmentSel = mysqli_query($conn,$departmentSel);
		$numOfFile = "SELECT COUNT(`receiveDepartmentNumber`) FROM `courier_files` WHERE `receiveDepartmentNumber`='".$rec[0]."' AND `stats`='AD' AND `fileType`='".$y."' AND `branchNumber` = '".$z."'";
		$sqlnumOfFile = mysqli_query($conn,$numOfFile);
				while($rec1 = mysqli_fetch_array($sqldepartmentSel)){
					while($rec2 = mysqli_fetch_array($sqlnumOfFile)){
						echo "<tr style='background-color:#FFFFFF;'>";
						echo "<td style='width:200px;'>
							  <div id='diva".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txta".$a."' id='txta".$a."' value='".$rec[0]."'/></div> 
							  <input style='width:200px;' type='text' name='txta".$a."' id='txta".$a."' value='".$rec1[0]."' disabled='disabled'/></td>";
						echo "<td style='width:100px;'>
							  <div id='divb".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."'/></div>
							  <input style='width:100px;' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."' disabled='disabled'/></td>";
					}
				}
		echo "</tr>";
		$a++;
	}
?>
</table>