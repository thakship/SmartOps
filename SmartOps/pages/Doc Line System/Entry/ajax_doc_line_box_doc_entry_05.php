<?php
	$boxVal = $_REQUEST['txtVal'];
    /*$ischk1 = $_REQUEST['getchk1'];
    $ischk2 = $_REQUEST['getchk2'];*/
	//echo $boxVal;
	include('../../../php_con/includes/db.ini.php');
    /*if($ischk1 == "RD"){
        $sql_boxVal = "SELECT distinct `box_number` FROM `doc_line_file_stack` WHERE `doc_number`='".$boxVal."' AND `doc_type`= '".$ischk1."';";
    }else if($ischk2 == "SD"){
        $sql_boxVal = "SELECT distinct `box_number` FROM `doc_line_file_stack` WHERE `doc_number`='".$boxVal."' AND `doc_type`= '".$ischk2."';";
    }else{*/
        $sql_boxVal = "SELECT distinct `box_number` FROM `doc_line_file_stack` WHERE `doc_number`='".$boxVal."'";
    //}
	
	$quary_file_count = mysqli_query($conn,$sql_boxVal);
	while ($rec_file_count = mysqli_fetch_array($quary_file_count)){
	?>
		<div style='display:none;'>
            <input type="text" name="txtalet" id="txtalet" value="<?php echo $rec_file_count[0]; ?>"/>
		</div>
<?php
	}
	
?>
