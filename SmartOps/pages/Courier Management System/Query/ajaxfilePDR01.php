<?php
	$x=$_REQUEST['txt1']; //File namuber
	$y=$_REQUEST['txt2']; //filename
	
	include('../../../php_con/includes/db.ini.php');
	$subselect = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='$x'";
	$sqlsubselct = mysqli_query($conn,$subselect);
	while($chekSts = mysqli_fetch_array($sqlsubselct)){
		//echo $chekSts[0];
		if($chekSts[0] == "NO"){
			$selectFilenum = "SELECT @rownum := @rownum + 1 AS rank,`documentNumber`,`documentName`,`receiveAvailable`,`partiallyNote` , `disacknowledgmentNote` FROM `courier_document`,(SELECT @rownum := 0) r WHERE `fileNumber`='$x'";
			//echo $selectFileName;					   
			$sql_FileNum = mysqli_query($conn,$selectFilenum);
?>
            <table id="ggg" class="tbl2" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">Rank</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Doc. Number</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">Document Name</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">Received State</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;">Partially Note</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;">Disacknowledgment Note</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">#</td>
                  </tr>
<?php
			$a = 1;
			while ($add_rec = mysqli_fetch_array($sql_FileNum)){
				echo "<tr style='background-color:#FFFFFF;'>";
				echo "<td style='width:50px;text-align:left;'>".$add_rec[0]."</td>";
				echo "<td style='width:150px;text-align:left;'>".$add_rec[1]."</td>";
				echo "<td style='width:200px;text-align:left;'>".$add_rec[2]."</td>";
				echo "<td style='width:100px;text-align:left;'>".$add_rec[3]."</td>";
   	            echo "<td style='width:300px;text-align:left;'>".$add_rec[4]."</td>";
               	echo "<td style='width:300px;text-align:left;'>";
                    if($add_rec[3] == "NO" && $add_rec[5] == ""){
                        echo " <input type='text' style='width:300px;text-align:left;background-color: #DAA7BA;' name='txtDisNote".$a."' id='txtDisNote".$a."' value=''/>";
                    }else{
                        echo " - ";
                    }
                  
                echo "</td>";
                echo "<td style='width:100px;text-align:left;'>";
                    if($add_rec[3] == "NO" && $add_rec[5] == ""){
                        echo "<input class='buttonManage' style='width:100px;margin-left: 5px;' type='button' value='Update' title='".$x."|".$add_rec[1]."|".$a."' onclick='isBranchError(title)' />";
                    }else{
                        echo " - ";
                    }
                echo "</td>";
				echo "</tr>";
				$a++;
			}
?>
			</table>
<?php
		}else{
			$selectFilenum = "SELECT @rownum := @rownum + 1 AS rank,`subDocumentNumber`,`subDocumentName`,`receiveAvailable` ,`partiallyNote` , `disacknowledgmentNote` FROM `courier_document_sub`,(SELECT @rownum := 0) r WHERE `fileNumber`='$x'";
			//echo $selectFileName;					   
			$sql_FileNum = mysqli_query($conn,$selectFilenum);
			//$row_table = mysqli_num_rows($sql_selectFileName);
			//echo $row_table;
?>
            <table id="ggg" class="tbl2" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5; width:50px;">Rank</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5; width:150px;">Doc. Number</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:200px;">Document Name</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">Received State</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;">Partially Note</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:300px;">Disacknowledgment Note</td>
                    <td style="text-align:left; padding-top:5px; padding-bottom:5;width:100px;">#</td>
                  </tr>
<?php
			$a = 1;
			while ($add_rec = mysqli_fetch_array($sql_FileNum)){
				echo "<tr style='background-color:#FFFFFF;'>";
				echo "<td style='width:50px;text-align:left;'>".$add_rec[0]."</td>";
				echo "<td style='width:150px;text-align:left;'>".$add_rec[1]."</td>";
				echo "<td style='width:200px;text-align:left;'>".$add_rec[2]."</td>";
			    echo "<td style='width:100px;text-align:left;'>".$add_rec[3]."</td>";
   	            echo "<td style='width:300px;text-align:left;'>".$add_rec[4]."</td>";
               	echo "<td style='width:300px;text-align:left;'>";
                    if($add_rec[3] == "NO" && $add_rec[5] == ""){
                        echo " <input type='text' style='width:300px;text-align:left;background-color: #DAA7BA;' name='txtDisNote".$a."' id='txtDisNote".$a."' value=''/>";
                    }else{
                        echo " - ";
                    }
                  
                echo "</td>";
                echo "<td style='width:100px;text-align:left;'>";
                    if($add_rec[3] == "NO" && $add_rec[5] == ""){
                        echo "<input class='buttonManage' style='width:100px;margin-left: 5px;' type='button' value='Update' title='".$x."|".$add_rec[1]."|".$a."' onclick='isBranchError(title)' />";
                    }else{
                        echo " - ";
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
	