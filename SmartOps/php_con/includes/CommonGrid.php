<?php
function ShowGrid($conn,$sql,$OutputCode,$OutputDescription,$pop,$funcname,$txt,$txta,$relationship){
	//echo $relationship."<br/>";
	//echo $OutputCode."<br/>";
	//echo $OutputDescription."<br/>";
	//echo $funcname."<br/>";
	
	//echo $sql."<br/>"; 
	$sql = str_replace('%1%', "'".$relationship."'", $sql);
	//echo $sql."<br/>"; 
	
	$sql_grid= mysqli_query($conn,$sql) or die(mysqli_error($conn));
    echo "<table class='tblsub' border='1'><tr>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Code</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Description</td>
              		<td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td> </tr>";
					
	$a = 1 ;					
	while ($recs = mysqli_fetch_array($sql_grid)){
		if ($a==1){
			echo "<script>
					function ".$funcname."(obj,title){
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						if(obj == 'btnselect'){ 
							var id1 = document.getElementById(m1).value;
							var id2 = document.getElementById(n1).value;
							document.getElementById('".$OutputCode."').value = id1;
							document.getElementById('".$OutputDescription."').value = id2;
							var mydata;
							mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
								if(mydata.readyState==4){
									document.getElementById('test').innerHTML=mydata.responseText;
								}
							}
							mydata.open('GET','ajaxUserDepartmet.php'+'?g1='+id1,true);
							mydata.send();
						}else{
							alert('else my code');
						}
					} 
				</script>";
		}
			/*document.getElementById('".$OutputCode."').value = id1;*/
			/*echo "<script>alert(document.getElementById('".$OutputCode."').value);</script>";*/
     	
        echo "<tr style='background-color:#FFFFFF;'>";
        echo "<td style='width:200px;'><div style='display:none;'><input class='txt' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."'/></div> 
                              <input style='width:200px;' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."' disabled='disabled'/></td>";
        echo "<td style='width:200px;'> <div style='display:none;'><input class='txt' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."'/></div>
                              <input style='width:200px;' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."' disabled='disabled'/></td>";
        echo "<td style='width:100px;'>";
        echo "<input type='button' id='btnselect' name='btnselect' title='$txt".$a."|$txta".$a."' value='Select' onclick='".$funcname."(this.id,title);".$pop.";'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
	
}


?>