<?php
	$s=$_REQUEST['a1']; //send Brach
	$p=$_REQUEST['a2']; //receive department name
	$t=$_REQUEST['a3']; //file name
	//echo $t;
	include('../../../php_con/includes/db.ini.php');
    
	$selectFile = "SELECT `fileName`,`createDateTime`,`branchNumber`,`departmentNumber`,`receiveDepartmentNumber`,`receiveBranchNumber`,`numberOfDocument`,`fileNumber` FROM `courier_files` WHERE `branchNumber`='$s' AND `receiveDepartmentNumber`='$p' AND `stats`='AB' AND `fileType` = '$t'";
	$sqlselectFile = mysqli_query($conn,$selectFile);
    //echo mysqli_num_rows($sqlselectFile);
	$_SESSION['rowDeparment'] = mysqli_num_rows($sqlselectFile);
    
?>

<br/>
<table class="tbl3" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">File Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Create Date & Time</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Send Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Send Department Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Receive Branch Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Receive Department Name</td>
         <td style="text-align:center; padding-top:5px; padding-bottom:5;width:50px;">Num of Doc</td>
      </tr>

<?php
	$i = 1;
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
							  <input style='width:50px;' type='text' name='txtref".$i."' id='txtref".$i."' value='".$rec[7]."' />
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
							  <input style='width:50px;' type='text' name='txt' id='txt' value='".$rec[6]."' disabled='disabled'/></td>";
						echo "</tr>";
						$i++;
					}
				}
			}
		}
	}
	
?>
</table><br/><hr/>
<div style="display: none;">
<input class='txt' type='text' name='txta' id='txta' value='<?php echo $i; ?>'/>
</div>
<table>
	<tr>
    	<td><input type="checkbox" name="cheRoot" id="cheRoot" value="chekedroot" onclick="showsub(this.id);"/></td>
		<td>Required root chenge</td>
    </tr>
</table>
<table>
  <tr>
    <td style=" width:100px;"><p class="linetop">Receive Branch</p></td>
    <td>
    	<?php
			$rootchebrn="SELECT `branchNumber`,`branchName` FROM `branch`  WHERE `branchNumber`='0001' ";
			$qurRootBrn = mysqli_query($conn,$rootchebrn);
		?>
        <select name="selBranchNumber" id="selBranchNumber" onKeyPress="return disableEnterKey(event)" onchange="department()" disabled="disabled">
            			<option value="">--Select Branch Name--</option>
            			<?php
			 				while ($rootbrn = mysqli_fetch_array($qurRootBrn)){
			 					echo "<option value='".$rootbrn[0]."'>".$rootbrn[1]."</option>";
			 				}
						?>
            		</select>
    </td>
     <td valign="bottom"><p class="linetop">Receive Department </p></td>
    <td>
    	 <div id="diva">
    		 &nbsp;&nbsp; <select name="selDepartmentNumber" id="selDepartmentNumber" onKeyPress="return disableEnterKey(event)" disabled="disabled">
            	 		  	<option value="">--Select Department Name--</option>
              			  </select>
         </div>
    </td>
    <td><p class="linetop">Receive Officer</p></td>
    <td>
    	&nbsp;&nbsp;<input type="text" name="txtResiveOfficer" id="txtResiveOfficer" value=""  onKeyPress="return disableEnterKey(event)" disabled="disabled"/>
    	</td>
  </tr>
</table>
<table>
	<tr>
    <td style=" width:100px; vertical-align:top;"><p class="linetop">Remarks</p></td>
    <td>
   		<textarea rows="3" cols="40" name="txtareSN" id="txtareSN" disabled="disabled"></textarea>
   </td>
  </tr>
</table>
