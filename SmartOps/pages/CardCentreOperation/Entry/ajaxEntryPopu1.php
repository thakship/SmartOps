<?php
	$x=$_REQUEST['txtsearch'];//Select File name
	include('../../../php_con/includes/db.ini.php');
?>
		<?php
            //$viewDoc = "SELECT `userName`,`userID` FROM `user` where `userID` like '%$x%'";
             $viewDoc = "SELECT u.userName, u.userID , u.branchNumber , b.branchName 
                                            FROM user AS u , branch AS b
                                            WHERE u.branchNumber = b.branchNumber AND
                                                  u.userStat = 'A' AND 
                                                 u.userID like '%$x%';";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table class="tbl1" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">User Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">User Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                        echo "<td style='width:200px;'>
                              <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/>
                               <input style='display: none;' type='text' name='txt3".$a."' id='txt3".$a."' value='".$add[2]."' />
                               <input style='display: none;' type='text' name='txt4".$a."' id='txt4".$a."' value='".$add[3]."' />
                                          
                              </td>";
                        
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>