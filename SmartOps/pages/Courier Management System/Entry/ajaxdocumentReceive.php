<?php
	$x=$_REQUEST['txt1']; //send branch number
	$y=$_REQUEST['txt2']; //Courier type
	$s=$_REQUEST['txt3']; //Recevie Deparment
	$n=$_REQUEST['txt4']; //Receive Branch
	//echo $x;
	//echo $y;
	//echo $s;
	//echo $n;
	include('../../../php_con/includes/db.ini.php');
	$selectBranch = "SELECT DISTINCT(`receiveDepartmentNumber`),`departmentNumber` FROM `courier_files` WHERE `branchNumber`='$x' AND (`stats`='DR' OR `preFileNumber`= null) AND `stats`!='PDR' AND `receiveBranchNumber`='$n' AND `receiveDepartmentNumber` = '$s' AND `fileType`='$y'";
	$sql_selectBranch = mysqli_query($conn,$selectBranch);
?>
	<table class="tbl2" border="1">
      <tr>
      	<td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Branch</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Department</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Number of File</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">View</td>
      </tr>
<?php
	$_SESSION['rowDeparment'] = mysqli_num_rows($sql_selectBranch);
	$a = 1 ;
	while ($rec = mysqli_fetch_array($sql_selectBranch)){
		$brn1 = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='$x' ORDER BY `branchName`";
		$sql_brn1 = mysqli_query($conn,$brn1);
		$departmentSel = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$rec[1]."'";
		$sqldepartmentSel = mysqli_query($conn,$departmentSel);
		$numOfFile = "SELECT COUNT(`fileNumber`) FROM `courier_files` WHERE `receiveDepartmentNumber`='".$rec[0]."' AND (`stats`='DR' OR `preFileNumber`= null) AND `stats`!='PDR' AND `fileType`='$y' AND `branchNumber`='$x' AND `departmentNumber`='".$rec[1]."' ";
		$sqlnumOfFile = mysqli_query($conn,$numOfFile);
			while($rec3 = mysqli_fetch_array($sql_brn1)){
				while($rec1 = mysqli_fetch_array($sqldepartmentSel)){
					while($rec2 = mysqli_fetch_array($sqlnumOfFile)){
						echo "<tr style='background-color:#FFFFFF;'>";
						echo "<td style='width:200px;'>
							  <div id='diva".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txtz".$a."' id='txtz".$a."' value='".$x."'/></div> 
							  <input style='width:200px;' type='text' name='txtz".$a."' id='txtz".$a."' value='".$rec3[0]."' disabled='disabled'/></td>";
						echo "<td style='width:200px;'>
							  <div id='diva".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txta".$a."' id='txta".$a."' value='".$rec[1]."'/></div> 
							  <input style='width:200px;' type='text' name='txtaa".$a."' id='txtaa".$a."' value='".$rec1[0]."' disabled='disabled'/></td>";
						echo "<td style='width:200px;'>
							  <div id='divb".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."'/></div>
							  <input style='width:200px;' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."' disabled='disabled'/></td>";
						echo "</td>";	
						echo "<td style='width:100px;'>";
				 		echo "<input style='font-size: 12px;' type='button' id='btnView' name='btnView' value='View' title='txtz".$a."|txta".$a."' onclick='view(this.id,title)'/>";
						echo "</td>";
				 		echo "</tr>";
					} 
				}
			}		
		$a++;
	}	
?>
</table>
<br/>
<div id='subtbl'>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div id='subtb2'>
</div>
<div id='diva' style='display:none;'>
	<input class='txt' type='text' name='txta' id='txta' value='<?php echo $_SESSION['rowDeparment']; ?>'/>
    <input class='txt' type='text' name='txtb' id='txtb' value='<?php echo $x; ?>'/>
     <input class='txt' type='text' name='txtc' id='txtc' value='<?php echo $y; ?>'/>
</div>