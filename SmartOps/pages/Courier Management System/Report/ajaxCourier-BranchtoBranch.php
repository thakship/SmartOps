<?php
	$sDate1 = $_REQUEST['date1'];//From Date
	$sDate2 = $_REQUEST['date2'];//To Date
    
	include('../../../php_con/includes/db.ini.php');
	
    $sqlFile = "SELECT cf.fileNumber AS fileNumber,  
                       b1.branchName AS sendBranchName,
                       cf.sendDateTime AS sendDateTime, 
                       b2.branchName AS receiveBranchNumber,
                       cf.receiveOfficer AS receiveOfficer, 
                       cf.remarks AS remarks
                FROM courier_files AS cf , branch AS b1 , branch AS b2
                WHERE 
                cf.branchNumber = b1.branchNumber AND
                cf.receiveBranchNumber = b2.branchNumber AND
                cf.branchNumber != '0001' AND
                cf.receiveBranchNumber != '0001' AND 
                DATE(cf.sendDateTime) BETWEEN '".$sDate1."' AND '".$sDate2."';";
                      
                      // `courier_files`.`stats` IN ('AB','OB','BR','DR','FDR','PDR') Mofifiy by madushan 2016-09-12
	$query_File = mysqli_query($conn,$sqlFile);	
    // `courier_files`.`fileNumber` IN (SELECT `fileNumber` FROM `filemovement` WHERE `action` = 'sent to branch') AND
?>	
	<table border="1" id="myTable" class="tbl1" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:left; padding-left:5px; width:50px;">#</td>
      	 <td style="text-align:left; padding-left:5px; width:200px;">File Number</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">Send Brnach</td>
      	 <td style="text-align:left; padding-left:5px; width:150px;">Receive Brnach</td>
      	 <td style="text-align:left; padding-left:5px; width:100px;">Send On</td>
         <td style="text-align:left; padding-left:5px; width:150px;">Receive Officer</td>
         <td style="text-align:left; padding-left:5px; width:300px;">Remarks</td>
      </tr>
<?php
	$a = 1;
	$col = "#FFCCCC";
	while ($rec1= mysqli_fetch_assoc($query_File)){
		
		if($a % 2 == 1){
			$col = "#E6E6E6"; 
		}else{
			$col = "#FAFAFA"; 
		}
		echo "<tr style='background-color:".$col.";'>";
		echo "<td style='text-align:left; padding-left:5px; width:50px;'>".$a."</td>";
        echo "<td style='text-align:left; padding-left:5px; width:200px;'>`".$rec1['fileNumber']."</td>";
	    echo "<td style='text-align:left; padding-left:5px; width:150px;'>".$rec1['sendBranchName']."</td>";
   	    echo "<td style='text-align:left; padding-left:5px; width:150px;'>".$rec1['receiveBranchNumber']."</td>";
   	    echo "<td style='text-align:left; padding-left:5px; width:100px;'>".$rec1['sendDateTime']."</td>";
        echo "<td style='text-align:left; padding-left:5px; width:150px;'>".$rec1['receiveOfficer']."</td>";
        echo "<td style='text-align:left; padding-left:5px; width:300px;'>".$rec1['remarks']."</td>";
        echo "</tr>";
		$a++;
	}
?>
</table>