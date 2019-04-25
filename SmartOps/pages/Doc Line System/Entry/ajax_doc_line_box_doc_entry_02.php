<?php
	$docNum=$_REQUEST['txtval']; // Document Number
	//echo $docNum;
	include('../../../php_con/includes/db.ini.php');
	$sql_doc_st = "SELECT COUNT(`doc_name`) FROM `doc_line_doc_mast` WHERE `doc_number`='$docNum'";
	$quary_Doc_st = mysqli_query($conn,$sql_doc_st);
	while ($rec_Doc_st = mysqli_fetch_array($quary_Doc_st)){
?>
		<input type="text" name="txtCount" id="txtCount" value="<?php echo $rec_Doc_st[0]; ?>"  onKeyPress="return disableEnterKey(event)"/>
<?php	
	}
?>