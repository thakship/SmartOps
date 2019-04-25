<?php
	$m=$_REQUEST['sub2'];//groupDoc
	//echo $m;
	include('../../../php_con/includes/db.ini.php');
	$sqltbl = "SELECT `courier_groupdoc`.`documentNumber`,`courier_masters_document`.`documentName` 
			   FROM `courier_groupdoc`,`courier_masters_document` 
               WHERE `courier_groupdoc`.`documentNumber`= `courier_masters_document`.`documentNumber` AND 
			   		 `courier_groupdoc`.`groupCodeDoc`= '$m' ORDER BY `sOrder`";
	$sql_selectBranch = mysqli_query($conn,$sqltbl);
	$rowNewTxt = mysqli_num_rows($sql_selectBranch);
	if($m!=""){
?>
<table width="921" border="1" id="myTable" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Document Number</td>
    <td width="449" style="width:350px;">Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
 <?php
 	$d = 1;
 	while ($recNew = mysqli_fetch_array($sql_selectBranch)){
		echo "<tr style='width:800px;'>";
		echo "<td style='wdth:100px;'><input style='width:100px;' type='text' name='txta".$d."' id='txta".$d."' value='".$d."'  onKeyPress='return disableEnterKey(event)' readonly required/></td>";
		echo "<td style='width:350px;'><input style='width:350px;' type='text' name='txtb".$d."' id='txtb".$d."' value='".$recNew[0]."'  onKeyPress='return disableEnterKey(event)' onclick='popup(1);getValue(this);' required/></td>";
		echo "<td style='width:350px;'><input style='width:350px;' type='text' name='txtc".$d."' id='txtc".$d."' value='".$recNew[1]."'  onKeyPress='return disableEnterKey(event)' readonly required/></td>";
		echo "<td style='width:100px;'><input type='button' value='Delete' onclick='deleteRow(this)'></td>";
		echo "</tr>";
		$d++;
	}	
 ?>
</table>
<table>
  <tr>
    <td><p class="linetop">Number of Document(s)</p></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="<?php echo $rowNewTxt; ?>"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="<?php echo $rowNewTxt; ?>" disabled="disabled"/>
   </td>
  </tr>
</table>
<?php
}else{
?>
<table width="921" border="1" id="myTable" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Document Number</td>
    <td width="449" style="width:350px;">Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
  <tr style="width:800px;">
    <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" onclick="popup(1);getValue(this);" required/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtc1" id="txtc1" value=""  onKeyPress="return disableEnterKey(event)" readonly required/></td>
     <td style="width:100px;"><input type="button" value="Delete" onclick="deleteRow(this)"></td>
  </tr>
</table>
<table>
  <tr>
    <td><p class="linetop">Number of Document(s)</p></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
<?php
}
?>