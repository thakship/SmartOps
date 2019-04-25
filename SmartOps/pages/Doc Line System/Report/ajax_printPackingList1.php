<?php		
	$dateGet = $_REQUEST['txt'];
    $branchGet = $_REQUEST['txtB'];
    $departmentGet = $_REQUEST['txtD'];
    
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
		
?>
<?php
	$index = 0;
	$sql_box_dispach ="SELECT `doc_line_box_mast`.`box_number`,`doc_line_box_mast`.`box_clo_date`,
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number`),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'RD'),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'SD')
				FROM `doc_line_box_mast`
				WHERE `doc_line_box_mast`.`box_opn_date`!='0000-00-00' AND `doc_line_box_mast`.`box_clo_date` = '".$dateGet."' AND `doc_line_box_mast`.`box_disp_date` = '0000-00-00' AND `doc_line_box_mast`.`branch` = '".$branchGet."' AND `doc_line_box_mast`.`department` = '".$departmentGet."' ";
	
   /* $sql_box_dispach ="SELECT `doc_line_box_mast`.`box_number`,`doc_line_box_mast`.`box_clo_date`,
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number`),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'RD'),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'SD')
				FROM `doc_line_box_mast`
				WHERE `doc_line_box_mast`.`box_number`='736763'";*/
    $query_box_dispach = mysqli_query($conn,$sql_box_dispach);	
	 $_SESSION['rowFile'] = mysqli_num_rows($query_box_dispach);
?>
	<table border="1" id="myTable"  style="width:800px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    	<tr class="tbl1">
            <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
            <td style="width:200px; text-align:left; padding-left:5px;">Box Number</td>
            <td style="width:100px; text-align:left; padding-left:5px;">Closed Date</td>
            <td style="width:100px; text-align:right; padding-right:5px;">Number of Documnet</td>
            <td style="width:100px; text-align:right; padding-right:5px;">RD</td>
            <td style="width:100px; text-align:right; padding-right:5px;">SD</td>
            <td style="width:150px;"></td>
         </tr>
<?php
	while ($rec_box_dispach = mysqli_fetch_array($query_box_dispach)){
		$index++;
		$sql_box = "SELECT count(*) FROM `dl_printlog` WHERE `BoxNo`='".$rec_box_dispach[0]."'";
		$query_box = mysqli_query($conn,$sql_box);
		while ($rec_box = mysqli_fetch_array($query_box)){
			if($rec_box[0] != 0){
				$colRow = GetParamValue(3,$conn);
			}else{
				$colRow = "#FFFFFF";
			}
		}
?>
		<tr style="background:<?php echo $colRow;?>;">
            <td style="width:50px;"><input style="width:50px;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
            <td style="width:200px;"><input style="width:200px;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_box_dispach[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_box_dispach[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value="<?php echo $rec_box_dispach[2]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value="<?php echo $rec_box_dispach[3]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;background:<?php echo $colRow;?>;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value="<?php echo $rec_box_dispach[4]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:150px;"><input type="button" value="Select"  name="<?php echo "txtg".$index; ?>"  id="<?php echo "txtf".$index; ?>" title="<?php echo "txtb".$index; ?>" onclick="loadGrid(title);"/></td>
            
         </tr>	
<?php
	}
?>
    </table>