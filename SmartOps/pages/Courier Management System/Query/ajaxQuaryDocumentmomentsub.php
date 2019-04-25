<?php
	$y=$_REQUEST['txt2'];//Select file number
	//echo $y;
	include('../../../php_con/includes/db.ini.php');
	$sta = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='$y'";
	$sql_sta = mysqli_query($conn,$sta);
 ?>
 <input type="submit" style="width:100px;" value="PDF" name="getPDF" id="getPDF"/>
<br />
<hr />
 <?php
	while ($getSta = mysqli_fetch_array($sql_sta)){
		if($getSta[0]=="NO"){
	$filefull = "SELECT @rownum := @rownum + 1 AS Line,`courier_document`.`documentNumber`,`courier_document`.`documentName`,`courier_document`.`receiveAvailable` , `courier_document`.`receiveDateTime` FROM `courier_files`,`courier_document`,(SELECT @rownum := 0) r WHERE `courier_files`.`fileNumber` = `courier_document`.`fileNumber` AND `courier_document`.`fileNumber` = '$y';";
    //AND (`courier_files`.`stats` = 'PDR' OR `courier_files`.`stats` = 'FDR')
   // echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
?>


<table border="1" class="tbl2" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Number</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Name</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Received Statement</td>
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
		echo "<td style='width:200px;text-align:left;'>".$rec2[2]."</td>";
		echo "<td style='width:200px;text-align:left;'>";
         if($rec2[4] != '0000-00-00 00:00:00'){
			if($rec2[3] == "YES"){
				echo "Yes";
			}else{
				echo "NO";
			}
         }else{
             echo "-";
         }
		echo "</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>

<?php
}else{
	$filefull = "SELECT @rownum := @rownum + 1 AS Line,`courier_document_sub`.`subDocumentNumber`,`courier_document_sub`.`subDocumentName`,`courier_document_sub`.`receiveAvailable` ,`courier_document_sub`.`receiveDateTime` FROM `courier_files`,`courier_document_sub`,(SELECT @rownum := 0) r WHERE `courier_files`.`fileNumber` = `courier_document_sub`.`fileNumber` AND `courier_document_sub`.`fileNumber` = '$y';";
    //AND (`courier_files`.`stats` = 'PDR' OR `courier_files`.`stats` = 'FDR')
   // echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
?>
<table border="1" class="tbl2" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Number</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Document Name</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Received Statement</td>
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
		echo "<td style='width:200px;text-align:left;'>".$rec2[2]."</td>";
		echo "<td style='width:200px;text-align:left;'>";
		 if($rec2[4] != '0000-00-00 00:00:00'){
			if($rec2[3] == "YES"){
				echo "Yes";
			}else{
				echo "NO";
			}
         }else{
             echo "-";
         }
		echo "</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>
<?php
}

}
?>
<div style='display:none;'>
    <input class='txt' type='text' name='txta' id='txta' value='<?php echo $y; ?>'/>
</div>


</div>