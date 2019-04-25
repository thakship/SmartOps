<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DicLine
Page Name		: Box Closure
Purpose			: To close the opened box	
Author			: Madushan Wikramaara
Date & Time		: 8:52 AM 28/05/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/002";
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
<title>Box Closure</title>
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
<script type="text/javascript">
function GetArrayValue(OpenDate,openBy){
	document.getElementById('txtBoxOpenDate').value = OpenDate;
	document.getElementById('txtBoxOpenBy').value = openBy;	
	loadGrid();
	//document.getElementById(`btnDocMasterSave`).disabled = document.getElementById("myTable").rows.length>1;
}

function loadGrid(){
			//alert("aaaa");
			var mydataLoad;
			mydataLoad= new XMLHttpRequest();
			mydataLoad.onreadystatechange=function(){
				if(mydataLoad.readyState==4){
					document.getElementById('BoxClosure').innerHTML=mydataLoad.responseText;
					document.getElementById('btnDocMasterSave').disabled = document.getElementById("myTable").rows.length<2;
				}
			}
			var no=document.getElementById('selBoxMast').value;
			mydataLoad.open("GET","ajax_BoxClosure_01.php"+"?txt1="+no,true);
			mydataLoad.send();
			
}
</script>
<!-- Ends CDB User defined function here -->

</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
  <tr>
    <td style="width:150px; text-align:right;" ><p class="linetop">Box Number : </p></td>
    <td>
    	<?php 
			$V_SQL = "SELECT `doc_line_box_mast`.`box_number`,`doc_line_box_mast`.`box_opn_date`,`doc_line_box_mast`.`box_opn_by` FROM `doc_line_box_mast` WHERE `doc_line_box_mast`.`box_clo_date`='0000-00-00' AND `doc_line_box_mast`.`box_disp_date`='0000-00-00' AND `doc_line_box_mast`.`branch` = '$_SESSION[userBranch]' AND `doc_line_box_mast`.`department` = '$_SESSION[userDepartment]' AND `doc_line_box_mast`.`box_number` IN (SELECT distinct`box_number` FROM `doc_line_file_stack`)";
			$RsOpenedBox = mysqli_query($conn,$V_SQL);
			?>
            <select name="selBoxMast" style=" font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selBoxMast" onchange="GetArrayValue(this.options[this.selectedIndex].getAttribute('openDate'),this.options[this.selectedIndex].getAttribute('openBy'))"  onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" required>
            <option style="color:#CCCCCC;" value="">--Select Box Master--</option>
            <?php
			 while ($rec1 = mysqli_fetch_array($RsOpenedBox)){
			 	echo '<option openDate="'.$rec1[1].'" openBy="'.$rec1[2].'" value="'.$rec1[0].'">'.$rec1[0].' </option>';
			 }
			?>
            </select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="width:150px; text-align:right;" ><p class="linetop">Box Opened Date : </p></td>
    <td> <input type="text" id="txtBoxOpenDate" name="txtBoxOpenDate" value="" disabled="disabled" onKeyPress="return disableEnterKey(event)" /></td>
    <td><label class="linetop">by : </label> <input type="text" id="txtBoxOpenBy" name="txtBoxOpenBy" value="" disabled="disabled" onKeyPress="return disableEnterKey(event)" /></td>
  </tr> 
</table>

	<!-- Data grid starts -->
	<div id="BoxClosure">
	<table border="1" id="myTable"  style="width:750px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    	  <tr class="tbl1">    
          	<td><p class="linetop"># </p></td>
           	<td><p class="linetop" style="text-align:left; padding-left:5px;">Document Number </p></td>
           	<td><p class="linetop" style="text-align:left; padding-left:5px;">Document Name </p></td>            
           	<td><p class="linetop">Is Reference Doc</p></td>            
           	<td><p class="linetop">Is Security Doc</p></td>                        
          </tr>
    </table>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
    <td><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="0"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="0" disabled="disabled"/>
   </td>
  </tr>
</table>
    <div style='display:none;'>
            <input type="text" name="txtVal" id="txtVal" value="0"/>
	</div>
	</div>
<!--End of Screen design will be started from here -->
	
	<br />
	<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocMasterSave" value="Save" disabled="disabled"/>
	<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
	<?php 
		if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Save'){
			mysqli_autocommit($conn,FALSE);
			try{
				//
				if(trim($_POST['selBoxMast'])!=""){
					date_default_timezone_set('Asia/Colombo');
					
					$v_Sql_Command = "UPDATE `doc_line_box_mast` 
                                         SET `box_clo_date` = now() , 
                                             `box_clo_by` = '".$_SESSION['user']."'  
                                       WHERE `box_number`=".trim($_POST['selBoxMast']);
					//echo $v_Sql_Command;
					$rsBoxClosureUpdate= mysqli_query($conn,$v_Sql_Command) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));	
					for($i = 1; $i <= trim($_POST['txtrow']); $i++){
						$sql_Documents = "SELECT `doc_number`, `doc_type` FROM `doc_line_file_stack` WHERE `doc_number`='".trim($_POST['txtb'.$i])."'";
						$rsDocuments =  mysqli_query($conn,$sql_Documents)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						while ($EachDocument = mysqli_fetch_array($rsDocuments)){
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`) VALUES ('".trim($_POST['selBoxMast'])."','$EachDocument[0]','$EachDocument[1]',now(),'LD','".$_SESSION['user']."')";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
						}
					}		
					mysqli_commit($conn);
					echo "<script> alert('Box <". trim($_POST['selBoxMast']) ."> Closed');
									pageClose();
						 </script>";
				}else{
					echo "<script> alert('Box Number not set');</script>";
				}
			
				
			}catch(Exception $e){
					mysqli_rollback($conn);
				    echo 'Message: '.$e->getMessage();
 			}
		}
	?>
</form>
</body>
</html>
