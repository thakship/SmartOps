<?php
	$q=$_REQUEST['a1']; //Receive Deparment
	$p=$_REQUEST['a2']; //Receive Branch
	$e=$_REQUEST['a3']; //Courier Type
	$u=$_REQUEST['a4']; //SendBranch
	$w=$_REQUEST['a5']; //SendDepartment
	include('../../../php_con/includes/db.ini.php');
	$Sub1 = "SELECT `fileNumber`,`fileName`,`numberOfDocument`,`receiveOfficer` FROM `courier_files` WHERE `receiveBranchNumber` = '$p' AND `receiveDepartmentNumber` = '$q' AND (`stats` = 'DR' OR `preFileNumber`= null) AND `stats`!='PDR' AND `fileType` = '$e' AND `branchNumber`='$u' AND `departmentNumber`= '$w' ORDER BY `receiveOfficer`";
	$sqlSub1 = mysqli_query($conn,$Sub1);
	$sql_sqlSub1 = mysqli_num_rows($sqlSub1);
?>



<table class="tbl3" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:350px;">File Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Num of Doc</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">Receive Officer</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
      </tr>
<?php
    $a=1;
	while($recSub1 = mysqli_fetch_array($sqlSub1)){
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:350px;'>
			  <div id='diva".$a."' style='display:none;'>
			  <input type='text' name='txte".$a."' id='txte".$a."' value='".$recSub1[0]."'/>
			  </div> 
			  <input style='width:350px;' type='text' name='txt' id='txt' value='".$recSub1[1]."' disabled='disabled'/></td>";
		echo "<td style='width:100px;'>
			  <div id='diva".$a."' style='display:none;'>
			  <input type='text' name='txtf".$a."' id='txtf".$a."' value='".$recSub1[2]."'/>
			  </div>
			  <input style='width:100px;' type='text' name='txt' id='txt' value='".$recSub1[2]."' disabled='disabled'/></td>";
		echo "<td style='width:150px;'>
			  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recSub1[3]."' disabled='disabled'/></td>";
		echo "<td style='width:100px;'>";
		echo "<input style='font-size: 12px;' type='button' id='btnView1' name='btnView1' title='txte".$a."' value='View' onclick='show(this.id);view1(this.id,title)'/>";		
		echo "</td>";
		echo "</tr>";
		$a++;
			
	}
	
?>
</table>
<div style='display:none;'>
	<input type='text' name='txts' id='txts' value='<?php echo $sql_sqlSub1; ?>' required/>
</div>