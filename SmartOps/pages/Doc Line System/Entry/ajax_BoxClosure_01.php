<?php		
	$boxNumber = $_REQUEST['txt1'];	
	include('../../../php_con/includes/db.ini.php');	
	$index = 0;
	$isNewRecord = "";
	$sql_file_list = "SELECT MIS.`doc_number` AS DOCUMENT_NO,
							(SELECT `doc_name` FROM `doc_line_doc_mast` WHERE `doc_line_doc_mast`.`doc_number` = MIS.`doc_number`) AS DOCUMENT_NAME,
							(SELECT 'checked' FROM `doc_line_file_stack` WHERE `doc_type` = 'RD' AND `box_number` = '$boxNumber' AND `doc_line_file_stack`.`doc_number` =  MIS.`doc_number`) AS RD,
							(SELECT 'checked' FROM `doc_line_file_stack` WHERE `doc_type` = 'SD' AND `box_number` = '$boxNumber' AND `doc_line_file_stack`.`doc_number` =  MIS.`doc_number`)  AS SD
								FROM (
								SELECT distinct `doc_number`
								FROM `doc_line_file_stack`
								WHERE `box_number` = '$boxNumber' order by docindex) MIS";

	$sql_file_list_ex = mysqli_query($conn,$sql_file_list);	
	
?>

    <table border="1" id="myTable"  style="width:750px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    	<tr class="tbl1">
            <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
            <td style="width:150px; text-align:left; padding-left:5px;">Document Number</td>
            <td style="width:350px; text-align:left; padding-left:5px;">Document Name</td>
            <td style="width:100px;">Reference Documnet</td>
            <td style="width:100px;">Security Documnet</td>
         </tr>
<?php	
		while ($rec_file_st_count = mysqli_fetch_array($sql_file_list_ex )){
		$index++;
?>

        <tr style="background:#FFFFFF;">
            <td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
            <td style="width:150px;"><input style="width:150px;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_file_st_count[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:350px;"><div id="gettext1"><input style="width:350px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_file_st_count[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></div></td>
            <td style="width:100px;"><input type="checkbox" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" onclick="checkValidate(this.id)" <?php if($rec_file_st_count[2]=='checked') echo "checked='checked'"; ?> disabled="disabled"/></td>
            <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" onclick="checkValidate(this.id)" <?php if($rec_file_st_count[3]=='checked') echo "checked='checked'"; ?> disabled="disabled"/></td>
         </tr>	
<?php 	} ?>
	</table>
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


