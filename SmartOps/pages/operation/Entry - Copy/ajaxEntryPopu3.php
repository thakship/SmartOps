<?php
	$x=$_REQUEST['txtsearch'];//Select File name txtsearch
	include('../../../php_con/includes/db.ini.php');
    
    $viewDoc = "SELECT c.helpid , c.issue 
                  FROM cdb_helpdesk AS c 
                 WHERE c.issue like '%$x%'
				 and c.scat_code_2 = '200115'";
    $sql_viewDoc = mysqli_query($conn,$viewDoc);
    echo "<table class='tbl1' border='1' cellpadding='0' cellspacing='0'>
            <tr>
                <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>Help ID</td>
                <td style='text-align:center; padding-top:5px; padding-bottom:5;width:400px;'>Request</td>
            </tr>";
    $a = 1 ;
    while ($add = mysqli_fetch_array($sql_viewDoc)){
        echo "<tr style='background-color:#FFFFFF;' title=".$a." ondblclick='selectDB(title);popup(0);'> ";
        echo "<td style='width:200px;'><input style='width:200px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
        echo "<td style='width:400px;'><input style='width:400px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
        echo "</tr>";
        $a++;
    }
	echo "</table>";
?>