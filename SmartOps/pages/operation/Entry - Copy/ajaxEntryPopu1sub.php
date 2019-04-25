<?php
	$x=$_REQUEST['txtsearch'];//Select File name
	include('../../../php_con/includes/db.ini.php');
?>
		<?php
            $viewDoc = "SELECT b.branchNumber, b.branchName, b.br_code FROM branch b WHERE b.branchName like '%$x%' AND b.branchNumber != '1212' AND  b.branchNumber != '9522'
                        UNION ALL 
                        SELECT d.deparmentNumber,d.deparmentName,d.br_code FROM deparment d WHERE d.deparmentName like '%$x%' AND d.deparmentName != 'GENARAL' AND d.deparmentNumber != '01003' AND d.deparmentNumber != '40301'";
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
                              <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[2]."' readonly='readonly'/></td>";
                        echo "<td style='width:200px;'>
                              <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>