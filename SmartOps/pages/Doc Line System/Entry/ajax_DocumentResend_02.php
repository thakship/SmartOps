<?php
	$valNum = $_REQUEST['txtBoxNum'];
	//echo $valNum;
	include('../../../php_con/includes/db.ini.php');
	$sql_Box_get ="SELECT DISTINCT`doc_line_file_stack`.`box_number`,`doc_line_file_stack`.`doc_number`,
								   (SELECT T1.`doc_type` FROM `doc_line_file_stack` T1 WHERE T1.`action_stat`='RC' AND T1.`doc_type` = 'RD' AND T1.`box_number` = `doc_line_file_stack`.`box_number` and T1.`doc_number` = `doc_line_file_stack`.`doc_number`) AS RD,
								   (SELECT T2.`doc_type` FROM `doc_line_file_stack` T2 WHERE T2.`action_stat`='RC' AND T2.`doc_type` = 'SD' AND T2.`box_number` = `doc_line_file_stack`.`box_number` AND T2.`doc_number` = `doc_line_file_stack`.`doc_number`) AS SD
				   FROM `doc_line_file_stack` 
				   WHERE `doc_line_file_stack`.`box_number`='$valNum' AND `doc_line_file_stack`.`action_stat`='RC'";
	$quary_Box_get = mysqli_query($conn,$sql_Box_get);
	$index = 0;
?>
<table border="1" id="myTable"  style="width:900px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Box Number</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Document Number</td>
       	<td style="width:100px; text-align:left; padding-left:5px;">Reference Documnet</td>
        <td style="width:100px; text-align:left; padding-left:5px;">Security Documnet</td>
        <td style="width:150px;">Courier Branch</td>
        <td style="width:100px;">&nbsp;</td>
     </tr>
     
<?php
	while ($rec_Box_get = mysqli_fetch_array($quary_Box_get)){
		$index++;               
		if($rec_Box_get[2] == "RD" && $rec_Box_get[3] == "SD"){
			$rd = "checked";
			$sd = "checked";	
		}else if($rec_Box_get[2] == "RD" && $rec_Box_get[3] != "SD"){
			$rd = "checked";	
			$sd = "disabled=\"disabled\"";	
			
		}else if($rec_Box_get[2] != "RD" && $rec_Box_get[3] == "SD"){
			$rd = "disabled=\"disabled\"";	
			$sd = "checked";	
		}else{
			$rd = "disabled=\"disabled\"";
			$sd = "disabled=\"disabled\"";	
		}
?>
		<tr class="tbl1" id="<?php echo "tr".$index; ?>" style="background:#FFFFFF;">
		<td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_Box_get[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_Box_get[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" <?php echo $rd; ?> /></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" <?php echo $sd; ?> /></td>
         <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" title="<?php echo $index; ?>" readonly="readonly" onclick="clickBranch(title , 1)"/></td>
        <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
		</tr>
<?php
	}
?>
</table>
<div id="nodTable">
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="<?php echo $index; ?>"/>
            <input type="text" name="txtrowCount" id="txtrowCount" value="<?php echo $index; ?>"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="<?php echo $index; ?>" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>