<?php
	$t=$_REQUEST['txtpartha'];
	//echo $t;
	include ('../../../php_con/function_PHP/reader.php');
    $excel = new Spreadsheet_Excel_Reader();
?>
<table width="921" border="1" id="myTable1" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Sub Document Number</td>
    <td width="449" style="width:350px;">Sub Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
    <?php
    $excel->read($t);    
    $x=1;
    while($x<=$excel->sheets[0]['numRows']) {
      echo "\t<tr style='width:800px;'>\n";
      $y=1;
	  
		echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txtaa".$x."' id='txtaa".$x."' value='".$x."' onKeyPress='return disableEnterKey(event)' readonly required/></td>";

	$cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
	
	echo "\t\t<td style='width:350px;'><input style='width:350px;' type='text' name='txtbb".$x."' id='txtbb".$x."' value='".$cell."' onKeyPress='return disableEnterKey(event)' required/></td>\n"; 
	
	$y++;
	$cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';	
	echo "\t\t<td style='width:350px;'><input style='width:350px;' type='text' name='txtcc".$x."' id='txtcc".$x."' value='".$cell."' onKeyPress='return disableEnterKey(event)' required/></td>\n";
	  echo " <td style='width:100px;'><input type='button' value='Delete' id='del' name='del' onclick='deleteRow(this)'></td>";  
      echo "\t</tr>\n";
      $x++;
    }
    ?>    
    </table>
<table>
  <tr>
    <td><p class="linetop">Number of Document(s)</p></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="<?php echo $x-1; ?>"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="<?php echo $x-1; ?>" disabled="disabled"/>
   </td>
  </tr>
</table>
