<?php
    if(isset($_REQUEST['dateR']) && isset($_REQUEST['dep_id'])){
        //echo $_REQUEST['dateR']." ".$_REQUEST['dep_id'];
    
    
	
	include('../../../php_con/includes/db.ini.php');
	//$sqlquary = "SELECT @rownum := @rownum + 1 AS rank,tmp.dnum,tmp.dname From (SELECT `courier_files`.`departmentNumber` dnum,`deparment`.`deparmentName` dname FROM `courier_files`,`deparment` WHERE `courier_files`.`departmentNumber` = `deparment`.`deparmentNumber` AND date(`courier_files`.`sendDateTime`) = '$date' AND `courier_files`.`branchNumber`='0001' group by `courier_files`.`departmentNumber`)tmp ,(SELECT @rownum := 0) r ORDER BY tmp.dnum DESC";
	$sqlquary = "SELECT `fileNumber`, `fileName`, `createBy`, `currentowner`, `createDateTime`, `branchNumber`, `departmentNumber`, `sendBy`, `sendDateTime`, `receiveOfficer`, `receiveDepartmentNumber`, `receiveBranchNumber`, `stats`, `receiveDateTime`, `numberOfDocument`, `fileType`, `remarks`, `preFileNumber`, `subdoc` 
                 FROM `courier_files` WHERE `departmentNumber` = '".$_REQUEST['dep_id']."' AND date(`sendDateTime`) = '".$_REQUEST['dateR']."'";
    $Addquary = mysqli_query($conn,$sqlquary); 
?>
<table border="1" cellpadding="0" cellspacing="0">
      <tr style="background-color: silver;">
      	<td style="text-align:left; padding-left:5px; width:50px;">#</td>
        <td style="text-align:left; padding-left:5px; width:100px;">File Number</td>
        <td style="text-align:left; padding-left:5px; width:300px;">File Name</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Create On</td>
        <td style="text-align:left; padding-left:5px; width:300px;">Create By</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while($recquary = mysqli_fetch_assoc($Addquary)){
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='width:50px;text-align:left; padding-left:5px;'>".$a."</td>";
		echo "<td style='width:100px;text-align:left; padding-left:5px;'>".$recquary['fileNumber']."</td>";
		echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$recquary['fileName']."</td>";
        echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$recquary['createDateTime']."</td>";
        echo "<td style='width:300px;text-align:left; padding-left:5px;'>".$recquary['createBy']."</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>

<?php
}
?>