<?php
	$t=$_REQUEST['txtpartha'];
	echo $t;
	include ('../../../php_con/function_PHP/reader.php');
    $excel = new Spreadsheet_Excel_Reader();
?>
<table  border="1" id="myTable1" style="width:800px;">
    <?php
    $excel->read($t);    
    $x=1;
    while($x<=$excel->sheets[0]['numRows']) {
      echo "\t<tr>\n";
       $y=1;
	  
      $cell1 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][1] : '';
      $cell2 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][2] : '';
      $cell3 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][3] : '';
      $cell4 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][4] : '';
      $cell5 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][5] : '';
      $cell6 = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][6] : '';
	
	  echo "\t\t<td style='width:350px;'>";
             echo "ACCOUNT_CLIENT_CODE : ".$cell1."\n";
             echo "ACCOUNT_BRANCH_NAME : ".$cell2."\n";
             echo "PRIMARY CLIENT NAME : ".$cell3."\n";
             echo "FULL LOCATION : ".$cell4."\n";
             echo "TELE_RES : ".$cell5."\n";
             echo "TELE_MOB : ".$cell6;
                
       echo "</td>\n"; 
	
	  // $y++;
	  // $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';	
        echo "\t</tr>\n";
        $x++;
    }
    ?>    
    </table>
    <?php
        echo $x;
    ?>
   
