<?php
if(isset($_REQUEST['txt1']) && isset($_REQUEST['txt2']) && isset($_REQUEST['txt2'])){
        	$x=$_REQUEST['txt1'];//send branch number
        	$y=$_REQUEST['txt2'];//file type
        	$r=$_REQUEST['txt3'];//Resive Branch numbe

	include('../../../php_con/includes/db.ini.php');
	$selectBranch = "SELECT DISTINCT(`receiveDepartmentNumber`),`stats`,`branchNumber` FROM `courier_files` WHERE `branchNumber`='".$x."' AND `stats`='AB' AND `branchNumber`='".$x."' AND `receiveBranchNumber`='".$r."' AND `fileType`='".$y."'  AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001'";
	$sql_selectBranch = mysqli_query($conn,$selectBranch);
?>
	<table class="tbl2" border="1">
      <tr>
      	<td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">From Branch Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">From Department Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Number of File</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">View</td>
      </tr>
<?php
	$a = 1 ;
	while ($rec = mysqli_fetch_array($sql_selectBranch)){
		$departmentSel = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`= '".$rec[0]."'";
		$sqldepartmentSel = mysqli_query($conn,$departmentSel);
		$beranchSel = "SELECT `branchName` FROM `branch` WHERE `branchNumber`='".$x."'";
		$sqlBranchSel = mysqli_query($conn,$beranchSel);
		$numOfFile = "SELECT COUNT(`receiveDepartmentNumber`) FROM `courier_files` WHERE `receiveDepartmentNumber`='".$rec[0]."' AND `fileType`='$y' AND (`stats`='AB') AND `branchNumber`='$x'  AND `receiveBranchNumber` != '0001' AND `branchNumber` != '0001'";
		$sqlnumOfFile = mysqli_query($conn,$numOfFile);
			while($rec3 = mysqli_fetch_array($sqlBranchSel)){
				while($rec1 = mysqli_fetch_array($sqldepartmentSel)){
					while($rec2 = mysqli_fetch_array($sqlnumOfFile)){
						echo "<tr style='background-color:#FFFFFF;'>";
						echo "<td style='width:200px;'>
							  <div id='divc".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txtd".$a."' id='txtd".$a."' value='".$x."'/></div> 
							  <input style='width:200px;' type='text' name='txtcc".$a."' id='txtcc".$a."' value='".$rec3[0]."' disabled='disabled'/></td>";
						echo "<td style='width:200px;'>
							  <div id='diva".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txta".$a."' id='txta".$a."' value='".$rec[0]."'/></div> 
							  <input style='width:200px;' type='text' name='txtaa".$a."' id='txtaa".$a."' value='".$rec1[0]."' disabled='disabled'/></td>";
						echo "<td style='width:100px;'>
							  <div id='divb".$a."' style='display:none;'>
							  <input class='txt' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."'/></div>
							  <input style='width:100px;' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec2[0]."' disabled='disabled'/></td>";
						echo "<td style='width:100px;'>";
							if($rec[1] == "AB"){
								echo "<input type='checkbox' name='chka' id='chka' checked='checked'/>";
							}else{
								echo "<input type='checkbox' name='chka' id='chka'/>";
							}
						echo "</td>";	
						echo "<td style='width:100px;'>";
				 		echo "<input style=' font-size: 12px;' type='button' id='btnView' name='btnView' value='View' title='txta".$a."|$x' onclick='show(this.id);view(this.id,title)'/>";
						echo "</td>";
				 		echo "</tr>";
					}
				}
			}		
		$a++;
	}	
?>
</table>
<div style='display:none;'>
    <input class='txt' type='text' name='txtb' id='txtb' value='<?php echo $x; ?>'/>
     <input class='txt' type='text' name='txtc' id='txtc' value='<?php echo $y; ?>'/>
</div>
<?php
    }
?>