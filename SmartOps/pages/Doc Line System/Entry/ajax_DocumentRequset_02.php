<?php
	$valNum = $_REQUEST['txtBoxNum'];
	//echo $valNum;
	include('../../../php_con/includes/db.ini.php');
	$sql_Box_get ="SELECT `box_number`,`doc_number`,`doc_type` FROM `doc_line_file_stack` WHERE `box_number`='$valNum' AND `action_stat`='ST'";
	$quary_Box_get = mysqli_query($conn,$sql_Box_get);
	$index = 0;
?>
<table border="1" id="myTable"  style="width:750px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px;text-align:left; padding-left:5px;">Index</td>
        <td style="width:200px;text-align:left; padding-left:5px;">Box Number</td>
        <td style="width:200px;text-align:left; padding-left:5px;">Document Number</td>
        <td style="width:100px;text-align:left; padding-left:5px;">Documnet Type</td>
        <td style="width:100px;">Confirm</td>
         <td style="width:100px;">&nbsp;</td>
     </tr>
     
<?php
	while ($rec_Box_get = mysqli_fetch_array($quary_Box_get)){
		$index++;
?>
		<tr class="tbl1">
		<td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_Box_get[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_Box_get[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value="<?php echo $rec_Box_get[2]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" checked=" checked"/></td>
         <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
<?php
	}
?>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="<?php echo $index; ?>"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="<?php echo $index; ?>" disabled="disabled"/>
   </td>
  </tr>
</table>