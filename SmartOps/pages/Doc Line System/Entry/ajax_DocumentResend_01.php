<?php
	$docNumber = $_REQUEST['txt1'];
	$index = $_REQUEST['txt2'];
	
	//echo $docNumber." -- ".$docType;
	include('../../../php_con/includes/db.ini.php');
	$sql_Doc_get = "SELECT DISTINCT`doc_line_file_stack`.`box_number`,`doc_line_file_stack`.`doc_number`,
										(SELECT T1.`doc_type` FROM `doc_line_file_stack` T1 WHERE T1.`action_stat`='RC' AND T1.`doc_type` = 'RD' AND T1.`box_number` = `doc_line_file_stack`.`box_number` AND T1.`doc_number` = `doc_line_file_stack`.`doc_number`) AS RD,
										(SELECT T2.`doc_type` FROM `doc_line_file_stack` T2 WHERE T2.`action_stat`='RC' AND T2.`doc_type` = 'SD' AND T2.`box_number` = `doc_line_file_stack`.`box_number` AND T2.`doc_number` = `doc_line_file_stack`.`doc_number`) AS SD
										FROM `doc_line_file_stack` 
										WHERE `doc_line_file_stack`.`doc_number` = '$docNumber' AND `doc_line_file_stack`.`action_stat`='RC'";
	$quary_Doc_get = mysqli_query($conn,$sql_Doc_get);
	$V_row = mysqli_num_rows($quary_Doc_get);	
	if($V_row!=0){
    $brnch_cue = "";
	while ($rec_Doc_get = mysqli_fetch_array($quary_Doc_get)){
		 /*$sql_branch_get = "SELECT `branch_Numbar` 
                            FROM `doc_line_stat_history` 
                            WHERE `doc_number` = '".$docNumber."' AND 
                            `action_stat` = 'RQ' AND 
                            `perpas_code` = 'PP003' AND
                            `action_seq` = (SELECT MAX(`action_seq`) 
                                            FROM `doc_line_stat_history` 
                                            WHERE `doc_number` = '".$docNumber."' AND 
                                                  `action_stat` = 'RQ' AND 
                                                  `perpas_code` = 'PP003')";
        $quary_branch_get = mysqli_query($conn,$sql_branch_get);
        while($rec__branch_get = mysqli_fetch_array($quary_branch_get)){
            $brnch_cue = $rec__branch_get[0];
        }*/
		if($rec_Doc_get[2] == "RD" && $rec_Doc_get[3] == "SD"){
			$rd = "checked";
			$sd = "checked";	
		}else if($rec_Doc_get[2] == "RD" && $rec_Doc_get[3] != "SD"){
			$rd = "checked";	
			$sd = "disabled=\"disabled\"";	
			
		}else if($rec_Doc_get[2] != "RD" && $rec_Doc_get[3] == "SD"){
			$rd = "disabled=\"disabled\"";	
			$sd = "checked";	
		}else{
			$rd = "disabled=\"disabled\"";
			$sd = "disabled=\"disabled\"";	
		}
?>
		<td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_Doc_get[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_Doc_get[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" <?php echo $rd; ?> /></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" <?php echo $sd; ?> /></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" title="<?php echo $index; ?>" readonly="readonly" onclick="clickBranch(title , 1)"/></td>
        <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td></tr>
        
<?php
	}
	}else{
?>
		<td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)"  disabled="disabled" /></td>
        <td style="width:100px;"><input type="checkbox" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" disabled="disabled"/></td>
        <td style="width:150px;"><input style="width:150px; color:#999999;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value=""  onKeyPress="return disableEnterKey(event)" title="<?php echo $index; ?>" readonly="readonly" onclick="clickBranch(title , 1)"/></td>
        <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td></tr>
        

 <?php
 }
 ?>
 