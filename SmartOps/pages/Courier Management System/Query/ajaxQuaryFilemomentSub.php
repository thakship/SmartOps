<?php
	$y=$_REQUEST['txt2'];//Select file number
	//echo $y;
	include('../../../php_con/includes/db.ini.php');
	$filefull = "SELECT @rownum := @rownum + 1 AS Line,`fileNumber`,`createDateTime`,`action`, `doneby` 
            FROM `filemovement`,(SELECT @rownum := 0) r WHERE `fileNumber` = '$y' order by `autonum`";
   // echo $filefull;
	$sql_filefull = mysqli_query($conn,$filefull);
	
?>
<table border="1" class="tbl2" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;Line</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;File Number</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Create Date &amp; Time</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Action</td>
      	 <td style="text-align:left; padding-top:5px; padding-bottom:5; width:200px;">&nbsp;&nbsp;&nbsp;&nbsp;Done by</td>
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
		echo "<td style='width:200px;text-align:left;'>".$rec2[3]."</td>";
		echo "<td style='width:200px;text-align:left;'>".$rec2[4]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>