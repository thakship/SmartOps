<?php
	$docNum=$_REQUEST['txtdoc']; // Document Number
	$num = $_REQUEST['txtnum']; // tabele Row num
	$getId = "txtc".$num;
	//echo $getId;
	include('../../../php_con/includes/db.ini.php');
	$sql_Doc_get = "SELECT  COUNT(`doc_name`) FROM `doc_line_doc_mast` WHERE `doc_number`='$docNum'";
	$quary_Doc_get = mysqli_query($conn,$sql_Doc_get);
	while ($rec_Doc_get = mysqli_fetch_array($quary_Doc_get)){
	if($rec_Doc_get[0] != 0){
		$sql_Doc_Name = "SELECT `doc_name` FROM `doc_line_doc_mast` WHERE `doc_number`='$docNum'";
		$quary_Doc_Name = mysqli_query($conn,$sql_Doc_Name);
		while ($rec_Doc_Name = mysqli_fetch_array($quary_Doc_Name)){
?>
		
            <input style="width:350px; color:#999999;" type="text" name="<?php echo $getId; ?>" id="<?php echo $getId; ?>" value="<?php echo $rec_Doc_Name[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/>
<?php	
		}
	}else{
?>
			<input style="width:350px; color:#999999;" type="text" name="<?php echo $getId; ?>" id="<?php echo $getId; ?>" value=""  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/>
<?php
	}
	}
	
?>