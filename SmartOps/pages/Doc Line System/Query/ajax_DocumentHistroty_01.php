<?php
	$DocNumber = $_REQUEST['txtdocNum'];
	$DocStates = $_REQUEST['txtDocStat'];
	include('../../../php_con/includes/db.ini.php');
	
	if($DocStates == "BO"){
		$sql_DocSelection ="SELECT `doc_line_stat_history`.`box_number`,`doc_line_stat_history`.`doc_number`, `doc_line_doc_mast`.`doc_name`,`doc_line_stat_history`.`doc_type`, DATE(`doc_line_stat_history`.`action_date_time`), `doc_line_stat_history`.`action_stat` ,`doc_line_stat_history`.`action_user`,(SELECT `doc_line_perpase_requst`.`parpas_value` FROM `doc_line_perpase_requst` WHERE `doc_line_perpase_requst`.`perpas_code` = `doc_line_stat_history`.`perpas_code`) AS PPNAME FROM `doc_line_stat_history`,`doc_line_doc_mast` WHERE `doc_line_stat_history`.`doc_number` = '$DocNumber' AND `doc_line_stat_history`.`doc_number` = `doc_line_doc_mast`.`doc_number` ORDER BY `doc_line_stat_history`.`action_date_time`";
	}else{
		$sql_DocSelection ="SELECT `doc_line_stat_history`.`box_number`,`doc_line_stat_history`.`doc_number`, `doc_line_doc_mast`.`doc_name`,`doc_line_stat_history`.`doc_type`, DATE(`doc_line_stat_history`.`action_date_time`), `doc_line_stat_history`.`action_stat` ,`doc_line_stat_history`.`action_user`,(SELECT `doc_line_perpase_requst`.`parpas_value` FROM `doc_line_perpase_requst` WHERE `doc_line_perpase_requst`.`perpas_code` = `doc_line_stat_history`.`perpas_code`) AS PPNAME FROM `doc_line_stat_history`,`doc_line_doc_mast` WHERE `doc_line_stat_history`.`doc_number` = '$DocNumber' AND `doc_line_stat_history`.`doc_type`='$DocStates' AND `doc_line_stat_history`.`doc_number` = `doc_line_doc_mast`.`doc_number` ORDER BY `doc_line_stat_history`.`action_date_time`";
	}
	$query_DocSelection = mysqli_query($conn,$sql_DocSelection);	
?>
	<table border="1" id="myTable"  style="width:1125px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr class="tbl1">
            <td style="width:50px;">Index</td>
            <td style="width:100px;">Box Number</td>
            <td style="width:150px;">Document Number</td>
            <td style="width:300px;">Document Name</td>
            <td style="width:150px;">Documnet Type</td>
            <td style="width:100px;">Action Date & Time</td>
            <td style="width:75px;">Action Stat</td>
            <td style="width:100px;">Action User</td>
        	<td style="width:100px;">Perpas</td>
        </tr>
       
	
<?php	
		$index = 0;
        $v_DocName = "";
		while ($rec_DocSelection = mysqli_fetch_array($query_DocSelection)){
			$index++;
			$v_DocName = $rec_DocSelection[2];
?>
		<tr style="background:#FFFFFF;">
            <td style="width:50px; text-align:right; padding-right:5px;"><?php echo $index; ?></td>
            <td style="width:100px;text-align:right; padding-right:5px;"><?php echo $rec_DocSelection[0]; ?></td>
            <td style="width:150px; text-align:right;padding-right:5px;"><?php echo $rec_DocSelection[1]; ?></td>
            <td style="width:300px; text-align:left; padding-left:5px;"><?php echo $rec_DocSelection[2]; ?></td>
            <td style="width:150px;text-align:left; padding-left:5px;"><?php echo ($rec_DocSelection[3] == "RD" ? "Reference Only" : "Security Only"); ?></td>
            <td style="width:100px; text-align:left; padding-left:5px;"><?php echo $rec_DocSelection[4]; ?></td>
            <td style="width:75px; text-align:left; padding-left:5px;"><?php echo ($rec_DocSelection[5] == "LD" ? "Loaded" : ($rec_DocSelection[5] == "ST" ? "Dispatched" : ($rec_DocSelection[5] == "RQ" ? "Requested" : ($rec_DocSelection[5] == "RC" ? "Received" :  ($rec_DocSelection[5] == "RF" ? "Forward" : "None"))))); ?></td>
         	 <td style="width:100px; text-align:left; padding-left:5px;"><?php echo $rec_DocSelection[6]; ?></td>
              <td style="width:100px; text-align:left; padding-left:5px;"><?php echo $rec_DocSelection[7]; ?></td>
         </tr>		
<?php } ?>
</table>
<div  style='display:none;'>
	<input type="text" name="txtDocname" id="txtDocname" value="<?php echo $v_DocName; ?>"/>
</div>