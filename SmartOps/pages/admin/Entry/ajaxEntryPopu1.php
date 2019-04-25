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
            $viewDoc = "SELECT `userID`,`userName` FROM `user` where `userName` like '$x%'";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table style="width: 500px; margin-left: 30px;" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">User ID</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">User Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<script>
								function selectDBsub".$a."(){
									var id1 = document.getElementById('txts".$a."').value;
									document.getElementById('txtBOIC1').value = id1;
									var id2 = document.getElementById('txtd".$a."').value;
									document.getElementById('txtBOIC').value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:200px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txts".$a."' id='txts".$a."' value='".$add[0]."'/></div> 
                              <input style='width:200px;' type='text' name='txts".$a."' id='txts".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txtd".$a."' id='txtd".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txtd".$a."' id='txtd".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' tyle='font-size: 12px;' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' onclick='selectDBsub".$a."();popupsub(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>