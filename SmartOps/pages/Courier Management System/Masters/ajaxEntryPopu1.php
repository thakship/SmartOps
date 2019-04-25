<?php
	$x=$_REQUEST['txtsearch'];//Select File name
	//$g=$_REQUEST['txt3'];//Select File name
	//echo $g;
	include('../../../php_con/includes/db.ini.php');
	/*$selectFileName = "SELECT @rownum := @rownum + 1 AS rank,`fileNumber`,`fileName`,`remarks` 
					   FROM `courier_files`,(SELECT @rownum := 0) r
					   where filename like '$x%' AND `fileType` like '$g' ";*/
	//echo $selectFileName;					   
	//$sql_selectFileName = mysqli_query($conn,$selectFileName);
?>
		<?php
            $viewDoc = "SELECT `documentNumber`,`documentName` FROM `courier_masters_document` where `documentName` like '$x%'";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table class="tbl1" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Document Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Document Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<script>
								function selectDB".$a."(){
									var id1 = document.getElementById('txt1".$a."').value;
									var newID = document.getElementById('tx').value;
									document.getElementById(newID).value = id1;
									var id2 = document.getElementById('txt2".$a."').value;
									var newName = document.getElementById('ty').value;
									document.getElementById(newName).value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."'/></div> 
                              <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' onclick='selectDB".$a."();popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>