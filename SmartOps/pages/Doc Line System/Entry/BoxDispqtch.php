<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Box Closure
Purpose			: To close the opened box	
Author			: Madushan Wikramaarachchi
Date & Time		: 8:52 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/003";
	$_SESSION['Module'] = "Doc Line System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Box Dispatch</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
<!-- Starts CDB User defined function here -->
</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr/>
<!-- Screen design will be started from here -->
<form action="" method="post">
<?php
	$index = 0;
	$sql_box_dispach ="SELECT `doc_line_box_mast`.`box_number`,`doc_line_box_mast`.`box_clo_date`,
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number`),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'RD'),
				(SELECT COUNT(*) FROM `doc_line_file_stack` WHERE `doc_line_file_stack`.`box_number` = `doc_line_box_mast`.`box_number` AND `doc_line_file_stack`.`doc_type` = 'SD')
				FROM `doc_line_box_mast`
				WHERE `doc_line_box_mast`.`box_clo_date`!='0000-00-00' AND `doc_line_box_mast`.`box_disp_date` = '0000-00-00'";
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
            <td style="width:150px;">Confirm</td>
         </tr>
<?php
	while ($rec_box_dispach = mysqli_fetch_array($query_box_dispach)){
		$index++;
?>
		<tr style="background:#FFFFFF;">
            <td style="width:50px;"><input style="width:50px;" type="text" name="<?php echo "txta".$index; ?>" id="<?php echo "txta".$index; ?>" value="<?php echo $index; ?>"  onKeyPress="return disableEnterKey(event)" readonly required/></td>
            <td style="width:200px;"><input style="width:200px;" type="text" name="<?php echo "txtb".$index; ?>" id="<?php echo "txtb".$index; ?>" value="<?php echo $rec_box_dispach[0]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px;" type="text" name="<?php echo "txtc".$index; ?>" id="<?php echo "txtc".$index; ?>" value="<?php echo $rec_box_dispach[1]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;" type="text" name="<?php echo "txtd".$index; ?>" id="<?php echo "txtd".$index; ?>" value="<?php echo $rec_box_dispach[2]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;" type="text" name="<?php echo "txte".$index; ?>" id="<?php echo "txte".$index; ?>" value="<?php echo $rec_box_dispach[3]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:100px;"><input style="width:100px; text-align:right;" type="text" name="<?php echo "txtf".$index; ?>" id="<?php echo "txtf".$index; ?>" value="<?php echo $rec_box_dispach[4]; ?>"  onKeyPress="return disableEnterKey(event)" required readonly="readonly"/></td>
            <td style="width:150px;"><input type="checkbox" name="<?php echo "txtg".$index; ?>" id="<?php echo "txtg".$index; ?>" onKeyPress="return disableEnterKey(event)" /></td>
         </tr>	
<?php
	}
?>
    </table>
 <!-- End of Screen design will be started from here -->
	
	<br/>
	<input type="submit" style="font-size:12px;" name="btnBoxDispatch" id="btnBoxDispatch" value="Confirm"/>
	<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<?php
    if(isset($_POST['btnBoxDispatch']) && $_POST['btnBoxDispatch']=='Confirm'){
		mysqli_autocommit($conn,FALSE);
		$RowsAffected = 0;
			try{
				 for ($i = 1; $_SESSION['rowFile']>= $i; $i++){		//For each box
				 	if(isset($_POST['txtg'.$i])){
 						date_default_timezone_set('Asia/Colombo');
						
						// Update the box master
						$sql_boxUpdate = "UPDATE `doc_line_box_mast` SET `box_disp_date`=now(),`box_disp_by`='".$_SESSION['user']."' WHERE `box_number`='".trim($_POST['txtb'.$i])."'";
						$query_boxUpdate= mysqli_query($conn,$sql_boxUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						//if($RowsAffected=0)	$RowsAffected = mysql_affected_rows();
						
						//Update the document stack
						$sql_docUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='ST' WHERE `box_number`='".trim($_POST['txtb'.$i])."'";
						$query_docUpdate= mysqli_query($conn,$sql_docUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						
						//Insert new record(s) to document movement tables
						$sql_BoxDocuments = "SELECT `doc_number`, `doc_type` FROM `doc_line_file_stack` WHERE `box_number`='".trim($_POST['txtb'.$i])."'";
						$rsBoxDocuments =  mysqli_query($conn,$sql_BoxDocuments)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						while ($EachDocument = mysqli_fetch_array($rsBoxDocuments)){
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`) VALUES ('".trim($_POST['txtb'.$i])."','$EachDocument[0]','$EachDocument[1]',now(),'ST','".$_SESSION['user']."')";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						}
						
					}else{
					
					}
				 }
				 
				mysqli_commit($conn);
				echo "<script> alert('Selected boxes were dispatched.');
								pageClose();
					</script>";
					
			}catch(Exception $e){
					mysqli_rollback($conn);
				    echo 'Message: '.$e->getMessage();
 			}
	
	}
	
?>
    
</form>
</body>
</html>
