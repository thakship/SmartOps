<?php
	$boxNumber = $_REQUEST['txtBoxNum'];
	include('../../../php_con/includes/db.ini.php');
	
	$sql_DocSelection ="SELECT `doc_line_file_stack`.`doc_number`,`doc_line_doc_mast`.`doc_name`,`doc_line_file_stack`.`doc_type`,`doc_line_file_stack`.`action_stat` FROM `doc_line_file_stack`,`doc_line_doc_mast` WHERE `box_number`='$boxNumber' AND  `doc_line_file_stack`.`doc_number` = `doc_line_doc_mast`.`doc_number`";
	$query_DocSelection = mysqli_query($conn,$sql_DocSelection);	
?>
	<table border="1" id="myTable"  style="width:725px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr class="tbl1">
            <td style="width:50px;">Index</td>
            <td style="width:150px;">Document Number</td>
            <td style="width:300px;">Document Name</td>
            <td style="width:150px;">Documnet Type</td>
            <td style="width:75px;">Current Status</td>
        </tr>
       
	
<?php	
		$index = 0;
		while ($rec_DocSelection = mysqli_fetch_array($query_DocSelection)){
			$index++;
?>
		<tr style="background:#FFFFFF;">
            <td style="width:50px; text-align:right; padding-right:5px;"><?php echo $index; ?></td>
            <td style="width:150px;text-align:right; padding-right:5px;"><?php echo $rec_DocSelection[0]; ?></td>
            <td style="width:350px; text-align:left; padding-left:5px;"><?php echo $rec_DocSelection[1]; ?></td>
            <td style="width:150px;text-align:left; padding-left:5px;"><?php echo ($rec_DocSelection[2] == "RD" ? "Reference Only" : "Security Only"); ?></td>
            <td style="width:75px; text-align:left; padding-left:5px;"><?php echo ($rec_DocSelection[3] == "LD" ? "Loaded" : ($rec_DocSelection[3] == "ST" ? "Dispatched" : ($rec_DocSelection[3] == "RQ" ? "Requested" : ($rec_DocSelection[3] == "RC" ? "Received" :($rec_DocSelection[3] == "RF" ? "Forward" :"None"))))); ?></td>
         </tr>		
<?php } ?>
</table>