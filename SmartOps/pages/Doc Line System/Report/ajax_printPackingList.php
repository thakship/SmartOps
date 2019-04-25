<?php		
	$boxNumber = $_REQUEST['txt1'];	
	$user = $_REQUEST['txt2'];	
	$num_padded = sprintf("%09s", $boxNumber);
	include('../../../php_con/includes/db.ini.php');
	date_default_timezone_set('Asia/Colombo');	
						
?>
<div style="width:100%; height:20px; float:left"><h1 style="font-size:12px; text-align:center; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif;">PACKING LIST</h1></div>
<div style="width:100%; height:80px; float:left">
	<div style="width:50%; height:80px; float:left; text-align:left;font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">
    	<img src="../../../img/logo_hdr.jpg"/><br/>
    	<label style="margin-left:10px; font-weight:bold; font-size:13px;">Citizens Development Business Finance PLC.</label><br/>
    </div>
    <div style="width:50%; height:80px; float:left; text-align: right;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;">
    	<label>Carton number</label><br/>
       	<table border="0" cellpadding="0" cellspacing="0" style="float:right;">
        	<tr>
            	<td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,0,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,1,1); ?></td>
               	<td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,2,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,3,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,4,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,5,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,6,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,7,1); ?></td>
                <td style="border:#000000 solid 1px; width:20px; text-align:center; font-size: 16px;"><?php echo substr($num_padded,8,1); ?></td>
            </tr>
        </table>
    </div>
</div>
<div style="width:100%; height:100px; float:left">
	<div style="width:50%; height:100px; float:left; text-align:left;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:bold;"><br/><br/>
    <?php
		$sql_b_d = "SELECT `branch`.`branchName`,`deparment`.`deparmentName` FROM `user`,`branch`,`deparment` WHERE `user`.`userName` = '$user' AND `user`.`branchNumber` = `branch`.`branchNumber` AND `user`.`deparmentNumber` = `deparment`.`deparmentNumber`";
		$quary_b_d = mysqli_query($conn,$sql_b_d);	
		while ($rec_b_d = mysqli_fetch_array($quary_b_d )){
			$barnch_Get = $rec_b_d[0];
			$department_b_d = $rec_b_d[1];
		} 
		
	?>
        	<table>
        		<tr>
            		<td>Supplier Name</td>
                    <td> : Transnational BPM Lanka (Pvt) Limited</td>
                </tr>
                <tr>
                	<td> Branch / Department</td>
                 	<td>: <?php echo $barnch_Get." / ".$department_b_d; ?></td>
                </tr>
                <tr>
               		<td>Disposal Date</td>
                    <td>:</td>
             	</tr>
            </table>   
        
    </div>
    <div style="width:50%; height:100px; float:left; text-align: right;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;">
    	<table style="float:right; width:400px;">
        	<tr>
            	<td style="width:100px;">&nbsp;</td>
                <td style="width:100px; text-align:center;">Name</td>
               	<td style="width:100px; text-align:center;">Signature</td>
                <td style="width:100px; text-align:center;">Date</td>
            </tr>
         </table>
         <table border="0" cellpadding="0" cellspacing="0"  style="float:right; width:400px;">
        	<tr>
            	<td style="width:100px; border:#000000 solid 1px;">Packed by</td>
                <td style="width:100px; text-align:center; border:#000000 solid 1px;">&nbsp;</td>
               	<td style="width:100px; text-align:center; border:#000000 solid 1px;">&nbsp;</td>
                <td style="width:100px; text-align:center; border:#000000 solid 1px;">&nbsp;</td>
            </tr>
            <tr>
            	<td style="width:100px; border:#000000 solid 1px;">Data Entry</td>
                <td style="width:100px; text-align:center; border:#000000 solid 1px;">&nbsp;</td>
               	<td style="width:100px; text-align:center; border:#000000 solid 1px;">&nbsp;</td>
                <td style="width:100px; text-align:center;border:#000000 solid 1px;">&nbsp;</td>
            </tr>
         </table>
    </div>
</div>
<?php
	$sql_file_list ="SELECT `doc_line_file_stack`.`doc_number`,`doc_line_doc_mast`.`doc_name` ,`doc_line_file_stack`.`doc_type` ,`doc_line_doc_mast` .`prod_name` 
					 FROM `doc_line_file_stack`,`doc_line_doc_mast` 
					 WHERE `doc_line_file_stack`.`doc_number` = `doc_line_doc_mast`.`doc_number` AND `doc_line_file_stack`.`box_number`='$boxNumber' ORDER BY `doc_line_file_stack`.`docindex`";
	$sql_file_list_ex = mysqli_query($conn,$sql_file_list);	
?>

<div style="width:100%; height:50px; float:left; margin-top: 10px; ">
<table border="0" id="myTable"  style="width:1100px;background:#FFFFFF;text-align:center; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;"  cellpadding="0" cellspacing="0">
    	<tr class="tbl1">
            <td style="width:50px; text-align:left; padding-left:5px; border:#000000 solid 1px; ">Index</td>
            <td style="width:100px; text-align:left; padding-left:5px; border:#000000 solid 1px; ">Document Number</td>
            <td style="width:300px; text-align:left; padding-left:5px; border:#000000 solid 1px; ">Document Name</td>
            <td style="width:50px; text-align:left; padding-left:5px; border:#000000 solid 1px; ">&nbsp;</td>
            <td style="width:150px; border:#000000 solid 1px; ">Product Name</td>
            <td style="width:150px; border:#000000 solid 1px; ">Subject Description</td>
            <td style="width:100px; border:#000000 solid 1px; ">Document Dates</td>
            <td style="width:200px; border:#000000 solid 1px; ">Retention Period (this  month)</td>
            <td style="width:50px; border:#000000 solid 1px; ">hold</td>
         </tr>
<?php	
		$index = 0;
		while ($rec_file_st_count = mysqli_fetch_array($sql_file_list_ex )){
		$index++;
		if($index%2 == 0){
			$col = "#CCCCCC";
		}else{
			$col = "#FFFFFF";
		} 
?>

      		<tr class="tbl1">
            	<td style="width:50px; text-align:left; padding-left:5px; background:<?php echo $col;?>; border:#000000 solid 1px; "><?php echo $index; ?></td>
            	<td style="width:100px; text-align:left; padding-left:5px; background:<?php echo $col;?>; border:#000000 solid 1px; "><?php echo $rec_file_st_count[0]; ?></td>
            	<td style="width:300px; text-align:left; padding-left:5px; background:<?php echo $col;?>; border:#000000 solid 1px; "><?php echo $rec_file_st_count[1]; ?></td>
             	<td style="width:50px; text-align:left; padding-left:5px; background:<?php echo $col;?>; border:#000000 solid 1px; "><?php echo $rec_file_st_count[2]; ?></td>
            	<td style="width:150px; border:#000000 solid 1px; background:<?php echo $col;?>;"><?php echo $rec_file_st_count[3]; ?></td>
            	<td style="width:150px; border:#000000 solid 1px; background:<?php echo $col;?>;">&nbsp;</td>
             	<td style="width:100px; border:#000000 solid 1px; background:<?php echo $col;?>;">&nbsp;</td>
             	<td style="width:200px; border:#000000 solid 1px; background:<?php echo $col;?>;">&nbsp;</td>
              	<td style="width:50px; border:#000000 solid 1px; background:<?php echo $col;?>;">&nbsp;</td>
        	</tr>
<?php 	} ?>
	</table>
</div>
