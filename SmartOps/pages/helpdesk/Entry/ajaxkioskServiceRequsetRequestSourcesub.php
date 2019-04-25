<?php
session_start();
	$x=$_REQUEST['txtsearch'];//Select File name
	include('../../../php_con/includes/db.ini.php');
?>
		<?php
            $viewDoc = "SELECT ch.`helpid` , ch.`issue` , ch.`help_discr` FROM `cdb_helpdesk` ch,`scat_02` s2 WHERE ch.`issue` like '%$x%' AND ch.`cat_code` = '1024' AND ch.`cmb_code` = '5001' AND ch.cat_code = s2.cat_code AND ch.scat_code_1 = s2.scat_code_1 AND ch.scat_code_2 = s2.scat_code_2 AND s2.scat_discr_2 = '". $_SESSION['userBranchName']."'";
           // echo $viewDoc;
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table class="tbl1" border="1">
              <tr>
                 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:100px;">Help ID</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Contact Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">Description </td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<tr style='background-color:#FFFFFF;'>";
                         echo "<td style='width:100px;'>
                              <input style='width:100px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                        echo "<td style='width:100px;'>
                              <input style='width:100px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                              echo "<td style='width:300px;'>
                        <input style='width:300px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[2]."' readonly='readonly'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>