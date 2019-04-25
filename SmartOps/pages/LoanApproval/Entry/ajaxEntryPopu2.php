<?php
	$x=$_REQUEST['txtsearchsub'];//Select File name
	include('../../../php_con/includes/db.ini.php');
?>
		<?php
            $viewDocsub = "SELECT `user`.`userName`, `user`.`userID`, `user`.`branchNumber`, `branch`.`branchName`, `user`.`deparmentNumber`, `deparment`.`deparmentName`
                            FROM `user`, `branch`, `deparment` 
                            WHERE `user`.`branchNumber` = `branch`.`branchNumber` 
                                    AND `user`.`deparmentNumber` = `deparment`.`deparmentNumber` 
                                    AND `user`.`userID` like '%$x%'";
            $sql_viewDocsub = mysqli_query($conn,$viewDocsub);
        ?>
        
       <table class="tbl1" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">User Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">User Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($addsub = mysqli_fetch_array($sql_viewDocsub)){
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <input style='width:150px;' type='text' name='txt1sub".$a."' id='txt1sub".$a."' value='".$addsub[0]."' readonly='readonly'/></td>";
                        echo "<td style='width:200px;'>
                              <input style='width:200px;' type='text' name='txt2sub".$a."' id='txt2sub".$a."' value='".$addsub[1]."' readonly='readonly'/>
                              <div style='display:none;'>
                                <input style='width:200px;' type='text' name='txt3sub".$a."' id='txt3sub".$a."' value='".$addsub[2]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt4sub".$a."' id='txt4sub".$a."' value='".$addsub[3]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt5sub".$a."' id='txt5sub".$a."' value='".$addsub[4]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt6sub".$a."' id='txt6sub".$a."' value='".$addsub[5]."' readonly='readonly'/>
                              </div>
                              </td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' title='".$a."' onclick='selectDBsub(title);popupsub(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>