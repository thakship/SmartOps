<?php
$fileNumbe=$_REQUEST['b1'];
include('../../../php_con/includes/db.ini.php');
$sta = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='$fileNumbe'";
	$sql_sta = mysqli_query($conn,$sta);
	while ($getSta = mysqli_fetch_array($sql_sta)){
		if($getSta[0]=="NO"){
	$selectDoc = "SELECT `documentNumber`,`documentName` FROM `courier_document` WHERE `fileNumber`='$fileNumbe'";
	$sqlselectDoc = mysqli_query($conn,$selectDoc);
?>
	<table class="tbl2" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Document Number</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">Document Name</td>
      </tr>
<?php
		while($add = mysqli_fetch_array($sqlselectDoc)){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:200px;'>
				  <input style='width:200px;' type='text' name='txt' id='txt' value='".$add[0]."' disabled='disabled'/></td>";
			echo "<td style='width:300px;'>
				  <input style='width:300px;' type='text' name='txt' id='txt' value='".$add[1]."' disabled='disabled'/></td>";
			echo "</tr>";
		}
?>
	</table>
<?php
	}else{
	 	$selectDoc = "SELECT `subDocumentNumber`,`subDocumentName` FROM `courier_document_sub` WHERE `fileNumber`='$fileNumbe'";
	$sqlselectDoc = mysqli_query($conn,$selectDoc);
?>
	<table class="tbl2" border="1">
      <tr>
        <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Document Number</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">Document Name</td>
      </tr>
<?php
		while($add = mysqli_fetch_array($sqlselectDoc)){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:200px;'>
				  <input style='width:200px;' type='text' name='txt' id='txt' value='".$add[0]."' disabled='disabled'/></td>";
			echo "<td style='width:300px;'>
				  <input style='width:300px;' type='text' name='txt' id='txt' value='".$add[1]."' disabled='disabled'/></td>";
			echo "</tr>";
		}
?>
	</table>
 <?php
 }	
	}
?>