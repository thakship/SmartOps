<?php
	$x=$_REQUEST['txt1'];//Select File name
	$g=$_REQUEST['txt3'];//Select Date
	$k=$_REQUEST['txt9'];//Select File name
	$w=$_REQUEST['txt10'];//deparatment
	//echo $g;
	include('../../../php_con/includes/db.ini.php');
	$selectFileName = "SELECT @rownum := @rownum + 1 AS rank,cf.fileNumber,cf.fileName,cf.remarks,cf.stats,br.branchName,dep.deparmentName,cf.numberOfDocument,cf.subdoc
 FROM courier_files AS cf, branch AS br , deparment AS dep ,(SELECT @rownum := 0) r 
where cf.receiveBranchNumber = br.branchNumber AND cf.receiveDepartmentNumber= dep.deparmentNumber AND
cf.fileName like '".$x."%' AND  
			DATE(cf.createDateTime) = '".$g."'  AND 
			cf.branchNumber ='".$k."' AND 
			cf.departmentNumber='".$w."'";
	//echo $selectFileName;	
	//				   
	$sql_selectFileName = mysqli_query($conn,$selectFileName);
?>
<table class="tbl1" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;" rowspan="2">File Number</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;"  rowspan="2">File Name</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;" rowspan="2">Rec. Branch</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;" rowspan="2">Rec. Dep</td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;width:400px;"  rowspan="2">Remark</td>
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:210px;" colspan="3" >Number of</td>
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:70px;"></td>
      </tr>
      <tr>
        
        
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:70px;">Doc</td>
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:70px;">FRD</td>
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:70px;">PRD</td>
        <td style="text-align: center; padding-top:5px; padding-bottom:5;width:70px;"></td>
      </tr>
<?php
	$a = 1;
    
	while ($rec1 = mysqli_fetch_array($sql_selectFileName)){
	   $col_1 = "#FFFFFF";
       if($rec1[4] == "FDR"){
        $col_1 = "#CEF6D8";
       }
		echo "<tr style='background-color:".$col_1.";'>";
		echo "<td style='width:150px;text-align:left;'>
			  <div style='display:none;'>
			  <input class='txt' type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec1[1]."'/></div> 
			  ".$rec1[1]."</td>";
		echo "<td style='width:300px;text-align:left;'>".$rec1[2]."</td>";
        echo "<td style='width:150px;text-align:left;'>".$rec1[5]."</td>";
        echo "<td style='width:150px;text-align:left;'>".$rec1[6]."</td>";
		echo "<td style='width:400px;text-align:left;'>".$rec1[3]."</td>";
        echo "<td style='width:70px;text-align:left;'>".$rec1[7]."</td>";
        if($rec1[8] == 'NO'){
            $sql_document_count = "SELECT COUNT(*) FROM courier_document AS cd WHERE cd.fileNumber = '".$rec1[1]."' AND cd.receiveAvailable = 'YES' AND cd.receiveDateTime != '0000-00-00 00:00:00';";
            $que_document_count = mysqli_query($conn,$sql_document_count) or die(mysqli_error($conn));
            while($rec_document_count = mysqli_fetch_array($que_document_count)){
                echo "<td style='width:70px;text-align:left;'>".$rec_document_count[0]."</td>";
            }
            $sql_document_P_count = "SELECT COUNT(*) FROM courier_document AS cd WHERE cd.fileNumber = '".$rec1[1]."' AND cd.receiveAvailable = 'NO';";
            $que_document_P_count = mysqli_query($conn,$sql_document_P_count) or die(mysqli_error($conn));
            while($rec_document_P_count = mysqli_fetch_array($que_document_P_count)){
                echo "<td style='width:70px;text-align:left;'>".$rec_document_P_count[0]."</td>";
            }
        }else{
            $sql_document_count = "SELECT COUNT(*) FROM courier_document_sub AS cs WHERE cs.fileNumber = '".$rec1[1]."' AND cs.receiveAvailable = 'YES' AND cs.receiveDateTime != '0000-00-00 00:00:00';";
            $que_document_count = mysqli_query($conn,$sql_document_count) or die(mysqli_error($conn));
            while($rec_document_count = mysqli_fetch_array($que_document_count)){
                echo "<td style='width:70px;text-align:left;'>".$rec_document_count[0]."</td>";
            }
            $sql_document_P_count = "SELECT COUNT(*) FROM courier_document_sub AS cs WHERE cs.fileNumber = '".$rec1[1]."' AND cs.receiveAvailable = 'NO';";
            $que_document_P_count = mysqli_query($conn,$sql_document_P_count) or die(mysqli_error($conn));
            while($rec_document_P_count = mysqli_fetch_array($que_document_P_count)){
                echo "<td style='width:70px;text-align:left;'>".$rec_document_P_count[0]."</td>";
            }
        } 
        
        
		echo "<td style='width:70px;text-align:center;'>";
		echo "<input style='font-size: 12px;' type='button' id='btnView' name='btnView' value='View' title='txtb".$a."' onclick='filemovement(this.id,title)'/>";
		echo "</td>";
		echo "</tr>";
		$a++;
	}
?>
</table>