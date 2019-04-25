<?php
	$isDesitionVal = $_REQUEST['txtDesVal']; // carant valiu in documnet Numbewr
    $ischk1 = $_REQUEST['getchk1'];
    $ischk2 = $_REQUEST['getchk2'];
	
	include('../../../php_con/includes/db.ini.php');
	//$sql_isDesitionRD = "SELECT COUNT(`doc_number`) FROM `doc_line_file_stack` WHERE `doc_number`='$isDesitionVal' AND `doc_type`='RD'";
    $sql_isDesitionRD = "SELECT COUNT(`doc_number`) FROM `doc_line_file_stack` WHERE `doc_number`='".$isDesitionVal."' AND `doc_type`='".$ischk1."';";
	$quary_isDesitionRD = mysqli_query($conn,$sql_isDesitionRD);
	while ($rec_isDesitionRD = mysqli_fetch_array($quary_isDesitionRD)){
		$getValRD = $rec_isDesitionRD[0];
	}
	//$sql_isDesitionSD = "SELECT COUNT(`doc_number`) FROM `doc_line_file_stack` WHERE `doc_number`='".$isDesitionVal."' AND `doc_type`='SD'";
    $sql_isDesitionSD = "SELECT COUNT(`doc_number`) FROM `doc_line_file_stack` WHERE `doc_number`='".$isDesitionVal."' AND `doc_type`='".$ischk2."'";
	$quary_isDesitionSD = mysqli_query($conn,$sql_isDesitionSD);
	while ($rec_isDesitionSD = mysqli_fetch_array($quary_isDesitionSD)){
		$getRDValSD = $rec_isDesitionSD[0];
	}
	if($getValRD == 1 && $getRDValSD == 1){
		$getValNew = "ISFULL";
	}else if($getValRD == 1 && $getRDValSD == 0){
		$getValNew = "RDFULL";
	}else if($getValRD == 0 && $getRDValSD == 1){
		$getValNew = "SDFULL";
	}else if($getValRD == 0 && $getRDValSD == 0){
		$getValNew = "NOFULL";
	}else{
	
	}
?>
<input type="text" name="txtDesitionVal" id="txtDesitionVal" value="<?php echo $getValNew; ?>"  onKeyPress="return disableEnterKey(event)"/>