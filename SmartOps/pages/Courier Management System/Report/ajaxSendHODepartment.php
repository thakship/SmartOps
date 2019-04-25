<?php
	//$branchNum = $_REQUEST['txt1'];
	$date = $_REQUEST['txt3'];
	//echo $branchNum;
	//echo $date;
	include('../../../php_con/includes/db.ini.php');
	//$sqlquary = "SELECT @rownum := @rownum + 1 AS rank,tmp.dnum,tmp.dname From (SELECT `courier_files`.`departmentNumber` dnum,`deparment`.`deparmentName` dname FROM `courier_files`,`deparment` WHERE `courier_files`.`departmentNumber` = `deparment`.`deparmentNumber` AND date(`courier_files`.`sendDateTime`) = '$date' AND `courier_files`.`branchNumber`='0001' group by `courier_files`.`departmentNumber`)tmp ,(SELECT @rownum := 0) r ORDER BY tmp.dnum DESC";
	$sqlquary = "SELECT cf.departmentNumber, dep.deparmentName ,MAX(cf.sendDateTime)
                    FROM courier_files AS cf , deparment AS dep
                    WHERE cf.departmentNumber = dep.deparmentNumber AND
                          DATE(cf.sendDateTime) = '".$date."' AND 
                          cf.branchNumber='0001'
                    GROUP BY cf.departmentNumber;";
    $Addquary = mysqli_query($conn,$sqlquary); 
?>
A
<table border="1" cellpadding="0" cellspacing="0">
      <tr style="background-color: silver;">
      	<td style="text-align:left; padding-left:5px; width:50px;">#</td>
        <td style="text-align:left; padding-left:5px; width:100px;">Send Dep. Num</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Send Department</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Last Send Date Time</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while($recquary = mysqli_fetch_array($Addquary)){
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";' title='".$recquary[0]."' onclick='getFiledtl(title);'>";
		echo "<td style='width:50px;text-align:left; padding-left:5px;'>".$a."</td>";
		echo "<td style='width:100px;text-align:left; padding-left:5px;'>".$recquary[0]."</td>";
		echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$recquary[1]."</td>";
        echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$recquary[2]."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>