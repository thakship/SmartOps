<?php
	$fileNum=$_REQUEST['txt2'];//Select file number
	//echo $fileNum;
	include('../../../php_con/includes/db.ini.php');
	$sta = "SELECT `subdoc` , `fileName` FROM `courier_files` WHERE `fileNumber`='".$fileNum."'";
	$sql_sta = mysqli_query($conn,$sta);
	while ($getSta = mysqli_fetch_array($sql_sta)){
?>
    <label>File Number : <?php echo $fileNum; ?></label><br />
    <label>File Name  : <?php echo $getSta[1]; ?></label>
<?php
		if($getSta[0]=="NO"){
	$filefull = "SELECT @rownum := @rownum + 1 AS Line,`courier_document`.`documentNumber`,`courier_document`.`documentName` FROM `courier_files`,`courier_document`,(SELECT @rownum := 0) r WHERE `courier_files`.`fileNumber` = `courier_document`.`fileNumber` AND `courier_document`.`fileNumber` = '$fileNum'";
   // echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
?>
<table border="1" class="tbl2" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Number</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Name</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while ($rec2 = mysqli_fetch_array($sql_filefull)){
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left;'>".$rec2[0]."</td>";
		echo "<td style='width:200px;text-align:left;'>".$rec2[1]."</td>";
		echo "<td style='width:400px;text-align:left;'>".$rec2[2]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>
<?php
	}else{
		//echo "NULL";
		$filefull = "SELECT @rownum := @rownum + 1 AS Line,`courier_document_sub`.`subDocumentNumber`,`courier_document_sub`.`subDocumentName` FROM `courier_files`,`courier_document_sub`, (SELECT @rownum := 0) r WHERE `courier_files`.`fileNumber` = `courier_document_sub`.`fileNumber` AND `courier_document_sub`.`fileNumber` = '$fileNum'";
		// echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
?>
<table border="1" class="tbl2" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Number</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Name</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while ($rec2 = mysqli_fetch_array($sql_filefull)){
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left;'>".$rec2[0]."</td>";
		echo "<td style='width:200px;text-align:left;'>".$rec2[1]."</td>";
		echo "<td style='width:400px;text-align:left;'>".$rec2[2]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>
<?php
	}
}
?>
<br/>
<div style='display:none;'>
    <input class='txt' type='text' name='txta' id='txta' value='<?php echo $fileNum;; ?>'/>
</div>
